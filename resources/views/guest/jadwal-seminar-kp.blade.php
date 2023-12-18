@extends('guest.layout')

@section('content')
<style>
    .divider {
        width: 100%;
        height: 2px;
        background: #BBB;
        margin: 1rem 0;
        margin-top: -5px;
    }
</style>

<div class="sidebar">
    <div class="sidebar-background"></div>
    <div class="sidebar-wrapper scrollbar-inner">
        <div class="sidebar-content">
            <ul class="nav">
                @if (empty($pengumuman->cttn_seminar_kp))
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
                        <span style="margin: -20px 0 0 0px">{!! $pengumuman->cttn_seminar_kp !!}</span>
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
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <h4 class="card-title text-center">JADWAL SEMINAR KERJA PRAKTIK</h4>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="col-sm-6 col-md-3">
                                <div class="row align-items-center">
                                    <div class="col col-stats ml-3 ml-sm-0">
                                        <div class="filter tahun">
                                            <label class="font-weight-bold h6">Filter Tahun</label>
                                            <select data-column="5" class="form-control" id="filter-tahun">
                                                <option value="">-- Pilih Tahun --</option>
                                                @foreach ($thn_akademik as $k)
                                                <option value="{{ $k->tahun }}">{{ $k->tahun }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="dropdown-divider"></div>
                            <div class="table-responsive">
                                <table id="daftar-pembimbing" class="display table table-striped table-hover">
                                    <thead>
                                        <tr align="center">
                                            <th>No</th>
                                            <th>NIM</th>
                                            <th>Nama</th>
                                            <th>Judul</th>
                                            <th>Dosen Pembimbing</th>
                                            <th>Tanggal Seminar</th>
                                            <th>Jam Seminar</th>
                                            <th>Tempat Seminar</th>
                                            <th>Status</th>
                                            <th>Tahun Akademik</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @php $no=1; @endphp
                                        @foreach ($seminarkp as $item)
                                        <tr class="text-capitalize text-center">
                                            <td>{{ $no++ }}</td>
                                            <td class="text-left">{{ $item->daftarkp->mahasiswa->biodata->no_induk}}
                                            </td>
                                            <td class="text-left">{{ $item->daftarkp->mahasiswa->biodata->nama}}</td>
                                            <td>{{ $item->judul}}</td>
                                            <td class="text-capitalize text-left">
                                                @foreach ($dosen as $k)
                                                {{ $k->id == $item->daftarkp->d_pembimbing_1 ?
                                                $k->biodata->nama :''
                                                }}
                                                @endforeach
                                            </td>
                                            <td>{{
                                                Carbon\Carbon::parse($item->tgl_seminar)->locale('id')->translatedformat('l,
                                                d
                                                F
                                                Y')}}
                                            </td>
                                            <td>{{
                                                Carbon\Carbon::parse($item->jam_seminar)->locale('id')->format('H:i')}}
                                                WIB
                                            </td>
                                            <td>{{ $item->tempat_seminar }}</td>
                                            @if ($item->stts_seminar=='proses')
                                            <td>
                                                <a
                                                    class="font-weight-bold text-light text-capitalize badge badge-warning">
                                                    {{
                                                    $item->stts_seminar }}</a>
                                            </td>
                                            @elseif($item->stts_seminar=='selesai')
                                            <td>
                                                <a
                                                    class="font-weight-bold text-light text-capitalize badge badge-success">
                                                    {{
                                                    $item->stts_seminar }}</a>
                                            </td>
                                            @else
                                            <td>
                                                <a
                                                    class="font-weight-bold text-light text-capitalize badge badge-primary">
                                                    {{
                                                    $item->stts_seminar }}</a>
                                            </td>
                                            @endif
                                            <td>{{ $item->daftarkp->tahunakademik->tahun }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<script src="/assets/js/core/jquery.3.2.1.min.js"></script>
<script src="/assets/js/native/filter-tahun.js"></script>
<script>
    $(document).ready(function() {
            $('#daftar-pembimbing').DataTable({
                $("#filter-tahun").change(function () {
                table.column($(this).data("column")).search($(this).val()).draw();
                });
            });
        });

</script>
@endsection