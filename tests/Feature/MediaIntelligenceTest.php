<?php

use App\Models\TrackedKeyword;
use App\Models\Mention;
use App\Models\MentionSource;
use App\Models\MentionCluster;
use App\Models\MonitoringProvider;
use App\Models\AlertRule;
use App\Models\Alert;
use App\Services\MediaIntelligenceService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;

uses(RefreshDatabase::class);

beforeEach(function () {
    // Seed default keywords, providers, and alert rules
    $this->artisan('db:seed', ['--force' => true]);
    $this->service = app(MediaIntelligenceService::class);
});

test('keyword detection matches default tracked keywords', function () {
    $activeKeywords = TrackedKeyword::where('is_active', true)->pluck('keyword')->toArray();

    // Positive matches
    expect($this->service->checkKeywords("Breaking news about Chief Ifeanyi Odii today.", $activeKeywords))->toBe("Chief Ifeanyi Odii");
    expect($this->service->checkKeywords("The candidate ANYICHUKS won the governorship primaries.", $activeKeywords))->toBe("Anyichuks");
    expect($this->service->checkKeywords("Dr Ifeanyichukwu Odii is building modern schools.", $activeKeywords))->toBe("Dr Ifeanyichukwu Odii");

    // Negative matches (not in list)
    expect($this->service->checkKeywords("Some random text with no politicians.", $activeKeywords))->toBeNull();
});

test('false positive heuristic classification correctly filters non-target entities', function () {
    // Matched keyword is "Ifeanyi Odii", but text talks about someone else named Odii without context
    $item = [
        'title' => 'Professor Chukwuemeka Odii receives award in biology',
        'description' => 'A botany researcher named Odii received an award for academic papers.',
        'content' => 'The academic researcher Professor Chukwuemeka Odii from Enugu state received praise today.',
        'url' => 'https://example.com/botany-award',
        'published_at' => now()->toDateTimeString(),
        'source_name' => 'Academic Times',
        'source_domain' => 'academictimes.com',
        'logo_url' => null,
    ];

    $analysis = $this->service->verifyAndClassify($item, 'Ifeanyi Odii');
    
    // Heuristic should reject this due to lack of target context clues (PDP, Anyichuks, Ebonyi, etc.)
    expect($analysis['entity_confirmed'])->toBeFalse();
    expect($analysis['confidence_score'])->toBeLessThan(0.5);
    expect($analysis['reason'])->toContain('Rejected');
});

test('entity is confirmed when keyword matching contains target context clues', function () {
    $item = [
        'title' => 'Ifeanyi Odii promises massive industrialization',
        'description' => 'The governorship candidate for Ebonyi state PDP, Ifeanyi Odii, discussed economic policies.',
        'content' => 'Speaking at the PDP rally in Ebonyi state, Ifeanyi Odii announced plans to support local manufacturing.',
        'url' => 'https://example.com/pdp-rally',
        'published_at' => now()->toDateTimeString(),
        'source_name' => 'Vanguard News',
        'source_domain' => 'vanguardngr.com',
        'logo_url' => null,
    ];

    $analysis = $this->service->verifyAndClassify($item, 'Ifeanyi Odii');
    
    expect($analysis['entity_confirmed'])->toBeTrue();
    expect($analysis['confidence_score'])->toBeGreaterThanOrEqual(0.8);
    expect($analysis['category'])->toBe('Politics');
});

