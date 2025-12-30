<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Facades\LocaleFacade;
use App\Http\Requests\Admin\Category\StoreRequest;
use App\Http\Requests\Admin\Category\UpdateRequest;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::paginate(10);
        return view('admin.pages.category.list', [
            'items' => $categories
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.category.create', [
            'selected_locale' => config('app.locale'),
            'locales' => LocaleFacade::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $category = Category::create($this->getMassUpdateFields($request));

        if ($request->hasFile('icon')) {
            $category
                ->addMediaFromRequest('icon')
                ->toMediaCollection('icon');
        }

        $this->alert("success", "Category has been added");
        return redirect(dashboard_route('admin.categories.index'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('admin.pages.project.edit', [
            'item' => $category,
            'selected_locale' => config('app.locale'),
            'locales' => LocaleFacade::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, Category $category)
    {
        if (!$category) {
            $this->alert("warning", "Category not found");
        }
        $category->update($this->getMassUpdateFields($request));

        if ($request->hasFile('icon')) {
            $category
                ->addMediaFromRequest('icon')
                ->toMediaCollection('icon');
        }

        $this->alert("success", "Category has been updated");
        return redirect(dashboard_route('admin.categories.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        if (!$category) {
            $this->alert("warning", "Category not found");
        }
        $category->deleteTranslations();
        $category->delete();
        $this->alert("success", "Category has been deleted");
        return redirect(dashboard_route('admin.categories.index'));
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
