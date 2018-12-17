<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>WMS | Writers Management System</title>
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('images/favicon.ico')}}">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/bootstrap-datetimepicker.min.css')}}">
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
            @include('partials._navtop')
        <div class="row">
            <div class="col-md-2">
                @include('partials._sidemenu')
            </div>
            <div class="col-md-10">
                <div class="yield-wrapper">
                    @include('partials._success')
                    @include('partials._errors')
                    @yield('content')
                </div>
                @include('partials._copyright')
            </div>
        </div>

    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    @include('partials._datejs')
    <script src="{{asset('/js/alertdelete.js')}}"></script>
    @include('partials._ wysiwyg')
    @include('partials._passToModalJs')

</body>
</html>
