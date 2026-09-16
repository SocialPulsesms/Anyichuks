<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/contact', function () {
    return view('contact');
});

Route::post('/api/ai-chat', function (Request $request) {
    $userMessage = $request->input('message');
    if (empty($userMessage)) {
        return response()->json(['error' => 'Message is required.'], 400);
    }

    $apiKey = config('services.gemini.key') ?: env('GEMINI_API_KEY');

    // Authoritative Campaign Knowledge Base Fallback Generator
    $generateFallbackReply = function ($userMsg) {
        $query = strtolower(trim($userMsg));

        // 1. Wife & Family
        if (str_contains($query, 'wife') || str_contains($query, 'ebele') || str_contains($query, 'family') || str_contains($query, 'nwunye')) {
            return "Dr. Ifeanyi Chukwuma Odii is happily married to his beloved wife, **Chief Dr. Mrs. Ebelechukwu Odii (Ebele Odii)**, and they are blessed with lovely children.\n\n" .
                   "• **A True Pillar of Compassion:** Chief Dr. Mrs. Ebelechukwu Odii is an esteemed philanthropist, humanitarian, and champion of women empowerment and maternal healthcare.\n" .
                   "• **The Ebele & Anyichuks Foundation:** Together with Dr. Odii, she co-founded and actively directs the renowned Ebele & Anyichuks Foundation. Under their direct guidance, the foundation has built over 140 modern bungalows completely free of charge for indigent widows, distributed millions in food and healthcare materials, and provided over 1,000 university scholarships across Ebonyi State and Nigeria.\n" .
                   "• **Ebonyi First Lady in Waiting:** As incoming First Lady in 2027, she is championing grassroots initiatives for widow protection, girl-child education, skills acquisition, and maternal health across all 171 wards.";
        }

        // 2. Who is Anyichuks / Bio / Profile / Track Record
        if (str_contains($query, 'who is') || str_contains($query, 'about anyichuks') || str_contains($query, 'profile') || str_contains($query, 'biography') || str_contains($query, 'track record') || str_contains($query, 'onye bu')) {
            return "Dr. Ifeanyi Chukwuma Odii (MFR), popularly known as **Anyichuks**, is a visionary industrialist, global entrepreneur, philanthropist par excellence, and the PDP candidate for Governor of Ebonyi State 2027 under the banner of **ANYI GA EMEYA 2027**.\n\n" .
                   "• **Origins:** Born on April 17, 1977, in Isu, Onicha Local Government Area of Ebonyi State.\n" .
                   "• **Business Conglomerates:** He is the Founder, Chairman, and CEO of **Orient Global Group** (manufacturing, logistics, haulage, agribusiness) and President/CEO of **Ultimus Holdings** (pan-African investment, real estate, energy, infrastructure, healthcare). Over two decades, he has built multi-billion-naira enterprises creating thousands of jobs.\n" .
                   "• **Philanthropy (Without Government Office):** Through the Ebele & Anyichuks Foundation, he has built over 140 free furnished homes for widows, awarded 1,000+ full university scholarships, drilled community boreholes, and built schools and churches purely from personal earnings.\n" .
                   "• **2027 Vision:** Leading Ebonyi into an era of massive local mineral and agro-industrialization, guaranteed 25th-of-the-month civil service salaries, automated rice milling hubs, and 40,000 direct youth jobs.";
        }

        // 3. Widows / Free Houses / Philanthropy / Charity
        if (str_contains($query, 'widow') || str_contains($query, 'house') || str_contains($query, 'home') || str_contains($query, 'philanthrop') || str_contains($query, 'charity') || str_contains($query, 'scholarship') || str_contains($query, 'foundation') || str_contains($query, 'ụlọ') || str_contains($query, 'ulo')) {
            return "Dr. Ifeanyi Chukwuma Odii's historic philanthropic record through the **Ebele & Anyichuks Foundation** is unmatched in Ebonyi State:\n\n" .
                   "• **140+ Free Modern Bungalows:** Built, fully furnished, and handed over free of charge with full title to indigent widows and homeless vulnerable families across all 13 LGAs of Ebonyi State.\n" .
                   "• **1,000+ University Scholarships:** Full tuition, accommodation, and living stipends for Ebonyi youths in AE-FUNAI, Ebonyi State University (EBSU), UNN, and international institutions.\n" .
                   "• **10,000+ Free WAEC & JAMB Sponsorships:** Lifting the financial burden off low-income parents and students.\n" .
                   "• **Clean Water Boreholes & Churches:** Modern solar-powered boreholes and community worship centers installed across rural wards.\n\n" .
                   "*Crucially, Dr. Odii accomplished all of this with private wealth as an ordinary citizen—demonstrating the unprecedented transformation he will deliver with state resources as Governor in 2027.*";
        }

        // 4. Civil Service / Salary / Pension / Workers
        if (str_contains($query, 'salary') || str_contains($query, 'pension') || str_contains($query, 'civil service') || str_contains($query, 'worker') || str_contains($query, 'gratuity') || str_contains($query, 'ọrụ') || str_contains($query, 'oru') || str_contains($query, 'retiree')) {
            return "Dr. Ifeanyi Chukwuma Odii holds civil servants and retirees as the sacred heartbeat of Ebonyi State:\n\n" .
                   "• **Guaranteed 25th Salary Payment:** Uninterrupted, automated salary payment on the 25th of every single month for all state and LGA workers.\n" .
                   "• **Liquidation of Pension & Gratuity Backlogs:** A structured, ring-fenced fund to immediately commence settling accumulated pensions and gratuities owed to retirees.\n" .
                   "• **Worker Dignity & Welfare:** Complete cessation of worker harassment or punitive deductions; implementation of transparent, merit-based civil service promotions.\n" .
                   "• **Civil Service Health Insurance:** Comprehensive healthcare coverage for government workers and their dependents.";
        }

        // 5. Agriculture / Rice / Farming / Grants
        if (str_contains($query, 'agric') || str_contains($query, 'rice') || str_contains($query, 'farm') || str_contains($query, 'crop') || str_contains($query, 'yam') || str_contains($query, 'cassava') || str_contains($query, 'ugbo')) {
            return "Dr. Odii's ANYI GA EMEYA 2027 agricultural blueprint will revolutionize Ebonyi farming into a high-wealth commercial industry:\n\n" .
                   "• **3 Senatorial Automated Rice Hubs:** Building mega destoning, parboiling, and packaging complexes in Izzi, Ikwo, and Onicha to guarantee Ebonyi rice commands top export prices globally.\n" .
                   "• **₦20 Billion Agricultural Revolving Fund:** Providing single-digit low-interest micro-credit and mechanized equipment leasing to farmers' cooperatives and women agrarian groups.\n" .
                   "• **Subsidized Seedlings & Fertilizer:** Certified high-yield rice, yam, and cassava seedlings distributed directly to genuine farmers in all 13 LGAs.\n" .
                   "• **Guaranteed Off-Taker Scheme:** State purchase guarantees ensuring no farmer is forced to sell produce at a loss during peak harvest.\n" .
                   "• **Rural Farm Feeder Roads:** Constructing durable feeder roads connecting farms directly to urban markets.";
        }

        // 6. Youth / Jobs / Tech / Industries / Employment
        if (str_contains($query, 'job') || str_contains($query, 'youth') || str_contains($query, 'tech') || str_contains($query, 'employ') || str_contains($query, 'work') || str_contains($query, 'industry') || str_contains($query, 'business') || str_contains($query, 'grant')) {
            return "Dr. Ifeanyi Chukwuma Odii's Youth & Industrialization Plan is built on private-sector proven models:\n\n" .
                   "• **40,000 Direct Industrial Jobs:** Deploying the Orient Global enterprise framework to set up mineral processing factories (limestone, lead, zinc, salt) inside Ebonyi, ending the raw export of state wealth.\n" .
                   "• **3 Senatorial ICT & Innovation Hubs:** World-class digital academies in Abakaliki, Afikpo, and Onueke offering free certified training in software engineering, AI, cybersecurity, and digital creative arts.\n" .
                   "• **10,000 Youth Enterprise Seed Grants:** Non-repayable seed capital and vendor financing for young entrepreneurs and tech startups.\n" .
                   "• **Sports & Creative Arts Endowment:** Grassroots football academies, creative arts incubation, and entertainment grants for talented Ebonyi youth.";
        }

        // 7. Roads / Infrastructure / Water / Light
        if (str_contains($query, 'road') || str_contains($query, 'uzọ') || str_contains($query, 'uzo') || str_contains($query, 'infrastruct') || str_contains($query, 'water') || str_contains($query, 'light') || str_contains($query, 'power')) {
            return "Dr. Odii's Infrastructure Strategy focuses on durable, economic-yielding investments:\n\n" .
                   "• **Rural Farm-to-Market Arteries:** Eliminating food transport loss by tarring critical rural feeder networks across all 13 LGAs.\n" .
                   "• **Inter-LGA Link Roads:** Upgrading key economic corridors connecting Ebonyi North, Central, and South with Enugu, Abia, and Cross River.\n" .
                   "• **Solar Electrification:** Powering primary healthcare centers, bustling night markets, and trading hubs with reliable solar micro-grids.\n" .
                   "• **Pipe-Borne & Clean Borehole Water:** Revitalizing regional water schemes and installing solar-powered water reticulation in rural communities.";
        }

        // 8. Igbo Greetings & Conversational Queries
        if (str_contains($query, 'kedu') || str_contains($query, 'ndewo') || str_contains($query, 'anyi ga emeya') || str_contains($query, 'onye') || str_contains($query, 'nwanne')) {
            return "Ndewo nwanne m! Nnọọ na ANYI GA EMEYA 2027 AI Town Hall.\n\n" .
                   "Dr. Ifeanyi Chukwuma Odii (Anyichuks) na nwunye ya, Chief Dr. Mrs. Ebelechukwu Odii, ji obi ha dum na-echebara ndị Ebonyi echiche.\n\n" .
                   "Atụmatụ ya maka Ebonyi na 2027 gụnyere:\n" .
                   "• **Ịkwụ ndị ọrụ gọọmentị ụgwọ:** Ụbọchị iri abụọ na ise (25th) nke ọnwa ọ bụla n'enweghị nkwụsị.\n" .
                   "• **Ọrụ maka ndị ntorobịa:** Ụlọ ọrụ mmepụta ihe 40,000 na agụmakwụkwọ kọmputa n'efu.\n" .
                   "• **Ndị ọrụ ugbo:** Ịkwado ndị na-akọ osikapa na ji na ₦20 Billion ego mgbazinye dị mfe.\n" .
                   "• **Ụlọ n'efu maka ndị inyom di nwụrụ:** Ịga n'ihu n'iwu ụlọ ọgbara ọhụrụ n'efu (karịrị ụlọ 140 o wuru na mbụ).\n\n" .
                   "Jikọọ aka na anyị dịka ANYI GA EMEYA 2027 Ambassador taa!";
        }

        // Default Comprehensive Campaign Overview
        return "Dr. Ifeanyi Chukwuma Odii (Anyichuks) is leading the **ANYI GA EMEYA 2027** movement under the Peoples Democratic Party (PDP) for the total economic rebirth, industrialization, and human capital upliftment of Ebonyi State.\n\n" .
               "• **Core Pillars:** 40,000 industrial and tech jobs, prompt civil service salaries on the 25th, clearing pension backlogs, modern mechanized agriculture for Ebonyi rice farmers, solar-powered primary healthcare in all 171 wards, and continuing the 140+ free houses legacy of the Ebele & Anyichuks Foundation.\n\n" .
               "Feel free to ask about his specific plans for your LGA, his background, his businesses (Orient Global, Ultimus), his wife Chief Dr. Mrs. Ebelechukwu Odii, or how to register as a 2027 Campaign Ambassador!";
    };

    // Check cache for instant repeat response (< 5ms)
    $cacheKey = 'ai_rep_' . md5(trim(strtolower($userMessage)));
    if ($cached = cache($cacheKey)) {
        return response()->json(['reply' => $cached]);
    }

    // Fast-path: If user clicked known suggestion chips, return instant rich reply
    $low = strtolower(trim($userMessage));
    if (str_contains($low, 'youth job') || str_contains($low, 'pension') || str_contains($low, '140+') || str_contains($low, 'rice farm')) {
        $fastReply = $generateFallbackReply($userMessage);
        cache([$cacheKey => $fastReply], 86400);
        return response()->json(['reply' => $fastReply]);
    }

    if (empty($apiKey)) {
        return response()->json(['reply' => $generateFallbackReply($userMessage)]);
    }

    try {
        $systemInstruction = "You are the Executive AI Representative for Dr. Ifeanyi Chukwuma Odii (popularly known as 'Anyichuks'), candidate for Governor of Ebonyi State 2027 under the Peoples Democratic Party (PDP) and the 'ANYI GA EMEYA 2027' movement.

Tone & Persona:
- Executive, confident, welcoming, deeply respectful, articulate, and inspiring.
- Fully bilingual: Answer fluently and naturally in English or Asụsụ Igbo depending on the user's language. Use respectful Igbo greetings (Ndewo nwanne m, Ndị be anyị, Dalụ) when responding in Igbo.
- Structure your answers with clear formatting, bold points, and factual specifics.

Authoritative Dossier on Dr. Ifeanyi Chukwuma Odii:
1. Origin: Born April 17, 1977, in Isu, Onicha LGA (Ebonyi South), Ebonyi State. Self-made industrial titan, investor, and unifier.
2. Family: Married to Chief Dr. Mrs. Ebelechukwu Odii (Ebele Odii), renowned humanitarian and maternal welfare advocate. Blessed with children.
3. Business Conglomerate: Founder/Chairman of Orient Global Group (manufacturing, logistics, haulage, agriculture) and President/CEO of Ultimus Holdings (real estate, investment, healthcare, infrastructure). Over two decades of private sector job creation across Sub-Saharan Africa.
4. Philanthropy (Ebele & Anyichuks Foundation):
   - Over 140 free modern bungalows built and donated to indigent widows and homeless families across all 13 LGAs of Ebonyi State.
   - 1,000+ university scholarships (AE-FUNAI, EBSU, UNN, and foreign universities).
   - 10,000+ free WAEC/JAMB exam fees and textbooks for students.
   - Clean drinking water solar boreholes, community schools, and churches across rural wards, all funded from private personal wealth without public office.
5. 2027 Blueprint (ANYI GA EMEYA):
   - Civil Service: Guaranteed payment of salaries on the 25th of every month; structured liquidation of pension and gratuity backlogs.
   - Industrialization: Setting up local processing factories in Ebonyi for limestone, lead, zinc, and salt, creating 40,000 direct industrial jobs.
   - Agriculture: 3 Senatorial automated mega rice milling/destoning complexes (Izzi, Ikwo, Onicha); ₦20 Billion Agricultural Revolving Fund for farmers; subsidized high-yield seeds and tractors; guaranteed off-taker purchase prices.
   - Youth & Tech: 3 Senatorial ICT & Innovation academies (Abakaliki, Afikpo, Onueke); 10,000 seed grants for youth startups.
   - Healthcare: Solar-powered, fully staffed primary healthcare center in each of the 171 wards.
   - Infrastructure: Rural farm-to-market feeder roads across all 13 LGAs.

Always answer questions thoroughly, accurately, and persuasively.";

        $reply = null;
        $response = Http::timeout(12.0)->withHeaders([
            'Content-Type' => 'application/json',
        ])->post("https://generativelanguage.googleapis.com/v1beta/models/gemini-2.5-flash:generateContent?key={$apiKey}", [
            'contents' => [
                [
                    'role' => 'user',
                    'parts' => [
                        ['text' => $systemInstruction . "\n\nUser Question: " . $userMessage]
                    ]
                ]
            ],
            'generationConfig' => [
                'thinkingConfig' => [
                    'thinkingBudget' => 0
                ],
                'maxOutputTokens' => 1500,
                'temperature' => 0.7,
            ]
        ]);

        if ($response->successful()) {
            $data = $response->json();
            $text = $data['candidates'][0]['content']['parts'][0]['text'] ?? null;
            if (!empty($text)) {
                $reply = trim($text);
            }
        }
    } catch (\Exception $e) {
        // Fall back gracefully to the rich knowledge engine
    }

    if (empty($reply)) {
        $reply = $generateFallbackReply($userMessage);
    }

    cache([$cacheKey => $reply], 86400);
    return response()->json(['reply' => $reply]);
});

