<?php

namespace App\Http\Controllers;

use App\Models\MonitoringProvider;
use App\Models\MonitoringRun;
use App\Models\Mention;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class SystemHealthController extends Controller
{
    private function checkAuth()
    {
        if (session('admin_logged_in') !== true) {
            abort(403, 'Unauthorized access.');
        }
    }

    public function index()
    {
        if (session('admin_logged_in') !== true) {
            return redirect('/contacts-login');
        }

        // 1. Database Check
        $dbStatus = 'CONNECTED';
        try {
            DB::connection()->getPdo();
        } catch (\Exception $e) {
            $dbStatus = 'ERROR: ' . $e->getMessage();
        }

        // 2. Media Monitoring Providers Status
        $providers = MonitoringProvider::all();
        
        // 3. Storage Check
        $storageStatus = is_writable(storage_path('app')) ? 'CONNECTED' : 'ERROR: Storage directory not writable';

        // 4. AI Service Check
        $geminiKey = config('services.media.gemini_key') ?: config('services.gemini.key');
        $aiStatus = !empty($geminiKey) ? 'CONNECTED' : 'NOT CONFIGURED';

        // 5. News Providers Check
        $newsKey = config('services.media.news_key');
        $newsApiStatus = !empty($newsKey) ? 'CONNECTED' : 'NOT CONFIGURED';

        // 6. YouTube API Check
        $youtubeKey = config('services.media.youtube_key');
        $youtubeStatus = !empty($youtubeKey) ? 'CONNECTED' : 'NOT CONFIGURED';

        // 7. Recent Monitoring Runs
        $recentRuns = MonitoringRun::with('provider')->orderBy('run_at', 'desc')->take(10)->get();

        return view('system-health', compact(
            'dbStatus',
            'providers',
            'storageStatus',
            'aiStatus',
            'newsApiStatus',
            'youtubeStatus',
            'recentRuns'
        ));
    }
}
