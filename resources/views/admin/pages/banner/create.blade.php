@extends('layouts.admin')

@section('breadcrumb')
    @include('admin.partials.breadcrumb', [
        'title' => 'Create Banner',
        'list' => [
            [
                'name' => 'Create Banner',
                'current' => true
            ]
        ]
    ])
@endsection

@section('content')
<form action="{{dashboard_route('dashboard.banners.store')}}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="col">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-end">
                    <div class="btn-group gap-2" role="group">
                        <button type="submit" class="btn btn-form">@lang("admin.save")</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row row-cols-1 row-cols-md-2">
        <div class="col">
            <div class="row row-cols-1 mt-0 g-4">
                <div class="col">
                    <div class="card card-form">
                        <div class="card-header">
                            <h5 class="card-title">@lang("admin.info")</h5>
                            <p class="card-subtitle">Here you can change your project information</p>
                        </div>
                        <div class="card-body">
                            <div>
                                <label for="url" class="form-label">@lang("admin.url")</label>
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="url" name="url" placeholder="@lang("admin.url")"  value="{{old('url')}}">
                                    <label for="url">@lang("admin.url")</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card card-form">
                        <div class="card-header">
                            <h5 class="card-title">@lang("admin.details")</h5>
                            <p class="card-subtitle">Here you can change your project details</p>
                        </div>
                        <div class="card-body">
                            <nav>
                                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                    @foreach ($locales as $locale)
                                    <button class="nav-link @if($selected_locale === $locale) active @endif" id="nav-{{$locale}}-tab" data-bs-toggle="tab" 
                                        data-bs-target="#nav-{{$locale}}" type="button" role="tab" aria-controls="nav-{{$locale}}" 
                                        aria-selected="true">@lang("admin.$locale")</button>
                                    @endforeach
                                </div>
                            </nav>
                            <div class="tab-content" id="nav-tabContent">
                                @foreach ($locales as $locale)
                                <div class="tab-pane fade @if($selected_locale === $locale) show active @endif " id="nav-{{$locale}}" role="tabpanel" aria-labelledby="nav-{{$locale}}-tab" tabindex="0">
                                    <div class="my-3">
                                        <label for="title_{{$locale}}" class="form-label">@lang("admin.title") <span class="important">*</span></label>
                                        <div class="form-floating">
                                            <input type="text" class="form-control" id="title_{{$locale}}" 
                                                name="{{$locale}}[title]" placeholder="@lang("admin.title")" value="{{ old("$locale.title") }}" >
                                            <label for="title_{{$locale}}">@lang("admin.title")</label>
                                        </div>
                                    </div>
                                    <div>
                                        <label for="content_{{$locale}}" class="form-label">@lang("admin.content")</label>
                                        <div class="form-floating">
                                            <textarea class="form-control" placeholder="Leave a description here" id="content_{{$locale}}" name="{{$locale}}[content]" style="height: 150px">
                                                {{ old("$locale.content") }}
                                            </textarea>
                                            <label for="content_{{$locale}}">@lang("admin.content")</label>
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
        <div class="col">
            <div class="row row-cols-1 mt-0 g-4">
                <div class="col">
                    <div class="card card-form">
                        <div class="card-header">
                            <h5 class="card-title">@lang("admin.image")</h5>
                        </div>
                        <div class="card-body">
                            <input type="file" id="image" name="image">
                            <div class="col">
                                <label for="image" class="image-drop">
                                    <div class="wrap">
                                        <span class="icon"><i class="bi bi-cloud-arrow-up"></i></span>
                                        <p>Drop your image here or select <span>click to browse</span></p>
                                        <small>1600 x 1200 (4:3) recommended. PNG, JPG and GIF files are allowed</small>
                                    </div>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card card-form">
                        <div class="card-header">
                            <h5 class="card-title">@lang("admin.extra")</h5>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="type" class="form-label">@lang("admin.type")</label>
                                <select class="form-select custom-select" id="type" name="type" aria-label="Floating label select example">
                                    <option selected disabled>@lang('admin.select_product')</option>
                                    @foreach ($types as $t)
                                        <option value="{{$t}}">@lang("admin.$t")</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="order" class="form-label">@lang("admin.order")</label>
                                <div class="form-floating">
                                    <input type="number" class="form-control" id="order" name="order" placeholder="@lang("admin.order")" value="{{old('order',$order_num+1)}}">
                                    <label for="order">@lang("admin.order")</label>
                                </div>
                            </div>
                            <div class="row row-cols-3">
                                <div class="col">
                                    <label for="is_active" class="form-label">@lang('admin.active')</label>
                                    <div class="custom-switch">
                                        <input type="checkbox" name="is_active" id="is_active">
                                        <label for="is_active">
                                            <div class="custom-switch-ball"><i class="bi bi-check2"></i></div>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection

@section('css')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
@endsection

@section('js')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
@endsection