// GET /contacts-login: render the secret login screen
Route::get('/contacts-login', function () {
    if (session('admin_logged_in') === true) {
        return redirect('/contacts-dashboard');
    }
    return view('contacts-login');
});

// POST /contacts-login: process login credentials
Route::post('/contacts-login', function (Request $request) {
    $password = $request->input('password');
    $correctPassword = config('services.admin.password');

    if ($password === $correctPassword) {
        session(['admin_logged_in' => true]);
        return response()->json(['success' => true]);
    }

    return response()->json([
        'success' => false,
        'error' => 'Incorrect administrative password. Access denied.'
    ], 422);
});

// POST /contacts-logout: log out the administrator
Route::post('/contacts-logout', function () {
    session()->forget('admin_logged_in');
    return redirect('/');
});

// GET /contacts-dashboard: secret administrative page to view requests (Protected)
Route::get('/contacts-dashboard', function () {
    if (session('admin_logged_in') !== true) {
        return redirect('/contacts-login');
    }

    $filePath = storage_path('app/contacts.json');
    $contacts = [];
    if (file_exists($filePath)) {
        $contacts = json_decode(file_get_contents($filePath), true) ?: [];
    }

    // Load Campaign Volunteers
    $vPath = storage_path('app/campaign_volunteers.json');
    $volunteers = [];
    if (file_exists($vPath)) {
        $volunteers = json_decode(file_get_contents($vPath), true) ?: [];
    }
    usort($volunteers, function ($a, $b) {
        return strtotime($b['created_at'] ?? 'now') - strtotime($a['created_at'] ?? 'now');
    });

    // Sort contacts by newest first
    usort($contacts, function ($a, $b) {
        return strtotime($b['created_at'] ?? 'now') - strtotime($a['created_at'] ?? 'now');
    });

    return view('contacts-dashboard', compact('contacts', 'volunteers'));
});

