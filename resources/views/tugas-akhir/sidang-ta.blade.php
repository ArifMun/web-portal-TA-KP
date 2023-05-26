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
                <h4 class="page-title">Sidang Tugas Akhir</h4>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <h4 class="card-title"></h4>
                                <a href="/sidang-ta/daftar" class="btn btn-primary btn-round ml-auto"
                                    data-toggle="modal" data-target="#modalDaftarSidang">
                                    <i class="fa fa-plus"></i>
                                    Daftar
                                </a>
                            </div>
                        </div>

                        <div class="card-body">
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
                                                <select data-column="5" class="form-control" id="filter-stts">
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

                                {{-- <div class="col-sm-6 col-md-3">
                                    <div class="row align-items-center">
                                        <div class="col col-stats ml-3 ml-sm-0">
                                            <label class="font-weight-bold h6">Status Pengajuan</label>
                                            <div class="row ml-1">
                                                <p class="font-weight-bold text-light p-1 btn-success btn-round mr-1">
                                                    Diterima
                                                    : {{
                                                    $d_diterima}}
                                                </p>
                                                <p class="font-weight-bold text-light p-1 btn-warning btn-round mr-1">
                                                    Tertunda :
                                                    {{
                                                    $d_tertunda }}
                                                </p>
                                                <p class="font-weight-bold text-light p-1 btn-danger btn-round mr-1">
                                                    Ditolak
                                                    :
                                                    {{
                                                    $d_ditolak
                                                    }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div> --}}

                            </div>
                            <div class="divider"></div>
                            <div class="table-responsive">
                                <table id="seminar-kp" class="display table table-striped table-hover">
                                    <thead>
                                        <tr align="center">
                                            <th>No</th>
                                            <th>NIM</th>
                                            <th>Nama</th>
                                            <th>Dosen Pembimbing 1</th>
                                            <th>Dosen Pembimbing 2</th>
                                            <th>Status Sidang</th>
                                            <th>Form Bimbingan 1</th>
                                            <th>Form Bimbingan 2</th>
                                            <th>Slip Pembayaran</th>
                                            <th>Tahun</th>
                                            <th>Judul</th>
                                            <th>Catatan</th>
                                            <th>Tanggal Sidang</th>
                                            <th>Jam Sidang</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>

                                    @if (Auth::user()->level==0)
                                    <tbody>
                                        @if (!empty(Auth::user()->biodata->mahasiswa->sidangta))
                                        @foreach ($m_list as $item)
                                        <tr align="center">@php $no=1; @endphp
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $item->daftarta->mahasiswa->biodata->no_induk}}</td>
                                            <td>{{ $item->daftarta->mahasiswa->biodata->nama }}</td>

                                            <td>
                                                @foreach ($dosen as $k)
                                                {{ $k->id == $item->daftarta->d_pembimbing_1 ?
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

                                            @if ($item->daftarta->sidangta->stts_sidang=='proses')
                                            <td>
                                                <a
                                                    class="btn-warning btn-round p-1 font-weight-bold text-light text-capitalize">
                                                    {{
                                                    $item->daftarta->sidangta->stts_sidang }}</a>
                                            </td>
                                            @elseif($item->daftarta->sidangta->stts_sidang=='selesai')
                                            <td>
                                                <a
                                                    class="btn-success btn-round p-1 font-weight-bold text-light text-capitalize">
                                                    {{
                                                    $item->daftarta->sidangta->stts_sidang }}</a>
                                            </td>
                                            @else
                                            <td>
                                                <a
                                                    class="btn-primary btn-round p-1 font-weight-bold text-light text-capitalize">
                                                    {{
                                                    $item->daftarta->sidangta->stts_sidang }}</a>
                                            </td>
                                            @endif

                                            <td><a href="sidang-ta/view-form_1/{{ $item->id }}" data-toggle="modal"
                                                    data-target="#viewForm_1{{ $item->id }}"
                                                    class="btn-round btn-success btn-xs"><i class="fa fa-eye">
                                                    </i> </a>
                                            </td>

                                            <td><a href="sidang-ta/view-form_2/{{ $item->id }}" data-toggle="modal"
                                                    data-target="#viewForm_2{{ $item->id }}"
                                                    class="btn-round btn-success btn-xs"><i class="fa fa-eye">
                                                    </i> </a>
                                            </td>

                                            <td><a href="sidang-ta/view-slip/{{ $item->id }}" data-toggle="modal"
                                                    data-target="#viewSlip{{ $item->id }}"
                                                    class="btn-round btn-success btn-xs"><i class="fa fa-eye">
                                                    </i> </a>
                                            </td>

                                            <td>{{ $item->daftarta->tahunakademik->tahun }}</td>
                                            <td>{{ $item->judul }}</td>
                                            <td>{{ $item->catatan }}</td>
                                            <td>{{ $item->tgl_sidang }}</td>
                                            <td>{{ $item->jam_sidang }}</td>
                                            <td>
                                                <a href="sidang-ta/edit/{{ $item->id }}" data-toggle="modal"
                                                    data-target="#modalEditSidang{{ $item->id }}"
                                                    class="btn btn-warning btn-xs"><i class="fa fa-edit">
                                                    </i> </a>
                                                <a href="sidang-ta/hapus/{{ $item->id }}" data-toggle="modal"
                                                    data-target="#modalHapusSidang{{ $item->id }}"
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

                                    {{-- All- --}}
                                    @elseif(Auth::user()->level !=0)
                                    <tbody> @php $no=1; @endphp
                                        @foreach ($s_list as $row)
                                        <tr align="center">
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $row->daftarta->mahasiswa->biodata->no_induk }}</td>
                                            <td>{{ $row->daftarta->mahasiswa->biodata->nama }}</td>
                                            <td>
                                                @foreach ($dosen as $d)
                                                {{ $d->id == $row->daftarta->d_pembimbing_1 ?
                                                $d->biodata->nama :''
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
                                            @if ($row->stts_sidang=='proses')
                                            <td>
                                                <a
                                                    class="btn-warning btn-round p-1 font-weight-bold text-light text-capitalize">
                                                    {{
                                                    $row->stts_sidang }}</a>
                                            </td>
                                            @elseif($row->stts_sidang=='selesai')
                                            <td>
                                                <a
                                                    class="btn-success btn-round p-1 font-weight-bold text-light text-capitalize">
                                                    {{
                                                    $row->stts_sidang }}</a>
                                            </td>
                                            @else
                                            <td>
                                                <a
                                                    class="btn-primary btn-round p-1 font-weight-bold text-light text-capitalize">
                                                    {{
                                                    $row->stts_sidang }}</a>
                                            </td>
                                            @endif

                                            <td><a href="sidang-ta/view-form_1/{{ $row->id }}" data-toggle="modal"
                                                    data-target="#viewForm_1{{ $row->id }}"
                                                    class="btn-round btn-success btn-xs"><i class="fa fa-eye">
                                                    </i> </a>
                                            </td>

                                            <td><a href="sidang-ta/view-form_2/{{ $row->id }}" data-toggle="modal"
                                                    data-target="#viewForm_2{{ $row->id }}"
                                                    class="btn-round btn-success btn-xs"><i class="fa fa-eye">
                                                    </i> </a>
                                            </td>

                                            <td><a href="sidang-ta/view-slip/{{ $row->id }}" data-toggle="modal"
                                                    data-target="#viewSlip{{ $row->id }}"
                                                    class="btn-round btn-success btn-xs"><i class="fa fa-eye">
                                                    </i> </a>
                                            </td>

                                            <td>{{ $row->daftarta->tahunakademik->tahun }}</td>
                                            <td>{{ $row->judul }}</td>
                                            <td>{{ $row->catatan }}</td>
                                            <td>{{ $row->tgl_sidang }}</td>
                                            <td>{{ $row->jam_sidang }}</td>
                                            <td>
                                                <a href="sidang-ta/edit/{{ $row->id }}" data-toggle="modal"
                                                    data-target="#modalEditSidang{{ $row->id }}"
                                                    class="btn btn-warning btn-xs"><i class="fa fa-edit">
                                                    </i> </a>
                                                <a href="sidang-ta/hapus/{{ $row->id }}" data-toggle="modal"
                                                    data-target="#modalHapusSidang{{ $row->id }}"
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

            <form method="POST" enctype="multipart/form-data" action="sidang-ta">
                @csrf
                <div class="modal-body">
                    <div class="form-group required">
                        <div class="row">
                            <div class="col">
                                <label class="control-label">NIM - Nama - Tahun </label>
                                <select class="form-control" name="daftar_ta_id" id="daftar_ta_id" size="1"
                                    onchange="no_mahasiswa()" required>
                                    <option value="" hidden="">-- Pilih --</option>

                                    @if (Auth::user()->level==0 )
                                    @foreach ($d_mhs_ta as $item)
                                    <option value=" {{ $item->id}}">{{
                                        $item->mahasiswa->biodata->no_induk
                                        }} - {{ $item->mahasiswa->biodata->nama
                                        }} - {{ $item->tahunakademik->tahun }}
                                    </option>
                                    @endforeach
                                    <input type="hidden" value="{{ Auth::user()->biodata->mahasiswa->id }}"
                                        name="mahasiswa_id">
                                    @else

                                    @foreach ($daftarta as $k)
                                    <option value="{{ $k->id }}">{{
                                        $k->mahasiswa->biodata->no_induk
                                        }} - {{ $k->mahasiswa->biodata->nama
                                        }} - {{ $k->tahunakademik->tahun
                                        }}</option>
                                    @endforeach

                                    @endif
                                </select>
                                <input type="hidden" name="mahasiswa_id" id="mahasiswa_id" readonly>
                            </div>
                            <div class="col">
                                <label class="control-label">Status Sidang </label>
                                <select class="form-control" name="stts_sidang" size="1" required>
                                    @if (Auth::user()->level==0)
                                    <option value="proses" @readonly(true)>Proses</option>
                                    @else
                                    <option value="" hidden="">-- Status Sidang --</option>
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
                                <label class="control-label">Tanggal Sidang </label>
                                <input type="date" class="form-control" name="tgl_sidang" size="1">
                            </div>
                            <div class="col">
                                <label class="control-label">
                                    Jam Sidang
                                </label>
                                <input type="time" class="form-control" name="jam_sidang" size="1">
                            </div>
                        </div>
                    </div>

                    <div class="form-group required">
                        <div class="row">
                            <div class="col">
                                <label class="control-label">Judul Tugas Akhir </label>
                                <input type="text" class="form-control" name="judul" size="1">
                            </div>
                            <div class="col">
                                <label>Catatan</label>
                                <input type="text" class="form-control" name="catatan" size="1">
                            </div>
                        </div>
                    </div>

                    <div class="form-group required">
                        <div class="row">
                            <div class="col">
                                <label for="image" class="form-label control-label">Form Bimbingan 1</label>
                                <input type="file" class="form-control picture" id="image1" name="f_bimbingan_1"
                                    onchange="previewImage(1)">
                                <img class="img-preview img-fluid mt-2 col-sm-5" id="preview1">
                            </div>
                            <div class="col">
                                <label for="image" class="form-label control-label">Form Bimbingan 2</label>
                                <input type="file" class="form-control picture" id="image2" name="f_bimbingan_2"
                                    onchange="previewImage(2)">
                                <img class="img-preview img-fluid mt-2 col-sm-5" id="preview2">
                            </div>
                        </div>
                    </div>
                    <div class="form-group required">
                        <div class="row">
                            <div class="col-6">
                                <label for="image" class="form-label control-label">Slip Pembayaran</label>
                                <input type="file" class="form-control picture" name="slip_pembayaran"
                                    onchange="previewImage(3)" id="image3">
                                <img class="img-preview img-fluid mt-2 col-sm-5" id="preview3">
                            </div>
                            {{-- <div class="col">
                                <label for="image" class="form-label control-label">Form Bimbingan 2</label>
                                <img class="img-preview img-fluid mb-3 col-sm-5" id="preview1">
                                <input type="file" class="form-control picture" id="f_bimbingan_2" name="f_bimbingan_2"
                                    onchange="previewImage()">
                            </div> --}}
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

            <form method="POST" enctype="multipart/form-data" action="sidang-ta/{{ $item->id }}">
                @method('put')
                @csrf
                <div class="modal-body">
                    <div class="form-group required">
                        <div class="row">
                            <div class="col">
                                <label class="control-label">NIM</label>
                                <select class="form-control" name="daftar_ta_id" id="daftar_ta_id">
                                    <option value="{{ $item->daftar_ta_id }}">{{
                                        $item->daftarta->mahasiswa->biodata->no_induk }} - {{
                                        $item->daftarta->mahasiswa->biodata->nama }} - {{
                                        $item->daftarta->tahunakademik->tahun }}</option>
                                </select>
                                <input type="hidden" value="{{ $item->mahasiswa_id }}" name="mahasiswa_id">
                            </div>
                            <div class="col">
                                <label class="control-label"> Status Sidang</label>
                                <select class="form-control" name="stts_sidang" required>
                                    @if (Auth::user()->level==0)
                                    <option value="proses">Proses</option>
                                    @else
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
                                    Jam Sidang
                                </label>
                                <input type="time" class="form-control" name="jam_sidang"
                                    value="{{ $item->jam_sidang }}">
                            </div>
                        </div>
                    </div>

                    <div class="form-group required">
                        <div class="row">
                            <div class="col">
                                <label class="control-label"> Judul Tugas Akhir </label>
                                <input type="text" class="form-control" name="judul" value="{{ $item->judul }}">
                            </div>
                            <div class="col">
                                <label>Catatan</label>
                                <input type="text" class="form-control" name="catatan" value="{{ $item->catatan }}">
                            </div>
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
                            <div class="col-6">
                                <label for="image" class="form-label control-label">Slip Pembayaran</label>
                                <input type="hidden" name="oldImage3" value="{{ $item->slip_pembayaran }}">
                                <input type="file" class="form-control picture" id="image6" name="slip_pembayaran"
                                    onchange="previewImage(6)">

                                @if ($item->slip_pembayaran)
                                <img src="{{ asset('storage/' . $item->slip_pembayaran) }}"
                                    class="img-preview img-fluid mt-2 col-sm-4" id="preview6">
                                @else
                                @endif
                                <p class="mt-1 font-italic">biarkan kolom kosong
                                    jika tidak diganti</p>
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

{{-- view Form Bimbingan 1--}}
@foreach ($s_list as $item)
<div class="modal fade" id="viewForm_1{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Form Bimbingan 1</h5>
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
                <h5 class="modal-title" id="exampleModalLongTitle">Form Bimbingan 2</h5>
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

{{-- Slip Pembayaran --}}
@foreach ($s_list as $item)
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
                        @if ($item->slip_pembayaran)
                        <div class="col">
                            <img src="{{ asset('storage/' . $item->slip_pembayaran) }}" alt=""
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
                            <span class="text-danger text-capitalize">{{ $item->mahasiswa->biodata->nama }}</span>
                            dengan
                            NIM <span class="text-danger">{{
                                $item->mahasiswa->biodata->no_induk
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
    // untuk mendapatkan id mahasiswa
    function no_mahasiswa() {
        let daftar_ta_id = $("#daftar_ta_id").val();
            $("#mahasiswa_id").children().remove();
                if (daftar_ta_id != '' && daftar_ta_id != null) {
                $.ajax({

                url: "{{ url('') }}/sidang-ta/daftar_ta_id/" + daftar_ta_id,
                success: function (res) {
                $("#mahasiswa_id").val(res.mahasiswa_id);
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