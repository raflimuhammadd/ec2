@include('admin.layout.top')
<!-- Content Wrapper -->

<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->


    @include('admin.layout.sidebar')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <div id="content">
            @yield('content')

        </div>
    </div>


    @include('admin.layout.footer')
