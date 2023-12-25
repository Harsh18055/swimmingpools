@extends('admin/layout')
@section('page_title','Sacrificial Pool')
@section('sacrificialpool_select','active')
@section('container')

<div class="container-fluid">
            <div class="card-body">
                <h5 class="card-title fw-semibold mb-4">Sacrificial Pool</h5>
                <div class="card">
                    <div class="card-body">
                        <form id="productform" >
                            @csrf
                            <input type="hidden" value="{{$sacrificial->id ?? '0'}}" name="id">
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Model Name</label>
                                <input type="text" class="form-control" id="modelname"
                                    aria-describedby="emailHelp" name="modelname" value="{{$sacrificial->modelname ?? ''}}" placeholder="Enter Modelname">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Includes</label>
                                <textarea class="form-control" id="includes" aria-describedby="emailHelp" name="includes" placeholder="Enter Includes">{{ $sacrificial->includes ?? '' }}</textarea>
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Price</label>
                                <input type="text" class="form-control" id="email"
                                    aria-describedby="emailHelp" name="price" value="{{$sacrificial->price ?? ''}}" placeholder="Enter Price">
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
                url: '{{ route('admin.sacrificialpool.store') }}',
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
                        window.location.href = "{{ route('admin.sacrificialpool.list') }}";
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