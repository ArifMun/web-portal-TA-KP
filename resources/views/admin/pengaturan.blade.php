@extends('layouts.layout')

@section('content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/froala-editor@3.2.6/css/froala_editor.pkgd.min.css">
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
</style>

<div class="main-panel">
    <div class="content">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">Pengaturan</h4>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <h4 class="card-title">Tahun Akademik</h4>
                                <a href="/akun/tambah" class="btn btn-primary btn-round ml-auto" data-toggle="modal"
                                    data-target="#tambahTahun">
                                    <i class="fa fa-plus"></i>
                                    Tambah
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="tabel-tahun" class="display table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Tahun Akademik</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @php
                                        $no=1;
                                        @endphp
                                        @foreach ($thnAkademik as $row)

                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $row->tahun}}</td>

                                            <td>
                                                <a href="#hapusDataTahun{{ $row->id }}" data-toggle="modal"
                                                    data-target="" class="btn btn-danger btn-xs"><i class="fa fa-trash">
                                                    </i> </a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <h4 class="card-title">Konsentrasi</h4>
                                <a href="/konsentrasi/tambah" class="btn btn-primary btn-round ml-auto"
                                    data-toggle="modal" data-target="#tambahKonsentrasi">
                                    <i class="fa fa-plus"></i>
                                    Tambah
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="tabel-konsentrasi" class="display table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Konsentrasi</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @php
                                        $no=1;
                                        @endphp
                                        @foreach ($konsentrasi as $row)

                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $row->nama_konsentrasi}}</td>

                                            <td>
                                                <a href="#editDataKonsentrasi/{{ $row->id }}" data-toggle="modal"
                                                    class="btn btn-warning btn-xs"><i class="fa fa-edit">
                                                    </i> </a>
                                                <a href="#HapusDataKonsentrasi/{{ $row->id }}" data-toggle="modal"
                                                    class="btn btn-danger btn-xs"><i class="fa fa-trash">
                                                    </i> </a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Akses Form --}}
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <h4 class="card-title">Akses Form </h4>
                                <a href="/akses/tambah" class="btn btn-primary btn-round ml-auto" data-toggle="modal"
                                    data-target="#tambahAkses">
                                    <i class="fa fa-plus"></i>
                                    Tambah
                                </a>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="tabel-akses" class="display table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>Akses Form KP </th>
                                            <th>Akses Form TA </th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($formAkses as $row)

                                        <tr>
                                            <td>
                                                <input type="checkbox" data-id="{{ $row->id }}" id="akses_kp" {{
                                                    $row->akses_kp ? 'checked' : '' }} data-toggle="toggle"
                                                data-size="xs"
                                                class="toggle-class">
                                            </td>
                                            <td>
                                                <input type="checkbox" data-id="{{ $row->id }}" id="akses_ta" {{
                                                    $row->akses_ta ? 'checked' : '' }} data-toggle="toggle"
                                                data-size="xs"
                                                class="toggle-class-1">
                                            </td>
                                            <td>
                                                <a href="#hapusAkses{{ $row->id }}" data-toggle="modal" data-target=""
                                                    class="btn btn-danger btn-xs"><i class="fa fa-trash">
                                                    </i> </a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- new row --}}
            <div class="row">
                <div class="col-4">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <h4 class="card-title">Panduan</h4>
                                <a href="/pengaturan/tambah-dokumen" class="btn btn-primary btn-round ml-auto"
                                    data-toggle="modal" data-target="#tambahDokumen">
                                    <i class="fa fa-plus"></i>
                                    Tambah
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="tabel-dokumen" class="display table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Dokumen</th>
                                            <th>Dokumen</th>
                                            <th>Action</th>
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
                                            <td>
                                                <a href="dokumen/update/{{ $item->id }}" data-toggle="modal"
                                                    data-target="#modalEditDokumen{{ $item->id }}"
                                                    class="btn btn-warning btn-xs"><i class="fa fa-edit">
                                                    </i> </a>
                                                <a href="dokumen/destroy/{{ $item->id }}" data-toggle="modal"
                                                    data-target="#modalHapusDokumen{{ $item->id }}"
                                                    class="btn btn-danger btn-xs"><i class="fa fa-trash">
                                                    </i> </a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- pengumuman --}}
                <div class="col-8">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <h4 class="card-title">Pengumuman</h4>
                                <a href="/pengaturan/tambah-pengumuman" class="btn btn-primary btn-round ml-auto"
                                    data-toggle="modal" data-target="#tambahPengumuman">
                                    <i class="fa fa-plus"></i>
                                    Tambah
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="tabel-pengumuman" class="display table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>Pengumuman Halaman Home</th>
                                            <th>Pengumuman Daftar KP</th>
                                            <th>Pengumuman Seminar KP</th>
                                            <th>Pengumuman Bimbingan KP</th>
                                            <th>Pengumuman Daftar TA</th>
                                            <th>Pengumuman Sidang TA</th>
                                            <th>Pengumuman Bimbingan TA</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($pengumuman as $item)
                                        <tr align="center">
                                            <td>
                                                <a href="manajemen-form/view-home/{{ $item->id }}" data-toggle="modal"
                                                    data-target="#viewHome{{ $item->id }}"
                                                    class="btn btn-success btn-xs"><i class="fa fa-eye">
                                                    </i>
                                                </a>
                                            </td>
                                            <td>
                                                <a href="manajemen-form/view-daftarkp/{{ $item->id }}"
                                                    data-toggle="modal" data-target="#viewDaftarKP{{ $item->id }}"
                                                    class="btn btn-success btn-xs"><i class="fa fa-eye">
                                                    </i>
                                                </a>
                                            </td>
                                            <td>
                                                <a href="manajemen-form/view-seminarkp/{{ $item->id }}"
                                                    data-toggle="modal" data-target="#viewSeminarKP{{ $item->id }}"
                                                    class="btn btn-success btn-xs"><i class="fa fa-eye">
                                                    </i>
                                                </a>
                                            </td>
                                            <td>
                                                <a href="manajemen-form/view-bimbingankp/{{ $item->id }}"
                                                    data-toggle="modal" data-target="#viewBimbinganKP{{ $item->id }}"
                                                    class="btn btn-success btn-xs"><i class="fa fa-eye">
                                                    </i>
                                                </a>
                                            </td>
                                            <td>
                                                <a href="manajemen-form/view-daftarta/{{ $item->id }}"
                                                    data-toggle="modal" data-target="#viewDaftarTA{{ $item->id }}"
                                                    class="btn btn-success btn-xs"><i class="fa fa-eye">
                                                    </i>
                                                </a>
                                            </td>
                                            <td>
                                                <a href="manajemen-form/view-sidangta/{{ $item->id }}"
                                                    data-toggle="modal" data-target="#viewSidangTA{{ $item->id }}"
                                                    class="btn btn-success btn-xs"><i class="fa fa-eye">
                                                    </i>
                                                </a>
                                            </td>
                                            <td>
                                                <a href="manajemen-form/view-bimbinganta/{{ $item->id }}"
                                                    data-toggle="modal" data-target="#viewBimbinganTA{{ $item->id }}"
                                                    class="btn btn-success btn-xs"><i class="fa fa-eye">
                                                    </i>
                                                </a>
                                            </td>
                                            <td>
                                                <a href="manajemen-form/{{ $item->id }}/update" data-toggle="modal"
                                                    data-target="#EditPengumuman{{ $item->id }}"
                                                    class="btn btn-warning btn-xs"><i class="fa fa-edit">
                                                    </i> </a>
                                                <a href="manajemen-form/{{ $item->id }}/destroy" data-toggle="modal"
                                                    data-target="#HapusPengumuman{{ $item->id }}"
                                                    class="btn btn-danger btn-xs"><i class="fa fa-trash">
                                                    </i> </a>
                                            </td>
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

