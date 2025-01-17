@extends('layouts.admin')

@section('breadcrumb')
    @include('admin.partials.breadcrumb', [
        'title' => 'Create Post',
        'list' => [
            [
                'name' => 'Create Post',
                'current' => true
            ]
        ]
    ])
@endsection

@section('content')
    
@endsection