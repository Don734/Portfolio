@extends('layouts.site')

@section('title', 'Home')

@section('content')
@include('site.pages.home.sections.banner')
@include('site.pages.home.sections.portfolio')
@include('site.pages.home.sections.contact')
@endsection