@extends('admin/layout')
@section('page_title', 'Blog')
@section('blog_select', 'active')
@section('container')

<div class="container-fluid">
    <div class="card-body">
        <h5 class="card-title fw-semibold mb-4">Blog</h5>
        <div class="card">
            <div class="card-body">
                <form id="blogForm" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" value="{{ $id ?? '0' }}" name="id">
                    <div class="mb-3">
                        <label for="image" class="form-label">Image</label>
                        <input type="file" class="form-control" id="image" name="image" accept="image/*">
                    </div>
                    <div class="mb-3">
                        <label for="heading" class="form-label">Heading</label>
                        <input type="text" class="form-control" id="heading" name="heading" value="{{ $heading ?? '' }}"
                            placeholder="Enter Heading">
                    </div>
                    <div class="mb-3">
                        <label for="text" class="form-label">Text</label>
                        <textarea class="form-control" id="text" name="text"
                            placeholder="Enter Text">{{$text ?? ''}}</textarea>   
                    </div>
                    <button type="submit" class="btn btn-primary" id="submit">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script src="https://cdn.ckeditor.com/ckeditor5/37.0.1/classic/ckeditor.js"></script>

<script>
    $(document).ready(function () {
        $('#blogForm').on('submit', function (event) {
            event.preventDefault();

            var $submitButton = $('#submit');
            $submitButton.html('Please Wait...').attr('disabled', true);

            var formData = new FormData($(this)[0]);

            $.ajax({
                type: 'POST',
                url: '{{ route('admin.blog.manage_process') }}',
                data: formData,
                processData: false,
                contentType: false,
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                success: function (response) {
                    if (response.success) {
                        Swal.fire(
                            'Good job!',
                            response.message,
                            'success'
                        );
                        window.location.href = "{{ route('admin.blog.list') }}";
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: response.message,
                        });
                    }
                    $submitButton.html('Submit').attr('disabled', false);
                },
                error: function (xhr) {
                    alert('Error occurred during the AJAX request.');
                    $submitButton.html('Submit').attr('disabled', false);
                }
            });
        });
    });

    ClassicEditor
            .create( document.querySelector( '#text' ),{
                ckfinder: {
                    uploadUrl: '{{route('admin.ckeditor.upload').'?_token='.csrf_token()}}',
        }
            })
            .catch( error => {
                console.error( error );
            } );
</script>

@endsection

@section('script')
<!-- Additional scripts if needed -->
@endsection
