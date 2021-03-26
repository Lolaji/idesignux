@extends('errors::minimal')

@section('title', __('Not Found'))
@section('code', '404')

@section('message')
    <h1 class="title mb--20">Page Not Found</h1>
    <p class="subtitle-2 mb--30">This Page Isn't Available <br>
        The link may be broken, or the page may have been removed. 
        Check to see if the <br> link you're trying to open is correct.</p>
@endsection
