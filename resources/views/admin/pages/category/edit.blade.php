@extends('layouts.admin')

@section('breadcrumb')
    @include('admin.partials.breadcrumb', [
        'title' => 'Create Category',
        'list' => [
            [
                'name' => 'Create Category',
                'current' => true
            ]
        ]
    ])
@endsection

@section('content')
<form action="{{dashboard_route(config("admin.route_name_prefix").'categories.update')}}" method="post" enctype="multipart/form-data">
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
                            <p class="card-subtitle">Here you can change category information</p>
                        </div>
                        <div class="card-body">
                            <div>
                                <label for="slug" class="form-label">@lang('admin.slug')</label>
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="slug" name="slug" placeholder="slug" value="{{old('slug', $item->slug)}}">
                                    <label for="slug">@lang('admin.slug')</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card card-form">
                        <div class="card-header">
                            <h5 class="card-title">@lang('admin.detail')</h5>
                            <p class="card-subtitle">Here you can change category detail information</p>
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
                                                    name="{{$locale}}[title]" placeholder="@lang("admin.title")" value="{{ old("$locale.title",$item->{'title:'.$locale }) }}" >
                                                <label for="title_{{$locale}}">@lang("admin.title")</label>
                                            </div>
                                        </div>
                                        <div>
                                            <label for="description_{{$locale}}" class="form-label">@lang("admin.description")</label>
                                            <div class="form-floating">
                                                <textarea class="form-control editor"
                                                    id="description_{{$locale}}"
                                                    name="{{$locale}}[description]"
                                                    style="height: 150px">{{ old("$locale.description",$item->{'description:'.$locale }) }}</textarea>
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
                            <h5 class="card-title">@lang('admin.icon')</h5>
                        </div>
                        <div class="card-body">
                            <input type="file" id="icon" name="icon">
                            <div class="col">
                                <label for="icon" class="image-drop" id="dropArea">
                                    <div class="wrap">
                                        <span class="icon"><i class="bi bi-cloud-arrow-up"></i></span>
                                        <p>Drop your icon here or select <span>click to browse</span></p>
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
                            <h5 class="card-title">@lang('admin.category_params')</h5>
                            <p class="card-subtitle">Here you can change category parameters</p>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="color" class="form-label">@lang('admin.color')</label>
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="color" name="color" placeholder="color" value="{{old('order', $item->color)}}">
                                    <label for="color">@lang('admin.color')</label>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="order" class="form-label">@lang('admin.order')</label>
                                <div class="form-floating">
                                    <input type="number" class="form-control" id="order" name="order" placeholder="order" value="{{old('order', $item->order)}}">
                                    <label for="order">@lang('admin.order')</label>
                                </div>
                            </div>
                            <div class="row row-cols-3 mb-3">
                                <div class="col">
                                    <label for="is_visible" class="form-label">@lang('admin.is_visible')</label>
                                    <div class="custom-switch">
                                        <input type="checkbox" name="is_visible" id="is_visible" @checked(old('is_visible',$item->is_visible))>
                                        <label for="is_visible">
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