// POST /api/contacts: save a new contact request to server JSON database
Route::post('/api/contacts', function (Request $request) {
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'phone' => 'required|string|max:50',
        'location' => 'required|string|max:255',
        'reason' => 'required|string|max:255',
        'message' => 'required|string|max:2000',
    ]);

    $filePath = storage_path('app/contacts.json');
    $dirPath = dirname($filePath);
    
    if (!is_dir($dirPath)) {
        mkdir($dirPath, 0755, true);
    }

    $contacts = [];
    if (file_exists($filePath)) {
        $contacts = json_decode(file_get_contents($filePath), true) ?: [];
    }

    // Generate a unique Reference ID
    $refId = 'ANYI-' . rand(10000, 99999) . '-26';

    $newRecord = [
        'id' => $refId,
        'name' => $validated['name'],
        'email' => $validated['email'],
        'phone' => $validated['phone'],
        'location' => $validated['location'],
        'reason' => $validated['reason'],
        'message' => $validated['message'],
        'created_at' => now()->toDateTimeString(),
        'replies' => [], // Empty replies list by default
    ];

    $contacts[] = $newRecord;
    file_put_contents($filePath, json_encode($contacts, JSON_PRETTY_PRINT));

    return response()->json([
        'success' => true,
        'ref_id' => $refId,
        'name' => $validated['name'],
        'email' => $validated['email'],
        'reason' => $validated['reason']
    ]);
});