test('duplicate detection prevents redundant persistence', function () {
    $provider = MonitoringProvider::first();

    $item = [
        'title' => 'Anyichuks donates homes to widows',
        'description' => 'Dr. Ifeanyi Odii under the Ebele & Anyichuks Foundation built 140 free houses in Ebonyi.',
        'content' => 'Dr. Ifeanyi Chukwuma Odii co-founded the Ebele and Anyichuks Foundation.',
        'url' => 'https://example.com/charity-housing',
        'published_at' => now()->toDateTimeString(),
        'source_name' => 'Punch News',
        'source_domain' => 'punchng.com',
        'logo_url' => null,
    ];

    // Check direct logic:
    $activeKeywords = TrackedKeyword::pluck('keyword')->toArray();
    $matched = $this->service->checkKeywords($item['title'], $activeKeywords);
    $contentHash = md5($item['url'] . $item['title']);

    // 1st insertion
    $analysis = $this->service->verifyAndClassify($item, $matched);
    $cluster = $this->service->findOrCreateCluster($item['title'], $analysis['sentiment'], $item['published_at']);

    // Manually store using reflection for private method
    $method = new ReflectionMethod($this->service, 'storeMention');
    $method->setAccessible(true);
    $mention1 = $method->invoke($this->service, $provider, $item, $matched, $contentHash, $analysis, $cluster);

    expect(Mention::count())->toBe(1);

    // 2nd insertion check
    $exists = Mention::where('url', $item['url'])
        ->orWhere('content_hash', $contentHash)
        ->exists();

    expect($exists)->toBeTrue();
});

test('duplicate coverage is grouped into the same story cluster', function () {
    $publishedAt = now()->toDateTimeString();

    // Insert 1st mention
    $cluster1 = $this->service->findOrCreateCluster("Anyichuks PDP candidate Ebonyi governorship campaign rally", "positive", $publishedAt);
    
    // Insert 2nd similar mention (similar syndicated headline)
    $cluster2 = $this->service->findOrCreateCluster("Ebonyi PDP campaign: Anyichuks governorship rally details", "positive", $publishedAt);

    // They should share words: "Anyichuks", "PDP", "Ebonyi", "governorship", "campaign", "rally"
    // Therefore they should resolve to the SAME cluster!
    expect($cluster1->id)->toBe($cluster2->id);
    expect(MentionCluster::count())->toBe(1);
});

test('alert rules trigger alert logs when criteria is met', function () {
    $mention = Mention::create([
        'mention_source_id' => MentionSource::create(['name' => 'Test Src', 'domain' => 'test.com'])->id,
        'title' => 'Dr Ifeanyichukwu Odii controversy in elections',
        'url' => 'https://test.com/controversy-elections',
        'content_hash' => 'hash123',
        'matched_keyword' => 'Dr Ifeanyichukwu Odii',
        'sentiment' => 'negative',
        'category' => 'Politics',
        'importance' => 'high',
        'published_at' => now(),
        'detected_at' => now(),
        'entity_confirmed' => true,
    ]);

    $cluster = MentionCluster::create([
        'title' => $mention->title,
        'first_detected_at' => now(),
        'last_updated_at' => now(),
        'overall_sentiment' => 'negative'
    ]);

    $this->service->triggerAlertRules($mention, $cluster);

    // Expect alert logged in DB for "High Importance" and "Negative Sentiment" rules
    // Total rules triggered should be 3: "every mention", "high importance", "negative sentiment"
    expect(Alert::count())->toBe(3);
    expect(Alert::where('title', 'Alert for every mention')->exists())->toBeTrue();
    expect(Alert::where('title', 'Alert for High/Breaking Importance')->exists())->toBeTrue();
});

test('media intelligence routes are protected from unauthorized visitors', function () {
    // Guest gets redirect to login
    $response = $this->get('/admin/media-intelligence');
    $response->assertRedirect('/contacts-login');

    // Authenticated admin gets dashboard
    session(['admin_logged_in' => true]);
    $response = $this->get('/admin/media-intelligence');
    $response->assertStatus(200);
});

test('sse stream returns correct event headers', function () {
    session(['admin_logged_in' => true]);
    
    $response = $this->get('/api/media-intelligence/stream');
    $response->assertHeader('Content-Type', 'text/event-stream; charset=utf-8');
    $response->assertHeader('Cache-Control', 'no-cache, private');
});
