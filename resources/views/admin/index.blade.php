@include('admin.layouts.header')
@include('admin.layouts.nav')
@include('admin.layouts.sidebar')

    <!-- Main content -->
        @include('admin.layouts.message')
        @yield('content')
    
@include('admin.layouts.footer')