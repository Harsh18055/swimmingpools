@extends('admin/layout')
@section('page_title','Footer')
@section('Footer_select','active')
@section('container')

<div class="container-fluid">
    <h5 class="card-title fw-semibold mb-4">Footer</h5>
    <div class="card">
        <div class="card-body">
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
                        <th scope="col">Logo</th>
                        <th scope="col">Description</th>
                        <th scope="col">Location</th>
                        <th scope="col">Phone</th>
                        <th scope="col">Email</th>
                        <th scope="col">Heading</th>
                        <th scope="col">Text</th>

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
            ajax: "{{ route('admin.footer.getdatatable') }}",
            columns: [
                { data: 'id'},
                { data: 'actions'},     
                {
    data: 'logo',
    render: function(data, type, full, meta) {
        var baseUrl = 'assets/media/footer/';
        var imageUrl = baseUrl + data;
        return '<img src="' + imageUrl + '" alt="Image" style="width: 200px; height: 100px;">';
    }
},

                { data: 'desperation'},
                { data: 'location'},
                { data: 'phone'},
                { data: 'email'},
                { data: 'heading'},
                  { data: 'text'},
            ],
            lengthMenu: [[50, 100, -1], [50, 100, 'All']],
        });
    });
</script>
@endsection  