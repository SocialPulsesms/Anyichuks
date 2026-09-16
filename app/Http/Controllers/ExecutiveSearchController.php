<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ExecutiveSearchController extends Controller
{
    /**
     * Perform global site-wide search.
     */
    public function search(Request $request)
    {
        $q = trim($request->input('q', ''));

        if (empty($q)) {
            return response()->json([
                'query' => '',
                'results' => [
                    'businesses' => [],
                    'projects' => [],
                    'milestones' => [],
                    'news' => [],
                    'media' => [],
                    'awards' => [],
                    'claims' => [],
                ]
            ]);
        }

        $businesses = collect([]);
        $projects = collect([]);
        $milestones = collect([]);
        $news = collect([]);
        $media = collect([]);
        $awards = collect([]);
        $claims = collect([]);

        try {
            if (class_exists(\App\Models\Mention::class)) {
                $news = \App\Models\Mention::where('entity_confirmed', true)
                    ->where(function ($query) use ($q) {
                        $query->where('title', 'like', "%{$q}%")
                            ->orWhere('description', 'like', "%{$q}%")
                            ->orWhere('content', 'like', "%{$q}%");
                    })
                    ->take(10)
                    ->get();
            }
        } catch (\Exception $e) {
            $news = collect([]);
        }

        return response()->json([
            'query' => $q,
            'total_matches' => $news->count(),
            'results' => [
                'businesses' => $businesses,
                'projects' => $projects,
                'milestones' => $milestones,
                'news' => $news,
                'media' => $media,
                'awards' => $awards,
                'claims' => $claims,
            ]
        ]);
    }
}
