<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'FARMLAB') }} | @yield('pageTitle')</title>

    <link rel="stylesheet" href="{!! asset('css/vendor.css') !!}" />
    <link rel="stylesheet" href="{!! asset('css/app.css') !!}" />

</head>
<body>
  <!-- Wrapper-->
    <div id="wrapper">
        <!-- Navigation -->
        @if (auth()->user()->type === \App\Models\User::ADMIN)
            @include('navigation.admin')
        @elseif (auth()->user()->type === \App\Models\User::FARM_LAB_MEMBER)
            @include('navigation.labmember')
        @elseif (auth()->user()->type === \App\Models\User::PRACTICE_ADMIN)
            @include('navigation.practice')
        @elseif (auth()->user()->type === \App\Models\User::VET)
            @include('navigation.vet')
        @endif

        <!-- Page wraper -->
        <div id="page-wrapper" class="gray-bg">

            <!-- Page wrapper -->
            @include('layouts.topnavbar')

            <!-- Main view  -->
            @yield('content')
            <!-- Footer -->
            @include('layouts.footer')

        </div>
        <!-- End page wrapper-->

    </div>
    <!-- End wrapper-->



    <script src="{!! asset('js/app.js') !!}" type="text/javascript"></script>
    @include('layouts.flash')

    @yield('scripts')
</body>
</html>
