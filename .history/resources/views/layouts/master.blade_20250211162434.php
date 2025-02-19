<!DOCTYPE html>
<html lang="en">

<head>
    @include('layouts.head')
</head>

<body>
    {{-- @include('layouts.notification') --}}
    <!-- Header -->
    @include('layouts.header')
    <!--/ End Header -->
    @yield('main-content')
    <!-- Footer -->
    @include('layouts.footer')
    <!-- End Footer -->
</body>

</html>
