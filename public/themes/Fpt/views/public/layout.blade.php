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

        @stack('meta')

        <link href="https://fonts.googleapis.com/css?family=Rubik:300,400,500&display=swap" rel="stylesheet">

        <link rel="stylesheet" href="{{ v(Theme::url('public/css/app.css')) }}">

        {{-- <link rel="shortcut icon" href="{{ $favicon }}" type="image/x-icon">

        @stack('styles')

        {!! setting('custom_header_assets') !!}


        {!! $schemaMarkup->toScript() !!}

        @stack('globals')

        @routes --}} 
    </head>

    <body>
        <div class="wrapper">
            {{-- @include('public.layout.header') --}}

            @yield('content')

            {{-- @include('public.layout.footer') --}}
            
        </div>

        @stack('pre-scripts')

        <script src="{{ v(Theme::url('public/js/app.js')) }}"></script>

        @stack('scripts')

        {!! setting('custom_footer_assets') !!}
    </body>
</html>
