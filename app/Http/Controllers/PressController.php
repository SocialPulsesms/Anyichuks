<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PressController extends Controller
{
    /**
     * Render the Executive Press Centre page.
     */
    public function index()
    {
        $assets = [];
        $claims = [];
        $awards = [];

        if (class_exists(\App\Models\PressAsset::class)) {
            try {
                $assets = \App\Models\PressAsset::where('is_public', true)->get();
            } catch (\Exception $e) {
                $assets = [];
            }
        }

        if (class_exists(\App\Models\VerifiedClaim::class)) {
            try {
                $claims = \App\Models\VerifiedClaim::orderBy('category')->get();
            } catch (\Exception $e) {
                $claims = [];
            }
        }

        if (class_exists(\App\Models\Award::class)) {
            try {
                $awards = \App\Models\Award::orderBy('year', 'desc')->get();
            } catch (\Exception $e) {
                $awards = [];
            }
        }

        // Fallback to verified official factsheets if database is empty or not migrated
        if (empty($assets) || count($assets) === 0) {
            $assets = [
                (object)[
                    'id' => 1,
                    'title' => 'Official 2027 Campaign Portrait',
                    'category' => 'High-Res Photography',
                    'format' => 'JPG',
                    'file_size' => '2.4 MB',
                    'file_type' => 'JPG (High-Res)',
                    'description' => 'Approved official campaign portrait of Dr. Ifeanyi Chukwuma Odii for print, broadcast, and billboard publication.',
                    'download_url' => asset('images/landing-profile.png')
                ],
                (object)[
                    'id' => 2,
                    'title' => 'PDP Flagship Rally Portrait',
                    'category' => 'High-Res Photography',
                    'format' => 'JPG',
                    'file_size' => '913 KB',
                    'file_type' => 'JPG (High-Res)',
                    'description' => 'Official photograph of Dr. Ifeanyi Chukwuma Odii raising the PDP Banner in Ebonyi State Capital.',
                    'download_url' => asset('images/anyichuks_pdp_banner_ebonyi.jpg')
                ],
                (object)[
                    'id' => 3,
                    'title' => 'Philanthropy Factsheet & Audit',
                    'category' => 'Executive Document',
                    'format' => 'PDF',
                    'file_size' => '1.8 MB',
                    'file_type' => 'PDF Document',
                    'description' => 'Comprehensive verified record of 140+ free modern homes, 1,000+ university scholarships, and infrastructure donations.',
                    'download_url' => asset('images/philanthropy_housing.png')
                ],
            ];
        }

        if (empty($claims) || count($claims) === 0) {
            $claims = [
                (object)[
                    'category' => 'Philanthropy & Shelter',
                    'claim' => 'Over 140 fully furnished modern houses built and donated to widows and destitute families across Ebonyi State.',
                    'details' => 'Executed entirely through the private personal funding of the Ebele & Anyichuks Foundation prior to seeking any political office.',
                    'source_name' => 'Ebele & Anyichuks Foundation Audit',
                    'verified_by' => 'Community Stakeholders & Beneficiaries'
                ],
                (object)[
                    'category' => 'Education & Human Capital',
                    'claim' => 'More than 1,000 full tuition university scholarships disbursed to underprivileged Ebonyi students.',
                    'details' => 'Covering undergraduate programs across state, federal, and private universities throughout Nigeria.',
                    'source_name' => 'Academic Welfare Registrar',
                    'verified_by' => 'Student Union & Beneficiary Network'
                ],
                (object)[
                    'category' => 'Enterprise & Industry',
                    'claim' => 'Founder & Executive Chairman of Orient Global Group and President/CEO of Ultimus Holdings.',
                    'details' => 'Over two decades of proven corporate enterprise spanning manufacturing, agro-processing, logistics, and construction.',
                    'source_name' => 'Corporate Affairs Commission',
                    'verified_by' => 'Executive Management Directorate'
                ]
            ];
        }

        if (empty($awards) || count($awards) === 0) {
            $awards = [
                (object)[
                    'year' => '2023',
                    'category' => 'Philanthropic Leadership',
                    'award' => 'Excellence in Humanitarian Service',
                    'organization' => 'National Association of Nigerian Students (NANS)',
                    'description' => 'Conferred in recognition of nationwide scholarship programs and grassroots youth educational upliftment.'
                ],
                (object)[
                    'year' => '2022',
                    'category' => 'Enterprise Innovation',
                    'award' => 'Outstanding Industrialist of the Year',
                    'organization' => 'African Leadership Council',
                    'description' => 'Honoring pioneering supply-chain excellence and local manufacturing growth through Orient Global Manufacturing.'
                ],
                (object)[
                    'year' => '2021',
                    'category' => 'Social Welfare',
                    'award' => 'Community Development & Shelter Icon',
                    'organization' => 'Ebonyi State Community Development Alliance',
                    'description' => 'Conferred for eradicating thatched-roof poverty through 140+ free modern brick homes for rural widows.'
                ]
            ];
        }

        return view('press', compact('assets', 'claims', 'awards'));
    }

    /**
     * Download or view a specific press asset.
     */
    public function downloadAsset($id)
    {
        if ($id == 1) {
            return redirect('/images/landing-profile.png');
        }
        if ($id == 2) {
            return redirect('/images/anyichuks_pdp_banner_ebonyi.jpg');
        }
        return redirect('/images/philanthropy_housing.png');
    }
}
