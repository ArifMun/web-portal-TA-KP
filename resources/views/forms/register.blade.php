<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Portal TA-KP</title>
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
    <div class="wrapper wrapper-login">
        <div class="container container-signup animated fadeIn">
            <h3 class="text-center">REGISTRASI</h3>
            <form action="register-proccess" enctype="multipart/form-data" method="POST">
                @csrf
                <div class="login-form">
                    <div class="form-group form-floating-label">
                        <input id="nama" name="nama" type="text" class="form-control input-border-bottom" required>
                        <label for="nama" class="placeholder">Nama</label>
                    </div>
                    <div class="form-group form-floating-label">
                        <input id="no_induk" name="no_induk" type="number" class="form-control input-border-bottom"
                            required>
                        <label for="no_induk" class="placeholder">No Induk</label>
                    </div>
                    <div class="form-group form-floating-label">
                        <input id="tempat_lahir" name="tempat_lahir" type="text"
                            class="form-control input-border-bottom">
                        <label for="tempat_lahir" class="placeholder">Tempat Lahir</label>
                    </div>
                    <div class="form-group form-floating-label">
                        <label for="tgl_lahir">Tanggal Lahir</label>
                        <input id="tgl_lahir" name="tgl_lahir" type="date" class="form-control input-border-bottom">
                    </div>
                    <div class="form-group form-floating-label">
                        <input id="no_telp" name="no_telp" type="text" class="form-control input-border-bottom"
                            required>
                        <label for="no_telp" class="placeholder">No WA</label>
                    </div>
                    <div class="form-group form-floating-label">
                        <input id="email" name="email" type="text" class="form-control input-border-bottom" required>
                        <label for="email" class="placeholder">Email</label>
                    </div>
                    <div class="form-group form-floating-label">
                        <input id="alamat" name="alamat" type="text" class="form-control input-border-bottom" required>
                        <label for="alamat" class="placeholder">Alamat</label>
                    </div>
                    <div class="form-group form-floating-label">
                        <input id="password" name="password" type="password" class="form-control input-border-bottom"
                            required>
                        <label for="password" class="placeholder">Password</label>
                    </div>
                    <input name="level" type="hidden" value="0">
                    <input name="jabatan" type="hidden" value="mahasiswa">
                    {{-- <input name="id_biodata" type="hidden" value=""> --}}
                    <div class="form-action">
                        <a href="/" id="show-signin" class="btn btn-danger btn-rounded btn-login mr-3">Cancel</a>
                        <button type="submit" class="btn btn-primary btn-rounded btn-login">Registrasi</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>

</html>
@include('sweetalert::alert')