<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Project;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function home(Request $request)
    {
        $categories = Category::select('id', 'slug')->visible()->withTranslation()->get();
        $projects = Project::withTranslation()->latest()->get();
        return view('site.pages.home.index', compact('categories', 'projects'));
    }
}