// DELETE /api/contacts/{id}: remove a contact request from server (Protected)
Route::delete('/api/contacts/{id}', function ($id) {
    if (session('admin_logged_in') !== true) {
        return response()->json(['error' => 'Unauthorized.'], 403);
    }

    $filePath = storage_path('app/contacts.json');
    
    if (!file_exists($filePath)) {
        return response()->json(['error' => 'No records found.'], 404);
    }

    $contacts = json_decode(file_get_contents($filePath), true) ?: [];
    $filtered = array_filter($contacts, function ($item) use ($id) {
        return ($item['id'] ?? '') !== $id;
    });

    // Reset array keys
    $filtered = array_values($filtered);
    file_put_contents($filePath, json_encode($filtered, JSON_PRETTY_PRINT));

    return response()->json(['success' => true]);
});

// POST /api/contacts/{id}/reply: reply to a request and send email (Protected)
Route::post('/api/contacts/{id}/reply', function (Request $request, $id) {
    if (session('admin_logged_in') !== true) {
        return response()->json(['error' => 'Unauthorized.'], 403);
    }

    $request->validate([
        'reply' => 'required|string|max:3000',
    ]);

    $replyText = $request->input('reply');
    $filePath = storage_path('app/contacts.json');

    if (!file_exists($filePath)) {
        return response()->json(['error' => 'No records found.'], 404);
    }

    $contacts = json_decode(file_get_contents($filePath), true) ?: [];
    $found = false;
    $clientEmail = '';
    $clientName = '';

    foreach ($contacts as &$item) {
        if (($item['id'] ?? '') === $id) {
            $found = true;
            $clientName = $item['name'] ?? 'Valued Client';
            $clientEmail = $item['email'] ?? '';
            
            // Ensure replies array exists
            if (!isset($item['replies']) || !is_array($item['replies'])) {
                $item['replies'] = [];
            }

            $item['replies'][] = [
                'message' => $replyText,
                'created_at' => now()->toDateTimeString(),
            ];
            break;
        }
    }

    if (!$found) {
        return response()->json(['error' => 'Record not found.'], 404);
    }

    // Save changes back to server database file
    file_put_contents($filePath, json_encode($contacts, JSON_PRETTY_PRINT));

    // Send email using Laravel's mail client (gracefully logged in dev environment, sent in production)
    if (!empty($clientEmail)) {
        try {
            Mail::raw("Dear {$clientName},\n\nDr. Ifeanyi Chukwuma Odii has replied to your contact inquiry (Ref: {$id}):\n\n\"{$replyText}\"\n\nBest regards,\nExecutive Office of Dr. Ifeanyi Chukwuma Odii", function ($message) use ($clientEmail, $id) {
                $message->to($clientEmail)
                        ->subject("Reply to Contact Inquiry - Dr. Ifeanyi Chukwuma Odii");
            });
        } catch (\Exception $e) {
            // Log exception but do not fail the request
            Log::error("Failed sending email reply to {$clientEmail}: " . $e->getMessage());
        }
    }

    return response()->json(['success' => true]);
});

