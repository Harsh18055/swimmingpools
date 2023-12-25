@extends('fornt/layout')
@section('page_title','home')
@section('home_select','active')
@section('container')
<!-- ===== Main Section - Slider ===== -->

<section class="main" id="home">
    <!-- Swiper -->
    <div class="swiper-container fullscreen">
        <div class="swiper-wrapper">

            <!-- Slide 1 -->
            @foreach($about as $list)
            <div class="swiper-slide overlay"
                style="background: url('{{asset('admin/assets/media/about/'.$list->image)}}'); background-size: cover;">
                <div class="slider-content container">
                    <div class="col-md-12">
                        <h3>Welcome to <br> <span>{{$list->heading}}</span></h3>
                        <h4>{{$list->text}}</h4>
                        <div class="cta">
                            <a href="{{route('quotation')}}" class="btn" target="_blank">{{$list->btntext}}</a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            <!-- End of Slide 1 -->

        </div>
        <!-- End of Swiper Wrapper -->

        <!-- Add Pagination -->
        <div class="swiper-pagination"></div>

        <!-- scroll down -->
        <div class="scroll-down"><a href=""><i class="fa fa-angle-double-down"></i></a></div>

    </div>
    <!-- End of Swiper Container -->
</section>


<!-- ===== End of Main Section - Slider ===== -->
<!-- ===== Start About Us Section ===== -->

<section id="about-us">
    <div class="container-fluid">
        <div class="row">
            @foreach($slider as $list)
            <div class="col-md-4 about-image"
                style="background: url('{{asset('admin/assets/media/slider/'.$list->image)}}'); background-size: cover;">
            </div>

            <div class="col-md-8 main-content">
                <h2 class="section-title">About Us</h2>
                <div class="about-description">
                    <h4 style="padding-bottom:20px;">{{$list->heading}}</h2>
                        <p>{{$list->text}}</p>
                        <a href="{{ route('about', ['id' => $list->id]) }}" class="btn">Read more</a>
                </div>
            </div>

            <div class="logo-overlay">
            </div>
            @endforeach
        </div>
    </div>
</section>
<!-- ===== End About Us Section ===== -->

<!-- ===== Start of Gallery Section ===== -->
<section id="gallery">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 pad80">
                <h2 class="section-title">Gallery</h2>
            </div>

            <!-- Start of Gallery Filters -->
            <ul class="gallery-sorting text-center">
                <li><a href="#" class="btn-border active" data-group="all">All</a></li>
                @foreach($cimage as $list)
                <li><a href="#" class="btn-border" data-group="{{$list->category_name}}">{{$list->category_name}}</a></li>
                @endforeach
            </ul>

            <!-- Start of Gallery Images -->
            <ul class="gallery-items list-unstyled" id="grid">
                @foreach($cimage as $image)
                <!-- image -->
                <li class="col-md-2 col-sm-4 col-xs-6" data-groups='["{{ $image->category_name }}"]'>
                    <figure class="gallery-item">
                        <a href="{{asset('admin/assets/media/categoryimages/'.$image->image)}}">
                            <img src="{{asset('admin/assets/media/categoryimages/'.$image->image)}}" alt=""
                                class="img-responsive">
                        </a>
                    </figure>
                </li>
                @endforeach
                <!-- sizer -->
                <li class="col-md-2 col-sm-4 col-xs-6 shuffle_sizer"></li>
            </ul>
            <!-- End of Gallery Images -->

        </div>
    </div>
</section>
<!-- ===== End of Gallery Section ===== -->





<!-- ===== Start of Blog Section ===== -->
<section id="blog">
    <div class="container">
        <div class="col-md-12 pad80">
            <h2 class="section-title">Blog</h2>
        </div>
        <!-- Start of Blog Post 1 -->
        @foreach($blog as $list)
        <article class="col-md-12 blog-post">
            <div class="col-md-3 blog-thumbnail">
                <a href="{{ route('blog', ['id' => $list->id]) }}"><img
                        src="{{asset('admin/assets/media/blog/'.$list->image)}}" class="img-responsive" alt=""></a>
            </div>

            <div class="col-md-9 blog-desc">
                <h4><a href="{{ route('blog', ['id' => $list->id]) }}">{{$list->heading}}</a></h4>

                <div class="post-detail">
                </div>
                <span>{{ Carbon\Carbon::parse($list->created_at)->format('d-m-Y') }}</span>
                @php
                $blogContent = preg_replace('/<img[^>]+>/i', '', $list->text);
                    $limitedContent = Str::limit($blogContent, 350, ' ...');
                    @endphp
                    <p>{!! $limitedContent !!}</p>
                    <a href="{{ route('blog', ['id' => $list->id]) }}" class="btn">read more</a>
            </div>
        </article>
        @endforeach
        <!-- End of Blog Post 1 -->
        <!-- <div class="col-md-12 text-center">
                <a href="blog-listing.html" class="btn-border">visit blog</a>
            </div> -->

    </div>
</section>
<!-- ===== End of Blog Section ===== -->

<!-- ===== Start of Testimonial Section ===== -->
<section id="testimonials">
    <div class="container main-content">

        <div class="col-md-12">
            <h2 class="section-title"><span>happy clients</span><br> testimonial</h2>
        </div>

        <!-- Start of Sync 1 -->
        <div id="sync1" class="owl-carousel col-md-12">
            @foreach($testimonial as $list)
            <!-- Testimonial of Client 1 -->
            <div class="item">
                <div class="testimonial">
                    <blockquote>{{$list->desperation}}</blockquote>
                </div>
            </div>

            <!-- Testimonial of Client 2 -->


            <!-- Testimonial of Client 3 -->

            @endforeach
        </div>
        <!-- End of Sync 1 -->

        <!-- Start of Sync 2 -->
        <div id="sync2" class="owl-carousel col-md-12">

            <!-- Client 1 -->
            @foreach($testimonial as $list)
            <div class="item">
                <!-- Client Image -->
                <div class="client-img">
                    <img src="{{asset('admin/assets/media/testimonial/'.$list->profile)}}" class="img-responsive"
                        alt="">
                </div>
                <!-- Client Detail -->
                <div class="details">
                    <h4>{{$list->heading}}</h4>
                    <h6>{{$list->review}}</h6>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
<!-- ===== End of Testimonial Section ===== -->




@endsection