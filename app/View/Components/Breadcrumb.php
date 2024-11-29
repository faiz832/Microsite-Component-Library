<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class Breadcrumb extends Component
{
    public array $segments;

    private array $urlMapping = [
        'docs' => 'Documentation',
        // 'install' => 'Installation',
        // 'config' => 'Configuration',
        // 'api' => 'API Reference',
        // 'faq' => 'FAQ',
        // 'getting-started' => 'Getting Started',
    ];

    public function __construct()
    {
        // Get the current URL path segments
        $path = request()->path();
        
        // Split the path into segments and get the last 2
        $allSegments = array_filter(explode('/', $path));
        $lastTwoSegments = array_slice($allSegments, -2);

        // Decode URL-encoded segments (like: delete %20)
        $decodedSegments = array_map('urldecode', $lastTwoSegments);

        // Map the segments to their friendly names
        $this->segments = array_map(function ($segment) {
            return $this->urlMapping[$segment] ?? ucfirst($segment);
        }, $decodedSegments);
    }

    public function render(): View
    {
        return view('components.breadcrumb');
    }
}