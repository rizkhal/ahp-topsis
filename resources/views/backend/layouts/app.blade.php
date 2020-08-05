<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <meta name="csrf-token" content="{{csrf_token()}}">
    <title>{{isset($title) ? $title : "Skripsi"}} | Topsis and AHP</title>
    <link rel="icon" href="{{ asset('backend/img/stisla.svg') }}">
    @include('backend.partials._css')
</head>
<body>
    <div id="app">
        <div class="main-wrapper">
            @include('backend.partials.header')
            @include('backend.partials.sidebar')
            <div class="main-content">
                @yield("app")
            </div>
            @include('backend.partials.footer')
        </div>
    </div>
    @include('backend.partials._js')
</body>
</html>
