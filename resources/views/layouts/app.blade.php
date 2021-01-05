<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name', 'forum') }}</title>
    <link rel="apple-touch-icon" sizes="180x180" href="/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon/favicon-16x16.png">
    <link rel="manifest" href="/favicon/site.webmanifest">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}" />
    @yield('styles')
    <script>
        window.App = {!! json_encode([
               'csrfToken' => csrf_token(),
               'user' => Auth::user(),
               'signedIn' => Auth::check()
           ]) !!};
    </script>
</head>
<body>
    <div id="app">
        @include('layouts.nav')
        @yield('content')
        @include('layouts.footer')
    </div>
    <script src="{{ asset('js/app.js') }}"></script>
    {{-- <script src="{{ asset('js/bulma.js') }}"></script> --}}
    @yield('scripts')
</body>
</html>
