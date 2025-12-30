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
                <div class="d-flex justify-content-end">
                    <div class="btn-group gap-2" role="group">
                        <button type="button" class="btn btn-outline-danger">@lang('admin.cancel')</button>
                        <button type="submit" class="btn btn-form">@lang('admin.submit')</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-lg-6">
            <div class="row row-cols-1 mt-0 g-4">
                <div class="col">
                    <div class="card card-form">
                        <div class="card-header">
                            <h5 class="card-title">@lang('admin.info')</h5>
                            <p class="card-subtitle">Here you can change project information</p>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="slug" class="form-label">@lang('admin.slug')</label>
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="slug" name="slug" placeholder="slug" value="{{old('slug')}}">
                                    <label for="slug">@lang('admin.slug')</label>
                                </div>
                            </div>
                            <div class="row row-cols-1 row-cols-md-2 g-3">
                                <div class="col">
                                    <label for="status" class="form-label">@lang('admin.status')</label>
                                    <div class="form-floating">
                                        <select class="form-select custom-select" id="status" name="status">
                                            <option selected disabled>@lang('admin.status')</option>
                                            @foreach ($statuses as $status)
                                                <option value="{{$status->value}}" @selected(old('status') == $status->value)>
                                                    {{$status->label()}}
                                                </option>
                                            @endforeach
                                        </select>
                                        <label for="status">@lang('admin.status')</label>
                                    </div>
                                </div>
                                <div class="col">
                                    <label for="type" class="form-label">@lang('admin.type')</label>
                                    <div class="form-floating">
                                        <select class="form-select custom-select" id="type" name="type">
                                            <option selected disabled>@lang('admin.type')</option>
                                            @foreach ($types as $type)
                                                <option value="{{$type->value}}" @selected(old('type') == $type->value)>
                                                    {{$type->label()}}
                                                </option>
                                            @endforeach
                                        </select>
                                        <label for="type">@lang('admin.type')</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card card-form">
                        <div class="card-header">
                            <h5 class="card-title">@lang('admin.detail')</h5>
                            <p class="card-subtitle">Here you can change project detail information</p>
                        </div>
                        <div class="card-body">
                            <ul class="nav nav-tabs" id="nav-tab" role="tablist">
                                @foreach ($locales as $locale)
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link @if ($selected_locale === $locale) active @endif" 
                                            id="nav-{{$locale}}-tab" 
                                            data-bs-toggle="tab" 
                                            data-bs-target="#nav-{{$locale}}" 
                                            type="button" role="tab" 
                                            aria-controls="nav-{{$locale}}" 
                                            aria-selected="true">
                                            @lang("admin.locale.$locale")
                                        </button>
                                    </li>
                                @endforeach
                            </ul>
                            <div class="tab-content" id="nav-TabContent">
                                @foreach ($locales as $locale)
                                    <div class="tab-pane fade @if($selected_locale === $locale) show active @endif" id="nav-{{$locale}}" role="tabpanel" aria-labelledby="nav-{{$locale}}-tab" tabindex="0">
                                        <div class="my-3">
                                            <label for="title_{{$locale}}" class="form-label">@lang("admin.title") <span class="important">*</span></label>
                                            <div class="form-floating">
                                                <input type="text" class="form-control" id="title_{{$locale}}" 
                                                    name="{{$locale}}[title]" placeholder="@lang("admin.title")" value="{{ old("$locale.title") }}" >
                                                <label for="title_{{$locale}}">@lang("admin.title")</label>
                                            </div>
                                        </div>
                                        <div>
                                            <label for="description_{{$locale}}" class="form-label">@lang("admin.description")</label>
                                            <div class="form-floating">
                                                <textarea class="form-control editor"
                                                    id="description_{{$locale}}"
                                                    name="{{$locale}}[description]"
                                                    style="height: 150px">{{ old("$locale.description") }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-6">
            <div class="row row-cols-1 mt-0 g-4">
                <div class="col">
                    <div class="card card-form">
                        <div class="card-header">
                            <h5 class="card-title">@lang('admin.media')</h5>
                        </div>
                        <div class="card-body">
                            <input type="file" id="media" name="media[]" multiple>
                            <div class="col">
                                <label for="media" class="image-drop" id="dropArea">
                                    <div class="wrap">
                                        <span class="icon"><i class="bi bi-cloud-arrow-up"></i></span>
                                        <p>Drop your images here or select <span>click to browse</span></p>
                                    </div>
                                </label>
                            </div>
                            <div id="fileList"></div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card card-form">
                        <div class="card-header">
                            <h5 class="card-title">@lang('admin.project_params')</h5>
                            <p class="card-subtitle">Here you can change project parameters</p>
                        </div>
                        <div class="card-body">
                            <div class="row row-cols-1 row-cols-md-2 g-3 mb-3">
                                <div class="col">
                                    <label for="started_at" class="form-label">@lang('admin.started_at')</label>
                                    <div class="form-floating">
                                        <input type="datetime-local" class="form-control" id="started_at" name="started_at" placeholder="started_at" value="{{old('started_at')}}">
                                        <label for="started_at">@lang('admin.started_at')</label>
                                    </div>
                                </div>
                                <div class="col">
                                    <label for="finished_at" class="form-label">@lang('admin.finished_at')</label>
                                    <div class="form-floating">
                                        <input type="datetime-local" class="form-control" id="finished_at" name="finished_at" placeholder="finished_at" value="{{old('finished_at')}}">
                                        <label for="finished_at">@lang('admin.finished_at')</label>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="priority" class="form-label">@lang('admin.priority')</label>
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="priority" name="priority" placeholder="priority" value="{{old('priority')}}">
                                    <label for="priority">@lang('admin.priority')</label>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="visibility" class="form-label">@lang('admin.visibility')</label>
                                <div class="form-floating">
                                    <select class="form-select custom-select" id="visibility" name="visibility">
                                        @foreach ($visibilities as $visibility)
                                            <option value="{{$visibility->value}}">{{$visibility->label()}}</option>
                                        @endforeach
                                    </select>
                                    <label for="visibility">@lang('admin.visibility')</label>
                                </div>
                            </div>
                            {{-- <div class="mb-3">
                                <label for="tech" class="form-label">@lang('admin.techs')</label>
                                <div class="form-floating">
                                    <select class="form-select custom-select" id="tech" name="techs[]" multiple>
                                        @foreach ($techs as $tech)
                                            <option value="{{$tech->id}}">{{$tech->title}}</option>
                                        @endforeach
                                    </select>
                                    <label for="tech">@lang('admin.techs')</label>
                                </div>
                            </div> --}}
                            {{-- <div class="mb-3">
                                <label for="categories" class="form-label">@lang('admin.categories')</label>
                                <div class="form-floating">
                                    <select class="form-select custom-select" id="categories" name="categories[]" multiple>
                                        @foreach ($categories as $category)
                                            <option value="{{$category->id}}">{{$category->title}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection