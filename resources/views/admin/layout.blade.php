<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">

    <title>@yield('page_title')</title>

    <meta name="description"
        content="Codebase - Bootstrap 5 Admin Template &amp; UI Framework created by pixelcave and published on Themeforest">
    <meta name="author" content="pixelcave">
    <meta name="robots" content="noindex, nofollow">

    <!-- Open Graph Meta -->
    <meta property="og:title" content="Codebase - Bootstrap 5 Admin Template &amp; UI Framework">
    <meta property="og:site_name" content="Codebase">
    <meta property="og:description"
        content="Codebase - Bootstrap 5 Admin Template &amp; UI Framework created by pixelcave and published on Themeforest">
    <meta property="og:type" content="website">
    <meta property="og:url" content="">
    <meta property="og:image" content="">

    <!-- Icons -->
    <!-- The following icons can be replaced with your own, they are used by desktop and mobile browsers -->
    <link rel="shortcut icon" href="{{asset('admin/assets/media/favicons/favicon.png')}}">
    <link rel="icon" type="image/png" sizes="192x192"
        href="{{asset('admin/assets/media/favicons/favicon-192x192.png')}}">
    <link rel="apple-touch-icon" sizes="180x180"
        href="{{asset('admin/assets/media/favicons/apple-touch-icon-180x180.png')}}">
    <!-- END Icons -->

    <!-- Stylesheets -->

    <!-- Fonts and Codebase framework -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800&display=swap">
    <link rel="stylesheet" id="css-main" href="{{asset('admin/assets/css/codebase.min.css')}}">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.css">

</head>

