<?php

namespace App\Http\Controllers;

use App\Models\Version;
use App\Models\Category;
use App\Models\Component;
use Illuminate\Http\Request;

class ComponentController extends Controller
{
    public function index()
    {
        $components = Component::with(['version', 'category'])
            ->join('versions', 'components.version_id', '=', 'versions.id')
            ->orderBy('versions.version', 'desc')
            ->select('components.*')
            ->get();
        
        $versions = Version::orderBy('version', 'desc')->get();
        $categories = collect(); // Empty collection

        return view('component.index', compact('components', 'versions', 'categories'));
    }

    public function create()
    {
        $versions = Version::orderBy('version', 'desc')->get();
        $categories = collect();
        return view('component.create', compact('versions', 'categories'));
    }


    public function edit($id)
    {
        $components = Component::findOrFail($id);
        $versions = Version::orderBy('version', 'desc')->get();
        $categories = Category::where('version_id', $components->version_id)->get();
        return view('component.edit', compact('components', 'versions', 'categories'));
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'version_id' => 'required|exists:versions,id',
            'category_id' => 'required|exists:categories,id',
            'component' => 'required|string|max:255'
        ]);

        // Cek apakah komponen sudah ada
        $existingComponent = Component::where([
            'version_id' => $request->version_id,
            'category_id' => $request->category_id,
            'component' => $request->component
        ])->exists();

        if ($existingComponent) {
            return back()->with('error', 'Component with same version, category, and name already exists.');
        }

        // Buat komponen baru
        Component::create([
            'version_id' => $request->version_id,
            'category_id' => $request->category_id,
            'component' => $request->component
        ]);

        return redirect()->route('component.index')->with('success', 'Component created successfully.');
    }

    public function update(Request $request, $id)
    {
        // Temukan komponen yang akan diupdate
        $component = Component::findOrFail($id);

        // Validasi input
        $request->validate([
            'version_id' => 'required|exists:versions,id',
            'category_id' => 'required|exists:categories,id',
            'component' => 'required|string|max:255'
        ]);

        // Cek apakah komponen sudah ada
        $existingComponent = Component::where([
            'version_id' => $request->version_id,
            'category_id' => $request->category_id,
            'component' => $request->component
        ])->where('id', '!=', $id)->exists();

        if ($existingComponent) {
            return back()->with('error', 'Component with same version, category, and name already exists.');
        }

        // Update komponen
        $component->update([
            'version_id' => $request->version_id,
            'category_id' => $request->category_id,
            'component' => $request->component
        ]);

        return redirect()->route('component.index')->with('success', 'Component updated successfully.');
    }

    public function destroy($id)
    {
        // Temukan dan hapus komponen
        $component = Component::findOrFail($id);
        $component->delete();

        return back()->with('success', 'Component deleted successfully.');
    }

    // Metode tambahan untuk mendapatkan categories berdasarkan version_id
    public function getCategories($versionId)
    {
        $categories = Category::where('version_id', $versionId)->get();
        return response()->json($categories);
    }
}
