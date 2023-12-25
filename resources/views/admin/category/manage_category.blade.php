@extends('admin/layout')
@section('page_title','Category')
@section('category_select','active')
@section('container')

<div class="container-fluid">
            <div class="card-body">
                <h5 class="card-title fw-semibold mb-4">Category Name</h5>
                <div class="card">
                    <div class="card-body">
                      <form id="productform" >
                            @csrf   
                            <input type="hidden" value="{{$id ?? '0'}}" name="id">
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Category Name</label>
                                <input type="text" class="form-control" id="c_name"
                                    aria-describedby="emailHelp" name="c_name" value="{{$c_name ?? ''}}" placeholder="Enter Category Name" >
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Category Images</label>
                                                        <input type="file" class="form-control" id="image" name="image[]" accept="image/*" multiple>

                            </div>
                            <div class="container mb-4">
                      <div class="row">
                            @if(isset($Cimages))
                            @foreach($Cimages as $Cimage)
                                <div class="col-md-2">
                                  <div class="img-wrap">
                                    <a href="{{ route('admin.category.image.delete', $Cimage->id) }}" type="button" class="btn-close" id="delete-image-button" aria-label="Close"></a>
                                    <img src="{{ asset('admin/assets/media/categoryimages/'. $Cimage->image) }}" class="img-fluid">
                                    <!-- <button class="close-button">&times;</button> -->
                                  </div>
                                </div>
                            @endforeach
                            @endif
                      </div>
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
                url: '{{ route('admin.category.manage_process') }}',
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
                        window.location.href = "{{ route('admin.category.list') }}";
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


<script>

    document.getElementById('delete-image-button').addEventListener('click', function() {
        if (confirm('Are you sure you want to delete this image?')) {
            window.location.href = '{{ route('admin.category.image.delete', ['$id']) }}';
        }
    });
</script>
@endsection

@section('script')

@endsection