{{-- Tambah Tahun--}}
<div class="modal fade" id="tambahTahun" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-open">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Tambah Tahun</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form method="POST" enctype="multipart/form-data" action="tahun/tambah">
                @csrf
                <div class="modal-body">

                    <div class="form-group">
                        <div class="row">
                            <div class="col">
                                <label>Tahun</label>
                                <input type="text" class="form-control" name="tahun" id="tahun"
                                    placeholder="contoh : 2021/2022-1" required>
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

{{-- Tambah Dokumen--}}
<div class="modal fade" id="tambahDokumen" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-open">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Tambah Panduan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form method="POST" enctype="multipart/form-data" action="dokumen/tambah">
                @csrf
                <div class="modal-body">

                    <div class="form-group">
                        <div class="row">
                            <div class="col">
                                <label>Nama Dokumen</label>
                                <input type="text" class="form-control" name="nama_dokumen" id="nama_dokumen" required>
                            </div>
                            <div class="col">
                                <label for="file" class="form-label">File Dokumen </label>
                                <img class="img-preview img-fluid mb-3 col-sm-5" alt="">
                                <input type="file" class="form-control picture" id="file_dokumen" name="file_dokumen">
                                <span class="font-italic text-muted mt-1">ukuran file maksimal <span
                                        class="text-danger">1024
                                        KB</span> </span>
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

