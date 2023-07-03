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
                @if (Auth::user()->level==0)
                <h4 class="page-title">Seminar Kerja Praktik [Mahasiswa]</h4>
                @else
                <h4 class="page-title">Seminar Kerja Praktik</h4>
                @endif
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <div class="">Readme First
                                    <a href="seminar-kp/view-pengumuman" data-toggle="modal"
                                        data-target="#viewPengumuman"><i class="fa fa-eye ml-2">
                                        </i>
                                    </a>
                                </div>

                                @if ($registerSeminar || UserCheck::levelAdmin())
                                <a href="/seminar-kp/daftar" class="btn btn-primary btn-round ml-auto"
                                    data-toggle="modal" data-target="#modalDaftarSeminar">
                                    <i class="fa fa-plus"></i>
                                    Daftar
                                </a>
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
                                                <select data-column="9" class="form-control" id="filter-tahun">
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
                                                <select data-column="4" class="form-control text-capitalize"
                                                    id="filter-stts">
                                                    <option value="">-- Pilih Status Seminar --</option>
                                                    @foreach ($filterStts as $item)
                                                    <option value="{{ $item->stts_seminar }}" class="text-capitalize">{{
                                                        $item->stts_seminar }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-6 col-md-3">
                                    <div class="row align-items-center">
                                        <div class="col col-stats ml-3 ml-sm-0">
                                            <p class="font-weight-bold h6">Status Seminar</p>
                                            <p class="font-weight-bold badge badge-success mr-1">
                                                Selesai
                                                : {{
                                                $sSelesai}}
                                            </p>
                                            <p class="font-weight-bold badge badge-primary mr-1">
                                                Terjadwal :
                                                {{
                                                $sTerjadwal }}
                                            </p>
                                            <p class="font-weight-bold badge badge-warning">
                                                Proses
                                                :
                                                {{
                                                $sProses
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
                                            <th>NIM</th>
                                            <th>Nama</th>
                                            <th>Dosen Pembimbing</th>
                                            <th>Status Seminar</th>
                                            <th>Semester</th>
                                            <th>Form Bimbingan</th>
                                            <th>Slip Pembayaran</th>
                                            <th>Judul</th>
                                            <th>Tahun Akademik</th>
                                            {{-- <th>Catatan</th> --}}
                                            <th>Tanggal Seminar</th>
                                            <th>Jam Seminar</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>

                                    @if (Auth::user()->level==0)
                                    <tbody>
                                        @if (empty(Auth::user()->biodata->mahasiswa->daftarkp->seminarkp))
                                        @foreach ($seminarmhs as $item)
                                        {{-- {{ $item }} --}}
                                        <tr align="center">@php $no=1; @endphp
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $item->daftarkp->mahasiswa->biodata->no_induk}}</td>
                                            <td>{{ $item->daftarkp->mahasiswa->biodata->nama }}</td>
                                            <td class="text-capitalize">
                                                @foreach ($dosen as $k)
                                                {{ $k->id == $item->daftarkp->d_pembimbing_1 ?
                                                $k->biodata->nama :''
                                                }}
                                                @endforeach
                                            </td>

                                            @if ($item->stts_seminar=='proses')
                                            <td>
                                                <a
                                                    class="badge badge-warning font-weight-bold text-light text-capitalize">
                                                    {{
                                                    $item->stts_seminar }}</a>
                                            </td>
                                            @elseif($item->stts_seminar=='selesai')
                                            <td>
                                                <a
                                                    class="badge badge-success font-weight-bold text-light text-capitalize">
                                                    {{
                                                    $item->stts_seminar }}</a>
                                            </td>
                                            @else
                                            <td>
                                                <a
                                                    class="badge badge-primary font-weight-bold text-light text-capitalize">
                                                    {{
                                                    $item->stts_seminar }}</a>
                                            </td>
                                            @endif

                                            <td>{{ $item->daftarkp->semester }}</td>

                                            <td><a href="seminar-kp/view-form/{{ $item->daftarkp->seminarkp->id }}"
                                                    data-toggle="modal"
                                                    data-target="#viewForm{{ $item->daftarkp->seminarkp->id }}"><i
                                                        class="fa fa-file-image fa-2x">
                                                    </i> </a>
                                            </td>

                                            <td><a href="seminar-kp/view-slip/{{ $item->id}}" data-toggle="modal"
                                                    data-target="#viewSlip{{ $item->id}}"><i
                                                        class="fa fa-file-image fa-2x">
                                                    </i> </a>
                                            </td>

                                            {{-- <td>{{ $item->daftarkp->seminarkp->judul }}</td> --}}
                                            <td>
                                                <a href="seminar-kp/view-judul/{{ $item->id }}" data-toggle="modal"
                                                    data-target="#viewJudul{{ $item->id }}"><i class="fa fa-eye ">
                                                    </i>
                                                </a>
                                            </td>
                                            <td>{{ $item->thnakademik->tahun }} </td>
                                            {{-- <td>{{ $item->daftarkp->seminarkp->catatan }}</td> --}}
                                            <td>{{ $item->tgl_seminar }}</td>
                                            <td>{{ $item->jam_seminar }}</td>
                                            <td>
                                                @if ($item->stts_seminar=='selesai' || $item->stts_seminar=='terjadwal')

                                                @else
                                                <a href="seminar-kp/edit/{{ $item->id }}" data-toggle="modal"
                                                    data-target="#modalEditSeminar{{ $item->id }}"
                                                    class="btn btn-warning btn-xs"><i class="fa fa-edit">
                                                    </i>
                                                </a>
                                                <a href="seminar-kp/hapus/{{ $item->id }}" data-toggle="modal"
                                                    data-target="#modalHapusSeminar{{ $item->id }}"
                                                    class="btn btn-danger btn-xs"><i class="fa fa-trash">
                                                    </i>
                                                </a>
                                                @endif
                                            </td>
                                        </tr>
                                        @endforeach

                                        @endif
                                    </tbody>

                                    {{-- All- --}}
                                    @elseif(Auth::user()->level !=0)
                                    <tbody> @php $no=1; @endphp
                                        @foreach ($seminarkp as $row)
                                        <tr align="center">
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $row->daftarkp->mahasiswa->biodata->no_induk }}</td>
                                            <td>{{ $row->daftarkp->mahasiswa->biodata->nama }}</td>
                                            <td class="text-capitalize">
                                                @foreach ($dosen as $k)
                                                {{ $k->id == $row->daftarkp->d_pembimbing_1 ?
                                                $k->biodata->nama :''
                                                }}
                                                @endforeach
                                            </td>
                                            @if ($row->stts_seminar=='proses')
                                            <td>
                                                <a
                                                    class="badge badge-warning font-weight-bold text-light text-capitalize">
                                                    {{
                                                    $row->stts_seminar }}</a>
                                            </td>
                                            @elseif($row->stts_seminar=='selesai')
                                            <td>
                                                <a
                                                    class="badge badge-success font-weight-bold text-light text-capitalize">
                                                    {{
                                                    $row->stts_seminar }}</a>
                                            </td>
                                            @else
                                            <td>
                                                <a
                                                    class="badge badge-primary font-weight-bold text-light text-capitalize">
                                                    {{
                                                    $row->stts_seminar }}</a>
                                            </td>
                                            @endif

                                            <td>{{ $row->daftarkp->semester }}</td>

                                            <td>
                                                <a href="seminar-kp/view-form/{{ $row->id }}" data-toggle="modal"
                                                    data-target="#viewForm{{ $row->id }}"><i
                                                        class="fa fa-file-image fa-2x">
                                                    </i>
                                                </a>
                                            </td>

                                            <td>
                                                <a href="seminar-kp/view-slip/{{ $row->id }}" data-toggle="modal"
                                                    data-target="#viewSlip{{ $row->id }}"><i
                                                        class="fa fa-file-image fa-2x">
                                                    </i>
                                                </a>
                                            </td>

                                            <td>
                                                <a href="seminar-kp/view-judul/{{ $row->id }}" data-toggle="modal"
                                                    data-target="#viewJudul{{ $row->id }}"><i class="fa fa-eye">
                                                    </i>
                                                </a>
                                            </td>
                                            <td>{{ $row->thnakademik->tahun }}</td>
                                            {{-- <td>{{ $row->catatan }}</td> --}}
                                            <td>{{ $row->tgl_seminar }}</td>
                                            <td>{{ $row->jam_seminar }}</td>
                                            <td>
                                                <a href="seminar-kp/edit/{{ $row->id }}" data-toggle="modal"
                                                    data-target="#modalEditSeminar{{ $row->id }}"
                                                    class="btn btn-warning btn-xs"><i class="fa fa-edit">
                                                    </i> </a>
                                                <a href="seminar-kp/hapus/{{ $row->id }}" data-toggle="modal"
                                                    data-target="#modalHapusSeminar{{ $row->id }}"
                                                    class="btn btn-danger btn-xs"><i class="fa fa-trash">
                                                    </i> </a>
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
<div class="modal fade" id="modalDaftarSeminar" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Daftar Seminar Kerja Praktik</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form method="POST" enctype="multipart/form-data" action="seminar-kp">
                @csrf
                <div class="modal-body">
                    <div class="form-group required">
                        <div class="row">
                            <div class="col">
                                <label class="control-label">NIM - Nama - Tahun </label>
                                @if (Auth::user()->level==0 )
                                <input type="text" class="form-control" value="{{
                                        $mhskps->mahasiswa->biodata->no_induk
                                        }} - {{ $mhskps->mahasiswa->biodata->nama
                                        }}" readonly>
                                <input type="hidden" value="{{ $mhskps->id }}" name="daftarkp_id">
                                @else
                                <select class="form-control text-capitalize" name="daftarkp_id"
                                    onchange="no_mahasiswa()" id="daftarkp_id" required>
                                    <option value="" hidden="">-- Pilih --</option>

                                    {{-- @foreach ($mhskps as $item)
                                    <option value="{{ $item->id}}" class="text-capitalize">{{
                                        $item->mahasiswa->biodata->no_induk
                                        }} - {{ $item->mahasiswa->biodata->nama
                                        }} - {{ $item->tahunakademik->tahun }}
                                    </option>
                                    @endforeach --}}
                                    {{-- <input type="hidden" value="{{ Auth::user()->biodata->mahasiswa->id }}"
                                        name="mahasiswa_id"> --}}

                                    @foreach ($daftarkp as $k)
                                    <option value="{{ $k->id }}" class="text-capitalize">{{
                                        $k->mahasiswa->biodata->no_induk
                                        }} - {{ $k->mahasiswa->biodata->nama
                                        }} - {{ $k->tahunakademik->tahun
                                        }}</option>
                                    @endforeach

                                    @endif
                                </select>
                            </div>
                            <div class="col">
                                <label class="control-label">Tahun Akademik </label>
                                <input type="text" class="form-control" value="{{ $last_year->tahun }}" readonly>
                                <input type="hidden" class="form-control" name="thn_akademik_id"
                                    value="{{ $last_year->id }}">
                            </div>
                        </div>
                    </div>

                    <div class="form-group ">
                        <div class="row">
                            <div class="col">
                                <label class="control-label">Tanggal Seminar </label>
                                <input type="date" class="form-control" name="tgl_seminar">
                            </div>
                            <div class="col">
                                <label class="control-label">
                                    Jam Seminar
                                </label>
                                <input type="time" class="form-control" name="jam_seminar">
                            </div>
                        </div>
                    </div>

                    <div class="form-group required">
                        <div class="row">
                            <div class="col">
                                <label class="control-label">Judul Kerja Praktik </label>
                                @if (Auth::user()->level==0)
                                <input type="text" class="form-control" name="judul" value="{{ $mhskps->judul }}">
                                @else
                                <input type="text" class="form-control" name="judul" id="judul">
                                @endif
                            </div>
                            <div class="col">
                                <label class="control-label">Status Seminar </label>
                                @if (Auth::user()->level==0)
                                <input type="text" class="form-control" value="Proses" readonly>
                                <input type="hidden" value="proses" name="stts_seminar">
                                @else
                                <select class="form-control" name="stts_seminar" required>
                                    <option value="" hidden="">-- Status KP --</option>
                                    <option value="proses">Proses</option>
                                    <option value="terjadwal">Terjadwal</option>
                                    <option value="selesai">Selesai</option>
                                </select>
                                @endif
                            </div>
                        </div>
                    </div>


                    <div class="form-group required">
                        <div class="row">
                            <div class="col-6">
                                <label for="image" class="form-label control-label">Form Bimbingan</label>
                                <input type="file" class="form-control picture" id="image1" name="form_bimbingan"
                                    onchange="previewImage(1)">
                                <img class="img-preview img-fluid mt-2 col-sm-5" id="preview1">
                                <span class="font-italic text-muted">ukuran file maksimal <span class="text-danger">1024
                                        KB</span> </span>
                            </div>
                            <div class="col-6">
                                <label for="image" class="form-label control-label">Surat Keterangan Selesai</label>
                                <input type="file" class="form-control picture" id="image3" name="ket_selesai"
                                    onchange="previewImage(3)">
                                <img class="img-preview img-fluid mt-2 col-sm-5" id="preview3">
                                <span class="font-italic text-muted">ukuran file maksimal <span class="text-danger">1024
                                        KB</span> </span>
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

