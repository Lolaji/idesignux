@extends('errors::minimal')

@section('title', __('Unauthorized'))
@section('code', '401')
@section('message', __('Unauthorized'))

@section('message')
    <h1 class="title mb--20">Unauthorized</h1>
    <p class="subtitle-2 mb--30">
        You don't have access to this page.
    </p>
@endsection
