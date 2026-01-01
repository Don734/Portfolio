@extends('layouts.admin')

@section('breadcrumb')
    @include('admin.partials.breadcrumb', [
        'title' => 'Technologies',
        'list' => [
            [
                'name' => 'Technologies',
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
                    'link' => dashboard_route(config("admin.route_name_prefix").'technologies.create'),
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
                            'title'=>['sortable'=>false,"name"=>"Title"],
                            'color'=>['sortable'=>false,"name"=>"Color"],
                            'order'=>['sortable'=>false,"name"=>"Order"],
                            'is_visible'=>['sortable'=>false,"name"=>"Is Visible"],
                            'actions'=>['sortable'=>false,"name"=>"",'class'=>'no-sort'],
                        ]
                    ])
                    <tbody>
                        @foreach ($items as $item)
                        <tr>
                            <td>#{{ $item->id }}</td>
                            <td>
                                @if ($item->hasMedia('icon'))
                                    <img src="{{ $item->getFirstMediaUrl('icon') }}" class="me-2">
                                @endif
                                <a href="{{ dashboard_route(config("admin.route_name_prefix").'technologies.edit', ['technology'=>$item->id]) }}">
                                    {{ $item->title }}
                                </a>
                            </td>
                            <td>{{$item->color}}</td>
                            <td>{{$item->order}}</td>
                            <td>
                                <span class="badge text-bg-{{$item->is_visible ? "success" : "danger"}}">
                                    {{$item->is_visible ? __('admin.active'): __('admin.not_active')}}
                                </span>
                            </td>
                            <td>
                                @include('admin.partials.table.actions', [
                                  'item' => $item,
                                  'edit_route' => dashboard_route(config("admin.route_name_prefix").'technologies.edit', ['technology'=>$item->id]),
                                  'destroy_route' => dashboard_route(config("admin.route_name_prefix").'technologies.destroy', ['technology'=>$item->id]),
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