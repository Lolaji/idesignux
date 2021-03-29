@extends('errors::minimal')

@section('title', __('Forbidden'))
@section('code', '403')

@section('message')
    <h1 class="title mb--20">{{$exception->getMessage() ?: 'Forbidden'}}</h1>
    <p class="subtitle-2 mb--30">
        This page is forbidden.
    </p>
@endsection
