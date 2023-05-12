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
                <h4 class="page-title">Bimbingan Kerja Praktik</h4>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <p><i> Disini tempat untuk pengumuman</i> </p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <h4 class="card-title"></h4>
                                <a href="/bimbingan-kp/tambah" class="btn btn-primary btn-round ml-auto"
                                    data-toggle="modal" data-target="#modalTambahBimbingan">
                                    <i class="fa fa-plus"></i>
                                    Tambah
                                </a>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="divider"></div>
                            <div class="table-responsive">
                                <table id="add-row" class="display table table-striped table-hover">
                                    <thead>
                                        <tr align="center">
                                            <th>No</th>
                                            <th>NIM</th>
                                            <th>Nama</th>
                                            <th>Tahun</th>
                                            <th>Judul Kerja Praktik</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>

                                    @if (Auth::user()->level==0)
                                    <tbody>
                                        @php $no=1; @endphp
                                        @if (!empty(Auth::user()->biodata->mahasiswa->bimbingankp))
                                        @foreach ($bimbingMhs as $item)
                                        {{-- {{ $item }} --}}

                                        <tr align="center">
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $item->mahasiswa->biodata->no_induk}}</td>
                                            <td>{{ $item->mahasiswa->biodata->nama }}</td>
                                            <td>{{ $item->judul_bimbingan }}</td>
                                            <td>
                                                <a href="storage/{{ $item->laporan_kp }}"
                                                    class="btn btn-success btn-xs"><i class="fas fa-download">
                                                    </i>
                                                </a>
                                            </td>
                                            <td>{{ $item->stts }}</td>
                                            <td><a href="bimbingan-kp/view/{{ $item->id }}" data-toggle="modal"
                                                    data-target="#viewCatatan{{ $item->id }}"
                                                    class="btn-round btn-primary btn-xs"><i class="fa fa-eye">
                                                    </i> </a></td>
                                            <td>{{ $item->author }}</td>

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

                                        @else
                                        <tr>
                                            <td colspan="13">
                                                <p align="center"><i>Data Tidak Tersedia</i></p>
                                            </td>
                                        </tr>
                                        @endif
                                    </tbody>

                                    {{-- All- --}}
                                    @elseif(Auth::user()->level!=0)
                                    <tbody> @php $no=1; @endphp
                                        @foreach ($list as $item)
                                        <tr align="center">
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $item->daftarkp->mahasiswa->biodata->no_induk }}</td>
                                            <td>{{ $item->daftarkp->mahasiswa->biodata->nama }}</td>
                                            <td>{{ $item->daftarkp->judul}}</td>
                                            <td>{{ $item->daftarkp->tahunakademik->tahun }}</td>
                                            <td>
                                                <a href="bimbing-kp/list/{{ $item->daftarkp_id }}"
                                                    class="btn btn-warning btn-xs"><i class="fas fa-external-link-alt">
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
                            <div class="col">
                                <label class="control-label">NIM - Nama - Tahun </label>
                                <select class="form-control" name="daftarkp_id" onchange="no_mahasiswa()"
                                    id="daftarkp_id" required>
                                    <option value="" hidden="">-- Pilih --</option>

                                    @if (Auth::user()->level==0 )
                                    @foreach ($mhskps as $item)
                                    <option value="{{ $item->id}}">{{ $item->mahasiswa->biodata->no_induk }} - {{
                                        $item->mahasiswa->biodata->nama }} - {{ $item->tahunakademik->tahun
                                        }}
                                    </option>
                                    @endforeach
                                    @else

                                    {{-- @foreach ($daftarkp as $k)
                                    <option value="{{ $k->id }}">{{
                                        $k->mahasiswa->biodata->no_induk
                                        }} - {{ $k->mahasiswa->biodata->nama
                                        }} - {{ $k->tahunakademik->tahun
                                        }}</option>
                                    @endforeach --}}

                                    @endif
                                </select>
                            </div>
                            <div class="col">
                                <label class="control-label">Judul Bimbingan </label>
                                <input type="text" class="form-control" name="judul_bimbingan">
                            </div>
                            <input type="hidden" name="mahasiswa_id" id="mahasiswa_id" readonly>
                            <input type="hidden" name="dosen_id" id="dosen_id" readonly>
                            <input type="hidden" name="author" value="{{ Auth::user()->biodata->nama }}" readonly>
                        </div>
                    </div>

                    <div class="form-group required">
                        <div class="row">
                            <div class="col">
                                <label for="file" class="form-label control-label">Laporan KP </label>
                                <img class="img-preview img-fluid mb-3 col-sm-5" alt="">
                                <input type="file" class="form-control picture" id="laporan_kp" name="laporan_kp"
                                    onchange="previewImage()">
                            </div>
                            <div class="col">
                                <label class="control-label">Status </label>
                                <select class="form-control" name="stts" required>
                                    @if (Auth::user()->level==0)
                                    <option value="proses" @readonly(true)>Proses</option>
                                    @else
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
                                <label>Catatan</label>
                                {{-- <input type="textarea" class="form-control" name="catatan"> --}}
                                <textarea class="form-control" name="catatan" id="catatan"></textarea>

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
                                    @if (Auth::user()->level==0 )
                                    <option value="{{ $item->daftarkp_id }}">{{ $item->mahasiswa->biodata->no_induk }} -
                                        {{
                                        $item->mahasiswa->biodata->nama }} - {{
                                        $item->daftarkp->tahunakademik->tahun }}
                                    </option>
                                    @else

                                    {{-- @foreach ($daftarkp as $k)
                                    <option value="{{ $k->id }}">{{
                                        $k->mahasiswa->biodata->no_induk
                                        }} - {{ $k->mahasiswa->biodata->nama
                                        }} - {{ $k->tahunakademik->tahun
                                        }}</option>
                                    @endforeach --}}

                                    @endif
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
                                <label for="file" class="form-label control-label">Laporan KP </label>
                                <input type="hidden" name="oldFile" value="{{ $item->laporan_kp }}">
                                <input type="file" class="form-control " id="laporan_kp" name="laporan_kp"
                                    value="{{ $item->laporan_kp }}">

                            </div>
                            {{-- <div class="col">
                                <input type="text" class="form-control">
                                @if (!empty($item->laporan_kp))
                                <a href="storage/{{ $item->laporan_kp }}" class="btn btn-primary btn-xs"><i
                                        class="fas fa-download">
                                    </i>
                                </a>
                                @else
                                no data
                                @endif
                            </div> --}}
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
                                {{-- <input type="textarea" class="form-control" name="catatan"> --}}
                                <textarea class="form-control" name="catatan" id="cttn">{!!$item->catatan!!}</textarea>
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
                        <h3>Apakah anda ingin menghapus data bimbingan</h>
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
</script>
<script src="{{asset('assets/ckeditor/ckeditor.js')}}"></script>
<script>
    var konten = document.getElementById("catatan");
        CKEDITOR.replace(catatan,{
        language:'en-gb'
    });

    CKEDITOR.config.allowedContent = true;
</script>

<script>
    var konten = document.getElementById("cttn");
        CKEDITOR.replace(cttn,{
        language:'en-gb'
    });

    CKEDITOR.config.allowedContent = true;
</script>

@endsection