{{-- Edit Dokumen--}}
@foreach ($dokumen as $item)
<div class="modal fade" id="modalEditDokumen{{ $item->id }}" tabindex="-1" role="dialog"
    aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-open">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Perbarui Panduan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form method="POST" enctype="multipart/form-data" action="dokumen/{{ $item->id }}/update">
                @csrf
                <div class="modal-body">

                    <div class="form-group">
                        <div class="row">
                            <div class="col">
                                <label>Nama Dokumen</label>
                                <input type="text" class="form-control" name="nama_dokumen" id="nama_dokumen"
                                    value="{{ $item->nama_dokumen }}" required>
                            </div>
                            <div class="col">
                                <label for="file" class="form-label">File Dokumen </label>
                                <input type="hidden" name="oldFile" value="{{ $item->file_dokumen }}">
                                <input type="file" class="form-control picture" id="file_dokumen" name="file_dokumen"
                                    value="{{ $item->file_dokumen }}">
                                <iframe src="{{asset('storage/' . $item->file_dokumen)}}" width="160"
                                    height="140"></iframe>
                                <span class="mt-1 font-italic text-muted">biarkan kolom kosong
                                    jika tidak diganti | ukuran file maksimal <span class="text-danger">1024
                                        KB</span> </span>
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

{{-- Tambah Pengumuman--}}
<div class="modal fade" id="tambahPengumuman" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Tambah Pengumuman</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form method="POST" enctype="multipart/form-data" action="pengumuman/tambah">
                @csrf
                <div class="modal-body">

                    <div class="form-group">
                        <div class="row mb-3">
                            <div class="col">
                                <label>Pengumuman Halaman Home</label>
                                <textarea name="cttn_utama" class="form-control ckeditor" id="ckedtor"></textarea>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <label>Pengumuman Daftar KP</label>
                                <textarea name="cttn_daftar_kp" class="form-control ckeditor" id="ckedtor"></textarea>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <label>Pengumuman Seminar KP</label>
                                <textarea name="cttn_seminar_kp" class="form-control ckeditor" id="ckedtor"></textarea>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <label>Pengumuman Bimbingan KP</label>
                                <textarea name="cttn_bimbingan_kp" class="form-control ckeditor"
                                    id="ckedtor"></textarea>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <label>Pengumuman Daftar TA</label>
                                <textarea name="cttn_daftar_ta" class="form-control ckeditor" id="ckedtor"></textarea>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <label>Pengumuman Bimbingan TA</label>
                                <textarea name="cttn_bimbingan_ta" class="form-control ckeditor"
                                    id="ckedtor"></textarea>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <label>Pengumuman Sidang TA</label>
                                <textarea name="cttn_sidang_ta" class="form-control ckeditor" id="ckedtor"></textarea>
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

