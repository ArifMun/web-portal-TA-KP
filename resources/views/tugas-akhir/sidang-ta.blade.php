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
            <div class="page-header">
                @if (Auth::user()->level ==0)
                <h4 class="page-title">Sidang Tugas Akhir [Mahasiswa]</h4>
                @else
                <h4 class="page-title">Sidang Tugas Akhir</h4>
                @endif
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <div class="">Readme First
                                    <a href="kerja-praktik/view-pengumuman" data-toggle="modal"
                                        data-target="#viewPengumuman"><i class="fa fa-eye ml-2">
                                        </i>
                                    </a>
                                </div>

                                @if ($registerSidang || Auth::user()->level==2)
                                <a href="/sidang-ta/daftar" class="btn btn-primary btn-round ml-auto"
                                    data-toggle="modal" data-target="#modalDaftarSidang">
                                    <i class="fa fa-plus"></i>
                                    Daftar
                                </a>
                                @else
                                @endif
                            </div>
                        </div>

                        <div class="card-body">
                            @if (UserCheck::levelAdmin())
                            <div class="row">
                                <div class="col-sm-6 col-md-3">
                                    <div class="row align-items-center">
                                        <div class="col col-stats ml-3 ml-sm-0">
                                            <div class="filter tahun">
                                                <label class="font-weight-bold h6">Filter Tahun</label>
                                                <select data-column="12" class="form-control" id="filter-tahun">
                                                    <option value="">-- Pilih Tahun --</option>
                                                    @foreach ($thnakademik as $k)
                                                    <option value="{{ $k->tahun }}">{{ $k->tahun }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-6 col-md-3">
                                    <div class="row align-items-center">
                                        <div class="col col-stats ml-3 ml-sm-0">
                                            <div class="filter tahun">
                                                <label class="font-weight-bold h6">Filter Status</label>
                                                <select data-column="6" class="form-control" id="filter-stts">
                                                    <option value="">-- Pilih Status --</option>
                                                    @foreach ($filterStts as $item)
                                                    <option value="{{ $item->stts_sidang }}" class="text-capitalize">
                                                        {{
                                                        $item->stts_sidang }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-6 col-md-3">
                                    <div class="row">
                                        <div class="col col-stats ml-3 ml-sm-0">
                                            <p class="font-weight-bold h6">Status Sidang</p>
                                            <p class="font-weight-bold badge badge-success mr-1">
                                                Selesai: {{$s_selesai}}
                                            </p>
                                            <p class="font-weight-bold badge badge-primary mr-1">
                                                Terjadwal :
                                                {{
                                                $s_terjadwal }}
                                            </p>
                                            <p class="font-weight-bold badge badge-warning">
                                                Proses
                                                :
                                                {{
                                                $s_proses
                                                }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="divider"></div>
                            @endif
                            <div class="table-responsive">
                                <table id="seminar-kp" class="display table table-striped table-hover">
                                    <thead>
                                        <tr align="center">
                                            <th>No</th>
                                            @if (Auth::user()->level==2)
                                            <th>NIM</th>
                                            <th>Nama</th>
                                            @endif

                                            <th>Dosen Penguji Utama</th>
                                            <th>Dosen Penguji 1</th>
                                            <th>Dosen Penguji 2</th>
                                            <th>Status Sidang</th>
                                            <th>Form Bimbingan 1</th>
                                            <th>Form Bimbingan 2</th>
                                            <th>Slip Pembayaran Sidang</th>
                                            <th>Slip Pembayaran Skripsi</th>
                                            <th>KRS</th>
                                            <th>Tahun Akademik</th>
                                            <th>Judul</th>
                                            <th>Tempat</th>
                                            <th>Tanggal Sidang</th>
                                            <th>Jam Sidang</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>

                                    @if (Auth::user()->level==0)
                                    <tbody>
                                        @if (empty(Auth::user()->biodata->mahasiswa->daftarta->sidangta))
                                        @php $no=1; @endphp
                                        @foreach ($m_list as $item)
                                        <tr align="center" class="text-capitalize">
                                            <td>{{ $no++ }}</td>
                                            {{-- <td>{{ $item->daftarta->mahasiswa->biodata->no_induk}}</td>
                                            <td>{{ $item->daftarta->mahasiswa->biodata->nama }}</td> --}}

                                            <td>
                                                @foreach ($dosen as $k)
                                                {{ $k->id == $item->d_penguji ?
                                                $k->biodata->nama :''
                                                }}
                                                @endforeach
                                            </td>
                                            <td>
                                                @foreach ($dosen as $k)
                                                {{ $k->id == $item->daftarta->d_pembimbing_2 ?
                                                $k->biodata->nama :''
                                                }}
                                                @endforeach
                                            </td>
                                            <td>
                                                @foreach ($dosen as $k)
                                                {{ $k->id == $item->daftarta->d_pembimbing_1 ?
                                                $k->biodata->nama :''
                                                }}
                                                @endforeach
                                            </td>

                                            @if ($item->daftarta->sidangta->stts_sidang=='proses')
                                            <td>
                                                <a
                                                    class="font-weight-bold text-light text-capitalize badge badge-warning">
                                                    {{
                                                    $item->stts_sidang }}</a>
                                            </td>
                                            @elseif($item->stts_sidang=='selesai')
                                            <td>
                                                <a
                                                    class="font-weight-bold text-light text-capitalize badge badge-success">
                                                    {{
                                                    $item->stts_sidang }}</a>
                                            </td>
                                            @else
                                            <td>
                                                <a
                                                    class="font-weight-bold text-light text-capitalize badge badge-primary">
                                                    {{
                                                    $item->stts_sidang }}</a>
                                            </td>
                                            @endif

                                            <td>
                                                <a href="sidang-ta/view-form_1/{{ $item->id }}" data-toggle="modal"
                                                    data-target="#viewForm_1{{ $item->id }}"><i
                                                        class="fa fa-file-image fa-2x">
                                                    </i> </a>
                                            </td>

                                            <td>
                                                <a href="sidang-ta/view-form_2/{{ $item->id }}" data-toggle="modal"
                                                    data-target="#viewForm_2{{ $item->id }}"><i
                                                        class="fa fa-file-image fa-2x">
                                                    </i> </a>
                                            </td>

                                            <td>
                                                <a href="sidang-ta/view-slip-sidang/{{ $item->id }}" data-toggle="modal"
                                                    data-target="#viewSlipSidang{{ $item->id }}"><i
                                                        class="fa fa-file-image fa-2x">
                                                    </i> </a>
                                            </td>

                                            <td>
                                                <a href="sidang-ta/view-slip-skripsi/{{ $item->id }}"
                                                    data-toggle="modal" data-target="#viewSlipSkripsi{{ $item->id }}"><i
                                                        class="fa fa-file-image fa-2x">
                                                    </i> </a>
                                            </td>
                                            <td>
                                                <a href="sidang-ta/view-krs/{{ $item->id }}" data-toggle="modal"
                                                    data-target="#viewKRS{{ $item->id }}"><i
                                                        class="fa fa-file-image fa-2x">
                                                    </i> </a>
                                            </td>

                                            <td>{{ $item->thnakademik->tahun }}</td>
                                            <td>
                                                <a href="sidang-ta/view-judul/{{ $item->id }}" data-toggle="modal"
                                                    data-target="#viewJudul{{ $item->id }}"><i class="fa fa-eye">
                                                    </i>
                                                </a>
                                            </td>
                                            {{-- <td>{{ $item->judul }}</td> --}}
                                            <td>{{ $item->tempat }}</td>
                                            <td>{{
                                                Carbon\Carbon::parse($item->tgl_sidang)->locale('id')->translatedformat('l,d
                                                F
                                                Y')}}
                                            </td>
                                            <td>{{
                                                Carbon\Carbon::parse($item->jam_mulai_sidang)->locale('id')->format('H:i')}}
                                                - {{
                                                Carbon\Carbon::parse($item->jam_akhir_sidang)->locale('id')->format('H:i')
                                                }} WIB
                                            </td>
                                            <td>

                                                @if (($item->stts_sidang == 'terjadwal') || ($item->stts_sidang ==
                                                'selesai') )
                                                @else
                                                <a href="sidang-ta/edit/{{ $item->id }}" data-toggle="modal"
                                                    data-target="#modalEditSidang{{ $item->id }}"
                                                    class="btn btn-warning btn-xs"><i class="fa fa-edit">
                                                    </i>
                                                </a>
                                                <a href="sidang-ta/hapus/{{ $item->id }}" data-toggle="modal"
                                                    data-target="#modalHapusSidang{{ $item->id }}"
                                                    class="btn btn-danger btn-xs"><i class="fa fa-trash">
                                                    </i>
                                                </a>
                                                @endif
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

                                    {{-- All- --}}
                                    @elseif(Auth::user()->level ==2)
                                    <tbody> @php $no=1; @endphp
                                        @foreach ($s_list as $row)
                                        <tr align="center" class="text-capitalize">
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $row->daftarta->mahasiswa->biodata->no_induk }}</td>
                                            <td>{{ $row->daftarta->mahasiswa->biodata->nama }}</td>

                                            <td>
                                                @foreach ($dosen as $k)
                                                {{ $k->id == $row->d_penguji ?
                                                $k->biodata->nama :''
                                                }}
                                                @endforeach
                                            </td>
                                            <td>
                                                @foreach ($dosen as $d)
                                                {{ $d->id == $row->daftarta->d_pembimbing_2 ?
                                                $d->biodata->nama :''
                                                }}
                                                @endforeach
                                            </td>

                                            <td>
                                                @foreach ($dosen as $d)
                                                {{ $d->id == $row->daftarta->d_pembimbing_1 ?
                                                $d->biodata->nama :''
                                                }}
                                                @endforeach
                                            </td>
                                            @if ($row->stts_sidang=='proses')
                                            <td>
                                                <a href="update-status-sidang/{{ $row->id }}" data-toggle="modal"
                                                    data-target="#modalUpdateStatus{{ $row->id }}"
                                                    class="font-weight-bold text-light text-capitalize badge badge-warning">
                                                    {{
                                                    $row->stts_sidang }}</a>
                                            </td>
                                            @elseif($row->stts_sidang=='selesai')
                                            <td>
                                                <a href="update-status-sidang/{{ $row->id }}" data-toggle="modal"
                                                    data-target="#modalUpdateStatus{{ $row->id }}"
                                                    class="font-weight-bold text-light text-capitalize badge badge-success">
                                                    {{
                                                    $row->stts_sidang }}</a>
                                            </td>
                                            @else
                                            <td>
                                                <a href="update-status-sidang/{{ $row->id }}" data-toggle="modal"
                                                    data-target="#modalUpdateStatus{{ $row->id }}"
                                                    class="font-weight-bold text-light text-capitalize badge badge-primary">
                                                    {{
                                                    $row->stts_sidang }}</a>
                                            </td>
                                            @endif

                                            <td>
                                                <a href="sidang-ta/view-form_1/{{ $row->id }}" data-toggle="modal"
                                                    data-target="#viewForm_1{{ $row->id }}"><i
                                                        class="fa fa-file-image fa-2x">
                                                    </i> </a>
                                            </td>

                                            <td>
                                                <a href="sidang-ta/view-form_2/{{ $row->id }}" data-toggle="modal"
                                                    data-target="#viewForm_2{{ $row->id }}"><i
                                                        class="fa fa-file-image fa-2x">
                                                    </i> </a>
                                            </td>

                                            <td>
                                                <a href="sidang-ta/view-slip-sidang/{{ $item->id }}" data-toggle="modal"
                                                    data-target="#viewSlipSidang{{ $item->id }}"><i
                                                        class="fa fa-file-image fa-2x">
                                                    </i> </a>
                                            </td>

                                            <td>
                                                <a href="sidang-ta/view-slip-skripsi/{{ $item->id }}"
                                                    data-toggle="modal" data-target="#viewSlipSkripsi{{ $item->id }}"><i
                                                        class="fa fa-file-image fa-2x">
                                                    </i> </a>
                                            </td>
                                            <td>
                                                <a href="sidang-ta/view-krs/{{ $item->id }}" data-toggle="modal"
                                                    data-target="#viewKRS{{ $item->id }}"><i
                                                        class="fa fa-file-image fa-2x">
                                                    </i> </a>
                                            </td>

                                            <td>{{ $row->thnakademik->tahun }}</td>
                                            <td>
                                                <a href="sidang-ta/view-judul/{{ $row->id }}" data-toggle="modal"
                                                    data-target="#viewJudul{{ $row->id }}"
                                                    class="btn btn-success btn-xs"><i class="fa fa-eye">
                                                    </i>
                                                </a>
                                            </td>
                                            {{-- <td>{{ $row->judul }}</td> --}}
                                            <td>{{ $row->tempat }}</td>
                                            <td>{{
                                                Carbon\Carbon::parse($row->tgl_sidang)->locale('id')->translatedformat('l,d
                                                F
                                                Y')}}
                                            </td>
                                            <td>{{
                                                Carbon\Carbon::parse($row->jam_mulai_sidang)->locale('id')->format('H:i')}}
                                                - {{
                                                Carbon\Carbon::parse($row->jam_akhir_sidang)->locale('id')->format('H:i')
                                                }}
                                            </td>
                                            <td>
                                                <a href="cetak-form/bimbingan-kp" class="btn btn-success btn-xs">
                                                    <i class="fas fa-print"></i>
                                                </a>
                                                <a href="sidang-ta/edit/{{ $row->id }}" data-toggle="modal"
                                                    data-target="#modalEditSidang{{ $row->id }}"
                                                    class="btn btn-warning btn-xs"><i class="fa fa-edit">
                                                    </i>
                                                </a>
                                                <a href="sidang-ta/hapus/{{ $row->id }}" data-toggle="modal"
                                                    data-target="#modalHapusSidang{{ $row->id }}"
                                                    class="btn btn-danger btn-xs"><i class="fa fa-trash">
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
    </div>
</div>

{{-- Tambah --}}
<div class="modal fade" id="modalDaftarSidang" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Daftar Sidang Tugas Akhir</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @if (count($errors) > 0)
            <div class="modal-header">
                <div class="alert alert-danger ">
                    @foreach ($errors->all() as $error)
                    <span class="text-danger">
                        {{ $error }}
                    </span>
                    @endforeach
                </div>
            </div>
            @endif

            <form method="POST" enctype="multipart/form-data" action="sidang-ta" id="tambah">
                @csrf
                <div class="modal-body">
                    <div class="form-group required">
                        <div class="row">
                            <div class="col">
                                <label class="control-label">NIM - Nama</label>
                                @if (Auth::user()->level==0 )
                                <input type="text" class="form-control" value="{{
                                        $inputMhsDiterima->mahasiswa->biodata->no_induk
                                        }} - {{ $inputMhsDiterima->mahasiswa->biodata->nama
                                    }} " readonly>
                                <input type="hidden" class="form-control" name="daftar_ta_id"
                                    value="{{ $inputMhsDiterima->id }}">
                                @else
                                <select class="form-control" name="daftar_ta_id" id="daftar_ta_id" size="1"
                                    onchange="no_mahasiswa()" required>

                                    <option value="0">-- Pilih Mahasiswa--</option>
                                    @foreach ($daftarta as $k)
                                    @if (old('daftar_ta_id')==$k->id)

                                    <option value="{{ $k->id }}" class="text-capitalize" selected>{{
                                        $k->mahasiswa->biodata->no_induk
                                        }} - {{ $k->mahasiswa->biodata->nama
                                        }}</option>
                                    @else
                                    <option value="{{ $k->id }}" class="text-capitalize">{{
                                        $k->mahasiswa->biodata->no_induk
                                        }} - {{ $k->mahasiswa->biodata->nama
                                        }}</option>
                                    @endif
                                    @endforeach

                                </select>
                                @endif
                            </div>
                            <div class="col">
                                <label class="control-label">Tahun Akademik </label>
                                <input type="text" class="form-control" size="1" value="{{ $last_year->tahun }}"
                                    readonly>
                                <input type="hidden" class="form-control" name="thn_akademik_id"
                                    value="{{ $last_year->id }}">
                            </div>
                        </div>
                    </div>

                    <div class="form-group ">
                        <div class="row">
                            <div class="col">
                                <label class="control-label">Tanggal Sidang </label>
                                <input type="date" class="form-control" name="tgl_sidang" size="1"
                                    value="{{ old('tgl_sidang') }}">
                            </div>
                            <div class="col-3">
                                <label class="control-label">
                                    Jam Mulai Sidang
                                </label>
                                <input type="time" class="form-control" name="jam_mulai_sidang" size="1"
                                    value="{{ old('jam_mulai_sidang') }}">
                            </div>
                            <div class="col-3">
                                <label class="control-label">
                                    Jam Akhir Sidang
                                </label>
                                <input type="time" class="form-control" name="jam_akhir_sidang" size="1"
                                    value="{{ old('jam_akhir_sidang') }}">
                            </div>
                        </div>
                    </div>

                    <div class="form-group required">
                        <div class="row">
                            <div class="col-6">
                                <label class="control-label">Judul Tugas Akhir </label>
                                @if (Auth::user()->level==0)
                                <input type="text" class="form-control" name="judul" size="1"
                                    value="{{ old('judul',$inputMhsDiterima->judul) }}">
                                @else
                                <input type="text" class="form-control" id="judul" name="judul" size="1"
                                    value="{{ old('judul') }}">
                                @endif
                            </div>
                            <div class="col">
                                <label class="control-label">Status Sidang </label>
                                @if (Auth::user()->level==0)
                                <input type="text" class="form-control text-capitalize" value="proses" readonly>
                                <input type="hidden" name="stts_sidang" value="proses">
                                @else
                                <select class="form-control" name="stts_sidang" size="1" required>
                                    <option value="" hidden="">-- Status Sidang --</option>
                                    <option value="proses">Proses</option>
                                    <option value="terjadwal">Terjadwal</option>
                                    <option value="selesai">Selesai</option>
                                </select>
                                @endif
                            </div>
                            @if (Auth::user()->level==2)
                            <div class="col-3">
                                <label for="" class="form-label control-label">Dosen Penguji </label>
                                <select class="form-control" name="d_penguji" size="1">
                                    <option value="" hidden="">-- Dosen Penguji--</option>
                                    @foreach ($dosen as $k)
                                    @if (old('d_penguji')==$k->id)

                                    <option value="{{ $k->id }}" selected>{{ $k->biodata->nama }}</option>
                                    @else
                                    <option value="{{ $k->id }}">{{ $k->biodata->nama }}</option>
                                    @endif
                                    @endforeach
                                </select>
                            </div>
                            @endif
                        </div>
                    </div>

                    <div class="form-group required">
                        <div class="row">
                            <div class="col-6">
                                <label for="image" class="form-label control-label">Form Bimbingan 1 </label>
                                <input type="file" class="form-control picture" id="image1" name="f_bimbingan_1"
                                    onchange="previewImage(1)">
                                <img class="img-preview img-fluid mt-2 col-sm-5" id="preview1">
                                {{-- <span class="font-italic text-muted mt-1">ukuran file maksimal <span
                                        class="text-danger">1024
                                        KB</span> </span> --}}
                            </div>
                            <div class="col-6">
                                <label for="image" class="form-label control-label">Form Bimbingan 2 </label>
                                <input type="file" class="form-control picture" id="image2" name="f_bimbingan_2"
                                    onchange="previewImage(2)">
                                <img class="img-preview img-fluid mt-2 col-sm-5" id="preview2">
                                {{-- <span class="font-italic text-muted mt-1">ukuran file maksimal <span
                                        class="text-danger">1024
                                        KB</span> </span> --}}
                            </div>
                        </div>
                    </div>

                    <div class="form-group required">
                        <div class="row">

                            <div class="col-6">
                                <label for="image" class="control-label">Slip Pembayaran Sidang </label>
                                <input type="file" class="form-control picture" id="image3"
                                    name="slip_pembayaran_sidang" onchange="previewImage(3)">
                                <img class="img-preview img-fluid mt-2 col-sm-5" id="preview3">
                                {{-- <span class="font-italic text-muted mt-1">ukuran file maksimal <span
                                        class="text-danger">1024
                                        KB</span> </span> --}}
                            </div>
                            <div class="col-6">
                                <label for="image" class="control-label">Slip Pembayaran Skripsi </label>
                                <input type="file" class="form-control picture" id="image7"
                                    name="slip_pembayaran_skripsi" onchange="previewImage(7)">
                                <img class="img-preview img-fluid mt-2 col-sm-5" id="preview7">
                                {{-- <span class="font-italic text-muted mt-1">ukuran file maksimal <span
                                        class="text-danger">1024
                                        KB</span> </span> --}}
                            </div>
                        </div>
                    </div>

                    <div class="form-group required">
                        <div class="row">
                            <div class="col-6">
                                <label for="image" class="control-label ">KRS (Tertera Mata Kuliah Skripsi) </label>
                                <input type="file" class="form-control picture" id="image8" name="krs"
                                    onchange="previewImage(8)">
                                <img class="img-preview img-fluid mt-2 col-sm-5" id="preview8">
                                {{-- <span class="font-italic text-muted mt-1">ukuran file maksimal <span
                                        class="text-danger">1024
                                        KB</span> </span> --}}
                            </div>
                            <div class="col-6">
                                <label for="" class="form-label ">Tempat Sidang</label>
                                <input type="text" class="form-control" name="tempat" value="{{ old('tempat') }}">
                            </div>
                        </div>
                    </div>

                </div>

                <div class="modal-footer required">
                    <div class="col">
                        <label class="control-label font-italic">
                            : Kolom Wajib Diisi | Ukuran file maksimal 1024KB
                        </label>
                    </div>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-undo">
                        </i> Kembali</button>
                    <button type="submit" class="btn btn-primary"><i class="fa fa-save"> </i> Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Edit --}}
@foreach ($s_list as $item)
<div class="modal fade" id="modalEditSidang{{ $item->id }}" tabindex="-1" role="dialog"
    aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Edit Data Sidang</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @if (count($errors) > 0)
            <div class="modal-header">
                <div class="alert alert-danger ">
                    @foreach ($errors->all() as $error)
                    <span class="text-danger">
                        {{ $error }}
                    </span>
                    @endforeach
                </div>
            </div>
            @endif

            <form method="POST" enctype="multipart/form-data" action="sidang-ta/{{ $item->id }}">
                @method('put')
                @csrf
                <div class="modal-body">
                    <div class="form-group required">
                        <div class="row">
                            <div class="col">
                                <label class="control-label">NIM</label>
                                <input type="text" class="form-control" value="{{
                                        $item->daftarta->mahasiswa->biodata->no_induk }} - {{
                                        $item->daftarta->mahasiswa->biodata->nama }}" readonly>
                                <input type="hidden" name="daftar_ta_id" value="{{ $item->daftar_ta_id }}">
                            </div>
                            <div class="col">
                                <label class="control-label">Tahun Akademik</label>
                                <input type="text" class="form-control" value="{{ $item->thnakademik->tahun }}"
                                    readonly>
                                <input type="hidden" class="form-control" name="thn_akademik_id"
                                    value="{{ $item->thn_akademik_id }}">
                            </div>
                        </div>
                    </div>

                    <div class="form-group required">
                        <div class="row">
                            <div class="col">
                                <label class="control-label">Tanggal Sidang</label>
                                <input type="date" class="form-control" name="tgl_sidang"
                                    value="{{ $item->tgl_sidang }}">
                            </div>
                            <div class="col">
                                <label class="control-label">
                                    Jam Mulai Sidang
                                </label>
                                <input type="time" class="form-control" name="jam_mulai_sidang"
                                    value="{{ $item->jam_mulai_sidang }}">
                            </div>
                            <div class="col">
                                <label class="control-label">
                                    Jam Akhir Sidang
                                </label>
                                <input type="time" class="form-control" name="jam_akhir_sidang"
                                    value="{{ $item->jam_akhir_sidang }}">
                            </div>
                        </div>
                    </div>

                    <div class="form-group required">
                        <div class="row">
                            <div class="col-6">
                                <label class="control-label"> Judul Tugas Akhir </label>
                                <input type="text" class="form-control" name="judul" value="{{ $item->judul }}">
                            </div>
                            <div class="col">
                                <label class="control-label"> Status Sidang </label>
                                @if (Auth::user()->level==0)
                                <input type="text" class="form-control text-capitalize" value="{{ $item->stts_sidang }}"
                                    readonly>
                                <input type="hidden" value="{{ $item->stts_sidang }}" name="stts_sidang">
                                {{-- <option value="proses">Proses</option> --}}
                                @else
                                <select class="form-control" name="stts_sidang" required>
                                    <option value="" hidden="">-- Status Sidang --</option>
                                    <option @php if($item->stts_sidang == 'proses') echo 'selected';
                                        @endphp value="proses">Proses</option>
                                    <option @php if($item->stts_sidang == 'terjadwal') echo 'selected';
                                        @endphp value="terjadwal">Terjadwal</option>
                                    <option @php if($item->stts_sidang == 'selesai') echo 'selected';
                                        @endphp value="selesai">Selesai</option>
                                    @endif
                                </select>
                            </div>
                            @if (Auth::user()->level==2)
                            <div class="col">
                                <label for="" class="form-label control-label">Dosen Penguji </label>
                                <select class="form-control" name="d_penguji" size="1">
                                    <option value="" hidden="">-- Dosen Penguji--</option>
                                    @foreach ($dosen as $k)
                                    <option value="{{ $k->id }}" {{ $k->id == $item->d_penguji ? 'selected':'' }}>{{
                                        $k->biodata->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @endif
                        </div>
                    </div>

                    <div class="form-group required">
                        <div class="row">
                            <div class="col">
                                <label for="image" class="form-label control-label">Form Bimbingan 1</label>
                                <input type="hidden" name="oldImage1" value="{{ $item->f_bimbingan_1 }}">
                                <input type="file" class="form-control picture" id="image4" name="f_bimbingan_1"
                                    onchange="previewImage(4)">

                                @if ($item->f_bimbingan_1)
                                <img src="{{ asset('storage/' . $item->f_bimbingan_1) }}"
                                    class="img-preview img-fluid mt-2 col-sm-5" id="preview4">
                                @else
                                <img class="img-preview img-fluid mt-2 col-sm-5" id="preview4">
                                @endif
                                <p class="mt-1 font-italic">biarkan kolom kosong
                                    jika tidak diganti</p>
                            </div>
                            <div class="col">
                                <label for="image" class="form-label control-label">Form Bimbingan 2</label>
                                <input type="hidden" name="oldImage2" value="{{ $item->f_bimbingan_2 }}">
                                <input type="file" class="form-control picture" id="image5" name="f_bimbingan_2"
                                    onchange="previewImage(5)">

                                @if ($item->f_bimbingan_2)
                                <img src="{{ asset('storage/' . $item->f_bimbingan_2) }}"
                                    class="img-preview img-fluid mt-2 col-sm-5" id="preview5">
                                @else
                                <img class="img-preview img-fluid mt-2 col-sm-5" id="preview5">
                                @endif
                                <p class="mt-1 font-italic">biarkan kolom kosong
                                    jika tidak diganti</p>
                            </div>
                        </div>
                    </div>
                    <div class="form-group required">
                        <div class="row">
                            <div class="col">
                                <label for="image" class="form-label control-label">Slip Pembayaran Sidang</label>
                                <input type="hidden" name="oldImage3" value="{{ $item->slip_pembayaran_sidang }}">
                                <input type="file" class="form-control picture" id="image6"
                                    name="slip_pembayaran_sidang" onchange="previewImage(6)">

                                @if ($item->slip_pembayaran_sidang)
                                <img src="{{ asset('storage/' . $item->slip_pembayaran_sidang) }}"
                                    class="img-preview img-fluid mt-2 col-sm-4" id="preview6">
                                @else
                                @endif
                                <p class="mt-1 font-italic">biarkan kolom kosong
                                    jika tidak diganti</p>
                            </div>
                            <div class="col">
                                <label for="image" class="form-label control-label">Slip Pembayaran Skripsi</label>
                                <input type="hidden" name="oldImage3" value="{{ $item->slip_pembayaran_skripsi }}">
                                <input type="file" class="form-control picture" id="image9"
                                    name="slip_pembayaran_skripsi" onchange="previewImage(9)">

                                @if ($item->slip_pembayaran_skripsi)
                                <img src="{{ asset('storage/' . $item->slip_pembayaran_skripsi) }}"
                                    class="img-preview img-fluid mt-2 col-sm-4" id="preview9">
                                @else
                                @endif
                                <p class="mt-1 font-italic">biarkan kolom kosong
                                    jika tidak diganti</p>
                            </div>

                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col">
                                <label for="image" class="form-label control-label">KRS (Tertera Mata Kuliah
                                    Skripsi)</label>
                                <input type="hidden" name="oldImage3" value="{{ $item->krs }}">
                                <input type="file" class="form-control picture" id="image10" name="krs"
                                    onchange="previewImage(10)">

                                @if ($item->krs)
                                <img src="{{ asset('storage/' . $item->krs) }}"
                                    class="img-preview img-fluid mt-2 col-sm-4" id="preview10">
                                @else
                                @endif
                                <p class="mt-1 font-italic">biarkan kolom kosong
                                    jika tidak diganti</p>
                            </div>
                            <div class="col">
                                <label for="" class="form-label">Tempat </label>
                                <input type="text" name="tempat" class="form-control" value="{{ $item->tempat }}">
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer required">
                        <div class="col">
                            <label class="control-label font-italic">
                                : Kolom Wajib Diisi | Ukuran file maksimal
                                <span class="text-danger">1024
                                    KB</span>
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

{{-- view Form Bimbingan 1--}}
@foreach ($s_list as $item)
<div class="modal fade" id="viewForm_1{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-capitalize" id="exampleModalLongTitle">Form Bimbingan 1 - {{
                    $item->daftarta->mahasiswa->biodata->nama
                    }} | {{ $item->daftarta->mahasiswa->biodata->no_induk }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <div class="form-group">
                    <div class="row">
                        @if ($item->f_bimbingan_1)
                        <div class="col">
                            <img src="{{ asset('storage/' . $item->f_bimbingan_1) }}" alt=""
                                class="rounded mx-auto d-block" style="width: 30%">
                        </div>
                        @else
                        <div class="col">
                            <p class="text-center">Gambar Tidak Ditemukan</p>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach

{{-- view Form Bimbingan 2--}}
@foreach ($s_list as $item)
<div class="modal fade" id="viewForm_2{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-capitalize" id="exampleModalLongTitle">Form Bimbingan 2 - {{
                    $item->daftarta->mahasiswa->biodata->nama
                    }} | {{ $item->daftarta->mahasiswa->biodata->no_induk }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <div class="form-group">
                    <div class="row">
                        @if ($item->f_bimbingan_2)
                        <div class="col">
                            <img src="{{ asset('storage/' . $item->f_bimbingan_2) }}" alt=""
                                class="rounded mx-auto d-block" style="width: 30%">
                        </div>
                        @else
                        <div class="col">
                            <p class="text-center">Gambar Tidak Ditemukan</p>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach

{{-- Slip Pembayaran Sidang--}}
@foreach ($s_list as $item)
<div class="modal fade" id="viewSlipSidang{{ $item->id }}" tabindex="-1" role="dialog"
    aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-capitalize" id="exampleModalLongTitle">Slip Pembayaran Sidang - {{
                    $item->daftarta->mahasiswa->biodata->no_induk }}
                    | {{ $item->daftarta->mahasiswa->biodata->nama
                    }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <div class="form-group">
                    <div class="row">
                        @if ($item->slip_pembayaran_sidang)
                        <div class="col">
                            <img src="{{ asset('storage/' . $item->slip_pembayaran_sidang) }}" alt=""
                                class="rounded mx-auto d-block" style="width: 30%">
                        </div>
                        @else
                        <div class="col">
                            <p class="text-center">Gambar Tidak Ditemukan</p>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach

{{-- Slip Pembayaran Skripsi--}}
@foreach ($s_list as $item)
<div class="modal fade" id="viewSlipSkripsi{{ $item->id }}" tabindex="-1" role="dialog"
    aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-capitalize" id="exampleModalLongTitle">Slip Pembayaran Skripsi - {{
                    $item->daftarta->mahasiswa->biodata->no_induk }}
                    | {{ $item->daftarta->mahasiswa->biodata->nama
                    }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <div class="form-group">
                    <div class="row">
                        @if ($item->slip_pembayaran_skripsi)
                        <div class="col">
                            <img src="{{ asset('storage/' . $item->slip_pembayaran_skripsi) }}" alt=""
                                class="rounded mx-auto d-block" style="width: 30%">
                        </div>
                        @else
                        <div class="col">
                            <p class="text-center">Gambar Tidak Ditemukan</p>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach

{{-- view KRS --}}
@foreach ($s_list as $item)
<div class="modal fade" id="viewKRS{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-capitalize" id="exampleModalLongTitle">Kartu Rencana Studi - {{
                    $item->daftarta->mahasiswa->biodata->nama
                    }} | {{ $item->daftarta->mahasiswa->biodata->no_induk }} </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <div class="form-group">
                    <div class="row">
                        @if ($item->krs)
                        <div class="col">
                            <img src="{{ asset('storage/' . $item->krs) }}" alt="" class="rounded mx-auto d-block"
                                style="width: 30%">
                        </div>
                        @else
                        <div class="col">
                            <p class="text-center">Gambar Tidak Ditemukan</p>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
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
                            {!! $pengumuman->cttn_sidang_ta !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Hapus --}}
@foreach ($s_list as $item)
<div class="modal fade" id="modalHapusSidang{{ $item->id }}" tabindex="-1" role="dialog"
    aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-open">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="exampleModalLongTitle">Hapus Data Sidang</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form method="POST" enctype="multipart/form-data" action="/sidang-ta/{{ $item->id }}">
                @method('delete')
                @csrf
                <div class="modal-body">

                    <input type="hidden" value="{{ $item->id }}" name="id" required>

                    <div class=" form-group">
                        <h3>Apakah anda yakin menghapus data
                            <span class="text-danger text-capitalize">{{ $item->daftarta->mahasiswa->biodata->nama
                                }}</span>
                            dengan
                            NIM <span class="text-danger">{{
                                $item->daftarta->mahasiswa->biodata->no_induk
                                }} </span> ?
                        </h3>
                        <h4 class="btn btn-warning text-uppercase">Data Terkait NIM tersebut juga akan terhapus!</h4>

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

{{-- update status pengajuan --}}
@foreach ($s_list as $ta)
<div class="modal fade" id="modalUpdateStatus{{ $ta->id }}" tabindex="-1" role="dialog"
    aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Perbarui Status Seminar | {{
                    $ta->daftarta->mahasiswa->biodata->nama }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form method="POST" enctype="multipart/form-data" action="/update-status-sidang/{{ $ta->id }}">
                @method('put')
                @csrf
                <div class="modal-body">

                    <input type="hidden" value="{{ $ta->id }}" name="id" required>

                    <div class="form-group">
                        <select class="form-control" name="stts_sidang" required>
                            <option value="" hidden="">-- Status Seminar --</option>
                            <option @php if($ta->stts_sidang == 'proses') echo 'selected';
                                @endphp value="proses">Proses</option>
                            <option @php if($ta->stts_sidang == 'terjadwal') echo 'selected';
                                @endphp value="terjadwal">Terjadwal</option>
                            <option @php if($ta->stts_sidang == 'selesai') echo 'selected';
                                @endphp value="selesai">Selesai</option>
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

@foreach ($s_list as $item)
<div class="modal fade" id="viewJudul{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Judul TA - {{
                    $item->daftarta->mahasiswa->biodata->no_induk }}
                    | {{ $item->daftarta->mahasiswa->biodata->nama
                    }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <div class="form-group">
                    <div class="row">
                        <div class="col">
                            {{ $item->judul }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach

<script src="/assets/js/core/jquery.3.2.1.min.js"></script>

<script>
    // untuk mendapatkan id mahasiswa
    function no_mahasiswa() {
        let daftar_ta_id = $("#daftar_ta_id").val();
            $("#judul").children().remove();
                if (daftar_ta_id != '' && daftar_ta_id != null) {
                    $.ajax({

                    url: "{{ url('') }}/sidang-ta/daftar_ta_id/" + daftar_ta_id,
                    success: function (res) {
                    $("#judul").val(res.judul);
                    }
                });
            }else if(daftar_ta_id ==null){
                $("#judul").val(res.null);
            }
    }

    $(document).ready(function () {
        var table = $("#seminar-kp").DataTable({});
        $("#filter-tahun").change(function () {
            table.column($(this).data("column")).search($(this).val()).draw();
        });
        $("#filter-stts").change(function () {
            table.column($(this).data("column")).search($(this).val()).draw();
        });
    });
</script>
<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

</script>
<script>
    function previewImage(index) {
        const image = document.querySelector('#image' + index);
        const imgPreview = document.querySelector('#preview' + index);

        imgPreview.style.display = 'block';

        const oFReader = new FileReader();
        oFReader.readAsDataURL(image.files[0]);

        oFReader.onload = function (oFREvent) {
        imgPreview.src = oFREvent.target.result;
        }
}
</script>
@endsection