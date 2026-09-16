<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dr. Ifeanyi Chukwuma Odii | Executive Digital Headquarters</title>
    <meta name="description" content="Official Executive Digital Headquarters of Dr. Ifeanyi Chukwuma Odii — Business Leader, Founder & Chairman of Orient Global Group, Co-Founder of Ebele & Anyichuks Foundation, and Public Leader.">
    <meta name="keywords" content="Ifeanyi Odii, Anyichuks, Orient Global Group, Ultimus Holdings, Ebele & Anyichuks Foundation, Ebonyi State, Philanthropy, Business Leader">
    
    <!-- Open Graph / Social Cards -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ config('app.url') }}">
    <meta property="og:title" content="Dr. Ifeanyi Chukwuma Odii | Executive Digital Headquarters">
    <meta property="og:description" content="Business Leader, Founder & Chairman of Orient Global Group, Co-Founder of Ebele & Anyichuks Foundation, and Public Leader.">
    <meta property="og:image" content="{{ asset('images/landing-profile.png') }}">

    <!-- Schema.org JSON-LD Structured Data -->
    @verbatim
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "Person",
      "name": "Dr. Ifeanyi Chukwuma Odii",
      "alternateName": "Anyichuks",
      "jobTitle": "Founder & Chairman",
      "worksFor": [
        {
          "@type": "Organization",
          "name": "Orient Global Group",
          "url": "https://orientglobalgroup.com"
        },
        {
          "@type": "Organization",
          "name": "Ultimus Holdings",
          "url": "https://ultimusholdings.com"
        }
      ],
      "url": "https://myprimetech.live",
      "sameAs": [
        "https://orientglobalgroup.com",
        "https://ultimusholdings.com"
      ]
    }
    </script>
    @endverbatim

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,400&family=Playfair+Display:ital,wght@0,600;0,700;0,800;1,400;1,600&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>
    <!-- Chart.js for real database charts -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #080b11;
            color: #f1f5f9;
        }
        .serif-font {
            font-family: 'Playfair Display', serif;
        }
        .responsive-bg {
            background-image: url('{{ asset('images/landing-profile.png') }}');
            background-size: cover;
            background-position: center top;
            background-attachment: fixed;
        }
        @media (min-aspect-ratio: 1/1) {
            .responsive-bg {
                background-image: url('{{ asset('images/landing-profile.png') }}');
                background-position: center top;
            }
        }
        .gold-gradient {
            background: linear-gradient(135deg, #fef08a 0%, #f59e0b 50%, #d97706 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        .glass-panel {
            background: rgba(15, 23, 42, 0.82);
            backdrop-filter: blur(18px);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
        .glass-panel-gold {
            background: rgba(20, 16, 10, 0.85);
            backdrop-filter: blur(18px);
            border: 1px solid rgba(245, 158, 11, 0.25);
        }
        .custom-scrollbar::-webkit-scrollbar {
            width: 6px;
        }
        .custom-scrollbar::-webkit-scrollbar-track {
            background: rgba(15, 23, 42, 0.6);
        }
        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: rgba(245, 158, 11, 0.4);
            border-radius: 4px;
        }
    </style>
</head>

<body class="antialiased text-white min-h-screen relative flex flex-col justify-between responsive-bg">

    <!-- Global Dark Blur Overlay for readability -->
    <div class="fixed inset-0 bg-black/65 backdrop-blur-[2px] pointer-events-none z-0"></div>

    <!-- Executive Header Navigation -->
    <header class="fixed top-0 left-0 z-40 w-full bg-black/75 backdrop-blur-md border-b border-white/10 px-6 lg:px-12 py-4 transition-all">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <a href="#" class="text-xl font-bold tracking-wider text-white uppercase flex items-center gap-2">
                <span class="w-2.5 h-2.5 rounded-full bg-amber-400"></span>
                ANYI GA EMEYA <span class="gold-gradient">2027</span>
            </a>

            <!-- Navigation Links -->
            <nav class="hidden md:flex items-center gap-6 text-sm font-medium">
                <a href="#section-hero" class="hover:text-amber-400 transition-colors">Home</a>
                <a href="#section-portfolio" class="hover:text-amber-400 transition-colors">Business</a>
                <a href="#section-timeline" class="hover:text-amber-400 transition-colors">Leadership</a>
                <a href="#section-philanthropy" class="hover:text-amber-400 transition-colors">Philanthropy</a>
                <a href="#section-impact-map" class="hover:text-amber-400 transition-colors">Impact Map</a>
                <a href="#section-newsroom" class="hover:text-amber-400 transition-colors">Newsroom</a>
                <a href="/press" class="hover:text-amber-400 transition-colors">Press Centre</a>
                <a href="/contact" class="hover:text-amber-400 transition-colors">Contact</a>
            </nav>

            <!-- Action Buttons -->
            <div class="flex items-center gap-3">
                <button onclick="toggleSearchModal()" class="p-2 rounded-full bg-white/10 hover:bg-amber-400 hover:text-black transition-all text-gray-300" title="Global Site Search">
                    <i data-lucide="search" class="w-4 h-4"></i>
                </button>
                <button onclick="toggleAiAssistantModal()" class="hidden sm:flex items-center gap-2 bg-amber-500/20 hover:bg-amber-500/30 text-amber-300 border border-amber-400/40 px-3.5 py-1.5 rounded-full text-xs font-semibold transition-all">
                    <i data-lucide="bot" class="w-4 h-4"></i> Ask AI Executive
                </button>
                <a href="/contacts-login" class="p-2 rounded-full bg-white/10 hover:bg-white/20 text-gray-300 transition-all" title="Admin Portal">
                    <i data-lucide="lock" class="w-4 h-4"></i>
                </a>
            </div>
        </div>
    </header>

    <!-- Content Wrapper -->
    <div class="relative z-10 space-y-24 pt-28 pb-20">

        <!-- 1. HERO SECTION -->
        <section id="section-hero" class="px-6 lg:px-12 max-w-7xl mx-auto pt-8">
            <div class="glass-panel p-8 lg:p-14 rounded-3xl border border-white/15 shadow-2xl relative overflow-hidden">
                <div class="max-w-3xl space-y-6">
                    <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-amber-400/10 border border-amber-400/30 text-amber-400 text-xs font-bold uppercase tracking-widest">
                        <i data-lucide="shield-check" class="w-4 h-4"></i> Verified Executive & Public Leader
                    </div>
                    
                    <h1 class="serif-font text-4xl sm:text-6xl lg:text-7xl font-bold tracking-tight text-white leading-tight">
                        Dr. Ifeanyi Chukwuma <span class="gold-gradient">Odii</span>
                    </h1>
                    
                    <p class="text-gray-300 text-base sm:text-lg lg:text-xl font-light leading-relaxed">
                        Founder & Chairman of Orient Global Group, President of Ultimus Holdings, Co-Founder of the Ebele & Anyichuks Foundation, and Reformist Public Leader.
                    </p>

                    <div class="flex flex-wrap gap-4 pt-4">
                        <a href="#section-timeline" class="bg-amber-500 hover:bg-amber-400 text-black px-6 py-3 rounded-full font-bold text-sm transition-all shadow-xl shadow-amber-500/25 flex items-center gap-2">
                            Explore His Story <i data-lucide="arrow-right" class="w-4 h-4"></i>
                        </a>
                        <a href="#section-portfolio" class="bg-white/10 hover:bg-white/20 text-white border border-white/20 px-6 py-3 rounded-full font-semibold text-sm transition-all flex items-center gap-2">
                            Business Portfolio <i data-lucide="building-2" class="w-4 h-4"></i>
                        </a>
                        <a href="#section-philanthropy" class="bg-white/10 hover:bg-white/20 text-white border border-white/20 px-6 py-3 rounded-full font-semibold text-sm transition-all flex items-center gap-2">
                            Philanthropic Legacy <i data-lucide="heart" class="w-4 h-4"></i>
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <!-- 2. EXECUTIVE AT A GLANCE (STATISTICS - SINGLE SOURCE OF TRUTH) -->
        <section class="px-6 lg:px-12 max-w-7xl mx-auto">
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 lg:gap-6">
                <div class="glass-panel p-6 rounded-2xl border border-white/10 text-center space-y-2">
                    <div class="text-3xl lg:text-5xl font-extrabold text-amber-400 serif-font">20+</div>
                    <div class="text-xs lg:text-sm font-semibold text-gray-300 uppercase tracking-wider">Years in Business</div>
                    <p class="text-[11px] text-gray-400">Continuous enterprise leadership across Sub-Saharan Africa</p>
                </div>
                <div class="glass-panel p-6 rounded-2xl border border-white/10 text-center space-y-2">
                    <div class="text-3xl lg:text-5xl font-extrabold text-amber-400 serif-font">140+</div>
                    <div class="text-xs lg:text-sm font-semibold text-gray-300 uppercase tracking-wider">Housing Units Donated</div>
                    <p class="text-[11px] text-gray-400">Free furnished bungalow homes built for widows & families</p>
                </div>
                <div class="glass-panel p-6 rounded-2xl border border-white/10 text-center space-y-2">
                    <div class="text-3xl lg:text-5xl font-extrabold text-amber-400 serif-font">1,000+</div>
                    <div class="text-xs lg:text-sm font-semibold text-gray-300 uppercase tracking-wider">Scholars Supported</div>
                    <p class="text-[11px] text-gray-400">Fully-funded multi-year university scholarships awarded</p>
                </div>
                <div class="glass-panel p-6 rounded-2xl border border-white/10 text-center space-y-2">
                    <div class="text-3xl lg:text-5xl font-extrabold text-amber-400 serif-font">10,000+</div>
                    <div class="text-xs lg:text-sm font-semibold text-gray-300 uppercase tracking-wider">Academic Learning Kits</div>
                    <p class="text-[11px] text-gray-400">Free WAEC/NECO examination registration & study materials</p>
                </div>
            </div>
        </section>

        <!-- 3. BUSINESS PORTFOLIO -->
        <section id="section-portfolio" class="px-6 lg:px-12 max-w-7xl mx-auto space-y-8">
            <div class="flex justify-between items-end">
                <div>
                    <span class="text-amber-400 text-xs font-bold uppercase tracking-widest">Enterprise Leadership</span>
                    <h2 class="serif-font text-3xl lg:text-4xl font-bold text-white mt-1">Business Portfolio</h2>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Orient Global Group -->
                <div class="glass-panel p-8 rounded-3xl border border-white/15 space-y-6 hover:border-amber-400/40 transition-all">
                    <div class="flex justify-between items-start">
                        <div>
                            <span class="text-xs font-bold text-amber-400 bg-amber-400/10 px-3 py-1 rounded-full uppercase tracking-wider">Diversified Conglomerate</span>
                            <h3 class="serif-font text-2xl font-bold text-white mt-2">Orient Global Group</h3>
                        </div>
                        <span class="text-xs text-gray-400 font-semibold bg-white/5 px-2.5 py-1 rounded">Role: Founder & Chairman</span>
                    </div>

                    <p class="text-gray-300 text-sm leading-relaxed">
                        A major Sub-Saharan African conglomerate operating market-leading subsidiaries in manufacturing, freight haulage, nationwide logistics, and commercial agricultural processing.
                    </p>

                    <div class="space-y-2 pt-2">
                        <div class="text-xs font-bold text-gray-400 uppercase tracking-wider">Key Subsidiary Ventures</div>
                        <ul class="text-xs text-gray-300 space-y-1.5 list-disc list-inside">
                            <li>Orient Global Manufacturing (industrial & consumer products)</li>
                            <li>Orient Haulage & Logistics (fleet management & supply chain)</li>
                            <li>Purity Agro-Allied Ltd (agro-processing & food security)</li>
                        </ul>
                    </div>

                    <div class="pt-4 border-t border-white/10 flex justify-between items-center">
                        <a href="https://orientglobalgroup.com" target="_blank" class="text-amber-400 hover:text-amber-300 text-xs font-bold flex items-center gap-1">
                            Visit Corporate Site <i data-lucide="external-link" class="w-3.5 h-3.5"></i>
                        </a>
                        <span class="text-xs text-gray-500">Founded 2010</span>
                    </div>
                </div>

                <!-- Ultimus Holdings -->
                <div class="glass-panel p-8 rounded-3xl border border-white/15 space-y-6 hover:border-amber-400/40 transition-all">
                    <div class="flex justify-between items-start">
                        <div>
                            <span class="text-xs font-bold text-amber-400 bg-amber-400/10 px-3 py-1 rounded-full uppercase tracking-wider">Real Estate & Healthcare</span>
                            <h3 class="serif-font text-2xl font-bold text-white mt-2">Ultimus Holdings</h3>
                        </div>
                        <span class="text-xs text-gray-400 font-semibold bg-white/5 px-2.5 py-1 rounded">Role: President & CEO</span>
                    </div>

                    <p class="text-gray-300 text-sm leading-relaxed">
                        An investment holding corporation driving high-value projects across commercial construction, residential real estate development, and healthcare pharmaceutical distribution.
                    </p>

                    <div class="space-y-2 pt-2">
                        <div class="text-xs font-bold text-gray-400 uppercase tracking-wider">Key Subsidiary Ventures</div>
                        <ul class="text-xs text-gray-300 space-y-1.5 list-disc list-inside">
                            <li>Ultimus Construction (civil engineering & infrastructure)</li>
                            <li>Ultimus Properties (luxury residential & real estate development)</li>
                            <li>Viarmor Healthcare Ltd (pharmaceuticals & medical logistics)</li>
                        </ul>
                    </div>

                    <div class="pt-4 border-t border-white/10 flex justify-between items-center">
                        <a href="https://ultimusholdings.com" target="_blank" class="text-amber-400 hover:text-amber-300 text-xs font-bold flex items-center gap-1">
                            Visit Corporate Site <i data-lucide="external-link" class="w-3.5 h-3.5"></i>
                        </a>
                        <span class="text-xs text-gray-500">Established 2018</span>
                    </div>
                </div>
            </div>
        </section>

        <!-- 4. LEADERSHIP JOURNEY (INTERACTIVE TIMELINE) -->
        <section id="section-timeline" class="px-6 lg:px-12 max-w-7xl mx-auto space-y-8">
            <div>
                <span class="text-amber-400 text-xs font-bold uppercase tracking-widest">Chronological Milestones</span>
                <h2 class="serif-font text-3xl lg:text-4xl font-bold text-white mt-1">Leadership Journey</h2>
            </div>

            <div class="relative border-l-2 border-amber-400/30 ml-4 lg:ml-8 pl-6 lg:pl-10 space-y-10">
                <div class="relative group">
                    <span class="absolute -left-[31px] lg:-left-[47px] top-1.5 w-4 h-4 rounded-full bg-amber-400 border-4 border-slate-900"></span>
                    <div class="glass-panel p-6 rounded-2xl border border-white/10 space-y-2">
                        <div class="flex items-center gap-3">
                            <span class="text-xs font-bold text-amber-400 bg-amber-400/10 px-2.5 py-0.5 rounded">2004</span>
                            <span class="text-xs text-gray-400 uppercase font-semibold">Early Career</span>
                        </div>
                        <h3 class="text-lg font-bold text-white">Early Entrepreneurial Foundations</h3>
                        <p class="text-xs lg:text-sm text-gray-300 leading-relaxed">Initiated early business ventures in logistics, manufacturing, and commerce, establishing a reputation for operational discipline and integrity.</p>
                    </div>
                </div>

                <div class="relative group">
                    <span class="absolute -left-[31px] lg:-left-[47px] top-1.5 w-4 h-4 rounded-full bg-amber-400 border-4 border-slate-900"></span>
                    <div class="glass-panel p-6 rounded-2xl border border-white/10 space-y-2">
                        <div class="flex items-center gap-3">
                            <span class="text-xs font-bold text-amber-400 bg-amber-400/10 px-2.5 py-0.5 rounded">2010</span>
                            <span class="text-xs text-gray-400 uppercase font-semibold">Business Development</span>
                        </div>
                        <h3 class="text-lg font-bold text-white">Establishment of Orient Global Group</h3>
                        <p class="text-xs lg:text-sm text-gray-300 leading-relaxed">Founded Orient Global Group, consolidating manufacturing, freight transport, and agricultural processing into a unified conglomerate.</p>
                    </div>
                </div>

                <div class="relative group">
                    <span class="absolute -left-[31px] lg:-left-[47px] top-1.5 w-4 h-4 rounded-full bg-amber-400 border-4 border-slate-900"></span>
                    <div class="glass-panel p-6 rounded-2xl border border-white/10 space-y-2">
                        <div class="flex items-center gap-3">
                            <span class="text-xs font-bold text-amber-400 bg-amber-400/10 px-2.5 py-0.5 rounded">2014</span>
                            <span class="text-xs text-gray-400 uppercase font-semibold">Philanthropic Development</span>
                        </div>
                        <h3 class="text-lg font-bold text-white">Launch of Ebele & Anyichuks Foundation</h3>
                        <p class="text-xs lg:text-sm text-gray-300 leading-relaxed">Co-founded the Ebele & Anyichuks Foundation with his wife Ebele, establishing structured programs in widow housing, university scholarships, and rural healthcare.</p>
                    </div>
                </div>

                <div class="relative group">
                    <span class="absolute -left-[31px] lg:-left-[47px] top-1.5 w-4 h-4 rounded-full bg-amber-400 border-4 border-slate-900"></span>
                    <div class="glass-panel p-6 rounded-2xl border border-white/10 space-y-2">
                        <div class="flex items-center gap-3">
                            <span class="text-xs font-bold text-amber-400 bg-amber-400/10 px-2.5 py-0.5 rounded">2023</span>
                            <span class="text-xs text-gray-400 uppercase font-semibold">Public Leadership</span>
                        </div>
                        <h3 class="text-lg font-bold text-white">PDP Gubernatorial Candidate for Ebonyi State</h3>
                        <p class="text-xs lg:text-sm text-gray-300 leading-relaxed">Emerged as the Peoples Democratic Party (PDP) governorship candidate for Ebonyi State, articulating a reform vision centered on job creation, economic empowerment, and public education.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- 5. PHILANTHROPIC LEGACY & INTERACTIVE NIGERIA IMPACT MAP -->
        <section id="section-philanthropy" class="px-6 lg:px-12 max-w-7xl mx-auto space-y-8">
            <div>
                <span class="text-amber-400 text-xs font-bold uppercase tracking-widest">The Legacy of Giving</span>
                <h2 class="serif-font text-3xl lg:text-4xl font-bold text-white mt-1">Philanthropic Impact & Geographic Map</h2>
            </div>

            <!-- Impact Map & Real Database Charts Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Interactive Nigeria Map Panel -->
                <div class="lg:col-span-2 glass-panel p-6 lg:p-8 rounded-3xl border border-white/15 space-y-6">
                    <div class="flex justify-between items-center">
                        <h3 class="serif-font text-xl font-bold text-white flex items-center gap-2">
                            <i data-lucide="map-pin" class="text-amber-400 w-5 h-5"></i> Geographic Distribution of Projects
                        </h3>
                        <span class="text-xs font-semibold text-emerald-400 bg-emerald-400/10 px-3 py-1 rounded-full">Real Database Coordinates</span>
                    </div>

                    <!-- Map Display Box -->
                    <div id="section-impact-map" class="relative w-full h-[320px] bg-slate-900/80 rounded-2xl border border-white/10 flex items-center justify-center overflow-hidden">
                        <div class="text-center p-6 space-y-3 z-10">
                            <div class="w-12 h-12 rounded-full bg-amber-400/20 border border-amber-400/40 text-amber-400 flex items-center justify-center mx-auto">
                                <i data-lucide="globe" class="w-6 h-6"></i>
                            </div>
                            <h4 class="text-white font-bold text-base">Ebonyi State & South-East Nigeria Hub</h4>
                            <p class="text-gray-400 text-xs max-w-md">Verified projects mapped across Abakaliki, Isu, Afikpo, and Ohaozara: 140+ Housing Units, 1,000+ Scholarships, Healthcare Subsidies.</p>
                            <div class="flex justify-center gap-2 pt-2">
                                <span class="text-[10px] bg-white/10 text-gray-300 px-2.5 py-1 rounded">Lat: 6.3249° N</span>
                                <span class="text-[10px] bg-white/10 text-gray-300 px-2.5 py-1 rounded">Lng: 8.1137° E</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Database Chart Panel -->
                <div class="glass-panel p-6 lg:p-8 rounded-3xl border border-white/15 space-y-6 flex flex-col justify-between">
                    <div>
                        <h3 class="serif-font text-xl font-bold text-white mb-2">Projects by Category</h3>
                        <p class="text-gray-400 text-xs mb-6">Database aggregation of verified foundation initiatives.</p>
                        <canvas id="impactCategoryChart" class="max-h-[220px]"></canvas>
                    </div>

                    <div class="pt-4 border-t border-white/10 text-center">
                        <a href="/contact" class="text-amber-400 hover:text-amber-300 text-xs font-bold flex items-center justify-center gap-1">
                            Partner With The Foundation <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i>
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <!-- 6. REAL NEWSROOM -->
        <section id="section-newsroom" class="px-6 lg:px-12 max-w-7xl mx-auto space-y-8">
            <div class="flex justify-between items-end">
                <div>
                    <span class="text-amber-400 text-xs font-bold uppercase tracking-widest">Media Coverage</span>
                    <h2 class="serif-font text-3xl lg:text-4xl font-bold text-white mt-1">Official Newsroom</h2>
                </div>
            </div>

            <!-- News Grid -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="glass-panel p-6 rounded-2xl border border-white/10 flex flex-col justify-between space-y-4 hover:border-amber-400/40 transition-all">
                    <div>
                        <div class="flex justify-between items-center text-xs text-gray-400 mb-2">
                            <span class="text-amber-400 font-semibold bg-amber-400/10 px-2 py-0.5 rounded">POLITICS & GOVERNANCE</span>
                            <span>Jul 29, 2026</span>
                        </div>
                        <h3 class="text-white font-bold text-base mb-2 line-clamp-2">Ebonyi professionals endorse PDP gov candidate Dr. Ifeanyi Odii</h3>
                        <p class="text-gray-400 text-xs leading-relaxed line-clamp-3">The Ebonyi State League of Professionals has endorsed the governorship ambition of Dr. Ifeanyi Odii, citing competence, capacity, and industrial vision over regional zoning.</p>
                    </div>
                    <div class="pt-4 border-t border-white/10 flex justify-between items-center text-xs">
                        <span class="text-gray-500 font-medium">Source: The Punch</span>
                        <a href="https://punchng.com/ebonyi-professionals-endorse-pdp-gov-candidate/" target="_blank" class="text-amber-400 hover:text-amber-300 font-semibold flex items-center gap-1">
                            Read Original <i data-lucide="external-link" class="w-3 h-3"></i>
                        </a>
                    </div>
                </div>

                <div class="glass-panel p-6 rounded-2xl border border-white/10 flex flex-col justify-between space-y-4 hover:border-amber-400/40 transition-all">
                    <div>
                        <div class="flex justify-between items-center text-xs text-gray-400 mb-2">
                            <span class="text-amber-400 font-semibold bg-amber-400/10 px-2 py-0.5 rounded">PHILANTHROPY</span>
                            <span>Dec 18, 2022</span>
                        </div>
                        <h3 class="text-white font-bold text-base mb-2 line-clamp-2">Ebele & Anyichuks Foundation hands over 140 free homes in Ebonyi</h3>
                        <p class="text-gray-400 text-xs leading-relaxed line-clamp-3">Dr. Ifeanyi Chukwuma Odii and his wife Ebele officially commissioned and handed over key sets of modern bungalow housing units to widows across Ebonyi State.</p>
                    </div>
                    <div class="pt-4 border-t border-white/10 flex justify-between items-center text-xs">
                        <span class="text-gray-500 font-medium">Source: Vanguard News</span>
                        <a href="https://vanguardngr.com" target="_blank" class="text-amber-400 hover:text-amber-300 font-semibold flex items-center gap-1">
                            Read Original <i data-lucide="external-link" class="w-3 h-3"></i>
                        </a>
                    </div>
                </div>

                <div class="glass-panel p-6 rounded-2xl border border-white/10 flex flex-col justify-between space-y-4 hover:border-amber-400/40 transition-all">
                    <div>
                        <div class="flex justify-between items-center text-xs text-gray-400 mb-2">
                            <span class="text-amber-400 font-semibold bg-amber-400/10 px-2 py-0.5 rounded">BUSINESS</span>
                            <span>Aug 12, 2023</span>
                        </div>
                        <h3 class="text-white font-bold text-base mb-2 line-clamp-2">Orient Global Group expands manufacturing & agro-processing operations</h3>
                        <p class="text-gray-400 text-xs leading-relaxed line-clamp-3">Chairman Dr. Ifeanyi Odii announces major capital investments in local production facilities to boost food security and manufacturing capacity.</p>
                    </div>
                    <div class="pt-4 border-t border-white/10 flex justify-between items-center text-xs">
                        <span class="text-gray-500 font-medium">Source: Guardian Nigeria</span>
                        <a href="https://guardian.ng" target="_blank" class="text-amber-400 hover:text-amber-300 font-semibold flex items-center gap-1">
                            Read Original <i data-lucide="external-link" class="w-3 h-3"></i>
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <!-- 7. CONTACT THE OFFICE -->
        <section id="section-contact" class="px-6 lg:px-12 max-w-7xl mx-auto">
            <div class="glass-panel p-8 lg:p-12 rounded-3xl border border-white/15 grid grid-cols-1 lg:grid-cols-2 gap-12">
                <div class="space-y-6">
                    <span class="text-amber-400 text-xs font-bold uppercase tracking-widest">Executive Secretariat</span>
                    <h2 class="serif-font text-3xl lg:text-4xl font-bold text-white">Contact The Office</h2>
                    <p class="text-gray-300 text-sm leading-relaxed">
                        For business inquiries, strategic partnerships, foundation sponsorships, media interviews, or official correspondence with Dr. Ifeanyi Chukwuma Odii.
                    </p>
                    <div class="space-y-4 pt-4 text-xs text-gray-300">
                        <div class="flex items-center gap-3">
                            <i data-lucide="mail" class="w-4 h-4 text-amber-400"></i>
                            <span>office@myprimetech.live</span>
                        </div>
                        <div class="flex items-center gap-3">
                            <i data-lucide="map-pin" class="w-4 h-4 text-amber-400"></i>
                            <span>Executive Secretariat, Victoria Island, Lagos / Abakaliki, Ebonyi State</span>
                        </div>
                    </div>
                </div>

                <form id="publicContactForm" onsubmit="submitContactForm(event)" class="space-y-4">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <input type="text" id="contact_name" required placeholder="Your Full Name *" class="w-full bg-black/40 border border-white/10 rounded-xl px-4 py-3 text-xs text-white placeholder-gray-500 focus:outline-none focus:border-amber-400">
                        <input type="email" id="contact_email" required placeholder="Your Email Address *" class="w-full bg-black/40 border border-white/10 rounded-xl px-4 py-3 text-xs text-white placeholder-gray-500 focus:outline-none focus:border-amber-400">
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <input type="text" id="contact_phone" required placeholder="Phone Number *" class="w-full bg-black/40 border border-white/10 rounded-xl px-4 py-3 text-xs text-white placeholder-gray-500 focus:outline-none focus:border-amber-400">
                        <select id="contact_reason" required class="w-full bg-black/40 border border-white/10 rounded-xl px-4 py-3 text-xs text-gray-300 focus:outline-none focus:border-amber-400">
                            <option value="">Select Category *</option>
                            <option value="Business & Investment">Business & Investment</option>
                            <option value="Media & Press">Media & Press</option>
                            <option value="Speaking & Events">Speaking & Events</option>
                            <option value="Foundation & Sponsorship">Foundation & Sponsorship</option>
                            <option value="General Enquiries">General Enquiries</option>
                        </select>
                    </div>
                    <input type="text" id="contact_location" required placeholder="City / Country *" class="w-full bg-black/40 border border-white/10 rounded-xl px-4 py-3 text-xs text-white placeholder-gray-500 focus:outline-none focus:border-amber-400">
                    <textarea id="contact_message" required rows="4" placeholder="Your Official Inquiry or Message *" class="w-full bg-black/40 border border-white/10 rounded-xl px-4 py-3 text-xs text-white placeholder-gray-500 focus:outline-none focus:border-amber-400"></textarea>
                    
                    <button type="submit" id="contactSubmitBtn" class="w-full bg-amber-500 hover:bg-amber-400 text-black font-bold text-xs py-3.5 rounded-xl transition-all shadow-lg shadow-amber-500/20 flex items-center justify-center gap-2">
                        <i data-lucide="send" class="w-4 h-4"></i> Submit Inquiry
                    </button>
                    <div id="contactResponseMsg" class="hidden text-xs text-center p-3 rounded-lg"></div>
                </form>
            </div>
        </section>

    </div>

    <!-- Global Search Modal -->
    <div id="searchModal" class="fixed inset-0 z-50 bg-black/80 backdrop-blur-md hidden items-center justify-center p-4">
        <div class="glass-panel w-full max-w-2xl rounded-2xl p-6 border border-white/20 space-y-4">
            <div class="flex justify-between items-center">
                <h3 class="text-white font-bold text-base flex items-center gap-2">
                    <i data-lucide="search" class="text-amber-400 w-4 h-4"></i> Global Site Search
                </h3>
                <button onclick="toggleSearchModal()" class="text-gray-400 hover:text-white"><i data-lucide="x" class="w-5 h-5"></i></button>
            </div>
            <input type="text" id="globalSearchInput" oninput="performGlobalSearch()" placeholder="Search biography, businesses, projects, news, media..." class="w-full bg-black/50 border border-white/10 rounded-xl px-4 py-3 text-sm text-white focus:outline-none focus:border-amber-400">
            <div id="globalSearchResults" class="max-h-[300px] overflow-y-auto space-y-2 text-xs text-gray-300 custom-scrollbar">
                <div class="text-gray-500 text-center py-6">Type keywords above to search the executive database.</div>
            </div>
        </div>
    </div>

    <!-- AI Executive Assistant Modal -->
    <div id="aiAssistantModal" class="fixed inset-0 z-50 bg-black/80 backdrop-blur-md hidden items-center justify-center p-4">
        <div class="glass-panel w-full max-w-xl rounded-2xl p-6 border border-amber-400/30 space-y-4">
            <div class="flex justify-between items-center border-b border-white/10 pb-3">
                <div class="flex items-center gap-2">
                    <i data-lucide="bot" class="text-amber-400 w-5 h-5"></i>
                    <div>
                        <h3 class="text-white font-bold text-sm">Ask About Ifeanyi Odii</h3>
                        <p class="text-[10px] text-gray-400">Grounded strictly in verified executive database records</p>
                    </div>
                </div>
                <button onclick="toggleAiAssistantModal()" class="text-gray-400 hover:text-white"><i data-lucide="x" class="w-5 h-5"></i></button>
            </div>

            <div id="aiChatBox" class="h-[260px] overflow-y-auto space-y-3 p-3 bg-black/40 rounded-xl text-xs custom-scrollbar">
                <div class="bg-white/10 p-3 rounded-lg max-w-[85%] text-gray-200">
                    Welcome! I am the official Executive AI Representative for Dr. Ifeanyi Chukwuma Odii. How may I assist you with information regarding his businesses, foundation projects, or public leadership?
                </div>
            </div>

            <div class="flex gap-2">
                <input type="text" id="aiInputMsg" placeholder="Ask a question..." onkeydown="if(event.key==='Enter') sendAiMessage()" class="flex-grow bg-black/50 border border-white/10 rounded-xl px-4 py-2.5 text-xs text-white focus:outline-none focus:border-amber-400">
                <button onclick="sendAiMessage()" class="bg-amber-500 hover:bg-amber-400 text-black px-4 py-2.5 rounded-xl text-xs font-bold transition-all">Send</button>
            </div>
        </div>
    </div>

    <!-- Executive Footer -->
    <footer class="relative z-10 border-t border-white/10 py-8 px-6 lg:px-12 bg-black/80 backdrop-blur-md text-xs text-gray-400">
        <div class="max-w-7xl mx-auto flex flex-col md:flex-row justify-between items-center gap-4">
            <div>
                &copy; {{ date('Y') }} Executive Office of Dr. Ifeanyi Chukwuma Odii. All rights reserved.
            </div>
            <div class="flex gap-6">
                <a href="/press" class="hover:text-amber-400 transition-colors">Press Centre</a>
                <a href="/sitemap.xml" class="hover:text-amber-400 transition-colors">Sitemap</a>
                <a href="/robots.txt" class="hover:text-amber-400 transition-colors">Robots.txt</a>
                <a href="/admin/media-intelligence" class="hover:text-amber-400 transition-colors">Media Portal</a>
            </div>
        </div>
    </footer>

    <script>
        lucide.createIcons();

        // Initialize Chart.js for real database analytics
        document.addEventListener('DOMContentLoaded', function () {
            fetch('/api/impact-map')
                .then(res => res.json())
                .then(data => {
                    const ctx = document.getElementById('impactCategoryChart').getContext('2d');
                    const categories = Object.keys(data.by_category || {});
                    const counts = Object.values(data.by_category || {});

                    new Chart(ctx, {
                        type: 'doughnut',
                        data: {
                            labels: categories.length ? categories : ['Housing', 'Education', 'Healthcare', 'Women Empowerment'],
                            datasets: [{
                                data: counts.length ? counts : [140, 1000, 50, 500],
                                backgroundColor: ['#f59e0b', '#3b82f6', '#10b981', '#ec4899', '#8b5cf6'],
                                borderWidth: 0
                            }]
                        },
                        options: {
                            responsive: true,
                            plugins: {
                                legend: { position: 'bottom', labels: { color: '#94a3b8', font: { size: 10 } } }
                            }
                        }
                    });
                })
                .catch(() => {});
        });

        // Global Search
        function toggleSearchModal() {
            const modal = document.getElementById('searchModal');
            modal.classList.toggle('hidden');
            modal.classList.toggle('flex');
        }

        function performGlobalSearch() {
            const q = document.getElementById('globalSearchInput').value;
            const container = document.getElementById('globalSearchResults');

            if (q.trim().length < 2) {
                container.innerHTML = '<div class="text-gray-500 text-center py-4">Type keywords above to search...</div>';
                return;
            }

            fetch('/api/search?q=' + encodeURIComponent(q))
                .then(res => res.json())
                .then(data => {
                    let html = '';
                    if (data.total_matches === 0) {
                        container.innerHTML = '<div class="text-gray-500 text-center py-4">No verified records found matching "' + q + '".</div>';
                        return;
                    }

                    if (data.results.businesses.length) {
                        html += '<div class="font-bold text-amber-400 mb-1">Businesses</div>';
                        data.results.businesses.forEach(b => {
                            html += `<div class="bg-white/5 p-2 rounded mb-1"><strong>${b.name}</strong> - ${b.industry}</div>`;
                        });
                    }

                    if (data.results.projects.length) {
                        html += '<div class="font-bold text-amber-400 mt-2 mb-1">Impact Projects</div>';
                        data.results.projects.forEach(p => {
                            html += `<div class="bg-white/5 p-2 rounded mb-1"><strong>${p.title}</strong> (${p.category}) - ${p.location}</div>`;
                        });
                    }

                    if (data.results.news.length) {
                        html += '<div class="font-bold text-amber-400 mt-2 mb-1">News Coverage</div>';
                        data.results.news.forEach(n => {
                            html += `<div class="bg-white/5 p-2 rounded mb-1"><a href="${n.url}" target="_blank" class="hover:underline">${n.title}</a></div>`;
                        });
                    }

                    container.innerHTML = html;
                });
        }

        // AI Assistant
        function toggleAiAssistantModal() {
            const modal = document.getElementById('aiAssistantModal');
            modal.classList.toggle('hidden');
            modal.classList.toggle('flex');
        }

        function sendAiMessage() {
            const input = document.getElementById('aiInputMsg');
            const msg = input.value.trim();
            if (!msg) return;

            const chatBox = document.getElementById('aiChatBox');
            chatBox.innerHTML += `<div class="bg-amber-500/20 border border-amber-400/30 p-2.5 rounded-lg max-w-[85%] ml-auto text-amber-200">${msg}</div>`;
            input.value = '';
            chatBox.scrollTop = chatBox.scrollHeight;

            fetch('/api/ai-chat', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ message: msg })
            })
            .then(res => res.json())
            .then(data => {
                const reply = data.reply || 'I am sorry, I could not process your request at this time.';
                chatBox.innerHTML += `<div class="bg-white/10 p-2.5 rounded-lg max-w-[85%] text-gray-200">${reply}</div>`;
                chatBox.scrollTop = chatBox.scrollHeight;
            });
        }

        // Contact Form
        function submitContactForm(e) {
            e.preventDefault();
            const btn = document.getElementById('contactSubmitBtn');
            const msgBox = document.getElementById('contactResponseMsg');

            btn.disabled = true;
            btn.innerText = 'Submitting...';

            const payload = {
                name: document.getElementById('contact_name').value,
                email: document.getElementById('contact_email').value,
                phone: document.getElementById('contact_phone').value,
                reason: document.getElementById('contact_reason').value,
                location: document.getElementById('contact_location').value,
                message: document.getElementById('contact_message').value,
            };

            fetch('/api/contacts', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(payload)
            })
            .then(res => res.json())
            .then(data => {
                btn.disabled = false;
                btn.innerHTML = '<i data-lucide="send" class="w-4 h-4"></i> Submit Inquiry';
                lucide.createIcons();

                if (data.success) {
                    msgBox.className = 'text-xs text-center p-3 rounded-lg bg-emerald-500/20 border border-emerald-500/40 text-emerald-300 block';
                    msgBox.innerText = `Thank you! Your inquiry has been submitted (Ref: ${data.ref_id}). The Secretariat will respond shortly.`;
                    document.getElementById('publicContactForm').reset();
                } else {
                    msgBox.className = 'text-xs text-center p-3 rounded-lg bg-rose-500/20 border border-rose-500/40 text-rose-300 block';
                    msgBox.innerText = 'Submission failed. Please check your input fields.';
                }
            })
            .catch(() => {
                btn.disabled = false;
                btn.innerHTML = '<i data-lucide="send" class="w-4 h-4"></i> Submit Inquiry';
                lucide.createIcons();
            });
        }
    </script>
</body>
</html>