{{-- Edit --}}
@foreach ($seminarkp as $item)
<div class="modal fade" id="modalEditSeminar{{ $item->id }}" tabindex="-1" role="dialog"
    aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Edit Data KP</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form method="POST" enctype="multipart/form-data" action="seminar-kp/{{ $item->id }}">
                @method('put')
                @csrf
                <div class="modal-body">
                    <div class="form-group required">
                        <div class="row">
                            <div class="col">
                                <label class="control-label">NIM - Nama</label>
                                <input type="text" class="form-control" size="1" name="daftarkp_id" value="{{ $item->daftarkp->mahasiswa->biodata->no_induk }} - {{
                                    $item->daftarkp->mahasiswa->biodata->nama }}" readonly>
                                <input type="hidden" size="1" name="daftarkp_id" value="{{ $item->daftarkp_id }}">
                                {{-- <select class="form-control" name="daftarkp_id" id="daftarkp_id">
                                    <option value="{{ $item->daftarkp_id }}">{{
                                        $item->daftarkp->mahasiswa->biodata->no_induk }} - {{
                                        $item->daftarkp->mahasiswa->biodata->nama }}</option>
                                </select> --}}
                            </div>
                            <div class="col">
                                <label class="control-label">Tahun Akademik </label>
                                <input type="text" class="form-control" value="{{ $item->thnakademik->tahun }}"
                                    readonly>
                                <input type="hidden" class="form-control" value="{{ $item->thn_akademik_id }}"
                                    name="thn_akademik_id">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col">
                                <label class="control-label">&nbsp;Tanggal Seminar</label>
                                <input type="date" class="form-control" name="tgl_seminar"
                                    value="{{ $item->tgl_seminar }}">
                            </div>
                            <div class="col">
                                <label class="control-label">
                                    Jam Seminar
                                </label>
                                <input type="time" class="form-control" name="jam_seminar"
                                    value="{{ $item->jam_seminar }}">
                            </div>
                        </div>
                    </div>

                    <div class="form-group required">
                        <div class="row">
                            <div class="col">
                                <label class="control-label"> Judul Kerja Praktik </label>
                                <input type="text" class="form-control" name="judul" value="{{ $item->judul }}">
                            </div>
                            <div class="col">
                                <label class="control-label"> Status Seminar</label>
                                @if (Auth::user()->level==0)
                                <input type="text" class="form-control text-capitalize" value="proses" readonly>
                                <input type="hidden" class="form-control text-capitalize" value="proses"
                                    name="stts_seminar">
                                {{-- <option value="proses">Proses</option> --}}
                                @else
                                <select class="form-control" name="stts_seminar" required>
                                    <option value="" hidden="">-- Status Seminar --</option>
                                    <option @php if($item->stts_seminar == 'proses') echo 'selected';
                                        @endphp value="proses">Proses</option>
                                    <option @php if($item->stts_seminar == 'terjadwal') echo 'selected';
                                        @endphp value="terjadwal">Terjadwal</option>
                                    <option @php if($item->stts_seminar == 'selesai') echo 'selected';
                                        @endphp value="selesai">Selesai</option>
                                    @endif
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-6">
                                <label for="image" class="form-label">Form Bimbingan </label>
                                <input type="hidden" name="oldImage" value="{{ $item->form_bimbingan }}">
                                <input type="file" class="form-control picture" id="image2" name="form_bimbingan"
                                    onchange="previewImage(2)">

                                @if ($item->form_bimbingan)
                                <img src="{{ asset('storage/' . $item->form_bimbingan) }}"
                                    class="img-preview img-fluid mt-2 col-sm-4 mt-1" id="preview2">
                                @else
                                <img class="img-preview img-fluid mt-2 col-sm-5" id="preview2">
                                @endif
                                <p class="mt-1 font-italic text-muted">biarkan kolom kosong
                                    jika tidak diganti | ukuran file maksimal <span class="text-danger">1024
                                        KB</span> </p>
                            </div>
                            <div class="col-6">
                                <label for="image" class="form-label">Surat Keterangan Selesai </label>
                                <input type="hidden" name="oldImage" value="{{ $item->ket_selesai }}">
                                <input type="file" class="form-control picture" id="image4" name="ket_selesai"
                                    onchange="previewImage(4)">

                                @if ($item->ket_selesai)
                                <img src="{{ asset('storage/' . $item->ket_selesai) }}"
                                    class="img-preview img-fluid mt-4 col-sm-4 mt-1" id="preview4">
                                @else
                                <img class="img-preview img-fluid mt-4 col-sm-5" id="preview4">
                                @endif
                                <p class="mt-1 font-italic text-muted">biarkan kolom kosong
                                    jika tidak diganti | ukuran file maksimal <span class="text-danger">1024
                                        KB</span> </p>
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

