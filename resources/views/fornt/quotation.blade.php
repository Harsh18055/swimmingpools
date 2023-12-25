@extends('fornt/layout')
@section('page_title','Quotation')
@section('qotation_select','active')
@section('container')

<section class="main" id="pages">

    <!-- Title -->
    <div class="page-title overlay"
        style="background: url('{{asset('fornt/assets/images/img/slider-bg.jpg')}}'); background-size: cover;">
        <h2>Quotation</h2>
    </div>
    <!-- End of Title -->

</section>
<!-- ===== End of Main Page Section ===== -->



<!-- ===== Start of Contact Section ===== -->
<section id="contact">
    <div class="container">
        <div class="col-md-12 pad80">
            <h2 class="section-title">Quotation</h2>
        </div>

        <!-- Start of Contact Form -->
        <div class="col-md-8 col-md-offset-2 contact-top">
            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the
                industry's standard dummy text ever since the 1500s.</p>

            <!-- start of form -->

            <form id="contact-form ">

               <div class="col-md-12">
            <p class="text-left" style="padding-top: 10px;">Water Volume</p>
            <select class="form-control input-box" name="watervolume" id="watervolumeDropdown">
                <option value="" disabled selected>Select Water Volume</option>
                @foreach($watervolume as $item)
                    <option value="{{ $item->id }}" data-price="{{ $item->price }}">{{ $item->name }}</option>
                @endforeach
            </select>
        </div>

                <div class="col-md-12">
                    <p class="text-left" style="padding-top: 10px;">Filter</p>
                    <select class="form-control input-box" name="filter" id="filterDropdown">
                        <option value="" disabled selected>Select Filter</option>
                    </select>
                    <p class="price finalprice"><p>
                </div>
                <div class="col-md-12">
                    <p class="text-left" style="padding-top: 10px;">Pump</p>
                    <select class="form-control input-box" name="pump" id="pump">
                        <option value="" disabled selected>Select Pump</option>
                    </select>
                    <p class="price1 finalprice"><p>
                </div>
                <div class="col-md-12">
                    <p class="text-left" style="padding-top: 10px;">Light</p>
                    <select class="form-control input-box" name="light" id="light">
                        <option value="" disabled selected>Select Light</option>
                    </select>
                    <p class="price2 finalprice"><p>
                </div>
                <div class="col-md-12">
                    <p class="text-left" style="padding-top: 10px;">Inlets</p>
                    <select class="form-control input-box" name="inlets" id="inlets">
                        <option value="" disabled selected>Select Inlets</option>
                    </select>
                    <p class="price3 finalprice"><p>
                </div>
                <div class="col-md-12">
                    <p class="text-left" style="padding-top: 10px;">MainDrain</p>
                    <select class="form-control input-box" name="maindrain" id="maindrain">
                        <option value="" disabled selected>Select MainDrain</option>
                    </select>
                    <p class="price4 finalprice"><p>
                </div>
                <div class="col-md-12">
                    <p class="text-left" style="padding-top: 10px;">Vacuum</p>
                    <select class="form-control input-box" name="vacuum" id="vacuum">
                        <option value="" disabled selected>Select Vacuum</option>
                    </select>
                    <p class="price5 finalprice"><p>
                </div>
                <div class="col-md-12">
                    <p class="text-left" style="padding-top: 10px;">Heater Pump</p>
                    <select class="form-control input-box" name="heaterpump" id="heaterpump">
                        <option value="" disabled selected>Select Heater Pump</option>
                    </select>
                    <p class="price6 finalprice"><p>
                </div>
                <div class="col-md-12">
                    <p class="text-left" style="padding-top: 10px;">Ozone</p>
                    <select class="form-control input-box" name="ozone" id="ozone">
                        <option value="" disabled selected>Select Ozone</option>
                    </select>
                    <p class="price7 finalprice"><p>
                </div>
                <p id="total">Total:</p>
            </form>
        

        </div>
        <!-- End of Contact Form -->
    </div>
