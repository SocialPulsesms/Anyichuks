<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Contacts Dashboard - Ifeanyi Chukwuma Odii</title>
    <link rel="icon" type="image/jpeg" href="{{ asset('images/favicon.jpg') }}">
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <script src="https://cdn.tailwindcss.com"></script>
    @endif
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;800&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }

        /* Custom Scrollbar for premium feel */
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

        /* Slide Out Animation on Delete */
        .slide-out {
            animation: slideOut 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275) forwards;
        }

        @keyframes slideOut {
            0% { transform: scale(1); opacity: 1; }
            100% { transform: scale(0.9); opacity: 0; margin-bottom: -150px; display: none; }
        }

    </style>
</head>

<body class="antialiased text-white min-h-screen relative flex flex-col justify-between"
    style="background-image: url('{{ asset('images/landing-profile.png') }}'); background-size: cover; background-position: center; background-attachment: fixed;">

    <!-- Dark Overlay to ensure readability and high-end feel -->
    <div class="absolute inset-0 bg-black/70 backdrop-blur-md z-0"></div>

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
                    <a href="/contacts-dashboard" class="text-amber-400 border-b-2 border-amber-400 pb-1 font-bold">Contact Inquiries</a>
                    <a href="/admin/media-intelligence" class="text-gray-400 hover:text-white font-medium transition-colors">Media Intelligence</a>
                    <a href="/admin/media-intelligence/health" class="text-gray-400 hover:text-white font-medium transition-colors">System Health</a>
                </nav>
            </div>

            <!-- Logo / Brand -->
            <a href="/" class="hidden lg:inline text-md font-bold tracking-wider text-white uppercase select-none">
                ANYI GA EMEYA <span class="text-amber-400">2027</span>
            </a>

            <!-- Sign Out Button -->
            <form action="/contacts-logout" method="POST" class="inline">
                @csrf
                <button type="submit" class="flex items-center gap-2 text-xs font-semibold text-gray-300 hover:text-red-400 bg-white/5 hover:bg-white/10 px-4 py-2 rounded-xl border border-white/10 transition-all select-none">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                    </svg>
                    Sign Out
                </button>
            </form>
        </div>
    </header>

    <!-- Mobile Nav Bar -->
    <div class="relative z-10 md:hidden bg-black/60 border-b border-white/10 px-6 py-3 flex justify-around text-xs">
        <a href="/contacts-dashboard" class="text-amber-400 font-bold">Contact Inquiries</a>
        <a href="/admin/media-intelligence" class="text-gray-400 hover:text-white font-medium">Media Intelligence</a>
        <a href="/admin/media-intelligence/health" class="text-gray-400 hover:text-white font-medium">System Health</a>
    </div>


    <!-- Main Content Panel -->
    <main class="relative z-10 flex-grow w-full max-w-7xl mx-auto px-4 md:px-8 lg:px-12 py-8 lg:py-16">
        
        <!-- Header Title Section -->
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 border-b border-white/10 pb-6 mb-6">
            <div>
                <span class="text-xs font-bold tracking-widest text-amber-400 uppercase block">Executive Campaign & CRM Console</span>
                <h1 class="text-2xl md:text-3xl lg:text-4xl font-extrabold text-white mt-1">ANYI GA EMEYA 2027 Command Center</h1>
            </div>
            
            <!-- Quick Stats Badges -->
            <div class="flex flex-wrap items-center gap-3">
                <div class="bg-amber-500/10 border border-amber-400/30 px-4 py-2 rounded-2xl flex items-center gap-2.5 shadow-md">
                    <span class="w-2.5 h-2.5 rounded-full bg-amber-400 animate-pulse"></span>
                    <span class="text-xs font-semibold text-gray-300">Campaign Volunteers: <span id="stats-volunteers-count" class="font-bold text-amber-400 text-sm ml-1">{{ count($volunteers ?? []) }}</span></span>
                </div>
                <div class="bg-white/5 border border-white/10 px-4 py-2 rounded-2xl flex items-center gap-2.5 shadow-md">
                    <span class="w-2.5 h-2.5 rounded-full bg-blue-400"></span>
                    <span class="text-xs font-semibold text-gray-300">Contact Inquiries: <span id="stats-total-count" class="font-bold text-white text-sm ml-1">{{ count($contacts) }}</span></span>
                </div>
            </div>
        </div>

        <!-- Dashboard Tabs -->
        <div class="flex items-center gap-2 border-b border-white/10 pb-4 mb-8">
            <button type="button" onclick="switchDashboardTab('volunteers')" id="tab-btn-volunteers"
                class="px-5 py-2.5 rounded-xl font-bold text-xs uppercase tracking-wider transition-all bg-amber-400 text-black shadow-lg shadow-amber-400/20 flex items-center gap-2 cursor-pointer">
                <span>★ 2027 Campaign Volunteers</span>
                <span class="px-2 py-0.5 rounded-full bg-black/20 text-black text-[10px] font-extrabold">{{ count($volunteers ?? []) }}</span>
            </button>
            <button type="button" onclick="switchDashboardTab('contacts')" id="tab-btn-contacts"
                class="px-5 py-2.5 rounded-xl font-bold text-xs uppercase tracking-wider transition-all bg-white/5 text-gray-400 hover:text-white hover:bg-white/10 flex items-center gap-2 cursor-pointer">
                <span>✉ Contact Inquiries</span>
                <span class="px-2 py-0.5 rounded-full bg-white/10 text-gray-300 text-[10px] font-extrabold">{{ count($contacts) }}</span>
            </button>
        </div>

        <!-- TAB 1: 2027 CAMPAIGN VOLUNTEERS VIEW -->
        <div id="view-volunteers" class="space-y-6">
            @if(count($volunteers ?? []) === 0)
                <div class="flex flex-col items-center justify-center p-12 lg:p-20 bg-black/40 backdrop-blur-xl border border-white/10 rounded-3xl text-center shadow-2xl max-w-2xl mx-auto">
                    <div class="w-16 h-16 rounded-full bg-amber-400/10 border border-amber-400/30 flex items-center justify-center mb-6 text-amber-400 text-2xl font-black">
                        ★
                    </div>
                    <h3 class="text-xl font-bold tracking-wide text-white uppercase">No Registered Volunteers Yet</h3>
                    <p class="text-xs text-gray-400 mt-2 leading-relaxed max-w-sm">
                        As supporters register through the "Join 2027 Movement" form on the homepage, their profiles, assigned LGAs, and campaign roles will populate here in real-time.
                    </p>
                </div>
            @else
                <!-- Volunteers Table -->
                <div class="bg-black/40 backdrop-blur-xl border border-white/10 rounded-3xl overflow-hidden shadow-2xl">
                    <div class="p-6 border-b border-white/10 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                        <div>
                            <h3 class="text-lg font-bold text-white">Registered Campaign Ambassadors</h3>
                            <p class="text-xs text-gray-400">Total mobilized across Ebonyi State and Diaspora</p>
                        </div>
                        <input type="text" id="volunteer-search-input" onkeyup="filterVolunteersTable()" placeholder="Search by name, phone, LGA..."
                            class="px-4 py-2 bg-black/50 border border-white/15 rounded-xl text-white text-xs focus:outline-none focus:border-amber-400 transition-colors w-full sm:w-64">
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse text-xs">
                            <thead>
                                <tr class="border-b border-white/10 bg-white/5 text-gray-400 font-semibold uppercase tracking-wider">
                                    <th class="p-4">Reg ID</th>
                                    <th class="p-4">Ambassador Name</th>
                                    <th class="p-4">Phone / WhatsApp</th>
                                    <th class="p-4">Ebonyi LGA & Ward</th>
                                    <th class="p-4">Role</th>
                                    <th class="p-4">Registered Date</th>
                                    <th class="p-4 text-right">Quick Contact</th>
                                </tr>
                            </thead>
                            <tbody id="volunteers-table-body" class="divide-y divide-white/5 text-gray-300">
                                @foreach($volunteers as $vol)
                                    <tr class="hover:bg-white/5 transition-colors">
                                        <td class="p-4 font-mono font-bold text-amber-400">{{ $vol['registration_id'] ?? 'ANYI27' }}</td>
                                        <td class="p-4 font-semibold text-white">{{ $vol['name'] ?? 'Ambassador' }}</td>
                                        <td class="p-4 font-mono">{{ $vol['phone'] ?? '-' }}</td>
                                        <td class="p-4">
                                            <span class="px-2.5 py-1 rounded-full bg-amber-400/10 text-amber-300 border border-amber-400/20 font-semibold">
                                                {{ $vol['lga'] ?? 'General' }}
                                            </span>
                                            @if(!empty($vol['ward']))
                                                <span class="text-gray-400 block text-[10px] mt-1">{{ $vol['ward'] }}</span>
                                            @endif
                                        </td>
                                        <td class="p-4 text-gray-300">{{ $vol['role'] ?? 'Volunteer' }}</td>
                                        <td class="p-4 text-gray-400 text-[11px]">{{ !empty($vol['created_at']) ? date('M d, Y h:ia', strtotime($vol['created_at'])) : 'Recent' }}</td>
                                        <td class="p-4 text-right">
                                            <a href="https://api.whatsapp.com/send?phone={{ preg_replace('/[^0-9]/', '', $vol['phone'] ?? '') }}&text=Hello%20{{ urlencode($vol['name'] ?? 'Ambassador') }}%2C%20greetings%20from%20the%20ANYI%20GA%20EMEYA%202027%20Campaign%20Directorate."
                                                target="_blank" class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-emerald-500/10 hover:bg-emerald-500/20 border border-emerald-500/30 text-emerald-400 font-semibold text-[11px] transition-colors">
                                                <span>WhatsApp</span> &rarr;
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif
        </div>

        <!-- TAB 2: CONTACT INQUIRIES VIEW (HIDDEN BY DEFAULT OR SWITCHABLE) -->
        <div id="view-contacts" class="hidden space-y-6">
        @if(count($contacts) === 0)
            <!-- Elegant Empty State -->
            <div class="flex flex-col items-center justify-center p-12 lg:p-20 bg-black/40 backdrop-blur-xl border border-white/10 rounded-3xl text-center shadow-2xl animate-fade-in max-w-2xl mx-auto">
                <div class="w-16 h-16 rounded-full bg-white/5 border border-white/10 flex items-center justify-center mb-6">
                    <svg class="w-8 h-8 text-amber-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                </div>
                <h3 class="text-xl font-bold tracking-wide text-white uppercase">No Contact Inquiries Yet</h3>
                <p class="text-xs text-gray-400 mt-2 leading-relaxed max-w-sm">
                    Inquiries submitted via the contact form will appear here in real-time. Share the contact page with your team to collect new inquiries.
                </p>
                <a href="/contact" class="mt-6 px-6 py-2.5 bg-amber-400 hover:bg-amber-300 text-black font-bold tracking-wider uppercase rounded-xl text-xs transition-colors">
                    Go to Contact Form
                </a>
            </div>
        @else
            <!-- Responsive Grid of Inquiries -->
            <div id="contacts-grid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8 items-stretch">
                @foreach($contacts as $item)
                    <!-- Single Inquiry Card -->
                    <div id="card-{{ $item['id'] }}" class="flex flex-col bg-black/40 backdrop-blur-xl border border-white/10 rounded-3xl shadow-2xl p-6 justify-between gap-5 transition-all hover:border-amber-400/30 hover:scale-[1.01] duration-300 relative overflow-hidden group">
                        
                        <!-- Top Header with Ref ID & Submission Date -->
                        <div class="flex justify-between items-start border-b border-white/5 pb-3">
                            <div class="flex flex-col">
                                <span class="text-[10px] font-bold text-amber-400 uppercase tracking-widest">{{ $item['id'] }}</span>
                                <span class="text-[9px] text-gray-400 mt-0.5">{{ \Carbon\Carbon::parse($item['created_at'])->format('d M Y, h:i A') }}</span>
                            </div>
                            <span class="text-[9px] font-bold uppercase tracking-wider bg-emerald-500/10 border border-emerald-500/30 text-emerald-400 px-2 py-0.5 rounded-full select-none">
                                New Inquiry
                            </span>
                        </div>

                        <!-- Client Details Block -->
                        <div class="space-y-3">
                            <div>
                                <span class="text-[9px] font-bold tracking-widest text-amber-400/80 uppercase">Client Name</span>
                                <h3 class="text-base font-bold text-white tracking-wide mt-0.5">{{ $item['name'] }}</h3>
                            </div>

                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <span class="text-[9px] font-bold tracking-widest text-amber-400/80 uppercase">Location</span>
                                    <p class="text-xs text-gray-300 font-medium truncate mt-0.5">{{ $item['location'] }}</p>
                                </div>
                                <div>
                                    <span class="text-[9px] font-bold tracking-widest text-amber-400/80 uppercase">Purpose</span>
                                    <p class="text-xs text-amber-400 font-bold truncate mt-0.5">{{ $item['reason'] }}</p>
                                </div>
                            </div>

                            <div class="grid grid-cols-1 gap-2 pt-2 border-t border-white/5">
                                <a href="mailto:{{ $item['email'] }}" class="flex items-center gap-2 text-xs text-gray-300 hover:text-amber-400 transition-colors w-fit">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                    </svg>
                                    <span class="truncate">{{ $item['email'] }}</span>
                                </a>
                                <a href="tel:{{ $item['phone'] }}" class="flex items-center gap-2 text-xs text-gray-300 hover:text-amber-400 transition-colors w-fit">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.94.725l.548 2.2a1 1 0 01-.321.988l-1.305.98a10.582 10.582 0 004.872 4.872l.98-1.305a1 1 0 01.988-.321l2.2.548a1 1 0 01.725.94V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                    </svg>
                                    <span>{{ $item['phone'] }}</span>
                                </a>
                            </div>
                        </div>

                        <!-- Detailed Message Box (Scrollable) -->
                        <div class="flex-grow">
                            <span class="text-[9px] font-bold tracking-widest text-amber-400/80 uppercase">Inquiry Message</span>
                            <div class="bg-white/5 border border-white/5 rounded-2xl p-3 mt-1 text-xs text-gray-300 leading-relaxed max-h-36 overflow-y-auto whitespace-pre-line">
                                {{ $item['message'] }}
                            </div>
                        </div>

                        <!-- Reply History Timeline -->
                        @if(isset($item['replies']) && count($item['replies']) > 0)
                            <div class="border-t border-white/5 pt-3 mt-1 space-y-2 shrink-0">
                                <span class="text-[9px] font-bold tracking-widest text-emerald-400 uppercase block">Reply History</span>
                                <div class="space-y-2 max-h-36 overflow-y-auto pr-1">
                                    @foreach($item['replies'] as $reply)
                                        <div class="bg-emerald-500/5 border border-emerald-500/10 rounded-2xl p-2.5 text-[11px] leading-relaxed">
                                            <div class="flex justify-between items-center text-[9px] text-gray-400 mb-1">
                                                <span class="font-bold text-emerald-400">Dr. Odii Office</span>
                                                <span>{{ \Carbon\Carbon::parse($reply['created_at'])->format('d M, h:i A') }}</span>
                                            </div>
                                            <p class="text-gray-300 font-light">{{ $reply['message'] }}</p>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        <!-- Card Footer CRM Controls -->
                        <div class="border-t border-white/5 pt-4 mt-2 flex gap-3 shrink-0">
                            <!-- Reply Button -->
                            <button type="button" onclick="openReplyModal('{{ $item['id'] }}', '{{ addslashes($item['name']) }}', '{{ $item['email'] }}')"
                                class="w-full py-2.5 bg-amber-400 hover:bg-amber-300 text-black font-bold uppercase rounded-xl text-[10px] tracking-wider transition-all duration-200 flex items-center justify-center gap-1.5 active:scale-95 select-none">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6" />
                                </svg>
                                Reply
                            </button>

                            <!-- Delete/Archive button -->
                            <button type="button" onclick="archiveContact('{{ $item['id'] }}')"
                                class="w-full py-2.5 bg-red-600/10 hover:bg-red-600 hover:text-white border border-red-500/20 text-red-400 font-bold uppercase rounded-xl text-[10px] tracking-wider transition-all duration-200 flex items-center justify-center gap-1.5 active:scale-95 select-none">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                                Archive
                            </button>
                        </div>

                    </div>
                @endforeach
            </div>
        @endif
        </div> <!-- /view-contacts -->

    </main>

    <!-- Reply Modal Overlay (Hidden by default) -->
    <div id="reply-modal" class="hidden fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/80 backdrop-blur-md animate-fade-in">
        <div class="w-full max-w-lg bg-neutral-900 border border-white/10 rounded-3xl p-6 md:p-8 shadow-2xl relative flex flex-col justify-between">
            <div>
                <!-- Modal Header -->
                <div class="flex justify-between items-center border-b border-white/10 pb-4 mb-5">
                    <h3 class="text-sm font-bold text-white tracking-wider uppercase">Send Response</h3>
                    <button type="button" onclick="closeReplyModal()" class="text-gray-500 hover:text-white transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <!-- Recipient Info -->
                <div class="w-full bg-white/5 border border-white/5 rounded-2xl p-3.5 mb-4 text-xs space-y-1.5">
                    <div class="flex justify-between">
                        <span class="text-gray-400">Recipient:</span>
                        <span id="modal-client-name" class="text-white font-bold">---</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-400">Email:</span>
                        <span id="modal-client-email" class="text-amber-400 font-semibold">---</span>
                    </div>
                </div>

                <!-- Reply Input Form -->
                <form id="reply-form" class="space-y-4">
                    <input type="hidden" id="modal-inquiry-id">
                    <div class="flex flex-col gap-1.5">
                        <label for="reply-message" class="text-[11px] font-bold tracking-wider text-amber-400 uppercase">Draft Your Message</label>
                        <textarea id="reply-message" required rows="6" placeholder="Dear Client, thank you for your proposal. We are pleased to connect regarding..."
                            class="bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-sm placeholder-gray-500 focus:outline-none focus:border-amber-400/50 transition-colors w-full focus:ring-1 focus:ring-amber-400/30 resize-none text-white leading-relaxed"></textarea>
                    </div>
                </form>
            </div>

            <!-- Modal Footer Buttons -->
            <div class="border-t border-white/10 pt-4 mt-6 flex justify-end gap-3">
                <button type="button" onclick="closeReplyModal()"
                    class="px-5 py-2.5 bg-white/5 hover:bg-white/10 text-white font-bold uppercase rounded-xl text-xs transition-colors select-none">
                    Cancel
                </button>
                <button type="button" id="send-reply-btn"
                    class="px-6 py-2.5 bg-amber-400 hover:bg-amber-300 text-black font-bold uppercase rounded-xl text-xs transition-all flex items-center justify-center gap-2 active:scale-95 select-none">
                    <span id="send-reply-text">Send Reply</span>
                    <svg id="send-reply-spinner" class="w-4 h-4 animate-spin hidden" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Footer Area -->
    <footer class="relative z-10 w-full text-center py-6 border-t border-white/10 bg-black/40 text-xs text-gray-400 shrink-0">
        <p>© 2026 Dr. Ifeanyi Chukwuma Odii. Admin Console.</p>
    </footer>

    <!-- Admin Interactive Script -->
    <script>
        // --- REPLY MODAL LOGIC ---
        const replyModal = document.getElementById('reply-modal');
        const modalClientName = document.getElementById('modal-client-name');
        const modalClientEmail = document.getElementById('modal-client-email');
        const modalInquiryId = document.getElementById('modal-inquiry-id');
        const replyMessage = document.getElementById('reply-message');
        const sendReplyBtn = document.getElementById('send-reply-btn');
        const sendReplyText = document.getElementById('send-reply-text');
        const sendReplySpinner = document.getElementById('send-reply-spinner');

        function openReplyModal(id, name, email) {
            modalInquiryId.value = id;
            modalClientName.textContent = name;
            modalClientEmail.textContent = email;
            replyMessage.value = '';
            replyModal.classList.remove('hidden');
            replyMessage.focus();
        }

        function closeReplyModal() {
            replyModal.classList.add('hidden');
        }

        sendReplyBtn.addEventListener('click', async function () {
            const id = modalInquiryId.value;
            const message = replyMessage.value;

            if (!message.trim()) {
                alert('Please draft a response message before sending.');
                return;
            }

            // Set button loader state
            sendReplySpinner.classList.remove('hidden');
            sendReplyText.textContent = 'Sending...';
            sendReplyBtn.disabled = true;

            try {
                const response = await fetch(`/api/contacts/${id}/reply`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        reply: message
                    })
                });

                // Add brief delay for premium loader experience
                await new Promise(resolve => setTimeout(resolve, 800));

                if (response.ok) {
                    closeReplyModal();
                    // Reload the page to seamlessly render the updated replies list and histories on the card
                    window.location.reload();
                } else {
                    alert('Failed to send reply. Please try again.');
                }
            } catch (error) {
                alert('A gateway connection error occurred. Please try again.');
            } finally {
                // Reset button loader state
                sendReplySpinner.classList.add('hidden');
                sendReplyText.textContent = 'Send Reply';
                sendReplyBtn.disabled = false;
            }
        });

        // --- DELETION / ARCHIVING LOGIC ---
        async function archiveContact(id) {
            if (!confirm(`Are you sure you want to archive and permanently delete inquiry ${id}?`)) {
                return;
            }

            try {
                const response = await fetch(`/api/contacts/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                });

                if (response.ok) {
                    const card = document.getElementById(`card-${id}`);
                    if (card) {
                        // Add class to animate slide out
                        card.classList.add('slide-out');

                        // Wait for animation to finish, then fully remove from DOM
                        setTimeout(() => {
                            card.remove();

                            // Update the total inquiry counter dynamically
                            const counterEl = document.getElementById('stats-total-count');
                            if (counterEl) {
                                const currentCount = parseInt(counterEl.textContent);
                                const newCount = Math.max(0, currentCount - 1);
                                counterEl.textContent = newCount;

                                // Reload page to show empty state if total count reaches 0
                                if (newCount === 0) {
                                    window.location.reload();
                                }
                            }
                        }, 500);
                } else {
                    alert('Failed to archive inquiry. Please try again.');
                }
            } catch (error) {
                alert('A gateway connection error occurred. Please try again.');
            }
        }

        // --- DASHBOARD TAB SWITCHING ---
        function switchDashboardTab(tab) {
            const vView = document.getElementById('view-volunteers');
            const cView = document.getElementById('view-contacts');
            const vBtn = document.getElementById('tab-btn-volunteers');
            const cBtn = document.getElementById('tab-btn-contacts');

            if (tab === 'volunteers') {
                if (vView) vView.classList.remove('hidden');
                if (cView) cView.classList.add('hidden');
                if (vBtn) vBtn.className = 'px-5 py-2.5 rounded-xl font-bold text-xs uppercase tracking-wider transition-all bg-amber-400 text-black shadow-lg shadow-amber-400/20 flex items-center gap-2 cursor-pointer';
                if (cBtn) cBtn.className = 'px-5 py-2.5 rounded-xl font-bold text-xs uppercase tracking-wider transition-all bg-white/5 text-gray-400 hover:text-white hover:bg-white/10 flex items-center gap-2 cursor-pointer';
            } else {
                if (cView) cView.classList.remove('hidden');
                if (vView) vView.classList.add('hidden');
                if (cBtn) cBtn.className = 'px-5 py-2.5 rounded-xl font-bold text-xs uppercase tracking-wider transition-all bg-amber-400 text-black shadow-lg shadow-amber-400/20 flex items-center gap-2 cursor-pointer';
                if (vBtn) vBtn.className = 'px-5 py-2.5 rounded-xl font-bold text-xs uppercase tracking-wider transition-all bg-white/5 text-gray-400 hover:text-white hover:bg-white/10 flex items-center gap-2 cursor-pointer';
            }
        }

        // --- FILTER VOLUNTEERS TABLE ---
        function filterVolunteersTable() {
            const query = (document.getElementById('volunteer-search-input')?.value || '').toLowerCase();
            const rows = document.querySelectorAll('#volunteers-table-body tr');
            rows.forEach(row => {
                const text = row.textContent.toLowerCase();
                row.style.display = text.includes(query) ? '' : 'none';
            });
        }
    </script>

</body>

</html>
