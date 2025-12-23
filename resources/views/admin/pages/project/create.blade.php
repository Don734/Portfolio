@extends('layouts.admin')

@section('breadcrumb')
    @include('admin.partials.breadcrumb', [
        'title' => 'Create Project',
        'list' => [
            [
                'name' => 'Create Project',
                'current' => true
            ]
        ]
    ])
@endsection

@section('content')
<form action="{{dashboard_route(config("admin.route_name_prefix").'projects.store')}}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="col mt-3">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <nav>
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            <button class="nav-link active" id="nav-main-tab" data-bs-toggle="tab" data-bs-target="#nav-main" type="button" role="tab" aria-controls="nav-main" aria-selected="true">
                                Main
                            </button>
                            <button class="nav-link" id="nav-content-tab" data-bs-toggle="tab" data-bs-target="#nav-content" type="button" role="tab" aria-controls="nav-content" aria-selected="false">
                                Content
                            </button>
                            <button class="nav-link" id="nav-media-tab" data-bs-toggle="tab" data-bs-target="#nav-media" type="button" role="tab" aria-controls="nav-media" aria-selected="false">
                                Media
                            </button>
                            <button class="nav-link" id="nav-seo-tab" data-bs-toggle="tab" data-bs-target="#nav-seo" type="button" role="tab" aria-controls="nav-seo" aria-selected="false">
                                SEO
                            </button>
                        </div>
                    </nav>
                    <div class="btn-group gap-2" role="group">
                        <button type="button" class="btn btn-outline-danger">@lang('admin.cancel')</button>
                        <button type="submit" class="btn btn-form">@lang('admin.save')</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="tab-content mt-4" id="nav-tabContent">
        <div class="tab-pane fade show active" id="nav-main" role="tabpanel" aria-labelledby="nav-main-tab" tabindex="0">
            <div class="row g-4">
                <div class="col-12 col-lg-6">
                    <div class="card card-form"></div>
                </div>
                <div class="col-12 col-lg-6">
                    <div class="card card-form"></div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="nav-content" role="tabpanel" aria-labelledby="nav-content-tab" tabindex="0">
            Content
        </div>
        <div class="tab-pane fade" id="nav-media" role="tabpanel" aria-labelledby="nav-media-tab" tabindex="0">
            Media
        </div>
        <div class="tab-pane fade" id="nav-seo" role="tabpanel" aria-labelledby="nav-seo-tab" tabindex="0">
            SEO
        </div>
    </div>
</form>
@endsection