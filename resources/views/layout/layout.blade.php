
<!-- head -->
<x-head/>
<!-- end head -->

<body class="g-sidenav-show bg-gray-100">

    <div class="min-height-300 bg-primary position-absolute w-100"></div>

    <!-- aside -->
    <x-aside/>
    <!-- end aside -->

    <main class="main-content position-relative border-radius-lg ps">

        <!-- Navbar -->
        <x-nav/>
        <!-- End Navbar -->

        <div class="container-fluid py-4">

            <!-- page-header -->
            @yield('page-header')
            <!-- end page-header -->

            <!-- content -->
            @yield('content')
            <!-- end content -->

        </div>

            <!-- footer -->
            <x-footer/>
            <!-- end footer -->


    </main>

    <!-- config -->
    <x-config/>
    <!-- end config -->


<!-- end -->
<x-end/>
<!-- end end -->
