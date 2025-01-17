@extends('layouts.admin')

@section('breadcrumb')
    @include('admin.partials.breadcrumb', [
        'title' => 'Create User',
        'list' => [
            [
                'name' => 'Create User',
                'current' => true
            ]
        ]
    ])
@endsection

@section('content')
    
@endsection