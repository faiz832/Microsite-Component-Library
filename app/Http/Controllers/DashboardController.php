<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Version;
use App\Models\Category;
use App\Models\Component;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $components = Component::all();
        $categories = Category::all();
        $versions = Version::all();
        $users = User::all();

        return view('dashboard', compact('components', 'categories', 'versions', 'users'));
    }
}
