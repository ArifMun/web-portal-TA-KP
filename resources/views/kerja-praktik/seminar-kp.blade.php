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
                <h4 class="page-title">Seminar Kerja Praktik</h4>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <h4 class="card-title"></h4>
                                <a href="/seminar-kp/daftar" class="btn btn-primary btn-round ml-auto"
                                    data-toggle="modal" data-target="#modalDaftarSeminar">
                                    <i class="fa fa-plus"></i>
                                    Daftar
                                </a>
                            </div>
                        </div>

                        <div class="card-body">
                            {{-- <div class="row">
                                <div class="body-panel col-4">
                                    <label class="font-weight-bold h6">Filter Kategori</label>
                                    <select data-column="1" class="form-control col-sm-12" id="filter-kategori">
                                        <option value="">-- Pilih Kategori --</option>
                                        @foreach ($kategori as $k)
                                        <option value=" {{ $k->kode_kategori }}">{{ $k->nama_kategori }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="body-panel col-4">
                                    <label class="font-weight-bold h6">Filter Kondisi</label>
                                    <select data-column="8" class="form-control col-sm-12" id="filter-kondisi">
                                        <option value="">-- Pilih Kondisi --</option>
                                        <option value="BAIK">BAIK</option>
                                        <option value="RUSAK">RUSAK</option>
                                    </select>
                                </div>
                                <div class="body-panel col-4">
                                    <label class="font-weight-bold h6">Filter Tahun</label>
                                    <select data-column="7" class="form-control col-sm-12" id="filter-tahun">
                                        <option value="">-- Pilih Tahun --</option>
                                        @for ($i = date('Y'); $i >= date('Y')-5; $i-=1)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div> --}}
                            <div class="divider"></div>
                            <div class="table-responsive">
                                <table id="add-row" class="display table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>NIM</th>
                                            <th>Nama</th>
                                            <th>Dosen Pembimbing</th>
                                            <th>Status Seminar</th>
                                            <th>Semester</th>
                                            <th>Form Bimbingan</th>
                                            <th>Slip Pembayaran</th>
                                            <th>Tahun</th>
                                            <th>Judul</th>
                                            <th>Tanggal Seminar</th>
                                            <th>Jam Seminar</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>

                                    @if (Auth::user()->level==0)
                                    <tbody>
                                        @if (!empty(Auth::user()->biodata->mahasiswa->seminarkp))
                                        @foreach ($seminarmhs as $item)
                                        {{-- {{ $item }} --}}
                                        <tr>@php $no=1; @endphp
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $item->daftarkp->mahasiswa->biodata->no_induk}}</td>
                                            <td>{{ $item->daftarkp->mahasiswa->biodata->nama }}</td>
                                            <td>
                                                @foreach ($dosen as $k)
                                                {{ $k->id == $item->daftarkp->d_pembimbing_1 ?
                                                $k->biodata->nama :''
                                                }}
                                                @endforeach
                                            </td>

                                            @if ($item->daftarkp->seminarkp->stts_seminar=='proses')
                                            <td>
                                                <a
                                                    class="btn-warning btn-round p-1 font-weight-bold text-light text-capitalize">
                                                    {{
                                                    $item->daftarkp->seminarkp->stts_seminar }}</a>
                                            </td>
                                            @elseif($item->daftarkp->seminarkp->stts_seminar=='selesai')
                                            <td>
                                                <a
                                                    class="btn-success btn-round p-1 font-weight-bold text-light text-capitalize">
                                                    {{
                                                    $item->daftarkp->seminarkp->stts_seminar }}</a>
                                            </td>
                                            @else
                                            <td>
                                                <a
                                                    class="btn-primary btn-round p-1 font-weight-bold text-light text-capitalize">
                                                    {{
                                                    $item->daftarkp->seminarkp->stts_seminar }}</a>
                                            </td>
                                            @endif

                                            <td>{{ $item->daftarkp->semester }}</td>

                                            <td><a href="seminar-kp/view-form/{{ $item->daftarkp->seminarkp->id }}"
                                                    data-toggle="modal"
                                                    data-target="#viewForm{{ $item->daftarkp->seminarkp->id }}"
                                                    class="btn-round btn-success btn-xs"><i class="fa fa-eye">
                                                    </i> </a>
                                            </td>

                                            <td><a href="seminar-kp/view-slip/{{ $item->daftarkp->id}}"
                                                    data-toggle="modal" data-target="#viewSlip{{ $item->daftarkp->id}}"
                                                    class="btn-round btn-success btn-xs"><i class="fa fa-eye">
                                                    </i> </a>
                                            </td>

                                            <td>{{ $item->daftarkp->tahunakademik->tahun }} </td>
                                            <td>{{ $item->daftarkp->seminarkp->judul }}</td>
                                            <td>{{ $item->daftarkp->seminarkp->tgl_seminar }}</td>
                                            <td>{{ $item->daftarkp->seminarkp->jam_seminar }}</td>
                                            <td>
                                                <a href="seminar-kp/edit/{{ $item->daftarkp->seminarkp->id }}"
                                                    data-toggle="modal"
                                                    data-target="#modalEditSeminar{{ $item->daftarkp->seminarkp->id }}"
                                                    class="btn btn-warning btn-xs"><i class="fa fa-edit">
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

                                    {{-- All- --}}
                                    @elseif(Auth::user()->level == 1)
                                    <tbody> @php $no=1; @endphp
                                        @foreach ($seminarkp as $row)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $row->daftarkp->mahasiswa->biodata->no_induk }}</td>
                                            <td>{{ $row->daftarkp->mahasiswa->biodata->nama }}</td>
                                            <td>
                                                @foreach ($dosen as $k)
                                                {{ $k->id == $row->daftarkp->d_pembimbing_1 ?
                                                $k->biodata->nama :''
                                                }}
                                                @endforeach
                                            </td>
                                            @if ($row->stts_seminar=='proses')
                                            <td>
                                                <a
                                                    class="btn-warning btn-round p-1 font-weight-bold text-light text-capitalize">
                                                    {{
                                                    $row->stts_seminar }}</a>
                                            </td>
                                            @elseif($row->stts_seminar=='selesai')
                                            <td>
                                                <a
                                                    class="btn-success btn-round p-1 font-weight-bold text-light text-capitalize">
                                                    {{
                                                    $row->stts_seminar }}</a>
                                            </td>
                                            @else
                                            <td>
                                                <a
                                                    class="btn-primary btn-round p-1 font-weight-bold text-light text-capitalize">
                                                    {{
                                                    $row->stts_seminar }}</a>
                                            </td>
                                            @endif

                                            <td>{{ $row->daftarkp->semester }}</td>

                                            <td><a href="seminar-kp/view-form/{{ $row->id }}" data-toggle="modal"
                                                    data-target="#viewForm{{ $row->id }}"
                                                    class="btn-round btn-success btn-xs"><i class="fa fa-eye">
                                                    </i> </a>
                                            </td>

                                            <td><a href="seminar-kp/view-slip/{{ $row->id }}" data-toggle="modal"
                                                    data-target="#viewSlip{{ $row->id }}"
                                                    class="btn-round btn-success btn-xs"><i class="fa fa-eye">
                                                    </i> </a>
                                            </td>

                                            <td>{{ $row->daftarkp->tahunakademik->tahun }}</td>
                                            <td>{{ $row->judul }}</td>
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


                    {{-- <select name="stts_pengajuan" id="" hidden>
                        <option value="tertunda" selected>tertunda</option>
                    </select> --}}
                    <div class="form-group required">
                        <div class="row">
                            <div class="col">
                                <label class="control-label">NIM - Nama - Tahun </label>
                                <select class="form-control" name="daftarkp_id" onchange="no_biodata()" id="biodata"
                                    required>
                                    <option value="" hidden="">-- Pilih --</option>

                                    @if (Auth::user()->level==0 )
                                    @foreach ($mhskps as $item)
                                    <option value="{{ $item->id}}">{{
                                        $item->mahasiswa->biodata->no_induk
                                        }} - {{ $item->mahasiswa->biodata->nama
                                        }} - {{ $item->tahunakademik->tahun }}
                                        {{-- {{
                                        $item->daftarkp->mahasiswa->biodata->nama
                                        }} - {{
                                        $item->daftarkp->tahunakademik->tahun
                                        }} --}}
                                    </option>
                                    @endforeach
                                    <input type="hidden" value="{{ Auth::user()->biodata->mahasiswa->id }}"
                                        name="mahasiswa_id">
                                    @else

                                    @foreach ($daftarkp as $k)
                                    <option value="{{ $k->id }}">{{
                                        $k->mahasiswa->biodata->no_induk
                                        }} - {{ $k->mahasiswa->biodata->nama
                                        }} - {{ $k->tahunakademik->tahun
                                        }}</option>
                                    @endforeach

                                    @endif
                                </select>
                            </div>
                            {{-- <div class="col">
                                <label>Tahun</label>
                                <input type="text" class="form-control" name="tahun" id="tahun" readonly>
                            </div> --}}
                        </div>
                    </div>

                    <div class="form-group required">
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
                                <input type="text" class="form-control" name="judul">
                            </div>
                            <div class="col">
                                <label class="control-label">Status Seminar </label>
                                <select class="form-control" name="stts_seminar" required>
                                    @if (Auth::user()->level==0)
                                    <option value="proses" @readonly(true)>Proses</option>
                                    @else
                                    <option value="" hidden="">-- Status KP --</option>
                                    <option value="proses">Proses</option>
                                    <option value="terjadwal">Terjadwal</option>
                                    <option value="selesai">Selesai</option>
                                    @endif
                                </select>
                            </div>
                        </div>
                    </div>


                    <div class="form-group required">
                        <div class="row">
                            <div class="col">
                                <label>Catatan</label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="col">
                                <label for="image" class="form-label control-label">Form Bimbingan</label>
                                <img class="img-preview img-fluid mb-3 col-sm-5" alt="">
                                <input type="file" class="form-control picture" id="form_bimbingan"
                                    name="form_bimbingan" onchange="previewImage()">
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
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
                    <div class="form-group">
                        <div class="row">
                            <div class="col">
                                <label>NIM</label>
                                <select class="form-control" name="daftarkp_id" onchange="no_biodata()" id="biodata">
                                    <option value="{{ $item->daftarkp_id }}">{{
                                        $item->daftarkp->mahasiswa->biodata->no_induk }} - {{
                                        $item->daftarkp->mahasiswa->biodata->nama }} - {{
                                        $item->daftarkp->tahunakademik->tahun }}</option>
                                </select>
                                <input type="hidden" value="{{ $item->mahasiswa_id }}" name="mahasiswa_id">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col">
                                <label>Tanggal Seminar</label>
                                <input type="date" class="form-control" name="tgl_seminar"
                                    value="{{ $item->tgl_seminar }}">
                            </div>
                            <div class="col">
                                <label>
                                    Jam Seminar
                                </label>
                                <input type="time" class="form-control" name="jam_seminar"
                                    value="{{ $item->jam_seminar }}">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col">
                                <label &#42;>Judul KP </label>
                                <input type="text" class="form-control" name="judul" value="{{ $item->judul }}">
                            </div>
                            <div class="col">
                                <label>Status Seminar</label>
                                <select class="form-control" name="stts_seminar" required>
                                    @if (Auth::user()->level==0)
                                    <option value="proses">Proses</option>
                                    @else
                                    <option value="" hidden="">-- Status KP --</option>
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
                            <div class="col">
                                <label>Catatan</label>
                                <input type="text" class="form-control" value="{{ $item->catatan }}">
                            </div>
                            <div class="col">
                                <label for="image" class="form-label">Form Bimbingan</label>
                                <input type="hidden" name="oldImage" value="{{ $item->form_bimbingan }}">

                                @if ($item->form_bimbingan)
                                <img src="{{ asset('storage/' . $item->form_bimbingan) }}"
                                    class="img-preview img-fluid mb-2 col-sm-2 d-block">
                                @endif

                                <img class="img-preview img-fluid mb-3 col-sm-5" alt="">
                                <input type="file" class="form-control picture" id="form_bimbingan"
                                    name="form_bimbingan" onchange="previewImage()">
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
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
                <h5 class="modal-title" id="exampleModalLongTitle">Form Bimbingan</h5>
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
                <h5 class="modal-title" id="exampleModalLongTitle">Slip Pembayaran</h5>
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

