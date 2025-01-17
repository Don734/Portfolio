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

@endsection