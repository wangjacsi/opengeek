<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
    <title>{{ config('app.name') }} | @yield('title') </title>

    <link rel="stylesheet" href="{{ URL::asset('css/app.css') }}" />
    <link rel="stylesheet" href="{{ URL::asset('admin/css/admin_plugin.css') }}" />
    @yield('styles')
    <link rel="stylesheet" href="{{ URL::asset('admin/css/admin.css') }}" />

</head>
<body>

  <!-- Wrapper-->
    <div id="wrapper">

        <!-- Navigation -->
        @include('admin.layouts.navigation')

        <!-- Page wraper -->
        <div id="page-wrapper" class="gray-bg">

            <!-- Page wrapper -->
            @include('admin.layouts.topnavbar')

            <!-- Main view  -->
            @yield('content')

            <!-- Footer -->
            @include('admin.layouts.footer')

        </div>
        <!-- End page wrapper-->

        <!-- Small Chat -->
        @include('admin.layouts.smallchat')
        <!-- Right Sidebar -->
        @include('admin.layouts.rightsidebar')
    </div>
    <!-- End wrapper-->


<script src="{{ URL::asset('admin/js/admin_app.js') }}"></script>
<script src="{{ URL::asset('admin/js/admin_plugin.js') }}" type="text/javascript"></script>

<script src="{{ URL::asset('admin/js/admin.js') }}" type="text/javascript"></script>

@yield('scripts')

</body>
</html>