</section>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<script>
    $(document).ready(function () {
        $('#watervolumeDropdown').on('change', function () {
            var watervolumeId = $(this).val();

            if (watervolumeId) {
                // Fetch filtered data for Filter dropdown
                $.ajax({
                    url: '/get-filtered-data/' + watervolumeId,
                    type: 'GET',
                    dataType: 'json',
                    success: function (data) {
                        // Clear the current options in the Filter dropdown
                        $('#filterDropdown').empty();

                        // Add the new options based on the fetched data
                        $.each(data, function (key, value) {
                            $('#filterDropdown').append('<option value="' + value.id + '">' + value.name + '</option>');
                            $('.price').append(value.price);
                        });
                    }
                });

                // Fetch data for Pump dropdown
                $.ajax({
                    url: '/get-pump-data/' + watervolumeId,
                    type: 'GET',
                    dataType: 'json',
                    success: function (data) {
                        // Clear the current options in the Pump dropdown
                        $('#pump').empty();

                        // Add the new options based on the fetched data
                        $.each(data, function (key, value) {
                            $('#pump').append('<option value="' + value.id + '">' + value.name + '</option>');
                            $('.price1').append(value.price);
                            
                            
                        });
                    }
                });
                // Fetch data for Light dropdown
                $.ajax({
                    url: '/get-light-data/' + watervolumeId,
                    type: 'GET',
                    dataType: 'json',
                    success: function (data) {
                        // Clear the current options in the Light dropdown
                        $('#light').empty();

                        // Add the new options based on the fetched data
                        $.each(data, function (key, value) {
                            $('#light').append('<option value="' + value.id + '">' + value.name + '</option>');
                            $('.price2').append(value.price);
                        });
                    }
                });
                // Fetch data for Inlets dropdown
                $.ajax({
                    url: '/get-inlet-data/' + watervolumeId,
                    type: 'GET',
                    dataType: 'json',
                    success: function (data) {
                        // Clear the current options in the Inlets dropdown
                        $('#inlets').empty();

                        // Add the new options based on the fetched data
                        $.each(data, function (key, value) {
                            $('#inlets').append('<option value="' + value.id + '">' + value.name + '</option>');
                             $('.price3').append(value.price);
                        });
                    }
                });
                // Fetch data for MainDrain dropdown
                $.ajax({
                    url: '/get-maindrain-data/' + watervolumeId,
                    type: 'GET',
                    dataType: 'json',
                    success: function (data) {
                        // Clear the current options in the MainDrain dropdown
                        $('#maindrain').empty();

                        // Add the new options based on the fetched data
                        $.each(data, function (key, value) {
                            $('#maindrain').append('<option value="' + value.id + '">' + value.name + '</option>');
                             $('.price4').append(value.price);
                        });
                    }
                });
                // Fetch data for Vacuum dropdown
                $.ajax({
                    url: '/get-vacuum-data/' + watervolumeId,
                    type: 'GET',
                    dataType: 'json',
                    success: function (data) {
                        // Clear the current options in the Vacuum dropdown
                        $('#vacuum').empty();

                        // Add the new options based on the fetched data
                        $.each(data, function (key, value) {
                            $('#vacuum').append('<option value="' + value.id + '">' + value.name + '</option>');
                            $('.price5').append(value.price);
                        });
                    }
                });
                // Fetch data for Heater Pump dropdown
                $.ajax({
                    url: '/get-heaterpump-data/' + watervolumeId,
                    type: 'GET',
                    dataType: 'json',
                    success: function (data) {
                        // Clear the current options in the Heater Pump dropdown
                        $('#heaterpump').empty();

                        // Add the new options based on the fetched data
                        $.each(data, function (key, value) {
                            $('#heaterpump').append('<option value="' + value.id + '">' + value.name + '</option>');
                            $('.price6').append(value.price);
                        });
                    }
                });
                // Fetch data for Ozone dropdown
                $.ajax({
                    url: '/get-ozone-data/' + watervolumeId,
                    type: 'GET',
                    dataType: 'json',
                    success: function (data) {
                        // Clear the current options in the Ozone dropdown
                        $('#ozone').empty();

                        // Add the new options based on the fetched data
                        $.each(data, function (key, value) {
                            $('#ozone').append('<option value="' + value.id + '">' + value.name + '</option>');
                            $('.price7').append(value.price);
                            gettotal();
                        });
                    }
                });
            } else {
                // If the first dropdown is empty, clear the second and third dropdowns
                $('#filterDropdown').empty();
                $('#pump').empty();
                $('#light').empty();
                $('#inlets').empty();
                $('#maindrain').empty();
                $('#vacuum').empty();
                $('#heaterpump').empty();
                $('#ozone').empty();
            }
        });
    });
</script>
<!-- Your existing HTML and script code -->

<script>
function gettotal(){
    // Select all elements with class "finalprice"
    var prices = $('.finalprice');

    // Initialize total to 0
    var total = 0;

    // Loop through each element and add its value to the total
    prices.each(function() {
      // Convert the text content of the element to a number and add to total
      total += parseFloat($(this).text());
    });

    // Display the total in an alert
    $('#total').html(total);

  }
</script>

@endsection