{{-- Edit Pengumuman --}}
@foreach ($pengumuman as $item)
<div class="modal fade" id="EditPengumuman{{ $item->id }}" tabindex="-1" role="dialog"
    aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Perbarui Pengumuman</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form method="POST" enctype="multipart/form-data" action="pengumuman/{{ $item->id }}/update">
                @csrf
                <div class="modal-body">

                    <div class="form-group">
                        <div class="row mb-3">
                            <div class="col">
                                <label>Pengumuman Halaman Home</label>
                                <textarea name="cttn_utama" class="form-control ckeditor"
                                    id="ckedtor">{!! $item->cttn_utama !!}</textarea>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <label>Pengumuman Daftar KP</label>
                                <textarea name="cttn_daftar_kp" class="form-control ckeditor"
                                    id="ckedtor">{!! $item->cttn_daftar_kp !!}</textarea>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <label>Pengumuman Seminar KP</label>
                                <textarea name="cttn_seminar_kp" class="form-control ckeditor"
                                    id="ckedtor">{!! $item->cttn_seminar_kp !!}</textarea>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <label>Pengumuman Bimbingan KP</label>
                                <textarea name="cttn_bimbingan_kp" class="form-control ckeditor"
                                    id="ckedtor">{!! $item->cttn_bimbingan_kp !!}</textarea>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <label>Pengumuman Daftar TA</label>
                                <textarea name="cttn_daftar_ta" class="form-control ckeditor"
                                    id="ckedtor">{!! $item->cttn_daftar_ta !!}</textarea>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <label>Pengumuman Bimbingan TA</label>
                                <textarea name="cttn_bimbingan_ta" class="form-control ckeditor"
                                    id="ckedtor">{!! $item->cttn_bimbingan_ta !!}</textarea>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <label>Pengumuman Sidang TA</label>
                                <textarea name="cttn_sidang_ta" class="form-control ckeditor"
                                    id="ckedtor">{!! $item->cttn_sidang_ta !!}</textarea>
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

{{-- akses tambah --}}
<div class="modal fade" id="tambahAkses" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-open">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Tambah Akses</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form method="POST" enctype="multipart/form-data" action="akses/tambah">
                @csrf
                <div class="modal-body">

                    <div class="form-group">
                        <div class="row">
                            <div class="col">
                                <h3><b>FORM DAFTAR KERJA PRAKTIK DAN TAMBAH TUGAS AKHIR AKAN MEMILIKI AKSES BUKA DAN
                                        TUTUP !</b></h3>
                                <input type="hidden" class="form-control" name="akses_kp" id="akses_kp" value="1"
                                    required readonly>
                                <input type="hidden" class="form-control" name="akses_ta" id="akses_ta" value="1"
                                    required readonly>
                            </div>

                        </div>
                    </div>


                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-undo">
                            </i> Kembali</button>
                        <button type="submit" class="btn btn-primary"><i class="fa fa-save"> </i> Lanjut</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- edit akses form --}}
@foreach ($formAkses as $item)
<div class="modal fade" id="editJadwal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-open">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Pilih Akses Form KP</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" enctype="multipart/form-data" action="form-akses/{{ $item->id }}/update">
                @csrf

            </form>
        </div>
    </div>
</div>
@endforeach

{{-- Tambah Konsentrasi --}}
<div class="modal fade" id="tambahKonsentrasi" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-open">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Tambah konsentrasi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form method="POST" enctype="multipart/form-data" action="konsentrasi/tambah">
                @csrf
                <div class="modal-body">

                    <div class="form-group">
                        <div class="row">
                            <div class="col">
                                <label>Nama Konsentrasi</label>
                                <input type="text" class="form-control" name="nama_konsentrasi" id="nama_konsentrasi"
                                    required>
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

