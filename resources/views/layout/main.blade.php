
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Cuba admin is super flexible, powerful, clean &amp; modern responsive bootstrap 5 admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, Cuba admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="pixelstrap">
    <link rel="icon" href="{{ url('') }}/assets/images/favicon.png" type="image/x-icon">
    <link rel="shortcut icon" href="{{ url('') }}/assets/images/favicon.png" type="image/x-icon">
    <title>{{ config('app.name') }}</title>
    <!-- Google font-->
    <link href="https://fonts.googleapis.com/css?family=Rubik:400,400i,500,500i,700,700i&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i,900&amp;display=swap" rel="stylesheet">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&display=swap" rel="stylesheet">

    <!-- Font Awesome-->
    <link rel="stylesheet" type="text/css" href="{{ url('') }}/assets/css/fontawesome.css">
    <!-- ico-font-->
    <link rel="stylesheet" type="text/css" href="{{ url('') }}/assets/css/vendors/icofont.css">
    <!-- Themify icon-->
    <link rel="stylesheet" type="text/css" href="{{ url('') }}/assets/css/vendors/themify.css">
    <!-- Flag icon-->
    <link rel="stylesheet" type="text/css" href="{{ url('') }}/assets/css/vendors/flag-icon.css">
    <!-- Feather icon-->
    <link rel="stylesheet" type="text/css" href="{{ url('') }}/assets/css/vendors/feather-icon.css">
    <!-- Plugins css start-->
    <link rel="stylesheet" type="text/css" href="{{ url('') }}/assets/css/vendors/slick.css">
    <link rel="stylesheet" type="text/css" href="{{ url('') }}/assets/css/vendors/slick-theme.css">
    <link rel="stylesheet" type="text/css" href="{{ url('') }}/assets/css/vendors/scrollbar.css">
    <link rel="stylesheet" type="text/css" href="{{ url('') }}/assets/css/vendors/animate.css">
    <link rel="stylesheet" type="text/css" href="{{ url('') }}/assets/css/vendors/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="{{ url('') }}/assets/css/vendors/select.bootstrap5.css">
    <link rel="stylesheet" type="text/css" href="{{ url('') }}/assets/css/vendors/flatpickr/flatpickr.min.css">
    <link rel="stylesheet" type="text/css" href="{{ url('') }}/assets/css/vendors/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="{{ url('') }}/assets/css/vendors/dataTables.bootstrap5.css">
    <!-- Plugins css Ends-->
    <!-- Bootstrap css-->
    <link rel="stylesheet" type="text/css" href="{{ url('') }}/assets/css/vendors/bootstrap.css">
    <!-- App css-->
    <link rel="stylesheet" type="text/css" href="{{ url('') }}/assets/css/style.css">
    <link id="color" rel="stylesheet" href="{{ url('') }}/assets/css/color-1.css" media="screen">
    <!-- Responsive css-->
    <link rel="stylesheet" type="text/css" href="{{ url('') }}/assets/css/responsive.css">
    <script src="http://maps.googleapis.com/maps/api/js"></script>
    <script>
      // variabel global marker
      var marker;
      
      function taruhMarker(peta, posisiTitik){
          
          if( marker ){
          // pindahkan marker
          marker.setPosition(posisiTitik);
          } else {
          // buat marker baru
          marker = new google.maps.Marker({
              position: posisiTitik,
              map: peta
          });
          }
      
          // isi nilai koordinat ke form
          document.getElementById("lat").value = posisiTitik.lat();
          document.getElementById("lng").value = posisiTitik.lng();
          
      }
      
      function initialize() {
      var propertiPeta = {
          center:new google.maps.LatLng(-7.604843000, 110.7968060),
          zoom:9,
          mapTypeId:google.maps.MapTypeId.ROADMAP
      };
      
      var peta = new google.maps.Map(document.getElementById("googleMap"), propertiPeta);
      
      // even listner ketika peta diklik
      google.maps.event.addListener(peta, 'click', function(event) {
          taruhMarker(this, event.latLng);
      });

      }


      // event jendela di-load  
      google.maps.event.addDomListener(window, 'load', initialize);
    </script>

    @yield('css-library')
    @yield('css-custom')
  </head>
  <body onload="startTime()"> 
    <!-- loader starts-->
    <div class="loader-wrapper">
      <div class="loader-index"> <span></span></div>
      <svg>
        <defs></defs>
        <filter id="goo">
          <fegaussianblur in="SourceGraphic" stddeviation="11" result="blur"></fegaussianblur>
          <fecolormatrix in="blur" values="1 0 0 0 0  0 1 0 0 0  0 0 1 0 0  0 0 0 19 -9" result="goo"> </fecolormatrix>
        </filter>
      </svg>
    </div>
    <!-- loader ends-->
    <!-- tap on top starts-->
    <div class="tap-top"><i data-feather="chevrons-up"></i></div>
    <!-- tap on tap ends-->
    <!-- page-wrapper Start-->
    <div class="page-wrapper compact-wrapper" id="pageWrapper">
      <!-- Page Header Start-->
      <div class="page-header">
        @include('layout.header')
      </div>
      <!-- Page Header Ends -->
      <!-- Page Body Start -->
      <div class="page-body-wrapper">
        <!-- Page Sidebar Start-->
        @include('layout.sidebar')
        <!-- Page Sidebar Ends-->
        @yield('content')
        <!-- footer start-->
        <footer class="footer">
          <div class="container-fluid">
            <div class="row">
              <div class="col-md-12 footer-copyright text-center">
                <p class="mb-0">Copyright <span class="year-update"> </span> ©{{ date('Y')}} | SMP Nurul Islam </p>
              </div>
            </div>
          </div>
        </footer>
      </div>
    </div>
    <!-- latest jquery-->
    <script src="{{ url('') }}/assets/js/jquery.min.js"></script>
    <!-- Bootstrap js-->
    <script src="{{ url('') }}/assets/js/bootstrap/bootstrap.bundle.min.js"></script>
    <!-- feather icon js-->
    <script src="{{ url('') }}/assets/js/icons/feather-icon/feather.min.js"></script>
    <script src="{{ url('') }}/assets/js/icons/feather-icon/feather-icon.js"></script>
    <!-- scrollbar js-->
    <script src="{{ url('') }}/assets/js/scrollbar/simplebar.min.js"></script>
    <script src="{{ url('') }}/assets/js/scrollbar/custom.js"></script>
    <!-- Sidebar jquery-->
    <script src="{{ url('') }}/assets/js/config.js"></script>
    <!-- Plugins JS start-->
    <script src="{{ url('') }}/assets/js/sidebar-menu.js"></script>
    <script src="{{ url('') }}/assets/js/sidebar-pin.js"></script>
    <script src="{{ url('') }}/assets/js/clock.js"></script>
    <script src="{{ url('') }}/assets/js/slick/slick.min.js"></script>
    <script src="{{ url('') }}/assets/js/slick/slick.js"></script>
    <script src="{{ url('') }}/assets/js/header-slick.js"></script>
    <script src="{{ url('') }}/assets/js/chart/apex-chart/apex-chart.js"></script>
    <script src="{{ url('') }}/assets/js/chart/apex-chart/stock-prices.js"></script>
    <script src="{{ url('') }}/assets/js/counter/counter-custom.js"></script>
    <script src="{{ url('') }}/assets/js/notify/bootstrap-notify.min.js"></script>
    <script src="{{ url('') }}/assets/js/dashboard/default.js"></script>
    <script src="{{ url('') }}/assets/js/notify/index.js"></script>
    <script src="{{ url('') }}/assets/js/datatable/datatables/jquery.dataTables.min.js"></script>
    <script src="{{ url('') }}/assets/js/datatable/datatables/dataTables.js"></script>
    <script src="{{ url('') }}/assets/js/datatable/datatables/dataTables.select.js"></script>
    <script src="{{ url('') }}/assets/js/datatable/datatables/select.bootstrap5.js"></script>
    <script src="{{ url('') }}/assets/js/datatable/datatables/datatable.custom.js"></script>
    <script src="{{ url('') }}/assets/js/typeahead/handlebars.js"></script>
    <script src="{{ url('') }}/assets/js/typeahead/typeahead.bundle.js"></script>
    <script src="{{ url('') }}/assets/js/typeahead/typeahead.custom.js"></script>
    <script src="{{ url('') }}/assets/js/typeahead-search/handlebars.js"></script>
    <script src="{{ url('') }}/assets/js/typeahead-search/typeahead-custom.js"></script>
    <script src="{{ url('') }}/assets/js/flat-pickr/flatpickr.js"></script>
    <script src="{{ url('') }}/assets/js/flat-pickr/custom-flatpickr.js"></script>
    <script src="{{ url('') }}/assets/js/datatable/datatables/jquery.dataTables.min.js"></script>
    <script src="{{ url('') }}/assets/js/datatable/datatables/dataTables1.js"></script>
    <script src="{{ url('') }}/assets/js/datatable/datatables/dataTables.bootstrap5.js"></script>
    <script src="{{ url('') }}/assets/js/datatable/datatables/datatable.custom2.js"></script>
    <!-- maps JS start-->
    <script src="{{ url('') }}/assets/js/gmap.js"></script>
    <!-- Plugins JS Ends-->
    <!-- Theme js-->
    <script src="{{ url('') }}/assets/js/script.js"></script>
    <script src="{{ url('') }}/assets/js/script1.js"></script>
    {{-- <script src="{{ url('') }}/assets/js/theme-customizer/customizer.js"></script> --}}
    <!-- Sweetalert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @yield('js-library')
    @yield('js-custom')
  </body>
</html>