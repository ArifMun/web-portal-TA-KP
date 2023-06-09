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
                <h4 class="page-title">Bimbingan Kerja Praktik [Mahasiswa]</h4>
                @elseif(Auth::user()->level==1)
                <h4 class="page-title">Bimbingan Kerja Praktik [Dosen]</h4>
                @endif
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <div class="">Readme First
                                    <a href="bimbingan-kp/view-pengumuman" data-toggle="modal"
                                        data-target="#viewPengumuman"><i class="fa fa-eye ml-2">
                                        </i>
                                    </a>
                                </div>
                                <a href="cetak-form/bimbingan-kp" class="btn btn-success btn-round ml-auto">
                                    <i class="fas fa-print"></i>
                                    Cetak Form
                                </a>
                                <a href="/bimbingan-kp/tambah" class="btn btn-primary btn-round ml-auto"
                                    data-toggle="modal" data-target="#modalTambahBimbingan">
                                    <i class="fa fa-plus"></i>
                                    Tambah
                                </a>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="row">
                                {{-- <div class="col-sm-6 col-md-3">
                                    <div class="row align-items-center">
                                        <div class="col col-stats ml-3 ml-sm-0">
                                            <div class="filter tahun">
                                                <label class="font-weight-bold h6">Filter Tahun</label>
                                                <select data-column="8" class="form-control" id="filter-tahun">
                                                    <option value="">-- Pilih Tahun --</option>
                                                    @foreach ($thnakademik as $k)
                                                    <option value="{{ $k->tahun }}">{{ $k->tahun }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div> --}}

                                {{-- <div class="col-sm-6 col-md-3">
                                    <div class="row align-items-center">
                                        <div class="col col-stats ml-3 ml-sm-0">
                                            <div class="filter tahun">
                                                <label class="font-weight-bold h6">Filter Status</label>
                                                <select data-column="6" class="form-control text-capitalize"
                                                    id="filter-stts">
                                                    <option value="">-- Pilih Status --</option>
                                                    @foreach ($filterStts as $item)
                                                    <option value="{{ $item->stts }}" class="text-capitalize">{{
                                                        $item->stts }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-1 col-md-3">
                                    <div class="row">
                                        <div class="col col-stats ml-3 ml-sm-0">
                                            <p class="font-weight-bold h6">Status Bimbingan</p>
                                            @if (Auth::user()->level == 1)
                                            <p class="badge badge-warning font-weight-bold ">
                                                Proses : {{ $sttsDosen}}
                                            </p>

                                            @elseif(Auth::user()->level == 0)
                                            <p class="badge badge-warning font-weight-bold ">
                                                Proses : {{ $sttsMhs}}
                                            </p>
                                            @endif

                                        </div>
                                    </div>
                                </div> --}}
                            </div>


                            {{-- <div class="divider"></div> --}}
                            <div class="table-responsive">
                                <table id="bimbingan-kp" class="display table table-striped table-hover">
                                    <thead>
                                        <tr align="center">
                                            <th>No</th>
                                            @if (Auth::user()->level==1)
                                            <th>NIM</th>
                                            <th>Nama</th>
                                            @endif
                                            @if (Auth::user()->level==0)
                                            <th>Dosen Pembimbing</th>
                                            @endif

                                            <th>Judul Bimbingan</th>
                                            <th>Laporan KP</th>
                                            <th>Status</th>
                                            <th>Catatan</th>
                                            <th>Tahun</th>
                                            <th>Author</th>
                                            <th>Dibuat</th>
                                            {{-- <th>Diubah</th> --}}
                                            <th>Action</th>
                                        </tr>
                                    </thead>

                                    @if (Auth::user()->level==0)
                                    <tbody>
                                        @php $no=1; @endphp
                                        @if (empty(Auth::user()->biodata->mahasiswa->daftarkp->bimbingankp))
                                        @foreach ($bimbingMhs as $item)
                                        {{-- {{ $item }} --}}

                                        <tr align="center">
                                            <td>{{ $no++ }}</td>
                                            {{-- <td>{{ $item->daftarkp->mahasiswa->biodata->no_induk}}</td>
                                            <td>{{ $item->daftarkp->mahasiswa->biodata->nama }}</td> --}}
                                            <td>{{ $item->daftarkp->dosen->biodata->nama }}</td>
                                            <td>{{ $item->judul_bimbingan }}</td>
                                            <td>
                                                <a href="storage/{{ $item->laporan_kp }}"><i
                                                        class="fa fa-file-download fa-2x">
                                                    </i>
                                                </a>
                                            </td>
                                            @if ($item->stts == 'proses')
                                            <td>
                                                <span
                                                    class="font-weight-bold text-light text-capitalize badge badge-warning">
                                                    {{
                                                    $item->stts }}</span>
                                            </td>
                                            @elseif($item->stts == 'acc')
                                            <td>
                                                <span
                                                    class="font-weight-bold text-light text-capitalize badge badge-success">
                                                    {{
                                                    $item->stts}}</span>
                                            </td>
                                            @else
                                            <td>
                                                <span
                                                    class="font-weight-bold text-light text-capitalize badge badge-danger">
                                                    {{
                                                    $item->stts}}</span>
                                            </td>
                                            @endif
                                            {{-- <td><a href="bimbingan-kp/view/{{ $item->id }}" data-toggle="modal"
                                                    data-target="#viewCatatan{{ $item->id }}"
                                                    class="btn-round btn-primary btn-xs"><i class="fa fa-eye">
                                                    </i> </a>
                                            </td> --}}
                                            <td>{{ $item->catatan }}</td>
                                            <td>{{ $item->daftarkp->tahunakademik->tahun }}</td>
                                            <td>{{ $item->author }}</td>
                                            <td>{{ $item->created_at }}</td>
                                            {{-- <td>{{ $item->updated_at }}</td> --}}
                                            <td>
                                                <a href="bimbingan-kp/edit/{{ $item->id }}" data-toggle="modal"
                                                    data-target="#EditBimbingan{{ $item->id }}"
                                                    class="btn btn-warning btn-xs"><i class="fa fa-edit">
                                                    </i> </a>
                                                <a href="bimbingan-kp/hapus/{{ $item->id }}" data-toggle="modal"
                                                    data-target="#modalHapusBimbingan{{ $item->id }}"
                                                    class="btn btn-danger btn-xs"><i class="fa fa-trash">
                                                    </i> </a>
                                            </td>
                                        </tr>
                                        @endforeach


                                        @endif
                                    </tbody>

                                    {{-- All- --}}
                                    @elseif(Auth::user()->level == 1)
                                    <tbody>
                                        @php $no=1; @endphp
                                        @foreach ($bimbingDosen as $item)
                                        {{-- {{ $item }} --}}
                                        <tr align="center">
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $item->daftarkp->mahasiswa->biodata->no_induk }}</td>
                                            <td>{{ $item->daftarkp->mahasiswa->biodata->nama }}</td>
                                            {{-- <td>{{ $item->daftarkp->dosen->biodata->nama }}</td> --}}
                                            <td>{{ $item->judul_bimbingan }}</td>
                                            <td>
                                                <a href="storage/{{ $item->laporan_kp }}"
                                                    class="btn btn-success btn-xs"><i class="fas fa-file-download">
                                                    </i>
                                                </a>
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
                                            {{-- <td><a href="bimbingan-kp/view/{{ $item->id }}" data-toggle="modal"
                                                    data-target="#viewCatatan{{ $item->id }}"
                                                    class="btn-round btn-primary btn-xs"><i class="fa fa-eye">
                                                    </i> </a>
                                            </td> --}}
                                            <td>{{ $item->catatan }}</td>
                                            <td>{{ $item->daftarkp->tahunakademik->tahun }}</td>
                                            <td>{{ $item->author }}</td>
                                            <td>{{ $item->created_at }}</td>
                                            {{-- <td>{{ $item->updated_at }}</td> --}}
                                            <td>
                                                <a href="bimbingan-kp/edit/{{ $item->id }}" data-toggle="modal"
                                                    data-target="#EditBimbingan{{ $item->id }}"
                                                    class="btn btn-warning btn-xs"><i class="fa fa-edit">
                                                    </i> </a>
                                                <a href="bimbingan-kp/hapus/{{ $item->id }}" data-toggle="modal"
                                                    data-target="#modalHapusBimbingan{{ $item->id }}"
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
<div class="modal fade" id="modalTambahBimbingan" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Tambah Bimbingan KP</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form method="POST" enctype="multipart/form-data" action="bimbingan-kp">
                @csrf
                <div class="modal-body">

                    <div class="form-group required">
                        <div class="row">
                            <div class="col-6">
                                <label class="control-label">NIM - Nama - Tahun </label>

                                @if (Auth::user()->level==0 )
                                <input type="text" class="form-control" value="{{ $mhskps->mahasiswa->biodata->no_induk }} - {{
                                    $mhskps->mahasiswa->biodata->nama }} - {{ $mhskps->tahunakademik->tahun
                                    }}" readonly>
                                <input type="hidden" value="{{ $mhskps->id }}" name="daftarkp_id">

                                @elseif(Auth::user()->level==1)
                                <select class="form-control" name="daftarkp_id" onchange="no_mahasiswa()"
                                    id="daftarkp_id" required>
                                    <option value="" hidden="">-- Pilih --</option>
                                    @foreach ($mhskpd as $item)
                                    <option value="{{ $item->id }}">{{
                                        $item->mahasiswa->biodata->no_induk
                                        }} - {{ $item->mahasiswa->biodata->nama
                                        }} - {{ $item->tahunakademik->tahun
                                        }}</option>
                                    @endforeach

                                    @endif
                                </select>
                            </div>
                            @if (UserCheck::levelMhs())

                            <div class="col">
                                <label>Dosen Pembimbing</label>
                                <input type="text" class="form-control" value="{{ $mhskps->dosen->biodata->nama }}"
                                    readonly>
                            </div>
                            @endif
                            <input type="hidden" name="author" value="{{ Auth::user()->biodata->nama }}" readonly>
                        </div>
                    </div>

                    <div class="form-group required">
                        <div class="row">
                            <div class="col">
                                <label class="control-label">Judul Bimbingan </label>
                                <input type="text" class="form-control" name="judul_bimbingan">
                            </div>
                            <div class="col">
                                <label class="control-label">Status </label>
                                @if (Auth::user()->level==0)
                                <input type="text" class="form-control text-capitalize" name="stts" value="proses"
                                    readonly>
                                @else
                                <select class="form-control" name="stts" required>
                                    <option value="" hidden="">-- Status KP --</option>
                                    <option value="proses">Proses</option>
                                    <option value="acc">ACC</option>
                                    <option value="revisi">Revisi</option>
                                    @endif
                                </select>
                            </div>
                        </div>
                    </div>


                    <div class="form-group required">
                        <div class="row">
                            <div class="col">
                                <label for="file" class="form-label">Laporan KP </label>
                                <img class="img-preview img-fluid mb-3 col-sm-5" alt="">
                                <input type="file" class="form-control picture" id="laporan_kp" name="laporan_kp">
                                <span class="font-italic text-muted mt-1">ukuran file maksimal <span
                                        class="text-danger">1024
                                        KB</span> </span>
                            </div>
                            <div class="col">
                                <label>Catatan</label>
                                {{-- <input type="textarea" class="form-control" name="catatan"> --}}
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

