<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">

    <!-- ===== Mobile viewport optimized ===== -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1.0, user-scalable=no">

    <!-- ===== Meta Tags - Description for Search Engine purposes ===== -->
    <meta name="description" content="Swimmerland - Water Park HTML Template">
    <meta name="keywords" content="water park, pool, summer, swimming, swimmerland">
    <meta name="author" content="GnoDesign">

    <!-- ===== Website Title ===== -->
    <title>Swimmerland - Water Park HTML Template</title>
    <link rel="shortcut icon" href="{{ asset('fornt/assets/images/favicon.png') }}" type="image/x-icon">
    <link rel="apple-touch-icon-precomposed" href="images/apple-touch-icon.html">

    <!-- ===== Google Fonts ===== -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700|Open+Sans" rel="stylesheet">

    <!-- ===== CSS links ===== -->
    <link rel="stylesheet" type="text/css" href="{{asset('fornt/assets/css/bootstrap.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('fornt/assets/css/font-awesome.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('fornt/assets/css/swiper.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('fornt/assets/css/animate.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('fornt/assets/css/shuffle.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('fornt/assets/css/magnific-popup.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('fornt/assets/css/owl.carousel.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('fornt/assets/css/style.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('fornt/assets/css/responsive.css')}}">
</head>

<body>

<!-- ===== Start of Header ===== -->

    <header class="main">
        <nav class="navbar navbar-default navbar-static-top fluid_header">
            <div class="container">
                <!-- Logo -->
                <div class="col-md-4">
                    @foreach($setting as $list)
                    <a class="navbar-brand" href=""><img src="{{asset('admin/assets/media/setting/'.$list->logo)}}" alt="logo"></a>
                    <!-- INSERT YOUR LOGO HERE -->
                    @endforeach
                </div>

                <!-- Main Menu -->
                <div class="col-md-8">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle toggle-menu menu-right push-body" data-toggle="collapse" data-target="#main-nav" aria-expanded="false">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    </div>

                    <div class="collapse navbar-collapse pull-right cbp-spmenu cbp-spmenu-vertical cbp-spmenu-right" id="main-nav">
                        <h3>Menu</h3>
                        <ul class="nav navbar-nav navbar-right">
                        <li><a href="#home" >Home</a></li>
                        <li><a href="#about-us" >About US</a></li>
                        <li><a href="#gallery">Gallery</a></li>
                        <li><a href="#blog">Blog</a></li>
                        <li><a href="#testimonials">Testimonial</a></li>
                    </ul>
                        <!-- <ul class="nav navbar-nav navbar-right">
                            <li class="active dropdown" role="presentation">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">home</a>
                            </li>
                            <li class="dropdown" role="presentation">
                                <a href="#about-us" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">About US</i></a>
                            </li>
                            <li class="dropdown" role="presentation">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">blog</a>
                            </li>
                            <li class="dropdown" role="presentation">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Testimonial</a>
                            </li>
                            <li class="dropdown" role="presentation">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Footer</a>
                            </li>
                        </ul> -->
                    </div>
                </div>
            </div>
        </nav>
    </header>
    <!-- ===== End of Header ===== -->
@section('container')
@show
    <!-- ===== Start of Footer ===== -->
    <footer id="main-footer">
        <div class="container">

            <!-- Start of Footer Top -->
            <div class="row footer-top">

                <!-- Start of Footer About -->
               
                <div class="col-md-4 col-xs-6 about">
                     @foreach($footer as $list)
                    <img src="{{asset('admin/assets/media/footer/'.$list->logo)}}" alt="">
                    <p>{{$list->desperation}}</p>
                    <ul>
                        <li><span><i class="fa fa-map-marker"></i>{{$list->location}}</span></li>
                        <li><span><i class="fa fa-phone"></i>{{$list->phone}}</span></li>
                        <li><span><i class="fa fa-envelope-o"></i>{{$list->email}}</span></li>
                    </ul>
                    @endforeach
                </div>
                <!-- End of Footer About -->
                
                <!-- Start of Footer Navigation -->
                <div class="col-md-2 col-xs-6 footer-nav">
                    <h4>navigation</h4>
                    <ul class="footer-links">
                        <li><a href="#home" >Home</a></li>
                        <li><a href="#about-us" >About US</a></li>
                        <li><a href="#gallery">Gallery</a></li>
                        <li><a href="#blog">Blog</a></li>
                        <li><a href="#testimonials">Testimonial</a></li>
                    </ul>
                </div>
                <!-- End of Footer Navigation -->

                <!-- Start of Footer Social Media Links -->
                <div class="col-md-2 col-xs-6 footer-social">
                    <h4>follow us</h4>
                    <ul class="footer-links">
                        @foreach($data as $list)
                        <li><a href="{{$list->facebook}}" target=”_blank”>facebook</a></li>
                        <li><a href="{{$list->intagram}}" target=”_blank”>twitter</a></li>
                        <li><a href="{{$list->linkdin}}" target=”_blank”>instagram</a></li>
                        <li><a href="{{$list->twitter}}" target=”_blank”>linkedin</a></li>
                        @endforeach
                    </ul>
                </div>
                <!-- End of Footer Social Media Links -->

                <!-- Start of Footer Newsletter -->
                @foreach($footer as $list)
                <div class="col-md-4 col-xs-6 footer-newsletter">
                    <h4>{{$list->heading}}</h4>
                    <p>{{$list->text}}</p>
                @endforeach 
                    <!-- Start of Form -->
                    <form action="{{ route('email') }}" class="" method="post">
                        @csrf
                        <input type="hidden" value="{{$id ?? '0'}}" name="id">
                        <!-- subscribe result -->
                        <div id="subscribe-result"></div>
                        <!-- end of subscribe result -->
                        <div class="form-group">
                            <div class="input-group">
                                <input type="email" name="email" id="email" class="form-control" placeholder="Email Address" required>
                               <button type="submit" class="btn">Subscribe</button>
                            </div>
                             
                        </div>
                    </form>
                    <!-- End of Form -->
                    
                </div>
                <!-- End of Footer Newsletter -->

            </div>
            <!-- End of Footer Top -->

            <!-- Start of Footer Copyright -->
            <div class="row">
                <div class="col-md-12 text-center copyright">
                    <p>Copyright © Swimmerland. All Rights Reserved.</p>
                </div>
            </div>
            <!-- End of Footer Copyright -->

        </div>
    </footer>
    <!-- ===== End of Footer ===== -->

    <script data-cfasync="false" src="../../cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
    <script src="{{asset('fornt/assets/js/jquery-3.1.1.min.js')}}"></script>
    <script src="{{asset('fornt/assets/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('fornt/assets/js/modernizr.min.js')}}"></script>
    <script src="{{asset('fornt/assets/js/wow.min.js')}}"></script>
    <script src="{{asset('fornt/assets/js/swiper.min.js')}}"></script>
    <script src="{{asset('fornt/assets/js/jquery.shuffle.min.js')}}"></script>
    <script src="{{asset('fornt/assets/js/jquery.magnific-popup.min.js')}}"></script>
    <script src="{{asset('fornt/assets/js/jquery.countTo.js')}}"></script>
    <script src="{{asset('fornt/assets/js/jquery.inview.min.js')}}"></script>
    <script src="{{asset('fornt/assets/js/owl.carousel.min.js')}}"></script>
    <script src="{{asset('fornt/assets/js/calendar.min.js')}}"></script>
    <script src="{{asset('fornt/assets/js/jquery.ajaxchimp.js')}}"></script>
    <script src="{{asset('fornt/assets/js/custom.js')}}"></script>
</body>
</html>