<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>FARMLAB | @yield('pageTitle')</title>

    <link rel="stylesheet" href="{!! asset('css/vendor.css') !!}" />
    <link rel="stylesheet" href="{!! asset('css/app.css') !!}" />

</head>

<body class="gray-bg">

   @yield ('content')

    <!-- Scripts -->
    <script src="{!! asset('js/app.js') !!}"></script>

</body>

</html>
