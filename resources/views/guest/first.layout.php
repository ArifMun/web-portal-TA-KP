<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="/assets/img/psti.png" type="image/x-icon" />
    <link rel="stylesheet" href="/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/css/azzara.min.css">
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
    {{-- <title>JADWAL SIDANG</title> --}}
</head>

<body>

    <div class="wrapper">
        <div class="main-header" data-background-color="dark">
            <nav class="navbar navbar-expand-lg ">
                <div class="container-fluid">
                    <a class="navbar-brand" href="jadwal-sidang"><img src="/assets/img/psti-logo.png" alt="navbar brand"
                            class="navbar-brand" width="170px"></a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false"
                        aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                        <ul class="navbar-nav ml-auto">
                            {{-- @if(Auth::user()->level =='' || null) --}}

                            @auth

                            <li>
                                <b><a class="nav-link text-white" href="/dashboard">Dashboard</a></b>
                            </li>
                            <li>
                                <a class="nav-link text-white" href="/logout"><i class="fa fa-arrow-circle-left"></i>
                                    Logout</a>
                            </li>
                            @else
                            <li>
                                <a class="nav-link text-white" href="/"><i class="fa fa-arrow-circle-right"></i>
                                    Login
                            </li>
                            </a>
                            @endauth
                        </ul>
                    </div>
                </div>
            </nav>
        </div>

        @yield('content')
    </div>
</body>
{{-- <footer>ssasfdfds</footer> --}}
<!--   Core JS Files   -->
<script src="/assets/js/core/jquery.3.2.1.min.js"></script>
<script src="/assets/js/core/popper.min.js"></script>
<script src="/assets/js/core/bootstrap.min.js"></script>
<!-- jQuery UI -->
<script src="/assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
<script src="/assets/js/plugin/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js"></script>
<!-- Bootstrap Toggle -->
<script src="/assets/js/plugin/bootstrap-toggle/bootstrap-toggle.min.js"></script>
<!-- jQuery Scrollbar -->
<script src="/assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>
<!-- Datatables -->
<script src="/assets/js/plugin/datatables/datatables.min.js"></script>
<!-- Azzara JS -->
<script src="/assets/js/ready.min.js"></script>
<!-- Azzara DEMO methods, don't include it in your project! -->
<script src="/assets/js/setting-demo.js"></script>
<script>
    $(document).ready(function () {
        $('#add-row').DataTable({

        });
    });

</script>

</html>