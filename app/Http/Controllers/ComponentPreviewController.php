<?php

namespace App\Http\Controllers;

use App\Models\Component;
use Illuminate\Http\Request;

class ComponentPreviewController extends Controller
{
    public function show(Component $component)
    {
        return view('component.preview', compact('component'));
    }
}