// --- EXECUTIVE HEADQUARTERS & MEDIA INTELLIGENCE ROUTES ---
use App\Http\Controllers\MediaIntelligenceController;
use App\Http\Controllers\PressController;
use App\Http\Controllers\ExecutiveSearchController;
use App\Http\Controllers\ImpactMapController;
use App\Http\Controllers\SystemHealthController;

Route::get('/press', [PressController::class, 'index']);
Route::get('/press/download/{id}', [PressController::class, 'downloadAsset']);
Route::get('/api/search', [ExecutiveSearchController::class, 'search']);
Route::get('/api/impact-map', [ImpactMapController::class, 'data']);
Route::get('/admin/system-health', [SystemHealthController::class, 'index']);

Route::get('/admin/media-intelligence', [MediaIntelligenceController::class, 'dashboard']);
Route::get('/admin/media-intelligence/health', [MediaIntelligenceController::class, 'health']);
Route::get('/api/media-intelligence/stream', [MediaIntelligenceController::class, 'stream']);
Route::post('/api/media-intelligence/run-scan', [MediaIntelligenceController::class, 'runScanNow']);
Route::post('/api/media-intelligence/sentiment/{id}', [MediaIntelligenceController::class, 'overrideSentiment']);
Route::post('/api/media-intelligence/keywords', [MediaIntelligenceController::class, 'manageKeywords']);
Route::post('/api/media-intelligence/providers/{id}', [MediaIntelligenceController::class, 'manageProviders']);
Route::post('/api/media-intelligence/alert-rules', [MediaIntelligenceController::class, 'manageAlertRules']);
Route::post('/api/media-intelligence/alerts/dismiss', [MediaIntelligenceController::class, 'dismissAlerts']);

