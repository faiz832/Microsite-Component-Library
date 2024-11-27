<?php

namespace App\Http\Controllers;

use App\Models\Version;
use App\Models\Category;
use App\Models\Component;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::with(['version' => function($query) {
            $query->orderBy('version', 'desc');
        }])->get();
        
        $versions = Version::orderBy('version', 'desc')->get();

        return view('category.index', compact('categories', 'versions'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'version_id' => 'required',
            'category' => 'required',
        ]);

        $checking = Category::where('version_id', $data['version_id'])->where('category', $data['category'])->exists();

        if ($checking) {
            return back()->with('error', 'Category with same name and version already exists');
        }

        Category::create($data);

        return back()->with('success', 'Category created successfully');
    }

    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'version_id' => 'required',
            'category' => 'required',
        ]);

        $checking = Category::where('version_id', $data['version_id'])->where('category', $data['category'])->exists();

        if ($checking) {
            return back()->with('error', 'Category with same name and version already exists');
        }

        Category::find($id)->update($data);

        return back()->with('success', 'Category updated successfully');
    }

    public function destroy(string $id)
    {
        $category = Category::findOrFail($id);

        $componentExists = Component::where('category_id', $category->id)->exists();

        if ($componentExists) {
            return back()->with('error', 'Cannot delete category because it is associated with a component.');
        }

        $category->delete();

        return back()->with('success', 'Category deleted successfully');
    }
}
