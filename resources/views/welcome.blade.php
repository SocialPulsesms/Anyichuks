<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">
    <title>Ifeanyi Chukwuma Odii</title>
    <link rel="icon" type="image/jpeg" href="{{ asset('images/favicon.jpg') }}">
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;800&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }

        /* Analog Clock Styling */
        .clock-face-bg {
            transition: fill 0.5s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .clock-ticks line {
            transition: stroke 0.5s ease;
        }
        .clock-numbers text {
            transition: fill 0.5s ease;
        }
        .clock-hand-hour, .clock-hand-minute {
            transition: stroke 0.5s ease;
        }

        /* Day Theme (Light Face) */
        .clock-day .clock-face-bg {
            fill: rgba(255, 255, 255, 0.85);
        }
        .clock-day .clock-ticks line {
            stroke: rgba(0, 0, 0, 0.25);
        }
        .clock-day .clock-numbers text {
            fill: #1c1c1e;
        }
        .clock-day .clock-hand-hour {
            stroke: #1c1c1e;
        }
        .clock-day .clock-hand-minute {
            stroke: #1c1c1e;
        }

        /* Night Theme (Dark Face) */
        .clock-night .clock-face-bg {
            fill: rgba(28, 28, 30, 0.7); /* deep macOS charcoal grey, glassmorphic */
        }
        .clock-night .clock-ticks line {
            stroke: rgba(255, 255, 255, 0.25);
        }
        .clock-night .clock-numbers text {
            fill: #ffffff;
        }
        .clock-night .clock-hand-hour {
            stroke: #ffffff;
        }
        .clock-night .clock-hand-minute {
            stroke: #ffffff;
        }

        /* WordPress Navigation Menu Hover & Dropdown Styles */
        .nav-item {
            position: relative;
        }

        .nav-dropdown {
            position: absolute;
            top: 100%;
            left: 0;
            background-color: rgba(22, 22, 21, 0.95);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 8px;
            padding: 8px 0;
            min-width: 200px;
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.5);
            opacity: 0;
            visibility: hidden;
            transform: translateY(8px);
            transition: all 0.2s ease-in-out;
            z-index: 50;
        }

        /* Dropdown drops down smoothly on hover like premium WordPress themes */
        .nav-item:hover .nav-dropdown {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }

        .nav-dropdown-item {
            display: block;
            padding: 10px 20px;
            font-size: 13px;
            color: #d1d5db;
            transition: all 0.15s ease-in-out;
        }

        .nav-dropdown-item:hover {
            background-color: rgba(255, 255, 255, 0.1);
            color: #ffffff;
            padding-left: 24px;
        }

        /* Hide details marker completely across all modern browsers */
        summary {
            list-style: none !important;
            list-style-type: none !important;
        }
        summary::-webkit-details-marker {
            display: none !important;
        }
        summary::marker {
            display: none !important;
            content: "" !important;
            font-size: 0 !important;
            width: 0 !important;
            height: 0 !important;
        }
        details > summary {
            list-style: none !important;
        }

        /* Smooth scroll snapping */
        html {
            scroll-snap-type: y mandatory;
            scroll-behavior: smooth;
            scroll-padding-top: 76px;
        }

        .accordion-section {
            scroll-margin-top: 76px;
        }

        summary,
        .dropdown-content-panel {
            scroll-snap-align: start;
            scroll-snap-stop: always;
            scroll-margin-top: 76px;
        }

        .word-span {
            display: inline-block;
            opacity: 0;
            transform: translateY(-25px);
            filter: blur(6px);
            transition: opacity 0.5s ease-out, transform 0.6s cubic-bezier(0.175, 0.885, 0.32, 1.275), filter 0.5s ease-out;
            transition-delay: inherit;
            will-change: opacity, transform, filter;
        }

        .word-span.assemble {
            opacity: 1;
            transform: translateY(0);
            filter: blur(0);
        }

        .word-span.fade-out {
            opacity: 0;
            transform: translateY(15px);
            filter: blur(6px);
            transition: opacity 0.4s ease-in, transform 0.4s ease-in, filter 0.4s ease-in;
            transition-delay: 0ms !important;
        }

        /* Smooth camera panning transition for boardroom interactive pan */
        #site-bg-image {
            transition: object-position 0.6s cubic-bezier(0.25, 1, 0.5, 1);
            will-change: object-position;
        }

        /* Smooth Native Mobile UX, Margins & Readable Typography */
        @media screen and (max-width: 768px) {
            html {
                scroll-snap-type: none !important;
                scroll-behavior: smooth !important;
                scroll-padding-top: 72px !important;
                -webkit-overflow-scrolling: touch;
            }

            body {
                font-size: 15px !important;
                line-height: 1.65 !important;
                overflow-x: hidden !important;
                background-color: #080A10 !important;
            }

            /* On mobile, desktop full-bleed fixed background is hidden; the dedicated uncropped 16:9 boardroom showcase card is featured in Section Home */
            #site-fixed-bg {
                display: none !important;
            }

            /* Hide details marker completely on mobile */
            summary {
                list-style: none !important;
                list-style-type: none !important;
                display: block !important;
            }
            summary::-webkit-details-marker {
                display: none !important;
            }
            summary::marker {
                display: none !important;
                content: "" !important;
                font-size: 0 !important;
                width: 0 !important;
                height: 0 !important;
            }

            /* Disable rigid snapping and force natural fluid flow */
            summary,
            .dropdown-content-panel {
                scroll-snap-align: none !important;
                scroll-snap-stop: normal !important;
                height: auto !important;
                min-height: auto !important;
            }

            .accordion-section {
                margin-bottom: 16px !important;
                width: 100% !important;
                scroll-margin-top: 72px !important;
            }

            .accordion-section summary {
                height: auto !important;
                min-height: auto !important;
                padding: 22px 18px !important;
                border-radius: 20px !important;
                background: rgba(18, 21, 28, 0.92) !important;
                backdrop-filter: blur(16px) !important;
                -webkit-backdrop-filter: blur(16px) !important;
                border: 1px solid rgba(255, 255, 255, 0.12) !important;
                box-shadow: 0 10px 30px -5px rgba(0, 0, 0, 0.5) !important;
                display: block !important;
                position: relative !important;
                cursor: pointer !important;
            }

            /* Remove absolute positioning so content flows naturally */
            .summary-text-container {
                position: static !important;
                transform: none !important;
                max-width: 100% !important;
                width: 100% !important;
                padding: 0 !important;
                display: flex !important;
                flex-direction: column !important;
                gap: 16px !important;
            }

            .stylish-reveal-text {
                font-size: 15px !important;
                line-height: 1.65 !important;
                color: #e2e8f0 !important;
                max-height: none !important;
                overflow: visible !important;
                display: block !important;
                opacity: 1 !important;
                transform: none !important;
                filter: none !important;
            }

            /* Disable blurred fading word cycling on mobile so text is immediately readable and never disappears */
            .word-span,
            .word-span.assemble,
            .word-span.fade-out {
                opacity: 1 !important;
                transform: none !important;
                filter: none !important;
                display: inline !important;
                transition: none !important;
                animation: none !important;
            }

            .hero-chevron-arrow {
                width: 28px !important;
                height: 18px !important;
                max-width: 28px !important;
                stroke-width: 14 !important;
            }

            .dropdown-content-panel {
                height: auto !important;
                min-height: auto !important;
                max-height: none !important;
                padding: 20px 16px 28px !important;
                border-radius: 20px !important;
                margin-top: 10px !important;
                background: rgba(13, 15, 20, 0.96) !important;
                border: 1px solid rgba(255, 255, 255, 0.12) !important;
                overflow: visible !important;
                scroll-margin-top: 72px !important;
            }
        }

        /* Desktop Fixed Parallax Background */
        @media screen and (min-width: 769px) {
            #site-bg-image {
                object-position: center 25% !important;
                object-fit: cover !important;
            }
        }

        /* Mobile Landscape Mode Optimizations */
        @media (orientation: landscape) and (max-height: 550px) {
            header {
                padding-top: 6px !important;
                padding-bottom: 6px !important;
                height: auto !important;
                background: rgba(0, 0, 0, 0.88) !important;
            }
            #site-fixed-bg img {
                object-position: center 20% !important;
            }
            .stylish-reveal-text {
                font-size: 13px !important;
                line-height: 1.4 !important;
            }
            .accordion-section summary {
                height: 100vh !important;
                min-height: 100vh !important;
            }
        }

    </style>
</head>

