@extends('fornt/layout')
@section('page_title','Blog')
@section('blog_select','active')
@section('container')
<!-- ===== Main Page Section ===== -->
    <section class="main" id="pages">

        <!-- Title -->
        <div class="page-title overlay" style="background: url('{{asset('fornt/assets/images/img/slider-bg.jpg')}}'); background-size: cover;">
            <h2>Blog Detail</h2>
        </div>
        <!-- End of Title -->

    </section>
    <!-- ===== End of Main Page Section ===== -->




    <!-- ===== Start of Blog Post Section ===== -->
    <section id="blog-post">
        <div class="container pad80">
            <!-- Start of Post Title -->
            <div class="col-md-12 post-title">
                <h1 style="text-align:center;">{{ $blog->heading }}</h1>
                <p >{!! $blog->text !!}</p>
            </div>
        </div>
    </section>
    <!-- ===== End of Comments Section ===== -->
@endsection