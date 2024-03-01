<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
     <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>{{$pageTitle??'Potters Craft'}}</title>
    <!-- base:css -->
    @include('pages.common.styles.main-css')
    @yield('styles')
</head>
<body>
<div class="container-scroller d-flex">
    <!-- partial:./partials/_sidebar.html -->
    @include('pages.common.partials.sidebar')
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
        <!-- partial:./partials/_navbar.html -->
    @include('pages.common.partials.top-navbar')
        <!-- partial -->
        <div class="main-panel">

            @yield('content')
            <!-- content-wrapper ends -->
            <!-- partial:./partials/_footer.html -->
        @include('pages.common.partials.footer')
            <!-- partial -->
        </div>
        <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
</div>
<!-- container-scroller -->
@include('pages.common.scripts.main-js')
@include('pages.alerts.sweet-alert-flash-message')
@yield('scripts')
</body>

</html>