{{-- view Form Bimbingan --}}
@foreach ($seminarkp as $item)
<div class="modal fade" id="viewForm{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Form Bimbingan - {{
                    $item->daftarkp->mahasiswa->biodata->no_induk }}
                    | {{ $item->daftarkp->mahasiswa->biodata->nama
                    }}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <div class="form-group">
                    <div class="row">
                        @if ($item->form_bimbingan)
                        <div class="col">
                            <img src="{{ asset('storage/' . $item->form_bimbingan) }}" alt=""
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

{{-- Slip Pembayaran --}}
@foreach ($seminarkp as $item)
<div class="modal fade" id="viewSlip{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">
                    Slip Pembayaran - {{ $item->daftarkp->mahasiswa->biodata->no_induk }}
                    | {{ $item->daftarkp->mahasiswa->biodata->nama
                    }}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <div class="form-group">
                    <div class="row">
                        @if ($item->daftarkp->slip_pembayaran)
                        <div class="col">
                            <img src="{{ asset('storage/' . $item->daftarkp->slip_pembayaran) }}" alt=""
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

{{-- Judul --}}
@foreach ($seminarkp as $item)
<div class="modal fade" id="viewJudul{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Judul KP - {{
                    $item->daftarkp->mahasiswa->biodata->no_induk }}
                    | {{ $item->daftarkp->mahasiswa->biodata->nama
                    }}
                </h5>
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
                            {!! $pengumuman->cttn_seminar_kp !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Hapus --}}
