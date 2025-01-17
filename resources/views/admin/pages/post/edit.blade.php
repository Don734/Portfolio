@extends('layouts.admin')

@section('breadcrumb')
    @include('admin.partials.breadcrumb', [
        'title' => 'Edit Post',
        'list' => [
            [
                'name' => 'Edit Post',
                'current' => true
            ]
        ]
    ])
@endsection

@section('content')
    
@endsection