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
<div id="wrapper-404">
    <div class="container">
        <div class="content-404">
            <h1>Oops!</h1>
            <h3>404 Not Found</h3><br>
            <p>The page you are looking for might have been removed,<br>
                had its name changed or is temporalily unavailable. <br>
                Head over to <a href="/home">Homepage</a></p>
        </div>
    </div>
</div>
</body>
</html>