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
                    'collapse' => false,
                    'permission' => 'create_technologies',
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
                    @include('admin.partials.table.body', ['items' => $items])
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
