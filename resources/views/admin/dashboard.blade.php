@extends('admin/layout')
@section('page_title','Dashboard')
@section('dashbord_select','active')
@section('container')

<!-- Page Content -->
<div class="content">
    <div class="row">
        <!-- Row #1 -->
        <div class="col-6 col-xl-3">
            <a class="block block-rounded block-link-shadow text-end" href="javascript:void(0)">
                <div class="block-content block-content-full d-sm-flex justify-content-between align-items-center">
                    <div class="d-none d-sm-block">
                        <i class="fa fa-shopping-bag fa-2x opacity-25"></i>
                    </div>
                    <div>
                        <div class="fs-3 fw-semibold">1500</div>
                        <div class="fs-sm fw-semibold text-uppercase text-muted">Sales</div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-6 col-xl-3">
            <a class="block block-rounded block-link-shadow text-end" href="javascript:void(0)">
                <div class="block-content block-content-full d-sm-flex justify-content-between align-items-center">
                    <div class="d-none d-sm-block">
                        <i class="fa fa-wallet fa-2x opacity-25"></i>
                    </div>
                    <div>
                        <div class="fs-3 fw-semibold">$780</div>
                        <div class="fs-sm fw-semibold text-uppercase text-muted">Earnings</div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-6 col-xl-3">
            <a class="block block-rounded block-link-shadow text-end" href="javascript:void(0)">
                <div class="block-content block-content-full d-sm-flex justify-content-between align-items-center">
                    <div class="d-none d-sm-block">
                        <i class="fa fa-envelope-open fa-2x opacity-25"></i>
                    </div>
                    <div>
                        <div class="fs-3 fw-semibold">15</div>
                        <div class="fs-sm fw-semibold text-uppercase text-muted">Messages</div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-6 col-xl-3">
            <a class="block block-rounded block-link-shadow text-end" href="javascript:void(0)">
                <div class="block-content block-content-full d-sm-flex justify-content-between align-items-center">
                    <div class="d-none d-sm-block">
                        <i class="fa fa-users fa-2x opacity-25"></i>
                    </div>
                    <div>
                        <div class="fs-3 fw-semibold">4252</div>
                        <div class="fs-sm fw-semibold text-uppercase text-muted">Online</div>
                    </div>
                </div>
            </a>
        </div>
        <!-- END Row #1 -->
    </div>
</div>
<!-- END Page Content -->

@endsection