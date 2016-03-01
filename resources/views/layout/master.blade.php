<!DOCTYPE html>
<html>
<head>
    <title>@yield('title')</title>
    {{-- Lato Font --}}
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:100">
    {{-- Bootstrap CSS--}}
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"/>

    {{-- JQuery--}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    {{-- Bootstrap JS--}}
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container-fluid">
    {{-- Content menu--}}
    <div class="col-md-9 col-lg-10">
        @yield('content')
    </div>
</div>
</body>
</html>
