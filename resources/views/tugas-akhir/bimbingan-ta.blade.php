@extends('layouts.layout')

@section('content')

<style>
    .divider {
        width: 100%;
        height: 1px;
        background: #BBB;
        margin: 1rem 0;
    }

    .picture {
        padding: 5px 5px 5px 5px;
    }

    .colorMenunggu {
        padding: 3px 3px 3px 3px;
        background-color: red:
    }

    .form-group.required .control-label:after {
        content: "*";
        color: red;
    }
</style>

<div class="main-panel">
    <div class="content">
        <div class="page-inner">
            <div class="page-header d-flex justify-content-between">
                @if (Auth::user()->level==1)
                <h4 class="page-title ">Bimbingan Tugas Akhir [Dosen]</h4>
                @else
                <h4 class="page-title">Bimbingan Tugas Akhir [Mahasiswa]</h4>
                @endif
            </div>
            {{-- --}}

            {{-- --}}
            <div class="row" id="bimbingan-1">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <ul class="nav nav-pills nav-secondary" id="pills-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#bimbingan1"
                                        role="tab" aria-controls="pills-home" aria-selected="true">Bimbingan I</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#bimbingan2"
                                        role="tab" aria-controls="pills-profile" aria-selected="false">Bimbingan II</a>
                                </li>
                            </ul>
                        </div>

                        {{-- CARD BODY--}}
                        <div class="card-body">
                            <div class="tab-content mt-2 mb-3" id="pills-tabContent">
                                <div class="tab-pane fade show active" id="bimbingan1" role="tabpanel"
                                    aria-labelledby="pills-home-tab">
                                    @if (Auth::user()->level==0)
                                    <ul class="nav nav-pills nav-secondary  nav-pills-no-bd justify-content-center"
                                        id="pills-tab-with-icon" role="tablist">
                                        <li class="nav-item">
                                            <a href="cetak-form/bimbingan-ta-1"
                                                class="btn btn-success btn-round ml-auto" target="_blank">
                                                <i class="fas fa-print"></i>
                                                Cetak Form
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="/bimbingan-ta/tambah" class="btn btn-primary btn-round ml-auto"
                                                data-toggle="modal" data-target="#modalTambahBimbingan">
                                                <i class="fa fa-plus"></i>
                                                Tambah
                                            </a>
                                        </li>
                                    </ul>
                                    <div class="dropdown-divider"></div>
                                    @elseif(Auth::user()->level==1)
                                    @endif
                                    <div class="table-responsive">
                                        <table id="bimbingan-ta" class="display table table-striped table-hover">
                                            <thead>
                                                <tr align="center">
                                                    @if (Auth::user()->level==1)
                                                    <th>No</th>
                                                    <th>NIM</th>
                                                    <th>Nama</th>
                                                    <th>Jumlah Bimbingan</th>
                                                    <th>Judul Tugas Akhir</th>
                                                    <th>Tahun Akademik</th>
                                                    <th>Detail</th>
                                                    @endif

                                                    @if (Auth::user()->level==0)
                                                    <th>No</th>
                                                    <th>Dosen Pembimbing 1</th>
                                                    <th>Laporan TA</th>
                                                    <th>Status</th>
                                                    <th>Uraian Bimbingan</th>
                                                    <th>Tahun Akademik</th>
                                                    <th>Tgl Bimbingan</th>
                                                    <th>Action</th>
                                                    @endif

                                                </tr>
                                            </thead>

                                            @if (Auth::user()->level==0)
                                            <tbody>
                                                @php $no=1; @endphp
                                                @if (empty(Auth::user()->biodata->mahasiswa->daftarta->bimbinganta1))
                                                @foreach ($b_mhs_1 as $item)
                                                <tr align="center">
                                                    <td>{{ $no++ }}</td>
                                                    <td class="text-capitalize text-left">{{
                                                        $item->daftarta->dosen1->biodata->nama
                                                        }}
                                                    </td>
                                                    <td>
                                                        @if ($item->laporan_ta==NULL)
                                                        @else
                                                        <a href="storage/{{ $item->laporan_ta }}"><i
                                                                class="fas fa-file-download fa-2x">
                                                            </i>
                                                        </a>
                                                        @endif
                                                    </td>
                                                    @if ($item->stts == 'proses')
                                                    <td>
                                                        <a
                                                            class="font-weight-bold text-light text-capitalize badge badge-warning">
                                                            {{
                                                            $item->stts }}</a>
                                                    </td>
                                                    @elseif($item->stts == 'acc')
                                                    <td>
                                                        <a
                                                            class="font-weight-bold text-light text-capitalize badge badge-success">
                                                            {{
                                                            $item->stts}}</a>
                                                    </td>
                                                    @else
                                                    <td>
                                                        <a
                                                            class="font-weight-bold text-light text-capitalize badge badge-danger">
                                                            {{
                                                            $item->stts}}</a>
                                                    </td>
                                                    @endif
                                                    <td>{{ $item->catatan }}</td>
                                                    <td>{{ $item->daftarta->tahunakademik->tahun }}</td>
                                                    <td>{{
                                                        Carbon\Carbon::parse($item->tgl_bimbingan)->locale('id')->translatedformat('l,
                                                        d
                                                        F
                                                        Y')}}
                                                    </td>
                                                    <td>
                                                        <a href="/bimbingan-ta/edit/{{ $item->id }}" data-toggle="modal"
                                                            data-target="#EditBimbingan{{ $item->id }}"
                                                            class="btn btn-warning btn-xs"><i class="fa fa-edit">
                                                            </i> </a>
                                                        <a href="/bimbingan-ta/hapus/{{ $item->id }}"
                                                            data-toggle="modal"
                                                            data-target="#modalHapusBimbingan{{ $item->id }}"
                                                            class="btn btn-danger btn-xs"><i class="fa fa-trash">
                                                            </i> </a>
                                                    </td>
                                                </tr>
                                                @endforeach

                                                @else
                                                <tr>
                                                    <td colspan="13">
                                                        <p align="center"><i>Data Tidak Tersedia</i></p>
                                                    </td>
                                                </tr>
                                                @endif
                                            </tbody>

                                            @elseif(Auth::user()->level == 1)
                                            <tbody> @php $no=1; @endphp
                                                @foreach ($b_dosen_1 as $item)
                                                <tr align="center">
                                                    <td>{{ $no++ }}</td>
                                                    <td>{{ $item->daftarta->mahasiswa->biodata->no_induk }}</td>
                                                    <td class="text-left">{{ $item->daftarta->mahasiswa->biodata->nama
                                                        }}</td>
                                                    <td>{{ $item->where('daftar_ta_id', $item->daftar_ta_id)->count() }}
                                                    </td>
                                                    <td>{{ $item->daftarta->judul }}</td>
                                                    <td>{{ $item->daftarta->tahunakademik->tahun }}</td>
                                                    <td>
                                                        <a href="/bimbingan-ta/{{ $item->daftarta->id }}"
                                                            class="btn btn-primary btn-xs"><i class="fa fa-eye">
                                                            </i>
                                                        </a>
                                                    </td>
                                                </tr>
                                                @endforeach

                                            </tbody>
                                            @endif
                                        </table>
                                    </div>
                                </div>

                                {{-- BIMBINGAN 2 --}}
                                <div class="tab-pane fade" id="bimbingan2" role="tabpanel"
                                    aria-labelledby="pills-profile-tab">
                                    @if (Auth::user()->level==0)
                                    <ul class="nav nav-pills nav-secondary  nav-pills-no-bd justify-content-center"
                                        id="pills-tab-with-icon" role="tablist">
                                        <li class="nav-item">
                                            <a href="cetak-form/bimbingan-ta-2"
                                                class="btn btn-success btn-round ml-auto" target="_blank">
                                                <i class="fas fa-print"></i>
                                                Cetak Form
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="/bimbingan-ta-1/tambah" class="btn btn-primary btn-round ml-auto"
                                                data-toggle="modal" data-target="#modalTambahBimbingan1">
                                                <i class="fa fa-plus"></i>
                                                Tambah
                                            </a>
                                        </li>
                                    </ul>
                                    <div class="dropdown-divider"></div>
                                    @elseif(Auth::user()->level==1)
                                    @endif

                                    <div class="table-responsive">
                                        <table id="bimbingan-ta-1" class="display table table-striped table-hover">
                                            <thead>
                                                <tr align="center">
                                                    @if (Auth::user()->level==1)
                                                    <th>No</th>
                                                    <th>NIM</th>
                                                    <th>Nama</th>
                                                    <th>Jumlah Bimbingan</th>
                                                    <th>Judul Tugas Akhir</th>
                                                    <th>Tahun Akademik</th>
                                                    <th>Detail</th>
                                                    @endif

                                                    @if (Auth::user()->level==0)
                                                    <th>No</th>
                                                    <th>Dosen Pembimbing 2</th>
                                                    {{-- <th>Judul Bimbingan</th> --}}
                                                    <th>Laporan TA</th>
                                                    <th>Status</th>
                                                    <th>Uraian Bimbingan</th>
                                                    <th>Tahun Akademik</th>
                                                    {{-- <th>Author</th> --}}
                                                    <th>Tgl Bimbingan</th>
                                                    <th>Action</th>
                                                    @endif

                                                </tr>
                                            </thead>

                                            @if (Auth::user()->level==0)
                                            <tbody>
                                                @php $no=1; @endphp
                                                @if (empty(Auth::user()->biodata->mahasiswa->daftarta->bimbinganta2))
                                                @foreach ($b_mhs_2 as $item)
                                                <tr align="center">
                                                    <td>{{ $no++ }}</td>
                                                    <td class="text-capitalize text-left">{{
                                                        $item->daftarta->dosen2->biodata->nama
                                                        }}
                                                    </td>
                                                    {{-- <td>{{ $item->judul_bimbingan }}</td> --}}
                                                    <td>
                                                        @if ($item->laporan_ta == NULL)
                                                        @else
                                                        <a href="storage/{{ $item->laporan_ta }}"><i
                                                                class="fas fa-file-download fa-2x">
                                                            </i>
                                                        </a>
                                                        @endif
                                                    </td>
                                                    @if ($item->stts == 'proses')
                                                    <td>
                                                        <a
                                                            class="font-weight-bold text-light text-capitalize badge badge-warning">
                                                            {{
                                                            $item->stts }}</a>
                                                    </td>
                                                    @elseif($item->stts == 'acc')
                                                    <td>
                                                        <a
                                                            class="font-weight-bold text-light text-capitalize badge badge-success">
                                                            {{
                                                            $item->stts}}</a>
                                                    </td>
                                                    @else
                                                    <td>
                                                        <a
                                                            class="font-weight-bold text-light text-capitalize badge badge-danger">
                                                            {{
                                                            $item->stts}}</a>
                                                    </td>
                                                    @endif
                                                    <td> {{ \Illuminate\Support\Str::limit($item->catatan, 60) }}
                                                        @if (strlen($item->catatan) > 60)
                                                        <br>
                                                        {{ substr($item->catatan, 60) }}
                                                        @endif
                                                    </td>
                                                    <td>{{ $item->daftarta->tahunakademik->tahun }}</td>
                                                    {{-- <td>{{ $item->author }}</td> --}}
                                                    <td>{{
                                                        Carbon\Carbon::parse($item->tgl_bimbingan)->locale('id')->translatedformat('l,
                                                        d
                                                        F
                                                        Y')}}
                                                    </td>
                                                    <td>
                                                        <a href="/bimbingan-ta-1/edit/{{ $item->id }}"
                                                            data-toggle="modal"
                                                            data-target="#EditBimbingan1{{ $item->id }}"
                                                            class="btn btn-warning btn-xs"><i class="fa fa-edit">
                                                            </i> </a>
                                                        <a href="/bimbingan-ta-1/hapus/{{ $item->id }}"
                                                            data-toggle="modal"
                                                            data-target="#modalHapusBimbingan1{{ $item->id }}"
                                                            class="btn btn-danger btn-xs"><i class="fa fa-trash">
                                                            </i> </a>
                                                    </td>
                                                </tr>
                                                @endforeach

                                                @else
                                                <tr>
                                                    <td colspan="13">
                                                        <p align="center"><i>Data Tidak Tersedia</i></p>
                                                    </td>
                                                </tr>
                                                @endif
                                            </tbody>

                                            @elseif(Auth::user()->level == 1)
                                            <tbody> @php $no=1; @endphp
                                                @foreach ($b_dosen_2 as $item)
                                                <tr align="center">
                                                    <td>{{ $no++ }}</td>
                                                    <td>{{ $item->daftarta->mahasiswa->biodata->no_induk }}</td>
                                                    <td class="text-left">{{ $item->daftarta->mahasiswa->biodata->nama
                                                        }}</td>
                                                    <td>{{ $item->where('daftar_ta_id', $item->daftar_ta_id)->count() }}
                                                    </td>
                                                    <td>{{ $item->daftarta->judul }}</td>
                                                    <td>{{ $item->daftarta->tahunakademik->tahun }}</td>
                                                    <td>
                                                        <a href="bimbingan-ta-1/{{ $item->daftarta->id }}"
                                                            class="btn btn-primary btn-xs"><i class="fa fa-eye">
                                                            </i>
                                                        </a>
                                                    </td>
                                                </tr>
                                                @endforeach

                                            </tbody>
                                            @endif
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                @if (Auth::user()->level==0)
                                <h4 class="card-title">Dosen Pembimbing I</h4>
                                <a href="cetak-form/bimbingan-ta-1" class="btn btn-success btn-round ml-auto"
                                    target="_blank">
                                    <i class="fas fa-print"></i>
                                    Cetak Form
                                </a>
                                <a href="/bimbingan-ta/tambah" class="btn btn-primary btn-round ml-auto"
                                    data-toggle="modal" data-target="#modalTambahBimbingan">
                                    <i class="fa fa-plus"></i>
                                    Tambah
                                </a>
                                @elseif(Auth::user()->level==1)
                                <h4 class="card-title">Mahasiswa Bimbingan I</h4>
                                @endif
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="d-flex align-items-center">Readme First
                                <a href="bimbingan-ta/view-pengumuman" data-toggle="modal"
                                    data-target="#viewPengumuman"><i class="fa fa-eye ml-2">
                                    </i>
                                </a>
                            </div>
                            <div class="divider"></div>
                            <div class="table-responsive">
                                <table id="bimbingan-ta" class="display table table-striped table-hover">
                                    <thead>
                                        <tr align="center">
                                            @if (Auth::user()->level==1)
                                            <th>No</th>
                                            <th>NIM</th>
                                            <th>Nama</th>
                                            <th>Jumlah Bimbingan</th>
                                            <th>Judul Tugas Akhir</th>
                                            <th>Tahun Akademik</th>
                                            <th>Detail</th>
                                            @endif

                                            @if (Auth::user()->level==0)
                                            <th>No</th>
                                            <th>Dosen Pembimbing 1</th>
                                            <th>Laporan TA</th>
                                            <th>Status</th>
                                            <th>Uraian Bimbingan</th>
                                            <th>Tahun Akademik</th>
                                            <th>Tgl Bimbingan</th>
                                            <th>Action</th>
                                            @endif

                                        </tr>
                                    </thead>

                                    @if (Auth::user()->level==0)
                                    <tbody>
                                        @php $no=1; @endphp
                                        @if (empty(Auth::user()->biodata->mahasiswa->daftarta->bimbinganta1))
                                        @foreach ($b_mhs_1 as $item)
                                        <tr align="center">
                                            <td>{{ $no++ }}</td>
                                            <td class="text-capitalize text-left">{{
                                                $item->daftarta->dosen1->biodata->nama
                                                }}
                                            </td>
                                            <td>
                                                @if ($item->laporan_ta==NULL)
                                                @else
                                                <a href="storage/{{ $item->laporan_ta }}"><i
                                                        class="fas fa-file-download fa-2x">
                                                    </i>
                                                </a>
                                                @endif
                                            </td>
                                            @if ($item->stts == 'proses')
                                            <td>
                                                <a
                                                    class="font-weight-bold text-light text-capitalize badge badge-warning">
                                                    {{
                                                    $item->stts }}</a>
                                            </td>
                                            @elseif($item->stts == 'acc')
                                            <td>
                                                <a
                                                    class="font-weight-bold text-light text-capitalize badge badge-success">
                                                    {{
                                                    $item->stts}}</a>
                                            </td>
                                            @else
                                            <td>
                                                <a
                                                    class="font-weight-bold text-light text-capitalize badge badge-danger">
                                                    {{
                                                    $item->stts}}</a>
                                            </td>
                                            @endif
                                            <td>{{ $item->catatan }}</td>
                                            <td>{{ $item->daftarta->tahunakademik->tahun }}</td>
                                            <td>{{
                                                Carbon\Carbon::parse($item->tgl_bimbingan)->locale('id')->translatedformat('l,
                                                d
                                                F
                                                Y')}}
                                            </td>
                                            <td>
                                                <a href="/bimbingan-ta/edit/{{ $item->id }}" data-toggle="modal"
                                                    data-target="#EditBimbingan{{ $item->id }}"
                                                    class="btn btn-warning btn-xs"><i class="fa fa-edit">
                                                    </i> </a>
                                                <a href="/bimbingan-ta/hapus/{{ $item->id }}" data-toggle="modal"
                                                    data-target="#modalHapusBimbingan{{ $item->id }}"
                                                    class="btn btn-danger btn-xs"><i class="fa fa-trash">
                                                    </i> </a>
                                            </td>
                                        </tr>
                                        @endforeach

                                        @else
                                        <tr>
                                            <td colspan="13">
                                                <p align="center"><i>Data Tidak Tersedia</i></p>
                                            </td>
                                        </tr>
                                        @endif
                                    </tbody>

                                    @elseif(Auth::user()->level == 1)
                                    <tbody> @php $no=1; @endphp
                                        @foreach ($b_dosen_1 as $item)
                                        <tr align="center">
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $item->daftarta->mahasiswa->biodata->no_induk }}</td>
                                            <td class="text-left">{{ $item->daftarta->mahasiswa->biodata->nama }}</td>
                                            <td>{{ $item->where('daftar_ta_id', $item->daftar_ta_id)->count() }}</td>
                                            <td>{{ $item->daftarta->judul }}</td>
                                            <td>{{ $item->daftarta->tahunakademik->tahun }}</td>
                                            <td>
                                                <a href="/bimbingan-ta/{{ $item->daftarta->id }}"
                                                    class="btn btn-primary btn-xs"><i class="fa fa-eye">
                                                    </i>
                                                </a>
                                            </td>
                                        </tr>
                                        @endforeach

                                    </tbody>
                                    @endif
                                </table>
                            </div>
                        </div>

                    </div>
                </div> --}}
            </div>

            {{-- ============================================================= --}}

            {{-- pembimbing 2 --}}
            {{-- <div class="row" id="bimbingan-2">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                @if (Auth::user()->level==0)
                                <h4 class="card-title">Dosen Pembimbing II</h4>
                                <a href="cetak-form/bimbingan-ta-2" class="btn btn-success btn-round ml-auto"
                                    target="_blank">
                                    <i class="fas fa-print"></i>
                                    Cetak Form
                                </a>
                                <a href="/bimbingan-ta-1/tambah" class="btn btn-primary btn-round ml-auto"
                                    data-toggle="modal" data-target="#modalTambahBimbingan1">
                                    <i class="fa fa-plus"></i>
                                    Tambah
                                </a>
                                @elseif(Auth::user()->level==1)
                                <h4 class="card-title">Mahasiswa Bimbingan II</h4>
                                @endif

                            </div>
                        </div>

                        <div class="card-body">

                            <div class="divider"></div>
                            <div class="table-responsive">
                                <table id="bimbingan-ta-1" class="display table table-striped table-hover">
                                    <thead>
                                        <tr align="center">
                                            @if (Auth::user()->level==1)
                                            <th>No</th>
                                            <th>NIM</th>
                                            <th>Nama</th>
                                            <th>Jumlah Bimbingan</th>
                                            <th>Judul Tugas Akhir</th>
                                            <th>Tahun Akademik</th>
                                            <th>Detail</th>
                                            @endif

                                            @if (Auth::user()->level==0)
                                            <th>No</th>
                                            <th>Dosen Pembimbing 2</th>
                                            <th>Laporan TA</th>
                                            <th>Status</th>
                                            <th>Uraian Bimbingan</th>
                                            <th>Tahun Akademik</th>
                                            <th>Tgl Bimbingan</th>
                                            <th>Action</th>
                                            @endif

                                        </tr>
                                    </thead>

                                    @if (Auth::user()->level==0)
                                    <tbody>
                                        @php $no=1; @endphp
                                        @if (empty(Auth::user()->biodata->mahasiswa->daftarta->bimbinganta2))
                                        @foreach ($b_mhs_2 as $item)
                                        <tr align="center">
                                            <td>{{ $no++ }}</td>
                                            <td class="text-capitalize text-left">{{
                                                $item->daftarta->dosen2->biodata->nama
                                                }}
                                            </td>
                                            <td>
                                                @if ($item->laporan_ta == NULL)
                                                @else
                                                <a href="storage/{{ $item->laporan_ta }}"><i
                                                        class="fas fa-file-download fa-2x">
                                                    </i>
                                                </a>
                                                @endif
                                            </td>
                                            @if ($item->stts == 'proses')
                                            <td>
                                                <a
                                                    class="font-weight-bold text-light text-capitalize badge badge-warning">
                                                    {{
                                                    $item->stts }}</a>
                                            </td>
                                            @elseif($item->stts == 'acc')
                                            <td>
                                                <a
                                                    class="font-weight-bold text-light text-capitalize badge badge-success">
                                                    {{
                                                    $item->stts}}</a>
                                            </td>
                                            @else
                                            <td>
                                                <a
                                                    class="font-weight-bold text-light text-capitalize badge badge-danger">
                                                    {{
                                                    $item->stts}}</a>
                                            </td>
                                            @endif
                                            <td> {{ \Illuminate\Support\Str::limit($item->catatan, 60) }}
                                                @if (strlen($item->catatan) > 60)
                                                <br>
                                                {{ substr($item->catatan, 60) }}
                                                @endif
                                            </td>
                                            <td>{{ $item->daftarta->tahunakademik->tahun }}</td>
                                            <td>{{
                                                Carbon\Carbon::parse($item->tgl_bimbingan)->locale('id')->translatedformat('l,
                                                d
                                                F
                                                Y')}}
                                            </td>
                                            <td>
                                                <a href="/bimbingan-ta-1/edit/{{ $item->id }}" data-toggle="modal"
                                                    data-target="#EditBimbingan1{{ $item->id }}"
                                                    class="btn btn-warning btn-xs"><i class="fa fa-edit">
                                                    </i> </a>
                                                <a href="/bimbingan-ta-1/hapus/{{ $item->id }}" data-toggle="modal"
                                                    data-target="#modalHapusBimbingan1{{ $item->id }}"
                                                    class="btn btn-danger btn-xs"><i class="fa fa-trash">
                                                    </i> </a>
                                            </td>
                                        </tr>
                                        @endforeach

                                        @else
                                        <tr>
                                            <td colspan="13">
                                                <p align="center"><i>Data Tidak Tersedia</i></p>
                                            </td>
                                        </tr>
                                        @endif
                                    </tbody>

                                    @elseif(Auth::user()->level == 1)
                                    <tbody> @php $no=1; @endphp
                                        @foreach ($b_dosen_2 as $item)
                                        <tr align="center">
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $item->daftarta->mahasiswa->biodata->no_induk }}</td>
                                            <td class="text-left">{{ $item->daftarta->mahasiswa->biodata->nama }}</td>
                                            <td>{{ $item->where('daftar_ta_id', $item->daftar_ta_id)->count() }}</td>
                                            <td>{{ $item->daftarta->judul }}</td>
                                            <td>{{ $item->daftarta->tahunakademik->tahun }}</td>
                                            <td>
                                                <a href="bimbingan-ta-1/{{ $item->daftarta->id }}"
                                                    class="btn btn-primary btn-xs"><i class="fa fa-eye">
                                                    </i>
                                                </a>
                                            </td>
                                        </tr>
                                        @endforeach

                                    </tbody>
                                    @endif
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
            </div> --}}
        </div>
    </div>
</div>

{{-- Tambah pembimbing 1--}}
<div class="modal fade" id="modalTambahBimbingan" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Tambah Bimbingan TA</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form method="POST" enctype="multipart/form-data" action="bimbingan-ta">
                @csrf
                <div class="modal-body">

                    <div class="form-group required">
                        <div class="row">
                            <div class="col-6">
                                <label class="control-label">NIM - Nama - Tahun </label>
                                @if (Auth::user()->level==0 )
                                <input type="text" class="form-control"
                                    value="{{ $m_bimbing_1->mahasiswa->biodata->no_induk }} - {{ $m_bimbing_1->mahasiswa->biodata->nama }} - {{ $m_bimbing_1->tahunakademik->tahun }}"
                                    readonly>
                                <input type="hidden" name="daftar_ta_id" value="{{ $m_bimbing_1->id }}">
                                @else
                                <select class="form-control" name="daftar_ta_id" id="daftar_ta_id" required>
                                    <option value="" hidden="">-- Pilih --</option>

                                    @foreach ($d_bimbing_1 as $item)
                                    <option value="{{ $item->id }}">{{
                                        $item->mahasiswa->biodata->no_induk
                                        }} - {{ $item->mahasiswa->biodata->nama
                                        }} - {{ $item->tahunakademik->tahun
                                        }}
                                    </option>
                                    @endforeach

                                    @endif
                                </select>
                            </div>
                            @if (UserCheck::levelMhs())
                            <div class="col">
                                <label class="control-label">Dosen Pembimbing 1 </label>
                                <input type="text" class="form-control"
                                    value="{{ $m_bimbing_1->dosen1->biodata->nama }}" readonly>
                            </div>
                            @else
                            <div class="col">
                                <label for=""></label>
                                <input type="text" class="form-control" value="Mahasiswa Bimbingan 1" readonly>
                            </div>
                            @endif
                            <input type="hidden" name="author" value="{{ Auth::user()->biodata->nama }}" readonly>
                        </div>
                    </div>

                    <div class="form-group required">
                        <div class="row">
                            <div class="col">
                                <label class="control-label">Tanggal Bimbingan </label>
                                <input type="date" class="form-control" name="tgl_bimbingan"
                                    value="{{ old('tgl_bimbingan') }}">
                            </div>
                            <div class="col">
                                <label class="control-label">Status TA </label>
                                @if (Auth::user()->level==0)
                                <input type="text" size="1" class="form-control" value="Proses" readonly>
                                <input type="hidden" value="proses" name="stts">
                                @else
                                <select class="form-control" name="stts" required>
                                    <option value="" hidden="">-- Status TA --</option>
                                    <option value="proses">Proses</option>
                                    <option value="acc">ACC</option>
                                    <option value="revisi">Revisi</option>
                                    @endif
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col">
                                <label for="file" class="form-label ">Laporan TA </label>
                                <img class="img-preview img-fluid mb-3 col-sm-5" alt="">
                                <input type="file" class="form-control picture" id="laporan_ta" name="laporan_ta">
                                <span class="font-italic text-muted mr-5">ukuran file maksimal <span
                                        class="text-danger">1024
                                        KB</span></span>
                            </div>
                            <div class="col">
                                <label>Uraian Bimbingan</label>
                                <textarea class="form-control" name="catatan" id="catatan"></textarea>

                            </div>
                        </div>
                    </div>

                    <div class="modal-footer required">
                        <div class="col">
                            <label class="control-label font-italic">
                                : Kolom Wajib Diisi
                            </label>
                        </div>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-undo">
                            </i> Kembali</button>
                        <button type="submit" class="btn btn-primary"><i class="fa fa-save"> </i> Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- ========================================================================================================== --}}

{{-- Tambah Pembimbing 2--}}
<div class="modal fade" id="modalTambahBimbingan1" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Tambah Bimbingan TA</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form method="POST" enctype="multipart/form-data" action="bimbingan-ta-1">
                @csrf
                <div class="modal-body">

                    <div class="form-group required">
                        <div class="row">
                            <div class="col-6">
                                <label class="control-label">NIM - Nama - Tahun </label>
                                @if (Auth::user()->level==0 )
                                <input type="text" class="form-control"
                                    value="{{ $m_bimbing_1->mahasiswa->biodata->no_induk }} - {{ $m_bimbing_1->mahasiswa->biodata->nama }} - {{ $m_bimbing_1->tahunakademik->tahun }}"
                                    readonly>
                                <input type="hidden" name="daftar_ta_id" value="{{ $m_bimbing_1->id }}">
                                @else

                                <select class="form-control" name="daftar_ta_id" onchange="no_mahasiswa_1()"
                                    id="daftar_ta_id_1" required>
                                    <option value="" hidden="">-- Pilih --</option>
                                    @foreach ($d_bimbing_2 as $item)
                                    <option value="{{ $item->id }}">{{
                                        $item->mahasiswa->biodata->no_induk
                                        }} - {{ $item->mahasiswa->biodata->nama
                                        }} - {{ $item->tahunakademik->tahun
                                        }}
                                    </option>
                                    @endforeach

                                    @endif
                                </select>
                            </div>
                            @if (UserCheck::levelMhs())
                            <div class="col">
                                <label class="control-label">Dosen Pembimbing 2 </label>
                                <input type="text" class="form-control"
                                    value="{{ $m_bimbing_1->dosen2->biodata->nama }}" readonly>
                            </div>
                            @else
                            <div class="col">
                                <label for=""></label>
                                <input type="text" class="form-control" value="Mahasiswa Bimbingan 2" readonly>
                            </div>
                            @endif
                            <input type="hidden" name="author" value="{{ Auth::user()->biodata->nama }}" readonly>
                        </div>
                    </div>

                    <div class="form-group required">
                        <div class="row">
                            <div class="col">
                                <label class="control-label">Tanggal Bimbingan </label>
                                <input type="date" class="form-control" name="tgl_bimbingan"
                                    value="{{ old('tgl_bimbingan') }}">
                            </div>
                            <div class="col">
                                <label class="control-label">Status TA</label>
                                @if (Auth::user()->level==0)
                                <input type="text" class="form-control" value="Proses" readonly>
                                <input type="hidden" class="form-control" value="proses" name="stts">
                                @else
                                <select class="form-control" name="stts" required>
                                    <option value="" hidden="">-- Status TA --</option>
                                    <option value="proses">Proses</option>
                                    <option value="acc">ACC</option>
                                    <option value="revisi">Revisi</option>
                                    @endif
                                </select>
                            </div>
                        </div>
                    </div>


                    <div class="form-group">
                        <div class="row">
                            <div class="col">
                                <label for="file" class="form-label">Laporan TA </label>
                                <img class="img-preview img-fluid mb-3 col-sm-5" alt="">
                                <input type="file" class="form-control picture" id="laporan_ta" name="laporan_ta">
                                <span class="font-italic text-muted mr-5">ukuran file maksimal <span
                                        class="text-danger">1024
                                        KB</span></span>
                            </div>
                            <div class="col">
                                <label>Uraian Bimbingan</label>
                                <textarea class="form-control" name="catatan" id="catatan"></textarea>

                            </div>
                        </div>
                    </div>

                    <div class="modal-footer required">
                        <div class="col">
                            <label class="control-label font-italic">
                                : Kolom Wajib Diisi
                            </label>
                        </div>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-undo">
                            </i> Kembali</button>
                        <button type="submit" class="btn btn-primary"><i class="fa fa-save"> </i> Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- ================================================================================= --}}

{{-- Edit Bimbingan 1--}}
@foreach ($e_bimbing as $item)
<div class="modal fade" id="EditBimbingan{{ $item->id }}" tabindex="-1" role="dialog"
    aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="exampleModalLongTitle">Ubah Data Bimbingan TA</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form method="POST" enctype="multipart/form-data" action="/bimbingan-ta/{{ $item->id }}">
                @method('put')
                @csrf
                <div class="modal-body">

                    <div class="form-group required">
                        <div class="row">
                            <div class="col-6">
                                <label class="control-label">NIM - Nama - Tahun </label>
                                <input type="text" class="form-control" value="{{
                                        $item->daftarta->mahasiswa->biodata->no_induk }} - {{
                                        $item->daftarta->mahasiswa->biodata->nama }} - {{
                                        $item->daftarta->tahunakademik->tahun }}" readonly>
                                <input type="hidden" name="daftar_ta_id" value="{{ $item->daftar_ta_id }}">
                                <input type="hidden" name="author" value="{{ Auth::user()->biodata->nama }}" readonly>
                            </div>
                            @if (UserCheck::levelMhs())
                            <div class="col">
                                <label class="control-label">Dosen Pembimbing 1 </label>
                                <input type="text" class="form-control"
                                    value="{{ $item->daftarta->dosen1->biodata->nama }}" readonly>
                            </div>
                            @else
                            <div class="col">
                                <label for=""></label>
                                <input type="text" class="form-control" value="Mahasiswa Bimbingan 1" readonly>
                            </div>
                            @endif
                            <input type="hidden" name="author" value="{{ Auth::user()->biodata->nama }}" readonly>
                        </div>
                    </div>

                    <div class="form-group required">
                        <div class="row">
                            <div class="col">
                                <label class="control-label">Tanggal Bimbingan </label>
                                <input type="date" class="form-control" name="tgl_bimbingan"
                                    value="{{ old('tgl_bimbingan',$item->tgl_bimbingan) }}">
                            </div>
                            <div class="col">
                                <label class="control-label">Status </label>
                                @if (Auth::user()->level==0)
                                <input type="text" class="form-control text-capitalize" value="{{ $item->stts }}"
                                    readonly>
                                <input type="hidden" class="form-control text-capitalize" value="{{ $item->stts }}"
                                    name="stts">
                                {{-- <option value="{{ $item->stts }}" @readonly(true)>{{ $item->stts }}</option> --}}
                                @else
                                <select class="form-control text-capitalize" name="stts" required>
                                    <option @php if($item->stts == 'proses') echo 'selected';
                                        @endphp value="proses">Proses</option>
                                    <option @php if($item->stts == 'acc') echo 'selected';
                                        @endphp value="acc">ACC</option>
                                    <option @php if($item->stts == 'revisi') echo 'selected';
                                        @endphp value="revisi">Revisi</option>
                                </select>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="form-group required">
                        <div class="row">
                            <div class="col">
                                <label for="file" class="form-label ">Laporan TA </label>
                                <input type="hidden" name="oldFile" value="{{ $item->laporan_ta }}">
                                <input type="file" class="form-control picture" id="laporan_kp" name="laporan_kp"
                                    value="{{ $item->laporan_ta }}">
                                <span class="mt-1 font-italic">biarkan kolom kosong
                                    jika tidak diganti | ukuran file maksimal
                                    <span class="text-danger">1024
                                        KB</span></span>
                            </div>
                            <div class="col">
                                <label>Catatan</label>
                                <textarea class="form-control" name="catatan"
                                    id="catatan">{!! $item->catatan !!}</textarea>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer required">
                        <div class="col">
                            <label class="control-label font-italic">
                                : Kolom Wajib Diisi
                            </label>
                        </div>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-undo">
                            </i> Kembali</button>
                        <button type="submit" class="btn btn-primary"><i class="fa fa-save"> </i> Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach


{{-- Edit Bimbingan 2--}}
@foreach ($e_bimbing_2 as $item)
<div class="modal fade" id="EditBimbingan1{{ $item->id }}" tabindex="-1" role="dialog"
    aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="exampleModalLongTitle">Ubah Data Bimbingan TA</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form method="POST" enctype="multipart/form-data" action="bimbingan-ta-1/{{ $item->id }}">
                @method('put')
                @csrf
                <div class="modal-body">

                    <div class="form-group required">
                        <div class="row">
                            <div class="col">
                                <label class="control-label">NIM - Nama - Tahun </label>
                                <input type="text" class="form-control" value="{{
                                    $item->daftarta->mahasiswa->biodata->no_induk }} - {{
                                    $item->daftarta->mahasiswa->biodata->nama }} - {{
                                    $item->daftarta->tahunakademik->tahun }}" readonly>
                                <input type="hidden" name="daftar_ta_id" value="{{ $item->daftar_ta_id }}">
                            </div>
                            @if (UserCheck::levelMhs())
                            <div class="col">
                                <label class="control-label">Dosen Pembimbing 2 </label>
                                <input type="text" class="form-control"
                                    value="{{ $item->daftarta->dosen2->biodata->nama }}" readonly>
                            </div>
                            @else
                            <div class="col">
                                <label for=""></label>
                                <input class="form-control" type="text" value="Mahasiswa Bimbingan 2" readonly>
                            </div>
                            @endif
                            <input type="hidden" name="author" value="{{ Auth::user()->biodata->nama }}" readonly>
                        </div>
                    </div>

                    <div class="form-group required">
                        <div class="row">
                            <div class="col">
                                <label class="control-label">Tanggal Bimbingan </label>
                                <input type="date" class="form-control" name="tgl_bimbingan"
                                    value="{{ old('tgl_bimbingan',$item->tgl_bimbingan) }}">
                            </div>
                            <div class="col">
                                <label class="control-label">Status </label>
                                @if (Auth::user()->level==0)
                                <input type="text" class="form-control text-capitalize" value="{{ $item->stts }}"
                                    readonly>
                                <input type="hidden" class="form-control" value="{{ $item->stts }}" name="stts">
                                {{-- <option value="{{ $item->stts }}" @readonly(true)>{{ $item->stts }}</option> --}}
                                @else
                                <select class="form-control text-capitalize" name="stts" required>
                                    <option @php if($item->stts == 'proses') echo 'selected';
                                        @endphp value="proses">Proses</option>
                                    <option @php if($item->stts == 'acc') echo 'selected';
                                        @endphp value="acc">ACC</option>
                                    <option @php if($item->stts == 'revisi') echo 'selected';
                                        @endphp value="revisi">Revisi</option>
                                    @endif
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-group required">
                        <div class="row">
                            <div class="col">
                                <label for="file" class="form-label control-label">Laporan TA </label>
                                <input type="hidden" name="oldFile" value="{{ $item->laporan_ta }}">
                                <input type="file" class="form-control picture" id="laporan_kp" name="laporan_kp"
                                    value="{{ $item->laporan_ta }}">
                                <span class="mt-1 font-italic">biarkan kolom kosong
                                    jika tidak diganti | ukuran file maksimal
                                    <span class="text-danger">1024
                                        KB</span></span>
                            </div>
                            <div class="col">
                                <label>Catatan</label>
                                <textarea class="form-control" name="catatan"
                                    id="catatan">{!! $item->catatan !!}</textarea>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer required">
                        <div class="col">
                            <label class="control-label font-italic">
                                : Kolom Wajib Diisi
                            </label>
                        </div>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-undo">
                            </i> Kembali</button>
                        <button type="submit" class="btn btn-primary"><i class="fa fa-save"> </i> Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach

