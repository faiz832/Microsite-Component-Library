<?php

namespace App\Http\Controllers;

use App\Models\Version;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class VersionController extends Controller
{
    public function index()
    {
        $versions = Version::orderBy('version', 'desc')->get();
        return view('version.index', compact('versions'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'version' => ['required', 'string', 'min:2', 'max:4', Rule::unique('versions')->ignore($request->id)],
        ], [
            'version.unique' => 'A version with that name already exists.',
        ]);

        Version::create($data);

        return back()->with('success', 'Version created successfully.');
    }

    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'version' => ['required', 'string', 'min:2', 'max:4', Rule::unique('versions')->ignore($id)],
        ], [
            'version.unique' => 'A version with that name already exists.',
        ]);

        Version::find($id)->update($data);

        return back()->with('success', 'Version updated successfully.');
    }


    public function destroy(string $id)
    {
        $version = Version::findOrFail($id);

        $categoryExists = Category::where('version_id', $version->id)->exists();

        if ($categoryExists) {
            return back()->with('error', 'Cannot delete version because it is associated with a category.');
        }

        $version->delete();

        return back()->with('success', 'Version deleted successfully.');
    }
}