{{-- Edit Konsentrasi --}}
@foreach ($konsentrasi as $item)
<div class="modal fade" id="editDataKonsentrasi/{{ $item->id }}" tabindex="-1" role="dialog"
    aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-open">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Ubah konsentrasi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form method="POST" enctype="multipart/form-data" action="/konsentrasi/{{ $item->id }}/ubah">
                @csrf
                <div class="modal-body">

                    <div class="form-group">
                        <div class="row">
                            <div class="col">
                                <label>Nama Konsentrasi</label>
                                <input type="text" class="form-control" name="nama_konsentrasi" id="nama_konsentrasi"
                                    required value="{{ $item->nama_konsentrasi }}">
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

{{-- Edit --}}
{{-- @foreach($thnAkademik as $d) --}}
{{-- @endforeach --}}

{{-- Hapus Tahun--}}
@foreach ($thnAkademik as $d)
<div class="modal fade" id="hapusDataTahun{{ $d->id }}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-open">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="exampleModalLongTitle">Hapus Data Tahun</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form method="POST" enctype="multipart/form-data" action="/tahun/{{ $d->id }}/destroy">
                {{-- @method('delete') --}}
                @csrf
                <div class="modal-body">

                    <input type="hidden" value="{{ $d->id }}" name="id" required>

                    <div class=" form-group">
                        <h3>Apakah anda yakin menghapus data <span class="text-danger"> {{ $d->tahun }}</span> ? </h3>
                        <b><span class="text-danger"> Data terkait tahun tersebut akan ikut terhapus !</span></b>
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

{{-- Hapus Akses--}}
@foreach ($formAkses as $d)
<div class="modal fade" id="hapusAkses{{ $d->id }}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-open">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="exampleModalLongTitle">Hapus Akses</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form method="POST" enctype="multipart/form-data" action="/akses/{{ $d->id }}/destroy">
                @csrf
                <div class="modal-body">

                    <input type="hidden" value="{{ $d->id }}" name="id" required>
                    <div class=" form-group">
                        <h3>Apakah anda ingin menghapus akses untuk form Kerja Praktik ? </h3>
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

{{-- Hapus Pengumuman--}}
@foreach ($pengumuman as $d)
<div class="modal fade" id="HapusPengumuman{{ $d->id }}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-open">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="exampleModalLongTitle">Hapus Pengumuman</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form method="POST" enctype="multipart/form-data" action="/pengumuman/{{ $d->id }}/destroy">
                @csrf
                <div class="modal-body">

                    <div class=" form-group">
                        <h3>Apakah anda yakin ingin menghapus Pengumuman ? </h3>
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

{{-- Hapus konsentrasi--}}
@foreach ($konsentrasi as $d)
<div class="modal fade" id="HapusDataKonsentrasi/{{ $d->id }}" tabindex="-1" role="dialog"
    aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-open">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="exampleModalLongTitle">Hapus Data Konsentrasi</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form method="POST" enctype="multipart/form-data" action="/konsentrasi/{{ $d->id }}/destroy">
                {{-- @method('delete') --}}
                @csrf
                <div class="modal-body">

                    <input type="hidden" value="{{ $d->id }}" name="id" required>

                    <div class=" form-group">
                        <h3>Apakah anda yakin menghapus data <span class="text-danger"> {{ $d->nama_konsentrasi }}
                            </span>?</h3>
                        <b><span class="text-danger"> Data terkait konsentrasi tersebut akan ikut terhapus !</span></b>
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

{{-- Hapus Panduan--}}
@foreach ($dokumen as $d)
<div class="modal fade" id="modalHapusDokumen{{ $d->id }}" tabindex="-1" role="dialog"
    aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-open">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="exampleModalLongTitle">Hapus Data Dokumen</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form method="POST" enctype="multipart/form-data" action="/dokumen/{{ $d->id }}/destroy">
                @csrf
                <div class="modal-body">

                    <input type="hidden" value="{{ $d->id }}" name="id" required>

                    <div class=" form-group">
                        <h3>Apakah anda yakin menghapus data <span class="text-danger"> {{ $d->nama_dokumen }}
                            </span>?</h3>
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


