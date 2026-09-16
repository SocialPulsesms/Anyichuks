<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Production System Health Console</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #0b0f17; color: #e2e8f0; }
        .glass-panel { background: rgba(15, 23, 42, 0.75); backdrop-filter: blur(16px); border: 1px solid rgba(255, 255, 255, 0.08); }
    </style>
</head>
<body class="p-8">
    <div class="max-w-6xl mx-auto space-y-8">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-3xl font-bold text-white flex items-center gap-3">
                    <i data-lucide="activity" class="text-amber-400"></i> Production System Health
                </h1>
                <p class="text-gray-400 text-sm mt-1">Real-time status of database, media intelligence pipeline, storage, and external providers.</p>
            </div>
            <a href="/admin/media-intelligence" class="bg-white/10 hover:bg-white/20 text-white text-xs font-semibold px-4 py-2 rounded-lg transition-all flex items-center gap-2">
                <i data-lucide="arrow-left" class="w-4 h-4"></i> Media Intelligence Portal
            </a>
        </div>

        <!-- Health Grid -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
            <!-- Database -->
            <div class="glass-panel p-6 rounded-xl border border-white/10">
                <div class="text-xs text-gray-400 uppercase font-semibold mb-1">Database Status</div>
                <div class="text-xl font-bold text-emerald-400 flex items-center gap-2">
                    <i data-lucide="database" class="w-5 h-5"></i> {{ $dbStatus }}
                </div>
            </div>
            <!-- Storage -->
            <div class="glass-panel p-6 rounded-xl border border-white/10">
                <div class="text-xs text-gray-400 uppercase font-semibold mb-1">Storage System</div>
                <div class="text-xl font-bold text-emerald-400 flex items-center gap-2">
                    <i data-lucide="hard-drive" class="w-5 h-5"></i> {{ $storageStatus }}
                </div>
            </div>
            <!-- Gemini AI -->
            <div class="glass-panel p-6 rounded-xl border border-white/10">
                <div class="text-xs text-gray-400 uppercase font-semibold mb-1">Gemini AI Service</div>
                <div class="text-xl font-bold {{ $aiStatus === 'CONNECTED' ? 'text-emerald-400' : 'text-amber-400' }} flex items-center gap-2">
                    <i data-lucide="cpu" class="w-5 h-5"></i> {{ $aiStatus }}
                </div>
            </div>
            <!-- News API -->
            <div class="glass-panel p-6 rounded-xl border border-white/10">
                <div class="text-xs text-gray-400 uppercase font-semibold mb-1">NewsAPI.org</div>
                <div class="text-xl font-bold {{ $newsApiStatus === 'CONNECTED' ? 'text-emerald-400' : 'text-amber-400' }} flex items-center gap-2">
                    <i data-lucide="newspaper" class="w-5 h-5"></i> {{ $newsApiStatus }}
                </div>
            </div>
        </div>

        <!-- Providers List -->
        <div class="glass-panel p-6 rounded-xl border border-white/10">
            <h2 class="text-xl font-bold text-white mb-4">Media Monitoring Providers</h2>
            <div class="divide-y divide-white/5">
                @foreach($providers as $p)
                <div class="py-3 flex justify-between items-center">
                    <div>
                        <span class="text-white font-medium">{{ $p->name }}</span>
                        <span class="text-xs text-gray-500 ml-2">Type: {{ $p->type }}</span>
                    </div>
                    <div class="flex items-center gap-4 text-xs">
                        <span class="text-gray-400">Last Sync: {{ $p->last_successful_sync ?? 'Never' }}</span>
                        <span class="px-2 py-0.5 rounded font-bold {{ $p->is_enabled ? 'bg-emerald-400/10 text-emerald-400' : 'bg-rose-400/10 text-rose-400' }}">
                            {{ $p->is_enabled ? 'ACTIVE' : 'DISABLED' }}
                        </span>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <!-- Recent Runs -->
        <div class="glass-panel p-6 rounded-xl border border-white/10">
            <h2 class="text-xl font-bold text-white mb-4">Recent Pipeline Execution Runs</h2>
            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs text-gray-400">
                    <thead class="bg-white/5 text-gray-300 uppercase text-[10px] tracking-wider">
                        <tr>
                            <th class="p-3">Run ID</th>
                            <th class="p-3">Provider</th>
                            <th class="p-3">Status</th>
                            <th class="p-3">Fetched</th>
                            <th class="p-3">Accepted</th>
                            <th class="p-3">Rejected</th>
                            <th class="p-3">Run Time</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-white/5">
                        @foreach($recentRuns as $run)
                        <tr>
                            <td class="p-3 font-mono">#{{ $run->id }}</td>
                            <td class="p-3 font-medium text-white">{{ $run->provider->name ?? 'System' }}</td>
                            <td class="p-3">
                                <span class="px-2 py-0.5 rounded font-bold {{ $run->status === 'success' ? 'bg-emerald-400/10 text-emerald-400' : 'bg-rose-400/10 text-rose-400' }}">
                                    {{ strtoupper($run->status) }}
                                </span>
                            </td>
                            <td class="p-3">{{ $run->items_fetched }}</td>
                            <td class="p-3 text-emerald-400 font-bold">{{ $run->items_accepted }}</td>
                            <td class="p-3 text-rose-400">{{ $run->items_rejected }}</td>
                            <td class="p-3">{{ $run->run_at }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script>lucide.createIcons();</script>
</body>
</html>
