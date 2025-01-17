@extends('layouts.admin')

@section('breadcrumb')
    @include('admin.partials.breadcrumb', [
        'title' => 'Edit User',
        'list' => [
            [
                'name' => 'Edit User',
                'current' => true
            ]
        ]
    ])
@endsection

@section('content')
    
@endsection