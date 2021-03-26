@extends('errors::minimal')

@section('title', __('Too Many Requests'))
@section('code', '429')

@section('message')
    <h1 class="title mb--20">Too Many Requests</h1>
    <p class="subtitle-2 mb--30">
        There is too many request on this page.
    </p>
@endsection
