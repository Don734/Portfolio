<?php

namespace App\Http\Controllers\Admin;

use App\Exports\ParseExport;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

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

    public function parser()
    {
        $arr = [];
        $address_tags = [
            'Toshkent shahri'
        ];
        $ch = curl_init('https://orginfo.uz/organization/0731599e89ff/');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $html = curl_exec($ch);
        // if ($html === false) {
        //     echo "cURL Error: " . curl_error($ch);
        // } else {
        //     echo "Webpage content fetched successfully.";
        // }
        curl_close($ch);
        preg_match_all('/<span>\d{1,2}\.\d{1,2}\.\d{2,4}/', $html, $date_matches);
        // preg_match('/\d{9}/', $html, $num_matches);
        // preg_match('/Активный|Ликвидирована/', $html, $status);
        preg_match_all('/<span>\d{5}\s/', $html, $num_matches1);
        $html = str_replace(["&nbsp;", "\u{A0}"], "", $html);
        preg_match_all("/\d+,\d{2}/", $html, $amount);
        preg_match_all("/\W+<\/span>/", $html, $words);
        // preg_match_all("/[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}/", $html, $email);
        foreach ($num_matches1 as $value) {
            $val = str_replace(["<span>", " "], "", $value);
            $arr[] = $val;
        }
        $arr = array_combine([0, 1], $arr[0]);
        $arr[] = $amount[0][0];
        return Excel::download(new ParseExport($arr), 'file.xlsx', \Maatwebsite\Excel\Excel::XLSX);
    }
}
