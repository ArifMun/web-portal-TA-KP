@extends('guest.layout')

@section('content')
<style>
    .divider {
        width: 100%;
        height: 2px;
        background: #BBB;
        /* margin: 1rem 0; */
        margin-top: -5px;
    }

    a:hover {
        /* Atur properti CSS sesuai kebutuhan */
        color: #808080;
        /* Contoh: warna teks saat dihover */
        font-weight: normal;
        /* Contoh: gaya teks saat dihover */
    }
</style>
<div class="sidebar">
    <div class="sidebar-background"></div>
    <div class="sidebar-wrapper scrollbar-inner">
        <div class="sidebar-content">
            <ul class="nav">

                @if (empty($pengumuman->cttn_utama))
                <li class="nav-item mr-2">
                    <a>
                        <span class="text-center text-dark font-weight-bold h2">Tidak ada Pengumuman</span>
                    </a>
                </li>
                @else
                <li class="nav-item mr-2">
                    <a>
                        <span class="text-center text-dark font-weight-bold h2">PENGUMUMAN</span>
                    </a>
                    <a>
                        <span class="divider"></span>
                    </a>
                    <a href="">
                        <span style="margin: -10px 0 0 0px">{!! $pengumuman->cttn_utama !!}</span>
                    </a>
                </li>
                @endif
            </ul>
        </div>
    </div>
</div>

