@extends('errors::minimal')

@section('title', __('Server Error'))
@section('code', '500')
@section('message', __('Server Error'))

@section('message')
    <h1 class="title mb--20">Server Error</h1>
    <p class="subtitle-2 mb--30">
        There page cannot work now due to system error. <br>
        We are working on it already, please check back later. If it persist, please kindly contact us on <br>
        <a href="mailto:contact@idesignux.net">contact@idesignux.net</a>
    </p>
@endsection
