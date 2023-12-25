@extends('fornt/layout')
@section('page_title','About Detail')
@section('about_select','active')
@section('container')

<style>
    
    .custom-image 
    {
        display: block;
        margin: 0 auto;
        max-width: 800px;
        width: 100%; 
        height: auto; 
        max-height: 400px; 
        border: 1px solid #ccc;
        box-shadow: 2px 2px 5px #888888;
    }

    h2
    {
        padding-bottom:50px;
    }

    .heading
    {
        text-align: center;
        margin: 0 !important;
        text-transform: uppercase;
    }

    @media (max-width: 768px) {
        .custom-image {
            max-width: 100%;
        }
    }
</style>

    <!-- ===== Main Page Section ===== -->
    <section class="main" id="pages">

        <!-- Title -->
        <div class="page-title overlay" style="background: url('{{asset('fornt/assets/images/img/slider-bg.jpg')}}'); background-size: cover;">
            <h2>About Us</h2>
        </div>
        <!-- End of Title -->

    </section>
    <!-- ===== End of Main Page Section ===== -->
    <!-- ===== Start of About Section ===== -->
    <section id="about">
        <div class="container main-content">

            <div class="col-md-12">
                <h2 class="heading">{{$about->heading}}</h2>
               <p><img src="{{ asset('admin/assets/media/slider/' . $about->image) }}" alt="About Image" class="custom-image"></p>
                <p>{{$about->text}}</p>
            </div>

            <div class="col-md-6 about-vid pad40">
            </div>  
        </div>
    </section>
    <!-- ===== End of About Section ===== -->
@endsection