{{-- Edit --}}
@foreach ($bimbingkp as $item)
<div class="modal fade" id="EditBimbingan{{ $item->id }}" tabindex="-1" role="dialog"
    aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="exampleModalLongTitle">Ubah Data Bimbingan KP</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form method="POST" enctype="multipart/form-data" action="bimbingan-kp/{{ $item->id }}">
                @method('put')
                @csrf
                <div class="modal-body">

                    <div class="form-group required">
                        <div class="row">
                            <div class="col">
                                <label class="control-label">NIM - Nama - Tahun </label>
                                <select class="form-control" name="daftarkp_id" onchange="no_mahasiswa()"
                                    id="daftarkp_id" required>
                                    <option value="{{ $item->daftarkp_id }}">{{
                                        $item->daftarkp->mahasiswa->biodata->no_induk }} -
                                        {{
                                        $item->daftarkp->mahasiswa->biodata->nama }} - {{
                                        $item->daftarkp->tahunakademik->tahun }}
                                    </option>

                                </select>
                            </div>

                            <div class="col">
                                <label class="control-label">Judul Bimbingan </label>
                                <input type="text" class="form-control" name="judul_bimbingan"
                                    value="{{ $item->judul_bimbingan }}">
                            </div>
                            <input type="hidden" name="mahasiswa_id" id="mahasiswa_id" value="{{ $item->mahasiswa_id }}"
                                readonly>
                            <input type="hidden" name="dosen_id" id="dosen_id" value="{{ $item->dosen_id }}" readonly>
                            <input type="hidden" name="author" value="{{ Auth::user()->biodata->nama }}" readonly>
                        </div>
                    </div>

                    <div class="form-group required">
                        <div class="row">
                            <div class="col">
                                <label for="file" class="form-label">Laporan KP </label>
                                <input type="hidden" name="oldFile" value="{{ $item->laporan_kp }}">
                                <input type="file" class="form-control picture" id="laporan_kp" name="laporan_kp"
                                    value="{{ $item->laporan_kp }}">
                                <span class="mt-1 font-italic text-muted">biarkan kolom kosong
                                    jika tidak diganti | ukuran file maksimal <span class="text-danger">1024
                                        KB</span> </span>
                            </div>
                            <div class="col">
                                <label class="control-label">Status </label>
                                <select class="form-control" name="stts" required>
                                    @if (Auth::user()->level==0)
                                    <option value="proses" @readonly(true)>Proses</option>
                                    @else
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

