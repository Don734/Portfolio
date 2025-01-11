<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function dashboard()
    {
        return view('admin.pages.dashboard');
    }

    public function settings()
    {
        return view('admin.pages.settings');
    }

    public function profile()
    {
        return view('admin.pages.profile');
    }
}
