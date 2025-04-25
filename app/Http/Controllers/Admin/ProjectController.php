<?php

namespace App\Http\Controllers\Admin;

use App\Facades\LocaleFacade;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Project\StoreRequest;
use App\Http\Requests\Admin\Project\UpdateRequest;
use App\Models\Project;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::paginate(10);
        return view('admin.pages.project.list', [
            'items' => $projects
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.banner.create', [
            'selected_locale' => config('app.locale'),
            'locales' => LocaleFacade::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        dd($request->all());
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        return view('admin.pages.banner.create', [
            'item' => $project,
            'selected_locale' => config('app.locale'),
            'locales' => LocaleFacade::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, Project $project)
    {
        dd($request->all());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        if ($project) {
            $project->deleteTranslations();
            $project->images()->delete();
            $project->delete();
            $this->alert("success", "Project has been deleted");
        } else {
            $this->alert("warning", "Project not found");
        }
        return redirect(dashboard_route('dashboard.projects.index'));
    }
}