{{-- View --}}
{{-- @foreach ($barang as $d)
<div class="modal fade" id="viewDataBarang{{ $d->id }}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Detail Barang</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <div class="form-group">
                    <div class="row">
                        @if ($d->image)
                        <div class="col">
                            <img src="{{ asset('storage/' . $d->image) }}" alt="" class="rounded mx-auto d-block"
                                style="width: 18%">
                        </div>
                        @else
                        <div class="col">
                            <p class="text-center">Gambar Tidak Ditemukan</p>
                        </div>
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col">
                            <ul class="list-group">
                                <li class="list-group-item">Nama Barang</li>
                                <li class="list-group-item">Kategori</li>
                                <li class="list-group-item">No Barang</li>
                                <li class="list-group-item">Penulis</li>
                                <li class="list-group-item">Jumlah</li>
                                <li class="list-group-item">Unit</li>
                                <li class="list-group-item">Tahun</li>
                                <li class="list-group-item">Kondisi</li>
                                <li class="list-group-item">Keterangan</li>
                            </ul>
                        </div>
                        <div class="col">
                            <ul class="list-group">
                                <li class="list-group-item">{{ $d->nama_barang }}</li>
                                <li class="list-group-item">{{ $d->nama_kategori }}</li>
                                <li class="list-group-item">{{ $d->no_barang }}</li>
                                <li class="list-group-item">{{ Auth::user()->level }}</li>
                                <li class="list-group-item">{{ $d->jumlah }}</li>
                                <li class="list-group-item">{{ $d->unit }}</li>
                                <li class="list-group-item">{{ $d->tahun }}</li>
                                <li class="list-group-item">{{ $d->kondisi }}</li>
                                <li class="list-group-item">{{ $d->keterangan }}.</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach --}}

{{-- Hapus --}}
{{-- @foreach ($seminarkp as $kp)
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
                        <h3>Apakah anda ingin menghapus data ini ?</h3>
                        <p class="text-danger">Dengan Nama <b>{{ $kp->daftarkp->mahasiswa->biodata->nama }}<b> dan
                                    No
                                    Induk {{ $kp->daftarkp->mahasiswa->biodata->no_induk }}</p>
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
@endforeach --}}

<script>
    function no_biodata() {
        let biodata = $("#biodata").val();
        $("#tahun").children().remove();
        if (biodata != '' && biodata != null) {
            $.ajax({

                url: "{{ url('') }}/seminar-kp/biodata/" + biodata,
                success: function (res) {
                    $("#tahun").val(res.id);
                }
            });
        }
    }
</script>
@endsection