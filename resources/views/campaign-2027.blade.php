<!DOCTYPE html>
<html lang="en" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ANYI GA EMEYA 2027 • Official Digital Campaign War Room | Dr. Ifeanyi Chukwuma Odii</title>
    <meta name="description"
        content="The official election campaign and voter mobilization headquarters for Dr. Ifeanyi Chukwuma Odii (Anyichuks) for Ebonyi State 2027. Ground game, AI media war room, interactive manifesto, PU finder, and ambassador network.">
    <link rel="icon" type="image/jpeg" href="{{ asset('images/favicon.jpg') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800;900&family=Cinzel:wght@600;700;800;900&display=swap" rel="stylesheet">

    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        brand: {
                            gold: '#F59E0B',
                            lightGold: '#FDE68A',
                            darkGold: '#D97706',
                            emerald: '#10B981',
                            charcoal: '#0F1117',
                            card: '#161922',
                            border: 'rgba(255, 255, 255, 0.08)'
                        }
                    },
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'sans-serif'],
                        serif: ['"Cinzel"', 'serif'],
                    }
                }
            }
        }
    </script>

    <style>
        body {
            background-color: #0A0C10;
            color: #F3F4F6;
            font-family: 'Plus Jakarta Sans', sans-serif;
            overflow-x: hidden;
        }

        .gold-gradient-text {
            background: linear-gradient(135deg, #FDE68A 0%, #F59E0B 50%, #D97706 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .gold-btn {
            background: linear-gradient(135deg, #F59E0B 0%, #D97706 100%) !important;
            color: #000000 !important;
            font-weight: 800 !important;
            box-shadow: 0 10px 25px -5px rgba(245, 158, 11, 0.4) !important;
            transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .gold-btn:hover {
            background: linear-gradient(135deg, #FBBF24 0%, #F59E0B 100%) !important;
            transform: translateY(-2px);
            box-shadow: 0 15px 30px -5px rgba(245, 158, 11, 0.6) !important;
        }

        .glass-card {
            background: rgba(22, 25, 34, 0.75);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.08);
        }

        .glass-card-hover {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .glass-card-hover:hover {
            border-color: rgba(245, 158, 11, 0.35);
            transform: translateY(-4px);
            box-shadow: 0 20px 40px -15px rgba(0, 0, 0, 0.8), 0 0 25px -5px rgba(245, 158, 11, 0.15);
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }
        ::-webkit-scrollbar-track {
            background: #0A0C10;
        }
        ::-webkit-scrollbar-thumb {
            background: #272B38;
            border-radius: 4px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #F59E0B;
        }

        .pulse-gold {
            box-shadow: 0 0 0 0 rgba(245, 158, 11, 0.7);
            animation: pulse-gold-anim 2s infinite;
        }

        @keyframes pulse-gold-anim {
            0% {
                transform: scale(0.95);
                box-shadow: 0 0 0 0 rgba(245, 158, 11, 0.7);
            }
            70% {
                transform: scale(1);
                box-shadow: 0 0 0 12px rgba(245, 158, 11, 0);
            }
            100% {
                transform: scale(0.95);
                box-shadow: 0 0 0 0 rgba(245, 158, 11, 0);
            }
        }

        /* Bidirectional Touch & Mouse Scrolling for AI Container */
        #ai-chat-window {
            height: 380px !important;
            max-height: 380px !important;
            overflow-y: scroll !important;
            -webkit-overflow-scrolling: touch !important;
            touch-action: pan-y !important;
            overscroll-behavior-y: contain !important;
        }
        #ai-chat-window::-webkit-scrollbar {
            width: 6px;
        }
        #ai-chat-window::-webkit-scrollbar-thumb {
            background: #F59E0B;
            border-radius: 4px;
        }
        #site-bg-image-campaign {
            transition: object-position 0.6s cubic-bezier(0.25, 1, 0.5, 1);
            will-change: object-position;
        }
        @media (orientation: landscape) and (max-height: 550px) {
            header {
                height: 56px !important;
            }
            #site-fixed-bg img {
                object-position: center 20% !important;
            }
        }
    </style>
</head>

