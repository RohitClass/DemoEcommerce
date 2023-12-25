@extends('layout.layout')


@section('pagetitle')
    Add Category
@endsection


@section('maincontent')
    <div class="container mt-5  pt-5 pb-5 bg-white">
        <div class="col-12 ">
            <form id="form_submit">
                @csrf
                <div class="form-row">
                    <div class="col-md-6 mb-3">
                        <label for="validationServer01">Category Name</label>
                        <input type="text" name="Category" id="name" class="form-control " placeholder="Name">

                        <div class="text-danger small mt-1" id="error">

                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="validationServer02">Slug</label>
                        <input type="text" class="form-control" name="slug" id="slug" placeholder="slug"
                            value="" readonly>

                        <div class="text-danger small mt-1" id="error">

                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="validationServer02">Image</label>
                        <input type="file" class="form-control " id="image" name="image" value="Last Name">

                        <div class="text-danger small mt-1" id="error">

                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="validationServer02">Status</label>
                        <select name="status" class="form-control " id="validationServer02">
                            <option value="1">Active</option>
                            <option value="0">Deactive</option>
                        </select>
                        {{-- <div class="text-daborder-danger small mt-1">
                        Sorry, that username's taken. Try another?
                    </div> --}}
                    </div>
                </div>
                <button class="btn btn-primary btn-pill mr-2" type="submit">Submit</button>
                <button class="btn btn-light btn-pill" type="submit">Cancel</button>
            </form>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $("#form_submit").submit(function(event) {
                event.preventDefault();
                var form_data = new FormData(this);
                form_data.append('_token', $('meta[name="csrf-token"]').attr('content'));

                $.ajax({
                    type: "POST",
                    url: "{{ route('create.create') }}",
                    dataType: "json",
                    processData: false,
                    contentType: false,
                    data: form_data,
                }).done(function(data) {

                    if (data.status == false) {

                        var response = data['message'];

                        if (response['Category']) {
                            $('#name').addClass('is-invalid').siblings('#error').addClass(
                                'invalide-feedback').html(response['Category']);
                        } else {
                            $('#name').removeClass('is-invalid').siblings('#error').removeClass(
                                'invalide-feedback').html('');
                        }

                        if (response['slug']) {
                            $('#slug').addClass('is-invalid').siblings('#error').addClass(
                                'invalide-feedback').html(response['slug']);
                        } else {
                            $('#slug').removeClass('is-invalid').siblings('#error').removeClass(
                                'invalide-feedback').html('');
                        }


                        if (response['image']) {
                            $('#image').addClass('is-invalid').siblings('#error').addClass(
                                'invalide-feedback').html(response['image']);
                        } else {
                            $('#image').removeClass('is-invalid').siblings('#error').removeClass(
                                'invalide-feedback').html('');
                        }

                    } else {
                        $('#name').removeClass('is-invalid').siblings('#error').removeClass(
                            'invalide-feedback').html('');
                        $('#slug').removeClass('is-invalid').siblings('#error').removeClass(
                            'invalide-feedback').html('');
                        $('#image').removeClass('is-invalid').siblings('#error').removeClass(
                            'invalide-feedback').html('');
                        $('#form_submit')[0].reset();
                        console.log('successs');
                    }



                })
            })
        })

        $('#name').change(function () {
    var csrfToken = $('meta[name="csrf-token"]').attr('content');

    var inputValue = $(this).val();

    $.ajax({
        type: "POST",
        url: "{{ route('getslug') }}",
        dataType: "json",
        data: {
            _token: csrfToken,
            slug: inputValue
        },
        success: function (data) {
            // Handle the success response
            $('#slug').val(data.slug);
        },
        error: function (xhr, status, error) {
            // Handle the error
            console.error(xhr.responseText);
        }
    });


        });
    </script>
@endsection
