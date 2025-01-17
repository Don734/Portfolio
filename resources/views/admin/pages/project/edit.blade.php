@extends('layouts.admin')

@section('breadcrumb')
    @include('admin.partials.breadcrumb', [
        'title' => 'Edit Project',
        'list' => [
            [
                'name' => 'Edit Project',
                'current' => true
            ]
        ]
    ])
@endsection

@section('content')

@endsection