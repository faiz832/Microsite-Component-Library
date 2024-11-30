<?php

namespace App\Http\Controllers;

use App\Models\Component;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('query');

        $results = Component::where('component', 'like', "%{$query}%")
            ->with(['category.version'])
            ->get()
            ->groupBy(function ($component) {
                return $component->category->version->version;
            })
            ->map(function ($versionGroup) {
                return $versionGroup->groupBy(function ($component) {
                    return $component->category->category;
                });
            });

        return response()->json($results);
    }
}
