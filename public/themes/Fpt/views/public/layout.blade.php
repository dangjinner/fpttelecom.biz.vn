<!DOCTYPE html>
<html lang="{{ locale() }}">
<head>
    <base href="{{ config('app.url') }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">

    <title>
        @hasSection('title')
            @yield('title') - {{ setting('store_name') }}
        @else
            {{ setting('store_name') }}
        @endif
    </title>
    <link rel="stylesheet" href="{{ v(Theme::url('assets/css/bootstrap.min.css')) }}">
    <link rel="stylesheet" href="{{ v(Theme::url("assets/slick-1.8.1/slick/slick.css")) }}">
    <link rel="stylesheet" href="{{ v(Theme::url("assets/slick-1.8.1/slick/slick-theme.css")) }}">
    <link rel="stylesheet" href="{{ v(Theme::url("assets/css/font/fontawesome-free-5.15.4/css/all.min.css")) }}">
    <link rel="stylesheet" href="{{ v(Theme::url("assets/css/header.css")) }}">
    <link rel="stylesheet" href="{{ v(Theme::url("assets/css/footer.css")) }}">
    <link rel="stylesheet" href="{{ v(Theme::url("assets/css/css.css")) }}">
    <link rel="stylesheet" href="{{ v(Theme::url("assets/css/reponsive.css")) }}">
    @stack('meta')

{{--    <link rel="shortcut icon" href="{{ $favicon }}" type="image/x-icon">--}}

    @stack('styles')

    {!! setting('custom_header_assets') !!}

{{--    {!! $schemaMarkup->toScript() !!}--}}

    @stack('globals')
</head>

<body>
@include('public.layout.header')

@yield('content')

@include('public.layout.footer')

@stack('pre-scripts')
<script src="{{ v(Theme::url('assets/js/popper.min.js')) }}"></script>
<script src="{{ v(Theme::url('assets/js/bootstrap.min.js')) }}"></script>
<script src="{{ v(Theme::url('assets/js/jquery.min.js')) }}"></script>
<script src="{{ v(Theme::url('assets/slick-1.8.1/slick/slick.min.js')) }}"></script>
<script src="{{ v(Theme::url('assets/js/js.js')) }}"></script>
@stack('scripts')

{!! setting('custom_footer_assets') !!}
</body>
</html>
