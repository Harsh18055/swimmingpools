@extends('admin/layout')
@section('page_title','Follow US')
@section('followas_select','active')
@section('container')

<div class="container-fluid">
            <div class="card-body">
                <h5 class="card-title fw-semibold mb-4">Follow US</h5>
                <div class="card">
                    <div class="card-body">
                      <form id="productform" >
                            @csrf   
                            <input type="hidden" value="{{$id ?? '0'}}" name="id">
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Facebook</label>
                                <input type="text" class="form-control" id="facebook"
                                    aria-describedby="emailHelp" name="facebook" value="{{$facebook ?? ''}}" placeholder="Enter Facebook" >
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Intagram</label>
                                <input type="text" class="form-control" id="intagram"
                                    aria-describedby="emailHelp" name="intagram" value="{{$intagram ?? ''}}" placeholder="Enter Intagram" >
                            </div>
                             <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Linkdin</label>
                                <input type="text" class="form-control" id="linkdin"
                                    aria-describedby="emailHelp" name="linkdin" value="{{$linkdin ?? ''}}" placeholder="Enter Linkdin" >
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Twitter</label>
                                <input type="text" class="form-control" id="twitter"
                                    aria-describedby="emailHelp" name="twitter" value="{{$twitter ?? ''}}" placeholder="Enter Twitter" >
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
                url: '{{ route('admin.followas.manage_process') }}',
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
                        window.location.href = "{{ route('admin.followas.list') }}";
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