@foreach ($seminarkp as $kp)
<div class="modal fade" id="modalHapusSeminar{{ $kp->id }}" tabindex="-1" role="dialog"
    aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-open">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="exampleModalLongTitle">Hapus Data Seminar</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form method="POST" enctype="multipart/form-data" action="/seminar-kp/{{ $kp->id }}">
                @method('delete')
                @csrf
                <div class="modal-body">

                    <input type="hidden" value="{{ $kp->id }}" name="id" required>

                    <div class=" form-group">
                        <h3>Apakah anda yakin menghapus data
                            <span class="text-danger text-capitalize">{{ $kp->daftarkp->mahasiswa->biodata->nama
                                }}</span> dengan
                            NIM <span class="text-danger">{{
                                $kp->daftarkp->mahasiswa->biodata->no_induk
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

<script src="/assets/js/core/jquery.3.2.1.min.js"></script>

<script>
    function no_mahasiswa() {
        let daftarkp_id = $("#daftarkp_id").val();
        $("#mahasiswa_id").children().remove();
        $("#judul").children().remove();
        if (daftarkp_id != '' && daftarkp_id != null) {
            $.ajax({

                url: "{{ url('') }}/seminar-kp/mahasiswa_id/" + daftarkp_id,
                success: function (res) {
                    // $("#mahasiswa_id").val(res.mahasiswa_id);
                    $("#judul").val(res.judul);
                    // console.log(res.mahasiswa_id);
                }
            });
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
<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

</script>
@endsection