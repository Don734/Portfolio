<?php

namespace App\Http\Controllers\Admin;

use App\Exports\ParseExport;
use App\Http\Controllers\Controller;
use App\Imports\CompanyImport;
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

    public function getCompanies()
    {
        $links = [];
        $companies = Excel::toArray(new CompanyImport, storage_path('app/public/table1.xlsx'));
        foreach ($companies[0] as $company) {
            $tin = (int) $company['stir'];
            $ch = curl_init("https://orginfo.uz/search/all/?q={$tin}");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $html = curl_exec($ch);
            curl_close($ch);
            preg_match('/\/organization\/[A-Za-z0-9]+\//', $html, $url);
            $links[] = $url[0] ?? $tin;
        }
        dd($links);
    }

    public function parser()
    {
        $arr = [];
        $ch = curl_init("https://orginfo.uz/organization/5124fd10f591/");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $html = curl_exec($ch);
        curl_close($ch);
        $html = str_replace(["&nbsp;", "\u{A0}"], "", $html);
        $html = str_replace("&#x27;", "'", $html);
        $html = str_replace("&quot;", "\"", $html);
        preg_match('/<span>\d{1,2}\.\d{1,2}\.\d{2,4}/', $html, $date);
        preg_match('/ИНН-\d{9}/', $html, $tin);
        preg_match('/Активный|Ликвидирована/', $html, $status);
        preg_match_all('/\d{3,5}\s-\s\D+\W+</', $html, $num_matches1);
        preg_match('/Об организации\s-\s\D+/', $html, $title);
        preg_match("/\d+,\d{2}\s+(USD|UZS)\s+<\/span>/", $html, $amount);
        preg_match("/q=\d+/", $html, $phone);
        dd($html);
        $arr[] = str_replace(["Об организации - ", ", ИНН-"], "", $title[0]);
        $arr[] = str_replace("<span>", "", $date[0]);
        $arr[] = str_replace("ИНН-", "", $tin[0]);
        $arr[] = $status[0];
        foreach ($num_matches1[0] as $value) {
            $val = str_replace(["<span>", "<", "\n"], "", $value);
            $val = preg_replace("/-\s+/", "", $val);
            $arr[] = $val;
        }
        $amount = str_replace([" ", "</span>", "\n"], "", trim($amount[0]));
        $amount = str_replace(["USD", "UZS"], [" USD", " UZS"], $amount);
        $arr[] = $amount;
        $arr[] = str_replace("q=", "", $phone[0]);
        return Excel::download(new ParseExport($arr), 'file.xlsx', \Maatwebsite\Excel\Excel::XLSX);
    }
}
