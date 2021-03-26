@extends('errors::minimal')

@section('title', __('Service Unavailable'))
@section('code', '503')

@section('message')
    <h1 class="title mb--20">Page Unavailable</h1>
    <p class="subtitle-2 mb--30">
        This Page Isn't Available righ now. Please check back later.
    </p>
@endsection
