<?php

namespace App\Http\Controllers;

use App\Models\Version;
use App\Models\Category;
use App\Models\Component;
use Illuminate\Http\Request;

class DocsController extends Controller
{
    public function show($version = null, $category = null, $component = null)
    {
        $latestVersion = Version::orderBy('version', 'desc')->first();
        $selectedVersion = $version ? Version::where('version', $version)->firstOrFail() : $latestVersion;

        $versions = Version::orderBy('version', 'desc')->get();

        $categories = Category::where('version_id', $selectedVersion->id)
            ->with('components')
            ->get();

        $selectedComponent = null;
        if ($component) {
            $selectedComponent = Component::where('component', $component)
                ->whereHas('category', function ($query) use ($selectedVersion, $category) {
                    $query->where('version_id', $selectedVersion->id)
                          ->where('category', $category);
                })
                ->firstOrFail();
        }

        return view('docs', compact('versions', 'selectedVersion', 'categories', 'selectedComponent'));
    }
}