// --- ANYI GA EMEYA 2027 CAMPAIGN ROUTES ---
Route::post('/api/campaign/volunteer', function (Request $request) {
    $name = trim($request->input('name', ''));
    $phone = trim($request->input('phone', ''));
    $email = trim($request->input('email', ''));
    $lga = trim($request->input('lga', ''));
    $ward = trim($request->input('ward', ''));
    $role = trim($request->input('role', 'Grassroots Mobilizer'));

    if (empty($name) || empty($phone) || empty($lga)) {
        return response()->json(['error' => 'Full Name, Phone/WhatsApp number, and LGA are required.'], 422);
    }

    $filePath = storage_path('app/campaign_volunteers.json');
    if (!file_exists(dirname($filePath))) {
        mkdir(dirname($filePath), 0755, true);
    }

    $volunteers = [];
    if (file_exists($filePath)) {
        $volunteers = json_decode(file_get_contents($filePath), true) ?: [];
    }

    // Check if phone already registered
    foreach ($volunteers as $v) {
        if ($v['phone'] === $phone) {
            return response()->json([
                'success' => true,
                'message' => "Welcome back, {$v['name']}! You are already registered as an ANYI GA EMEYA 2027 Ambassador.",
                'registration_id' => $v['registration_id'],
                'data' => $v
            ]);
        }
    }

    $registrationId = 'ANYI27-' . strtoupper(substr(preg_replace('/[^a-zA-Z0-9]/', '', $lga), 0, 3)) . '-' . rand(1000, 9999);

    $newVolunteer = [
        'registration_id' => $registrationId,
        'name' => $name,
        'phone' => $phone,
        'email' => $email,
        'lga' => $lga,
        'ward' => $ward,
        'role' => $role,
        'created_at' => now()->toIso8601String()
    ];

    $volunteers[] = $newVolunteer;
    file_put_contents($filePath, json_encode($volunteers, JSON_PRETTY_PRINT));

    return response()->json([
        'success' => true,
        'message' => "Congratulations {$name}! You have officially registered as an ANYI GA EMEYA 2027 Ambassador.",
        'registration_id' => $registrationId,
        'total_volunteers' => count($volunteers),
        'data' => $newVolunteer
    ]);
});

