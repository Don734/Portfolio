<?php

namespace App\Http\Controllers\Admin;

use App\Enums\ProjectStatus;
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
        return view('admin.pages.project.create', [
            'selected_locale' => config('app.locale'),
            'locales' => LocaleFacade::all(),
            'statuses' => ProjectStatus::cases(),
            'types' => ProjectStatus::cases(),
            'visibilities' => ProjectStatus::cases(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        Project::create($this->getMassUpdateFields($request));
        $this->alert("success", "Project has been added");
        return redirect(dashboard_route('admin.projects.index'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        return view('admin.pages.project.edit', [
            'item' => $project,
            'selected_locale' => config('app.locale'),
            'locales' => LocaleFacade::all(),
            'statuses' => ProjectStatus::cases(),
            'types' => ProjectStatus::cases(),
            'visibils' => ProjectStatus::cases(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, Project $project)
    {
        if (!$project) {
            $this->alert("warning", "Project not found");
        }
        $project->update($this->getMassUpdateFields($request));
        $this->alert("success", "Project has been updated");
        return redirect(dashboard_route('admin.projects.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        if (!$project) {
            $this->alert("warning", "Project not found");
        }
        $project->deleteTranslations();
        $project->images()->delete();
        $project->delete();
        $this->alert("success", "Project has been deleted");
        return redirect(dashboard_route('admin.projects.index'));
    }

    private function getMassUpdateFields($request)
    {
        return array_merge(
            $request->only(
                array_merge(
                    ['slug', 'is_active'],
                    LocaleFacade::all()
                )
            ),
            [
                'is_active' => $request->filled('is_active') == 'on',
            ]
        );
    }
}
