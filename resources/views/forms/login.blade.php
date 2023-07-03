{{--
<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <title>PORTAL TA-KP</title>
  <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
  <link rel="icon" href="/assets/img/psti.png" type="image/x-icon" />

  <script src="/assets/js/plugin/webfont/webfont.min.js"></script>
  <script>
    WebFont.load({
            google: {
                "families": ["Open+Sans:300,400,600,700"]
            },
            custom: {
                "families": ["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular",
                    "Font Awesome 5 Brands"
                ],
                urls: ['/assets/css/fonts.css']
            },
            active: function () {
                sessionStorage.fonts = true; 
            }
        });

  </script>

  <link rel="stylesheet" href="/assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="/assets/css/azzara.min.css">
</head>


<body class="login">
  <h4 class="text-center"><a href="home/jadwal-sidang">JADWAL SIDANG</a></h4>
  <div class="wrapper wrapper-login border">
    <div class="container container-login">
      <h3 class="text-center">SILAHKAN MASUK</h3>
      <form method="POST" action="{{url('login-process')}}">
        @csrf
        <div class="login-form">
          <div class="form-group form-floating-label">
            <input id="username" name="username" type="text" class="form-control input-border-bottom" required
              autofocus>
            <label for="username" class="placeholder">Username</label>
          </div>
          <div class="form-group form-floating-label">
            <input id="password" name="password" type="password" class="form-control input-border-bottom" required>
            <label for="password" class="placeholder">Password</label>
            <div class="show-password">
              <i class="flaticon-interface"></i>
            </div>
          </div>
          <div class="form-group">
            <p class="col">Gunakan NIM/NIP sebagai Username</p>
          </div>
          <div class="form-action mb-3">
            <button type="submit" class="btn btn-primary btn-rounded btn-login">Masuk</button>
          </div>
      </form>
      <div class="login-account">
        <a href="user-registrasi" class="link">Registrasi</a>
      </div>
    </div>
  </div>
  <script src="/assets/js/core/jquery.3.2.1.min.js"></script>
  <script src="/assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
  <script src="/assets/js/core/popper.min.js"></script>
  <script src="/assets/js/core/bootstrap.min.js"></script>
  <script src="/assets/js/ready.js"></script>
</body>

</html> --}}
<!DOCTYPE html>
<html lang="en">

<head>
  <title>Login V1</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!--===============================================================================================-->
  <link rel="icon" type="image/png" href="images/icons/favicon.ico" />
  <!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="/assets/login/vendor/bootstrap/css/bootstrap.min.css">
  <!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="/assets/login/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
  <!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="/assets/login/vendor/animate/animate.css">
  <!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="/assets/login/vendor/css-hamburgers/hamburgers.min.css">
  <!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="/assets/login/vendor/select2/select2.min.css">
  <!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="/assets/login/css/util.css">
  <link rel="stylesheet" type="text/css" href="/assets/login/css/main.css">
  <!--===============================================================================================-->
</head>

<body>

  <div class="limiter">
    <div class="container-login100">
      <div class="wrap-login100">
        <div class="login100-pic js-tilt" data-tilt>
          <img src="/assets/img/psti.png">
        </div>

        <form class="login100-form validate-form" method="POST" action="{{url('login-process')}}">
          @csrf
          <span class="login100-form-title">
            Silahkan Masuk
          </span>

          <div class="wrap-input100 validate-input" data-validate="Valid email is required: ex@abc.xyz">
            <input class="input100" type="text" name="username" placeholder="Username">
            <span class="focus-input100"></span>
            <span class="symbol-input100">
              <i class="fa fa-envelope" aria-hidden="true"></i>
            </span>
          </div>

          <div class="wrap-input100 validate-input" data-validate="Password is required">
            <input class="input100" type="password" name="password" placeholder="Password">
            <span class="focus-input100"></span>
            <span class="symbol-input100">
              <i class="fa fa-lock" aria-hidden="true"></i>
            </span>
          </div>

          <div class="container-login100-form-btn">
            <button type="submit" class="login100-form-btn">
              MASUK
            </button>
          </div>

          <div class="text-center p-t-12">
            <a class="txt2" href="user-registrasi">
              Registrasi
            </a>
          </div>

          <div class="text-center p-t-50">
            <a class="txt2" href="/home/jadwal-sidang">
              Jadwal Sidang Tugas Akhir
              <i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
            </a>
          </div>
        </form>
      </div>
    </div>
  </div>




  <!--===============================================================================================-->
  <script src="/assets/login/vendor/jquery/jquery-3.2.1.min.js"></script>
  <!--===============================================================================================-->
  <script src="/assets/login/vendor/bootstrap/js/popper.js"></script>
  <script src="/assets/login/vendor/bootstrap/js/bootstrap.min.js"></script>
  <!--===============================================================================================-->
  <script src="/assets/login/vendor/select2/select2.min.js"></script>
  <!--===============================================================================================-->
  <script src="/assets/login/vendor/tilt/tilt.jquery.min.js"></script>
  <script>
    $('.js-tilt').tilt({
			scale: 1.1
		})
  </script>
  <!--===============================================================================================-->
  <script src="/assets/login/js/main.js"></script>

</body>

</html>
@include('sweetalert::alert')