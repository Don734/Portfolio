<?php

namespace App\Http\Controllers\Admin;

use App\Enums\ProjectStatus;
use App\Enums\ProjectType;
use App\Enums\ProjectVisibility;
use App\Facades\LocaleFacade;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Project\StoreRequest;
use App\Http\Requests\Admin\Project\UpdateRequest;
use App\Models\Category;
use App\Models\Project;
use App\Models\Technology;

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
            'types' => ProjectType::cases(),
            'visibilities' => ProjectVisibility::cases(),
            'categories' => Category::select()->get(),
            'techs' => Technology::select()->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $project = Project::create($this->getMassUpdateFields($request));

        if ($request->hasFile('cover')) {
            $project
                ->addMediaFromRequest('cover')
                ->toMediaCollection('cover');
        }

        if ($request->hasFile('gallery')) {
            foreach ($request->file('gallery') as $image) {
                $project
                    ->addMedia($image)
                    ->toMediaCollection('gallery');
            }
        }

        if ($request->hasFile('video')) {
            $project
                ->addMediaFromRequest('video')
                ->toMediaCollection('video');
        }

        if ($request->hasFile('attachments')) {
            foreach ($request->file('attachments') as $file) {
                $project
                    ->addMedia($file)
                    ->toMediaCollection('attachments');
            }
        }

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
            'types' => ProjectType::cases(),
            'visibilities' => ProjectVisibility::cases(),
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

        if ($request->hasFile('gallery')) {
            foreach ($request->file('gallery') as $image) {
                $project
                    ->addMedia($image)
                    ->toMediaCollection('gallery');
            }
        }

        if ($request->hasFile('video')) {
            $project
                ->addMediaFromRequest('video')
                ->toMediaCollection('video');
        }

        if ($request->hasFile('attachments')) {
            foreach ($request->file('attachments') as $file) {
                $project
                    ->addMedia($file)
                    ->toMediaCollection('attachments');
            }
        }

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
                    ['slug', 'status', 'type', 'started_at', 'finished_at', 'priority', 'visibility'],
                    LocaleFacade::all()
                )
            )
        );
    }
}
