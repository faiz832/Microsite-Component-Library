<?php

namespace App\Http\Controllers;

use App\Models\Version;
use App\Models\Category;
use Appp\Models\Component;
use Illuminate\Http\Request;

class DocsController extends Controller
{
    public function index()
    {
        return view('docs');
    }
}