{{-- Pengumuman --}}
<div class="modal fade" id="viewPengumuman" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Readme First </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <div class="form-group">
                    <div class="row">
                        <div class="col">
                            {!! $pengumuman->cttn_bimbingan_ta !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- view Catatan --}}
{{-- @foreach ($bimbingkp as $item)
<div class="modal fade" id="viewCatatan{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Catatan dari {{ $item->author }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <div class="form-group">
                    <div class="row">
                        <div class="col-12">
                            {!!$item->catatan!!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach --}}

{{-- Hapus bimbingan 1--}}
@foreach ($e_bimbing as $item)
<div class="modal fade" id="modalHapusBimbingan{{ $item->id }}" tabindex="-1" role="dialog"
    aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-open">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="exampleModalLongTitle">Hapus Data Bimbingan</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form method="POST" enctype="multipart/form-data" action="/bimbingan-ta/{{ $item->id }}">
                @method('delete')
                @csrf
                <div class="modal-body">

                    <input type="hidden" value="{{ $item->id }}" name="id" required>

                    <div class=" form-group">
                        <h3>Apakah anda ingin menghapus data bimbingan <span class="text-danger text-capitalize">{{
                                $item->daftarta->mahasiswa->biodata->nama }}</span> dengan
                            Judul <span class="text-danger text-capitalize">{{
                                $item->judul_bimbingan
                                }} </span> ?</h3>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-undo"></i>
                        Close</button>
                    <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i> hapus</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach

{{-- =============================================================================== --}}

{{-- Hapus bimbingan 2--}}
@foreach ($e_bimbing_2 as $item)
<div class="modal fade" id="modalHapusBimbingan1{{ $item->id }}" tabindex="-1" role="dialog"
    aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-open">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="exampleModalLongTitle">Hapus Data Bimbingan</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form method="POST" enctype="multipart/form-data" action="/bimbingan-ta-1/{{ $item->id }}">
                @method('delete')
                @csrf
                <div class="modal-body">

                    <input type="hidden" value="{{ $item->id }}" name="id" required>

                    <div class=" form-group">
                        <h3>Apakah anda ingin menghapus data bimbingan <span class="text-danger text-capitalize">{{
                                $item->daftarta->mahasiswa->biodata->nama }}</span> dengan
                            Judul <span class="text-danger text-capitalize">{{
                                $item->judul_bimbingan
                                }} </span> ?</h3>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-undo"></i>
                        Close</button>
                    <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i> hapus</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach

{{-- update status bimbingan 1 --}}
@foreach ($e_bimbing as $item)
<div class="modal fade" id="modalUpdateStatus{{ $item->id }}" tabindex="-1" role="dialog"
    aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Perbarui Status Bimbingan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form method="POST" enctype="multipart/form-data" action="/update-status-bimbingan-ta/{{ $item->id }}">
                @method('put')
                @csrf
                <div class="modal-body">

                    <input type="hidden" value="{{ $item->id }}" name="id" required>

                    <div class="form-group">
                        <select class="form-control" name="stts" size="1" required>
                            <option value="" hidden="">-- Status Bimbingan --</option>
                            <option @php if($item->stts == 'proses') echo 'selected';
                                @endphp value="proses">Proses</option>
                            <option @php if($item->stts == 'acc') echo 'selected';
                                @endphp value="acc">Acc</option>
                            <option @php if($item->stts == 'revisi') echo 'selected';
                                @endphp value="revisi">Revisi</option>
                        </select>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-undo"></i>
                        Close</button>
                    <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Perbarui</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach

{{-- ================================================================================================= --}}
{{-- update status bimbingan 2 --}}
@foreach ($e_bimbing_2 as $item)
<div class="modal fade" id="updateStatusBimbingan{{ $item->id }}" tabindex="-1" role="dialog"
    aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Perbarui Status Bimbingan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form method="POST" enctype="multipart/form-data" action="/update-status-bimbingan-ta-1/{{ $item->id }}">
                @method('put')
                @csrf
                <div class="modal-body">

                    <input type="hidden" value="{{ $item->id }}" name="id" required>

                    <div class="form-group">
                        <select class="form-control" name="stts" size="1" required>
                            <option value="" hidden="">-- Status Bimbingan --</option>
                            <option @php if($item->stts == 'proses') echo 'selected';
                                @endphp value="proses">Proses</option>
                            <option @php if($item->stts == 'acc') echo 'selected';
                                @endphp value="acc">Acc</option>
                            <option @php if($item->stts == 'revisi') echo 'selected';
                                @endphp value="revisi">Revisi</option>
                        </select>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-undo"></i>
                        Close</button>
                    <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Perbarui</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach

<script src="/assets/js/core/jquery.3.2.1.min.js"></script>
<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

</script>

<script>
    // function no_mahasiswa() {
    //     let daftar_ta_id = $("#daftar_ta_id").val();
    //     $("#mahasiswa_id").children().remove();
    //     if (daftar_ta_id != '' && daftar_ta_id != null) {
    //         $.ajax({

    //             url: "{{ url('') }}/bimbingan-ta/daftar_ta_id/" + daftar_ta_id,
    //             success: function (res) {
    //                 $("#mahasiswa_id").val(res.mahasiswa_id);
    //                 $("#dosen_id").val(res.d_pembimbing_1);
    //             }
    //         });
    //     }
    // }

    $(document).ready(function () {
    var table = $("#bimbingan-ta").DataTable({});
        $("#filter-tahun").change(function () {
        table.column($(this).data("column")).search($(this).val()).draw();
    });
        $("#filter-stts").change(function () {
        table.column($(this).data("column")).search($(this).val()).draw();
    });
    });

    // ================================================================

    // bimbingan 2
    // function no_mahasiswa_1() {
    //     let daftar_ta_id = $("#daftar_ta_id_1").val();
    //     $("#mahasiswa_id_1").children().remove();
    //     if (daftar_ta_id != '' && daftar_ta_id != null) {
    //         $.ajax({

    //             url: "{{ url('') }}/bimbingan-ta/daftar_ta_id/" + daftar_ta_id,
    //             success: function (res) {
    //                 $("#mahasiswa_id_1").val(res.mahasiswa_id);
    //                 $("#dosen_id_1").val(res.d_pembimbing_2);
    //             }
    //         });
    //     }
    // }

    $(document).ready(function () {
    var table = $("#bimbingan-ta-1").DataTable({});
        $("#filter-tahun").change(function () {
        table.column($(this).data("column")).search($(this).val()).draw();
    });
        $("#filter-stts").change(function () {
        table.column($(this).data("column")).search($(this).val()).draw();
    });
    });
</script>

@endsection