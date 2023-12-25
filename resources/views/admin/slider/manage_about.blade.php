@extends('admin/layout')
@section('page_title','Slider')
@section('slider_select','active')
@section('container')

<div class="container-fluid">
            <div class="card-body">
                <h5 class="card-title fw-semibold mb-4">Slider</h5>
                <div class="card">
                    <div class="card-body">
                      <form id="productform" >
                            @csrf   
                            <input type="hidden" value="{{$id ?? '0'}}" name="id">
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Image</label>
                                <input type="file" class="form-control" 
                                    aria-describedby="emailHelp" name="image" value="{{$image?? ''}}" placeholder="Enter Images" >
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Heading</label>
                                <input type="text" class="form-control" id="heading"
                                    aria-describedby="emailHelp" name="heading" value="{{$heading ?? ''}}" placeholder="Enter Heading" >
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Text</label>
                                <input type="text" class="form-control" id="text"
                                    aria-describedby="emailHelp" name="text" value="{{$text ?? ''}}" placeholder="Enter Text" >
                            </div>
                             <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Button Text</label>
                                <input type="text" class="form-control" id="btntext"
                                    aria-describedby="emailHelp" name="btntext" value="{{$btntext ?? ''}}" placeholder="Enter Button Text" >
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Link</label>
                                <input type="text" class="form-control" id="link"
                                    aria-describedby="emailHelp" name="link" value="{{$link ?? ''}}" placeholder="Enter Link" >
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
                url: '{{ route('admin.slider.manage_process') }}',
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
                        window.location.href = "{{ route('admin.slider.list') }}";
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