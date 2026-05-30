@extends('frontend.layouts.master')

@section('title', 'Home')

@section('content')
    @include('frontend.home.sections.hero')
    @include('frontend.home.sections.features')
    @include('frontend.home.sections.new-arrivals')
    @include('frontend.home.sections.collections')
    @include('frontend.home.sections.products')
    @include('frontend.home.sections.reels')
@endsection
