@extends('layout/main')

@section('css-library')
    {{-- Tempat Ngoding Meletakkan css library --}}

@endsection

@section('css-custom')
    {{-- Tempat Ngoding Meletakkan css custom --}}
    
@endsection

@section('content')
<div class="page-body">
    <div class="container-fluid">
      <div class="page-title">
        <div class="row">
          <div class="col-sm-6">
            <h3>
               Absensi</h3>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="index.html">                                       
                  <svg class="stroke-icon">
                    <use href="../assets/svg/icon-sprite.svg#stroke-home"></use>
                  </svg></a></li>
              <li class="breadcrumb-item">Master Data</li>
              <li class="breadcrumb-item">Absensi</li>
              <li class="breadcrumb-item active">Clock In/Clock Out Absensi</li>
            </ol>
          </div>
        </div>
      </div>
    </div>
    <!-- Container-fluid starts-->
    <div class="container-fluid e-category">
        <div class="row">
            <div class="col-xl-12">
                <div class="card height-equal">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-lg-6">
                                <h5 class="card-title">Clock In/Clock Out Absensi</h5>
                            </div>
                            <div class="col-lg-6 d-flex justify-content-end">
                                <a href="{{ url('absensi') }}" class="btn btn-sm btn-primary">Kembali</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body custom-input">
                        <form id="create_absensi" class="row g-3 needs-validation" action="{{ url('absensi/create/save') }}" method="POST">
                            @csrf
                            <div class="col-lg-12 mb-3" id="map" style="height: 400px;"></div>
                            <div class="col-md-12">
                                <h1 class="text-center">Waktu Saat Ini: <span id="clock"></span></h1>
                                <h4 class="text-center"><span id="date"></span></h4>
                            </div>
                            <div class="col-md-12">
                                <div id="reader"></div>
                            </div>
                            <input type="hidden" id="latitude" name="latitude">
                            <input type="hidden" id="longitude" name="longitude">  
                            <input type="hidden" id="clock_time" name="waktu">    
                            <input type="hidden" id="today_date" name="today_date"> 
                            <div class="col-md-12 d-flex justify-content-center">
                                <button id="submit" type="submit" name="clock_type" value="Clock In" class="btn btn-success">Clock In</button>
                                <button id="submit" type="submit" name="clock_type" value="Clock Out" class="btn btn-primary">Clock Out</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js-library')
{{-- Tempat Ngoding Meletakkan js library --}}
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCm8veVh4ipYx0T0217Njyu1zPiwm60f3U&callback=initMap"></script>
<script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
@endsection

@section('js-custom')
{{-- Tempat Ngoding Meletakkan js custom --}}
<script>
    function onScanSuccess(decodedText, decodedResult) {
    // handle the scanned code as you like, for example:
    console.log(`Code matched = ${decodedText}`, decodedResult);
    }

    let config = {
    fps: 10,
    qrbox: {width: 100, height: 100},
    rememberLastUsedCamera: true,
    // Only support camera scan type.
    supportedScanTypes: [Html5QrcodeScanType.SCAN_TYPE_CAMERA]
    };

    let html5QrcodeScanner = new Html5QrcodeScanner(
    "reader", config, /* verbose= */ false);
    html5QrcodeScanner.render(onScanSuccess);
</script>
<script>
    function initMap() {
        // Inisialisasi peta
        var map = new google.maps.Map(document.getElementById('map'), {
            center: {lat: -6.9790223, lng: 110.4139645}, // Default center (Jakarta)
            zoom: 15
        });

        // Mendapatkan lokasi pengguna
        navigator.geolocation.getCurrentPosition(function(position) {
            var latitude = position.coords.latitude;
            var longitude = position.coords.longitude;

            // Set marker pada lokasi pengguna
            var marker = new google.maps.Marker({
                position: {lat: latitude, lng: longitude},
                map: map
            });

            // Update nilai latitude dan longitude pada form
            document.getElementById('latitude').value = latitude;
            document.getElementById('longitude').value = longitude;
        });
    }

    // Tampilkan jam yang berjalan
    function displayTime() {
        var now = new Date();
        var hours = now.getHours();
        var minutes = now.getMinutes();
        var seconds = now.getSeconds();
        var timeString = hours + ':' + (minutes < 10 ? '0' : '') + minutes + ':' + (seconds < 10 ? '0' : '') + seconds;
        document.getElementById('clock').innerHTML = timeString;
        document.getElementById('clock_time').value = timeString;
    }
    function setDate() {
        var now = new Date();
        var date = now.getFullYear() + '-' + ((now.getMonth() + 1) < 10 ? '0' : '') + (now.getMonth() + 1) + '-' + (now.getDate() < 10 ? '0' : '') + now.getDate();
        document.getElementById('date').innerHTML = date;
        document.getElementById('today_date').value = date;
    }

    setInterval(displayTime, 1000);
    setDate();
</script>

<script>
    $(document).ready(function() {
        $("#submit").on('click', function(e) {
            e.preventDefault();
            $('#submit').prop('disabled', true);
            
            let formUrl = $('#create_absensi').attr('action');
            let form_data = new FormData($('#create_absensi')[0]);

            $.ajax({
                url: formUrl,
                method: "POST",
                data: form_data,
                contentType: false,
                processData: false,
                dataType: "JSON",
                timeout: 30000,
                error: function(xmlhttprequest, textstatus, message) {
                    var res = (textstatus === "timeout") ? "Request timeout!" : textstatus;
                    Swal.fire({
                        title: "Error",
                        html: res,
                        icon: "warning"
                    }).then(function() {
                        $('#btn-submit').prop('disabled', false);
                    });
                },
                success: function(response) {
                    let alert_text = "";
                    if ($.isArray(response.message)) {
                        $.each(response.message, function(i, message) {
                            alert_text += message + "<br>";
                        });
                    } else if (typeof response.message === 'object') {
                        $.each(response.message, function(key, messages) {
                            alert_text += messages[0] + "<br>";
                        });
                    } else {
                        alert_text = response.message;
                    }

                    if (response.status == true) {
                        Swal.fire({
                            title: "Success",
                            text: response.message,
                            icon: "success",
                            timer: 1500
                        }).then(function() {
                            window.location.href = response.url;
                        });
                    } else {
                        Swal.fire({
                            title: "Error",
                            html: alert_text,
                            icon: "warning"
                        }).then(function() {
                            $('#btn-submit').prop('disabled', false);
                        });
                    }
                }
            });
        });
    });
</script>
@endsection