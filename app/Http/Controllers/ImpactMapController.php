<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ImpactMapController extends Controller
{
    /**
     * Get real database-backed impact statistics and map coordinates.
     */
    public function data(Request $request)
    {
        $projects = collect([]);

        if (class_exists(\App\Models\ImpactProject::class)) {
            try {
                $projects = \App\Models\ImpactProject::orderBy('year', 'desc')->get();
            } catch (\Exception $e) {
                $projects = collect([]);
            }
        }

        // 1. Projects by Category
        $byCategory = $projects->groupBy('category')->map(fn($group) => $group->count());

        // 2. Projects by Year
        $byYear = $projects->groupBy('year')->map(fn($group) => $group->count())->sortKeys();

        // 3. Projects by State (Geographic distribution)
        $byState = $projects->groupBy('state')->map(fn($group) => [
            'count' => $group->count(),
            'projects' => $group
        ]);

        return response()->json([
            'total_projects' => $projects->count(),
            'by_category' => $byCategory,
            'by_year' => $byYear,
            'by_state' => $byState,
            'projects' => $projects,
        ]);
    }
}
