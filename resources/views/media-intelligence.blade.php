<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Media Intelligence - Ifeanyi Chukwuma Odii</title>
    <link rel="icon" type="image/jpeg" href="{{ asset('images/favicon.jpg') }}">
    
    <!-- Vite Assets or Tailwind CDN Fallback -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <script src="https://cdn.tailwindcss.com"></script>
    @endif

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <!-- ApexCharts CDN for Premium Interactive Charts -->
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

    <style>
        body {
            font-family: 'Inter', sans-serif;
        }

        /* Custom Scrollbars */
        ::-webkit-scrollbar {
            width: 6px;
            height: 6px;
        }
        ::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.02);
            border-radius: 10px;
        }
        ::-webkit-scrollbar-thumb {
            background: rgba(251, 191, 36, 0.3);
            border-radius: 10px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: rgba(251, 191, 36, 0.5);
        }

        /* Real-time Toast Entry Animation */
        .toast-enter {
            animation: slideInRight 0.35s cubic-bezier(0.175, 0.885, 0.32, 1.275) forwards;
        }
        @keyframes slideInRight {
            0% { transform: translateX(100%); opacity: 0; }
            100% { transform: translateX(0); opacity: 1; }
        }

        /* Live Alert Pulse Glow */
        .mention-glow {
            animation: glowPulse 2s infinite alternate;
        }
        @keyframes glowPulse {
            0% { border-color: rgba(251, 191, 36, 0.3); box-shadow: 0 0 5px rgba(251, 191, 36, 0.1); }
            100% { border-color: rgba(251, 191, 36, 0.8); box-shadow: 0 0 20px rgba(251, 191, 36, 0.4); }
        }

    </style>
</head>

