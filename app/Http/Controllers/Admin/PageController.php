<?php

namespace App\Http\Controllers\Admin;

use App\Exports\ParseExport;
use App\Http\Controllers\Controller;
use App\Imports\CompanyImport;
use App\Models\Setting;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;

class PageController extends Controller
{
    public function dashboard()
    {
        return view('admin.pages.dashboard');
    }

    public function settings()
    {
        $settings = Setting::all()->groupBy('group');
        return view('admin.pages.settings.list', compact('settings'));
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