<body>
    <div id="page-container" class="sidebar-o enable-page-overlay side-scroll page-header-modern main-content-boxed">
        <!-- Side Overlay-->
        <aside id="side-overlay">
            <!-- Side Header -->
            <div class="content-header">
                <!-- User Avatar -->
                <a class="img-link me-2" href="be_pages_generic_profile.html">
                    <img class="img-avatar img-avatar32" src="assets/media/avatars/avatar15.jpg" alt="">
                </a>
                <!-- END User Avatar -->

                <!-- User Info -->
                <a class="link-fx text-body-color-dark fw-semibold fs-sm" href="be_pages_generic_profile.html">
                    John Smith
                </a>
                <!-- END User Info -->

                <!-- Close Side Overlay -->
                <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                <button type="button" class="btn btn-sm btn-alt-danger ms-auto" data-toggle="layout"
                    data-action="side_overlay_close">
                    <i class="fa fa-fw fa-times"></i>
                </button>
                <!-- END Close Side Overlay -->
            </div>
        </aside>
        <!-- END Side Overlay -->

        <!-- Sidebar -->
        <nav id="sidebar">
            <!-- Sidebar Content -->
            <div class="sidebar-content">
                <!-- Side Header -->
                <div class="content-header justify-content-lg-center">
                    <!-- Logo -->
                    <div>
                        <span class="smini-visible fw-bold tracking-wide fs-lg">
                            c<span class="text-primary">b</span>
                        </span>
                        <a class="link-fx fw-bold tracking-wide mx-auto" href="index.html">
                            <span class="smini-hidden">
                                <i class="fa fa-fire text-primary"></i>
                                <span class="fs-4 text-dual">code</span><span class="fs-4 text-primary">base</span>
                            </span>
                        </a>
                    </div>
                    <!-- END Logo -->

                    <!-- Options -->
                    <div>
                        <!-- Close Sidebar, Visible only on mobile screens -->
                        <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                        <button type="button" class="btn btn-sm btn-alt-danger d-lg-none" data-toggle="layout"
                            data-action="sidebar_close">
                            <i class="fa fa-fw fa-times"></i>
                        </button>
                        <!-- END Close Sidebar -->
                    </div>
                    <!-- END Options -->
                </div>
                <!-- END Side Header -->

                <!-- Sidebar Scrolling -->
                <div class="js-sidebar-scroll">

                    <!-- Side Navigation -->
                    <div class="content-side content-side-full">
                        <ul class="nav-main">
                            <li class="nav-main-item">
                                <a class="nav-main-link @yield('dashbord_select')" href="{{route('admin.dashboard')}}">
                                    <i class="nav-main-link-icon fa fa-house-user"></i>
                                    <span class="nav-main-link-name">Dashboard</span>
                                </a>
                            </li>
                            @if (Session()->get('USER_TYPE') == 1 || Session()->get('USER_TYPE') == 2 ||
                            Session()->get('USER_TYPE') == 3)

                            @if(Session()->get('USER_TYPE') == 1)
                            <b class="ms-2 m-1">Users</b>
                            <li class="nav-main-item">
                                <a class="nav-main-link @yield('registereduser_select')"
                                    href="{{route('admin.user.list')}}">
                                    <i class="nav-main-link-icon fa fa-address-book"></i>
                                    <span class="nav-main-link-name">Registered User</span>
                                </a>
                            </li>
                            <li class="nav-main-item">
                                <a class="nav-main-link @yield('registeredmanager_select')"
                                    href="{{route('admin.manager.list')}}">
                                    <i class="nav-main-link-icon fa fa-address-book"></i>
                                    <span class="nav-main-link-name">Registered Managers</span>
                                </a>
                            </li>
                            <li class="nav-main-item">
                                <a class="nav-main-link @yield('registeredstaff_select')"
                                    href="{{route('admin.staff.list')}}">
                                    <i class="nav-main-link-icon fa fa-address-book"></i>
                                    <span class="nav-main-link-name">Registered Staffs</span>
                                </a>
                            </li>
                            @endif
                            <b class="ms-2 m-1">INSTALLATION</b>
                            <li class="nav-main-item">
                                <a class="nav-main-link @yield('sacrificialpool_select')"
                                    href="{{route('admin.sacrificialpool.list')}}">
                                    <i class="nav-main-link-icon fa fa-list"></i>
                                    <span class="nav-main-link-name">Sacrificial Pools</span>
                                </a>
                            </li>
                            <li class="nav-main-item">
                                <a class="nav-main-link @yield('watervolume_select')"
                                    href="{{route('admin.watervolume.list')}}">
                                    <i class="nav-main-link-icon fa fa-list"></i>
                                    <span class="nav-main-link-name">Water Volume</span>
                                </a>
                            </li>
                            <li class="nav-main-item">
                                <a class="nav-main-link @yield('filter_select')" href="{{route('admin.filter.list')}}">
                                    <i class="nav-main-link-icon fa fa-list"></i>
                                    <span class="nav-main-link-name">Filter</span>
                                </a>
                            </li>
                            <li class="nav-main-item">
                                <a class="nav-main-link @yield('pump_select')" href="{{route('admin.pump.list')}}">
                                    <i class="nav-main-link-icon fa fa-list"></i>
                                    <span class="nav-main-link-name">Pump</span>
                                </a>
                            </li>
                            <li class="nav-main-item">
                                <a class="nav-main-link @yield('light_select')" href="{{route('admin.light.list')}}">
                                    <i class="nav-main-link-icon fa fa-list"></i>
                                    <span class="nav-main-link-name">Light</span>
                                </a>
                            </li>
                            <li class="nav-main-item">
                                <a class="nav-main-link @yield('inlets_select')" href="{{route('admin.inlets.list')}}">
                                    <i class="nav-main-link-icon fa fa-list"></i>
                                    <span class="nav-main-link-name">Inlets</span>
                                </a>
                            </li>
                            <li class="nav-main-item">
                                <a class="nav-main-link @yield('maindrain_select')"
                                    href="{{route('admin.maindrain.list')}}">
                                    <i class="nav-main-link-icon fa fa-list"></i>
                                    <span class="nav-main-link-name">Main Drain</span>
                                </a>
                            </li>
                            <li class="nav-main-item">
                                <a class="nav-main-link @yield('vaccum_select')" href="{{route('admin.vaccum.list')}}">
                                    <i class="nav-main-link-icon fa fa-list"></i>
                                    <span class="nav-main-link-name">Vacuum</span>
                                </a>
                            </li>
                            <li class="nav-main-item">
                                <a class="nav-main-link @yield('heaterpump_select')"
                                    href="{{route('admin.heaterpump.list')}}">
                                    <i class="nav-main-link-icon fa fa-list"></i>
                                    <span class="nav-main-link-name">Heater Pump</span>
                                </a>
                            </li>
                            <li class="nav-main-item">
                                <a class="nav-main-link @yield('ozone_select')" href="{{route('admin.ozone.list')}}">
                                    <i class="nav-main-link-icon fa fa-list"></i>
                                    <span class="nav-main-link-name">Ozone</span>
                                </a>
                            </li>
                            <li class="nav-main-item">
                                <a class="nav-main-link @yield('slider_select')" href="{{route('admin.slider.list')}}">
                                    <i class="nav-main-link-icon fa fa-list"></i>
                                    <span class="nav-main-link-name">Slider</span>
                                </a>
                            </li>
                           <li class="nav-main-item">
                                <a class="nav-main-link @yield('about_select')" href="{{route('admin.about.list')}}">
                                    <i class="nav-main-link-icon fa fa-list"></i>
                                    <span class="nav-main-link-name">About US</span>
                                </a>
                            </li>
                            <li class="nav-main-item">
                                <a class="nav-main-link @yield('category_select')" href="{{route('admin.category.list')}}">
                                    <i class="nav-main-link-icon fa fa-list"></i>
                                    <span class="nav-main-link-name">Category</span>
                                </a>
                            </li>
                             <!-- <li class="nav-main-item">
                                <a class="nav-main-link @yield('categoryimages_select')" href="{{route('admin.categoryimages.list')}}">
                                    <i class="nav-main-link-icon fa fa-list"></i>
                                    <span class="nav-main-link-name">Category Images</span>
                                </a>
                            </li> -->
                            <li class="nav-main-item">
                                <a class="nav-main-link @yield('blog_select')" href="{{route('admin.blog.list')}}">
                                    <i class="nav-main-link-icon fa fa-list"></i>
                                    <span class="nav-main-link-name">Blog</span>
                                </a>
                            </li>
                             <li class="nav-main-item">
                                <a class="nav-main-link @yield('testimonial_select')" href="{{route('admin.testimonial.list')}}">
                                    <i class="nav-main-link-icon fa fa-list"></i>
                                    <span class="nav-main-link-name">Testimonial</span>
                                </a>
                            </li>
                              <li class="nav-main-item">
                                <a class="nav-main-link @yield('footer_select')" href="{{route('admin.footer.list')}}">
                                    <i class="nav-main-link-icon fa fa-list"></i>
                                    <span class="nav-main-link-name">Footer</span>
                                </a>
                            </li>
                             <li class="nav-main-item">
                                <a class="nav-main-link @yield('follwas_select')" href="{{route('admin.followas.list')}}">
                                    <i class="nav-main-link-icon fa fa-list"></i>
                                    <span class="nav-main-link-name">Follow AS</span>
                                </a>
                            </li>
                              <li class="nav-main-item">
                                <a class="nav-main-link @yield('setting_select')" href="{{route('admin.setting.list')}}">
                                    <i class="nav-main-link-icon fa fa-list"></i>
                                    <span class="nav-main-link-name">Setting</span>
                                </a>
                            </li>
                             <li class="nav-main-item">
                                <a class="nav-main-link @yield('email_select')" href="{{route('admin.email.list')}}">
                                    <i class="nav-main-link-icon fa fa-list"></i>
                                    <span class="nav-main-link-name">Email</span>
                                </a>
                            </li>
                            
                            @endif

                        </ul>
                    </div>
                    <!-- END Side Navigation -->
                </div>
                <!-- END Sidebar Scrolling -->
            </div>
            <!-- Sidebar Content -->
        </nav>
        <!-- END Sidebar -->

        <!-- Header -->
        <header id="page-header">
            <!-- Header Content -->
            <div class="content-header">
                <!-- Left Section -->
                <div class="space-x-1">
                    <!-- Toggle Sidebar -->
                    <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                    <button type="button" class="btn btn-sm btn-alt-secondary" data-toggle="layout"
                        data-action="sidebar_toggle">
                        <i class="fa fa-fw fa-bars"></i>
                    </button>
                    <!-- END Toggle Sidebar -->
                </div>
                <!-- END Left Section -->

                <!-- Right Section -->
                <div class="space-x-1">
                    <!-- User Dropdown -->
                    <div class="dropdown d-inline-block">
                        <button type="button" class="btn btn-sm btn-alt-secondary" id="page-header-user-dropdown"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-user d-sm-none"></i>
                            <span class="d-none d-sm-inline-block fw-semibold">Admin</span>
                            <i class="fa fa-angle-down opacity-50 ms-1"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-md dropdown-menu-end p-0"
                            aria-labelledby="page-header-user-dropdown">
                            <div class="px-2 py-3 bg-body-light rounded-top">
                                <h5 class="h6 text-center mb-0">
                                    Admin
                                </h5>
                            </div>
                            <div class="p-2">
                                <a class="dropdown-item d-flex align-items-center justify-content-between space-x-1"
                                    href="{{ route('logout') }}">
                                    <span>Sign Out</span>
                                    <i class="fa fa-fw fa-sign-out-alt opacity-25"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <!-- END User Dropdown -->
                </div>
                <!-- END Right Section -->
            </div>
        </header>
        <!-- END Header -->

        <!-- Main Container -->
        <main id="main-container">
            <!-- Page Content -->
            @section('container')
            @show
            <!-- END Page Content -->
        </main>
        <!-- END Main Container -->

        <!-- Footer -->
        <footer id="page-footer">
            <div class="content py-3">
                <div class="row fs-sm">
                    <!-- <div class="col-sm-6 order-sm-2 py-1 text-center text-sm-end">
                        Crafted with <i class="fa fa-heart text-danger"></i> by <a class="fw-semibold"
                            href="https://1.envato.market/ydb" target="_blank">pixelcave</a>
                    </div>
                    <div class="col-sm-6 order-sm-1 py-1 text-center text-sm-start">
                        <a class="fw-semibold" href="https://1.envato.market/95j" target="_blank">Codebase 5.1</a>
                        &copy; <span data-toggle="year-copy"></span>
                    </div> -->
                </div>
            </div>
        </footer>
        <!-- END Footer -->
    </div>
    <!-- END Page Container -->
    <script src="{{asset('admin/assets/js/codebase.app.min.js')}}"></script>

    <!-- Page JS Plugins -->
    <script src="{{asset('admin/assets/js/plugins/chart.js/chart.min.js')}}"></script>

    <!-- Page JS Code -->
    <script src="{{asset('admin/assets/js/pages/be_pages_dashboard.min.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

</html>