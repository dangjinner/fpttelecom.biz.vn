<!DOCTYPE html>
<html lang="{{ locale() }}">
<head>
    <base href="{{ config('app.url') }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">

    {!! SEO::generate() !!}

    <link rel="shortcut icon" href="{{ $favicon->path }}" type="image/x-icon" />

    <link rel="stylesheet" href="{{ v(Theme::url('assets/css/bootstrap.min.css')) }}">
    <link rel="stylesheet" href="{{ v(Theme::url("assets/slick-1.8.1/slick/slick.css")) }}">
    <link rel="stylesheet" href="{{ v(Theme::url("assets/slick-1.8.1/slick/slick-theme.css")) }}">
    <link rel="stylesheet" href="{{ v(Theme::url("assets/css/font/fontawesome-free-5.15.4/css/all.min.css")) }}">
    <link rel="stylesheet" href="{{ v(Theme::url("assets/libs/select2/style.min.css")) }}">
    <link rel="stylesheet" href="{{ v(Theme::url("assets/css/header.css")) }}">
    <link rel="stylesheet" href="{{ v(Theme::url("assets/css/footer.css")) }}">
    <link rel="stylesheet" href="{{ v(Theme::url("assets/css/css.css")) }}">
    <link rel="stylesheet" href="{{ v(Theme::url("assets/css/reponsive.css")) }}">
    <link rel="stylesheet" href="{{ v(Theme::url("assets/css/customize.css")) }}">
    @stack('meta')

    @stack('styles')

    {!! setting('custom_header_assets') !!}

{{--    {!! $schemaMarkup->toScript() !!}--}}

    @stack('globals')
</head>

<body>
@include('public.layouts.header')

@yield('content')

@include('public.layouts.footer')

@stack('pre-scripts')
<script src="{{ v(Theme::url('assets/js/popper.min.js')) }}"></script>
<script src="{{ v(Theme::url('assets/js/bootstrap.min.js')) }}"></script>
<script src="{{ v(Theme::url('assets/js/jquery.min.js')) }}"></script>
<script src="{{ v(Theme::url('assets/libs/select2/select2.min.js')) }}"></script>
<script src="{{ v(Theme::url('assets/slick-1.8.1/slick/slick.min.js')) }}"></script>
<script src="{{ v(Theme::url('assets/js/js.js')) }}"></script>
@stack('scripts')

{!! setting('custom_footer_assets') !!}
</body>
</html>
