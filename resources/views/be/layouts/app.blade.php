<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="Responsive HTML Admin Dashboard Template based on Bootstrap 5">
    <meta name="author" content="NobleUI">
    <meta name="keywords"
        content="nobleui, bootstrap, bootstrap 5, bootstrap5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">

    <title>Ziu | @yield('pageTitle' ?? 'Home')</title>

    @include('be.layouts.style')
    @stack('styles')
</head>

<body>
    <div class="main-wrapper">

        <!-- partial:partials/_sidebar.html -->
        @include('be.layouts.sidebar')

        <!-- partial -->

        <div class="page-wrapper">

            <!-- partial:partials/_navbar.html -->
            @include('be.layouts.navbar')
            <!-- partial -->

            <div class="page-content">
                @yield('content')
            </div>

            <!-- partial:partials/_footer.html -->
            @include('be.layouts.footer')
            <!-- partial -->

        </div>
    </div>

    @include('be.layouts.script')

    @stack('scripts')
</body>

</html>
