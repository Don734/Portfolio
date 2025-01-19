<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\BannerRequest;
use App\Models\Banner;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $banners = Banner::orderBy('order', 'asc')->paginate(10);
        return view('admin.pages.banner.list', [
            'items' => $banners
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $type = Banner::TYPE_BANNER;
        return view('admin.pages.banner.create', [
            'types' => Banner::TYPES,
            'type' => $type,
            'order_num' => Banner::whereType($type)->max('order')
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BannerRequest $request)
    {
        dd($request->all());
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Banner $banner)
    {
        return view('admin.pages.banner.edit', [
            'item' => $banner,
            'type' => $banner->type,
            'types' => Banner::TYPES,
            'order_num' => Banner::whereType($banner->type)->max('order')
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BannerRequest $request, Banner $banner)
    {
        dd($request->all());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Banner $banner)
    {
        if ($banner) {
            $banner->deleteTranslations();
            $banner->images()->delete();
            $banner->delete();
            session()->flash("success", "Banner has been deleted");
        } else {
            session()->flash("warning", "Banner not found");
        }
        return redirect(dashboard_route('dashboard.banners.index'));
    }
}
