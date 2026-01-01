@extends('layouts.admin')

@section('breadcrumb')
    @include('admin.partials.breadcrumb', [
        'title' => 'Projects',
        'list' => [
            [
                'name' => 'Projects',
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
                    'link' => dashboard_route(config("admin.route_name_prefix").'projects.create'),
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
                            'status'=>['sortable'=>false,"name"=>"Status"],
                            'type'=>['sortable'=>false,"name"=>"Type"],
                            'started_at'=>['sortable'=>false,"name"=>"Started At"],
                            'finished_at'=>['sortable'=>false,"name"=>"Finished At"],
                            'published_at'=>['sortable'=>false,"name"=>"Published At"],
                            'priority'=>['sortable'=>false,"name"=>"Priority"],
                            'visibility'=>['sortable'=>false,"name"=>"Visibility"],
                            'actions'=>['sortable'=>false,"name"=>"",'class'=>'no-sort'],
                        ]
                    ])
                    <tbody>
                        @foreach ($items as $item)
                        <tr>
                            <td>#{{ $item->id }}</td>
                            <td>
                                <a href="{{ dashboard_route(config("admin.route_name_prefix").'projects.edit', ['project'=>$item->id]) }}">
                                    {{ $item->title }}
                                </a>
                            </td>
                            <td>
                                <span class="badge text-bg-{{$item->status->color()}}">
                                    {{__('enums.project_status.'.$item->status->value)}}
                                </span>
                            </td>
                            <td>
                                <span class="badge text-bg-{{$item->type->color()}}">
                                    {{__('enums.project_type.'.$item->type->value)}}
                                </span>
                            </td>
                            <td>{{ getDefaultFormat($item->started_at, "Y/m/d H:i:s") }}</td>
                            <td>{{ getDefaultFormat($item->finished_at, "Y/m/d H:i:s") }}</td>
                            <td>{{ getDefaultFormat($item->published_at, "Y/m/d H:i:s") }}</td>
                            <td>{{$item->priority}}</td>
                            <td>
                                <span class="badge text-bg-{{$item->visibility->color()}}">
                                    {{__('enums.project_visibility.'.$item->visibility->value)}}
                                </span>
                            </td>
                            <td>
                                @include('admin.partials.table.actions', [
                                  'item' => $item,
                                  'edit_route' => dashboard_route(config("admin.route_name_prefix").'projects.edit', ['project'=>$item->id]),
                                  'destroy_route' => dashboard_route(config("admin.route_name_prefix").'projects.destroy', ['project'=>$item->id]),
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