<body class="antialiased text-white min-h-screen relative flex flex-col justify-between bg-[#0A0C10]">

    <!-- Dedicated Fixed Crisp Background (Hardware Accelerated, 100% Mobile Compatible, Zero Scaling Blur) -->
    <div id="site-fixed-bg" class="fixed inset-0 w-full h-full -z-50 pointer-events-none overflow-hidden select-none" aria-hidden="true">
        <img id="site-bg-image"
             src="{{ asset('images/landing-profile.png') }}?v={{ file_exists(public_path('images/landing-profile.png')) ? filemtime(public_path('images/landing-profile.png')) : time() }}"
             alt="Dr. Ifeanyi Chukwuma Odii - ANYI GA EMEYA 2027 PDP Flagship"
             class="w-full h-full object-cover transform-gpu"
             style="image-rendering: -webkit-optimize-contrast; object-position: center 25%;">
    </div>

    <!-- Dark overlay handled by individual sections -->
    <!-- <div class="absolute inset-0 bg-black/60 z-0"></div> -->

    <!-- Premium WordPress-style Header Navigation -->
    <header
        class="fixed top-0 left-0 z-50 w-full bg-black/80 backdrop-blur-xl border-b border-white/10 px-3.5 sm:px-6 lg:px-12 py-2.5 sm:py-4 transition-all">
        <div class="max-w-7xl mx-auto flex justify-between items-center gap-2">

            <!-- Logo -->
            <a href="#section-home" class="text-sm sm:text-lg md:text-xl font-bold tracking-wide sm:tracking-wider text-white uppercase shrink-0 select-none">
                ANYI GA EMEYA <span class="text-amber-400">2027</span>
            </a>

            <!-- Navigation Links (WordPress Desktop Menu Structure) -->
            <nav class="desktop-nav-menu hidden md:flex items-center gap-6">
                <a href="#section-home" class="hover:text-amber-400 transition-colors py-2 text-sm font-medium">Home</a>

                <a href="#section-philanthropist"
                    class="hover:text-amber-400 transition-colors py-2 text-sm font-medium">A philanthropist</a>
                <a href="#section-news" class="hover:text-amber-400 transition-colors py-2 text-sm font-medium">NEWS</a>

                <a href="/campaign-2027"
                    class="hover:text-amber-400 text-amber-400 font-semibold transition-colors py-2 text-sm flex items-center gap-1.5">
                    <span class="w-1.5 h-1.5 rounded-full bg-amber-400 animate-pulse"></span>
                    2027 Campaign
                </a>
                <a href="javascript:void(0);" onclick="window.openAboutModal(event);"
                    class="hover:text-amber-400 transition-colors py-2 text-sm font-medium">About</a>
                <a href="/contact" class="hover:text-amber-400 transition-colors py-2 text-sm font-medium">Contact</a>
            </nav>

            <!-- Action Area: Button, Social Icons & Mobile Menu Toggle -->
            <div class="flex items-center gap-2 sm:gap-3 lg:gap-5 shrink-0">
                <!-- Join 2027 Movement Button (Always visible on mobile & desktop, elegantly fitted) -->
                <button type="button" onclick="window.openVolunteerModal(event);"
                    class="relative z-10 px-2.5 sm:px-5 py-1.5 sm:py-2 bg-gradient-to-r from-amber-400 to-amber-500 text-black font-extrabold rounded-full hover:from-amber-300 hover:to-amber-400 active:scale-95 transition-all text-[10px] sm:text-xs tracking-wider uppercase whitespace-nowrap shadow-md shadow-amber-400/20 flex items-center gap-1 sm:gap-1.5 cursor-pointer shrink-0">
                    <span class="w-1.5 h-1.5 rounded-full bg-black animate-ping shrink-0"></span>
                    <span>Join <span class="hidden sm:inline">2027 Movement</span><span class="sm:hidden">2027</span></span>
                </button>

                <!-- Social Icons (Visible on Desktop Only to Avoid Mobile Clutter) -->
                <div class="hidden lg:flex items-center gap-3">
                    <!-- X (Twitter) -->
                    <a href="https://x.com/ifeanyiCodii" target="_blank" rel="noopener noreferrer"
                        class="text-white hover:text-amber-400 transition-colors p-1" aria-label="X (formerly Twitter)">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 22.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z">
                            </path>
                        </svg>
                    </a>
                    <!-- Instagram -->
                    <a href="https://www.instagram.com/ifeanyicodii/" target="_blank" rel="noopener noreferrer"
                        class="text-white hover:text-amber-400 transition-colors p-1" aria-label="Instagram">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                            <path fill-rule="evenodd"
                                d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </a>
                    <!-- Facebook -->
                    <a href="https://web.facebook.com/ifeanyiCodii/?_rdc=1&_rdr" target="_blank"
                        rel="noopener noreferrer" class="text-white hover:text-amber-400 transition-colors p-1"
                        aria-label="Facebook">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                            <path fill-rule="evenodd"
                                d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </a>
                    <!-- TikTok -->
                    <a href="https://www.tiktok.com/@ifeanyicodii" target="_blank" rel="noopener noreferrer" class="text-white hover:text-amber-400 transition-colors p-1" aria-label="TikTok">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M12.525.02c1.31-.02 2.61-.01 3.91-.02.08 1.53.63 3.09 1.75 4.17 1.12 1.11 2.7 1.62 4.24 1.79v4.03c-1.44-.05-2.89-.35-4.2-.97-.57-.26-1.1-.59-1.62-.93-.01 2.92.01 5.84-.02 8.75-.08 2.23-1.15 4.39-2.92 5.86-1.57 1.3-3.66 1.94-5.69 1.7-2.12-.23-4.06-1.3-5.32-2.93-1.39-1.78-1.92-4.14-1.42-6.32.48-2.17 1.87-4.07 3.8-5.11 2.01-1.07 4.43-1.22 6.6-.47v4.15c-1.16-.36-2.45-.41-3.63-.04-1.12.35-2.09 1.11-2.6 2.16-.54 1.12-.59 2.44-.15 3.59.45 1.2 1.48 2.15 2.72 2.49 1.28.36 2.69.19 3.84-.46 1.19-.69 1.99-1.91 2.18-3.26.23-1.48.16-2.98.17-4.47V.02z">
                            </path>
                        </svg>
                    </a>
                </div>

                <!-- Mobile Menu Hamburger Button -->
                <button type="button" onclick="window.toggleMobileNav()" id="mobile-nav-toggle"
                    class="md:hidden flex p-2 rounded-xl bg-white/10 hover:bg-white/20 active:scale-95 text-white transition-all items-center justify-center cursor-pointer border border-white/15 shrink-0"
                    aria-label="Toggle Mobile Navigation Menu">
                    <svg id="hamburger-icon" class="w-5 h-5 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                    <svg id="close-icon" class="w-5 h-5 hidden text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
        </div>
    </header>

    <!-- Full Mobile Navigation Drawer (Luxury Slide-Down Overlay) -->
    <div id="mobile-nav-drawer" class="fixed inset-0 z-[100] bg-[#0A0C10]/98 backdrop-blur-2xl transition-all duration-300 opacity-0 pointer-events-none flex flex-col justify-between overflow-y-auto" style="display: none;">
        <!-- Drawer Top Bar -->
        <div class="px-5 py-4 border-b border-white/10 flex items-center justify-between bg-black/70 sticky top-0 z-10 backdrop-blur-md">
            <a href="/" class="text-lg font-bold tracking-wider text-white uppercase">
                ANYI GA EMEYA <span class="text-amber-400">2027</span>
            </a>
            <button type="button" onclick="window.toggleMobileNav()" class="w-9 h-9 rounded-full bg-white/10 hover:bg-red-500/20 text-gray-300 hover:text-white flex items-center justify-center font-bold text-lg cursor-pointer transition-colors" aria-label="Close Mobile Menu">
                ✕
            </button>
        </div>

        <!-- Drawer Content & Links -->
        <div class="p-5 sm:p-6 flex flex-col gap-3">
            <span class="text-[10px] font-bold uppercase tracking-widest text-amber-400">Executive Directory</span>

            <!-- Home -->
            <a href="#section-home" onclick="window.closeMobileNav()" class="flex items-center justify-between p-3.5 rounded-xl bg-white/5 hover:bg-white/10 border border-white/10 text-white font-semibold transition-all">
                <span class="flex items-center gap-3">
                    <span class="text-base">🏠</span>
                    <span>Home</span>
                </span>
                <span class="text-gray-400 text-xs">&rarr;</span>
            </a>

            <!-- A Philanthropist -->
            <a href="#section-philanthropist" onclick="window.closeMobileNav()" class="flex items-center justify-between p-3.5 rounded-xl bg-white/5 hover:bg-white/10 border border-white/10 text-white font-semibold transition-all">
                <span class="flex items-center gap-3">
                    <span class="text-base">🤝</span>
                    <span>A Philanthropist</span>
                </span>
                <span class="text-gray-400 text-xs">&rarr;</span>
            </a>

            <!-- NEWS -->
            <a href="#section-news" onclick="window.closeMobileNav()" class="flex items-center justify-between p-3.5 rounded-xl bg-white/5 hover:bg-white/10 border border-white/10 text-white font-semibold transition-all">
                <span class="flex items-center gap-3">
                    <span class="text-base">📰</span>
                    <span>NEWS</span>
                </span>
                <span class="text-gray-400 text-xs">&rarr;</span>
            </a>

            <!-- 2027 Campaign -->
            <a href="/campaign-2027" class="flex items-center justify-between p-3.5 rounded-xl bg-gradient-to-r from-amber-500/20 to-amber-600/10 border border-amber-400/50 text-amber-300 font-bold transition-all shadow-lg shadow-amber-500/10">
                <span class="flex items-center gap-3">
                    <span class="w-2.5 h-2.5 rounded-full bg-amber-400 animate-pulse"></span>
                    <span>• 2027 Campaign (War Room)</span>
                </span>
                <span class="px-2 py-0.5 rounded-md bg-amber-400 text-black text-[10px] font-black uppercase">Active</span>
            </a>

            <!-- About -->
            <a href="javascript:void(0);" onclick="window.closeMobileNav(); window.openAboutModal(event);" class="flex items-center justify-between p-3.5 rounded-xl bg-white/5 hover:bg-white/10 border border-white/10 text-white font-semibold transition-all">
                <span class="flex items-center gap-3">
                    <span class="text-base">ℹ️</span>
                    <span>About Dr. Ifeanyi Odii</span>
                </span>
                <span class="text-gray-400 text-xs">&rarr;</span>
            </a>

            <!-- Contact -->
            <a href="/contact" class="flex items-center justify-between p-3.5 rounded-xl bg-white/5 hover:bg-white/10 border border-white/10 text-white font-semibold transition-all">
                <span class="flex items-center gap-3">
                    <span class="text-base">📞</span>
                    <span>Contact Official Office</span>
                </span>
                <span class="text-gray-400 text-xs">&rarr;</span>
            </a>

            <!-- Press Centre -->
            <a href="/press" class="flex items-center justify-between p-3.5 rounded-xl bg-white/5 hover:bg-white/10 border border-white/10 text-white font-semibold transition-all">
                <span class="flex items-center gap-3">
                    <span class="text-base">🏛️</span>
                    <span>Executive Press Centre</span>
                </span>
                <span class="text-gray-400 text-xs">&rarr;</span>
            </a>

            <!-- Big Golden Join 2027 Movement CTA -->
            <button type="button" onclick="window.closeMobileNav(); window.openVolunteerModal(event);"
                class="w-full mt-2 py-3.5 px-5 bg-gradient-to-r from-amber-400 via-amber-300 to-amber-500 text-black font-black uppercase tracking-wider rounded-2xl shadow-xl shadow-amber-500/30 flex items-center justify-center gap-2 text-sm cursor-pointer active:scale-[0.98] transition-all">
                <span class="w-2 h-2 rounded-full bg-black animate-ping"></span>
                <span>JOIN 2027 MOVEMENT</span>
            </button>

            <!-- Social Media Hub -->
            <div class="mt-4 pt-4 border-t border-white/10 flex flex-col gap-2">
                <span class="text-[10px] font-bold uppercase tracking-widest text-gray-400">Follow Anyichuks Online</span>
                <div class="grid grid-cols-2 gap-2">
                    <a href="https://x.com/ifeanyiCodii" target="_blank" rel="noopener noreferrer" class="flex items-center gap-2.5 p-2.5 rounded-xl bg-white/5 border border-white/10 text-xs text-white hover:border-amber-400 transition-colors">
                        <svg class="w-4 h-4 text-amber-400 shrink-0" fill="currentColor" viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 22.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"></path></svg>
                        <span class="font-medium truncate">𝕏 (Twitter)</span>
                    </a>
                    <a href="https://www.instagram.com/ifeanyicodii/" target="_blank" rel="noopener noreferrer" class="flex items-center gap-2.5 p-2.5 rounded-xl bg-white/5 border border-white/10 text-xs text-white hover:border-amber-400 transition-colors">
                        <svg class="w-4 h-4 text-pink-400 shrink-0" fill="currentColor" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z" clip-rule="evenodd"></path></svg>
                        <span class="font-medium truncate">Instagram</span>
                    </a>
                    <a href="https://web.facebook.com/ifeanyiCodii/?_rdc=1&_rdr" target="_blank" rel="noopener noreferrer" class="flex items-center gap-2.5 p-2.5 rounded-xl bg-white/5 border border-white/10 text-xs text-white hover:border-amber-400 transition-colors">
                        <svg class="w-4 h-4 text-blue-400 shrink-0" fill="currentColor" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" clip-rule="evenodd"></path></svg>
                        <span class="font-medium truncate">Facebook</span>
                    </a>
                    <a href="https://www.tiktok.com/@ifeanyicodii" target="_blank" rel="noopener noreferrer" class="flex items-center gap-2.5 p-2.5 rounded-xl bg-white/5 border border-white/10 text-xs text-white hover:border-amber-400 transition-colors">
                        <svg class="w-4 h-4 text-cyan-400 shrink-0" fill="currentColor" viewBox="0 0 24 24"><path d="M12.525.02c1.31-.02 2.61-.01 3.91-.02.08 1.53.63 3.09 1.75 4.17 1.12 1.11 2.7 1.62 4.24 1.79v4.03c-1.44-.05-2.89-.35-4.2-.97-.57-.26-1.1-.59-1.62-.93-.01 2.92.01 5.84-.02 8.75-.08 2.23-1.15 4.39-2.92 5.86-1.57 1.3-3.66 1.94-5.69 1.7-2.12-.23-4.06-1.3-5.32-2.93-1.39-1.78-1.92-4.14-1.42-6.32.48-2.17 1.87-4.07 3.8-5.11 2.01-1.07 4.43-1.22 6.6-.47v4.15c-1.16-.36-2.45-.41-3.63-.04-1.12.35-2.09 1.11-2.6 2.16-.54 1.12-.59 2.44-.15 3.59.45 1.2 1.48 2.15 2.72 2.49 1.28.36 2.69.19 3.84-.46 1.19-.69 1.99-1.91 2.18-3.26.23-1.48.16-2.98.17-4.47V.02z"></path></svg>
                        <span class="font-medium truncate">TikTok</span>
                </div>
            </div>
        </div>
    </div>

    <!-- World Clock Panel (Right Side, Fixed globally matching desktop view, Hidden on mobile) -->
    <div id="world-clocks-panel"
        class="hidden md:flex fixed right-6 md:right-12 lg:right-12 z-[30] flex-col gap-4 p-5 bg-transparent w-[280px] transition-all"
        style="top: 100px;">
        <div class="flex items-center justify-between pb-3 mb-1">
            <h3 class="text-[11px] font-extrabold tracking-widest text-white/60 uppercase">WORLD CLOCK</h3>
            <span class="flex h-2 w-2 relative">
                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-cyan-400 opacity-75"></span>
                <span class="relative inline-flex rounded-full h-2 w-2 bg-cyan-500"></span>
            </span>
        </div>

        <div class="flex flex-col gap-4" id="world-clocks-container">
            <!-- Nigeria (Lagos) - Primary Home/Local Dial -->
            <div class="flex items-center justify-between gap-3 group" id="row-nigeria">
                <div class="relative flex-shrink-0">
                    <svg id="analog-nigeria" class="w-16 h-16 rounded-full shadow-lg transition-transform group-hover:scale-105" viewBox="0 0 100 100">
                        <circle cx="50" cy="50" r="48" class="clock-face-bg" stroke-width="1.5" />
                        <!-- Hour ticks (12) and minutes (60) generated via JS -->
                        <g class="clock-ticks" stroke-width="1.5" stroke-linecap="round"></g>
                        <!-- Numbers generated via JS -->
                        <g class="clock-numbers" font-size="10" font-family="Inter, sans-serif" font-weight="700" text-anchor="middle" dominant-baseline="central"></g>
                        <!-- Hands -->
                        <line id="hand-hour-nigeria" x1="50" y1="50" x2="50" y2="28" stroke-width="3" stroke-linecap="round" class="clock-hand-hour" />
                        <line id="hand-minute-nigeria" x1="50" y1="50" x2="50" y2="18" stroke-width="1.8" stroke-linecap="round" class="clock-hand-minute" />
                        <line id="hand-second-nigeria" x1="50" y1="50" x2="50" y2="12" stroke-width="0.8" stroke-linecap="round" stroke="#f97316" />
                        <!-- Center Peg -->
                        <circle cx="50" cy="50" r="3" fill="#f97316" />
                        <circle cx="50" cy="50" r="1.2" fill="#fff" />
                    </svg>
                </div>
                <div class="flex-grow min-w-0">
                    <div class="flex items-center gap-1">
                        <span class="text-xs font-bold tracking-wide text-cyan-400 truncate">Nigeria</span>
                        <svg class="w-3 h-3 text-cyan-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                        </svg>
                    </div>
                    <div class="text-[9px] text-white/40 font-semibold tracking-wide flex gap-1 items-center">
                        <span id="day-nigeria">Today</span>
                        <span>•</span>
                        <span id="offset-nigeria">Home</span>
                    </div>
                </div>
                <div class="text-right flex-shrink-0 font-mono text-xs font-bold text-white/95" id="digital-nigeria">
                    --:--
                </div>
            </div>

            <!-- Cupertino -->
            <div class="flex items-center justify-between gap-3 group" id="row-cupertino">
                <div class="relative flex-shrink-0">
                    <svg id="analog-cupertino" class="w-16 h-16 rounded-full shadow-lg transition-transform group-hover:scale-105" viewBox="0 0 100 100">
                        <circle cx="50" cy="50" r="48" class="clock-face-bg" stroke-width="1.5" />
                        <g class="clock-ticks" stroke-width="1.5" stroke-linecap="round"></g>
                        <g class="clock-numbers" font-size="10" font-family="Inter, sans-serif" font-weight="700" text-anchor="middle" dominant-baseline="central"></g>
                        <line id="hand-hour-cupertino" x1="50" y1="50" x2="50" y2="28" stroke-width="3" stroke-linecap="round" class="clock-hand-hour" />
                        <line id="hand-minute-cupertino" x1="50" y1="50" x2="50" y2="18" stroke-width="1.8" stroke-linecap="round" class="clock-hand-minute" />
                        <line id="hand-second-cupertino" x1="50" y1="50" x2="50" y2="12" stroke-width="0.8" stroke-linecap="round" stroke="#f97316" />
                        <circle cx="50" cy="50" r="3" fill="#f97316" />
                        <circle cx="50" cy="50" r="1.2" fill="#fff" />
                    </svg>
                </div>
                <div class="flex-grow min-w-0">
                    <span class="text-xs font-bold tracking-wide text-white/80 group-hover:text-white transition-colors truncate block">Cupertino</span>
                    <div class="text-[9px] text-white/40 font-semibold tracking-wide flex gap-1 items-center">
                        <span id="day-cupertino">Today</span>
                        <span>•</span>
                        <span id="offset-cupertino">--HRS</span>
                    </div>
                </div>
                <div class="text-right flex-shrink-0 font-mono text-xs font-bold text-white/80" id="digital-cupertino">
                    --:--
                </div>
            </div>

            <!-- Tokyo -->
            <div class="flex items-center justify-between gap-3 group" id="row-tokyo">
                <div class="relative flex-shrink-0">
                    <svg id="analog-tokyo" class="w-16 h-16 rounded-full shadow-lg transition-transform group-hover:scale-105" viewBox="0 0 100 100">
                        <circle cx="50" cy="50" r="48" class="clock-face-bg" stroke-width="1.5" />
                        <g class="clock-ticks" stroke-width="1.5" stroke-linecap="round"></g>
                        <g class="clock-numbers" font-size="10" font-family="Inter, sans-serif" font-weight="700" text-anchor="middle" dominant-baseline="central"></g>
                        <line id="hand-hour-tokyo" x1="50" y1="50" x2="50" y2="28" stroke-width="3" stroke-linecap="round" class="clock-hand-hour" />
                        <line id="hand-minute-tokyo" x1="50" y1="50" x2="50" y2="18" stroke-width="1.8" stroke-linecap="round" class="clock-hand-minute" />
                        <line id="hand-second-tokyo" x1="50" y1="50" x2="50" y2="12" stroke-width="0.8" stroke-linecap="round" stroke="#f97316" />
                        <circle cx="50" cy="50" r="3" fill="#f97316" />
                        <circle cx="50" cy="50" r="1.2" fill="#fff" />
                    </svg>
                </div>
                <div class="flex-grow min-w-0">
                    <span class="text-xs font-bold tracking-wide text-white/80 group-hover:text-white transition-colors truncate block">Tokyo</span>
                    <div class="text-[9px] text-white/40 font-semibold tracking-wide flex gap-1 items-center">
                        <span id="day-tokyo">Today</span>
                        <span>•</span>
                        <span id="offset-tokyo">--HRS</span>
                    </div>
                </div>
                <div class="text-right flex-shrink-0 font-mono text-xs font-bold text-white/80" id="digital-tokyo">
                    --:--
                </div>
            </div>

            <!-- Sydney -->
            <div class="flex items-center justify-between gap-3 group" id="row-sydney">
                <div class="relative flex-shrink-0">
                    <svg id="analog-sydney" class="w-16 h-16 rounded-full shadow-lg transition-transform group-hover:scale-105" viewBox="0 0 100 100">
                        <circle cx="50" cy="50" r="48" class="clock-face-bg" stroke-width="1.5" />
                        <g class="clock-ticks" stroke-width="1.5" stroke-linecap="round"></g>
                        <g class="clock-numbers" font-size="10" font-family="Inter, sans-serif" font-weight="700" text-anchor="middle" dominant-baseline="central"></g>
                        <line id="hand-hour-sydney" x1="50" y1="50" x2="50" y2="28" stroke-width="3" stroke-linecap="round" class="clock-hand-hour" />
                        <line id="hand-minute-sydney" x1="50" y1="50" x2="50" y2="18" stroke-width="1.8" stroke-linecap="round" class="clock-hand-minute" />
                        <line id="hand-second-sydney" x1="50" y1="50" x2="50" y2="12" stroke-width="0.8" stroke-linecap="round" stroke="#f97316" />
                        <circle cx="50" cy="50" r="3" fill="#f97316" />
                        <circle cx="50" cy="50" r="1.2" fill="#fff" />
                    </svg>
                </div>
                <div class="flex-grow min-w-0">
                    <span class="text-xs font-bold tracking-wide text-white/80 group-hover:text-white transition-colors truncate block">Sydney</span>
                    <div class="text-[9px] text-white/40 font-semibold tracking-wide flex gap-1 items-center">
                        <span id="day-sydney">Today</span>
                        <span>•</span>
                        <span id="offset-sydney">--HRS</span>
                    </div>
                </div>
                <div class="text-right flex-shrink-0 font-mono text-xs font-bold text-white/80" id="digital-sydney">
                    --:--
                </div>
            </div>

            <!-- Paris -->
            <div class="flex items-center justify-between gap-3 group" id="row-paris">
                <div class="relative flex-shrink-0">
                    <svg id="analog-paris" class="w-16 h-16 rounded-full shadow-lg transition-transform group-hover:scale-105" viewBox="0 0 100 100">
                        <circle cx="50" cy="50" r="48" class="clock-face-bg" stroke-width="1.5" />
                        <g class="clock-ticks" stroke-width="1.5" stroke-linecap="round"></g>
                        <g class="clock-numbers" font-size="10" font-family="Inter, sans-serif" font-weight="700" text-anchor="middle" dominant-baseline="central"></g>
                        <line id="hand-hour-paris" x1="50" y1="50" x2="50" y2="28" stroke-width="3" stroke-linecap="round" class="clock-hand-hour" />
                        <line id="hand-minute-paris" x1="50" y1="50" x2="50" y2="18" stroke-width="1.8" stroke-linecap="round" class="clock-hand-minute" />
                        <line id="hand-second-paris" x1="50" y1="50" x2="50" y2="12" stroke-width="0.8" stroke-linecap="round" stroke="#f97316" />
                        <circle cx="50" cy="50" r="3" fill="#f97316" />
                        <circle cx="50" cy="50" r="1.2" fill="#fff" />
                    </svg>
                </div>
                <div class="flex-grow min-w-0">
                    <span class="text-xs font-bold tracking-wide text-white/80 group-hover:text-white transition-colors truncate block">Paris</span>
                    <div class="text-[9px] text-white/40 font-semibold tracking-wide flex gap-1 items-center">
                        <span id="day-paris">Today</span>
                        <span>•</span>
                        <span id="offset-paris">--HRS</span>
                    </div>
                </div>
                <div class="text-right flex-shrink-0 font-mono text-xs font-bold text-white/80" id="digital-paris">
                    --:--
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content Container with Full-Bleed Layout on Desktop, Friendly Margins on Mobile -->
    <main class="relative z-10 w-full flex-grow flex flex-col items-center justify-center pt-[72px] sm:pt-20 pb-8 px-3 sm:px-5 md:px-0 md:py-0">
        <!-- WordPress FAQ / Accordion Dropdown Blocks -->
        <div class="w-full max-w-7xl md:max-w-none mx-auto text-left flex flex-col gap-0 md:border-t md:border-white/10">

            <details id="section-home" class="group w-full accordion-section">
                <summary
                    class="relative w-full h-screen h-[100dvh] border-b border-white/10 overflow-hidden cursor-pointer select-none list-none transition-all duration-300">
                    <!-- Removed redundant background image for steady parallax effect -->

                    <!-- Dark overlay to ensure text readability -->
                    <div class="absolute inset-0 bg-black/20 group-hover:bg-black/10 transition-colors duration-300 pointer-events-none">
                    </div>

                    <!-- Mobile Dedicated 16:9 Boardroom Showcase Card (Mobile Only: 100% Uncropped Boardroom View) -->
                    <div class="md:hidden w-full mb-4">
                        <div class="w-full aspect-video rounded-xl sm:rounded-2xl overflow-hidden relative border border-amber-400/40 shadow-2xl bg-black">
                            <img id="mobile-boardroom-card-img"
                                 src="{{ asset('images/landing-profile.png') }}?v={{ file_exists(public_path('images/landing-profile.png')) ? filemtime(public_path('images/landing-profile.png')) : time() }}"
                                 alt="Dr. Ifeanyi Chukwuma Odii - ANYI GA EMEYA 2027 PDP Flagship"
                                 class="w-full h-full object-cover transition-all duration-300 select-none">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-black/30 pointer-events-none"></div>
                            <!-- Badge -->
                            <div class="absolute top-2.5 left-2.5 flex items-center gap-1.5 px-2.5 py-1 rounded-full bg-black/80 backdrop-blur-md border border-amber-400/60 text-[10px] font-bold text-amber-300 shadow-md">
                                <span class="w-2 h-2 rounded-full bg-amber-400 animate-pulse"></span>
                                <span>ANYI GA EMEYA 2027 PDP</span>
                            </div>
                        </div>
                    </div>

                    <!-- Small title on the far left (Exact Desktop Layout from Screenshot) -->
                    <div
                        class="summary-text-container absolute left-6 md:left-12 top-1/2 -translate-y-1/2 flex flex-col gap-3 md:gap-4 z-10 max-w-[460px] lg:max-w-[540px] text-left">
                        <p
                            class="stylish-reveal-text text-sm md:text-base lg:text-lg font-light text-gray-200 leading-relaxed tracking-wide">
                            Dr. Ifeanyi Chukwuma Odii is a businessman and philanthropist with vast experience spanning
                            over 20 years in building and managing businesses across various sectors. He is the
                            Founder/Chairman of Orient Global Group with subsidiary companies; Orient Global
                            Manufacturing, Orient Haulage & Logistics, and Purity Agro-Allied Ltd. He is also the
                            President/CEO of Ultimus Holdings with subsidiary companies; Ultimus Construction, Ultimus
                            Properties, and Ultimus Global Integrated (owners of The Classroom by Ultimus, Viarmor
                            Healthcare Ltd.) With investment portfolios that cut across sectors like – manufacturing,
                            logistics, construction, real estate, healthcare, trade, and services, Dr. Ifeanyi has
                            successfully grown these businesses outside the shores of Nigeria to Sub-Sharan Africa.
                        </p>
                        <div class="flex items-start gap-4">
                            <img src="{{ asset('images/pointer.png') }}" alt="Pointer"
                                class="w-8 h-8 md:w-10 md:h-10 object-contain shrink-0 mt-0.5">
                            <div class="flex flex-col items-center gap-1">
                                <span
                                    class="text-xs md:text-sm font-bold tracking-widest uppercase text-amber-400 leading-relaxed">
                                    Home
                                </span>
                                <svg class="hero-chevron-arrow w-8 h-5 md:w-[22vw] md:max-w-[260px] h-auto text-white opacity-95 transition-transform duration-500 group-open:rotate-180"
                                    viewBox="0 0 100 60" fill="none" stroke="currentColor" stroke-width="18"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M10 12 L50 48 L90 12" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </summary>
                <div
                    class="dropdown-content-panel relative w-full min-h-screen lg:h-screen lg:h-[100dvh] bg-black/75 backdrop-blur-xl border-b border-white/10 flex flex-col justify-start p-6 md:p-12 lg:p-16 overflow-y-auto z-20">
                    
                    <!-- Widescreen Container -->
                    <div class="max-w-7xl mx-auto w-full flex flex-col gap-6 md:gap-8 h-full">
                        
                        <!-- Header with dynamic accents -->
                        <div class="flex flex-col md:flex-row justify-between items-start md:items-center border-b border-white/10 pb-4 shrink-0">
                            <div>
                                <span class="text-xs font-bold tracking-widest text-cyan-400 uppercase block mb-1">Interactive Executive Profile</span>
                                <h2 class="text-2xl md:text-3xl lg:text-4xl font-extrabold text-white tracking-wide">Dr. Ifeanyi Chukwuma Odii</h2>
                            </div>
                            <p class="text-xs text-gray-400 max-w-md mt-2 md:mt-0 leading-relaxed">
                                Explore the career, enterprises, social impact initiatives, and leadership of one of West Africa's most prominent visionaries.
                            </p>
                        </div>

                        <!-- Main Interactive Grid -->
                        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-stretch flex-grow min-h-0">
                            
                            <!-- Left Sidebar: Gorgeous Navigation Tabs (lg:col-span-4) -->
                            <div class="lg:col-span-4 flex flex-col gap-3.5 justify-start shrink-0">
                                <span class="text-[10px] font-bold tracking-widest text-gray-500 uppercase select-none mb-1">Select Profile Sector</span>
                                
                                <button type="button" onclick="switchProfileTab('overview')" id="tab-overview"
                                    class="profile-tab-btn flex items-center justify-between text-left px-5 py-4 rounded-2xl border border-cyan-400 bg-cyan-400/10 text-white font-bold transition-all duration-300 hover:scale-[1.01] active:scale-[0.99] select-none">
                                    <div class="flex items-center gap-3">
                                        <div class="w-8 h-8 rounded-full bg-cyan-400/20 flex items-center justify-center text-cyan-400 text-sm font-bold">1</div>
                                        <div class="flex flex-col">
                                            <span class="text-sm font-bold tracking-wide">Executive Profile</span>
                                            <span class="text-[9px] font-medium text-cyan-300/80 uppercase tracking-wider mt-0.5">Overview & Career</span>
                                        </div>
                                    </div>
                                    <svg class="w-4 h-4 text-cyan-400" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                                    </svg>
                                </button>

                                <button type="button" onclick="switchProfileTab('business')" id="tab-business"
                                    class="profile-tab-btn flex items-center justify-between text-left px-5 py-4 rounded-2xl border border-white/10 bg-white/5 text-gray-300 font-semibold transition-all duration-300 hover:bg-white/10 hover:text-white hover:scale-[1.01] active:scale-[0.99] select-none">
                                    <div class="flex items-center gap-3">
                                        <div class="w-8 h-8 rounded-full bg-white/10 flex items-center justify-center text-gray-400 text-sm font-bold">2</div>
                                        <div class="flex flex-col">
                                            <span class="text-sm font-bold tracking-wide">Business Conglomerate</span>
                                            <span class="text-[9px] font-medium text-gray-400 uppercase tracking-wider mt-0.5">Orient Global & Ultimus</span>
                                        </div>
                                    </div>
                                    <svg class="w-4 h-4 opacity-50" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                                    </svg>
                                </button>

                                <button type="button" onclick="switchProfileTab('philanthropy')" id="tab-philanthropy"
                                    class="profile-tab-btn flex items-center justify-between text-left px-5 py-4 rounded-2xl border border-white/10 bg-white/5 text-gray-300 font-semibold transition-all duration-300 hover:bg-white/10 hover:text-white hover:scale-[1.01] active:scale-[0.99] select-none">
                                    <div class="flex items-center gap-3">
                                        <div class="w-8 h-8 rounded-full bg-white/10 flex items-center justify-center text-gray-400 text-sm font-bold">3</div>
                                        <div class="flex flex-col">
                                            <span class="text-sm font-bold tracking-wide">Philanthropic Legacy</span>
                                            <span class="text-[9px] font-medium text-gray-400 uppercase tracking-wider mt-0.5">Ebele & Anyichuks</span>
                                        </div>
                                    </div>
                                    <svg class="w-4 h-4 opacity-50" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                                    </svg>
                                </button>

                                <button type="button" onclick="switchProfileTab('politics')" id="tab-politics"
                                    class="profile-tab-btn flex items-center justify-between text-left px-5 py-4 rounded-2xl border border-white/10 bg-white/5 text-gray-300 font-semibold transition-all duration-300 hover:bg-white/10 hover:text-white hover:scale-[1.01] active:scale-[0.99] select-none">
                                    <div class="flex items-center gap-3">
                                        <div class="w-8 h-8 rounded-full bg-white/10 flex items-center justify-center text-gray-400 text-sm font-bold">4</div>
                                        <div class="flex flex-col">
                                            <span class="text-sm font-bold tracking-wide">Political Reform</span>
                                            <span class="text-[9px] font-medium text-gray-400 uppercase tracking-wider mt-0.5">Ebonyi Gubernatorial Campaign</span>
                                        </div>
                                    </div>
                                    <svg class="w-4 h-4 opacity-50" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                                    </svg>
                                </button>
                            </div>

                            <!-- Right Content Panel: Dynamic Widescreen Showcase (lg:col-span-8) -->
                            <div class="lg:col-span-8 bg-white/5 border border-white/10 rounded-3xl p-6 md:p-8 flex flex-col md:flex-row gap-6 md:gap-8 items-stretch overflow-y-auto shadow-2xl relative">
                                
                                <!-- Tab Image Container (Half-width on desktop) -->
                                <div class="w-full md:w-5/12 h-64 md:h-auto rounded-2xl overflow-hidden relative border border-white/10 shrink-0 shadow-lg">
                                    <img id="tab-showcase-image" src="{{ asset('images/landing-profile.png') }}?v={{ filemtime(public_path('images/landing-profile.png')) }}?v={{ filemtime(public_path('images/landing-profile.png')) }}" alt="Dr. Ifeanyi Chukwuma Odii"
                                        class="absolute inset-0 w-full h-full object-cover transition-opacity duration-300">
                                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent"></div>
                                    
                                    <!-- Embedded Small Label -->
                                    <span id="tab-image-badge" class="absolute bottom-4 left-4 bg-cyan-500 text-black text-[9px] font-bold uppercase tracking-wider px-2.5 py-1 rounded-md shadow-md">
                                        Executive Office
                                    </span>
                                </div>

                                <!-- Tab Content Details (Half-width on desktop) -->
                                <div class="flex flex-col justify-between flex-grow">
                                    <div class="space-y-4">
                                        <h3 id="tab-showcase-title" class="text-xl md:text-2xl font-extrabold text-white tracking-wide border-b border-white/5 pb-3">
                                            Who is Dr. Ifeanyi Chukwuma Odii?
                                        </h3>
                                        
                                        <!-- Main Bullet/Paragraph Content -->
                                        <div id="tab-showcase-body" class="text-xs md:text-sm text-gray-300 leading-relaxed space-y-3 max-h-[300px] overflow-y-auto pr-1">
                                            <p>Dr. Ifeanyi Chukwuma Odii is a distinguished Nigerian business leader, philanthropist, and politician with over 20 years of experience building thriving corporate empires and advocating for community growth across Sub-Saharan Africa.</p>
                                            <ul class="list-disc pl-5 space-y-2 text-gray-400">
                                                <li>Founder and Chairman of Orient Global Group, a multi-sector conglomerate.</li>
                                                <li>President/CEO of Ultimus Holdings, a leading construction, logistics, and real estate developer.</li>
                                                <li>Co-founder of the Ebele & Anyichuks Foundation, a charity that has built over 140 free homes for widows.</li>
                                                <li>2023 Ebonyi State PDP Gubernatorial candidate championing educational and economic reforms.</li>
                                            </ul>
                                        </div>
                                    </div>

                                    <!-- Quick Action Button inside tab -->
                                    <div class="pt-6 border-t border-white/5 mt-4 flex items-center justify-between shrink-0">
                                        <span class="text-[10px] text-cyan-400 font-bold uppercase tracking-widest">Premium Executive Dossier</span>
                                        <a href="/contact" class="px-5 py-2.5 bg-cyan-400 hover:bg-cyan-300 text-black font-bold uppercase rounded-xl text-xs transition-all active:scale-95 shadow-md flex items-center gap-1.5">
                                            <span>Get in Touch</span>
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                            </svg>
                                        </a>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>
            </details>

            <details id="section-philanthropist" class="group w-full accordion-section">
                <summary
                    class="relative w-full h-screen h-[100dvh] border-b border-white/10 overflow-hidden cursor-pointer select-none list-none transition-all duration-300">
                    <!-- Removed redundant background image for steady parallax effect -->

                    <!-- Dark overlay to ensure text readability -->
                    <div class="absolute inset-0 bg-black/20 group-hover:bg-black/10 transition-colors duration-300">
                    </div>

                    <!-- Small title on the far left -->
                    <div
                        class="summary-text-container absolute left-6 md:left-12 top-1/2 -translate-y-1/2 flex flex-col gap-4 z-10 max-w-[90%] sm:max-w-[420px] md:max-w-[500px] lg:max-w-[600px] text-left">
                        <p
                            class="stylish-reveal-text text-sm md:text-base lg:text-lg font-light text-gray-200 leading-relaxed tracking-wide">
                            Ebele and Anyichuks foundation donated 10,000 copies of the West Africa Examination Council
                            (WAEC) past questions and answers to students in Ebonyi state. This initiative is part of
                            the foundation’s commitment to reduce the poor academic performance of students in external
                            examinations such as West African Examination Council (WAEC) and National Examination
                            Council (NECO) Examinations. The project involves the donation of free academic materials,
                            free tutorials and the provision of scholarship for university education for students.
                        </p>
                        <div class="flex items-start gap-4">
                            <img src="{{ asset('images/pointer.png') }}" alt="Pointer"
                                class="w-8 h-8 md:w-10 h-10 object-contain shrink-0 mt-0.5">
                            <div class="flex flex-col items-center gap-1">
                                <span
                                    class="text-xs md:text-sm font-bold tracking-widest uppercase text-white leading-relaxed">
                                    A philanthropist
                                </span>
                                <svg class="hero-chevron-arrow w-8 h-5 md:w-[30vw] md:max-w-[320px] h-auto text-white opacity-95 transition-transform duration-500 group-open:rotate-180"
                                    viewBox="0 0 100 60" fill="none" stroke="currentColor" stroke-width="18"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M10 12 L50 48 L90 12" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </summary>
                <div
                    class="dropdown-content-panel relative w-full h-screen h-[100dvh] bg-black/40 backdrop-blur-md border-b border-white/10 flex flex-col items-center justify-center p-8 md:p-16 lg:p-24 pb-20 md:pb-36 lg:pb-48 text-center gap-8 overflow-hidden">
                    <!-- Removed redundant background image for steady parallax effect -->
                    <!-- Removed extra dark overlay for brighter background -->
                    <div class="relative z-10 max-w-3xl flex flex-col items-center justify-center gap-8">
                        <a href="#" id="open-philanthropy-btn"
                            class="inline-flex items-center gap-3 px-8 py-4 bg-red-600 hover:bg-red-700 text-white font-bold tracking-widest rounded-full transition-all uppercase text-xs md:text-sm shadow-2xl hover:scale-105 active:scale-95">
                            VIEW HERE
                        </a>
                    </div>
                </div>
            </details>

            <details id="section-news" class="group w-full accordion-section">
                <summary
                    class="relative w-full h-screen h-[100dvh] border-b border-white/10 overflow-hidden cursor-pointer select-none list-none transition-all duration-300">
                    <!-- Removed redundant background image for steady parallax effect -->

                    <!-- Dark overlay to ensure text readability -->
                    <div class="absolute inset-0 bg-black/20 group-hover:bg-black/10 transition-colors duration-300">
                    </div>

                    <!-- Small title on the far left -->
                    <div
                        class="summary-text-container absolute left-6 md:left-12 top-1/2 -translate-y-1/2 flex flex-col gap-4 z-10 max-w-[90%] sm:max-w-[420px] md:max-w-[500px] lg:max-w-[600px] text-left">
                        <p
                            class="stylish-reveal-text text-sm md:text-base lg:text-lg font-light text-gray-200 leading-relaxed tracking-wide">
                            Stay informed with real-time, live updates from trusted news networks across Nigeria,
                            Africa, and the World.
                        </p>
                        <div class="flex items-start gap-4">
                            <img src="{{ asset('images/pointer.png') }}" alt="Pointer"
                                class="w-8 h-8 md:w-10 h-10 object-contain shrink-0 mt-0.5">
                            <div class="flex flex-col items-center gap-1">
                                <span
                                    class="text-xs md:text-sm font-bold tracking-widest uppercase text-white leading-relaxed">
                                    News
                                </span>
                                <svg class="hero-chevron-arrow w-8 h-5 md:w-[30vw] md:max-w-[320px] h-auto text-white opacity-95 transition-transform duration-500 group-open:rotate-180"
                                    viewBox="0 0 100 60" fill="none" stroke="currentColor" stroke-width="18"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M10 12 L50 48 L90 12" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </summary>
                <div
                    class="dropdown-content-panel relative w-full h-screen h-[100dvh] bg-black/40 backdrop-blur-md border-b border-white/10 flex flex-col items-center justify-center p-8 md:p-16 lg:p-24 pb-20 md:pb-36 lg:pb-48 text-center gap-8 overflow-hidden">
                    <!-- Removed redundant background image for steady parallax effect -->
                    <!-- Removed extra dark overlay for brighter background -->
                    <div
                        class="relative z-10 w-full max-w-4xl flex flex-col items-center justify-center gap-6 md:gap-10">
                        <div
                            class="flex items-center gap-3 px-4 py-2 bg-red-600/20 border border-red-500/30 rounded-full animate-pulse">
                            <span class="w-3 h-3 bg-red-500 rounded-full shadow-[0_0_10px_rgba(239,68,68,0.8)]"></span>
                            <span class="text-xs md:text-sm font-bold tracking-widest uppercase text-red-500">Live
                                Global Updates</span>
                        </div>

                        <div id="live-news-grid"
                            class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 w-full max-w-7xl max-h-[60vh] overflow-y-auto custom-scrollbar p-4 text-left transition-opacity duration-700 opacity-0">
                            <!-- Dynamic News injected here -->
                            <div class="col-span-full flex flex-col items-center justify-center py-12">
                                <svg class="w-8 h-8 text-amber-400 animate-spin mb-4" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                        stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor"
                                        d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                    </path>
                                </svg>
                                <p class="text-sm md:text-lg font-light text-gray-400 tracking-wide">Connecting to news
                                    networks...</p>
                            </div>
                        </div>
                    </div>
                </div>
            </details>

            <details id="section-media" class="group w-full accordion-section">
                <summary
                    class="relative w-full h-screen h-[100dvh] border-b border-white/10 overflow-hidden cursor-pointer select-none list-none transition-all duration-300">
                    <!-- Removed redundant background image for steady parallax effect -->

                    <!-- Dark overlay to ensure text readability -->
                    <div class="absolute inset-0 bg-black/20 group-hover:bg-black/10 transition-colors duration-300">
                    </div>

                    <!-- Small title on the far left -->
                    <div
                        class="summary-text-container absolute left-6 md:left-12 top-1/2 -translate-y-1/2 flex flex-col gap-4 z-10 max-w-[90%] sm:max-w-[420px] md:max-w-[500px] lg:max-w-[600px] text-left">
                        <p
                            class="stylish-reveal-text text-sm md:text-base lg:text-lg font-light text-gray-200 leading-relaxed tracking-wide">
                            Explore our latest media broadcasts, entertainment showcases, and exclusive video coverage.
                        </p>
                        <div class="flex items-start gap-4">
                            <img src="{{ asset('images/pointer.png') }}" alt="Pointer"
                                class="w-8 h-8 md:w-10 h-10 object-contain shrink-0 mt-0.5">
                            <div class="flex flex-col items-center gap-1">
                                <span
                                    class="text-xs md:text-sm font-bold tracking-widest uppercase text-white leading-relaxed">
                                    Media and entertainment
                                </span>
                                <svg class="hero-chevron-arrow w-8 h-5 md:w-[30vw] md:max-w-[320px] h-auto text-white opacity-95 transition-transform duration-500 group-open:rotate-180"
                                    viewBox="0 0 100 60" fill="none" stroke="currentColor" stroke-width="18"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M10 12 L50 48 L90 12" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </summary>
                <div
                    class="dropdown-content-panel relative w-full h-screen h-[100dvh] bg-black/40 backdrop-blur-md border-b border-white/10 flex flex-col items-center justify-center p-8 md:p-16 lg:p-24 pb-20 md:pb-36 lg:pb-48 text-center gap-8 overflow-hidden">
                    <!-- Removed redundant background image for steady parallax effect -->
                    <!-- Removed extra dark overlay for brighter background -->
                    <div
                        class="relative z-10 w-full max-w-6xl flex flex-col items-center justify-start gap-8 h-full py-8 md:py-12 overflow-y-auto custom-scrollbar">

                        <div id="fb-manual-video-gallery"
                            class="w-full flex flex-col items-center gap-8 lg:gap-12 pb-12">
                            <div class="text-center max-w-2xl flex flex-col gap-4 px-4">
                                <h2 class="text-2xl md:text-4xl lg:text-5xl font-light tracking-wider text-white">
                                    Featured <span class="font-bold text-amber-400">Broadcasts</span>
                                </h2>
                                <p class="text-gray-300 text-sm md:text-base leading-relaxed">
                                    Our manual video grid is ready! Please paste the links to your favorite Facebook
                                    videos in the chat, and I will instantly plug them into these slots.
                                </p>
                            </div>

                            <!-- Video Grid -->
                            <div
                                class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8 w-full max-w-7xl px-4">
                                <!-- Placeholder 1 -->
                                <div
                                    class="w-full aspect-video bg-black border border-white/10 rounded-2xl overflow-hidden flex flex-col items-center justify-center relative group hover:border-amber-400 transition-colors duration-500 shadow-2xl">

                                    <!-- Close / Minimize Button -->
                                    <button onclick="this.parentElement.style.display='none'"
                                        class="absolute top-2 right-2 z-50 bg-black/60 hover:bg-red-600 text-white rounded-full p-2 backdrop-blur-sm transition-colors duration-300 shadow-lg group-hover:opacity-100 md:opacity-0 focus:opacity-100"
                                        title="Minimize Video">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M6 18L18 6M6 6l12 12"></path>
                                        </svg>
                                    </button>

                                    <iframe
                                        src="https://www.facebook.com/plugins/video.php?href=https%3A%2F%2Fwww.facebook.com%2Fwatch%2F%3Fv%3D607417373724244&show_text=false&width=560"
                                        width="560" height="315"
                                        style="border:none;overflow:hidden; position:absolute; top:0; left:0; width:100%; height:100%; z-index:10;"
                                        scrolling="no" frameborder="0" allowfullscreen="true"
                                        allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share"></iframe>
                                </div>
                                <!-- Placeholder 2 -->
                                <div
                                    class="w-full aspect-video bg-white/5 border border-white/10 rounded-2xl overflow-hidden flex flex-col items-center justify-center relative group hover:border-amber-400 transition-colors duration-500 shadow-2xl">
                                    <svg class="w-12 h-12 text-white/20 group-hover:text-amber-400 group-hover:scale-110 transition-all duration-500 mb-4"
                                        fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M8 5v14l11-7z" />
                                    </svg>
                                    <span
                                        class="text-white/50 text-xs md:text-sm font-medium tracking-widest uppercase">Video
                                        Placeholder 2</span>
                                </div>
                                <!-- Placeholder 3 -->
                                <div
                                    class="w-full aspect-video bg-white/5 border border-white/10 rounded-2xl overflow-hidden flex flex-col items-center justify-center relative group hover:border-amber-400 transition-colors duration-500 shadow-2xl">
                                    <svg class="w-12 h-12 text-white/20 group-hover:text-amber-400 group-hover:scale-110 transition-all duration-500 mb-4"
                                        fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M8 5v14l11-7z" />
                                    </svg>
                                    <span
                                        class="text-white/50 text-xs md:text-sm font-medium tracking-widest uppercase">Video
                                        Placeholder 3</span>
                                </div>
                                <!-- Placeholder 4 -->
                                <div
                                    class="w-full aspect-video bg-white/5 border border-white/10 rounded-2xl overflow-hidden flex flex-col items-center justify-center relative group hover:border-amber-400 transition-colors duration-500 shadow-2xl">
                                    <svg class="w-12 h-12 text-white/20 group-hover:text-amber-400 group-hover:scale-110 transition-all duration-500 mb-4"
                                        fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M8 5v14l11-7z" />
                                    </svg>
                                    <span
                                        class="text-white/50 text-xs md:text-sm font-medium tracking-widest uppercase">Video
                                        Placeholder 4</span>
                                </div>
                                <!-- Placeholder 5 -->
                                <div
                                    class="w-full aspect-video bg-white/5 border border-white/10 rounded-2xl overflow-hidden flex flex-col items-center justify-center relative group hover:border-amber-400 transition-colors duration-500 shadow-2xl">
                                    <svg class="w-12 h-12 text-white/20 group-hover:text-amber-400 group-hover:scale-110 transition-all duration-500 mb-4"
                                        fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M8 5v14l11-7z" />
                                    </svg>
                                    <span
                                        class="text-white/50 text-xs md:text-sm font-medium tracking-widest uppercase">Video
                                        Placeholder 5</span>
                                </div>
                                <!-- Placeholder 6 -->
                                <div
                                    class="w-full aspect-video bg-white/5 border border-white/10 rounded-2xl overflow-hidden flex flex-col items-center justify-center relative group hover:border-amber-400 transition-colors duration-500 shadow-2xl">
                                    <svg class="w-12 h-12 text-white/20 group-hover:text-amber-400 group-hover:scale-110 transition-all duration-500 mb-4"
                                        fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M8 5v14l11-7z" />
                                    </svg>
                                    <span
                                        class="text-white/50 text-xs md:text-sm font-medium tracking-widest uppercase">Video
                                        Placeholder 6</span>
                                </div>
                            </div>

                            <a href="https://www.facebook.com/share/1GoT34igNY/" target="_blank"
                                rel="noopener noreferrer"
                                class="mt-4 lg:mt-8 inline-flex items-center gap-3 px-8 py-4 bg-[#1877F2] hover:bg-[#166FE5] text-white font-bold tracking-widest rounded-full transition-all uppercase text-xs md:text-sm shadow-2xl hover:scale-105 active:scale-95">
                                WATCH MORE ON FACEBOOK
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path fill-rule="evenodd"
                                        d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z"
                                        clip-rule="evenodd"></path>
                                </svg>
                            </a>
                        </div>

                    </div>
                </div>
            </details>

            <details id="section-politics" class="group w-full accordion-section">
                <summary
                    class="relative w-full h-screen h-[100dvh] border-b border-white/10 overflow-hidden cursor-pointer select-none list-none transition-all duration-300">
                    <!-- Dark overlay to ensure text readability -->
                    <div class="absolute inset-0 bg-black/20 group-hover:bg-black/10 transition-colors duration-300">
                    </div>

                    <!-- Small title on the far left -->
                    <div
                        class="summary-text-container absolute left-6 md:left-12 top-1/2 -translate-y-1/2 flex flex-col gap-4 z-10 max-w-[90%] sm:max-w-[420px] md:max-w-[500px] lg:max-w-[600px] xl:max-w-[800px] text-left">
                        <p
                            class="stylish-reveal-text text-sm md:text-base lg:text-lg font-light text-gray-200 leading-relaxed tracking-wide md:max-h-[60vh] md:overflow-y-auto custom-scrollbar pr-2 pb-2">
                            My good people of Ebonyi State, I stand before you not just as a politician, but as a man
                            driven by a deep passion to make our beloved state work for every single one of us. For too
                            long, our wealth has been locked away while our people suffer, but I promise you that under
                            my watch, we will shift focus from mere cosmetic concrete structures to actual human capital
                            development that puts food on your table. I will aggressively establish local manufacturing
                            hubs to process our rich natural resources, launch advanced mechanized agriculture to
                            empower our farmers, and build modern tech and creative hubs to wipe out youth unemployment.
                            Beyond this, I give you my sacred word: civil servants will no longer be neglected—your
                            salaries, pensions, and gratuities will be paid promptly and fully, because a motivated
                            workforce is the backbone of growth. We will completely overhaul our neglected social
                            sectors by building a functional healthcare system with well-equipped primary healthcare
                            centers in every community and transforming our education system through rebuilt schools,
                            modern ICT laboratories, and robust scholarship programs. We will guarantee absolute
                            security across Ebonyi by equipping our local law enforcement and intelligence networks, and
                            I will personally step into our communities to resolve long-standing grievances and land
                            crises, establishing robust local peace committees to heal communal rifts and permanently
                            prevent further conflicts. Your hope will be restored, and together, we will build an Ebonyi
                            where prosperity belongs to everyone.
                        </p>
                        <div class="flex items-start gap-4">
                            <img src="{{ asset('images/pointer.png') }}" alt="Pointer"
                                class="w-8 h-8 md:w-10 h-10 object-contain shrink-0 mt-0.5">
                            <div class="flex flex-col items-center gap-1">
                                <span
                                    class="text-xs md:text-sm font-bold tracking-widest uppercase text-amber-400 leading-relaxed">
                                    ANYI GA EMEYA 2027
                                </span>
                                <svg class="hero-chevron-arrow w-8 h-5 md:w-[30vw] md:max-w-[320px] h-auto text-amber-400 opacity-95 transition-transform duration-500 group-open:rotate-180"
                                    viewBox="0 0 100 60" fill="none" stroke="currentColor" stroke-width="18"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M10 12 L50 48 L90 12" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </summary>
                <div
                    class="dropdown-content-panel relative w-full h-screen h-[100dvh] bg-black/40 backdrop-blur-md border-b border-white/10 flex flex-col items-center justify-center p-8 md:p-16 lg:p-24 pb-20 md:pb-36 lg:pb-48 text-center gap-8 overflow-hidden">
                    <div
                        class="relative z-10 w-full max-w-4xl flex flex-col items-center justify-center gap-6 md:gap-10">
                        <div
                            class="flex flex-wrap items-center justify-center gap-3">
                            <div class="flex items-center gap-3 px-5 py-2 bg-amber-500/20 border border-amber-400/40 rounded-full">
                                <span
                                    class="w-3 h-3 bg-amber-400 rounded-full shadow-[0_0_10px_rgba(245,158,11,0.8)] animate-pulse"></span>
                                <span
                                    class="text-xs md:text-sm font-bold tracking-widest uppercase text-amber-400">ANYI GA EMEYA 2027 CAMPAIGN HEADQUARTERS</span>
                            </div>
                            <button type="button" onclick="window.openVolunteerModal(event);"
                                class="px-5 py-2 bg-gradient-to-r from-amber-400 to-amber-500 hover:from-amber-300 hover:to-amber-400 text-black font-extrabold text-xs uppercase tracking-wider rounded-full transition-all shadow-lg hover:scale-105 flex items-center gap-2 cursor-pointer">
                                <span>Register as Campaign Ambassador</span> &rarr;
                            </button>
                        </div>
                        <div id="politics-news-grid"
                            class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 w-full max-w-7xl max-h-[60vh] overflow-y-auto custom-scrollbar p-4 text-left transition-opacity duration-700 opacity-0">
                            <!-- Dynamic News injected here -->
                            <div class="col-span-full flex flex-col items-center justify-center py-12">
                                <svg class="w-8 h-8 text-green-500 animate-spin mb-4" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                        stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor"
                                        d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                    </path>
                                </svg>
                                <p class="text-sm md:text-lg font-light text-gray-400 tracking-wide">Gathering political
                                    updates...</p>
                            </div>
                        </div>
                    </div>
                </div>
            </details>

            <details id="section-contact" class="group w-full accordion-section">
                <summary
                    class="relative w-full h-screen h-[100dvh] border-b border-white/10 overflow-hidden cursor-pointer select-none list-none transition-all duration-300">
                    <!-- Removed redundant background image for steady parallax effect -->

                    <!-- Dark overlay to ensure text readability -->
                    <div class="absolute inset-0 bg-black/20 group-hover:bg-black/10 transition-colors duration-300">
                    </div>

                    <!-- Small title on the far left -->
                    <div
                        class="summary-text-container absolute left-6 md:left-12 top-1/2 -translate-y-1/2 flex flex-col gap-4 z-10 max-w-[90%] sm:max-w-[420px] md:max-w-[500px] lg:max-w-[600px] text-left">
                        <p
                            class="stylish-reveal-text text-sm md:text-base lg:text-lg font-light text-gray-200 leading-relaxed tracking-wide">
                            Dr. Ifeanyi Chukwuma Odii is a businessman and philanthropist with vast experience spanning
                            over 20 years in building and managing businesses across various sectors. He is the
                            Founder/Chairman of Orient Global Group with subsidiary companies; Orient Global
                            Manufacturing, Orient Haulage & Logistics, and Purity Agro-Allied Ltd. He is also the
                            President/CEO of Ultimus Holdings with subsidiary companies; Ultimus Construction, Ultimus
                            Properties, and Ultimus Global Integrated (owners of The Classroom by Ultimus, Viarmor
                            Healthcare Ltd.) With investment portfolios that cut across sectors like – manufacturing,
                            logistics, construction, real estate, healthcare, trade, and services, Dr. Ifeanyi has
                            successfully grown these businesses outside the shores of Nigeria to Sub-Sharan Africa.
                        </p>
                        <div class="flex items-start gap-4">
                            <img src="{{ asset('images/pointer.png') }}" alt="Pointer"
                                class="w-8 h-8 md:w-10 h-10 object-contain shrink-0 mt-0.5">
                            <div class="flex flex-col items-center gap-1">
                                <span
                                    class="text-xs md:text-sm font-bold tracking-widest uppercase text-white leading-relaxed">
                                    About Me
                                </span>
                                <svg class="hero-chevron-arrow w-8 h-5 md:w-[30vw] md:max-w-[320px] h-auto text-white opacity-95 transition-transform duration-500 group-open:rotate-180"
                                    viewBox="0 0 100 60" fill="none" stroke="currentColor" stroke-width="18"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M10 12 L50 48 L90 12" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </summary>
                <div
                    class="dropdown-content-panel relative w-full h-screen h-[100dvh] bg-black/40 backdrop-blur-md border-b border-white/10 flex flex-col items-center justify-center p-8 md:p-16 lg:p-24 pb-20 md:pb-36 lg:pb-48 text-center gap-8 overflow-hidden">
                    <!-- Removed redundant background image for steady parallax effect -->
                    <!-- Removed extra dark overlay for brighter background -->
                    <div class="relative z-10 max-w-3xl flex flex-col items-center justify-center gap-8">
                        <p class="text-sm md:text-lg lg:text-xl font-light text-gray-200 leading-relaxed tracking-wide">
                            Dr. Ifeanyi Chukwuma Odii is a businessman and philanthropist with vast experience spanning
                            over 20 years in building and managing businesses across various sectors. He is the
                            Founder/Chairman of Orient Global Group with subsidiary companies; Orient Global
                            Manufacturing, Orient Haulage & Logistics, and Purity Agro-Allied Ltd. He is also the
                            President/CEO of Ultimus Holdings with subsidiary companies; Ultimus Construction, Ultimus
                            Properties, and Ultimus Global Integrated (owners of The Classroom by Ultimus, Viarmor
                            Healthcare Ltd.) With investment portfolios that cut across sectors like – manufacturing,
                            logistics, construction, real estate, healthcare, trade, and services, Dr. Ifeanyi has
                            successfully grown these businesses outside the shores of Nigeria to Sub-Sharan Africa.
                        </p>
                        <a href="javascript:void(0);" onclick="window.openAboutModal(event);" id="open-about-btn"
                            class="inline-flex items-center gap-3 px-8 py-4 bg-red-600 hover:bg-red-700 text-white font-bold tracking-widest rounded-full transition-all uppercase text-xs md:text-sm shadow-2xl hover:scale-105 active:scale-95">
                            VIEW HERE
                        </a>
                    </div>
                </div>
            </details>

        </div>
    </main>

    <footer class="relative z-10 w-full text-center py-6 border-t border-white/10 bg-black/30 text-xs text-gray-400">
        <p>© 2026 Ifeanyi Chukwuma Odii.</p>
    </footer>

    <script>
        document.querySelectorAll('details').forEach(details => {
            const summary = details.querySelector('summary');
            if (!summary) return;

            summary.addEventListener('click', (e) => {
                // If it is already open, it is about to close, so let the browser handle it naturally
                if (details.open) {
                    return;
                }

                // Close all other details cards to keep the viewport clean
                document.querySelectorAll('details').forEach(otherDetails => {
                    if (otherDetails !== details && otherDetails.open) {
                        otherDetails.removeAttribute('open');
                    }
                });

                // Smooth auto-scroll with header offset so open accordion content is never covered by header
                setTimeout(() => {
                    const panel = details.querySelector('.dropdown-content-panel');
                    if (panel && window.innerWidth <= 768) {
                        const headerOffset = 72;
                        const elementPosition = panel.getBoundingClientRect().top;
                        const offsetPosition = elementPosition + window.pageYOffset - headerOffset;
                        window.scrollTo({
                            top: offsetPosition,
                            behavior: 'smooth'
                        });
                    } else if (panel) {
                        panel.scrollIntoView({ behavior: 'smooth', block: 'start' });
                    }
                }, 100);
            });
        });

        // Typewriter word-assembly animation for Home Vision Statement (Desktop Only to ensure instant, stable mobile UX)
        if (window.innerWidth > 768) {
            document.querySelectorAll('.stylish-reveal-text').forEach((textContainer) => {
                const text = textContainer.textContent.trim();
                const words = text.split(/\s+/);

                // Re-render text wrapped in custom inline-block spans with transition delays
                textContainer.innerHTML = words.map((word, index) => {
                    return `<span class="word-span" style="animation-delay: ${index * 80}ms; transition-delay: ${index * 80}ms;">${word}</span>`;
                }).join(' ');

                function playCycle() {
                    const spans = textContainer.querySelectorAll('.word-span');

                    // 1. Staggered reveal bounce entry
                    spans.forEach(span => {
                        span.classList.remove('fade-out');
                        span.classList.add('assemble');
                    });

                    // 2. Stable display of full statement for 4 seconds after assembly is fully complete
                    const totalStaggerMs = words.length * 80;
                    setTimeout(() => {
                        // 3. Simultaneous smooth blurred fade-out
                        spans.forEach(span => {
                            span.classList.remove('assemble');
                            span.classList.add('fade-out');
                        });
                    }, totalStaggerMs + 4000);
                }

                // Run initial loop
                playCycle();

                // Loop forever: Assembly Stagger time + 4s stable time + 500ms fadeout + 500ms pause
                const totalIntervalMs = (words.length * 80) + 5000;
                setInterval(playCycle, totalIntervalMs);
            });
        }

        // Philanthropy Modal Trigger Logic
        document.addEventListener('DOMContentLoaded', () => {
            const openPhilBtn = document.getElementById('open-philanthropy-btn');
            const closePhilBtn = document.getElementById('close-philanthropy-modal');
            const philanthropyModal = document.getElementById('philanthropy-modal');
            const modalOverlay = document.getElementById('philanthropy-modal-overlay');
            const modalContent = philanthropyModal ? philanthropyModal.querySelector('.relative') : null;

            function openModal() {
                if (philanthropyModal && modalContent) {
                    philanthropyModal.classList.remove('opacity-0', 'pointer-events-none');
                    philanthropyModal.classList.add('opacity-100', 'pointer-events-auto');
                    modalContent.classList.remove('scale-95');
                    modalContent.classList.add('scale-100');
                    document.body.style.overflow = 'hidden'; // Lock background scroll
                }
            }

            function closeModal() {
                if (philanthropyModal && modalContent) {
                    philanthropyModal.classList.add('opacity-0', 'pointer-events-none');
                    philanthropyModal.classList.remove('opacity-100', 'pointer-events-auto');
                    modalContent.classList.remove('scale-100');
                    modalContent.classList.add('scale-95');
                    document.body.style.overflow = ''; // Unlock background scroll
                }
            }

            if (openPhilBtn) {
                openPhilBtn.addEventListener('click', (e) => {
                    e.preventDefault();
                    e.stopPropagation();
                    openModal();
                });
            }

            if (closePhilBtn) {
                closePhilBtn.addEventListener('click', closeModal);
            }

            if (modalOverlay) {
                modalOverlay.addEventListener('click', closeModal);
            }

            // Close on ESC key
            document.addEventListener('keydown', (e) => {
                if (e.key === 'Escape') {
                    closeModal();
                }
            });
        });
    </script>

    <!-- Immersive Philanthropy Legacy Modal Overlay -->
    <div id="philanthropy-modal"
        class="fixed inset-0 z-[100] flex items-center justify-center opacity-0 pointer-events-none transition-all duration-500 ease-out">
        <!-- Backdrop with high-end blur -->
        <div id="philanthropy-modal-overlay" class="absolute inset-0 bg-black/85 backdrop-blur-2xl"></div>

        <!-- Modal Content Container -->
        <div
            class="relative w-full max-w-6xl h-[90vh] mx-4 md:mx-8 bg-neutral-900/90 border border-white/10 rounded-2xl overflow-hidden flex flex-col shadow-2xl transform scale-95 transition-all duration-500 z-10">
            <!-- Modal Header -->
            <div
                class="flex justify-between items-center px-6 md:px-10 py-5 border-b border-white/10 bg-black/35 shrink-0">
                <div class="text-left">
                    <h2 class="text-xl md:text-2xl font-bold tracking-wider text-white uppercase">
                        Ebele & Anyichuks <span class="text-amber-400">Foundation</span>
                    </h2>
                    <p class="text-xs text-gray-400 mt-1 uppercase tracking-widest text-left">The Philanthropic Legacy
                        of Dr. Ifeanyi Chukwuma Odii</p>
                </div>
                <button id="close-philanthropy-modal"
                    class="p-2 text-gray-400 hover:text-white transition-colors focus:outline-none"
                    aria-label="Close Modal">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <!-- Scrollable Content Body -->
            <div class="flex-grow overflow-y-auto p-6 md:p-10 space-y-12 scrollbar-thin scrollbar-thumb-amber-400">
                <!-- Section 1: Hero Intro -->
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center text-left">
                    <div class="lg:col-span-7 space-y-4">
                        <span
                            class="text-xs font-bold tracking-widest text-amber-400 uppercase text-left block">Empowerment
                            Mandate</span>
                        <h3 class="text-2xl md:text-3xl font-semibold text-white text-left">Supporting and empowering
                            people through our foundation</h3>
                        <p class="text-gray-300 leading-relaxed font-light text-base text-left">
                            "For over 10 years, my wife and I have been running with the divine mandate of supporting
                            and empowering people through our foundation."
                        </p>
                        <p class="text-gray-400 leading-relaxed font-light text-sm text-left">
                            Co-founded by Dr. Ifeanyi Chukwuma Odii and his wife, the Ebele & Anyichuks Foundation has
                            emerged as a cornerstone of grassroots development in Ebonyi State and across Nigeria. Built
                            on empathy and sustained by private enterprise, the foundation works tirelessly to build a
                            society where the vulnerable are cared for and the energetic are equipped to succeed.
                        </p>
                    </div>
                    <div class="lg:col-span-5">
                        <div class="relative group overflow-hidden rounded-xl border border-white/10 shadow-lg">
                            <img src="https://ifeanyiodii.com/file/2018/03/Ifeanyi-Odii-1.jpg"
                                alt="Dr. Ifeanyi Chukwuma Odii"
                                class="w-full h-72 object-cover group-hover:scale-105 transition-transform duration-500">
                            <div
                                class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent opacity-60">
                            </div>
                        </div>
                    </div>
                </div>

                <hr class="border-white/5">

                <!-- Section 2: Education & Women Empowerment Grid -->
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center text-left">
                    <div class="lg:col-span-5 order-last lg:order-first">
                        <div class="relative group overflow-hidden rounded-xl border border-white/10 shadow-lg">
                            <img src="https://ifeanyiodii.com/file/2018/03/IMG_0320-scaled.jpg"
                                alt="Empowerment and Education building donation"
                                class="w-full h-72 object-cover group-hover:scale-105 transition-transform duration-500">
                            <div
                                class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent opacity-60">
                            </div>
                        </div>
                    </div>
                    <div class="lg:col-span-7 space-y-4">
                        <span
                            class="text-xs font-bold tracking-widest text-amber-400 uppercase text-left block">Academic
                            & Economic Pillars</span>
                        <h3 class="text-2xl md:text-3xl font-semibold text-white text-left">Education & Women
                            Empowerment</h3>
                        <p class="text-gray-300 leading-relaxed font-light text-base text-left">
                            The focus of the foundation's annual empowerment project heavily integrates educational
                            infrastructure and economic self-sufficiency.
                        </p>
                        <p class="text-gray-400 leading-relaxed font-light text-sm text-left">
                            A major milestone includes the donation of a new state-of-the-art school building to the Isu
                            Achara Primary School, equipped with a modern ICT center, science laboratories, and a
                            multi-purpose hall. Alongside infrastructure, the foundation distributes key economic tools
                            annually—including 50 motorcycles, 50 sewing machines, 50 grinding machines, 1,000 bags of
                            rice, 500 pieces of wrappers, and 20 hair dryers—to give women and families a clean start
                            toward building reliable businesses.
                        </p>
                    </div>
                </div>

                <hr class="border-white/5">

                <!-- Section 3: Healthcare, Shelter & Sports Cup -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 text-left">
                    <!-- Healthcare and Indigent Shelter -->
                    <div
                        class="bg-black/20 border border-white/5 rounded-2xl p-6 md:p-8 space-y-4 hover:border-amber-400/20 transition-colors">
                        <div class="relative group overflow-hidden rounded-xl border border-white/10 mb-4">
                            <img src="https://ifeanyiodii.com/file/2018/03/Ifeanyi-Odii-3.jpg"
                                alt="Shelter and Road construction project"
                                class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-500">
                        </div>
                        <span
                            class="text-xs font-bold tracking-widest text-amber-400 uppercase text-left block">Healthcare
                            & Shelter</span>
                        <h4 class="text-xl font-semibold text-white text-left">Medical Testing & Home Construction</h4>
                        <p class="text-gray-400 leading-relaxed font-light text-sm text-left">
                            The foundation operates a comprehensive free mobile medical testing scheme, facilitating
                            vital diagnosis and providing free prescription medications to rural inhabitants. Driven by
                            a desire to eradicate homelessness among the indigent, the foundation has constructed and
                            furnished over 150 homes for impoverished families, in addition to supporting critical local
                            roads and places of worship.
                        </p>
                    </div>

                    <!-- Anyichuks Unity Cup -->
                    <div
                        class="bg-black/20 border border-white/5 rounded-2xl p-6 md:p-8 space-y-4 hover:border-amber-400/20 transition-colors">
                        <div class="relative group overflow-hidden rounded-xl border border-white/10 mb-4">
                            <img src="https://ifeanyiodii.com/file/2018/03/Ifeanyi-Odii-6.jpg"
                                alt="Anyichuks Unity Cup sports empowerment"
                                class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-500">
                        </div>
                        <span class="text-xs font-bold tracking-widest text-amber-400 uppercase text-left block">Youth &
                            Sports</span>
                        <h4 class="text-xl font-semibold text-white text-left">Anyi Chuks Unity Cup</h4>
                        <p class="text-gray-400 leading-relaxed font-light text-sm text-left">
                            Born out of Dr. Ifeanyi Odii's lifelong passion for football and the critical need to
                            promote grassroots sports, the Anyi Chuks Unity Cup is an annual tournament held in Isu. By
                            creating structured engagement and showcasing local talent, the tournament serves as a
                            highly anticipated vehicle for youth development, teamwork, and healthy empowerment.
                        </p>
                    </div>
                </div>

                <hr class="border-white/5">

                <!-- Section 4: Comprehensive Philanthropy Gallery -->
                <div class="space-y-6 text-center">
                    <div>
                        <span class="text-xs font-bold tracking-widest text-amber-400 uppercase">Empowerment
                            Gallery</span>
                        <h3 class="text-2xl md:text-3xl font-semibold text-white mt-1">Philanthropic Events in Action
                        </h3>
                        <p class="text-gray-400 text-sm max-w-xl mx-auto mt-2 font-light">A visual record of outreach
                            projects, infrastructure developments, and direct beneficiary distribution schemes.</p>
                    </div>

                    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4">
                        <div
                            class="group overflow-hidden rounded-lg border border-white/5 bg-black/20 relative aspect-video sm:aspect-square cursor-pointer">
                            <img src="https://ifeanyiodii.com/file/2018/03/Ifeanyi-Odii-1.jpg" alt="Ifeanyi Odii 1"
                                class="gallery-img w-full h-full object-cover group-hover:scale-105 transition-all duration-300">
                        </div>
                        <div
                            class="group overflow-hidden rounded-lg border border-white/5 bg-black/20 relative aspect-video sm:aspect-square cursor-pointer">
                            <img src="https://ifeanyiodii.com/file/2018/03/Ifeanyi-Odii-2.jpg" alt="Ifeanyi Odii 2"
                                class="gallery-img w-full h-full object-cover group-hover:scale-105 transition-all duration-300">
                        </div>
                        <div
                            class="group overflow-hidden rounded-lg border border-white/5 bg-black/20 relative aspect-video sm:aspect-square cursor-pointer">
                            <img src="https://ifeanyiodii.com/file/2018/03/Ifeanyi-Odii-3.jpg" alt="Ifeanyi Odii 3"
                                class="gallery-img w-full h-full object-cover group-hover:scale-105 transition-all duration-300">
                        </div>
                        <div
                            class="group overflow-hidden rounded-lg border border-white/5 bg-black/20 relative aspect-video sm:aspect-square cursor-pointer">
                            <img src="https://ifeanyiodii.com/file/2018/03/Ifeanyi-Odii-4.jpg" alt="Ifeanyi Odii 4"
                                class="gallery-img w-full h-full object-cover group-hover:scale-105 transition-all duration-300">
                        </div>
                        <div
                            class="group overflow-hidden rounded-lg border border-white/5 bg-black/20 relative aspect-video sm:aspect-square cursor-pointer">
                            <img src="https://ifeanyiodii.com/file/2018/03/Ifeanyi-Odii-5.jpg" alt="Ifeanyi Odii 5"
                                class="gallery-img w-full h-full object-cover group-hover:scale-105 transition-all duration-300">
                        </div>
                        <div
                            class="group overflow-hidden rounded-lg border border-white/5 bg-black/20 relative aspect-video sm:aspect-square cursor-pointer">
                            <img src="https://ifeanyiodii.com/file/2018/03/Ifeanyi-Odii-6.jpg" alt="Ifeanyi Odii 6"
                                class="gallery-img w-full h-full object-cover group-hover:scale-105 transition-all duration-300">
                        </div>
                        <div
                            class="group overflow-hidden rounded-lg border border-white/5 bg-black/20 relative aspect-video sm:aspect-square cursor-pointer">
                            <img src="https://ifeanyiodii.com/file/2018/03/Ifeanyi-Odii-7.jpg" alt="Ifeanyi Odii 7"
                                class="gallery-img w-full h-full object-cover group-hover:scale-105 transition-all duration-300">
                        </div>
                        <div
                            class="group overflow-hidden rounded-lg border border-white/5 bg-black/20 relative aspect-video sm:aspect-square cursor-pointer">
                            <img src="https://ifeanyiodii.com/file/2018/03/Ifeanyi-Odii-8.jpg" alt="Ifeanyi Odii 8"
                                class="gallery-img w-full h-full object-cover group-hover:scale-105 transition-all duration-300">
                        </div>
                        <div
                            class="group overflow-hidden rounded-lg border border-white/5 bg-black/20 relative aspect-video sm:aspect-square cursor-pointer">
                            <img src="https://ifeanyiodii.com/file/2018/03/Ifeanyi-Odii-23.jpg" alt="Ifeanyi Odii 23"
                                class="gallery-img w-full h-full object-cover group-hover:scale-105 transition-all duration-300">
                        </div>
                        <div
                            class="group overflow-hidden rounded-lg border border-white/5 bg-black/20 relative aspect-video sm:aspect-square cursor-pointer">
                            <img src="https://ifeanyiodii.com/file/2018/03/Ifeanyi-Odii-24.jpg" alt="Ifeanyi Odii 24"
                                class="gallery-img w-full h-full object-cover group-hover:scale-105 transition-all duration-300">
                        </div>
                        <div
                            class="group overflow-hidden rounded-lg border border-white/5 bg-black/20 relative aspect-video sm:aspect-square cursor-pointer">
                            <img src="https://ifeanyiodii.com/file/2018/03/Ifeanyi-Odii-25.jpg" alt="Ifeanyi Odii 25"
                                class="gallery-img w-full h-full object-cover group-hover:scale-105 transition-all duration-300">
                        </div>
                        <div
                            class="group overflow-hidden rounded-lg border border-white/5 bg-black/20 relative aspect-video sm:aspect-square cursor-pointer">
                            <img src="https://ifeanyiodii.com/file/2018/03/Ifeanyi-Odii-26.jpg" alt="Ifeanyi Odii 26"
                                class="gallery-img w-full h-full object-cover group-hover:scale-105 transition-all duration-300">
                        </div>
                        <div
                            class="group overflow-hidden rounded-lg border border-white/5 bg-black/20 relative aspect-video sm:aspect-square cursor-pointer">
                            <img src="https://ifeanyiodii.com/file/2018/03/Ifeanyi-Odii-27.jpg" alt="Ifeanyi Odii 27"
                                class="gallery-img w-full h-full object-cover group-hover:scale-105 transition-all duration-300">
                        </div>
                        <div
                            class="group overflow-hidden rounded-lg border border-white/5 bg-black/20 relative aspect-video sm:aspect-square cursor-pointer">
                            <img src="https://ifeanyiodii.com/file/2018/03/Ifeanyi-Odii-28.jpg" alt="Ifeanyi Odii 28"
                                class="gallery-img w-full h-full object-cover group-hover:scale-105 transition-all duration-300">
                        </div>
                        <div
                            class="group overflow-hidden rounded-lg border border-white/5 bg-black/20 relative aspect-video sm:aspect-square cursor-pointer">
                            <img src="https://ifeanyiodii.com/file/2018/03/Ifeanyi-Odii-28-1.jpg"
                                alt="Ifeanyi Odii 28-1"
                                class="gallery-img w-full h-full object-cover group-hover:scale-105 transition-all duration-300">
                        </div>
                        <div
                            class="group overflow-hidden rounded-lg border border-white/5 bg-black/20 relative aspect-video sm:aspect-square cursor-pointer">
                            <img src="https://ifeanyiodii.com/file/2018/03/Ifeanyi-Odii-29.jpg" alt="Ifeanyi Odii 29"
                                class="gallery-img w-full h-full object-cover group-hover:scale-105 transition-all duration-300">
                        </div>
                        <div
                            class="group overflow-hidden rounded-lg border border-white/5 bg-black/20 relative aspect-video sm:aspect-square cursor-pointer">
                            <img src="https://ifeanyiodii.com/file/2018/03/Ifeanyi-Odii-30.jpg" alt="Ifeanyi Odii 30"
                                class="gallery-img w-full h-full object-cover group-hover:scale-105 transition-all duration-300">
                        </div>
                        <div
                            class="group overflow-hidden rounded-lg border border-white/5 bg-black/20 relative aspect-video sm:aspect-square cursor-pointer">
                            <img src="https://ifeanyiodii.com/file/2018/03/IMG_0320-scaled.jpg"
                                alt="Isu Achara School block"
                                class="gallery-img w-full h-full object-cover group-hover:scale-105 transition-all duration-300">
                        </div>
                        <div
                            class="group overflow-hidden rounded-lg border border-white/5 bg-black/20 relative aspect-video sm:aspect-square cursor-pointer">
                            <img src="https://ifeanyiodii.com/file/2018/03/IMG_0321-scaled.jpg"
                                alt="Direct Vehicle Distribution"
                                class="gallery-img w-full h-full object-cover group-hover:scale-105 transition-all duration-300">
                        </div>
                        <div
                            class="group overflow-hidden rounded-lg border border-white/5 bg-black/20 relative aspect-video sm:aspect-square cursor-pointer">
                            <img src="https://ifeanyiodii.com/file/2018/03/IMG_0323-scaled.jpg"
                                alt="Beneficiaries receiving medications"
                                class="gallery-img w-full h-full object-cover group-hover:scale-105 transition-all duration-300">
                        </div>
                        <div
                            class="group overflow-hidden rounded-lg border border-white/5 bg-black/20 relative aspect-video sm:aspect-square cursor-pointer">
                            <img src="https://ifeanyiodii.com/file/2018/03/IMG_0324-scaled.jpg"
                                alt="Mobile screening services"
                                class="gallery-img w-full h-full object-cover group-hover:scale-105 transition-all duration-300">
                        </div>
                        <div
                            class="group overflow-hidden rounded-lg border border-white/5 bg-black/20 relative aspect-video sm:aspect-square cursor-pointer">
                            <img src="https://ifeanyiodii.com/file/2018/03/IMG_0327-scaled.jpg" alt="ICT Infrastructure"
                                class="gallery-img w-full h-full object-cover group-hover:scale-105 transition-all duration-300">
                        </div>
                        <div
                            class="group overflow-hidden rounded-lg border border-white/5 bg-black/20 relative aspect-video sm:aspect-square cursor-pointer">
                            <img src="https://ifeanyiodii.com/file/2018/05/28166693_819914608217259_5582102007634195081_n.jpg"
                                alt="Grinding machines supply"
                                class="gallery-img w-full h-full object-cover group-hover:scale-105 transition-all duration-300">
                        </div>
                        <div
                            class="group overflow-hidden rounded-lg border border-white/5 bg-black/20 relative aspect-video sm:aspect-square cursor-pointer">
                            <img src="https://ifeanyiodii.com/file/2018/05/28166995_819914671550586_5175300950526025156_n.jpg"
                                alt="Annual empowerment bags of rice"
                                class="gallery-img w-full h-full object-cover group-hover:scale-105 transition-all duration-300">
                        </div>
                        <div
                            class="group overflow-hidden rounded-lg border border-white/5 bg-black/20 relative aspect-video sm:aspect-square cursor-pointer">
                            <img src="https://ifeanyiodii.com/file/2018/05/28276267_819915271550526_8042039464802161591_n.jpg"
                                alt="Distribution queues"
                                class="gallery-img w-full h-full object-cover group-hover:scale-105 transition-all duration-300">
                        </div>
                        <div
                            class="group overflow-hidden rounded-lg border border-white/5 bg-black/20 relative aspect-video sm:aspect-square cursor-pointer">
                            <img src="https://ifeanyiodii.com/file/2018/05/28277037_819915034883883_4266600533786877126_n.jpg"
                                alt="Indigent housing keys presentation"
                                class="gallery-img w-full h-full object-cover group-hover:scale-105 transition-all duration-300">
                        </div>
                        <div
                            class="group overflow-hidden rounded-lg border border-white/5 bg-black/20 relative aspect-video sm:aspect-square cursor-pointer">
                            <img src="https://ifeanyiodii.com/file/2018/05/28277292_409855879456970_944742122323849710_n.jpg"
                                alt="Empowerment projects"
                                class="gallery-img w-full h-full object-cover group-hover:scale-105 transition-all duration-300">
                        </div>
                        <div
                            class="group overflow-hidden rounded-lg border border-white/5 bg-black/20 relative aspect-video sm:aspect-square cursor-pointer">
                            <img src="https://ifeanyiodii.com/file/2018/05/28279042_821924321349621_4615326624423497449_n.jpg"
                                alt="Medical testing prescriptions"
                                class="gallery-img w-full h-full object-cover group-hover:scale-105 transition-all duration-300">
                        </div>
                        <div
                            class="group overflow-hidden rounded-lg border border-white/5 bg-black/20 relative aspect-video sm:aspect-square cursor-pointer">
                            <img src="https://ifeanyiodii.com/file/2018/05/28279450_820642218144498_7537192261926882544_n.jpg"
                                alt="Motorbike empowerment supply"
                                class="gallery-img w-full h-full object-cover group-hover:scale-105 transition-all duration-300">
                        </div>
                        <div
                            class="group overflow-hidden rounded-lg border border-white/5 bg-black/20 relative aspect-video sm:aspect-square cursor-pointer">
                            <img src="https://ifeanyiodii.com/file/2018/05/28280050_820642264811160_769552814138877959_n.jpg"
                                alt="Indigent houses constructed"
                                class="gallery-img w-full h-full object-cover group-hover:scale-105 transition-all duration-300">
                        </div>
                        <div
                            class="group overflow-hidden rounded-lg border border-white/5 bg-black/20 relative aspect-video sm:aspect-square cursor-pointer">
                            <img src="https://ifeanyiodii.com/file/2018/05/28378516_409855802790311_5990637257241877744_n.jpg"
                                alt="Youth empowerment sports"
                                class="gallery-img w-full h-full object-cover group-hover:scale-105 transition-all duration-300">
                        </div>
                        <div
                            class="group overflow-hidden rounded-lg border border-white/5 bg-black/20 relative aspect-video sm:aspect-square cursor-pointer">
                            <img src="https://ifeanyiodii.com/file/2018/05/IMG_0004-1.jpg"
                                alt="Empowerment events Ebonyi"
                                class="gallery-img w-full h-full object-cover group-hover:scale-105 transition-all duration-300">
                        </div>
                        <div
                            class="group overflow-hidden rounded-lg border border-white/5 bg-black/20 relative aspect-video sm:aspect-square cursor-pointer">
                            <img src="https://ifeanyiodii.com/file/2018/05/IMG_0005-1.jpg"
                                alt="Scholarship announcements"
                                class="gallery-img w-full h-full object-cover group-hover:scale-105 transition-all duration-300">
                        </div>
                        <div
                            class="group overflow-hidden rounded-lg border border-white/5 bg-black/20 relative aspect-video sm:aspect-square cursor-pointer">
                            <img src="https://ifeanyiodii.com/file/2018/05/IMG_0012-1.jpg" alt="Churches construction"
                                class="gallery-img w-full h-full object-cover group-hover:scale-105 transition-all duration-300">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal Footer -->
            <div
                class="px-6 md:px-10 py-4 border-t border-white/10 bg-black/35 text-center text-xs text-gray-500 shrink-0">
                Empowering Communities, Elevating Livelihoods • Ebele & Anyichuks Foundation
            </div>
        </div>
    </div>

    <!-- Immersive Photo Dynamic Lightbox Preview -->
    <div id="lightbox-overlay"
        class="fixed inset-0 z-[150] flex items-center justify-center opacity-0 pointer-events-none transition-all duration-300 ease-out bg-black/95 backdrop-blur-md">
        <button id="close-lightbox-btn"
            class="absolute top-6 right-6 p-3 text-gray-300 hover:text-white transition-colors focus:outline-none"
            aria-label="Close Lightbox">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
        <div class="relative max-w-5xl max-h-[85vh] p-4 flex flex-col items-center justify-center">
            <img id="lightbox-img" src="" alt="Enlarged Preview"
                class="max-w-full max-h-[80vh] object-contain rounded-lg shadow-2xl transform scale-95 transition-all duration-300 border border-white/10">
            <p id="lightbox-caption" class="text-gray-300 text-sm mt-4 tracking-wider uppercase font-medium"></p>
        </div>
    </div>

    <!-- Lightbox Script integration -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const lightbox = document.getElementById('lightbox-overlay');
            const lightboxImg = document.getElementById('lightbox-img');
            const lightboxCaption = document.getElementById('lightbox-caption');
            const closeBtn = document.getElementById('close-lightbox-btn');

            function openLightbox(src, alt) {
                if (lightbox && lightboxImg && lightboxCaption) {
                    lightboxImg.src = src;
                    lightboxCaption.textContent = alt || "Ebele & Anyichuks Foundation Action Event";
                    lightbox.classList.remove('opacity-0', 'pointer-events-none');
                    lightbox.classList.add('opacity-100', 'pointer-events-auto');
                    lightboxImg.classList.remove('scale-95');
                    lightboxImg.classList.add('scale-100');
                }
            }

            function closeLightbox() {
                if (lightbox && lightboxImg) {
                    lightbox.classList.add('opacity-0', 'pointer-events-none');
                    lightbox.classList.remove('opacity-100', 'pointer-events-auto');
                    lightboxImg.classList.remove('scale-100');
                    lightboxImg.classList.add('scale-95');
                }
            }

            // Bind click events on all gallery images
            document.querySelectorAll('.gallery-img').forEach(img => {
                img.addEventListener('click', (e) => {
                    e.stopPropagation(); // prevent modal bubble triggers
                    openLightbox(img.src, img.alt);
                });
            });

            if (closeBtn) {
                closeBtn.addEventListener('click', closeLightbox);
            }
            if (lightbox) {
                lightbox.addEventListener('click', closeLightbox);
            }

            // Close on escape key
            document.addEventListener('keydown', (e) => {
                if (e.key === 'Escape') {
                    closeLightbox();
                }
            });
        });
    </script>

    <!-- Immersive About Legacy Modal Overlay -->
    <div id="about-modal" style="z-index: 150;"
        class="fixed inset-0 flex items-center justify-center opacity-0 pointer-events-none transition-all duration-500 ease-out">
        <!-- Backdrop with high-end blur -->
        <div id="about-modal-overlay" class="absolute inset-0 bg-black/85 backdrop-blur-2xl"></div>

        <!-- Modal Content Container -->
        <div
            class="relative w-full max-w-6xl h-[90vh] mx-4 md:mx-8 bg-neutral-900/90 border border-white/10 rounded-2xl overflow-hidden flex flex-col shadow-2xl transform scale-95 transition-all duration-500 z-10">
            <!-- Modal Header -->
            <div
                class="flex justify-between items-center px-6 md:px-10 py-5 border-b border-white/10 bg-black/35 shrink-0">
                <div class="text-left">
                    <h2 class="text-xl md:text-2xl font-bold tracking-wider text-white uppercase">
                        About <span class="text-amber-400">Dr. Ifeanyi Odii</span>
                    </h2>
                    <p class="text-xs text-gray-400 mt-1 uppercase tracking-widest text-left">An Entrepreneur | Catalyst
                        | Philanthropist</p>
                </div>
                <button id="close-about-modal"
                    class="p-2 text-gray-400 hover:text-white transition-colors focus:outline-none"
                    aria-label="Close Modal">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <!-- Scrollable Content Body -->
            <div class="flex-grow overflow-y-auto p-6 md:p-10 space-y-12 scrollbar-thin scrollbar-thumb-amber-400">
                <!-- Section 1: Hero Intro -->
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center text-left">
                    <div class="lg:col-span-7 space-y-4">
                        <span
                            class="text-xs font-bold tracking-widest text-amber-400 uppercase text-left block">Profile</span>
                        <h3 class="text-2xl md:text-3xl font-semibold text-white text-left">Ifeanyi Chukwuma Odii</h3>
                        <p class="text-gray-300 leading-relaxed font-light text-base text-left">
                            Dr. Ifeanyi Chukwuma Odii is a businessman and philanthropist with vast experience spanning
                            over 20 years in building and managing businesses across various sectors.
                        </p>
                        <p class="text-gray-400 leading-relaxed font-light text-sm text-left">
                            He is the Founder/Chairman of Orient Global Group with subsidiary companies; Orient Global
                            Manufacturing, Orient Haulage & Logistics, and Purity Agro-Allied Ltd. He is also the
                            President/CEO of Ultimus Holdings with subsidiary companies; Ultimus Construction, Ultimus
                            Properties, and Ultimus Global Integrated (owners of The Classroom by Ultimus, Viarmor
                            Healthcare Ltd.)
                        </p>
                        <p class="text-gray-400 leading-relaxed font-light text-sm text-left">
                            With investment portfolios that cut across sectors like – manufacturing, logistics,
                            construction, real estate, healthcare, trade, and services, Dr. Ifeanyi has successfully
                            grown these businesses outside the shores of Nigeria to Sub-Sharan Africa.
                        </p>
                    </div>
                    <div class="lg:col-span-5">
                        <div class="relative group overflow-hidden rounded-xl border border-white/10 shadow-lg">
                            <img src="https://ifeanyiodii.com/file/2020/11/Ifeanyi-Chukwuma-Odii-1.jpg"
                                alt="Dr. Ifeanyi Chukwuma Odii"
                                class="w-full h-auto object-cover group-hover:scale-105 transition-transform duration-500">
                            <div
                                class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent opacity-60">
                            </div>
                        </div>
                    </div>
                </div>

                <hr class="border-white/5">

                <!-- Section 2: Education -->
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center text-left">
                    <div class="lg:col-span-5 order-last lg:order-first">
                        <div class="relative group overflow-hidden rounded-xl border border-white/10 shadow-lg">
                            <img src="{{ asset('images/landing-profile.png') }}?v={{ filemtime(public_path('images/landing-profile.png')) }}?v={{ filemtime(public_path('images/landing-profile.png')) }}" alt="Ifeanyi Odii Family"
                                class="w-full h-72 object-cover group-hover:scale-105 transition-transform duration-500">
                            <div
                                class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent opacity-60">
                            </div>
                        </div>
                    </div>
                    <div class="lg:col-span-7 space-y-4">
                        <span
                            class="text-xs font-bold tracking-widest text-amber-400 uppercase text-left block">Academic
                            Background</span>
                        <h3 class="text-2xl md:text-3xl font-semibold text-white text-left">Education & Affiliations
                        </h3>
                        <p class="text-gray-300 leading-relaxed font-light text-base text-left">
                            He has over the years honed his skills in Leadership, Management, and Business Strategy.
                        </p>
                        <p class="text-gray-400 leading-relaxed font-light text-sm text-left">
                            He is an alumnus of the Lagos Business School where he underwent a Chief Executive program
                            and also has a B.Sc. in Business Administration from the National Open University of
                            Nigeria. He was conferred with a Doctor of Science Degree in Strategic Business Management &
                            Corporate Governance by the European American University in the Republic of Panama.
                        </p>
                        <p class="text-gray-400 leading-relaxed font-light text-sm text-left">
                            He is also a member of Governing Council of the Lagos State University and sits on the board
                            of Prosperis Holdings.
                        </p>
                    </div>
                </div>

                <hr class="border-white/5">

                <!-- Section 3: Passions and Philanthropy -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 text-left">
                    <!-- Philanthropy -->
                    <div
                        class="bg-black/20 border border-white/5 rounded-2xl p-6 md:p-8 space-y-4 hover:border-amber-400/20 transition-colors">
                        <span class="text-xs font-bold tracking-widest text-amber-400 uppercase text-left block">Giving
                            Back</span>
                        <h4 class="text-xl font-semibold text-white text-left">Ebele & Anyichuks Foundation</h4>
                        <p class="text-gray-400 leading-relaxed font-light text-sm text-left">
                            Through the Ebele and Anyichuks Foundation, which he founded and named after himself and his
                            wife; he has over the years built over 100 homes for the indigents in rural areas, 6
                            churches, 3 Floors of Primary and secondary school, provided scholarships to over 1000
                            students home and abroad, provided yearly medical screening and support through his
                            foundation.
                        </p>
                    </div>

                    <!-- Personal Passions -->
                    <div
                        class="bg-black/20 border border-white/5 rounded-2xl p-6 md:p-8 space-y-4 hover:border-amber-400/20 transition-colors">
                        <span
                            class="text-xs font-bold tracking-widest text-amber-400 uppercase text-left block">Personal
                            Life</span>
                        <h4 class="text-xl font-semibold text-white text-left">Sports & Hobbies</h4>
                        <p class="text-gray-400 leading-relaxed font-light text-sm text-left">
                            His great love of sports led him to establish the Anyichuks Unity Cup, a yearly sports
                            tournament held in his hometown to encourage, empower youths and promote sports at the
                            grass-root level. Asides from his passion for his businesses and his love for his family, he
                            enjoys; reading, swimming, keeping fit and golfing course as he is an ardent member of
                            several golf clubs in Lagos.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Modal Footer -->
            <div
                class="px-6 md:px-10 py-4 border-t border-white/10 bg-black/35 text-center text-xs text-gray-500 shrink-0">
                Ifeanyi Chukwuma Odii • Portfolio & Biography
            </div>
        </div>
    </div>

    <!-- ======================================================= -->
    <!-- ANYI GA EMEYA 2027 CAMPAIGN VOLUNTEER MODAL -->
    <!-- ======================================================= -->
    <div id="volunteer-modal" style="z-index: 160;"
        class="fixed inset-0 flex items-center justify-center p-4 md:p-6 opacity-0 pointer-events-none transition-all duration-300">
        <!-- Backdrop Overlay -->
        <div id="volunteer-modal-overlay" class="absolute inset-0 bg-black/85 backdrop-blur-xl transition-opacity"></div>

        <!-- Modal Container -->
        <div class="relative w-full max-w-xl bg-[#0c1017]/95 border border-amber-400/30 rounded-3xl shadow-[0_0_50px_rgba(245,158,11,0.2)] overflow-hidden transform scale-95 transition-all duration-300 flex flex-col max-h-[90vh]">
            
            <!-- Modal Header -->
            <div class="px-6 md:px-8 pt-6 pb-4 border-b border-white/10 bg-black/40 flex justify-between items-start shrink-0">
                <div>
                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-amber-400/10 border border-amber-400/30 text-amber-400 text-[10px] font-bold uppercase tracking-widest mb-2">
                        <span class="w-1.5 h-1.5 rounded-full bg-amber-400 animate-ping"></span> ANYI GA EMEYA 2027 • OFFICIAL CAMPAIGN
                    </div>
                    <h3 class="text-xl md:text-2xl font-bold text-white tracking-wide">Join the 2027 Movement</h3>
                    <p class="text-gray-400 text-xs mt-1">Stand with Dr. Ifeanyi Chukwuma Odii across Ebonyi's 13 LGAs and 171 Wards.</p>
                </div>
                <button type="button" id="close-volunteer-modal" onclick="window.closeVolunteerModal();"
                    class="p-2 text-gray-400 hover:text-white hover:bg-white/10 rounded-full transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <!-- Modal Body (Scrollable) -->
            <div class="p-6 md:p-8 overflow-y-auto custom-scrollbar flex-grow space-y-6 text-left">
                
                <!-- Registration Form -->
                <form id="volunteer-registration-form" onsubmit="window.submitVolunteerRegistration(event);" class="space-y-4">
                    <div id="volunteer-form-alert" class="hidden px-4 py-3 rounded-xl text-xs font-semibold"></div>

                    <div>
                        <label class="block text-xs font-bold text-gray-300 uppercase tracking-wider mb-1.5">Full Name *</label>
                        <input type="text" id="v-name" required placeholder="e.g. Chinedu Eze"
                            class="w-full px-4 py-2.5 bg-black/50 border border-white/15 focus:border-amber-400 rounded-xl text-white text-sm focus:outline-none transition-colors">
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold text-gray-300 uppercase tracking-wider mb-1.5">Phone / WhatsApp *</label>
                            <input type="tel" id="v-phone" required placeholder="e.g. 08012345678"
                                class="w-full px-4 py-2.5 bg-black/50 border border-white/15 focus:border-amber-400 rounded-xl text-white text-sm focus:outline-none transition-colors">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-300 uppercase tracking-wider mb-1.5">Email Address</label>
                            <input type="email" id="v-email" placeholder="e.g. chinedu@example.com"
                                class="w-full px-4 py-2.5 bg-black/50 border border-white/15 focus:border-amber-400 rounded-xl text-white text-sm focus:outline-none transition-colors">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold text-gray-300 uppercase tracking-wider mb-1.5">Ebonyi LGA *</label>
                            <select id="v-lga" required
                                class="w-full px-4 py-2.5 bg-black/60 border border-white/15 focus:border-amber-400 rounded-xl text-white text-sm focus:outline-none transition-colors">
                                <option value="" disabled selected>Select LGA</option>
                                <option value="Abakaliki">Abakaliki</option>
                                <option value="Afikpo North">Afikpo North</option>
                                <option value="Afikpo South (Edda)">Afikpo South (Edda)</option>
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
                                <option value="Diaspora">Diaspora / Outside Ebonyi</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-300 uppercase tracking-wider mb-1.5">Ward / Community</label>
                            <input type="text" id="v-ward" placeholder="e.g. Kpirikpiri Ward"
                                class="w-full px-4 py-2.5 bg-black/50 border border-white/15 focus:border-amber-400 rounded-xl text-white text-sm focus:outline-none transition-colors">
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-gray-300 uppercase tracking-wider mb-1.5">Preferred Campaign Role *</label>
                        <select id="v-role" required
                            class="w-full px-4 py-2.5 bg-black/60 border border-white/15 focus:border-amber-400 rounded-xl text-white text-sm focus:outline-none transition-colors">
                            <option value="Grassroots Mobilizer">Grassroots Mobilizer (Community Organizer)</option>
                            <option value="Youth Wing Pioneer">Youth Wing Pioneer & Tech Advocate</option>
                            <option value="Women Mobilization Leader">Women Mobilization Leader</option>
                            <option value="Polling Unit Agent / Monitor">Polling Unit Agent / Election Day Monitor</option>
                            <option value="Media & Digital Campaigner">Media & Digital Warrior</option>
                            <option value="Diaspora Supporter">Diaspora Supporter</option>
                        </select>
                    </div>

                    <div class="pt-2">
                        <button type="submit" id="v-submit-btn"
                            style="background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%) !important; color: #000000 !important; font-weight: 800 !important; border: 1px solid #fbbf24 !important; box-shadow: 0 10px 25px -5px rgba(245, 158, 11, 0.4) !important;"
                            class="w-full py-4 px-6 bg-amber-400 hover:bg-amber-300 text-black font-extrabold text-sm uppercase tracking-wider rounded-xl transition-all shadow-xl shadow-amber-400/30 hover:scale-[1.02] flex items-center justify-center gap-2 cursor-pointer">
                            <span id="v-btn-text" style="color: #000000 !important; font-weight: 800 !important;">Claim My 2027 Ambassador Badge</span>
                            <svg id="v-btn-spinner" class="hidden w-4 h-4 text-black animate-spin" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                        </button>
                    </div>
                </form>

                <!-- Digital Ambassador Card Preview (Success State) -->
                <div id="volunteer-success-view" class="hidden space-y-6">
                    <div class="p-6 bg-gradient-to-br from-black via-zinc-900 to-black border-2 border-amber-400/50 rounded-2xl shadow-2xl relative overflow-hidden text-center">
                        <div class="absolute -right-8 -bottom-8 w-32 h-32 bg-amber-400/10 rounded-full blur-2xl pointer-events-none"></div>
                        
                        <div class="flex justify-between items-center border-b border-white/10 pb-3 mb-4">
                            <span class="text-[10px] font-bold tracking-widest text-amber-400 uppercase">ANYI GA EMEYA 2027</span>
                            <span class="text-[9px] text-gray-400 font-mono" id="badge-display-id">ANYI27-EB-0000</span>
                        </div>

                        <div class="w-16 h-16 rounded-full mx-auto mb-3 bg-amber-400/20 border border-amber-400/40 flex items-center justify-center text-amber-400 text-2xl font-black">
                            ✓
                        </div>

                        <h4 class="text-xl font-bold text-white" id="badge-display-name">Ambassador Name</h4>
                        <div class="inline-block mt-1 px-3 py-0.5 rounded-full bg-amber-400/10 border border-amber-400/30 text-amber-300 text-xs font-semibold" id="badge-display-role">
                            Grassroots Mobilizer
                        </div>
                        
                        <p class="text-gray-400 text-xs mt-3">
                            Jurisdiction: <span class="text-white font-medium" id="badge-display-lga">Abakaliki LGA</span>
                        </p>

                        <div class="mt-4 pt-3 border-t border-white/10 text-[11px] text-gray-400 italic">
                            "Together, we will build an Ebonyi where prosperity belongs to everyone."
                            <div class="text-amber-400/90 font-semibold not-italic text-[10px] mt-0.5">— Dr. Ifeanyi Chukwuma Odii</div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex flex-col sm:flex-row gap-3">
                        <a id="badge-whatsapp-share" href="#" target="_blank"
                            class="flex-1 py-3 px-4 bg-emerald-600 hover:bg-emerald-500 text-white font-bold text-xs uppercase tracking-wider rounded-xl transition-all flex items-center justify-center gap-2 shadow-lg shadow-emerald-600/20">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981z"/></svg>
                            Share on WhatsApp
                        </a>
                        <button type="button" onclick="window.closeVolunteerModal();"
                            class="py-3 px-6 bg-white/10 hover:bg-white/20 text-white font-semibold text-xs uppercase tracking-wider rounded-xl transition-all">
                            Continue Browsing
                        </button>
                    </div>
                </div>

            </div>

            <!-- Modal Footer -->
            <div class="px-6 md:px-8 py-3.5 border-t border-white/10 bg-black/40 text-center text-[11px] text-gray-500 shrink-0">
                Official ANYI GA EMEYA 2027 Election Campaign Platform • Dr. Ifeanyi Chukwuma Odii
            </div>
        </div>
    </div>

    <!-- About & Volunteer Modals Script -->
    <script>
        // About Modal
        window.openAboutModal = function (e) {
            if (e) {
                e.preventDefault();
                e.stopPropagation();
            }
            const aboutModal = document.getElementById('about-modal');
            const modalContent = aboutModal ? aboutModal.querySelector('.relative') : null;
            if (aboutModal && modalContent) {
                aboutModal.classList.remove('opacity-0', 'pointer-events-none');
                aboutModal.classList.add('opacity-100', 'pointer-events-auto');
                modalContent.classList.remove('scale-95');
                modalContent.classList.add('scale-100');
                document.body.style.overflow = 'hidden';
            }
        };

        window.closeAboutModal = function () {
            const aboutModal = document.getElementById('about-modal');
            const modalContent = aboutModal ? aboutModal.querySelector('.relative') : null;
            if (aboutModal && modalContent) {
                aboutModal.classList.add('opacity-0', 'pointer-events-none');
                aboutModal.classList.remove('opacity-100', 'pointer-events-auto');
                modalContent.classList.remove('scale-100');
                modalContent.classList.add('scale-95');
                document.body.style.overflow = '';
            }
        };

        // Volunteer Modal
        window.openVolunteerModal = function (e) {
            if (e) {
                e.preventDefault();
                e.stopPropagation();
            }
            const modal = document.getElementById('volunteer-modal');
            const modalContent = modal ? modal.querySelector('.relative') : null;
            if (modal && modalContent) {
                modal.classList.remove('opacity-0', 'pointer-events-none');
                modal.classList.add('opacity-100', 'pointer-events-auto');
                modalContent.classList.remove('scale-95');
                modalContent.classList.add('scale-100');
                document.body.style.overflow = 'hidden';
            }
        };

        window.closeVolunteerModal = function () {
            const modal = document.getElementById('volunteer-modal');
            const modalContent = modal ? modal.querySelector('.relative') : null;
            if (modal && modalContent) {
                modal.classList.add('opacity-0', 'pointer-events-none');
                modal.classList.remove('opacity-100', 'pointer-events-auto');
                modalContent.classList.remove('scale-100');
                modalContent.classList.add('scale-95');
                document.body.style.overflow = '';
            }
        };

        window.submitVolunteerRegistration = async function (e) {
            e.preventDefault();
            const btn = document.getElementById('v-submit-btn');
            const btnText = document.getElementById('v-btn-text');
            const btnSpinner = document.getElementById('v-btn-spinner');
            const alertBox = document.getElementById('volunteer-form-alert');

            const payload = {
                name: document.getElementById('v-name').value.trim(),
                phone: document.getElementById('v-phone').value.trim(),
                email: document.getElementById('v-email').value.trim(),
                lga: document.getElementById('v-lga').value,
                ward: document.getElementById('v-ward').value.trim(),
                role: document.getElementById('v-role').value
            };

            btn.disabled = true;
            btnText.textContent = 'Registering...';
            btnSpinner.classList.remove('hidden');
            alertBox.classList.add('hidden');

            try {
                const response = await fetch('/api/campaign/volunteer', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify(payload)
                });

                const data = await response.json();

                if (response.ok && data.success) {
                    // Populate success card
                    document.getElementById('badge-display-id').textContent = data.registration_id || 'ANYI27-EB-0001';
                    document.getElementById('badge-display-name').textContent = payload.name;
                    document.getElementById('badge-display-role').textContent = payload.role;
                    document.getElementById('badge-display-lga').textContent = payload.lga + (payload.ward ? ' (' + payload.ward + ')' : '');

                    // Configure WhatsApp share link
                    const shareMsg = encodeURIComponent(`I just officially registered as an ANYI GA EMEYA 2027 Campaign Ambassador (ID: ${data.registration_id}) for Dr. Ifeanyi Chukwuma Odii! Join the movement for the economic rebirth of Ebonyi State: https://anyigaemeya.org`);
                    document.getElementById('badge-whatsapp-share').href = `https://api.whatsapp.com/send?text=${shareMsg}`;

                    // Toggle form to success view
                    document.getElementById('volunteer-registration-form').classList.add('hidden');
                    document.getElementById('volunteer-success-view').classList.remove('hidden');
                } else {
                    alertBox.textContent = data.error || data.message || 'An error occurred. Please try again.';
                    alertBox.className = 'px-4 py-3 rounded-xl text-xs font-semibold bg-red-500/20 border border-red-500/30 text-red-300';
                    alertBox.classList.remove('hidden');
                }
            } catch (err) {
                alertBox.textContent = 'Connection error. Please check your internet and try again.';
                alertBox.className = 'px-4 py-3 rounded-xl text-xs font-semibold bg-red-500/20 border border-red-500/30 text-red-300';
                alertBox.classList.remove('hidden');
            } finally {
                btn.disabled = false;
                btnText.textContent = 'Claim My 2027 Ambassador Badge';
                btnSpinner.classList.add('hidden');
            }
        };

        document.addEventListener('DOMContentLoaded', () => {
            const closeAboutBtn = document.getElementById('close-about-modal');
            const aboutOverlay = document.getElementById('about-modal-overlay');
            const volunteerOverlay = document.getElementById('volunteer-modal-overlay');

            if (closeAboutBtn) closeAboutBtn.addEventListener('click', window.closeAboutModal);
            if (aboutOverlay) aboutOverlay.addEventListener('click', window.closeAboutModal);
            if (volunteerOverlay) volunteerOverlay.addEventListener('click', window.closeVolunteerModal);

            // Close on ESC key
            document.addEventListener('keydown', (e) => {
                if (e.key === 'Escape') {
                    window.closeAboutModal();
                    window.closeVolunteerModal();
                }
            });
        });
        // Live News Feed Engine
        document.addEventListener('DOMContentLoaded', () => {
            const generalNewsFeeds = [
                'https://www.channelstv.com/feed/', // Nigeria
                'https://www.premiumtimesng.com/feed', // Nigeria/Africa
                'https://www.aljazeera.com/xml/rss/all.xml' // World
            ];

            const politicsNewsFeeds = [
                'https://news.google.com/rss/search?q=Nigeria+Politics&hl=en-NG&gl=NG&ceid=NG:en', // Nigeria Politics
                'https://news.google.com/rss/search?q=World+Politics&hl=en-NG&gl=NG&ceid=NG:en', // World Politics
                'https://news.google.com/rss/search?q="Ifeanyi+Odii"+(victory+OR+development+OR+empowerment+OR+success+OR+philanthropy+OR+support+OR+PDP)&hl=en-NG&gl=NG&ceid=NG:en' // Ifeanyi Odii Positive News
            ];

            async function loadNewsFeeds(feedsArray, containerId, errorMsg) {
                const container = document.getElementById(containerId);
                if (!container) return;

                let allNews = [];
                try {
                    const fetchPromises = feedsArray.map(feed =>
                        fetch(`https://api.rss2json.com/v1/api.json?rss_url=${encodeURIComponent(feed)}&api_key=`)
                            .then(res => res.json())
                            .catch(err => null)
                    );

                    const results = await Promise.all(fetchPromises);

                    results.forEach(result => {
                        if (result && result.status === 'ok' && result.items) {
                            result.items.forEach(item => {
                                const source = result.feed.title || 'Live News';
                                allNews.push({
                                    title: item.title,
                                    link: item.link,
                                    date: new Date(item.pubDate),
                                    source: source.replace(' - Homepage', '').replace('Premium Times Nigeria', 'Premium Times').replace('"Ifeanyi Odii" (victory OR development OR empowerment OR success OR philanthropy OR support OR PDP) - Google News', 'Ifeanyi Odii Updates').replace('Nigeria Politics - Google News', 'Nigeria Politics').replace('World Politics - Google News', 'World Politics')
                                });
                            });
                        }
                    });

                    allNews.sort((a, b) => b.date - a.date);

                    if (allNews.length > 0) {
                        container.innerHTML = '';
                        const topNews = allNews.slice(0, 30);

                        topNews.forEach(newsItem => {
                            const diffMs = new Date() - newsItem.date;
                            const diffMins = Math.round(diffMs / 60000);
                            const diffHrs = Math.round(diffMins / 60);
                            let timeStr = diffMins < 60 ? `${diffMins}m ago` : `${diffHrs}h ago`;
                            if (diffMins < 1) timeStr = 'Just now';

                            const card = document.createElement('a');
                            card.href = newsItem.link;
                            card.target = '_blank';
                            card.rel = 'noopener noreferrer';
                            card.className = "flex flex-col gap-4 p-6 bg-white/5 border border-white/10 hover:border-amber-400 rounded-2xl transition-all duration-300 hover:bg-white/10 group cursor-pointer shadow-lg";

                            card.innerHTML = `
                                <div class="flex items-center justify-between gap-2">
                                    <div class="flex items-center gap-2 text-amber-400 font-medium text-xs md:text-sm uppercase tracking-widest">
                                        <span>${newsItem.source}</span>
                                    </div>
                                    <span class="text-xs text-gray-400 font-medium bg-black/40 px-2 py-1 rounded-md">${timeStr}</span>
                                </div>
                                <h3 class="text-lg md:text-xl font-semibold text-white leading-snug line-clamp-3 group-hover:text-amber-400 transition-colors">
                                    ${newsItem.title}
                                </h3>
                                <div class="mt-auto pt-4 flex items-center text-xs font-bold tracking-widest text-gray-400 uppercase group-hover:text-white transition-colors">
                                    Read Article 
                                    <svg class="w-4 h-4 ml-2 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                                    </svg>
                                </div>
                            `;
                            container.appendChild(card);
                        });

                        container.classList.remove('opacity-0');
                        container.classList.add('opacity-100');
                    } else {
                        container.innerHTML = `<div class="col-span-full text-center py-12"><p class="text-red-400 font-medium">${errorMsg}</p></div>`;
                        container.classList.remove('opacity-0');
                    }
                } catch (error) {
                    container.innerHTML = `<div class="col-span-full text-center py-12"><p class="text-red-400 font-medium">Unable to establish secure connection to news networks.</p></div>`;
                    container.classList.remove('opacity-0');
                }
            }

            // Start fetching both feeds
            loadNewsFeeds(generalNewsFeeds, 'live-news-grid', 'Unable to load latest updates at this moment.');
            loadNewsFeeds(politicsNewsFeeds, 'politics-news-grid', 'Unable to load political updates at this moment.');
        });
    </script>

    <script>
        // Accordion State Persistence
        document.addEventListener('DOMContentLoaded', function () {
            const accordions = document.querySelectorAll('details.accordion-section');

            // Function to scroll instantly to the content panel of a section
            function scrollToPanelInstant(accordion) {
                const panel = accordion.querySelector('.dropdown-content-panel');
                if (panel) {
                    panel.scrollIntoView({ behavior: 'auto', block: 'start' });
                }
            }

            // On load: check hash and open corresponding accordion instantly
            if (window.location.hash) {
                const targetAccordion = document.querySelector(window.location.hash);
                if (targetAccordion && targetAccordion.tagName === 'DETAILS') {
                    targetAccordion.open = true;
                    setTimeout(() => scrollToPanelInstant(targetAccordion), 50);
                }
            }

            // On toggle: update hash when a section is opened and auto-scroll
            accordions.forEach(acc => {
                acc.addEventListener('toggle', (e) => {
                    if (acc.open && acc.id) {
                        // Use replaceState to avoid jumping behavior usually caused by standard hash setting
                        history.replaceState(null, null, '#' + acc.id);

                        // If opened via nav click, skip standard summary smooth scroll
                        if (acc.dataset.navClick === "true") {
                            return;
                        }

                        // Smoothly scroll to the opened section so the user can immediately see the content
                        setTimeout(() => {
                            acc.scrollIntoView({ behavior: 'smooth', block: 'start' });
                        }, 50);
                    } else if (!acc.open && acc.id && window.location.hash === '#' + acc.id) {
                        // If the active section is closed, clear the hash
                        history.replaceState(null, null, window.location.pathname);
                    }
                });
            });

            // Listen for hash changes (e.g. from clicking nav links)
            window.addEventListener('hashchange', function () {
                if (window.location.hash) {
                    const targetAccordion = document.querySelector(window.location.hash);
                    if (targetAccordion && targetAccordion.tagName === 'DETAILS') {
                        if (targetAccordion.dataset.navClick === "true") return;

                        // Close all others
                        accordions.forEach(acc => {
                            if (acc !== targetAccordion) acc.removeAttribute('open');
                        });
                        // Open the target
                        targetAccordion.open = true;
                        setTimeout(() => scrollToPanelInstant(targetAccordion), 50);
                    }
                }
            });

            // Intercept navigation link clicks for a fully instant, seamless transition directly to the content panel
            document.querySelectorAll('nav a[href^="#section-"], header a[href^="#section-"], #mobile-nav-drawer a[href^="#section-"]').forEach(link => {
                link.addEventListener('click', function (e) {
                    const targetId = this.getAttribute('href');
                    const targetAccordion = document.querySelector(targetId);
                    if (targetAccordion && targetAccordion.tagName === 'DETAILS') {
                        e.preventDefault();

                        if (typeof window.closeMobileNav === 'function') {
                            window.closeMobileNav();
                        }

                        // Close all others
                        accordions.forEach(acc => {
                            if (acc !== targetAccordion) acc.removeAttribute('open');
                        });

                        // Flag that this is a nav click to skip standard toggle smooth scrolling
                        targetAccordion.dataset.navClick = "true";
                        targetAccordion.open = true;

                        // Instantly scroll directly to the content panel
                        scrollToPanelInstant(targetAccordion);

                        // Update the browser URL hash without scrolling jump
                        history.replaceState(null, null, targetId);

                        // Clean up flag
                        delete targetAccordion.dataset.navClick;
                    }
                });
            });
        });
    </script>

    <script>
        // High-Precision macOS-Style World Clock Engine
        document.addEventListener('DOMContentLoaded', function () {
            const cities = {
                'nigeria': { tz: 'Africa/Lagos', isHome: true },
                'cupertino': { tz: 'America/Los_Angeles', isHome: false },
                'tokyo': { tz: 'Asia/Tokyo', isHome: false },
                'sydney': { tz: 'Australia/Sydney', isHome: false },
                'paris': { tz: 'Europe/Paris', isHome: false }
            };

            // 1. Generate Ticks and Numbers dynamically for all clocks to keep HTML light and clean
            Object.keys(cities).forEach(id => {
                const clock = document.getElementById(`analog-${id}`);
                if (!clock) return;

                const ticksGroup = clock.querySelector('.clock-ticks');
                const numbersGroup = clock.querySelector('.clock-numbers');

                // Generate 60 ticks
                if (ticksGroup) {
                    for (let i = 0; i < 60; i++) {
                        const angle = i * 6 * Math.PI / 180;
                        const isHour = i % 5 === 0;
                        const rStart = isHour ? 41 : 44;
                        const rEnd = 47;
                        const x1 = 50 + rStart * Math.sin(angle);
                        const y1 = 50 - rStart * Math.cos(angle);
                        const x2 = 50 + rEnd * Math.sin(angle);
                        const y2 = 50 - rEnd * Math.cos(angle);

                        const line = document.createElementNS('http://www.w3.org/2000/svg', 'line');
                        line.setAttribute('x1', x1);
                        line.setAttribute('y1', y1);
                        line.setAttribute('x2', x2);
                        line.setAttribute('y2', y2);
                        if (isHour) {
                            line.setAttribute('stroke-width', '1.8');
                        } else {
                            line.setAttribute('stroke-width', '0.6');
                        }
                        ticksGroup.appendChild(line);
                    }
                }

                // Generate hour numbers
                if (numbersGroup) {
                    const radius = 33; // radius of numbers placement
                    for (let i = 1; i <= 12; i++) {
                        const angle = (i * 30) * Math.PI / 180;
                        const x = 50 + radius * Math.sin(angle);
                        const y = 50 - radius * Math.cos(angle);

                        const text = document.createElementNS('http://www.w3.org/2000/svg', 'text');
                        text.setAttribute('x', x);
                        text.setAttribute('y', y + 0.5); // vertical adjust
                        text.textContent = i;
                        numbersGroup.appendChild(text);
                    }
                }
            });

            // Helper to get offset minutes relative to UTC
            function getTzOffsetMinutes(tz, date) {
                try {
                    const formatter = new Intl.DateTimeFormat('en-US', {
                        timeZone: tz,
                        timeZoneName: 'longOffset'
                    });
                    const part = formatter.formatToParts(date).find(p => p.type === 'timeZoneName');
                    if (!part) return 0;
                    const offsetStr = part.value; // e.g. "GMT-7", "GMT+9:30", "GMT"
                    if (offsetStr === 'GMT') return 0;
                    const match = offsetStr.match(/GMT([+-])(\d+)(?::(\d+))?/);
                    if (!match) return 0;
                    const sign = match[1] === '+' ? 1 : -1;
                    const hours = parseInt(match[2]);
                    const minutes = match[3] ? parseInt(match[3]) : 0;
                    return sign * (hours * 60 + minutes);
                } catch (e) {
                    console.error(`Error fetching timezone offset for ${tz}:`, e);
                    return 0;
                }
            }

            // Central ticking update function
            function updateClocks() {
                const now = new Date();
                
                // Get local browser GMT offset in minutes
                const localOffsetMinutes = -now.getTimezoneOffset();

                Object.entries(cities).forEach(([id, info]) => {
                    try {
                        // 1. Get current time parts in target timezone
                        const formatter = new Intl.DateTimeFormat('en-US', {
                            timeZone: info.tz,
                            hour: 'numeric',
                            minute: '2-digit',
                            second: '2-digit',
                            hour12: false,
                            year: 'numeric',
                            month: '2-digit',
                            day: '2-digit'
                        });

                        const parts = formatter.formatToParts(now);
                        const partVal = (type) => parts.find(p => p.type === type).value;

                        const year = parseInt(partVal('year'));
                        const month = parseInt(partVal('month')) - 1;
                        const day = parseInt(partVal('day'));
                        const hour24 = parseInt(partVal('hour'));
                        const hour12 = hour24 % 12;
                        const minute = parseInt(partVal('minute'));
                        const second = parseInt(partVal('second'));

                        // 2. Rotate Hands
                        const secDeg = second * 6;
                        const minDeg = minute * 6 + second * 0.1;
                        const hrDeg = hour12 * 30 + minute * 0.5;

                        const hrHand = document.getElementById(`hand-hour-${id}`);
                        const minHand = document.getElementById(`hand-minute-${id}`);
                        const secHand = document.getElementById(`hand-second-${id}`);

                        if (hrHand) hrHand.setAttribute('transform', `rotate(${hrDeg} 50 50)`);
                        if (minHand) minHand.setAttribute('transform', `rotate(${minDeg} 50 50)`);
                        if (secHand) secHand.setAttribute('transform', `rotate(${secDeg} 50 50)`);

                        // 3. Toggle Day/Night Clock face dynamically
                        const svg = document.getElementById(`analog-${id}`);
                        if (svg) {
                            const isDay = hour24 >= 6 && hour24 < 18;
                            if (isDay) {
                                svg.classList.add('clock-day');
                                svg.classList.remove('clock-night');
                            } else {
                                svg.classList.add('clock-night');
                                svg.classList.remove('clock-day');
                            }
                        }

                        // 4. Update Digital time display
                        const digitalEl = document.getElementById(`digital-${id}`);
                        if (digitalEl) {
                            const ampm = hour24 >= 12 ? 'PM' : 'AM';
                            const displayHr = hour12 === 0 ? 12 : hour12;
                            const displayMin = String(minute).padStart(2, '0');
                            digitalEl.textContent = `${displayHr}:${displayMin} ${ampm}`;
                        }

                        // 5. Update Offset relative to browser/system local time
                        const offsetEl = document.getElementById(`offset-${id}`);
                        if (offsetEl) {
                            if (info.isHome) {
                                offsetEl.textContent = 'Home';
                            } else {
                                const targetOffset = getTzOffsetMinutes(info.tz, now);
                                const diffHrs = (targetOffset - localOffsetMinutes) / 60;
                                const sign = diffHrs >= 0 ? '+' : '';
                                const hrsText = Math.abs(diffHrs) === 1 ? 'HR' : 'HRS';
                                const formattedDiff = Number.isInteger(diffHrs) ? diffHrs : diffHrs.toFixed(1);
                                offsetEl.textContent = `${sign}${formattedDiff}${hrsText}`;
                            }
                        }

                        // 6. Update Calendar Relative Day
                        const dayEl = document.getElementById(`day-${id}`);
                        if (dayEl) {
                            const localFormatter = new Intl.DateTimeFormat('en-US', {
                                year: 'numeric',
                                month: '2-digit',
                                day: '2-digit'
                            });
                            const lParts = localFormatter.formatToParts(now);
                            const ly = parseInt(lParts.find(p => p.type === 'year').value);
                            const lm = parseInt(lParts.find(p => p.type === 'month').value) - 1;
                            const ld = parseInt(lParts.find(p => p.type === 'day').value);

                            const targetDate = new Date(year, month, day);
                            const localDate = new Date(ly, lm, ld);

                            const diffTime = targetDate - localDate;
                            const diffDays = Math.round(diffTime / (1000 * 60 * 60 * 24));

                            if (diffDays === 0) {
                                dayEl.textContent = 'Today';
                            } else if (diffDays === -1) {
                                dayEl.textContent = 'Yesterday';
                            } else if (diffDays === 1) {
                                dayEl.textContent = 'Tomorrow';
                            } else {
                                const sign = diffDays > 0 ? '+' : '';
                                dayEl.textContent = `${sign}${diffDays} Days`;
                            }
                        }
                    } catch (e) {
                        console.error(`Error updating world clock for ${id}:`, e);
                    }
                });
            }

            updateClocks();
            setInterval(updateClocks, 1000);
        });

        // --- PROFILE TABS SWITCHING LOGIC ---
        function switchProfileTab(tabName) {
            // 1. Get all tab buttons and reset styles
            const buttons = document.querySelectorAll('.profile-tab-btn');
            buttons.forEach(btn => {
                btn.className = "profile-tab-btn flex items-center justify-between text-left px-5 py-4 rounded-2xl border border-white/10 bg-white/5 text-gray-300 font-semibold transition-all duration-300 hover:bg-white/10 hover:text-white hover:scale-[1.01] active:scale-[0.99] select-none";
                const badge = btn.querySelector('.rounded-full');
                if (badge) {
                    badge.className = "w-8 h-8 rounded-full bg-white/10 flex items-center justify-center text-gray-400 text-sm font-bold";
                }
                const svg = btn.querySelector('svg');
                if (svg) {
                    svg.className = "w-4 h-4 opacity-50";
                }
            });

            // 2. Set active styles for the clicked button
            const activeBtn = document.getElementById(`tab-${tabName}`);
            if (activeBtn) {
                activeBtn.className = "profile-tab-btn flex items-center justify-between text-left px-5 py-4 rounded-2xl border border-cyan-400 bg-cyan-400/10 text-white font-bold transition-all duration-300 hover:scale-[1.01] active:scale-[0.99] select-none";
                const badge = activeBtn.querySelector('.rounded-full');
                if (badge) {
                    badge.className = "w-8 h-8 rounded-full bg-cyan-400/20 flex items-center justify-center text-cyan-400 text-sm font-bold";
                }
                const svg = activeBtn.querySelector('svg');
                if (svg) {
                    svg.className = "w-4 h-4 text-cyan-400";
                }
            }

            // 3. Update Content Elements based on tab name
            const imgEl = document.getElementById('tab-showcase-image');
            const badgeEl = document.getElementById('tab-image-badge');
            const titleEl = document.getElementById('tab-showcase-title');
            const bodyEl = document.getElementById('tab-showcase-body');

            // Apply fade-out animation for image first
            imgEl.style.opacity = '0';

            setTimeout(() => {
                if (tabName === 'overview') {
                    imgEl.src = "{{ asset('images/landing-profile.png') }}?v={{ filemtime(public_path('images/landing-profile.png')) }}";
                    badgeEl.textContent = "Executive Office";
                    badgeEl.className = "absolute bottom-4 left-4 bg-cyan-500 text-black text-[9px] font-bold uppercase tracking-wider px-2.5 py-1 rounded-md shadow-md";
                    titleEl.textContent = "Who is Dr. Ifeanyi Chukwuma Odii?";
                    bodyEl.innerHTML = `
                        <p>Dr. Ifeanyi Chukwuma Odii is a distinguished Nigerian business leader, philanthropist, and politician with over 20 years of experience building thriving corporate empires and advocating for community growth across Sub-Saharan Africa.</p>
                        <ul class="list-disc pl-5 space-y-2 text-gray-400">
                            <li>Founder and Chairman of Orient Global Group, a multi-sector conglomerate.</li>
                            <li>President/CEO of Ultimus Holdings, a leading construction, logistics, and real estate developer.</li>
                            <li>Co-founder of the Ebele & Anyichuks Foundation, a charity that has built over 140 free homes for widows.</li>
                            <li>2023 Ebonyi State PDP Gubernatorial candidate championing educational and economic reforms.</li>
                        </ul>
                    `;
                } else if (tabName === 'business') {
                    imgEl.src = "{{ asset('images/business_conglomerate.png') }}";
                    badgeEl.textContent = "Enterprise Leader";
                    badgeEl.className = "absolute bottom-4 left-4 bg-amber-400 text-black text-[9px] font-bold uppercase tracking-wider px-2.5 py-1 rounded-md shadow-md";
                    titleEl.textContent = "Multi-Sector Business Conglomerate";
                    bodyEl.innerHTML = `
                        <p>Dr. Ifeanyi Odii is a visionary builder of industries. Over the last 20 years, he has successfully established and scaled multi-billion Naira companies covering manufacture, real estate, energy, construction, and global trade:</p>
                        <div class="mt-3 space-y-3">
                            <div class="border-l-2 border-amber-400 pl-3">
                                <h4 class="text-xs font-bold text-white uppercase tracking-wider">Orient Global Group</h4>
                                <p class="text-xs text-gray-400 mt-1">Founding Chairman. Operates Orient Global Manufacturing (agro-allied products), Orient Haulage & Logistics, and Purity Agro-Allied Ltd.</p>
                            </div>
                            <div class="border-l-2 border-amber-400 pl-3">
                                <h4 class="text-xs font-bold text-white uppercase tracking-wider">Ultimus Holdings</h4>
                                <p class="text-xs text-gray-400 mt-1">President and CEO. Controls Ultimus Construction, Ultimus Properties, and Ultimus Global Integrated (owners of the iconic premium showroom 'The Classroom by Ultimus' and Viarmor Healthcare Ltd).</p>
                            </div>
                        </div>
                    `;
                } else if (tabName === 'philanthropy') {
                    imgEl.src = "{{ asset('images/philanthropy_housing.png') }}";
                    badgeEl.textContent = "Social Impact";
                    badgeEl.className = "absolute bottom-4 left-4 bg-emerald-500 text-white text-[9px] font-bold uppercase tracking-wider px-2.5 py-1 rounded-md shadow-md";
                    titleEl.textContent = "Empowerment & Philanthropic Legacy";
                    bodyEl.innerHTML = `
                        <p>Believing that wealth is only meaningful when used to lift humanity, Dr. Odii founded the <strong>Ebele & Anyichuks Foundation</strong> alongside his wife, Ebele. The foundation is Ebonyi State's largest private welfare provider:</p>
                        <ul class="list-disc pl-5 space-y-2 text-gray-400 mt-2">
                            <li><strong>Free Housing</strong>: Built and donated over 140 modern, fully furnished houses to widows and less-privileged families.</li>
                            <li><strong>Educational Support</strong>: Disbursed university scholarships to over 1,000 students and donated over 10,000 free WAEC/NECO textbooks and school supplies.</li>
                            <li><strong>Infrastructure & Health</strong>: Donated primary schools, modern churches, and community centers, alongside offering free mobile medical camps and surgical subsidies.</li>
                        </ul>
                    `;
                } else if (tabName === 'politics') {
                    imgEl.src = "{{ asset('images/politics_reform.png') }}";
                    badgeEl.textContent = "Public Leadership";
                    badgeEl.className = "absolute bottom-4 left-4 bg-red-500 text-white text-[9px] font-bold uppercase tracking-wider px-2.5 py-1 rounded-md shadow-md";
                    titleEl.textContent = "Ebonyi State Political Reform Campaign";
                    bodyEl.innerHTML = `
                        <p>Dr. Ifeanyi Chukwuma Odii's political ideology is rooted in systemic economic reform, industrialization, and empowering the youth to create jobs. In the 2023 elections:</p>
                        <ul class="list-disc pl-5 space-y-2 text-gray-400 mt-2">
                            <li>He was the Gubernatorial candidate of the People's Democratic Party (PDP) in Ebonyi State.</li>
                            <li>His manifesto centered around building state-of-the-art public infrastructure, supporting micro-businesses with capital, and transforming Ebonyi State into an industrial manufacturing hub.</li>
                            <li>He continues to actively engage in national policy discussions, championing youth inclusion, transparency, and grassroots economic empowerment.</li>
                        </ul>
                    `;
                }
                imgEl.style.opacity = '1';
            }, 150);
        }
    </script>



        // =========================================================================
        // MOBILE INTERACTIVE LANDSCAPE BOARDROOM CONTROLLER
        // =========================================================================
        let currentPanPercent = 50;
        window.panBoardroom = function(percent, target) {
            currentPanPercent = percent;
            const bgImg = document.getElementById('site-bg-image');
            if (bgImg) {
                bgImg.style.objectPosition = `${percent}% 25%`;
            }
            ['flag', 'center', 'gov'].forEach(t => {
                const el = document.getElementById('chip-pan-' + t);
                if (el) {
                    if (t === target) {
                        el.className = "px-2.5 py-1 rounded-full bg-amber-400 text-black font-extrabold text-[10px] shrink-0 active:scale-95 cursor-pointer shadow-md";
                    } else {
                        el.className = "px-2.5 py-1 rounded-full bg-white/10 text-gray-300 hover:text-white font-bold text-[10px] shrink-0 active:scale-95 cursor-pointer";
                    }
                }
            });
        };

        // Touch Drag / Horizontal Swipe listener for Mobile Hero
        document.addEventListener('DOMContentLoaded', () => {
            const heroSummary = document.querySelector('#section-home summary');
            if (heroSummary) {
                let startX = 0;
                let startPan = 50;
                let isDragging = false;

                heroSummary.addEventListener('touchstart', (e) => {
                    if (e.touches.length === 1) {
                        startX = e.touches[0].clientX;
                        startPan = currentPanPercent;
                        isDragging = true;
                    }
                }, { passive: true });

                heroSummary.addEventListener('touchmove', (e) => {
                    if (!isDragging || e.touches.length !== 1) return;
                    const deltaX = e.touches[0].clientX - startX;
                    let newPercent = startPan - (deltaX / window.innerWidth) * 75;
                    newPercent = Math.max(10, Math.min(90, newPercent));
                    const bgImg = document.getElementById('site-bg-image');
                    if (bgImg) {
                        bgImg.style.objectPosition = `${newPercent}% 25%`;
                    }
                    const mobileCardImg = document.getElementById('mobile-boardroom-card-img');
                    if (mobileCardImg) {
                        mobileCardImg.style.objectPosition = `${newPercent}% center`;
                    }
                }, { passive: true });

                heroSummary.addEventListener('touchend', () => {
                    isDragging = false;
                }, { passive: true });
            }
        });

        // =========================================================================
        // MOBILE NAVIGATION DRAWER CONTROLLER
        // =========================================================================
        window.toggleMobileNav = function() {
            const drawer = document.getElementById('mobile-nav-drawer');
            const hamburger = document.getElementById('hamburger-icon');
            const close = document.getElementById('close-icon');
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
                window.closeMobileNav();
            }
        };

        window.closeMobileNav = function() {
            const drawer = document.getElementById('mobile-nav-drawer');
            const hamburger = document.getElementById('hamburger-icon');
            const close = document.getElementById('close-icon');
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

        // Landscape Cinema Modal Functions
        window.openLandscapeCinema = function() {
            const modal = document.getElementById('landscape-cinema-modal');
            if (!modal) return;
            modal.style.display = 'flex';
            void modal.offsetWidth;
            modal.classList.remove('opacity-0', 'pointer-events-none');
            modal.classList.add('opacity-100', 'pointer-events-auto');
        };

        window.closeLandscapeCinema = function() {
            const modal = document.getElementById('landscape-cinema-modal');
            if (!modal) return;
            modal.classList.add('opacity-0', 'pointer-events-none');
            modal.classList.remove('opacity-100', 'pointer-events-auto');
            setTimeout(() => { modal.style.display = 'none'; }, 300);
        };

        window.showHotspotInfo = function(type) {
            const titleEl = document.getElementById('hotspot-title');
            const descEl = document.getElementById('hotspot-desc');
            if (!titleEl || !descEl) return;

            if (type === 'flag') {
                titleEl.textContent = "Peoples Democratic Party (PDP) Mandate";
                descEl.textContent = "Official party banner and INEC-accredited ticket for the 2027 Ebonyi State Gubernatorial Election.";
            } else if (type === 'bio') {
                titleEl.textContent = "Dr. Ifeanyi Chukwuma Odii (ANYICHUKS)";
                descEl.textContent = "Founder & Chairman Orient Global Group and Ultimus Holdings. Built 140+ free homes for widows before running for office.";
            } else if (type === 'gov-flag') {
                titleEl.textContent = "ANYICHUKS FOR GOVERNOR EBONYI STATE 2027";
                descEl.textContent = "Official Gubernatorial Blueprint: 40,000 industrial jobs, 3 Senatorial Tech Hubs, prompt civil service salaries on 25th.";
            } else if (type === 'banner') {
                titleEl.textContent = "ANYI GA EMEYA 2027 Campaign War Room";
                descEl.textContent = "A unified grassroots victory engine mobilizing all 13 LGAs, 171 wards, and 24,800+ accredited ambassadors.";
            }
        };

        window.showHotspotPopup = function(type) {
            window.showHotspotInfo(type);
            window.openLandscapeCinema();
        };

        window.rotatePhoneTip = function() {
            alert("📱 Tip: Rotate your phone sideways to landscape orientation for the ultimate full-bleed executive boardroom view!");
        };
    </script>

    <!-- Interactive Fullscreen Landscape Cinema Modal -->
    <div id="landscape-cinema-modal" class="fixed inset-0 z-[10000] bg-black/95 backdrop-blur-2xl transition-all duration-500 opacity-0 pointer-events-none flex flex-col justify-between" style="display: none;">
        <!-- Top Bar -->
        <div class="px-4 py-3 border-b border-white/15 flex items-center justify-between bg-black/70 shrink-0">
            <div class="flex items-center gap-2">
                <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                <span class="text-xs font-black uppercase tracking-wider text-amber-400">Executive Boardroom Landscape Cinema</span>
                <span class="hidden sm:inline-block px-2 py-0.5 rounded bg-white/10 text-[10px] text-gray-300 font-mono">16:9 8K Master</span>
            </div>
            <div class="flex items-center gap-2">
                <a href="/campaign-2027" class="px-3.5 py-1 rounded-full bg-amber-400 text-black text-[11px] font-black uppercase tracking-wider hover:bg-amber-300 transition-colors shadow-md">
                    War Room &rarr;
                </a>
                <button type="button" onclick="window.closeLandscapeCinema()" class="w-8 h-8 rounded-full bg-white/10 hover:bg-red-500/30 text-gray-300 hover:text-white flex items-center justify-center font-bold text-sm cursor-pointer">
                    ✕
                </button>
            </div>
        </div>

        <!-- Main Panorama Interactive Canvas -->
        <div class="relative flex-grow flex items-center justify-center overflow-hidden p-2 sm:p-4">
            <div class="relative max-w-6xl w-full aspect-video rounded-2xl overflow-hidden border border-amber-400/40 shadow-[0_0_80px_rgba(245,158,11,0.25)] group bg-black">
                <img src="{{ asset('images/landing-profile.png') }}?v={{ file_exists(public_path('images/landing-profile.png')) ? filemtime(public_path('images/landing-profile.png')) : time() }}"
                     alt="Dr. Ifeanyi Chukwuma Odii Executive Office"
                     class="w-full h-full object-cover select-none">
                
                <!-- Interactive Hotspot 1: Standing PDP Flag (Left) -->
                <button type="button" onclick="window.showHotspotInfo('flag')" class="absolute top-[35%] left-[22%] -translate-x-1/2 -translate-y-1/2 p-2.5 rounded-full bg-black/80 border-2 border-emerald-400 text-emerald-400 shadow-2xl hover:scale-110 active:scale-95 transition-all group/pin cursor-pointer" aria-label="Standing PDP Flag">
                    <span class="w-3 h-3 rounded-full bg-emerald-400 animate-ping absolute inset-0 m-auto"></span>
                    <span class="relative text-xs">🚩</span>
                    <span class="absolute left-1/2 -bottom-7 -translate-x-1/2 whitespace-nowrap bg-black/95 border border-emerald-400/50 px-2 py-0.5 rounded text-[10px] text-emerald-300 font-bold opacity-0 group-hover/pin:opacity-100 transition-opacity">PDP Standing Flag</span>
                </button>

                <!-- Interactive Hotspot 2: Dr. Ifeanyi Chukwuma Odii (Center) -->
                <button type="button" onclick="window.showHotspotInfo('bio')" class="absolute top-[40%] left-[50%] -translate-x-1/2 -translate-y-1/2 p-2.5 rounded-full bg-black/80 border-2 border-amber-400 text-amber-400 shadow-2xl hover:scale-110 active:scale-95 transition-all group/pin cursor-pointer" aria-label="Dr. Odii Profile">
                    <span class="w-3 h-3 rounded-full bg-amber-400 animate-ping absolute inset-0 m-auto"></span>
                    <span class="relative text-xs">👤</span>
                    <span class="absolute left-1/2 -bottom-7 -translate-x-1/2 whitespace-nowrap bg-black/95 border border-amber-400/50 px-2 py-0.5 rounded text-[10px] text-amber-300 font-bold opacity-0 group-hover/pin:opacity-100 transition-opacity">Dr. Odii Profile</span>
                </button>

                <!-- Interactive Hotspot 3: ANYICHUKS FOR GOVERNOR Table Flag (Right of Desk) -->
                <button type="button" onclick="window.showHotspotInfo('gov-flag')" class="absolute top-[68%] left-[75%] -translate-x-1/2 -translate-y-1/2 p-2.5 rounded-full bg-black/80 border-2 border-cyan-400 text-cyan-400 shadow-2xl hover:scale-110 active:scale-95 transition-all group/pin cursor-pointer" aria-label="Gov 2027 Flag">
                    <span class="w-3 h-3 rounded-full bg-cyan-400 animate-ping absolute inset-0 m-auto"></span>
                    <span class="relative text-xs">🏛️</span>
                    <span class="absolute left-1/2 -bottom-7 -translate-x-1/2 whitespace-nowrap bg-black/95 border border-cyan-400/50 px-2 py-0.5 rounded text-[10px] text-cyan-300 font-bold opacity-0 group-hover/pin:opacity-100 transition-opacity">Gov 2027 Flag</span>
                </button>

                <!-- Interactive Hotspot 4: ANYI GA EMEYA 2027 Banner (Top Right) -->
                <button type="button" onclick="window.showHotspotInfo('banner')" class="absolute top-[20%] left-[82%] -translate-x-1/2 -translate-y-1/2 p-2.5 rounded-full bg-black/80 border-2 border-red-400 text-red-400 shadow-2xl hover:scale-110 active:scale-95 transition-all group/pin cursor-pointer" aria-label="2027 Banner">
                    <span class="w-3 h-3 rounded-full bg-red-400 animate-ping absolute inset-0 m-auto"></span>
                    <span class="relative text-xs">⚡</span>
                    <span class="absolute left-1/2 -bottom-7 -translate-x-1/2 whitespace-nowrap bg-black/95 border border-red-400/50 px-2 py-0.5 rounded text-[10px] text-red-300 font-bold opacity-0 group-hover/pin:opacity-100 transition-opacity">2027 Banner</span>
                </button>
            </div>
        </div>

        <!-- Bottom Interactive Info Drawer -->
        <div id="landscape-hotspot-card" class="px-4 py-3.5 bg-black/90 border-t border-white/10 shrink-0 flex flex-col sm:flex-row sm:items-center justify-between gap-3">
            <div class="space-y-0.5">
                <h4 id="hotspot-title" class="text-sm font-black text-amber-400">ANYICHUKS FOR GOVERNOR EBONYI STATE 2027</h4>
                <p id="hotspot-desc" class="text-xs text-gray-300">Tap on any glowing icon above to explore the boardroom details and campaign flags.</p>
            </div>
            <div class="flex items-center gap-2 shrink-0">
                <button type="button" onclick="window.rotatePhoneTip()" class="px-3.5 py-1.5 rounded-lg bg-white/10 hover:bg-white/20 text-[11px] text-gray-200 font-bold flex items-center gap-1.5 cursor-pointer">
                    <span>📱 Rotate Phone</span>
                </button>
            </div>
        </div>
    </div>
</body>

</html>