{{-- view Catatan --}}
@foreach ($bimbingkp as $item)
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
                            {!! $pengumuman->cttn_bimbingan_kp !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Hapus --}}
@foreach ($bimbingkp as $item)
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

            <form method="POST" enctype="multipart/form-data" action="/bimbingan-kp/{{ $item->id }}">
                @method('delete')
                @csrf
                <div class="modal-body">

                    <input type="hidden" value="{{ $item->id }}" name="id" required>

                    <div class=" form-group">
                        <h3>Apakah anda ingin menghapus data bimbingan</h3>
                        dengan Judul <span class="text-danger">{{ $item->judul_bimbingan }}</span> ?
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
<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

</script>

<script>
    function no_mahasiswa() {
        let daftarkp_id = $("#daftarkp_id").val();
        $("#mahasiswa_id").children().remove();
        if (daftarkp_id != '' && daftarkp_id != null) {
            $.ajax({

                url: "{{ url('') }}/bimbingan-kp/daftarkp_id/" + daftarkp_id,
                success: function (res) {
                    $("#mahasiswa_id").val(res.mahasiswa_id);
                    $("#dosen_id").val(res.d_pembimbing_1);
                }
            });
        }
    }

    $(document).ready(function () {
    var table = $("#bimbingan-kp").DataTable({});
        $("#filter-tahun").change(function () {
        table.column($(this).data("column")).search($(this).val()).draw();
    });
        $("#filter-stts").change(function () {
        table.column($(this).data("column")).search($(this).val()).draw();
    });
    });
</script>

@endsection