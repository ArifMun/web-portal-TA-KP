<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="/assets/img/psti.png" type="image/x-icon" />
    <link rel="stylesheet" href="/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/css/azzara.min.css">
    <link rel="stylesheet" href="/assets/css/mandatory.css">
    <link rel="stylesheet" href="/assets/css/select2.min.css">
    {{--
    <link rel="stylesheet" href="/assets/css/layout.scss"> --}}
    <link rel="stylesheet" href="/assets/css/select2-bootstrap.min.css">

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
            active: function() {
                sessionStorage.fonts = true;
            }
        });
    </script>
    {{-- <title>{{ $title }}</title> --}}
</head>

<body>
    <div class="wrapper">
        <!--
			Tip 1: You can change the background color of the main header using: data-background-color="blue | purple | light-blue | green | orange | red"
		-->
        <div class="main-header" data-background-color="dark">
            <!-- Logo Header -->
            <div class="logo-header">

                <a href="index.html" class="logo">
                    <img src="/assets/img/psti-logo.png" alt="navbar brand" class="navbar-brand" width="170px">
                </a>
                <button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse"
                    data-target="collapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon">
                        <i class="fa fa-bars"></i>
                    </span>
                </button>
                <button class="topbar-toggler more"><i class="fa fa-ellipsis-v"></i></button>
                <div class="navbar-minimize">
                    <button class="btn btn-minimize btn-rounded">
                        <i class="fa fa-bars"></i>
                    </button>
                </div>
            </div>
            <!-- End Logo Header -->

            <!-- Navbar Header -->
            @include('layouts.header')
            <!-- End Navbar -->
        </div>

        <!-- Sidebar -->
        @include('layouts.sidebar')
        <!-- End Sidebar -->

        @yield('content')

        @include('layouts.footer')
    </div>

    <script src="/assets/js/core/jquery.3.2.1.min.js"></script>
    <script src="/assets/js/select2.min.js"></script>
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
        $(document).ready(function() {
            $('#add-row').DataTable({

            });
        });

    
    </script>

    {{-- <script>
        var multipleLineChart = document.getElementById('multipleLineChart').getContext('2d');
        // var total = {{ Js::from($datakp) }};
        var myMultipleLineChart = new Chart(multipleLineChart, {
			type: 'line',
			data: {
				labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
				datasets: [{
					label: "2021",
					borderColor: "#1d7af3",
					pointBorderColor: "#FFF",
					pointBackgroundColor: "#1d7af3",
					pointBorderWidth: 2,
					pointHoverRadius: 4,
					pointHoverBorderWidth: 1,
					pointRadius: 4,
					backgroundColor: 'transparent',
					fill: true,
					borderWidth: 2,
					data: [{{ $datakp}}]
				}]
			},
			options : {
				responsive: true, 
				maintainAspectRatio: false,
				legend: {
					position: 'top',
				},
				tooltips: {
					bodySpacing: 4,
					mode:"nearest",
					intersect: 0,
					position:"nearest",
					xPadding:10,
					yPadding:10,
					caretPadding:10
				},
				layout:{
					padding:{left:15,right:15,top:15,bottom:15}
				}
			}
		});

    </script> --}}
</body>

</html>
@include('sweetalert::alert')