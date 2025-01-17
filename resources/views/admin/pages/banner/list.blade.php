@extends('layouts.admin')

@section('breadcrumb')
    @include('admin.partials.breadcrumb', [
        'title' => 'Banners',
        'list' => [
            [
                'name' => 'Banners',
                'current' => true
            ]
        ]
    ])
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="table-wrap">
            <div class="table-header">
                @include('admin.partials.table.header', [
                  'per_page' => true,
                  'search' => true,
                  'create' => [
                    'link' => dashboard_route('dashboard.banners.create'),
                    'target' => "_self",
                    'collapse' => false
                  ]
                ])
            </div>
            <div class="table-responsive">
                <table class="table table-borderless data-table">
                    @include('admin.partials.table.head',[
                        'fields'=>[
                            'id'=>['sortable'=>false,"name"=>"#ID"],
                            'type'=>['sortable'=>false,"name"=>"Type"],
                            'title'=>['sortable'=>false,"name"=>"Title"],
                            'url'=>['sortable'=>false,"name"=>"URL"],
                            'is_active'=>['sortable'=>false,"name"=>"Is Active"],
                            'actions'=>['sortable'=>false,"name"=>"",'class'=>'no-sort'],
                        ]
                    ])
                    <tbody>
                        @foreach ($items as $item)
                        <tr>
                            <td>#{{ $item->id }}</td>
                            <td><span class="badge text-bg-secondary">@lang("dashboard.banner_type_".$item->type)</span></td>
                            <td>
                              <div class="d-flex align-items-center">
                                <div class="flex-shrink-0">
                                  <div class="img-block">
                                    @if($img = $item->landscape())
                                      <img src="{{$img->thumb_url}}" 
                                        width="{{$img->thumb_width}}" 
                                        height="{{$img->thumb_height}}"
                                        alt="{{$item->title}}">
                                    @endif
                                  </div>
                                </div>
                                <div class="flex-grow-1">{{ Str::limit($item->title, 32, '...') }}</div>
                              </div>
                            </td>
                            <td><a href="{{ $item->url }}" target="_blank">@lang('admin.visit')</a></td>
                            <td>
                                <span class="badge text-bg-{{$item->is_active ? "success" : "danger"}}">
                                    {{$item->is_active ? __('admin.active'): __('admin.not_active')}}
                                </span>
                            </td>
                            <td>
                                @include('admin.partials.table.actions', [
                                  'item' => $item,
                                  'edit_route' => dashboard_route('dashboard.banners.edit', ['banner'=>$item->id]),
                                  'destroy_route' => dashboard_route('dashboard.banners.destroy', ['banner'=>$item->id]),
                                ])
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @if (count($items))
                <div class="table-footer">
                    @include('admin.partials.table.footer', [
                        'pagination' => true,
                        'results' => true,
                        'items' => $items, 
                    ])
                </div>
            @endif
        </div>
    </div>
</div>
@endsection