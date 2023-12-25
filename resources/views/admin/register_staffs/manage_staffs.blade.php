@extends('admin/layout')
@section('page_title','Registered Staff')
@section('registeredstaff_select','active')
@section('container')

<div class="container-fluid">
            <div class="card-body">
                <h5 class="card-title fw-semibold mb-4">Registered Staff</h5>
                <div class="card">
                    <div class="card-body">
                        <form id="productform" >
                            @csrf
                            <input type="hidden" value="{{$user->id ?? '0'}}" name="id">
                            <input type="hidden" value="3" name="user_type">
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Name</label>
                                <input type="text" class="form-control" id="name"
                                    aria-describedby="emailHelp" name="name" value="{{$user->name ?? ''}}" placeholder="Enter name">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Address</label>
                                <input type="text" class="form-control" id="address"
                                    aria-describedby="emailHelp" name="address" value="{{$user->address ?? ''}}" placeholder="Enter Address">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email"
                                    aria-describedby="emailHelp" name="email" value="{{$user->email ?? ''}}" placeholder="Enter Email">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Phone</label>
                                <input type="text" class="form-control" id="phone"
                                    aria-describedby="emailHelp" name="phone" value="{{$user->phone ?? ''}}" placeholder="Enter Phone">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Quote Status</label>
                                <input type="text" class="form-control" id="quotestatus"
                                    aria-describedby="emailHelp" name="quotestatus" value="{{$user->quotestatus ?? ''}}" placeholder="Enter Quote Status">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password"
                                    aria-describedby="emailHelp" name="password"  placeholder="Enter Password">
                            </div>
                            <button  value="submit" id="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>

<script>
    $(document).ready(function() {
        // Event handler for form submission
        $('#productform').on('submit', function(event) {
            event.preventDefault(); // Prevent the default form submission

            var csrfToken = $(this).data('csrf-token'); // Access the CSRF token from the data attribute
            var $submitButton = $('#submit');
            $submitButton.html('Please Wait...').attr('disabled', true);

            var formData = new FormData($(this)[0]);

            // Perform AJAX request to submit the form data
            $.ajax({
                type: 'POST',
                url: '{{ route('admin.staff.staff_store') }}',
                data: formData,
                processData: false,
                contentType: false,
                headers: {
                    'X-CSRF-TOKEN': csrfToken // Include CSRF token from the data attribute
                },
                success: function(response) {
                    if (response.success) {
                        Swal.fire(
                            'Good job!',
                            response.message,
                            'success'
                        );
                        window.location.href = "{{ route('admin.staff.list') }}";
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: response.message,
                        });
                    }
                    $submitButton.html('Submit').attr('disabled', false);
                },
                error: function(xhr) {
                    alert('Error occurred during the AJAX request.');
                    $submitButton.html('Submit').attr('disabled', false);
                }
            });
        });
    });
</script>

@endsection

@section('script')

@endsection