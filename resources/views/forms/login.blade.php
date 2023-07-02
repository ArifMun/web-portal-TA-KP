<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <title>PORTAL TA-KP</title>
  <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
  <link rel="icon" href="/assets/img/psti.png" type="image/x-icon" />

  <!-- Fonts and icons -->
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

  <!-- CSS Files -->
  <link rel="stylesheet" href="/assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="/assets/css/azzara.min.css">
</head>


<body class="login">
  <h4 class="text-center"><a href="home/jadwal-sidang">JADWAL SIDANG</a></h4>
  <div class="wrapper wrapper-login border">
    {{-- <h3 class="text-center">WEB PORTAL TUGAS AKHIR DAN KERJA PRAKTIK</h3> --}}
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

</html>
@include('sweetalert::alert')