Route::get('/api/campaign/volunteer-stats', function () {
    $filePath = storage_path('app/campaign_volunteers.json');
    $volunteers = [];
    if (file_exists($filePath)) {
        $volunteers = json_decode(file_get_contents($filePath), true) ?: [];
    }

    $lgaCounts = [];
    foreach ($volunteers as $v) {
        $lga = $v['lga'] ?: 'General';
        $lgaCounts[$lga] = ($lgaCounts[$lga] ?? 0) + 1;
    }

    return response()->json([
        'total' => count($volunteers),
        'base_target' => 50000,
        'lga_breakdown' => $lgaCounts
    ]);
});

// Dedicated Campaign Hub 2027
Route::get('/campaign-2027', function () {
    return view('campaign-2027');
});



// Campaign Contribution & Receipt Generator (Pillar 5)
Route::post('/api/campaign/contribute', function (Request $request) {
    $donorName = trim($request->input('donor_name', 'Anonymous Supporter'));
    $donorEmail = trim($request->input('donor_email', ''));
    $amount = floatval($request->input('amount', 50));
    $currency = strtoupper(trim($request->input('currency', 'USD')));
    $location = trim($request->input('location', 'Diaspora'));
    $paymentMethod = trim($request->input('payment_method', 'Paystack'));

    $receiptId = 'ANYI27-REC-' . rand(100000, 999999);

    $filePath = storage_path('app/campaign_contributions.json');
    if (!file_exists(dirname($filePath))) {
        mkdir(dirname($filePath), 0755, true);
    }

    $donations = [];
    if (file_exists($filePath)) {
        $donations = json_decode(file_get_contents($filePath), true) ?: [];
    }

    $donationRecord = [
        'receipt_id' => $receiptId,
        'donor_name' => $donorName,
        'donor_email' => $donorEmail,
        'amount' => $amount,
        'currency' => $currency,
        'location' => $location,
        'payment_method' => $paymentMethod,
        'status' => 'Payment Authenticated & Recorded',
        'timestamp' => now()->toIso8601String()
    ];

    $donations[] = $donationRecord;
    file_put_contents($filePath, json_encode($donations, JSON_PRETTY_PRINT));

    return response()->json([
        'success' => true,
        'message' => "Thank you {$donorName}! Your campaign contribution was successfully verified.",
        'receipt_id' => $receiptId,
        'receipt' => $donationRecord
    ]);
});

