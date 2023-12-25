@extends('admin/layout')
@section('page_title','Testimonial')
@section('testimonial_select','active')
@section('container')

<div class="container-fluid">
    <h5 class="card-title fw-semibold mb-4">Testimonial</h5>
    <div class="card">
        <div class="card-body">
            <a href="{{ route('admin.testimonial.add')}}" type="button"   class="btn btn-sm btn-primary float-end mb-2" data-bs-toggle="tooltip" title="Add Testimonial">
                <i class="fa fa-plus"></i>Testimonial
                </a>
                @if(session()->has('message'))
            
            <div class="alert alert-success d-flex align-items-center justify-content-between" role="alert">
                    <p class="mb-0">
                    {{session('message')}}!
                    </p>
                    <i class="fa fa-fw fa-times ms-2"></i>
                  </div>
            @endif 
            @if(session()->has('delete'))
            <div class="alert alert-danger d-flex align-items-center justify-content-between" role="alert">
                    <p class="mb-0">
                    {{session('delete')}}!
                    </p>
                    <i class="fa fa-fw fa-times ms-2"></i>
                  </div>
            @endif  
            <table class="table table-bordered table-striped table-vcenter js-dataTable-full dataTable scroll-horizontal" id="FoamTable">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Action</th>
                        <th scope="col">Desperation</th>
                        <th scope="col">profile</th>
                        <th scope="col">Heading</th>
                        <th scope="col">Review</th>
                        
                    </tr>
                </thead>
            </table>
        </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>

<script>
    $(document).ready(function () {
        // Initialize DataTable
        var table = $('#FoamTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('admin.testimonial.getdatatable') }}",
            columns: [
                { data: 'id'},
                { data: 'actions'},  
                { data : 'desperation'} ,   
                {
    data: 'profile',
    render: function(data, type, full, meta) {
        var baseUrl = 'assets/media/testimonial/';
        var imageUrl = baseUrl + data;
        return '<img src="' + imageUrl + '" alt="Image" style="width: 200px; height: 100px;">';
    }
},

                { data: 'heading'},
                { data: 'review'},
            ],
            lengthMenu: [[50, 100, -1], [50, 100, 'All']],
        });
    });
</script>
@endsection  