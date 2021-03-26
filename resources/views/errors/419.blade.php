@extends('errors::minimal')

@section('title', __('Page Expired'))
@section('code', '419')

@section('message')
    <h1 class="title mb--20">Page Expired</h1>
    <p class="subtitle-2 mb--30">
        This page is expired. <br> Please referesh this page to continue.
    </p>
@endsection
