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
                @if(Auth::user()->level== 1)
                <h4 class="page-title">Mahasiswa Bimbingan 2 </h4>
                @endif
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center">

                                @if(Auth::user()->level==1)
                                <h4 class="card-title">Jumlah Bimbingan : {{ $b_dosen_2->count() }}</h4>
                                @endif
                                <a href="/bimbingan-ta-1/tambah" class="btn btn-primary btn-round ml-auto"
                                    data-toggle="modal" data-target="#modalTambahBimbingan1">
                                    <i class="fa fa-plus"></i>
                                    Tambah
                                </a>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="bimbingan-ta" class="display table table-striped table-hover">
                                    <thead>
                                        <tr align="center">
                                            <th>No</th>
                                            <th>NIM</th>
                                            <th>Nama</th>
                                            <th>Judul Bimbingan</th>
                                            <th>Laporan TA</th>
                                            <th>Status</th>
                                            <th>Catatan</th>
                                            <th>Tahun Akademik</th>
                                            <th>Author</th>
                                            <th>Dibuat</th>
                                            <th>Action</th>

                                        </tr>
                                    </thead>

                                    @if(Auth::user()->level == 1)
                                    <tbody>
                                        @php $no=1; @endphp
                                        @foreach ($b_dosen_2 as $item)
                                        <tr align="center">
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $item->daftarta->mahasiswa->biodata->no_induk }}</td>
                                            <td>{{ $item->daftarta->mahasiswa->biodata->nama }}</td>
                                            <td>{{ $item->judul_bimbingan }}</td>
                                            <td>
                                                @if ($item->laporan_ta==NULL)
                                                @else
                                                <a href="/storage/{{ $item->laporan_ta }}"><i
                                                        class="fas fa-file-download fa-2x">
                                                    </i>
                                                </a>
                                                @endif
                                            </td>
                                            @if ($item->stts=='proses')
                                            <td>
                                                <a href="update-status-bimbingan/{{ $item->id }}" data-toggle="modal"
                                                    data-target="#updateStatusBimbingan{{ $item->id }}"
                                                    class="font-weight-bold badge badge-warning text-white text-uppercase">
                                                    {{
                                                    $item->stts }}</a>
                                            </td>
                                            @elseif($item->stts=='acc')
                                            <td>
                                                <a href="update-status-bimbingan/{{ $item->id }}" data-toggle="modal"
                                                    data-target="#updateStatusBimbingan{{ $item->id }}"
                                                    class="font-weight-bold badge badge-success text-white text-uppercase">
                                                    {{
                                                    $item->stts }}</a>
                                            </td>
                                            @else
                                            <td>
                                                <a href="update-status-bimbingan/{{ $item->id }}" data-toggle="modal"
                                                    data-target="#updateStatusBimbingan{{ $item->id }}"
                                                    class="font-weight-bold badge badge-danger text-white text-uppercase">
                                                    {{
                                                    $item->stts }}</a>
                                            </td>
                                            @endif
                                            <td> {{ \Illuminate\Support\Str::limit($item->catatan, 60) }}
                                                @if (strlen($item->catatan) > 60)
                                                <br>
                                                {{ substr($item->catatan, 60) }}
                                                @endif
                                            </td>
                                            <td>{{ $item->daftarta->tahunakademik->tahun }}</td>
                                            <td>{{ $item->author }}</td>
                                            <td>{{ $item->created_at }}</td>
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

            <form method="POST" enctype="multipart/form-data" action="/bimbingan-ta-1">
                @csrf
                <div class="modal-body">

                    <div class="form-group required">
                        <div class="row">
                            <div class="col-6">
                                <label class="control-label">NIM - Nama - Tahun </label>
                                @foreach ($d_bimbing_2 as $item)
                                <input type="text" class="form-control"
                                    value="{{ $item->mahasiswa->biodata->no_induk }} - {{ $item->mahasiswa->biodata->nama }} - {{ $item->tahunakademik->tahun }}"
                                    readonly>
                                <input type="hidden" name="daftar_ta_id" value="{{ $item->id }}">
                                @endforeach
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
                                <label class="control-label">Judul Bimbingan </label>
                                <input type="text" class="form-control" name="judul_bimbingan">
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
                                <label>Catatan</label>
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

            <form method="POST" enctype="multipart/form-data" action="/bimbingan-ta-1/{{ $item->id }}">
                @method('put')
                @csrf
                <div class="modal-body">

                    <div class="form-group required">
                        <div class="row">
                            <div class="col">
                                <label class="control-label">NIM - Nama - Tahun </label>
                                <select class="form-control" name="daftar_ta_id" onchange="no_mahasiswa()"
                                    id="daftar_ta_id_1">
                                    <option value="{{ $item->daftar_ta_id }}">{{
                                        $item->daftarta->mahasiswa->biodata->no_induk }}
                                        -
                                        {{
                                        $item->daftarta->mahasiswa->biodata->nama }} - {{
                                        $item->daftarta->tahunakademik->tahun }}
                                    </option>
                                </select>
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
                                <label class="control-label">Judul Bimbingan </label>
                                <input type="text" class="form-control" name="judul_bimbingan"
                                    value="{{ $item->judul_bimbingan }}">
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
    $(document).ready(function () {
    var table = $("#bimbingan-ta").DataTable({});
        $("#filter-tahun").change(function () {
        table.column($(this).data("column")).search($(this).val()).draw();
    });
        $("#filter-stts").change(function () {
        table.column($(this).data("column")).search($(this).val()).draw();
    });
    });


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