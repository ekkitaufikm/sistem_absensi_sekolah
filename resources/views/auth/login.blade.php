
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Cuba admin is super flexible, powerful, clean &amp; modern responsive bootstrap 5 admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, Cuba admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="pixelstrap">
    <link rel="icon" href="{{ url('') }}/assets/images/logo_nuris.png" type="image/x-icon">
    <link rel="shortcut icon" href="{{ url('') }}/assets/images/logo_nuris.png" type="image/x-icon">
    <title>Login | {{ config('app.name') }}</title>
    <!-- Google font-->
    <link href="https://fonts.googleapis.com/css?family=Rubik:400,400i,500,500i,700,700i&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i,900&amp;display=swap" rel="stylesheet">
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
    <!-- Plugins css Ends-->
    <!-- Bootstrap css-->
    <link rel="stylesheet" type="text/css" href="{{ url('') }}/assets/css/vendors/bootstrap.css">
    <!-- App css-->
    <link rel="stylesheet" type="text/css" href="{{ url('') }}/assets/css/style.css">
    <link id="color" rel="stylesheet" href="{{ url('') }}/assets/css/color-1.css" media="screen">
    <!-- Responsive css-->
    <link rel="stylesheet" type="text/css" href="{{ url('') }}/assets/css/responsive.css">
  </head>
  <body>
    <!-- login page start-->
    <div class="container-fluid">
      <div class="row">
        <div class="col-xl-7"><img class="bg-img-cover bg-center" src="{{ url('') }}/assets/images/logo_nuris.png" alt="looginpage"></div>
        <div class="col-xl-5 p-0">
          <div class="login-card login-dark">
            <div class="login-main"> 
                <form class="theme-form" action="{{ route('login') }}" method="POST">
                    @csrf   
                    <h4>Login</h4>
                    <p>Masukkan Username dan Password untuk login!</p>
                    <!-- Alerts-->
                    @if (session()->has('sukses'))
                    <div class="alert alert-success dark alert-dismissible fade show" role="alert">
                        {{ session('sukses') }}
                    </div>
                    @elseif (session()->has('gagal'))
                    <div class="alert alert-danger dark alert-dismissible fade show" role="alert">
                        {{ session('gagal') }}
                    </div>
                    @endif
                    <div class="form-group">
                        <label class="col-form-label">Username</label>
                        <input class="form-control" type="text" name="username" placeholder="Username" required>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label">Password</label>
                        <div class="form-input position-relative">
                        <input class="form-control" type="password" name="password" placeholder="*********" required>
                        <div class="show-hide"><span class="show"></span></div>
                        </div>
                    </div>
                    <div class="form-group mb-0">
                        <button class="btn btn-primary btn-block w-100" type="submit">Sign in</button>
                    </div>
                </form>
              </div>
          </div>
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
      <!-- Sidebar jquery-->
      <script src="{{ url('') }}/assets/js/config.js"></script>
      <!-- Plugins JS start-->
      <!-- Plugins JS Ends-->
      <!-- Theme js-->
      <script src="{{ url('') }}/assets/js/script.js"></script>
      <script src="{{ url('') }}/assets/js/script1.js"></script>
    </div>
  </body>
</html>