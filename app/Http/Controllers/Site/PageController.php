<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Project;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function home()
    {
        $categories = Category::select('id', 'slug')
            ->visible()
            ->withTranslation()
            ->orderBy('order')
            ->get();
        $projects = Project::active()
            ->withTranslation()
            ->latest()
            ->get();
        return view('site.pages.home.index', compact('categories', 'projects'));
    }

    public function getPortfolioByCategory(?string $category = null)
    {
        if ($category === 'all') {
            $projects = Project::withTranslation()->latest()->get();
        } else {
            $projects = Project::withTranslation()
                ->whereHas('categories', function ($q) use ($category) {
                    $q->where('slug', $category);
                })
                ->latest()
                ->get();
        }
        return view('site.partials.projects', compact('projects'));
    }
}
