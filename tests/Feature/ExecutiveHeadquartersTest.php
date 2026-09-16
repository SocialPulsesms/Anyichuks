<?php

use App\Models\Business;
use App\Models\ImpactProject;
use App\Models\PressAsset;
use App\Models\VerifiedClaim;
use App\Models\Award;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->artisan('db:seed', ['--force' => true]);
});

test('welcome homepage renders successfully with executive content', function () {
    $response = $this->get('/');
    $response->assertStatus(200);
    $response->assertSee('Dr. Ifeanyi Chukwuma Odii');
    $response->assertSee('Orient Global Group');
});

test('press centre page renders with approved media assets', function () {
    $response = $this->get('/press');
    $response->assertStatus(200);
    $response->assertSee('Official Press Centre');
    $response->assertSee('Official Executive Biography');
});

test('global search API returns matched items from database', function () {
    $response = $this->get('/api/search?q=Orient');
    $response->assertStatus(200);
    $response->assertJsonPath('query', 'Orient');
    expect(count($response->json('results.businesses')))->toBeGreaterThan(0);
});

test('impact map API returns real database aggregated project categories', function () {
    $response = $this->get('/api/impact-map');
    $response->assertStatus(200);
    $response->assertJsonStructure([
        'total_projects',
        'by_category',
        'by_year',
        'by_state',
        'projects',
    ]);
    expect($response->json('total_projects'))->toBeGreaterThan(0);
});

test('system health route requires admin auth', function () {
    // Guest gets redirect to login
    $response = $this->get('/admin/system-health');
    $response->assertRedirect('/contacts-login');

    // Authenticated admin gets dashboard
    session(['admin_logged_in' => true]);
    $response = $this->get('/admin/system-health');
    $response->assertStatus(200);
    $response->assertSee('Production System Health');
});

test('sitemap xml and robots txt return valid responses', function () {
    $sitemap = $this->get('/sitemap.xml');
    $sitemap->assertStatus(200);
    $sitemap->assertHeader('Content-Type', 'application/xml');

    $robots = $this->get('/robots.txt');
    $robots->assertStatus(200);
    $robots->assertHeader('Content-Type', 'text/plain; charset=UTF-8');
});

test('ai chat endpoint returns grounded executive response', function () {
    $response = $this->postJson('/api/ai-chat', ['message' => 'Tell me about Orient Global Group']);
    $response->assertStatus(200);
    $response->assertJsonStructure(['reply']);
    expect($response->json('reply'))->not->toBeEmpty();
});
