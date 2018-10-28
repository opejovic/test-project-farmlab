<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>FARMLAB | 403 Error</title>

    <link rel="stylesheet" href="{!! asset('css/vendor.css') !!}" />
    <link rel="stylesheet" href="{!! asset('css/app.css') !!}" />

</head>

<body class="gray-bg">


    <div class="middle-box text-center animated fadeInDown">
        <h1>403</h1>
        <h3 class="font-bold">Permission denied!</h3>

        <div class="error-desc">
            Sorry, you are not authorized to view this page.
                <h5>
                    <button type="submit" class="btn btn-primary" onclick="window.history.go(-1)">Go back</button>
                </h5>
        </div>
    </div>

    <!-- Scripts -->
    <script src="{!! asset('js/app.js') !!}"></script>

</body>

</html>
