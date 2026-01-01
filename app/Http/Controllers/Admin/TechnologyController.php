<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Facades\LocaleFacade;
use App\Http\Requests\Admin\Technology\StoreRequest;
use App\Http\Requests\Admin\Technology\UpdateRequest;
use App\Models\Technology;

class TechnologyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $techs = Technology::paginate(10);
        return view('admin.pages.technology.list', [
            'items' => $techs
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.technology.create', [
            'selected_locale' => config('app.locale'),
            'locales' => LocaleFacade::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $technology = Technology::create($this->getMassUpdateFields($request));

        if ($request->hasFile('icon')) {
            $technology
                ->addMediaFromRequest('icon')
                ->toMediaCollection('icon');
        }
        
        $this->alert("success", "Technology has been added");
        return redirect(dashboard_route('admin.technologies.index'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Technology $technology)
    {
        return view('admin.pages.technology.edit', [
            'item' => $technology,
            'selected_locale' => config('app.locale'),
            'locales' => LocaleFacade::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, Technology $technology)
    {
        if (!$technology) {
            $this->alert("warning", "Technology not found");
        }
        $technology->update($this->getMassUpdateFields($request));

        if ($request->hasFile('icon')) {
            $technology
                ->addMediaFromRequest('icon')
                ->toMediaCollection('icon');
        }

        $this->alert("success", "Technology has been updated");
        return redirect(dashboard_route('admin.technologies.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Technology $technology)
    {
        if (!$technology) {
            $this->alert("warning", "Technology not found");
        }
        $technology->deleteTranslations();
        $technology->delete();
        $this->alert("success", "Technology has been deleted");
        return redirect(dashboard_route('admin.technologies.index'));
    }

    private function getMassUpdateFields($request)
    {
        return array_merge(
            $request->only(
                array_merge(
                    ['slug', 'color', 'order', 'is_visible'],
                    LocaleFacade::all()
                )
            ),
            [
                'is_visible' => $request->filled('is_visible') == 'on',
            ]
        );
    }
}