<body class="antialiased text-white min-h-screen relative flex flex-col justify-between"
    style="background-image: url('{{ asset('images/landing-profile.png') }}'); background-size: cover; background-position: center; background-attachment: fixed;">

    <!-- Blur overlay for readability -->
    <div class="absolute inset-0 bg-black/75 backdrop-blur-md z-0"></div>

    <!-- Toast Notifications Container -->
    <div id="toast-container" class="fixed top-6 right-6 z-50 flex flex-col gap-3 max-w-sm w-full"></div>

    <!-- Navigation Header -->
    <header class="relative z-10 w-full bg-black/40 border-b border-white/10 px-6 lg:px-12 py-4">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <!-- Home & Section Switcher -->
            <div class="flex items-center gap-6">
                <a href="/" class="flex items-center gap-2 group text-gray-300 hover:text-amber-400 font-semibold text-sm transition-all duration-200">
                    <svg class="w-4 h-4 transform group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                    </svg>
                    Main Website
                </a>
                <span class="text-white/20">|</span>
                <nav class="hidden md:flex items-center gap-6 text-sm">
                    <a href="/contacts-dashboard" class="text-gray-400 hover:text-white font-medium transition-colors">Contact Inquiries</a>
                    <a href="/admin/media-intelligence" class="text-amber-400 border-b-2 border-amber-400 pb-1 font-bold">Media Intelligence</a>
                    <a href="/admin/media-intelligence/health" class="text-gray-400 hover:text-white font-medium transition-colors">System Health</a>
                </nav>
            </div>

            <!-- Brand Logo -->
            <a href="/" class="text-md font-bold tracking-wider text-white uppercase select-none hidden lg:block">
                ANYI GA EMEYA <span class="text-amber-400">2027</span>
            </a>

            <!-- Admin Controls -->
            <div class="flex items-center gap-4">
                <button onclick="triggerImmediateScan()" class="flex items-center gap-1.5 text-xs font-semibold text-black bg-amber-400 hover:bg-amber-300 px-4 py-2 rounded-xl transition-all shadow-md active:scale-95">
                    <svg id="scan-btn-icon" class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 4v5h.582m15.356 2A8.001 8.001 0 1121.21 8H17" />
                    </svg>
                    <span id="scan-btn-text">Run Scan Now</span>
                </button>
                <form action="/contacts-logout" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="text-xs font-semibold text-gray-300 hover:text-red-400 bg-white/5 hover:bg-white/10 px-4 py-2 rounded-xl border border-white/10 transition-all">
                        Sign Out
                    </button>
                </form>
            </div>
        </div>
    </header>

    <!-- Mobile Nav Bar -->
    <div class="relative z-10 md:hidden bg-black/60 border-b border-white/10 px-6 py-3 flex justify-around text-xs">
        <a href="/contacts-dashboard" class="text-gray-400 hover:text-white font-medium">Contact Inquiries</a>
        <a href="/admin/media-intelligence" class="text-amber-400 font-bold">Media Intelligence</a>
        <a href="/admin/media-intelligence/health" class="text-gray-400 hover:text-white font-medium">System Health</a>
    </div>

    <!-- Main Container -->
    <main class="relative z-10 flex-grow w-full max-w-7xl mx-auto px-4 md:px-8 lg:px-12 py-8">
        
        <!-- Welcome Title & Badges -->
        <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center gap-4 pb-6 mb-8 border-b border-white/10">
            <div>
                <span class="text-xs font-bold tracking-widest text-amber-400 uppercase block">Media Intelligence Console</span>
                <h1 class="text-2xl md:text-3xl font-extrabold text-white mt-1">Mention & Reputation Dashboard</h1>
                <p class="text-xs text-gray-400 mt-1">Near-real-time monitoring, with alerts triggered as soon as configured sources make new content available.</p>
            </div>

            <!-- Configuration Modals Buttons -->
            <div class="flex flex-wrap gap-2">
                <button onclick="openModal('keywords-modal')" class="bg-white/5 hover:bg-white/10 border border-white/10 text-xs font-medium px-4 py-2.5 rounded-xl transition-all">
                    Configure Keywords
                </button>
                <button onclick="openModal('providers-modal')" class="bg-white/5 hover:bg-white/10 border border-white/10 text-xs font-medium px-4 py-2.5 rounded-xl transition-all">
                    Sync Providers
                </button>
                <button onclick="openModal('alert-rules-modal')" class="bg-white/5 hover:bg-white/10 border border-white/10 text-xs font-medium px-4 py-2.5 rounded-xl transition-all">
                    Alert Rules
                </button>
            </div>
        </div>

        <!-- Metric Cards -->
        <div class="grid grid-cols-2 lg:grid-cols-5 gap-4 mb-8">
            <div class="bg-black/35 backdrop-blur-xl border border-white/10 rounded-2xl p-4">
                <span class="text-[10px] uppercase font-bold text-gray-400 tracking-wider">Total Mentions</span>
                <h3 id="stat-total" class="text-2xl font-extrabold text-white mt-1">{{ $totalCount }}</h3>
            </div>
            <div class="bg-black/35 backdrop-blur-xl border border-white/10 rounded-2xl p-4">
                <span class="text-[10px] uppercase font-bold text-emerald-400 tracking-wider">Positive</span>
                <h3 id="stat-positive" class="text-2xl font-extrabold text-emerald-400 mt-1">
                    {{ $positiveCount }} <span class="text-xs text-gray-400 font-light">({{ $totalCount > 0 ? round(($positiveCount / $totalCount) * 100) : 0 }}%)</span>
                </h3>
            </div>
            <div class="bg-black/35 backdrop-blur-xl border border-white/10 rounded-2xl p-4">
                <span class="text-[10px] uppercase font-bold text-rose-400 tracking-wider">Negative</span>
                <h3 id="stat-negative" class="text-2xl font-extrabold text-rose-400 mt-1">
                    {{ $negativeCount }} <span class="text-xs text-gray-400 font-light">({{ $totalCount > 0 ? round(($negativeCount / $totalCount) * 100) : 0 }}%)</span>
                </h3>
            </div>
            <div class="bg-black/35 backdrop-blur-xl border border-white/10 rounded-2xl p-4">
                <span class="text-[10px] uppercase font-bold text-amber-400 tracking-wider">Mixed / Neutral</span>
                <h3 id="stat-neutral-mixed" class="text-2xl font-extrabold text-amber-400 mt-1">
                    {{ $neutralCount + $mixedCount }}
                </h3>
            </div>
            <div class="bg-black/35 backdrop-blur-xl border border-white/10 rounded-2xl p-4 col-span-2 lg:col-span-1">
                <span class="text-[10px] uppercase font-bold text-cyan-400 tracking-wider">Active Alerts</span>
                <h3 id="stat-alerts" class="text-2xl font-extrabold text-cyan-400 mt-1">
                    {{ $unreadAlerts->count() }} <span class="text-xs text-gray-400 font-light">unread</span>
                </h3>
            </div>
        </div>

        <!-- Analytics Charts Panel -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
            <!-- Mentions Over Time -->
            <div class="bg-black/35 backdrop-blur-xl border border-white/10 rounded-2xl p-5 lg:col-span-2 shadow-2xl">
                <h3 class="text-sm font-bold text-white tracking-wider uppercase mb-4">Mentions & Sentiment Trends</h3>
                <div id="chart-timeline" class="w-full h-64"></div>
            </div>

            <!-- Sentiment Distribution -->
            <div class="bg-black/35 backdrop-blur-xl border border-white/10 rounded-2xl p-5 shadow-2xl flex flex-col justify-between">
                <h3 class="text-sm font-bold text-white tracking-wider uppercase mb-4">Sentiment Distribution</h3>
                <div id="chart-sentiment" class="w-full flex justify-center py-4"></div>
                <div class="text-[10px] text-gray-400 text-center italic mt-2 border-t border-white/5 pt-2">
                    Automated sentiment assessment
                </div>
            </div>
        </div>

        <!-- Search, Filter & Mentions Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
            
            <!-- Filters Sidebar -->
            <div class="bg-black/35 backdrop-blur-xl border border-white/10 rounded-2xl p-5 h-fit shadow-2xl space-y-6">
                <div class="flex justify-between items-center pb-3 border-b border-white/5">
                    <h3 class="text-xs font-bold text-white uppercase tracking-wider">Filters</h3>
                    <a href="/admin/media-intelligence" class="text-[10px] text-amber-400 hover:underline">Reset Filters</a>
                </div>

                <form action="/admin/media-intelligence" method="GET" class="space-y-4">
                    <!-- Search input -->
                    <div class="flex flex-col gap-1.5">
                        <label class="text-[10px] font-bold text-gray-400 uppercase tracking-wider">Search Keywords</label>
                        <input type="text" name="q" value="{{ request('q') }}" placeholder="Search title or text..."
                            class="bg-white/5 border border-white/10 rounded-xl px-3 py-2 text-xs text-white placeholder-gray-500 focus:outline-none focus:border-amber-400/40 w-full">
                    </div>

                    <!-- Date Range -->
                    <div class="flex flex-col gap-1.5">
                        <label class="text-[10px] font-bold text-gray-400 uppercase tracking-wider">Date Window</label>
                        <select name="date_range" onchange="toggleCustomDates(this.value)"
                            class="bg-neutral-900 border border-white/10 rounded-xl px-3 py-2 text-xs text-white focus:outline-none focus:border-amber-400/40 w-full">
                            <option value="today" {{ $dateFilter === 'today' ? 'selected' : '' }}>Today</option>
                            <option value="last_24_hours" {{ $dateFilter === 'last_24_hours' ? 'selected' : '' }}>Last 24 Hours</option>
                            <option value="last_7_days" {{ $dateFilter === 'last_7_days' ? 'selected' : '' }}>Last 7 Days</option>
                            <option value="last_30_days" {{ $dateFilter === 'last_30_days' ? 'selected' : '' }}>Last 30 Days</option>
                            <option value="custom" {{ $dateFilter === 'custom' ? 'selected' : '' }}>Custom dates</option>
                        </select>
                    </div>

                    <!-- Custom dates -->
                    <div id="custom-dates-inputs" class="space-y-2 {{ $dateFilter === 'custom' ? '' : 'hidden' }}">
                        <div class="flex flex-col gap-1">
                            <span class="text-[9px] text-gray-400 uppercase">From</span>
                            <input type="date" name="start_date" value="{{ request('start_date') }}"
                                class="bg-neutral-900 border border-white/10 rounded-xl px-3 py-1.5 text-xs text-white focus:outline-none focus:border-amber-400/40 w-full">
                        </div>
                        <div class="flex flex-col gap-1">
                            <span class="text-[9px] text-gray-400 uppercase">To</span>
                            <input type="date" name="end_date" value="{{ request('end_date') }}"
                                class="bg-neutral-900 border border-white/10 rounded-xl px-3 py-1.5 text-xs text-white focus:outline-none focus:border-amber-400/40 w-full">
                        </div>
                    </div>

                    <!-- Sentiment -->
                    <div class="flex flex-col gap-1.5">
                        <label class="text-[10px] font-bold text-gray-400 uppercase tracking-wider">Sentiment</label>
                        <select name="sentiment"
                            class="bg-neutral-900 border border-white/10 rounded-xl px-3 py-2 text-xs text-white focus:outline-none focus:border-amber-400/40 w-full">
                            <option value="">All Sentiments</option>
                            <option value="positive" {{ request('sentiment') === 'positive' ? 'selected' : '' }}>Positive</option>
                            <option value="neutral" {{ request('sentiment') === 'neutral' ? 'selected' : '' }}>Neutral</option>
                            <option value="negative" {{ request('sentiment') === 'negative' ? 'selected' : '' }}>Negative</option>
                            <option value="mixed" {{ request('sentiment') === 'mixed' ? 'selected' : '' }}>Mixed</option>
                        </select>
                    </div>

                    <!-- Category -->
                    <div class="flex flex-col gap-1.5">
                        <label class="text-[10px] font-bold text-gray-400 uppercase tracking-wider">Category</label>
                        <select name="category"
                            class="bg-neutral-900 border border-white/10 rounded-xl px-3 py-2 text-xs text-white focus:outline-none focus:border-amber-400/40 w-full">
                            <option value="">All Categories</option>
                            <option value="Politics" {{ request('category') === 'Politics' ? 'selected' : '' }}>Politics</option>
                            <option value="Campaign" {{ request('category') === 'Campaign' ? 'selected' : '' }}>Campaign</option>
                            <option value="Elections" {{ request('category') === 'Elections' ? 'selected' : '' }}>Elections</option>
                            <option value="Philanthropy" {{ request('category') === 'Philanthropy' ? 'selected' : '' }}>Philanthropy</option>
                            <option value="Business" {{ request('category') === 'Business' ? 'selected' : '' }}>Business</option>
                            <option value="Public Statement" {{ request('category') === 'Public Statement' ? 'selected' : '' }}>Public Statement</option>
                            <option value="Other" {{ request('category') === 'Other' ? 'selected' : '' }}>Other</option>
                        </select>
                    </div>

                    <!-- Tracked Keyword -->
                    <div class="flex flex-col gap-1.5">
                        <label class="text-[10px] font-bold text-gray-400 uppercase tracking-wider">Matched Keyword</label>
                        <select name="keyword"
                            class="bg-neutral-900 border border-white/10 rounded-xl px-3 py-2 text-xs text-white focus:outline-none focus:border-amber-400/40 w-full">
                            <option value="">All Keywords</option>
                            @foreach($allKeywords as $kw)
                                <option value="{{ $kw->keyword }}" {{ request('keyword') === $kw->keyword ? 'selected' : '' }}>{{ $kw->keyword }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Source Publisher -->
                    <div class="flex flex-col gap-1.5">
                        <label class="text-[10px] font-bold text-gray-400 uppercase tracking-wider">Publisher</label>
                        <select name="source"
                            class="bg-neutral-900 border border-white/10 rounded-xl px-3 py-2 text-xs text-white focus:outline-none focus:border-amber-400/40 w-full">
                            <option value="">All Publishers</option>
                            @foreach($allSources as $src)
                                <option value="{{ $src->id }}" {{ request('source') == $src->id ? 'selected' : '' }}>{{ $src->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Options Toggle -->
                    <div class="flex items-center gap-2 pt-2">
                        <input type="checkbox" name="show_all" id="show_all" value="1" {{ request('show_all') ? 'checked' : '' }}
                            class="rounded bg-white/5 border border-white/10 text-amber-400 focus:ring-0">
                        <label for="show_all" class="text-[10px] text-gray-300 font-medium">Show Rejected / Uncertain</label>
                    </div>

                    <button type="submit" class="w-full py-2.5 bg-amber-400 hover:bg-amber-300 text-black font-bold uppercase rounded-xl text-[10px] tracking-wider transition-colors">
                        Apply Filters
                    </button>
                </form>
            </div>

            <!-- Mentions Feed List -->
            <div class="lg:col-span-3 space-y-6">
                
                <!-- Section Header -->
                <div class="flex justify-between items-center pb-2 border-b border-white/10">
                    <h3 class="text-sm font-bold text-white tracking-wider uppercase">Live Mentions Feed</h3>
                    <div class="text-[10px] text-gray-400">Showing {{ $mentions->firstItem() ?? 0 }}-{{ $mentions->lastItem() ?? 0 }} of {{ $mentions->total() }} matches</div>
                </div>

                @if($mentions->isEmpty())
                    <!-- Empty State -->
                    <div class="bg-black/35 backdrop-blur-xl border border-white/10 rounded-2xl p-12 text-center shadow-2xl">
                        <div class="w-12 h-12 rounded-full bg-white/5 border border-white/10 flex items-center justify-center mx-auto mb-4">
                            <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                        <h4 class="text-base font-bold text-white">No Mentions Found</h4>
                        <p class="text-xs text-gray-400 max-w-xs mx-auto mt-1 leading-relaxed">
                            No records match your filters. Try adjusting dates, clearing the query, or triggering a manual sync scan.
                        </p>
                    </div>
                @else
                    <div id="mentions-feed-container" class="space-y-4">
                        @foreach($mentions as $mention)
                            <!-- Mention Card -->
                            <div id="mention-{{ $mention->id }}" 
                                class="bg-black/35 backdrop-blur-xl border border-white/10 hover:border-amber-400/30 rounded-2xl p-5 shadow-2xl transition-all duration-300 relative group flex flex-col md:flex-row gap-5 justify-between">
                                
                                <!-- Left side: logo and source metadata -->
                                <div class="flex items-start gap-4 md:w-3/4">
                                    <img src="{{ $mention->source->logo_url ?: 'https://www.google.com/s2/favicons?domain=' . ($mention->source->domain ?? 'myprimetech.live') . '&sz=64' }}" 
                                        alt="{{ $mention->source->name }}" class="w-10 h-10 rounded-xl bg-white/5 border border-white/10 p-1 object-contain shrink-0">
                                    
                                    <div class="space-y-1.5">
                                        <div class="flex flex-wrap items-center gap-2">
                                            <span class="text-[10px] font-bold text-amber-400 uppercase tracking-wider">{{ $mention->source->name }}</span>
                                            <span class="text-[9px] text-gray-500">•</span>
                                            <span class="text-[9px] text-gray-400">Published: {{ $mention->published_at->format('d M, h:i A') }}</span>
                                            <span class="text-[9px] text-gray-500">•</span>
                                            <span class="text-[9px] text-gray-400">Detected: {{ $mention->detected_at->diffForHumans() }}</span>
                                        </div>

                                        <h3 class="text-sm font-bold text-white group-hover:text-amber-400 transition-colors leading-snug">
                                            <a href="{{ $mention->url }}" target="_blank" class="flex items-center gap-1">
                                                {{ $mention->title }}
                                                <svg class="w-3.5 h-3.5 inline text-gray-500 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                                                </svg>
                                            </a>
                                        </h3>

                                        <p class="text-xs text-gray-300 leading-relaxed font-light">{{ $mention->description }}</p>

                                        <!-- Meta Badges row -->
                                        <div class="flex flex-wrap items-center gap-2.5 pt-2">
                                            <span class="text-[9px] font-bold uppercase tracking-wider bg-white/5 border border-white/10 text-gray-300 px-2.5 py-0.5 rounded-full">
                                                Keyword: <span class="text-amber-400">{{ $mention->matched_keyword }}</span>
                                            </span>
                                            <span class="text-[9px] font-bold uppercase tracking-wider bg-indigo-500/10 border border-indigo-500/20 text-indigo-400 px-2.5 py-0.5 rounded-full">
                                                {{ $mention->category }}
                                            </span>
                                            
                                            <!-- Importance Tag -->
                                            @php
                                                $importanceColors = [
                                                    'breaking' => 'bg-rose-500/20 border-rose-500/40 text-rose-400',
                                                    'high' => 'bg-orange-500/20 border-orange-500/30 text-orange-400',
                                                    'medium' => 'bg-amber-500/10 border-amber-500/20 text-amber-300',
                                                    'low' => 'bg-gray-500/10 border-gray-500/20 text-gray-400',
                                                ];
                                                $importanceColor = $importanceColors[strtolower($mention->importance)] ?? $importanceColors['low'];
                                            @endphp
                                            <span class="text-[9px] font-bold uppercase tracking-wider px-2.5 py-0.5 rounded-full border {{ $importanceColor }}">
                                                {{ $mention->importance }}
                                            </span>

                                            <!-- AI Confidence -->
                                            <span class="text-[9px] text-gray-400">
                                                AI Confidence: <span class="font-bold text-amber-400/80">{{ round($mention->confidence_score * 100) }}%</span>
                                            </span>

                                            @if(!$mention->entity_confirmed)
                                                <span class="text-[9px] font-bold uppercase tracking-wider bg-red-600/10 border border-red-500/30 text-red-400 px-2.5 py-0.5 rounded-full select-none"
                                                    title="{{ $mention->rejection_reason }}">
                                                    Uncertain Match
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <!-- Right side: interactive sentiment override -->
                                <div class="flex flex-row md:flex-col justify-between items-end gap-3 shrink-0 border-t md:border-t-0 border-white/5 pt-3 md:pt-0">
                                    <div class="space-y-1 w-full text-left md:text-right">
                                        <span class="text-[9px] text-gray-400 uppercase tracking-wider block">Sentiment assessment</span>
                                        
                                        <!-- Sentiment selector trigger -->
                                        <div class="relative inline-block text-left">
                                            @php
                                                $sentimentColors = [
                                                    'positive' => 'bg-emerald-500/10 border-emerald-500/30 text-emerald-400',
                                                    'negative' => 'bg-rose-500/10 border-rose-500/30 text-rose-400',
                                                    'neutral' => 'bg-blue-500/10 border-blue-500/30 text-blue-400',
                                                    'mixed' => 'bg-yellow-500/10 border-yellow-500/30 text-yellow-400',
                                                ];
                                                $sentimentColor = $sentimentColors[strtolower($mention->sentiment)] ?? $sentimentColors['neutral'];
                                            @endphp
                                            <select onchange="overrideSentiment('{{ $mention->id }}', this.value)"
                                                class="text-xs font-bold uppercase tracking-wider px-3 py-1.5 rounded-xl border {{ $sentimentColor }} bg-neutral-900/90 cursor-pointer focus:outline-none w-fit">
                                                <option value="positive" {{ strtolower($mention->sentiment) === 'positive' ? 'selected' : '' }}>Positive</option>
                                                <option value="neutral" {{ strtolower($mention->sentiment) === 'neutral' ? 'selected' : '' }}>Neutral</option>
                                                <option value="negative" {{ strtolower($mention->sentiment) === 'negative' ? 'selected' : '' }}>Negative</option>
                                                <option value="mixed" {{ strtolower($mention->sentiment) === 'mixed' ? 'selected' : '' }}>Mixed</option>
                                            </select>
                                        </div>
                                    </div>

                                    <!-- Group duplicates status -->
                                    @if($mention->cluster && $mention->cluster->mentions_count > 1)
                                        <span class="text-[9px] font-semibold text-amber-400 bg-amber-400/10 border border-amber-400/20 px-2 py-0.5 rounded-full select-none shrink-0"
                                            title="Clustered coverage count">
                                            {{ $mention->cluster->mentions_count }} syndicated sources
                                        </span>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Pagination -->
                    <div class="pt-4">
                        {{ $mentions->links() }}
                    </div>
                @endif

                <!-- Story Clusters Table -->
                <div class="bg-black/35 backdrop-blur-xl border border-white/10 rounded-2xl p-5 shadow-2xl mt-8">
                    <h3 class="text-sm font-bold text-white tracking-wider uppercase mb-4 pb-2 border-b border-white/5">Identical Coverage & Story Clusters</h3>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="text-[9px] uppercase tracking-wider text-gray-400 border-b border-white/10">
                                    <th class="pb-3 font-semibold">Cluster Topic</th>
                                    <th class="pb-3 font-semibold">Syndications</th>
                                    <th class="pb-3 font-semibold">Overall Sentiment</th>
                                    <th class="pb-3 font-semibold">First Detected</th>
                                    <th class="pb-3 font-semibold">Latest Update</th>
                                </tr>
                            </thead>
                            <tbody class="text-xs font-light divide-y divide-white/5">
                                @forelse($storyClusters as $cluster)
                                    <tr>
                                        <td class="py-3.5 font-semibold text-white max-w-sm truncate pr-4">{{ $cluster->title }}</td>
                                        <td class="py-3.5">
                                            <span class="bg-white/5 border border-white/10 text-gray-300 px-2 py-0.5 rounded-full font-bold">
                                                {{ $cluster->mentions_count }} sources
                                            </span>
                                        </td>
                                        <td class="py-3.5">
                                            <span class="uppercase text-[9px] font-bold text-amber-400">{{ $cluster->overall_sentiment }}</span>
                                        </td>
                                        <td class="py-3.5 text-gray-400">{{ $cluster->first_detected_at->format('d M, h:i A') }}</td>
                                        <td class="py-3.5 text-gray-400">{{ $cluster->last_updated_at->diffForHumans() }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="py-4 text-center text-gray-500 italic">No story clusters found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>

    </main>

    <!-- Modal 1: KEYWORDS MANAGER -->
    <div id="keywords-modal" class="hidden fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/80 backdrop-blur-md">
        <div class="w-full max-w-lg bg-neutral-950 border border-white/10 rounded-3xl p-6 shadow-2xl relative">
            <div class="flex justify-between items-center border-b border-white/10 pb-4 mb-5">
                <h3 class="text-sm font-bold text-white tracking-wider uppercase">Monitored Keywords & Aliases</h3>
                <button onclick="closeModal('keywords-modal')" class="text-gray-500 hover:text-white transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <!-- List of existing keywords -->
            <div class="max-h-60 overflow-y-auto mb-4 border border-white/5 rounded-2xl p-3 bg-black/40 space-y-2">
                @foreach($allKeywords as $kw)
                    <div class="flex justify-between items-center bg-white/5 border border-white/5 rounded-xl px-3.5 py-2 text-xs">
                        <span class="font-medium {{ $kw->is_active ? 'text-white' : 'text-gray-500 line-through' }}">{{ $kw->keyword }}</span>
                        
                        <div class="flex items-center gap-2">
                            <!-- Toggle Active switch -->
                            <button onclick="toggleKeyword('{{ $kw->id }}')" 
                                class="px-2.5 py-1 {{ $kw->is_active ? 'bg-amber-400/10 text-amber-400 border-amber-400/20' : 'bg-white/5 text-gray-400 border-white/10' }} border rounded-lg font-bold text-[9px] uppercase tracking-wider transition-all select-none">
                                {{ $kw->is_active ? 'Active' : 'Paused' }}
                            </button>
                            <!-- Delete Button -->
                            <button onclick="deleteKeyword('{{ $kw->id }}')" class="text-gray-500 hover:text-red-400 transition-colors">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                            </button>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Add new keyword input -->
            <form id="new-keyword-form" onsubmit="addKeyword(event)" class="space-y-3 pt-2 border-t border-white/5">
                <div class="flex flex-col gap-1.5">
                    <label for="new-keyword-input" class="text-[10px] font-bold text-amber-400 uppercase tracking-wider">Add Monitored Keyword</label>
                    <div class="flex gap-2">
                        <input type="text" id="new-keyword-input" required placeholder="e.g. Ebonyi governor polls"
                            class="bg-white/5 border border-white/10 rounded-xl px-4 py-2.5 text-xs text-white placeholder-gray-500 focus:outline-none focus:border-amber-400/40 flex-grow">
                        <button type="submit" class="bg-amber-400 hover:bg-amber-300 text-black font-bold uppercase text-[10px] px-5 py-2.5 rounded-xl transition-all">
                            Add
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal 2: PROVIDERS CONFIGURATION -->
    <div id="providers-modal" class="hidden fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/80 backdrop-blur-md">
        <div class="w-full max-w-lg bg-neutral-950 border border-white/10 rounded-3xl p-6 shadow-2xl relative">
            <div class="flex justify-between items-center border-b border-white/10 pb-4 mb-5">
                <h3 class="text-sm font-bold text-white tracking-wider uppercase">Sync Providers Configuration</h3>
                <button onclick="closeModal('providers-modal')" class="text-gray-500 hover:text-white transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <!-- Providers list -->
            <div class="space-y-3 max-h-96 overflow-y-auto pr-1">
                @php
                    $activeProviders = \App\Models\MonitoringProvider::all();
                @endphp
                @foreach($activeProviders as $provider)
                    <div class="bg-white/5 border border-white/5 rounded-2xl p-4 space-y-3">
                        <div class="flex justify-between items-center">
                            <div>
                                <h4 class="text-xs font-bold text-white">{{ $provider->name }}</h4>
                                <span class="text-[9px] text-gray-400 uppercase">Type: {{ $provider->type }} • Polling Interval: {{ round($provider->polling_interval / 60) }}m</span>
                            </div>

                            <button onclick="toggleProvider('{{ $provider->id }}')"
                                class="px-2.5 py-1 {{ $provider->is_enabled ? 'bg-emerald-500/10 text-emerald-400 border-emerald-500/20' : 'bg-white/5 text-gray-400 border-white/10' }} border rounded-lg font-bold text-[9px] uppercase tracking-wider transition-all select-none">
                                {{ $provider->is_enabled ? 'Enabled' : 'Disabled' }}
                            </button>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Modal 3: ALERT RULES -->
    <div id="alert-rules-modal" class="hidden fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/80 backdrop-blur-md">
        <div class="w-full max-w-lg bg-neutral-950 border border-white/10 rounded-3xl p-6 shadow-2xl relative">
            <div class="flex justify-between items-center border-b border-white/10 pb-4 mb-5">
                <h3 class="text-sm font-bold text-white tracking-wider uppercase">Reputation Alert Rules</h3>
                <button onclick="closeModal('alert-rules-modal')" class="text-gray-500 hover:text-white transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <!-- Rules list -->
            <div class="space-y-3">
                @php
                    $alertRules = \App\Models\AlertRule::all();
                @endphp
                @foreach($alertRules as $rule)
                    <div class="flex justify-between items-center bg-white/5 border border-white/5 rounded-2xl p-4">
                        <div>
                            <h4 class="text-xs font-bold text-white">{{ $rule->name }}</h4>
                            <span class="text-[9px] text-gray-400 uppercase">Channels: {{ implode(', ', $rule->channels) }}</span>
                        </div>

                        <button onclick="toggleAlertRule('{{ $rule->id }}')"
                            class="px-2.5 py-1 {{ $rule->is_active ? 'bg-amber-400/10 text-amber-400 border-amber-400/20' : 'bg-white/5 text-gray-400 border-white/10' }} border rounded-lg font-bold text-[9px] uppercase tracking-wider transition-all select-none">
                            {{ $rule->is_active ? 'Active' : 'Paused' }}
                        </button>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Footer Area -->
    <footer class="relative z-10 w-full text-center py-6 border-t border-white/10 bg-black/40 text-xs text-gray-400 shrink-0">
        <p>© 2026 Dr. Ifeanyi Chukwuma Odii. Media Intelligence Platform.</p>
    </footer>

    <!-- Interactive Scripts -->
    <script>
        // --- TIMELINE TRENDS CHART ---
        const timelineCategories = {!! json_encode($mentionsOverTime->keys()->toArray()) !!};
        const totalSeries = {!! json_encode($mentionsOverTime->pluck('total')->toArray()) !!};
        const positiveSeries = {!! json_encode($mentionsOverTime->pluck('positive')->toArray()) !!};
        const negativeSeries = {!! json_encode($mentionsOverTime->pluck('negative')->toArray()) !!};

        const timelineOptions = {
            chart: {
                type: 'area',
                height: 250,
                background: 'transparent',
                foreColor: '#9ca3af',
                toolbar: { show: false }
            },
            stroke: { curve: 'smooth', width: 2 },
            fill: {
                type: 'gradient',
                gradient: {
                    shadeIntensity: 1,
                    opacityFrom: 0.35,
                    opacityTo: 0.05,
                    stops: [0, 90, 100]
                }
            },
            series: [
                { name: 'Total Mentions', data: totalSeries, color: '#f59e0b' },
                { name: 'Positive Sentiment', data: positiveSeries, color: '#10b981' },
                { name: 'Negative Sentiment', data: negativeSeries, color: '#f43f5e' }
            ],
            xaxis: {
                categories: timelineCategories,
                labels: { rotate: -30, style: { fontSize: '10px' } }
            },
            yaxis: { title: { text: 'Count', style: { fontSize: '10px' } } },
            grid: { borderColor: 'rgba(255, 255, 255, 0.05)' },
            legend: { position: 'top', horizontalAlign: 'right', fontSize: '11px' },
            tooltip: { theme: 'dark' }
        };
        const timelineChart = new ApexCharts(document.querySelector("#chart-timeline"), timelineOptions);
        timelineChart.render();

        // --- SENTIMENT DONUT CHART ---
        const sentimentLabels = ['Positive', 'Negative', 'Neutral', 'Mixed'];
        const sentimentSeries = [
            {{ $positiveCount }},
            {{ $negativeCount }},
            {{ $neutralCount }},
            {{ $mixedCount }}
        ];

        const sentimentOptions = {
            chart: {
                type: 'donut',
                width: 320,
                background: 'transparent',
                foreColor: '#9ca3af',
            },
            labels: sentimentLabels,
            series: sentimentSeries,
            colors: ['#10b981', '#f43f5e', '#3b82f6', '#eab308'],
            stroke: { show: false },
            legend: { position: 'bottom', fontSize: '11px' },
            dataLabels: { enabled: true, style: { fontSize: '10px' } },
            plotOptions: {
                pie: {
                    donut: {
                        size: '65%',
                        labels: {
                            show: true,
                            name: { fontSize: '12px' },
                            value: { fontSize: '16px', color: '#fff', formatter: (val) => val },
                            total: { show: true, label: 'Total', color: '#9ca3af', fontSize: '11px' }
                        }
                    }
                }
            },
            tooltip: { theme: 'dark' }
        };
        const sentimentChart = new ApexCharts(document.querySelector("#chart-sentiment"), sentimentOptions);
        sentimentChart.render();

        // --- CUSTOM DATE TOGGLER ---
        function toggleCustomDates(val) {
            const el = document.getElementById('custom-dates-inputs');
            if (val === 'custom') {
                el.classList.remove('hidden');
            } else {
                el.classList.add('hidden');
            }
        }

        // --- MODAL UTILS ---
        function openModal(id) {
            document.getElementById(id).classList.remove('hidden');
        }
        function closeModal(id) {
            document.getElementById(id).classList.add('hidden');
        }

        // --- API: RUN MANUAL SCAN ---
        async function triggerImmediateScan() {
            const icon = document.getElementById('scan-btn-icon');
            const text = document.getElementById('scan-btn-text');
            
            icon.classList.add('animate-spin');
            text.textContent = 'Scanning Feeds...';

            try {
                const response = await fetch('/api/media-intelligence/run-scan', {
                    method: 'POST',
                    headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' }
                });

                if (response.ok) {
                    const res = await response.json();
                    showToast('Scan Completed', `Fetched: ${res.fetched}, Accepted: ${res.accepted}, Rejected: ${res.rejected}`);
                    setTimeout(() => window.location.reload(), 1500);
                } else {
                    showToast('Scan Failed', 'System error occurred while synchronizing feeds.', 'error');
                }
            } catch (err) {
                showToast('Connection Error', 'Failed connecting to the sync server.', 'error');
            } finally {
                icon.classList.remove('animate-spin');
                text.textContent = 'Run Scan Now';
            }
        }

        // --- API: OVERRIDE SENTIMENT ---
        async function overrideSentiment(id, sentiment) {
            try {
                const response = await fetch(`/api/media-intelligence/sentiment/${id}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ sentiment })
                });

                if (response.ok) {
                    showToast('Sentiment Saved', `Re-classified as ${sentiment.toUpperCase()}`);
                    // Reload to update stats and charts
                    setTimeout(() => window.location.reload(), 1000);
                } else {
                    showToast('Override Failed', 'Invalid values submitted.', 'error');
                }
            } catch (err) {
                showToast('Error', 'Connection failure to server.', 'error');
            }
        }

        // --- API: KEYWORDS CRUD ---
        async function addKeyword(e) {
            e.preventDefault();
            const input = document.getElementById('new-keyword-input');
            const keyword = input.value;

            try {
                const response = await fetch('/api/media-intelligence/keywords', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ action: 'create', keyword })
                });

                if (response.ok) {
                    showToast('Keyword Added', `Now tracking: "${keyword}"`);
                    setTimeout(() => window.location.reload(), 1000);
                } else {
                    const errData = await response.json();
                    showToast('Add Failed', errData.error || 'Duplicate keyword', 'error');
                }
            } catch (err) {
                showToast('Error', 'Connection failure.', 'error');
            }
        }

        async function toggleKeyword(id) {
            try {
                const response = await fetch('/api/media-intelligence/keywords', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ action: 'toggle', id })
                });

                if (response.ok) {
                    showToast('Status Updated', 'Keyword tracking toggled.');
                    setTimeout(() => window.location.reload(), 800);
                }
            } catch (err) {}
        }

        async function deleteKeyword(id) {
            if (!confirm('Are you sure you want to stop tracking this keyword?')) return;
            try {
                const response = await fetch('/api/media-intelligence/keywords', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ action: 'delete', id })
                });

                if (response.ok) {
                    showToast('Keyword Deleted', 'No longer monitoring.');
                    setTimeout(() => window.location.reload(), 800);
                }
            } catch (err) {}
        }

        // --- API: PROVIDERS CRUD ---
        async function toggleProvider(id) {
            try {
                const response = await fetch(`/api/media-intelligence/providers/${id}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ action: 'toggle' })
                });

                if (response.ok) {
                    showToast('Provider Toggled', 'Sync configurations updated.');
                    setTimeout(() => window.location.reload(), 800);
                }
            } catch (err) {}
        }

        // --- API: ALERT RULES CRUD ---
        async function toggleAlertRule(id) {
            try {
                const response = await fetch('/api/media-intelligence/alert-rules', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ action: 'toggle', id })
                });

                if (response.ok) {
                    showToast('Rule Updated', 'Alert dispatch condition toggled.');
                    setTimeout(() => window.location.reload(), 800);
                }
            } catch (err) {}
        }

        // --- REAL-TIME EVENTSOURCE (SSE) ---
        const eventSource = new EventSource('/api/media-intelligence/stream');

        // Listen for new mentions
        eventSource.addEventListener('mention', function (e) {
            const data = JSON.parse(e.data);
            showToast('New Mention Detected', data.title, 'mention');
            
            // Build the card HTML dynamically
            const cardHtml = `
                <div id="mention-${data.id}" class="bg-black/35 backdrop-blur-xl border border-white/10 rounded-2xl p-5 shadow-2xl transition-all duration-300 relative group flex flex-col md:flex-row gap-5 justify-between mention-glow">
                    <div class="flex items-start gap-4 md:w-3/4">
                        <img src="${data.source_logo || 'https://www.google.com/s2/favicons?domain=myprimetech.live&sz=64'}" class="w-10 h-10 rounded-xl bg-white/5 border border-white/10 p-1 object-contain shrink-0">
                        <div class="space-y-1.5">
                            <div class="flex flex-wrap items-center gap-2">
                                <span class="text-[10px] font-bold text-amber-400 uppercase tracking-wider">${data.source_name}</span>
                                <span class="text-[9px] text-gray-500">•</span>
                                <span class="text-[9px] text-gray-400">Published: ${data.published_at}</span>
                                <span class="text-[9px] text-gray-500">•</span>
                                <span class="text-[9px] text-amber-400 animate-pulse font-bold">Just Detected</span>
                            </div>
                            <h3 class="text-sm font-bold text-white group-hover:text-amber-400 transition-colors leading-snug">
                                <a href="${data.url}" target="_blank" class="flex items-center gap-1">
                                    ${data.title}
                                    <svg class="w-3.5 h-3.5 inline text-gray-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                                    </svg>
                                </a>
                            </h3>
                            <p class="text-xs text-gray-300 leading-relaxed font-light">${data.description}</p>
                            <div class="flex flex-wrap items-center gap-2 pt-2">
                                <span class="text-[9px] font-bold uppercase tracking-wider bg-white/5 border border-white/10 text-gray-300 px-2.5 py-0.5 rounded-full">
                                    Keyword: <span class="text-amber-400">${data.matched_keyword}</span>
                                </span>
                                <span class="text-[9px] font-bold uppercase tracking-wider bg-indigo-500/10 border border-indigo-500/20 text-indigo-400 px-2.5 py-0.5 rounded-full">
                                    ${data.category}
                                </span>
                                <span class="text-[9px] font-bold uppercase tracking-wider px-2.5 py-0.5 rounded-full border bg-amber-500/10 border-amber-500/20 text-amber-300">
                                    ${data.importance}
                                </span>
                                <span class="text-[9px] text-gray-400">
                                    AI Confidence: <span class="font-bold text-amber-400/80">${Math.round(data.confidence_score * 100)}%</span>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-row md:flex-col justify-between items-end gap-3 shrink-0 border-t md:border-t-0 border-white/5 pt-3 md:pt-0">
                        <div class="space-y-1 w-full text-left md:text-right">
                            <span class="text-[9px] text-gray-400 uppercase tracking-wider block">Sentiment assessment</span>
                            <select onchange="overrideSentiment('${data.id}', this.value)"
                                class="text-xs font-bold uppercase tracking-wider px-3 py-1.5 rounded-xl border bg-neutral-900/90 cursor-pointer focus:outline-none w-fit">
                                <option value="positive" ${data.sentiment === 'positive' ? 'selected' : ''}>Positive</option>
                                <option value="neutral" ${data.sentiment === 'neutral' ? 'selected' : ''}>Neutral</option>
                                <option value="negative" ${data.sentiment === 'negative' ? 'selected' : ''}>Negative</option>
                                <option value="mixed" ${data.sentiment === 'mixed' ? 'selected' : ''}>Mixed</option>
                            </select>
                        </div>
                    </div>
                </div>
            `;

            // Append to feed container
            const container = document.getElementById('mentions-feed-container');
            if (container) {
                container.insertAdjacentHTML('afterbegin', cardHtml);
            }

            // Increment Total Counter
            const totEl = document.getElementById('stat-total');
            if (totEl) {
                totEl.textContent = parseInt(totEl.textContent) + 1;
            }
        });

        // Listen for new alerts
        eventSource.addEventListener('alert', function (e) {
            const data = JSON.parse(e.data);
            showToast(data.title, data.message, 'alert');
            
            // Increment Alert Counter
            const alertEl = document.getElementById('stat-alerts');
            if (alertEl) {
                const parts = alertEl.innerHTML.split(' ');
                const val = parseInt(parts[0]) + 1;
                alertEl.innerHTML = `${val} <span class="text-xs text-gray-400 font-light">unread</span>`;
            }
        });

        // --- TOAST NOTIFICATIONS MANAGER ---
        function showToast(title, message, type = 'success') {
            const container = document.getElementById('toast-container');
            const id = 'toast-' + Math.random().toString(36).substr(2, 9);

            let iconSvg = '';
            let borderColors = 'border-white/10 bg-neutral-900/95';
            let titleColors = 'text-white';

            if (type === 'mention') {
                iconSvg = `<svg class="w-5 h-5 text-amber-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>`;
                borderColors = 'border-amber-400/40 bg-black/90';
                titleColors = 'text-amber-400';
            } else if (type === 'alert') {
                iconSvg = `<svg class="w-5 h-5 text-rose-400 animate-bounce" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/></svg>`;
                borderColors = 'border-rose-500/40 bg-black/90';
                titleColors = 'text-rose-400';
            } else if (type === 'error') {
                iconSvg = `<svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>`;
                borderColors = 'border-red-500/30 bg-neutral-900/95';
                titleColors = 'text-red-500';
            } else {
                iconSvg = `<svg class="w-5 h-5 text-emerald-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>`;
                borderColors = 'border-emerald-500/30 bg-neutral-900/95';
            }

            const html = `
                <div id="${id}" class="toast-enter flex items-start gap-3 border ${borderColors} rounded-2xl p-4 shadow-2xl backdrop-blur-md">
                    <div class="shrink-0 pt-0.5">${iconSvg}</div>
                    <div class="flex-grow">
                        <h4 class="text-xs font-bold ${titleColors} tracking-wide">${title}</h4>
                        <p class="text-[10px] text-gray-300 mt-1 font-light leading-relaxed">${message}</p>
                    </div>
                </div>
            `;

            container.insertAdjacentHTML('beforeend', html);

            // Automatically remove toast after 5 seconds
            setTimeout(() => {
                const el = document.getElementById(id);
                if (el) {
                    el.style.transition = 'all 0.4s ease';
                    el.style.opacity = '0';
                    el.style.transform = 'translateY(-20px)';
                    setTimeout(() => el.remove(), 400);
                }
            }, 5000);
        }
    </script>
</body>

</html>
