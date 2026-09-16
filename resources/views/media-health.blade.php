<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Monitoring Health Console - Ifeanyi Chukwuma Odii</title>
    <link rel="icon" type="image/jpeg" href="{{ asset('images/favicon.jpg') }}">
    
    <!-- Vite Assets or Tailwind CDN Fallback -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <script src="https://cdn.tailwindcss.com"></script>
    @endif

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700;800&display=swap" rel="stylesheet">
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

        /* Toast entry */
        .toast-enter {
            animation: slideInRight 0.35s cubic-bezier(0.175, 0.885, 0.32, 1.275) forwards;
        }
        @keyframes slideInRight {
            0% { transform: translateX(100%); opacity: 0; }
            100% { transform: translateX(0); opacity: 1; }
        }

    </style>
</head>

<body class="antialiased text-white min-h-screen relative flex flex-col justify-between"
    style="background-image: url('{{ asset('images/landing-profile.png') }}'); background-size: cover; background-position: center; background-attachment: fixed;">

    <!-- Blur overlay for readability -->
    <div class="absolute inset-0 bg-black/75 backdrop-blur-md z-0"></div>

    <!-- Toast Notifications -->
    <div id="toast-container" class="fixed top-6 right-6 z-50 flex flex-col gap-3 max-w-sm w-full"></div>

    <!-- Navigation Header -->
    <header class="relative z-10 w-full bg-black/40 border-b border-white/10 px-6 lg:px-12 py-4">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <!-- Navigation links -->
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
                    <a href="/admin/media-intelligence" class="text-gray-400 hover:text-white font-medium transition-colors">Media Intelligence</a>
                    <a href="/admin/media-intelligence/health" class="text-amber-400 border-b-2 border-amber-400 pb-1 font-bold">System Health</a>
                </nav>
            </div>

            <!-- Brand Logo -->
            <a href="/" class="text-md font-bold tracking-wider text-white uppercase select-none hidden lg:block">
                ANYI GA EMEYA <span class="text-amber-400">2027</span>
            </a>

            <!-- Sync Trigger & Sign Out -->
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
        <a href="/admin/media-intelligence" class="text-gray-400 hover:text-white font-medium">Media Intelligence</a>
        <a href="/admin/media-intelligence/health" class="text-amber-400 font-bold">System Health</a>
    </div>

    <!-- Main Container -->
    <main class="relative z-10 flex-grow w-full max-w-7xl mx-auto px-4 md:px-8 lg:px-12 py-8">
        
        <!-- Welcome Title & Badges -->
        <div class="flex justify-between items-center pb-6 mb-8 border-b border-white/10">
            <div>
                <span class="text-xs font-bold tracking-widest text-amber-400 uppercase block">Engine Diagnosis Console</span>
                <h1 class="text-2xl md:text-3xl font-extrabold text-white mt-1">Monitoring Health Status</h1>
            </div>
        </div>

        <!-- Diagnostic Summary Cards -->
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
            <div class="bg-black/35 backdrop-blur-xl border border-white/10 rounded-2xl p-4">
                <span class="text-[10px] uppercase font-bold text-gray-400 tracking-wider">Total Scraped Items</span>
                <h3 class="text-2xl font-extrabold text-white mt-1">{{ $totalItemsFetched }}</h3>
            </div>
            <div class="bg-black/35 backdrop-blur-xl border border-white/10 rounded-2xl p-4">
                <span class="text-[10px] uppercase font-bold text-emerald-400 tracking-wider">Total Mentions Accepted</span>
                <h3 class="text-2xl font-extrabold text-emerald-400 mt-1">{{ $totalItemsAccepted }}</h3>
            </div>
            <div class="bg-black/35 backdrop-blur-xl border border-white/10 rounded-2xl p-4">
                <span class="text-[10px] uppercase font-bold text-rose-400 tracking-wider">False Positives Rejected</span>
                <h3 class="text-2xl font-extrabold text-rose-400 mt-1">{{ $totalItemsRejected }}</h3>
            </div>
            <div class="bg-black/35 backdrop-blur-xl border border-white/10 rounded-2xl p-4">
                <span class="text-[10px] uppercase font-bold text-amber-400 tracking-wider">Last DB Write</span>
                <h3 class="text-base font-bold text-white mt-2 truncate">{{ $lastDatabaseWrite }}</h3>
            </div>
        </div>

        <!-- Providers Status Cards -->
        <div class="mb-8">
            <h3 class="text-sm font-bold text-white tracking-wider uppercase mb-4 pb-2 border-b border-white/10">Connected Crawler Sources</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($providers as $provider)
                    @php
                        $isConfigured = true;
                        if ($provider->type === 'newsapi' && empty(env('NEWS_PROVIDER_API_KEY'))) {
                            $isConfigured = false;
                        }
                        if ($provider->type === 'youtube' && empty(env('YOUTUBE_API_KEY'))) {
                            $isConfigured = false;
                        }
                    @endphp
                    <div class="bg-black/35 backdrop-blur-xl border border-white/10 rounded-2xl p-5 shadow-2xl space-y-4">
                        <div class="flex justify-between items-start">
                            <div>
                                <h4 class="text-sm font-bold text-white">{{ $provider->name }}</h4>
                                <span class="text-[9px] text-gray-400 uppercase tracking-widest">Type: {{ $provider->type }}</span>
                            </div>

                            <!-- Status Badge -->
                            <div class="flex flex-col items-end gap-1">
                                @if(!$provider->is_enabled)
                                    <span class="text-[9px] font-bold uppercase tracking-wider bg-gray-500/10 border border-gray-500/30 text-gray-400 px-2 py-0.5 rounded-full select-none">
                                        Paused
                                    </span>
                                @elseif(!$isConfigured)
                                    <span class="text-[9px] font-bold uppercase tracking-wider bg-rose-500/10 border border-rose-500/30 text-rose-400 px-2 py-0.5 rounded-full select-none"
                                        title="Missing key in environment configurations.">
                                        Blocked (No Key)
                                    </span>
                                @else
                                    <span class="text-[9px] font-bold uppercase tracking-wider bg-emerald-500/10 border border-emerald-500/30 text-emerald-400 px-2 py-0.5 rounded-full select-none">
                                        Active
                                    </span>
                                @endif
                            </div>
                        </div>

                        <!-- Sync Metadata metrics -->
                        <div class="bg-white/5 border border-white/5 rounded-xl p-3.5 space-y-1.5 text-xs">
                            <div class="flex justify-between">
                                <span class="text-gray-400">Total Mentions:</span>
                                <span class="text-white font-bold">{{ $provider->mentions_count }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-400">Scan Interval:</span>
                                <span class="text-white font-semibold">{{ round($provider->polling_interval / 60) }} min</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-400">Last Sync Successful:</span>
                                <span class="text-amber-400 font-semibold">{{ $provider->last_successful_sync ? $provider->last_successful_sync->diffForHumans() : 'Never' }}</span>
                            </div>
                        </div>

                        @if($provider->last_error)
                            <!-- Sync error banner -->
                            <div class="bg-red-500/5 border border-red-500/10 rounded-xl p-3 text-[10px] text-red-400 font-light leading-relaxed">
                                <span class="font-bold uppercase tracking-wide block mb-0.5 text-red-500">Last Error log:</span>
                                {{ $provider->last_error }}
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Sync Job Logs Table -->
        <div class="bg-black/35 backdrop-blur-xl border border-white/10 rounded-2xl p-5 shadow-2xl">
            <h3 class="text-sm font-bold text-white tracking-wider uppercase mb-4 pb-2 border-b border-white/10">Cron / Job Sync History Log</h3>
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="text-[9px] uppercase tracking-wider text-gray-400 border-b border-white/10">
                            <th class="pb-3 font-semibold">Provider</th>
                            <th class="pb-3 font-semibold">Status</th>
                            <th class="pb-3 font-semibold text-center">Fetched</th>
                            <th class="pb-3 font-semibold text-center">Accepted</th>
                            <th class="pb-3 font-semibold text-center">Rejected</th>
                            <th class="pb-3 font-semibold">Duration/Run At</th>
                            <th class="pb-3 font-semibold">Details</th>
                        </tr>
                    </thead>
                    <tbody class="text-xs font-light divide-y divide-white/5">
                        @forelse($recentRuns as $run)
                            <tr>
                                <td class="py-3.5 font-bold text-white">{{ $run->provider->name }}</td>
                                <td class="py-3.5">
                                    @if($run->status === 'success')
                                        <span class="text-[9px] font-bold uppercase tracking-wider bg-emerald-500/10 border border-emerald-500/30 text-emerald-400 px-2 py-0.5 rounded-full select-none">
                                            Success
                                        </span>
                                    @elseif($run->status === 'running')
                                        <span class="text-[9px] font-bold uppercase tracking-wider bg-amber-500/10 border border-amber-500/30 text-amber-400 px-2 py-0.5 rounded-full select-none">
                                            Running
                                        </span>
                                    @else
                                        <span class="text-[9px] font-bold uppercase tracking-wider bg-rose-500/10 border border-rose-500/30 text-rose-400 px-2 py-0.5 rounded-full select-none">
                                            Failed
                                        </span>
                                    @endif
                                </td>
                                <td class="py-3.5 text-center text-gray-300 font-semibold">{{ $run->items_fetched }}</td>
                                <td class="py-3.5 text-center text-emerald-400 font-bold">{{ $run->items_accepted }}</td>
                                <td class="py-3.5 text-center text-rose-400 font-semibold">{{ $run->items_rejected }}</td>
                                <td class="py-3.5 text-gray-400">{{ $run->run_at->format('d M, h:i:s A') }}</td>
                                <td class="py-3.5 text-gray-400 max-w-xs truncate" title="{{ $run->error_message }}">
                                    {{ $run->error_message ?: 'None' }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="py-4 text-center text-gray-500 italic">No job sync runs recorded yet.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <!-- Pagination -->
            <div class="pt-4">
                {{ $recentRuns->links() }}
            </div>
        </div>

    </main>

    <!-- Footer Area -->
    <footer class="relative z-10 w-full text-center py-6 border-t border-white/10 bg-black/40 text-xs text-gray-400 shrink-0">
        <p>© 2026 Dr. Ifeanyi Chukwuma Odii. System Diagnostic Console.</p>
    </footer>

    <!-- Scripts -->
    <script>
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

        // --- TOAST NOTIFICATIONS MANAGER ---
        function showToast(title, message, type = 'success') {
            const container = document.getElementById('toast-container');
            const id = 'toast-' + Math.random().toString(36).substr(2, 9);

            let iconSvg = '';
            let borderColors = 'border-white/10 bg-neutral-900/95';
            let titleColors = 'text-white';

            if (type === 'error') {
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
