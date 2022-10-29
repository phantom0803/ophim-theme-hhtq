@extends('themes::layout')

@php
    $menu = \Ophim\Core\Models\Menu::getTree();
@endphp

@push('header')
    <link rel="stylesheet" href="{{ asset('/themes/hhtq/template/statics/css/mytheme-font.css') }}" type="text/css" />
    <link rel="stylesheet" href="{{ asset('/themes/hhtq/template/statics/css/mytheme-ui1b26.css') }}" type="text/css" />
    <link rel="stylesheet" href="{{ asset('/themes/hhtq/template/statics/css/mytheme-site6654.css') }}" type="text/css" />
    <link rel="stylesheet" href="{{ asset('/themes/hhtq/template/statics/css/mytheme-color26654.css') }}" type="text/css" name="default" />
    <link rel="stylesheet" href="{{ asset('/themes/hhtq/template/statics/css/custom.css') }}" type="text/css" name="default" />
    <link rel="stylesheet" href="{{ asset('/themes/hhtq/template/statics/css/header.css') }}" type="text/css" name="default" />

    <script type="text/javascript" src="{{ asset('/themes/hhtq/template/statics/js/jquery-3.6.1.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/themes/hhtq/template/statics/js/mytheme-site7839.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/themes/hhtq/template/statics/js/mytheme-ui.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/themes/hhtq/template/statics/js/header.js') }}"></script>
@endpush

@section('body')
    @include('themes::themehhtq.inc.header')
    @yield('content')
@endsection

@section('footer')
    {!! get_theme_option('footer') !!}

    {!! setting('site_scripts_google_analytics') !!}
@endsection
