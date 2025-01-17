@extends('layouts.admin')

@section('breadcrumb')
    @include('admin.partials.breadcrumb', [
        'title' => 'Posts',
        'list' => [
            [
                'name' => 'Posts',
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
                    'link' => dashboard_route('dashboard.posts.create'),
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
                            'published_at'=>['sortable'=>false,"name"=>"Published At"],
                            'status'=>['sortable'=>false,"name"=>"Status"],
                            'actions'=>['sortable'=>false,"name"=>"",'class'=>'no-sort'],
                        ]
                    ])
                    <tbody>
                        @foreach ($items as $item)
                        <tr>
                            <td>#{{ $item->id }}</td>
                            <td><span class="badge text-bg-info">@lang("admin.post_type_".$item->type)</span></td>
                            <td>
                                <a href="{{ dashboard_route('dashboard.posts.edit', ['post'=>$item->id]) }}">{{ $item->title }}</a>
                            </td>
                            <td>{{ getDefaultFormat($item->published_at, "Y/m/d H:i:s") }}</td>
                            <td>
                                <span class="badge text-bg-{{$item->is_active ? "success" : "danger"}}">
                                    {{$item->is_active ? __('admin.active'): __('admin.not_active')}}
                                </span>
                            </td>
                            <td>
                                @include('admin.partials.table.actions', [
                                  'item' => $item,
                                  'edit_route' => dashboard_route('dashboard.posts.edit', ['post'=>$item->id]),
                                  'destroy_route' => dashboard_route('dashboard.posts.destroy', ['post'=>$item->id]),
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