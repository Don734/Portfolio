<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $user = Auth::user();
        return view('admin.pages.profile', [
            'name' => $user->name,
            'email' => $user->email,
            'phone' => $user->phone,
            'about' => $user->about,
            'role' => $user->getRoleNames()->first()
        ]);
    }
}