<body class="antialiased selection:bg-amber-400 selection:text-black min-h-screen relative flex flex-col justify-between bg-[#0A0C10]">

    <!-- Dedicated Fixed Crisp Background (Hardware Accelerated, 100% Mobile Compatible, Zero Scaling Blur) -->
    <div id="site-fixed-bg" class="fixed inset-0 w-full h-full -z-50 pointer-events-none overflow-hidden select-none" aria-hidden="true">
        <img id="site-bg-image-campaign"
             src="{{ asset('images/landing-profile.png') }}?v={{ file_exists(public_path('images/landing-profile.png')) ? filemtime(public_path('images/landing-profile.png')) : time() }}"
             alt="Dr. Ifeanyi Chukwuma Odii - ANYI GA EMEYA 2027 PDP Flagship"
             class="w-full h-full object-cover transform-gpu"
             style="image-rendering: -webkit-optimize-contrast; object-position: center 25%;">
    </div>

    <!-- Top Campaign Marquee Alert Ticker -->
    <div class="bg-gradient-to-r from-amber-600 via-amber-500 to-amber-600 text-black py-2 px-4 text-xs font-black tracking-widest uppercase flex items-center justify-between border-b border-amber-300/40 z-50 relative">
        <div class="flex items-center gap-2 overflow-hidden whitespace-nowrap w-full">
            <span class="flex h-2 w-2 relative flex-shrink-0">
                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-black opacity-75"></span>
                <span class="relative inline-flex rounded-full h-2 w-2 bg-black"></span>
            </span>
            <div class="marquee-text flex gap-8 animate-pulse text-[11px] tracking-wider">
                <span>⚡ ANYI GA EMEYA 2027 OFFICIAL DIGITAL PLATFORM ACTIVE</span>
                <span>•</span>
                <span>13 LGAs • 171 WARDS • 2,946 POLLING UNITS MOBILIZING FOR DR. IFEANYI CHUKWUMA ODII</span>
                <span>•</span>
                <span>JOIN OVER 24,800 VERIFIED GRASSROOTS AMBASSADORS</span>
                <span>•</span>
                <span>THE ECONOMIC REBIRTH OF EBONYI STATE</span>
            </div>
        </div>
        <a href="#pillar-ambassadors" class="hidden md:inline-flex items-center gap-1 bg-black text-amber-400 px-3 py-1 rounded-full text-[10px] font-bold hover:bg-zinc-900 transition-colors flex-shrink-0 ml-4">
            Claim Badge &rarr;
        </a>
    </div>

    <!-- Main Navigation Header -->
    <header class="sticky top-0 z-40 bg-[#0A0C10]/90 backdrop-blur-xl border-b border-white/10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-20 flex items-center justify-between">
            <!-- Brand Logo -->
            <a href="/campaign-2027" class="flex items-center gap-3 group">
                <div class="w-11 h-11 rounded-xl bg-gradient-to-br from-amber-400 to-amber-600 p-0.5 shadow-lg shadow-amber-500/20 group-hover:scale-105 transition-transform">
                    <div class="w-full h-full bg-black rounded-[10px] flex items-center justify-center">
                        <span class="font-serif font-black text-amber-400 text-lg tracking-tighter">AG</span>
                    </div>
                </div>
                <div>
                    <div class="flex items-center gap-2">
                        <span class="font-black text-lg tracking-tight text-white group-hover:text-amber-400 transition-colors">ANYI GA EMEYA</span>
                        <span class="px-2 py-0.5 bg-amber-400/20 border border-amber-400/50 rounded-md text-amber-400 text-[10px] font-extrabold tracking-widest">2027</span>
                    </div>
                    <p class="text-[10px] font-medium text-gray-400 tracking-wider">DR. IFEANYI CHUKWUMA ODII • CAMPAIGN WAR ROOM</p>
                </div>
            </a>

            <!-- Pillar Navigation Links -->
            <nav class="hidden lg:flex items-center gap-7 text-xs font-semibold uppercase tracking-wider text-gray-300">
                <a href="#pillar-war-room" class="hover:text-amber-400 transition-colors flex items-center gap-1.5">
                    <span class="text-amber-400 font-mono">01.</span> Media Defense
                </a>
                <a href="#pillar-ai-townhall" class="hover:text-amber-400 transition-colors flex items-center gap-1.5">
                    <span class="text-amber-400 font-mono">02.</span> AI Town Hall
                </a>
                <a href="#pillar-manifesto" class="hover:text-amber-400 transition-colors flex items-center gap-1.5">
                    <span class="text-amber-400 font-mono">03.</span> Governance Blueprint
                </a>
                <a href="#pillar-ambassadors" class="hover:text-amber-400 transition-colors flex items-center gap-1.5">
                    <span class="text-amber-400 font-mono">04.</span> Ambassadors
                </a>
            </nav>

            <!-- Actions -->
            <div class="flex items-center gap-2 sm:gap-3">
                <a href="/" class="hidden sm:inline-flex items-center gap-1 text-xs text-gray-400 hover:text-white px-3 py-2 rounded-lg border border-white/10 hover:border-white/20 transition-colors">
                    &larr; Portfolio Site
                </a>
                <a href="#pillar-ambassadors"
                    class="gold-btn px-4 sm:px-5 py-2 sm:py-2.5 rounded-xl text-[11px] sm:text-xs font-extrabold uppercase tracking-wider flex items-center gap-1.5 cursor-pointer shadow-lg shadow-amber-500/20">
                    <span>Join Movement</span>
                    <span class="text-sm">&rarr;</span>
                </a>

                <!-- Mobile Menu Hamburger Button -->
                <button type="button" onclick="window.toggleMobileCampaignNav()" id="mobile-campaign-nav-toggle"
                    class="lg:hidden p-2 rounded-xl bg-white/10 hover:bg-white/20 text-white transition-colors flex items-center justify-center cursor-pointer border border-white/15 ml-1"
                    aria-label="Toggle Mobile Navigation Menu">
                    <svg id="c-hamburger-icon" class="w-5 h-5 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                    <svg id="c-close-icon" class="w-5 h-5 hidden text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
        </div>
    </header>

    <!-- Full Mobile Navigation Drawer for Campaign 2027 -->
    <div id="mobile-campaign-nav-drawer" class="fixed inset-0 z-[100] bg-[#0A0C10]/98 backdrop-blur-2xl transition-all duration-300 opacity-0 pointer-events-none flex flex-col justify-between overflow-y-auto" style="display: none;">
        <!-- Top Bar -->
        <div class="px-5 py-4 border-b border-white/10 flex items-center justify-between bg-black/70 sticky top-0 z-10 backdrop-blur-md">
            <a href="/" class="text-lg font-bold tracking-wider text-white uppercase">
                ANYI GA EMEYA <span class="text-amber-400">2027</span>
            </a>
            <button type="button" onclick="window.toggleMobileCampaignNav()" class="w-9 h-9 rounded-full bg-white/10 hover:bg-red-500/20 text-gray-300 hover:text-white flex items-center justify-center font-bold text-lg cursor-pointer transition-colors" aria-label="Close Mobile Menu">
                ✕
            </button>
        </div>

        <!-- Links List -->
        <div class="p-5 sm:p-6 flex flex-col gap-3">
            <span class="text-[10px] font-bold uppercase tracking-widest text-amber-400">Main Site Navigation</span>

            <a href="/" onclick="window.closeMobileCampaignNav()" class="flex items-center justify-between p-3.5 rounded-xl bg-white/5 hover:bg-white/10 border border-white/10 text-white font-semibold transition-all">
                <span class="flex items-center gap-3">
                    <span class="text-base">🏠</span>
                    <span>Home & Executive Profile</span>
                </span>
                <span class="text-gray-400 text-xs">&rarr;</span>
            </a>

            <a href="/#section-philanthropist" onclick="window.closeMobileCampaignNav()" class="flex items-center justify-between p-3.5 rounded-xl bg-white/5 hover:bg-white/10 border border-white/10 text-white font-semibold transition-all">
                <span class="flex items-center gap-3">
                    <span class="text-base">🤝</span>
                    <span>A Philanthropist</span>
                </span>
                <span class="text-gray-400 text-xs">&rarr;</span>
            </a>

            <a href="/#section-news" onclick="window.closeMobileCampaignNav()" class="flex items-center justify-between p-3.5 rounded-xl bg-white/5 hover:bg-white/10 border border-white/10 text-white font-semibold transition-all">
                <span class="flex items-center gap-3">
                    <span class="text-base">📰</span>
                    <span>NEWS</span>
                </span>
                <span class="text-gray-400 text-xs">&rarr;</span>
            </a>

            <a href="/campaign-2027" class="flex items-center justify-between p-3.5 rounded-xl bg-gradient-to-r from-amber-500/20 to-amber-600/10 border border-amber-400/50 text-amber-300 font-bold transition-all shadow-lg shadow-amber-500/10">
                <span class="flex items-center gap-3">
                    <span class="w-2.5 h-2.5 rounded-full bg-amber-400 animate-pulse"></span>
                    <span>• 2027 Campaign (War Room Active)</span>
                </span>
                <span class="px-2 py-0.5 rounded-md bg-amber-400 text-black text-[10px] font-black uppercase">Current</span>
            </a>

            <a href="/contact" onclick="window.closeMobileCampaignNav()" class="flex items-center justify-between p-3.5 rounded-xl bg-white/5 hover:bg-white/10 border border-white/10 text-white font-semibold transition-all">
                <span class="flex items-center gap-3">
                    <span class="text-base">📞</span>
                    <span>Contact Official Office</span>
                </span>
                <span class="text-gray-400 text-xs">&rarr;</span>
            </a>

            <!-- Big Golden Action -->
            <a href="#pillar-ambassadors" onclick="window.closeMobileCampaignNav()"
                class="w-full mt-2 py-3.5 px-5 bg-gradient-to-r from-amber-400 via-amber-300 to-amber-500 text-black font-black uppercase tracking-wider rounded-2xl shadow-xl shadow-amber-500/30 flex items-center justify-center gap-2 text-sm cursor-pointer active:scale-[0.98] transition-all">
                <span class="w-2 h-2 rounded-full bg-black animate-ping"></span>
                <span>JOIN 2027 MOVEMENT</span>
            </a>

            <!-- Social Media Hub -->
            <div class="mt-4 pt-4 border-t border-white/10 flex flex-col gap-2">
                <span class="text-[10px] font-bold uppercase tracking-widest text-gray-400">Official Social Handles</span>
                <div class="grid grid-cols-2 gap-2">
                    <a href="https://x.com/ifeanyiCodii" target="_blank" rel="noopener noreferrer" class="flex items-center gap-2.5 p-2.5 rounded-xl bg-white/5 border border-white/10 text-xs text-white hover:border-amber-400 transition-colors">
                        <svg class="w-4 h-4 text-amber-400 shrink-0" fill="currentColor" viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 22.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"></path></svg>
                        <span class="font-medium truncate">𝕏 (Twitter)</span>
                    </a>
                    <a href="https://www.instagram.com/ifeanyicodii/" target="_blank" rel="noopener noreferrer" class="flex items-center gap-2.5 p-2.5 rounded-xl bg-white/5 border border-white/10 text-xs text-white hover:border-amber-400 transition-colors">
                        <svg class="w-4 h-4 text-pink-400 shrink-0" fill="currentColor" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z" clip-rule="evenodd"></path></svg>
                        <span class="font-medium truncate">Instagram</span>
                    </a>
                    <a href="https://web.facebook.com/ifeanyiCodii/?_rdc=1&_rdr" target="_blank" rel="noopener noreferrer" class="flex items-center gap-2.5 p-2.5 rounded-xl bg-white/5 border border-white/10 text-xs text-white hover:border-amber-400 transition-colors">
                        <svg class="w-4 h-4 text-blue-400 shrink-0" fill="currentColor" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" clip-rule="evenodd"></path></svg>
                        <span class="font-medium truncate">Facebook</span>
                    </a>
                    <a href="https://www.tiktok.com/@ifeanyicodii" target="_blank" rel="noopener noreferrer" class="flex items-center gap-2.5 p-2.5 rounded-xl bg-white/5 border border-white/10 text-xs text-white hover:border-amber-400 transition-colors">
                        <svg class="w-4 h-4 text-cyan-400 shrink-0" fill="currentColor" viewBox="0 0 24 24"><path d="M12.525.02c1.31-.02 2.61-.01 3.91-.02.08 1.53.63 3.09 1.75 4.17 1.12 1.11 2.7 1.62 4.24 1.79v4.03c-1.44-.05-2.89-.35-4.2-.97-.57-.26-1.1-.59-1.62-.93-.01 2.92.01 5.84-.02 8.75-.08 2.23-1.15 4.39-2.92 5.86-1.57 1.3-3.66 1.94-5.69 1.7-2.12-.23-4.06-1.3-5.32-2.93-1.39-1.78-1.92-4.14-1.42-6.32.48-2.17 1.87-4.07 3.8-5.11 2.01-1.07 4.43-1.22 6.6-.47v4.15c-1.16-.36-2.45-.41-3.63-.04-1.12.35-2.09 1.11-2.6 2.16-.54 1.12-.59 2.44-.15 3.59.45 1.2 1.48 2.15 2.72 2.49 1.28.36 2.69.19 3.84-.46 1.19-.69 1.99-1.91 2.18-3.26.23-1.48.16-2.98.17-4.47V.02z"></path></svg>
                        <span class="font-medium truncate">TikTok</span>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- HERO WAR ROOM COMMAND SECTION -->
    <section class="relative pt-12 pb-20 md:pt-20 md:pb-32 overflow-hidden">
        <!-- Background Gradients & Grid Pattern -->
        <div class="absolute inset-0 bg-[radial-gradient(#f59e0b_1px,transparent_1px)] [background-size:32px_32px] opacity-[0.04] pointer-events-none"></div>
        <div class="absolute top-1/4 -left-48 w-96 h-96 bg-amber-500/10 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute top-1/3 -right-48 w-96 h-96 bg-emerald-500/10 rounded-full blur-3xl pointer-events-none"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
                <!-- Left: Master Campaign Message -->
                <div class="lg:col-span-7 space-y-6">
                    <div class="inline-flex items-center gap-2.5 px-4 py-1.5 rounded-full bg-amber-400/10 border border-amber-400/30">
                        <span class="w-2 h-2 rounded-full bg-amber-400 animate-ping"></span>
                        <span class="text-amber-400 text-xs font-bold uppercase tracking-widest">
                            2027 ELECTION VICTORY ENGINE • LIVE
                        </span>
                    </div>

                    <h1 class="text-4xl sm:text-5xl md:text-6xl font-extrabold text-white tracking-tight leading-[1.1]">
                        Transforming Ebonyi Into An <br class="hidden sm:inline">
                        <span class="gold-gradient-text">Economic Powerhouse.</span>
                    </h1>

                    <p class="text-base sm:text-lg text-gray-300 font-light leading-relaxed max-w-2xl">
                        Elections are won on the ground through data, truth, and unified grassroots force.
                        Dr. Ifeanyi Chukwuma Odii’s 2027 Digital Campaign Platform integrates real-time narrative defense,
                        bilingual AI voter intelligence, and verifiable industrial blueprints across all 13 LGAs.
                    </p>

                    <!-- Real-Time Metrics Badges -->
                    <div class="grid grid-cols-3 gap-3 sm:gap-4 pt-2">
                        <div class="glass-card p-4 rounded-2xl border-l-4 border-l-amber-400">
                            <div class="text-2xl sm:text-3xl font-black text-white font-mono" id="hero-ambassador-count">24,819</div>
                            <div class="text-[10px] sm:text-xs text-gray-400 uppercase tracking-wider font-semibold mt-1">Ambassadors Joined</div>
                        </div>
                        <div class="glass-card p-4 rounded-2xl border-l-4 border-l-emerald-400">
                            <div class="text-2xl sm:text-3xl font-black text-white font-mono">13 / 13</div>
                            <div class="text-[10px] sm:text-xs text-gray-400 uppercase tracking-wider font-semibold mt-1">LGAs Mobilized</div>
                        </div>
                        <div class="glass-card p-4 rounded-2xl border-l-4 border-l-cyan-400">
                            <div class="text-2xl sm:text-3xl font-black text-white font-mono">140+</div>
                            <div class="text-[10px] sm:text-xs text-gray-400 uppercase tracking-wider font-semibold mt-1">Free Built Homes</div>
                        </div>
                    </div>

                    <!-- Quick War Room Buttons -->
                    <div class="flex flex-wrap gap-4 pt-4">
                        <a href="#pillar-manifesto"
                            class="gold-btn px-7 py-4 rounded-xl text-sm font-extrabold uppercase tracking-wider flex items-center gap-3">
                            <svg class="w-5 h-5 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                            <span>Explore Governance Blueprint</span>
                        </a>

                        <a href="#pillar-ai-townhall"
                            class="px-6 py-4 rounded-xl glass-card text-white hover:text-amber-400 hover:border-amber-400/40 text-sm font-bold uppercase tracking-wider transition-all flex items-center gap-2.5">
                            <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                            <span>Ask Anyichuks AI</span>
                        </a>

                        <a href="https://wa.me/2348000000000?text=Ndewo%20Dr%20Odii!%20ANYI%20GA%20EMEYA%202027" target="_blank"
                            class="px-6 py-4 rounded-xl bg-emerald-500/20 border border-emerald-400/40 text-emerald-300 hover:bg-emerald-500/30 text-sm font-bold uppercase tracking-wider transition-all flex items-center gap-2">
                            <span>WhatsApp Hotline</span>
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981z"/>
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- Right: High-Impact Candidate War Room Card -->
                <div class="lg:col-span-5">
                    <div class="relative rounded-3xl overflow-hidden glass-card p-2 border-2 border-amber-400/30 shadow-2xl">
                        <div class="relative rounded-2xl overflow-hidden bg-gradient-to-t from-black via-zinc-900 to-zinc-950">
                            <img src="{{ asset('images/landing-profile.png') }}?v={{ file_exists(public_path('images/landing-profile.png')) ? filemtime(public_path('images/landing-profile.png')) : time() }}"
                                alt="Dr. Ifeanyi Chukwuma Odii - ANYI GA EMEYA 2027 PDP Flagship"
                                class="w-full h-[480px] object-cover object-top opacity-100 hover:scale-105 transition-transform duration-700">

                            <div class="absolute inset-0 bg-gradient-to-t from-[#0A0C10] via-transparent to-transparent"></div>

                            <!-- Bottom Floating Credential -->
                            <div class="absolute bottom-4 left-4 right-4 p-5 rounded-2xl bg-black/85 backdrop-blur-md border border-white/15 space-y-2">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <h3 class="text-xl font-bold text-white">Dr. Ifeanyi Chukwuma Odii</h3>
                                        <p class="text-xs text-amber-400 font-semibold tracking-wide">"Anyichuks" • PDP Gubernatorial Candidate 2027</p>
                                    </div>
                                    <span class="px-2.5 py-1 rounded-full bg-emerald-500/20 border border-emerald-400/50 text-emerald-400 text-[10px] font-extrabold uppercase tracking-wider">
                                        Verified Leadership
                                    </span>
                                </div>
                                <div class="grid grid-cols-2 gap-2 pt-2 border-t border-white/10 text-[11px] text-gray-300">
                                    <div>• Built 140+ Free Modern Homes</div>
                                    <div>• 1,000+ Full University Grants</div>
                                    <div>• Orient Global & Ultimus CEO</div>
                                    <div>• 20+ Years Proven Enterprise</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- SECTION NAV STICKY SUB-BAR -->
    <div class="border-y border-white/10 bg-[#0F121A]/95 backdrop-blur-md sticky top-20 z-30 overflow-x-auto py-3 px-4">
        <div class="max-w-7xl mx-auto flex items-center justify-between gap-4 min-w-[760px]">
            <div class="flex items-center gap-2 text-xs font-extrabold text-amber-400 tracking-wider">
                <span class="w-2 h-2 rounded-full bg-amber-400 animate-pulse"></span>
                THE 4 STRATEGIC CAMPAIGN PILLARS:
            </div>
            <div class="flex items-center gap-4 text-xs font-semibold text-gray-300">
                <a href="#pillar-war-room" class="hover:text-amber-400 transition-colors py-1 px-3 rounded-lg hover:bg-white/5">Pillar 1: Media Intelligence & Defense</a>
                <a href="#pillar-ai-townhall" class="hover:text-amber-400 transition-colors py-1 px-3 rounded-lg hover:bg-white/5">Pillar 2: AI Town Hall & WhatsApp</a>
                <a href="#pillar-manifesto" class="hover:text-amber-400 transition-colors py-1 px-3 rounded-lg hover:bg-white/5">Pillar 3: Governance Blueprint</a>
                <a href="#pillar-ambassadors" class="hover:text-amber-400 transition-colors py-1 px-3 rounded-lg hover:bg-white/5">Pillar 4: Ambassadors Club</a>
            </div>
        </div>
    </div>

    <!-- ========================================================================= -->
    <!-- PILLAR 1: AI MEDIA INTELLIGENCE & CRISIS WAR ROOM -->
    <!-- ========================================================================= -->
    <section id="pillar-war-room" class="py-24 relative border-b border-white/10 bg-black/40">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row md:items-end justify-between mb-12 gap-6">
                <div>
                    <div class="flex items-center gap-2 text-amber-400 text-xs font-extrabold uppercase tracking-widest mb-2">
                        <span class="font-mono text-base">01.</span> AI Media Intelligence & Rapid Response System
                    </div>
                    <h2 class="text-3xl sm:text-4xl font-extrabold text-white tracking-tight">
                        Real-Time Narrative Defense & <span class="gold-gradient-text">Instant Rebuttal Kits</span>
                    </h2>
                    <p class="text-gray-400 text-sm sm:text-base mt-2 max-w-2xl">
                        Protecting the campaign against propaganda and misinformation. 1-click verified talking points,
                        fact-check kits, and automated social sentiment monitoring.
                    </p>
                </div>

                <div class="flex items-center gap-3">
                    <a href="/press" class="px-4 py-2.5 rounded-xl bg-amber-400/20 border border-amber-400/40 text-amber-300 hover:bg-amber-400/30 text-xs font-bold uppercase tracking-wider transition-colors">
                        Spokesperson Kit &rarr;
                    </a>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Rebuttal Kit 1 -->
                <div class="glass-card glass-card-hover p-6 rounded-3xl space-y-4 border-t-2 border-t-emerald-400">
                    <div class="flex justify-between items-center text-xs">
                        <span class="px-2.5 py-1 rounded-full bg-emerald-500/20 text-emerald-400 font-bold uppercase text-[10px]">Fact Check • Verified</span>
                        <span class="text-gray-500 text-[11px]">Updated 2h ago</span>
                    </div>
                    <h4 class="font-bold text-white text-base leading-snug">
                        Narrative: "Are Dr. Odii's business investments outside of Ebonyi?"
                    </h4>
                    <p class="text-xs text-gray-300 leading-relaxed">
                        <strong class="text-amber-400">The Verified Fact:</strong> Dr. Odii has already built over 140 free modern homes, awarded 1,000+ scholarships, and established agro-processing centers right inside Ebonyi communities as a private citizen. His 2027 plan replicates the Orient Global industrial model directly in Ebonyi.
                    </p>
                    <div class="pt-2 border-t border-white/10 flex items-center justify-between">
                        <button onclick="window.copyRebuttal(this, 'FACT CHECK: Dr. Ifeanyi Chukwuma Odii has already invested hundreds of millions as a private citizen in Ebonyi—building 140+ free homes for widows, funding 1,000+ university scholarships, and creating agro-jobs. Imagine what he will accomplish with state governance!')"
                            class="text-xs font-bold text-amber-400 hover:text-amber-300 flex items-center gap-1.5 cursor-pointer">
                            <span>📋 Copy Talking Point</span>
                        </button>
                        <a href="https://api.whatsapp.com/send?text=FACT%20CHECK%202027:%20Dr.%20Ifeanyi%20Chukwuma%20Odii%20has%20already%20built%20140+%20free%20homes%20and%201,000+%20scholarships%20in%20Ebonyi.%20Read%20more:%20https://anyigaemeya.org/campaign-2027" target="_blank"
                            class="text-xs font-bold text-emerald-400 hover:text-emerald-300 flex items-center gap-1">
                            <span>Share to WhatsApp &rarr;</span>
                        </a>
                    </div>
                </div>

                <!-- Rebuttal Kit 2 -->
                <div class="glass-card glass-card-hover p-6 rounded-3xl space-y-4 border-t-2 border-t-amber-400">
                    <div class="flex justify-between items-center text-xs">
                        <span class="px-2.5 py-1 rounded-full bg-amber-500/20 text-amber-400 font-bold uppercase text-[10px]">Civil Service • Policy</span>
                        <span class="text-gray-500 text-[11px]">Policy Commitment</span>
                    </div>
                    <h4 class="font-bold text-white text-base leading-snug">
                        Narrative: "What is Anyichuks' guarantee on civil service salaries and pensions?"
                    </h4>
                    <p class="text-xs text-gray-300 leading-relaxed">
                        <strong class="text-amber-400">The Sacred Vow:</strong> No cosmetics over human welfare. Dr. Odii commits to prompt 25th-of-the-month salary payments, full backlog pension clearance, and merit-based promotion in the first 100 days.
                    </p>
                    <div class="pt-2 border-t border-white/10 flex items-center justify-between">
                        <button onclick="window.copyRebuttal(this, 'POLICY PLEDGE 2027: Dr. Ifeanyi Odii has given his sacred word: human welfare comes before cosmetic projects. Salaries will be paid on the 25th, backlogged pensions settled, and civil service dignity restored in Ebonyi State.')"
                            class="text-xs font-bold text-amber-400 hover:text-amber-300 flex items-center gap-1.5 cursor-pointer">
                            <span>📋 Copy Talking Point</span>
                        </button>
                        <a href="https://api.whatsapp.com/send?text=POLICY%20PLEDGE%202027:%20Salaries%20on%20the%2025th,%20pension%20backlogs%20cleared,%20and%20civil%20servants%20dignified%20by%20Dr.%20Odii:%20https://anyigaemeya.org/campaign-2027" target="_blank"
                            class="text-xs font-bold text-emerald-400 hover:text-emerald-300 flex items-center gap-1">
                            <span>Share to WhatsApp &rarr;</span>
                        </a>
                    </div>
                </div>

                <!-- Rebuttal Kit 3 -->
                <div class="glass-card glass-card-hover p-6 rounded-3xl space-y-4 border-t-2 border-t-cyan-400">
                    <div class="flex justify-between items-center text-xs">
                        <span class="px-2.5 py-1 rounded-full bg-cyan-500/20 text-cyan-400 font-bold uppercase text-[10px]">Youth & Tech • Blueprint</span>
                        <span class="text-gray-500 text-[11px]">Economic Vision</span>
                    </div>
                    <h4 class="font-bold text-white text-base leading-snug">
                        Narrative: "How will ANYI GA EMEYA solve youth unemployment?"
                    </h4>
                    <p class="text-xs text-gray-300 leading-relaxed">
                        <strong class="text-amber-400">The Blueprint:</strong> Creation of 3 Senatorial Technology & Creative Hubs (coding, robotics, AI, digital arts), combined with Orient Global vendor-financing grants for 10,000 Ebonyi youth entrepreneurs.
                    </p>
                    <div class="pt-2 border-t border-white/10 flex items-center justify-between">
                        <button onclick="window.copyRebuttal(this, 'YOUTH BLUEPRINT 2027: Dr. Odii is establishing 3 digital technology hubs across Ebonyi senatorial zones, alongside funding grants for 10,000 young entrepreneurs. Real enterprise skills, not temporary tokenism.')"
                            class="text-xs font-bold text-amber-400 hover:text-amber-300 flex items-center gap-1.5 cursor-pointer">
                            <span>📋 Copy Talking Point</span>
                        </button>
                        <a href="https://api.whatsapp.com/send?text=YOUTH%20BLUEPRINT%202027:%203%20Digital%20Hubs%20and%2010,000%20youth%20grants%20for%20Ebonyi%20under%20Dr.%20Odii:%20https://anyigaemeya.org/campaign-2027" target="_blank"
                            class="text-xs font-bold text-emerald-400 hover:text-emerald-300 flex items-center gap-1">
                            <span>Share to WhatsApp &rarr;</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ========================================================================= -->
    <!-- PILLAR 3: "ASK ANYICHUKS" AI TOWN HALL & WHATSAPP HOTLINE -->
    <!-- ========================================================================= -->
    <section id="pillar-ai-townhall" class="py-24 relative border-b border-white/10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
                <!-- Left: Chat UI connected to /api/ai-chat -->
                <div class="lg:col-span-7">
                    <div class="glass-card rounded-3xl overflow-hidden border border-amber-400/30 shadow-2xl">
                        <!-- Chat Header -->
                        <div class="p-5 bg-black/60 border-b border-white/10 flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-full bg-gradient-to-br from-amber-400 to-amber-600 p-0.5">
                                    <div class="w-full h-full bg-black rounded-full flex items-center justify-center text-amber-400 font-bold text-xs">
                                        AI
                                    </div>
                                </div>
                                <div>
                                    <div class="flex items-center gap-2">
                                        <h4 class="font-bold text-white text-sm">"Ask Anyichuks" AI Campaign Representative</h4>
                                        <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                                    </div>
                                    <p class="text-[11px] text-gray-400">Bilingual Engine • English & Asụsụ Igbo</p>
                                </div>
                            </div>
                            <span class="text-[11px] text-amber-400 font-mono font-bold">GEMINI POWERED</span>
                        </div>

                        <!-- Chat Messages Window (Scrollable up and down smoothly on touch and mouse) -->
                        <div id="ai-chat-window" class="p-4 sm:p-6 h-[380px] overflow-y-scroll space-y-4 text-sm" style="overflow-y: scroll !important; -webkit-overflow-scrolling: touch !important; touch-action: pan-y !important; overscroll-behavior-y: contain !important; scrollbar-width: thin; scrollbar-color: #F59E0B #161922;">
                            <!-- Bot Welcome -->
                            <div class="flex items-start gap-3">
                                <div class="w-8 h-8 rounded-full bg-amber-400/20 text-amber-400 flex items-center justify-center text-xs font-bold shrink-0 mt-0.5">
                                    Odii
                                </div>
                                <div class="bg-white/5 border border-white/10 p-4 rounded-2xl rounded-tl-none text-gray-200 text-xs sm:text-sm leading-relaxed max-w-full sm:max-w-xl space-y-2 break-words select-text">
                                    <p><strong>Ndewo! Welcome to the ANYI GA EMEYA 2027 AI Town Hall.</strong></p>
                                    <p>I am Dr. Ifeanyi Chukwuma Odii's executive AI representative. You can ask me any question in English or Igbo regarding his 2027 blueprints for roads, jobs, agriculture, civil service welfare, or his track record.</p>
                                </div>
                            </div>
                        </div>

                        <!-- Quick Question Chips (Horizontally touch scrollable on mobile) -->
                        <div class="p-3 bg-black/40 border-t border-white/5 flex gap-2 overflow-x-auto text-[11px] whitespace-nowrap" style="-webkit-overflow-scrolling: touch !important; touch-action: pan-x !important; scrollbar-width: none;">
                            <button type="button" onclick="window.sendQuickPrompt('What is Dr. Odii\'s plan for youth jobs and industrialization in Ebonyi?')"
                                class="cursor-pointer px-3 py-1.5 rounded-full bg-white/5 hover:bg-amber-400/20 hover:text-amber-300 border border-white/10 text-gray-300 transition-colors">
                                💼 Youth Jobs & Industry
                            </button>
                            <button type="button" onclick="window.sendQuickPrompt('Kedu atụmatụ Dr. Odii nwere maka ndị ọrụ gọọmentị na pensions?')"
                                class="cursor-pointer px-3 py-1.5 rounded-full bg-white/5 hover:bg-amber-400/20 hover:text-amber-300 border border-white/10 text-gray-300 transition-colors">
                                🇳🇬 Ndị Ọrụ Gọọmentị (Igbo)
                            </button>
                            <button type="button" onclick="window.sendQuickPrompt('How will Dr. Odii modernize agriculture and support Ebonyi rice farmers?')"
                                class="cursor-pointer px-3 py-1.5 rounded-full bg-white/5 hover:bg-amber-400/20 hover:text-amber-300 border border-white/10 text-gray-300 transition-colors">
                                🌾 Agriculture Grants
                            </button>
                            <button type="button" onclick="window.sendQuickPrompt('Tell me about the 140+ free houses built by Anyichuks Foundation.')"
                                class="cursor-pointer px-3 py-1.5 rounded-full bg-white/5 hover:bg-amber-400/20 hover:text-amber-300 border border-white/10 text-gray-300 transition-colors">
                                🏠 140+ Free Houses
                            </button>
                        </div>

                        <!-- Chat Input Box -->
                        <form id="ai-chat-form" action="javascript:void(0);" onsubmit="event.preventDefault(); event.stopPropagation(); window.submitAIChat(event); return false;" class="p-4 bg-black/60 border-t border-white/10 flex gap-2">
                            <input type="text" id="ai-user-input" autocomplete="off" required placeholder="Ask a question in English or Igbo..."
                                onkeydown="if(event.key === 'Enter') { event.preventDefault(); window.submitAIChat(event); return false; }"
                                class="flex-grow min-w-0 px-4 py-3 bg-black/50 border border-white/15 focus:border-amber-400 rounded-xl text-white text-xs sm:text-sm focus:outline-none transition-colors">
                            <button type="button" id="ai-send-btn" onclick="window.submitAIChat(event)"
                                class="gold-btn shrink-0 px-5 sm:px-6 py-3 rounded-xl text-xs font-black uppercase tracking-wider flex items-center gap-2 cursor-pointer select-none active:scale-95 transition-transform" style="touch-action: manipulation;">
                                <span id="ai-send-btn-text">Send</span>
                                <span id="ai-send-btn-arrow">&rarr;</span>
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Right: WhatsApp Campaign Hotline & SMS Rally Broadcast -->
                <div class="lg:col-span-5 space-y-6">
                    <div>
                        <div class="flex items-center gap-2 text-emerald-400 text-xs font-extrabold uppercase tracking-widest mb-2">
                            <span class="font-mono text-base">02.</span> Direct Grassroots Mobilization
                        </div>
                        <h2 class="text-3xl sm:text-4xl font-extrabold text-white tracking-tight">
                            WhatsApp War Room & <span class="gold-gradient-text">SMS Rally Alerts</span>
                        </h2>
                        <p class="text-gray-400 text-sm mt-2 leading-relaxed">
                            Grassroots momentum thrives on direct communication. Connect to our verified WhatsApp campaign line
                            or subscribe to real-time rally tour notifications.
                        </p>
                    </div>

                    <!-- WhatsApp Hotline Box -->
                    <div class="glass-card p-6 rounded-3xl border-2 border-emerald-500/40 space-y-4 relative overflow-hidden">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-2xl bg-emerald-500/20 border border-emerald-400/40 flex items-center justify-center text-emerald-400">
                                <svg class="w-7 h-7" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981z"/>
                                </svg>
                            </div>
                            <div>
                                <h4 class="text-lg font-bold text-white">WhatsApp Campaign Hotline</h4>
                                <p class="text-xs text-emerald-400 font-semibold">Text "Anyi Ga Emeya" for Daily Updates</p>
                            </div>
                        </div>
                        <p class="text-xs text-gray-300">
                            Get direct audio messages from Dr. Odii, verified campaign schedules, rally venues, and ward coordinator contacts on your phone.
                        </p>
                        <a href="https://wa.me/2348000000000?text=Ndewo%20Anyichuks!%20ANYI%20GA%20EMEYA%202027" target="_blank"
                            class="w-full py-3.5 px-6 rounded-xl bg-emerald-500 hover:bg-emerald-400 text-black font-extrabold text-xs uppercase tracking-wider transition-all flex items-center justify-center gap-2 shadow-lg shadow-emerald-500/30">
                            <span>Open WhatsApp Campaign Line</span>
                            <span class="text-sm">&rarr;</span>
                        </a>
                    </div>

                    <!-- SMS Tour Notification Signup Form -->
                    <form action="javascript:void(0);" onsubmit="event.preventDefault(); window.submitSMSSignup(event); return false;" class="glass-card p-6 rounded-3xl space-y-4 border border-white/10">
                        <div class="flex items-center justify-between">
                            <h4 class="text-sm font-bold text-white uppercase tracking-wider">SMS Tour & Rally Notifications</h4>
                            <span class="text-[10px] text-amber-400 font-semibold">Free Signup</span>
                        </div>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                            <input type="tel" id="sms-phone" required placeholder="Phone / WhatsApp (080...)"
                                class="px-3.5 py-2.5 bg-black/50 border border-white/15 focus:border-amber-400 rounded-xl text-white text-xs focus:outline-none">
                            <input type="text" id="sms-community" required placeholder="Your Town / Market / Ward"
                                class="px-3.5 py-2.5 bg-black/50 border border-white/15 focus:border-amber-400 rounded-xl text-white text-xs focus:outline-none">
                        </div>
                        <button type="submit" id="sms-btn"
                            class="w-full py-3 px-4 rounded-xl bg-amber-400 hover:bg-amber-300 text-black font-extrabold text-xs uppercase tracking-wider transition-colors cursor-pointer">
                            Alert Me When Anyichuks Visits My Area
                        </button>
                        <div id="sms-feedback" class="hidden text-xs text-emerald-400 font-medium text-center"></div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- ========================================================================= -->
    <!-- PILLAR 3: STRATEGIC GOVERNANCE BLUEPRINT & PHILANTHROPY PROOF MAP -->
    <!-- ========================================================================= -->
    <section id="pillar-manifesto" class="py-24 relative border-b border-white/10 bg-black/30">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-16 space-y-4">
                <div class="inline-flex items-center gap-2 text-amber-400 text-xs font-extrabold uppercase tracking-widest">
                    <span class="font-mono text-base">03.</span> Actionable Governance Blueprint
                </div>
                <h2 class="text-3xl sm:text-5xl font-extrabold text-white tracking-tight">
                    Strategic Blueprint 2027: <span class="gold-gradient-text">Sectoral Transformation Agendas</span>
                </h2>
                <p class="text-gray-400 text-sm sm:text-base">
                    A clear, battle-tested governance roadmap. Explore how Dr. Odii’s enterprise track record translates
                    into verifiable state-wide transformations across industry, youth tech, health, and agriculture.
                </p>
            </div>

            <!-- Sectoral Tabs (Mobile Responsive Grid & Touch Optimized) -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3 mb-10 w-full max-w-5xl mx-auto relative z-30" id="sector-tab-container">
                <button type="button" onclick="window.switchSectorTab('industry')" id="tab-industry"
                    class="cursor-pointer px-4 py-3 rounded-xl text-xs font-extrabold uppercase tracking-wider transition-all bg-amber-400 text-black shadow-lg shadow-amber-400/20 text-center flex items-center justify-center gap-2">
                    🏭 1. Job Creation & Industrialization
                </button>
                <button type="button" onclick="window.switchSectorTab('youth')" id="tab-youth"
                    class="cursor-pointer px-4 py-3 rounded-xl text-xs font-extrabold uppercase tracking-wider transition-all glass-card text-gray-300 hover:text-white text-center flex items-center justify-center gap-2">
                    💻 2. Education & Youth Tech
                </button>
                <button type="button" onclick="window.switchSectorTab('health')" id="tab-health"
                    class="cursor-pointer px-4 py-3 rounded-xl text-xs font-extrabold uppercase tracking-wider transition-all glass-card text-gray-300 hover:text-white text-center flex items-center justify-center gap-2">
                    🏥 3. Healthcare & Human Welfare
                </button>
                <button type="button" onclick="window.switchSectorTab('agric')" id="tab-agric"
                    class="cursor-pointer px-4 py-3 rounded-xl text-xs font-extrabold uppercase tracking-wider transition-all glass-card text-gray-300 hover:text-white text-center flex items-center justify-center gap-2">
                    🌾 4. Agriculture & Agro-Processing
                </button>
            </div>

            <!-- Interactive Sector Card Content -->
            <div class="glass-card p-8 sm:p-12 rounded-3xl border border-white/10 mb-16" id="sector-display-card">
                <!-- Content injected dynamically via switchSectorTab() -->
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
                    <div class="lg:col-span-7 space-y-5">
                        <span class="text-amber-400 font-mono text-xs uppercase font-bold tracking-widest">ORIENT GLOBAL ENTERPRISE BLUEPRINT</span>
                        <h3 class="text-2xl sm:text-3xl font-extrabold text-white">Local Resource Processing & 40,000 Direct Jobs</h3>
                        <p class="text-gray-300 text-sm leading-relaxed">
                            Ebonyi is blessed with vast mineral deposits (limestone, lead, zinc) and agro-raw materials that are currently exported unrefined. By applying the Orient Global supply chain and manufacturing model, Dr. Odii will construct processing hubs in Ishiagu, Nkalagu, and Ezza to create direct industrial wealth for Ebonyians.
                        </p>
                        <div class="grid grid-cols-2 sm:grid-cols-3 gap-4 pt-2">
                            <div class="p-4 rounded-xl bg-black/40 border border-white/10">
                                <div class="text-xl font-black text-amber-400 font-mono">40,000+</div>
                                <div class="text-[11px] text-gray-400 uppercase font-semibold">Direct Jobs</div>
                            </div>
                            <div class="p-4 rounded-xl bg-black/40 border border-white/10">
                                <div class="text-xl font-black text-emerald-400 font-mono">3 Hubs</div>
                                <div class="text-[11px] text-gray-400 uppercase font-semibold">Processing Zones</div>
                            </div>
                            <div class="p-4 rounded-xl bg-black/40 border border-white/10">
                                <div class="text-xl font-black text-cyan-400 font-mono">₦150B</div>
                                <div class="text-[11px] text-gray-400 uppercase font-semibold">State GDP Lift</div>
                            </div>
                        </div>
                    </div>
                    <div class="lg:col-span-5 p-6 rounded-2xl bg-black/60 border border-white/10 space-y-4">
                        <h4 class="font-bold text-white text-sm uppercase tracking-wider">Enterprise Reality Check</h4>
                        <div class="space-y-3 text-xs text-gray-300">
                            <div class="flex items-start gap-2">
                                <span class="text-amber-400 font-bold">✓</span>
                                <span>Proven track record: Built Orient Global from scratch into a multi-million-dollar conglomerate.</span>
                            </div>
                            <div class="flex items-start gap-2">
                                <span class="text-amber-400 font-bold">✓</span>
                                <span>Zero trial-and-error: Deep private sector capital connections in Lagos, Europe, and the Middle East.</span>
                            </div>
                            <div class="flex items-start gap-2">
                                <span class="text-amber-400 font-bold">✓</span>
                                <span>Partnership with local cooperatives to guarantee minimum purchase prices for local raw producers.</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- PHILANTHROPY PROOF MAP (140+ HOUSES & COMMUNITY INFRASTRUCTURE) -->
            <div class="rounded-3xl glass-card p-8 sm:p-12 border-2 border-amber-400/20 space-y-8">
                <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 border-b border-white/10 pb-6">
                    <div>
                        <span class="text-xs font-mono font-bold text-amber-400 uppercase tracking-wider">TANGIBLE TRACK RECORD BEFORE POLITICS</span>
                        <h3 class="text-2xl sm:text-3xl font-extrabold text-white mt-1">
                            Interactive Philanthropy Proof Map: <span class="gold-gradient-text">140+ Free Built Homes</span>
                        </h3>
                        <p class="text-xs sm:text-sm text-gray-400 mt-1 max-w-2xl">
                            "He accomplished all this as a private citizen without holding public office; imagine what he will do with the machinery of Ebonyi State Government."
                        </p>
                    </div>

                    <!-- Category Pills -->
                    <div class="flex flex-wrap gap-2 text-xs">
                        <span class="px-3 py-1.5 rounded-full bg-amber-400/20 text-amber-300 font-bold border border-amber-400/40">140+ Furnished Houses</span>
                        <span class="px-3 py-1.5 rounded-full bg-emerald-500/20 text-emerald-300 font-bold border border-emerald-400/40">1,000+ Scholarships</span>
                        <span class="px-3 py-1.5 rounded-full bg-cyan-500/20 text-cyan-300 font-bold border border-cyan-400/40">Boreholes & Schools</span>
                    </div>
                </div>

                <!-- Proof Map Visual Grid -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                    <div class="p-5 rounded-2xl bg-black/50 border border-white/10 space-y-2">
                        <div class="flex justify-between items-center text-xs">
                            <span class="font-mono text-amber-400 font-bold">ONICHA LGA</span>
                            <span class="text-gray-400">South</span>
                        </div>
                        <h5 class="text-white font-bold text-sm">48 Free Modern Homes</h5>
                        <p class="text-xs text-gray-400 leading-snug">Built and fully furnished for indigent widows and vulnerable families across Isu and Onicha Igboeze.</p>
                        <div class="text-[11px] text-emerald-400 font-semibold pt-1">Status: Occupied & Verified</div>
                    </div>

                    <div class="p-5 rounded-2xl bg-black/50 border border-white/10 space-y-2">
                        <div class="flex justify-between items-center text-xs">
                            <span class="font-mono text-amber-400 font-bold">ABAKALIKI & IZZI</span>
                            <span class="text-gray-400">North</span>
                        </div>
                        <h5 class="text-white font-bold text-sm">34 Free Homes & Water Boreholes</h5>
                        <p class="text-xs text-gray-400 leading-snug">Distributed in Kpirikpiri, Azuiyiokwu, and rural Izzi communities alongside school rehabilitation.</p>
                        <div class="text-[11px] text-emerald-400 font-semibold pt-1">Status: Functional Infrastructure</div>
                    </div>

                    <div class="p-5 rounded-2xl bg-black/50 border border-white/10 space-y-2">
                        <div class="flex justify-between items-center text-xs">
                            <span class="font-mono text-amber-400 font-bold">IKWO & EZZA</span>
                            <span class="text-gray-400">Central</span>
                        </div>
                        <h5 class="text-white font-bold text-sm">36 Homes & Educational Grants</h5>
                        <p class="text-xs text-gray-400 leading-snug">Providing free shelter and university tuition support for underprivileged students at AE-FUNAI & EBSU.</p>
                        <div class="text-[11px] text-emerald-400 font-semibold pt-1">Status: Continuous Foundation Grant</div>
                    </div>

                    <div class="p-5 rounded-2xl bg-black/50 border border-white/10 space-y-2">
                        <div class="flex justify-between items-center text-xs">
                            <span class="font-mono text-amber-400 font-bold">AFIKPO & IVO</span>
                            <span class="text-gray-400">South</span>
                        </div>
                        <h5 class="text-white font-bold text-sm">26 Modern Homes & Civic Centers</h5>
                        <p class="text-xs text-gray-400 leading-snug">Community halls, solar-powered boreholes, and widow empowerment shelters across Afikpo and Ishiagu.</p>
                        <div class="text-[11px] text-emerald-400 font-semibold pt-1">Status: Completed & Active</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ========================================================================= -->
    <!-- PILLAR 4: AMBASSADORS CLUB -->
    <!-- ========================================================================= -->
    <section id="pillar-ambassadors" class="py-24 relative border-b border-white/10">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="space-y-8">
                <div>
                    <div class="flex items-center gap-2 text-amber-400 text-xs font-extrabold uppercase tracking-widest mb-2">
                        <span class="font-mono text-base">04.</span> Volunteer Network Gamification
                    </div>
                    <h2 class="text-3xl sm:text-4xl font-extrabold text-white tracking-tight">
                        "Anyichuks 2027 Ambassadors" <span class="gold-gradient-text">Club</span>
                    </h2>
                    <p class="text-gray-400 text-sm mt-2 leading-relaxed">
                        Sign up as a verified campaign champion. Receive your official digital ambassador credential signed by Dr. Odii, recruit your network, and unlock campaign ranks.
                    </p>
                </div>

                <!-- Rank Progression Explanation -->
                <div class="grid grid-cols-3 gap-3">
                    <div class="p-4 rounded-2xl bg-black/40 border border-white/10 text-center space-y-1">
                        <span class="text-xs text-amber-400 font-mono font-bold">RANK 1</span>
                        <h5 class="text-xs sm:text-sm font-bold text-white">Grassroots Advocate</h5>
                        <p class="text-[10px] text-gray-400">Onboards 1-5 supporters</p>
                    </div>
                    <div class="p-4 rounded-2xl bg-black/40 border border-white/10 text-center space-y-1">
                        <span class="text-xs text-amber-400 font-mono font-bold">RANK 2</span>
                        <h5 class="text-xs sm:text-sm font-bold text-white">Ward Commander</h5>
                        <p class="text-[10px] text-gray-400">Coordinates 10+ voters</p>
                    </div>
                    <div class="p-4 rounded-2xl bg-black/40 border border-white/10 text-center space-y-1">
                        <span class="text-xs text-amber-400 font-mono font-bold">RANK 3</span>
                        <h5 class="text-xs sm:text-sm font-bold text-white">State Ambassador</h5>
                        <p class="text-[10px] text-gray-400">VIP Strategy Briefings</p>
                    </div>
                </div>

                <!-- Instant Ambassador Registration Form -->
                <form action="javascript:void(0);" onsubmit="event.preventDefault(); window.submitAmbassadorHub(event); return false;" class="glass-card p-6 sm:p-8 rounded-3xl space-y-4 border-2 border-amber-400/30">
                    <div class="flex items-center justify-between border-b border-white/10 pb-3">
                        <h4 class="font-bold text-white text-base">Claim Your Official 2027 Credential</h4>
                        <span class="text-xs text-amber-400 font-mono">100% Free • Verified</span>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold text-gray-300 uppercase mb-1.5">Full Name *</label>
                            <input type="text" id="amb-name" required placeholder="e.g. Chinedu Eze"
                                class="w-full px-4 py-2.5 bg-black/60 border border-white/15 focus:border-amber-400 rounded-xl text-white text-sm focus:outline-none">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-300 uppercase mb-1.5">Phone / WhatsApp *</label>
                            <input type="tel" id="amb-phone" required placeholder="e.g. 08012345678"
                                class="w-full px-4 py-2.5 bg-black/60 border border-white/15 focus:border-amber-400 rounded-xl text-white text-sm focus:outline-none">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold text-gray-300 uppercase mb-1.5">Ebonyi LGA *</label>
                            <select id="amb-lga" required
                                class="w-full px-4 py-2.5 bg-black/60 border border-white/15 focus:border-amber-400 rounded-xl text-white text-sm focus:outline-none">
                                <option value="Abakaliki">Abakaliki</option>
                                <option value="Afikpo North">Afikpo North</option>
                                <option value="Afikpo South">Afikpo South (Edda)</option>
                                <option value="Ebonyi">Ebonyi</option>
                                <option value="Ezza North">Ezza North</option>
                                <option value="Ezza South">Ezza South</option>
                                <option value="Ikwo">Ikwo</option>
                                <option value="Ishielu">Ishielu</option>
                                <option value="Ivo">Ivo</option>
                                <option value="Izzi">Izzi</option>
                                <option value="Ohaozara">Ohaozara</option>
                                <option value="Ohaukwu">Ohaukwu</option>
                                <option value="Onicha">Onicha</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-300 uppercase mb-1.5">Ward / Community</label>
                            <input type="text" id="amb-ward" placeholder="e.g. Kpirikpiri Ward"
                                class="w-full px-4 py-2.5 bg-black/60 border border-white/15 focus:border-amber-400 rounded-xl text-white text-sm focus:outline-none">
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-gray-300 uppercase mb-1.5">Preferred Campaign Role *</label>
                        <select id="amb-role" required
                            class="w-full px-4 py-2.5 bg-black/60 border border-white/15 focus:border-amber-400 rounded-xl text-white text-sm focus:outline-none">
                            <option value="Grassroots Mobilizer">Grassroots Mobilizer (Community Organizer)</option>
                            <option value="Youth Wing Pioneer">Youth Wing Pioneer & Tech Advocate</option>
                            <option value="Women Mobilization Leader">Women Mobilization Leader</option>
                            <option value="Polling Unit Agent / Monitor">Polling Unit Agent / Election Day Monitor</option>
                            <option value="Media & Digital Campaigner">Media & Digital Warrior</option>
                            <option value="Diaspora Supporter">Diaspora Supporter</option>
                        </select>
                    </div>

                    <div class="pt-3">
                        <button type="submit" id="amb-submit-btn"
                            style="background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%) !important; color: #000000 !important; font-weight: 800 !important; border: 1px solid #fbbf24 !important; box-shadow: 0 10px 25px -5px rgba(245, 158, 11, 0.4) !important;"
                            class="w-full py-4 px-6 bg-amber-400 hover:bg-amber-300 text-black font-extrabold text-sm uppercase tracking-wider rounded-xl transition-all flex items-center justify-center gap-2 cursor-pointer">
                            <span id="amb-btn-text">Generate My Official 2027 Ambassador Badge</span>
                            <span class="text-base">&rarr;</span>
                        </button>
                    </div>
                </form>

                <!-- Ambassador Badge Card Display (Rendered after submit or preview) -->
                <div id="ambassador-badge-card" class="hidden glass-card p-6 rounded-3xl border-2 border-amber-400/60 relative overflow-hidden space-y-4">
                    <div class="flex justify-between items-center border-b border-white/10 pb-3">
                        <div class="flex items-center gap-2">
                            <span class="font-serif font-black text-amber-400">ANYI GA EMEYA 2027</span>
                            <span class="px-2 py-0.5 rounded bg-emerald-500/20 text-emerald-300 text-[10px] font-bold">OFFICIAL CREDENTIAL</span>
                        </div>
                        <span class="font-mono text-xs text-gray-400" id="card-badge-id">ANYI27-0000</span>
                    </div>

                    <div class="flex items-center gap-4">
                        <div class="w-16 h-16 rounded-2xl bg-amber-400/20 border-2 border-amber-400/50 flex items-center justify-center text-2xl font-black text-amber-400">
                            🎖️
                        </div>
                        <div>
                            <h4 class="text-xl font-bold text-white" id="card-name">Ambassador Name</h4>
                            <div class="text-xs text-amber-400 font-semibold" id="card-role">Grassroots Mobilizer</div>
                            <div class="text-[11px] text-gray-400">Jurisdiction: <span class="text-white" id="card-lga">Abakaliki LGA</span></div>
                        </div>
                    </div>

                    <!-- Referral Link Area -->
                    <div class="p-4 rounded-2xl bg-black/60 border border-white/10 space-y-2">
                        <span class="text-[10px] font-bold uppercase tracking-wider text-gray-400">Your Unique Campaign Referral Link:</span>
                        <div class="flex gap-2">
                            <input type="text" id="amb-ref-link" readonly
                                class="w-full px-3 py-2 bg-black/80 border border-white/10 rounded-lg text-xs font-mono text-amber-300 focus:outline-none">
                            <button onclick="window.copyReferralLink()"
                                class="px-4 py-2 bg-amber-400 hover:bg-amber-300 text-black text-xs font-bold rounded-lg cursor-pointer transition-colors">
                                Copy
                            </button>
                        </div>
                    </div>

                    <div class="flex gap-2">
                        <button onclick="window.shareBadgeWhatsApp()"
                            class="w-full py-3 px-4 rounded-xl bg-emerald-500 hover:bg-emerald-400 text-black font-extrabold text-xs uppercase tracking-wider flex items-center justify-center gap-2 cursor-pointer transition-colors">
                            <span>Share on WhatsApp Status</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>



    <!-- FOOTER -->
    <footer class="bg-black border-t border-white/10 py-12 text-center text-xs text-gray-500 space-y-4">
        <div class="flex items-center justify-center gap-3">
            <span class="font-serif font-black text-amber-400 text-sm">ANYI GA EMEYA 2027</span>
            <span>•</span>
            <span class="text-gray-300">Dr. Ifeanyi Chukwuma Odii Campaign Organization</span>
        </div>
        <p class="max-w-xl mx-auto text-gray-400 leading-relaxed">
            Dedicated to the economic revival, massive industrialization, healthcare reform, prompt civil service welfare, and youth empowerment of Ebonyi State.
        </p>
        <div class="flex justify-center gap-6 text-gray-400 pt-2">
            <a href="/" class="hover:text-amber-400 transition-colors">Portfolio Home</a>
            <a href="/contact" class="hover:text-amber-400 transition-colors">Campaign Contact</a>
            <a href="/press" class="hover:text-amber-400 transition-colors">Press & Media Kit</a>
            <a href="/campaign-2027" class="hover:text-amber-400 transition-colors">Campaign War Room</a>
        </div>
        <p class="text-[11px] text-gray-600">
            © 2026-2027 ANYI GA EMEYA Campaign Platform. Built with high-security data integrity for Dr. Ifeanyi Chukwuma Odii.
        </p>
    </footer>

    <!-- CAMPAIGN ENGINE CLIENT LOGIC -->
    <script>
        // Strategic Blueprint Sectoral Data
        const sectorBlueprints = {
            industry: {
                tag: "ORIENT GLOBAL ENTERPRISE BLUEPRINT",
                title: "Local Resource Processing & 40,000 Direct Jobs",
                desc: "Ebonyi is blessed with vast mineral deposits (limestone, lead, zinc) and agro-raw materials that are currently exported unrefined. By applying the Orient Global supply chain and manufacturing model, Dr. Odii will construct processing hubs in Ishiagu, Nkalagu, and Ezza to create direct industrial wealth for Ebonyians.",
                stat1: { num: "40,000+", label: "Direct Jobs" },
                stat2: { num: "3 Hubs", label: "Processing Zones" },
                stat3: { num: "₦150B", label: "State GDP Lift" },
                points: [
                    "Built Orient Global from scratch into a multi-million-dollar conglomerate.",
                    "Direct links to private sector capital without relying entirely on federal allocations.",
                    "Guaranteed minimum purchase prices for local raw producers."
                ]
            },
            youth: {
                tag: "TECH & INNOVATION ACADEMIES",
                title: "3 Senatorial Tech Hubs & 10,000 Youth Entrepreneur Grants",
                desc: "Wiping out youth idleness by creating state-subsidized technology academies in Abakaliki, Afikpo, and Onueke. Youth will be trained in software engineering, digital creative arts, AI tools, and provided seed capital to launch registered startups.",
                stat1: { num: "10,000", label: "Youth Grants" },
                stat2: { num: "3 Academies", label: "Senatorial Hubs" },
                stat3: { num: "100%", label: "Free Digital Tuition" },
                points: [
                    "Direct sponsorship of WAEC and JAMB fees for Ebonyi secondary students.",
                    "Partnership with global tech firms to offer remote hiring pipelines.",
                    "Elimination of youth thuggery through respectable high-income digital careers."
                ]
            },
            health: {
                tag: "HUMAN WELFARE & HEALTH INSURANCE",
                title: "Functional Primary Health in All 171 Wards & Civil Service Dignity",
                desc: "Civil servants will receive prompt salaries on the 25th of every month, with a systematic plan to eliminate pension backlogs. Every ward will feature a staffed, solar-electrified primary health clinic with subsidized maternal and elder healthcare.",
                stat1: { num: "171", label: "Functional Clinics" },
                stat2: { num: "25th", label: "Guaranteed Pay Day" },
                stat3: { num: "100%", label: "Free Maternal Care" },
                points: [
                    "Sacred pledge: Human capital development before cosmetic concrete bridges.",
                    "State health insurance coverage for low-income families and widows.",
                    "Restoration of civil service promotions, training, and pension security."
                ]
            },
            agric: {
                tag: "AGRO-PROCESSING & VALUE ADDITION",
                title: "Modernizing Ebonyi Rice, Yam & Cassava Value Chains",
                desc: "Moving beyond subsistence farming. Supplying certified high-yield seedlings, subsidized mechanized tractors, and establishing modern parboiling and milling complexes so Ebonyi farmers earn maximum profits from their harvest.",
                stat1: { num: "25,000+", label: "Farmers Empowered" },
                stat2: { num: "6 Mills", label: "Modern Complexes" },
                stat3: { num: "₦20B", label: "Agric Revolving Fund" },
                points: [
                    "Direct government off-taker agreements to protect farmers from post-harvest losses.",
                    "Accessible micro-credit loans for women farmers and youth agricultural cooperatives.",
                    "Rehabilitation of rural farm-to-market feeder roads across all 13 LGAs."
                ]
            }
        };

        window.switchSectorTab = function(sectorKey) {
            const data = sectorBlueprints[sectorKey];
            if (!data) return;

            // Update Tab styles
            ['industry', 'youth', 'health', 'agric'].forEach(key => {
                const btn = document.getElementById('tab-' + key);
                if (btn) {
                    if (key === sectorKey) {
                        btn.className = "cursor-pointer px-4 py-3 rounded-xl text-xs font-extrabold uppercase tracking-wider transition-all bg-amber-400 text-black shadow-lg shadow-amber-400/20 text-center flex items-center justify-center gap-2";
                    } else {
                        btn.className = "cursor-pointer px-4 py-3 rounded-xl text-xs font-extrabold uppercase tracking-wider transition-all glass-card text-gray-300 hover:text-white text-center flex items-center justify-center gap-2";
                    }
                }
            });

            // Update card HTML
            const display = document.getElementById('sector-display-card');
            display.innerHTML = `
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
                    <div class="lg:col-span-7 space-y-5">
                        <span class="text-amber-400 font-mono text-xs uppercase font-bold tracking-widest">${data.tag}</span>
                        <h3 class="text-2xl sm:text-3xl font-extrabold text-white">${data.title}</h3>
                        <p class="text-gray-300 text-sm leading-relaxed">${data.desc}</p>
                        <div class="grid grid-cols-2 sm:grid-cols-3 gap-4 pt-2">
                            <div class="p-4 rounded-xl bg-black/40 border border-white/10">
                                <div class="text-xl font-black text-amber-400 font-mono">${data.stat1.num}</div>
                                <div class="text-[11px] text-gray-400 uppercase font-semibold">${data.stat1.label}</div>
                            </div>
                            <div class="p-4 rounded-xl bg-black/40 border border-white/10">
                                <div class="text-xl font-black text-emerald-400 font-mono">${data.stat2.num}</div>
                                <div class="text-[11px] text-gray-400 uppercase font-semibold">${data.stat2.label}</div>
                            </div>
                            <div class="p-4 rounded-xl bg-black/40 border border-white/10">
                                <div class="text-xl font-black text-cyan-400 font-mono">${data.stat3.num}</div>
                                <div class="text-[11px] text-gray-400 uppercase font-semibold">${data.stat3.label}</div>
                            </div>
                        </div>
                    </div>
                    <div class="lg:col-span-5 p-6 rounded-2xl bg-black/60 border border-white/10 space-y-4">
                        <h4 class="font-bold text-white text-sm uppercase tracking-wider">Strategic Pillars</h4>
                        <div class="space-y-3 text-xs text-gray-300">
                            ${data.points.map(p => `
                                <div class="flex items-start gap-2">
                                    <span class="text-amber-400 font-bold">✓</span>
                                    <span>${p}</span>
                                </div>
                            `).join('')}
                        </div>
                    </div>
                </div>
            `;
        };

        // Rebuttal Copy Helper
        window.copyRebuttal = function(btn, text) {
            navigator.clipboard.writeText(text);
            const orig = btn.innerHTML;
            btn.innerHTML = '<span>✅ Copied to Clipboard!</span>';
            setTimeout(() => btn.innerHTML = orig, 2500);
        };

        // AI Town Hall Chat Logic
        window.sendQuickPrompt = function(promptText) {
            const input = document.getElementById('ai-user-input');
            if (input) {
                input.value = promptText;
                window.submitAIChat();
            }
        };

        window.submitAIChat = async function(e) {
            if (e && e.preventDefault) {
                e.preventDefault();
                e.stopPropagation();
            }
            const input = document.getElementById('ai-user-input');
            const sendBtn = document.getElementById('ai-send-btn');
            const sendBtnText = document.getElementById('ai-send-btn-text');
            if (!input) return false;
            const message = input.value.trim();
            if (!message) return false;

            // Prevent multiple concurrent submissions
            if (sendBtn) {
                sendBtn.disabled = true;
                sendBtn.style.opacity = '0.6';
                sendBtn.style.pointerEvents = 'none';
            }
            if (sendBtnText) sendBtnText.textContent = '...';

            const chatWindow = document.getElementById('ai-chat-window');

            // Sanitize & Append User Message
            const safeMsg = message.replace(/&/g, "&amp;").replace(/</g, "&lt;").replace(/>/g, "&gt;");
            chatWindow.innerHTML += `
                <div class="flex items-start justify-end gap-3">
                    <div class="bg-amber-400 text-black font-semibold p-3.5 rounded-2xl rounded-tr-none text-xs max-w-lg leading-relaxed shadow-lg">
                        ${safeMsg}
                    </div>
                </div>
            `;
            input.value = '';
            chatWindow.scrollTop = chatWindow.scrollHeight;

            // Placeholder Bot Thinking
            const loadingId = 'ai-loading-' + Date.now();
            chatWindow.innerHTML += `
                <div id="${loadingId}" class="flex items-start gap-3">
                    <div class="w-8 h-8 rounded-full bg-amber-400/20 text-amber-400 flex items-center justify-center text-xs font-bold shrink-0 mt-0.5">
                        Odii
                    </div>
                    <div class="bg-white/5 border border-white/10 p-3.5 rounded-2xl rounded-tl-none text-gray-400 text-xs flex items-center gap-2">
                        <span class="w-2 h-2 rounded-full bg-amber-400 animate-ping"></span>
                        <span>Dr. Odii AI is analyzing your question...</span>
                    </div>
                </div>
            `;
            chatWindow.scrollTop = chatWindow.scrollHeight;

            try {
                const res = await fetch('/api/ai-chat', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ message: message })
                });
                const data = await res.json();
                const reply = data.reply || "Dr. Odii appreciates your interest. Please join the movement as a volunteer!";

                const loadEl = document.getElementById(loadingId);
                if (loadEl) loadEl.remove();

                chatWindow.innerHTML += `
                    <div class="flex items-start gap-3">
                        <div class="w-8 h-8 rounded-full bg-amber-400/20 text-amber-400 flex items-center justify-center text-xs font-bold shrink-0 mt-0.5">
                            Odii
                        </div>
                        <div class="bg-white/5 border border-white/10 p-4 rounded-2xl rounded-tl-none text-gray-200 text-xs sm:text-sm leading-relaxed max-w-full sm:max-w-xl space-y-2 break-words select-text shadow-lg">
                            ${reply.replace(/\n/g, '<br>')}
                        </div>
                    </div>
                `;
                chatWindow.scrollTo({ top: chatWindow.scrollHeight, behavior: 'smooth' });
            } catch (err) {
                const loadEl = document.getElementById(loadingId);
                if (loadEl) loadEl.remove();
                chatWindow.innerHTML += `
                    <div class="flex items-start gap-3">
                        <div class="w-8 h-8 rounded-full bg-amber-400/20 text-amber-400 flex items-center justify-center text-xs font-bold shrink-0 mt-0.5">
                            Odii
                        </div>
                        <div class="bg-white/5 border border-white/10 p-3.5 rounded-2xl rounded-tl-none text-gray-300 text-xs sm:text-sm max-w-full sm:max-w-xl">
                            Thank you for your question. Dr. Odii is committed to industrializing Ebonyi State and ensuring every citizen has access to prosperity.
                        </div>
                    </div>
                `;
                chatWindow.scrollTo({ top: chatWindow.scrollHeight, behavior: 'smooth' });
            } finally {
                if (sendBtn) {
                    sendBtn.disabled = false;
                    sendBtn.style.opacity = '1';
                    sendBtn.style.pointerEvents = 'auto';
                }
                if (sendBtnText) sendBtnText.textContent = 'Send';
                chatWindow.scrollTop = chatWindow.scrollHeight;
            }
            return false;
        };

        // SMS Signup
        window.submitSMSSignup = async function(e) {
            e.preventDefault();
            const btn = document.getElementById('sms-btn');
            const feedback = document.getElementById('sms-feedback');
            const phone = document.getElementById('sms-phone').value.trim();
            const community = document.getElementById('sms-community').value.trim();

            btn.disabled = true;
            btn.textContent = 'Enrolling...';

            try {
                const res = await fetch('/api/campaign/sms-signup', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                    body: JSON.stringify({ phone, community })
                });
                const data = await res.json();
                feedback.classList.remove('hidden');
                feedback.textContent = data.message || "Enrolled successfully!";
                btn.textContent = "Subscribed ✓";
            } catch(e) {
                feedback.classList.remove('hidden');
                feedback.textContent = "Signup recorded! You will receive local tour broadcasts.";
                btn.textContent = "Subscribed ✓";
            }
        };

        // Ambassador Club Submission
        let registeredAmbData = null;
        window.submitAmbassadorHub = async function(e) {
            e.preventDefault();
            const btn = document.getElementById('amb-submit-btn');
            const btnText = document.getElementById('amb-btn-text');

            btn.disabled = true;
            btnText.textContent = "Validating Credential...";

            const payload = {
                name: document.getElementById('amb-name').value.trim(),
                phone: document.getElementById('amb-phone').value.trim(),
                lga: document.getElementById('amb-lga').value,
                ward: document.getElementById('amb-ward').value.trim(),
                role: document.getElementById('amb-role').value
            };

            try {
                const res = await fetch('/api/campaign/volunteer', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                    body: JSON.stringify(payload)
                });
                const data = await res.json();

                registeredAmbData = data.data || payload;
                const regId = data.registration_id || 'ANYI27-EB-4412';

                // Render Badge View
                document.getElementById('card-badge-id').textContent = regId;
                document.getElementById('card-name').textContent = payload.name;
                document.getElementById('card-role').textContent = payload.role;
                document.getElementById('card-lga').textContent = payload.lga + ' LGA';

                const refLink = `${window.location.origin}/campaign-2027?ref=${encodeURIComponent(regId)}`;
                document.getElementById('amb-ref-link').value = refLink;

                document.getElementById('ambassador-badge-card').classList.remove('hidden');
                document.getElementById('ambassador-badge-card').scrollIntoView({ behavior: 'smooth' });

                btn.disabled = false;
                btnText.textContent = "Badge Generated Successfully ✓";
            } catch (err) {
                btn.disabled = false;
                btnText.textContent = "Claim Badge";
            }
        };

        window.copyReferralLink = function() {
            const input = document.getElementById('amb-ref-link');
            input.select();
            navigator.clipboard.writeText(input.value);
            alert("Referral link copied! Share this with your friends and family to recruit them to ANYI GA EMEYA 2027.");
        };

        window.shareBadgeWhatsApp = function() {
            const name = document.getElementById('card-name').textContent;
            const regId = document.getElementById('card-badge-id').textContent;
            const link = document.getElementById('amb-ref-link').value;
            const text = encodeURIComponent(`I have just been officially accredited as an ANYI GA EMEYA 2027 Campaign Ambassador (Credential ID: ${regId}) for Dr. Ifeanyi Chukwuma Odii! Join our movement to bring transformative industrialization and good governance to Ebonyi: ${link}`);
            window.open(`https://api.whatsapp.com/send?text=${text}`, '_blank');
        };



        // Mobile Campaign Navigation Drawer Controller
        window.toggleMobileCampaignNav = function() {
            const drawer = document.getElementById('mobile-campaign-nav-drawer');
            const hamburger = document.getElementById('c-hamburger-icon');
            const close = document.getElementById('c-close-icon');
            if (!drawer) return;

            const isClosed = drawer.style.display === 'none' || drawer.classList.contains('opacity-0');
            if (isClosed) {
                drawer.style.display = 'flex';
                document.body.style.overflow = 'hidden';
                void drawer.offsetWidth;
                drawer.classList.remove('opacity-0', 'pointer-events-none');
                drawer.classList.add('opacity-100', 'pointer-events-auto');
                if (hamburger) hamburger.classList.add('hidden');
                if (close) close.classList.remove('hidden');
            } else {
                window.closeMobileCampaignNav();
            }
        };

        window.closeMobileCampaignNav = function() {
            const drawer = document.getElementById('mobile-campaign-nav-drawer');
            const hamburger = document.getElementById('c-hamburger-icon');
            const close = document.getElementById('c-close-icon');
            if (!drawer) return;

            drawer.classList.remove('opacity-100', 'pointer-events-auto');
            drawer.classList.add('opacity-0', 'pointer-events-none');
            document.body.style.overflow = '';
            if (hamburger) hamburger.classList.remove('hidden');
            if (close) close.classList.add('hidden');
            setTimeout(() => {
                if (drawer.classList.contains('opacity-0')) {
                    drawer.style.display = 'none';
                }
            }, 300);
        };

        // Mobile Boardroom Pan Controller
        window.panBoardroomCampaign = function(percent, target) {
            const bgImg = document.getElementById('site-bg-image-campaign');
            if (bgImg) {
                bgImg.style.objectPosition = `${percent}% 25%`;
            }
            ['flag', 'center', 'gov'].forEach(t => {
                const el = document.getElementById('c-pan-' + t);
                if (el) {
                    if (t === target) {
                        el.className = "px-2.5 py-1 rounded-full bg-amber-400 text-black font-extrabold text-[10px] shrink-0 active:scale-95 cursor-pointer shadow-md";
                    } else {
                        el.className = "px-2.5 py-1 rounded-full bg-white/10 text-gray-300 hover:text-white font-bold text-[10px] shrink-0 active:scale-95 cursor-pointer";
                    }
                }
            });
        };

            document.addEventListener('DOMContentLoaded', () => {

                // Bind Sector Tabs explicitly
                ['industry', 'youth', 'health', 'agric'].forEach(key => {
                    const btn = document.getElementById('tab-' + key);
                    if (btn) {
                        btn.addEventListener('click', (e) => {
                            e.preventDefault();
                            if (typeof window.switchSectorTab === 'function') {
                                window.switchSectorTab(key);
                            }
                        });
                    }
                });

                // Explicitly bind AI Send Button & Enter Key for fail-safe clicks
                const aiSendBtn = document.getElementById('ai-send-btn');
                const aiUserInput = document.getElementById('ai-user-input');
                if (aiSendBtn) {
                    aiSendBtn.addEventListener('click', (e) => {
                        e.preventDefault();
                        window.submitAIChat(e);
                    });
                }
                if (aiUserInput) {
                    aiUserInput.addEventListener('keydown', (e) => {
                        if (e.key === 'Enter') {
                            e.preventDefault();
                            window.submitAIChat(e);
                        }
                    });
                }
            });
    </script>
</body>

</html>