{{-- VIEW pengumuman--}}
@foreach ($pengumuman as $item)
<div class="modal fade" id="viewHome{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Pengumuman Halaman Home</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <div class="form-group">
                    <div class="row">
                        <div class="col">
                            {!! $item->cttn_utama !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach
@foreach ($pengumuman as $item)
<div class="modal fade" id="viewDaftarKP{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Pengumuman Daftar KP</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <div class="form-group">
                    <div class="row">
                        <div class="col">
                            {!! $item->cttn_daftar_kp !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach

@foreach ($pengumuman as $item)
<div class="modal fade" id="viewSeminarKP{{ $item->id }}" tabindex="-1" role="dialog"
    aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Pengumuman Seminar KP</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <div class="form-group">
                    <div class="row">
                        <div class="col">
                            {!! $item->cttn_seminar_kp !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach
@foreach ($pengumuman as $item)
<div class="modal fade" id="viewBimbinganKP{{ $item->id }}" tabindex="-1" role="dialog"
    aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Pengumuman Bimbingan KP</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <div class="form-group">
                    <div class="row">
                        <div class="col">
                            {!! $item->cttn_bimbingan_kp !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach
@foreach ($pengumuman as $item)
<div class="modal fade" id="viewDaftarTA{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Pengumuman Daftar TA</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <div class="form-group">
                    <div class="row">
                        <div class="col">
                            {!! $item->cttn_daftar_ta !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach

@foreach ($pengumuman as $item)
<div class="modal fade" id="viewSidangTA{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Pengumuman Sidang TA</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <div class="form-group">
                    <div class="row">
                        <div class="col">
                            {!! $item->cttn_sidang_ta !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach

@foreach ($pengumuman as $item)
<div class="modal fade" id="viewBimbinganTA{{ $item->id }}" tabindex="-1" role="dialog"
    aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Pengumuman Bimbingan TA</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <div class="form-group">
                    <div class="row">
                        <div class="col">
                            {!! $item->cttn_bimbingan_ta !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach

<script src="/assets/js/core/jquery.3.2.1.min.js"></script>
<script type="text/javascript" src="assets/ckeditor/ckeditor.js"></script>
<script>
    $(function() {
    $('.toggle-class').change(function() {
    let akses_kp = $(this).prop('checked') == true ? 1 : 0;
    let id = $(this).data('id');

    $.ajax({
        type: "POST",
        headers: {
        'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        dataType: "json",
        url: '{{ route('toggle.update-kp') }}',
        data: {'akses_kp': akses_kp, 'id': id},
        success: function(data){
                nsole.log(data.success)
                }   
            });
        })
    });
</script>
<script>
    // checkbox toggle tanpa harus refresh halaman
    $(function() {
        $('.toggle-class-1').change(function() {
        let akses_ta = $(this).prop('checked') == true ? 1 : 0;
        let id = $(this).data('id');

        $.ajax({
            type: "POST",
            headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            dataType: "json",
            url: '{{ route('toggle.update-ta') }}',
            data: {'akses_ta': akses_ta, 'id': id},
            success: function(data){
                    console.log(data.success)
                    }   
                });
            })
    });
</script>

{{--Data Tabel --}}
<script>
    $(document).ready(function () { var table = $("#tabel-tahun").DataTable({}); });
    $(document).ready(function () { var table = $("#tabel-konsentrasi").DataTable({}); });
    $(document).ready(function () { var table = $("#tabel-akses").DataTable({}); });
    $(document).ready(function () { var table = $("#tabel-pengumuman").DataTable({}); });
    $(document).ready(function () { var table = $("#tabel-dokumen").DataTable({}); });
    
</script>

@endsection