<div class="main-panel">
    <div class="content">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">Home</h4>
            </div>
            <div class="row">
                <div class="col-sm-6 col-md-3">
                    <div class="card card-stats card-round">
                        <div class="card-body ">
                            <div class="row align-items-center">
                                <div class="col-icon">
                                    <div class="icon-big text-center icon-primary bubble-shadow-small">
                                        <i class="fas fa-users"></i>
                                    </div>
                                </div>
                                <div class="col col-stats ml-3 ml-sm-0">
                                    <div class="numbers">
                                        <p class="card-category">Kerja Praktik</p>
                                        <h4 class="card-title">{{ $notifAcc }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-3">
                    <div class="card card-stats card-round">
                        <div class="card-body ">
                            <div class="row align-items-center">
                                <div class="col-icon">
                                    <div class="icon-big text-center icon-primary bubble-shadow-small">
                                        <i class="fas fa-chalkboard-teacher"></i>
                                    </div>
                                </div>
                                <div class="col col-stats ml-3 ml-sm-0">
                                    <div class="numbers">
                                        <p class="card-category">Seminar Kerja Praktik</p>
                                        <h4 class="card-title">{{ $seminar }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-3">
                    <div class="card card-stats card-round">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-icon">
                                    <div class="icon-big text-center icon-success bubble-shadow-small">
                                        <i class="fas fa-users"></i>
                                    </div>
                                </div>
                                <div class="col col-stats ml-3 ml-sm-0">
                                    <div class="numbers">
                                        <p class="card-category">Tugas Akhir</p>
                                        <h4 class="card-title">{{ $TAditerima }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-3">
                    <div class="card card-stats card-round">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-icon">
                                    <div class="icon-big text-center icon-success bubble-shadow-small">
                                        <i class="fas fa-chalkboard-teacher"></i>
                                    </div>
                                </div>
                                <div class="col col-stats ml-3 ml-sm-0">
                                    <div class="numbers">
                                        <p class="card-category">Sidang Tugas Akhir</p>
                                        <h4 class="card-title">{{ $sidang }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <ul class="nav nav-pills nav-secondary" id="pills-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="pills-home-tab" data-toggle="pill"
                                        href="#kerja-praktik" role="tab" aria-controls="pills-home"
                                        aria-selected="true">KERJA PRAKTIK</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#tugas-akhir"
                                        role="tab" aria-controls="pills-profile" aria-selected="false">TUGAS AKHIR</a>
                                </li>
                            </ul>
                        </div>
                        {{-- <div class="card-header">
                            <div class="card-title">Kerja Praktik</div>
                        </div> --}}
                        <div class="tab-content mt-2 mb-3" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="kerja-praktik" role="tabpanel"
                                aria-labelledby="pills-home-tab">
                                <div class="card-body">
                                    <div class="chart-container">
                                        <canvas id="multipleLineChart"></canvas>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade show " id="tugas-akhir" role="tabpanel"
                                aria-labelledby="pills-home-tab">
                                <div class="card-body">
                                    <div class="chart-container">
                                        <canvas id="multipleLineChartTA"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Buku Panduan</div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="tabel-dokumen" class="display table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Dokumen</th>
                                            <th>Dokumen</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                        $no=1;
                                        @endphp
                                        @foreach ($dokumen as $item)
                                        <tr class="text-center">
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $item->nama_dokumen }}</td>
                                            <td>
                                                @if($item->file_dokumen == NULL)

                                                @else
                                                <a href=" {{asset('storage/' . $item->file_dokumen)}}"
                                                    target="_blank"><i class="fas fa-file-pdf fa-2x">
                                                    </i>
                                                </a>
                                                @endif
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            {{-- <div class="card-body">
                                <div class="chart-container">
                                    <canvas id="multipleLineChartTA"></canvas>
                                </div>
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<script src="/assets/js/plugin/chart.js/chart.min.js">
</script>
<script src="/assets/js/core/jquery.3.2.1.min.js"></script>
<script>
    $(document).ready(function () { var table = $("#tabel-dokumen").DataTable({}); });
</script>
<script>
    var multipleLineChart = document.getElementById('multipleLineChart').getContext('2d');
        var tahunAkademik = {!! json_encode($tahunAkademik) !!};
        var dataSeminarKP = {!! json_encode($dataSeminarKP) !!};
        var dataDaftarKP  = {!! json_encode($dataDaftarKP) !!};
        var myMultipleLineChart = new Chart(multipleLineChart, {
			type: 'line',
			data: {
				labels:tahunAkademik,
				datasets: [{
					label: "Selesai ",
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
					data: dataSeminarKP,
				},{
                    label: "Pendaftar",
                    borderColor: "#59d05d",
                    pointBorderColor: "#FFF",
                    pointBackgroundColor: "#59d05d",
                    pointBorderWidth: 2,
                    pointHoverRadius: 4,
                    pointHoverBorderWidth: 1,
                    pointRadius: 4,
                    backgroundColor: 'transparent',
                    fill: true,
                    borderWidth: 2,
                    data: dataDaftarKP,
                    }
                ]
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
					intersect: 1,
					position:"nearest",
					xPadding:10,
					yPadding:10,
					caretPadding:10,
				},
				layout:{
					padding:{left:15,right:15,top:15,bottom:15}
				}
			}
		});

</script>
<script>
    var multipleLineChart = document.getElementById('multipleLineChartTA').getContext('2d');
        var tahunAkademik = {!! json_encode($tahunAkademik) !!};
        var dataSidangTA  = {!! json_encode($dataSidangTA) !!};
        var dataDaftarTA  = {!! json_encode($dataDaftarTA) !!};
        var myMultipleLineChart = new Chart(multipleLineChart, {
			type: 'line',
			data: {
				labels:tahunAkademik,
				datasets: [{
					label: "Selesai ",
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
					data: dataSidangTA,
				},{
                    label: "Pendaftar",
                    borderColor: "#59d05d",
                    pointBorderColor: "#FFF",
                    pointBackgroundColor: "#59d05d",
                    pointBorderWidth: 2,
                    pointHoverRadius: 4,
                    pointHoverBorderWidth: 1,
                    pointRadius: 4,
                    backgroundColor: 'transparent',
                    fill: true,
                    borderWidth: 2,
                    data: dataDaftarTA,
                    }
                ]
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
					intersect: 1,
					position:"nearest",
					xPadding:10,
					yPadding:10,
					caretPadding:10,
				},
				layout:{
					padding:{left:15,right:15,top:15,bottom:15}
				}
			}
		});

</script>
@endsection