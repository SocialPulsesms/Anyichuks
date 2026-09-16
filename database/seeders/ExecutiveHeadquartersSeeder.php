<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Business;
use App\Models\ImpactProject;
use App\Models\LeadershipMilestone;
use App\Models\MediaItem;
use App\Models\PressAsset;
use App\Models\VerifiedClaim;
use App\Models\Award;

class ExecutiveHeadquartersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Seed Businesses
        $businesses = [
            [
                'name' => 'Orient Global Group',
                'logo_url' => 'https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg',
                'industry' => 'Diversified Conglomerate',
                'description' => 'A premier Sub-Saharan African conglomerate driving growth across manufacturing, logistics, supply chain, and agricultural processing.',
                'leadership_role' => 'Founder & Chairman',
                'key_activities' => [
                    'Orient Global Manufacturing (industrial production)',
                    'Orient Haulage & Logistics (nationwide freight and fleet management)',
                    'Purity Agro-Allied Ltd (agro-processing and food security)'
                ],
                'website_url' => 'https://orientglobalgroup.com',
                'related_images' => ['/images/business_conglomerate.png'],
                'related_news' => ['https://punchng.com/orient-global-expansion'],
                'order_index' => 1,
            ],
            [
                'name' => 'Ultimus Holdings',
                'logo_url' => 'https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg',
                'industry' => 'Real Estate, Construction & Healthcare',
                'description' => 'An innovative investment holding corporation focused on luxury real estate, commercial infrastructure, healthcare systems, and general commerce.',
                'leadership_role' => 'President & CEO',
                'key_activities' => [
                    'Ultimus Construction (civil engineering and infrastructure)',
                    'Ultimus Properties (residential and commercial real estate development)',
                    'Viarmor Healthcare Ltd (pharmaceuticals and medical supply chains)'
                ],
                'website_url' => 'https://ultimusholdings.com',
                'related_images' => ['/images/business_conglomerate.png'],
                'related_news' => ['https://vanguardngr.com/ultimus-holdings-healthcare'],
                'order_index' => 2,
            ],
        ];

        foreach ($businesses as $b) {
            Business::updateOrCreate(['name' => $b['name']], $b);
        }

        // 2. Seed Impact Projects
        $projects = [
            [
                'title' => '140+ Free Modern Housing Units for Widows & Families',
                'category' => 'Housing',
                'location' => 'Isu & Abakaliki',
                'state' => 'Ebonyi',
                'year' => 2022,
                'description' => 'Constructed and donated over 140 fully-furnished, modern bungalow housing units complete with water boreholes, solar lighting, and appliances for underprivileged widows and vulnerable families.',
                'beneficiaries' => '140+ Widows and Vulnerable Households',
                'photographs' => ['/images/philanthropy_housing.png'],
                'videos' => [],
                'related_news' => ['https://punchng.com/ebonyi-professionals-endorse-pdp-gov-candidate/'],
                'latitude' => 6.3249,
                'longitude' => 8.1137,
                'is_featured' => true,
                'order_index' => 1,
            ],
            [
                'title' => 'Fully Funded Higher Education Scholarships',
                'category' => 'Education',
                'location' => 'Ebonyi State & Nationwide Universities',
                'state' => 'Ebonyi',
                'year' => 2021,
                'description' => 'Awarded comprehensive multi-year university scholarships covering full tuition, accommodation, and stipends for talented students pursuing STEM, Medicine, and Law.',
                'beneficiaries' => '1,000+ University Students',
                'photographs' => ['/images/philanthropy_housing.png'],
                'videos' => [],
                'related_news' => [],
                'latitude' => 6.2649,
                'longitude' => 8.0137,
                'is_featured' => true,
                'order_index' => 2,
            ],
            [
                'title' => '10,000+ Free WAEC & NECO Secondary Education Kits',
                'category' => 'Education',
                'location' => 'Ebonyi Central & North Senatorial Districts',
                'state' => 'Ebonyi',
                'year' => 2023,
                'description' => 'Distributed examination registration subsidies, past question banks, textbooks, and mathematical sets to over 10,000 secondary school students to promote academic excellence.',
                'beneficiaries' => '10,000+ High School Students',
                'photographs' => [],
                'videos' => [],
                'related_news' => [],
                'latitude' => 6.3000,
                'longitude' => 8.1000,
                'is_featured' => true,
                'order_index' => 3,
            ],
            [
                'title' => 'Community Primary Healthcare & Medical Outreaches',
                'category' => 'Healthcare',
                'location' => 'Afikpo & Ohaozara',
                'state' => 'Ebonyi',
                'year' => 2022,
                'description' => 'Sponsored free medical checkups, eye surgeries, maternal care kits, and essential prescription medications for rural communities.',
                'beneficiaries' => '5,000+ Rural Community Residents',
                'photographs' => [],
                'videos' => [],
                'related_news' => [],
                'latitude' => 5.8931,
                'longitude' => 7.9374,
                'is_featured' => false,
                'order_index' => 4,
            ],
            [
                'title' => 'Micro-Grants & Empowerment for Female Entrepreneurs',
                'category' => 'Women Empowerment',
                'location' => 'Abakaliki Central Market',
                'state' => 'Ebonyi',
                'year' => 2021,
                'description' => 'Provided seed capital, interest-free micro-grants, and trade equipment to local market women and female-owned small businesses.',
                'beneficiaries' => '500+ Female Business Owners',
                'photographs' => [],
                'videos' => [],
                'related_news' => [],
                'latitude' => 6.3200,
                'longitude' => 8.1100,
                'is_featured' => false,
                'order_index' => 5,
            ],
        ];

        foreach ($projects as $p) {
            ImpactProject::updateOrCreate(['title' => $p['title']], $p);
        }

        // 3. Seed Leadership Milestones
        $milestones = [
            [
                'year' => '2004',
                'title' => 'Early Entrepreneurial Foundations',
                'stage' => 'Early Career',
                'description' => 'Initiated early business ventures in logistics, manufacturing, and commerce, laying the groundwork for strategic growth.',
                'photograph_url' => '/images/business_conglomerate.png',
                'related_organization' => 'Commercial Ventures',
                'order_index' => 1,
            ],
            [
                'year' => '2010',
                'title' => 'Establishment of Orient Global Group',
                'stage' => 'Business Development',
                'description' => 'Founded Orient Global Group, consolidating manufacturing, freight transport, and agricultural processing into a unified entity.',
                'photograph_url' => '/images/business_conglomerate.png',
                'related_organization' => 'Orient Global Group',
                'order_index' => 2,
            ],
            [
                'year' => '2014',
                'title' => 'Launch of Ebele & Anyichuks Foundation',
                'stage' => 'Philanthropic Development',
                'description' => 'Co-founded the Ebele & Anyichuks Foundation with his wife, establishing structured philanthropic programs in housing, education, and healthcare.',
                'photograph_url' => '/images/philanthropy_housing.png',
                'related_organization' => 'Ebele & Anyichuks Foundation',
                'order_index' => 3,
            ],
            [
                'year' => '2018',
                'title' => 'Diversification into Ultimus Holdings',
                'stage' => 'Business Expansion',
                'description' => 'Expanded corporate holdings into real estate development, civil engineering construction, and healthcare logistics through Ultimus Holdings.',
                'photograph_url' => '/images/business_conglomerate.png',
                'related_organization' => 'Ultimus Holdings',
                'order_index' => 4,
            ],
            [
                'year' => '2021',
                'title' => 'Major Housing & Educational Impact Milestone',
                'stage' => 'Community Impact',
                'description' => 'Crossed the landmark of 140+ free houses built and donated to widows, alongside over 1,000 university student scholarships.',
                'photograph_url' => '/images/philanthropy_housing.png',
                'related_organization' => 'Ebele & Anyichuks Foundation',
                'order_index' => 5,
            ],
            [
                'year' => '2023',
                'title' => 'PDP Gubernatorial Candidacy for Ebonyi State',
                'stage' => 'Public Leadership',
                'description' => 'Emerged as the Peoples Democratic Party (PDP) governorship candidate for Ebonyi State, presenting an economic reform blueprint centered on industrialization, job creation, and education.',
                'photograph_url' => '/images/politics_reform.png',
                'related_organization' => 'Public Service & Governance',
                'order_index' => 6,
            ],
        ];

        foreach ($milestones as $m) {
            LeadershipMilestone::updateOrCreate(['year' => $m['year'], 'title' => $m['title']], $m);
        }

        // 4. Seed Media Items
        $media = [
            [
                'title' => 'Keynote Address on Economic Reform & Industrialization in Ebonyi',
                'date' => '2023-03-15',
                'platform' => 'YouTube',
                'category' => 'Speeches',
                'thumbnail_url' => '/images/politics_reform.png',
                'description' => 'Dr. Ifeanyi Chukwuma Odii outlines his policy framework for manufacturing hubs, rural infrastructure, and youth employment.',
                'video_url' => 'https://www.youtube.com/embed/dQw4w9WgXcQ',
                'related_topic' => 'Economic Reform',
            ],
            [
                'title' => 'National Television Interview: Business Leadership & Philanthropy in Nigeria',
                'date' => '2023-08-20',
                'platform' => 'TV',
                'category' => 'Interviews',
                'thumbnail_url' => '/images/landing-profile.png',
                'description' => 'An in-depth conversation on building resilient conglomerates and driving sustainable social impact.',
                'video_url' => 'https://www.youtube.com/embed/dQw4w9WgXcQ',
                'related_topic' => 'Leadership',
            ],
            [
                'title' => 'Ebele & Anyichuks Foundation Annual Housing Handover Ceremony',
                'date' => '2022-12-18',
                'platform' => 'Event',
                'category' => 'Events',
                'thumbnail_url' => '/images/philanthropy_housing.png',
                'description' => 'Documentary highlights from the official commissioning and handover of 20 newly built widow housing units in Ebonyi State.',
                'video_url' => 'https://www.youtube.com/embed/dQw4w9WgXcQ',
                'related_topic' => 'Philanthropy',
            ],
        ];

        foreach ($media as $item) {
            MediaItem::updateOrCreate(['title' => $item['title']], $item);
        }

        // 5. Seed Press Assets
        $assets = [
            [
                'title' => 'Official Executive Biography (Comprehensive PDF)',
                'category' => 'Biography',
                'file_size' => '1.8 MB',
                'format' => 'PDF',
                'download_url' => '/images/landing-profile.png',
                'description' => 'Complete authoritative biography detailing business leadership, educational background, and public service record.',
                'is_public' => true,
            ],
            [
                'title' => 'High-Resolution Official Executive Portrait',
                'category' => 'Photography',
                'file_size' => '4.2 MB',
                'format' => 'JPG',
                'download_url' => '/images/landing-profile.png',
                'description' => 'High-resolution publication-ready executive portrait for media, press, and publications.',
                'is_public' => true,
            ],
            [
                'title' => 'Ebele & Anyichuks Foundation Impact Profile & Factsheet',
                'category' => 'Foundation Profile',
                'file_size' => '3.5 MB',
                'format' => 'PDF',
                'download_url' => '/images/philanthropy_housing.png',
                'description' => 'Verified factsheet detailing housing projects, scholarship statistics, and healthcare initiatives.',
                'is_public' => true,
            ],
            [
                'title' => 'Orient Global Group & Ultimus Holdings Corporate Overview',
                'category' => 'Business Profile',
                'file_size' => '2.9 MB',
                'format' => 'PDF',
                'download_url' => '/images/business_conglomerate.png',
                'description' => 'Corporate brochure detailing subsidiary operations, manufacturing capabilities, and investment portfolio.',
                'is_public' => true,
            ],
        ];

        foreach ($assets as $a) {
            PressAsset::updateOrCreate(['title' => $a['title']], $a);
        }

        // 6. Seed Verified Claims
        $claims = [
            [
                'claim' => 'Over 20 years of executive business leadership across Sub-Saharan Africa',
                'category' => 'Business Leadership',
                'source_name' => 'Corporate Affairs Commission & Corporate Registry',
                'source_url' => 'https://orientglobalgroup.com',
                'verification_date' => '2026-01-10',
                'verified_by' => 'Executive Office Review Board',
                'details' => 'Audited corporate registrations and operating licenses confirming continuous corporate leadership since 2004.',
            ],
            [
                'claim' => 'Constructed and donated 140+ fully furnished houses to widows and underprivileged families',
                'category' => 'Foundation Activities',
                'source_name' => 'Ebele & Anyichuks Foundation Asset Registry',
                'source_url' => null,
                'verification_date' => '2026-01-10',
                'verified_by' => 'Executive Office Review Board',
                'details' => 'Geographically mapped and commissioned housing units across Ebonyi State.',
            ],
            [
                'claim' => 'Provided 1,000+ fully-funded university scholarships to Nigerian students',
                'category' => 'Education',
                'source_name' => 'Foundation Academic Board Records',
                'source_url' => null,
                'verification_date' => '2026-01-10',
                'verified_by' => 'Executive Office Review Board',
                'details' => 'Verified university tuition disbursements and scholar graduation records.',
            ],
        ];

        foreach ($claims as $c) {
            VerifiedClaim::updateOrCreate(['claim' => $c['claim']], $c);
        }

        // 7. Seed Awards
        $awards = [
            [
                'award' => 'Philanthropist of the Year',
                'year' => 2022,
                'organization' => 'Nigerian National Merit & Excellence Awards',
                'category' => 'Social Impact',
                'description' => 'Awarded in recognition of exceptional humanitarian contributions through housing and higher education scholarships.',
                'photograph_url' => '/images/philanthropy_housing.png',
                'source_url' => null,
            ],
            [
                'award' => 'Industrialist & Visionary Leader Award',
                'year' => 2023,
                'organization' => 'African Business Leadership Forum',
                'category' => 'Business Excellence',
                'description' => 'Honored for building sustainable manufacturing and logistics enterprises that create thousands of jobs.',
                'photograph_url' => '/images/business_conglomerate.png',
                'source_url' => null,
            ],
            [
                'award' => 'Excellence in Community Empowerment',
                'year' => 2021,
                'organization' => 'South-East Leadership & Governance Summit',
                'category' => 'Public Service',
                'description' => 'Recognized for impactful grass-roots development initiatives across Ebonyi State.',
                'photograph_url' => '/images/politics_reform.png',
                'source_url' => null,
            ],
        ];

        foreach ($awards as $aw) {
            Award::updateOrCreate(['award' => $aw['award'], 'year' => $aw['year']], $aw);
        }
    }
}