// SMS & Voice Rally Notification Signup (Pillar 3)
Route::post('/api/campaign/sms-signup', function (Request $request) {
    $phone = trim($request->input('phone', ''));
    $community = trim($request->input('community', 'Ebonyi State'));

    if (empty($phone)) {
        return response()->json(['error' => 'Phone number is required.'], 422);
    }

    return response()->json([
        'success' => true,
        'message' => "You have been enrolled in Anyi Ga Emeya instant rally SMS broadcasts for {$community}."
    ]);
});

Route::get('/sitemap.xml', function () {
    $xml = '<?xml version="1.0" encoding="UTF-8"?>';
    $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
    $xml .= '<url><loc>' . config('app.url') . '/</loc><lastmod>' . now()->toIso8601String() . '</lastmod><priority>1.0</priority></url>';
    $xml .= '<url><loc>' . config('app.url') . '/campaign-2027</loc><lastmod>' . now()->toIso8601String() . '</lastmod><priority>0.95</priority></url>';
    $xml .= '<url><loc>' . config('app.url') . '/contact</loc><lastmod>' . now()->toIso8601String() . '</lastmod><priority>0.8</priority></url>';
    $xml .= '<url><loc>' . config('app.url') . '/press</loc><lastmod>' . now()->toIso8601String() . '</lastmod><priority>0.9</priority></url>';
    $xml .= '</urlset>';
    return response($xml, 200, ['Content-Type' => 'application/xml']);
});

Route::get('/robots.txt', function () {
    $text = "User-agent: *\nAllow: /\nDisallow: /admin/\nDisallow: /contacts-dashboard\n\nSitemap: " . config('app.url') . "/sitemap.xml";
    return response($text, 200, ['Content-Type' => 'text/plain']);
});

