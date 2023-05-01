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
                                        <tr>
                                            <th>No</th>
                                            <th>NIM</th>
                                            <th>Nama</th>
                                            <th>Judul Bimbingan</th>
                                            <th>Laporan KP</th>
                                            <th>Status</th>
                                            <th>Catatan</th>
                                            <th>Author</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>

                                    @if (Auth::user()->level==0)
                                    <tbody>
                                        @if (!empty(Auth::user()->biodata->mahasiswa->bimbingankp))
                                        @foreach ($bimbingMhs as $item)
                                        {{-- {{ $item }} --}}
                                        <tr>@php $no=1; @endphp
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $item->daftarkp->mahasiswa->biodata->no_induk}}</td>
                                            <td>{{ $item->daftarkp->mahasiswa->biodata->nama }}</td>
                                            <td>{{ $item->judul_bimbingan }}</td>
                                            <td>{{ $item->laporan_kp }}</td>
                                            <td>{{ $item->status }}</td>
                                            <td>{{ $item->catatan }}</td>
                                            <td>{{ $item->author }}</td>

                                            <td>
                                                <a href="bimbingan-kp/edit/{{ $item->daftarkp->seminarkp->id }}"
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
                                        @foreach ($bimbingDosen as $row)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $row->daftarkp->mahasiswa->biodata->no_induk }}</td>
                                            <td>{{ $row->daftarkp->mahasiswa->biodata->nama }}</td>
                                            <td>{{ $item->judul_bimbingan }}</td>
                                            <td>{{ $item->laporan_kp }}</td>
                                            <td>{{ $item->status }}</td>
                                            <td>{{ $item->catatan }}</td>
                                            <td>{{ $item->author }}</td>
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
{{-- <div class="modal fade" id="modalDaftarSeminar" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
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
                                <select class="form-control" name="daftarkp_id" onchange="no_mahasiswa()"
                                    id="daftarkp_id" required>
                                    <option value="" hidden="">-- Pilih --</option>

                                    @if (Auth::user()->level==0 )
                                    @foreach ($mhskps as $item)
                                    <option value="{{ $item->id}}">{{
                                        $item->mahasiswa->biodata->no_induk
                                        }} - {{ $item->mahasiswa->biodata->nama
                                        }} - {{ $item->tahunakademik->tahun }}
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
                            <input type="hidden" name="mahasiswa_id" id="mahasiswa_id" readonly>
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
</div> --}}

{{-- Edit --}}
{{-- @foreach ($seminarkp as $item)
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
                                <select class="form-control" name="daftarkp_id" id="daftarkp_id">
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
@endforeach --}}

{{-- view Form Bimbingan --}}
{{-- @foreach ($seminarkp as $item)
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
                        <h3>Apakah anda ingin menghapus data </h>
                            dengan Nama <span class="text-danger">{{ $kp->mahasiswa->biodata->nama }}</span> dengan No
                            Induk <span class="text-danger">{{
                                $kp->mahasiswa->biodata->no_induk
                                }} </span> ?
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

<script src="/assets/js/core/jquery.3.2.1.min.js"></script>

<script>
    function no_mahasiswa() {
        let daftarkp_id = $("#daftarkp_id").val();
        $("#mahasiswa_id").children().remove();
        if (daftarkp_id != '' && daftarkp_id != null) {
            $.ajax({

                url: "{{ url('') }}/seminar-kp/mahasiswa_id/" + daftarkp_id,
                success: function (res) {
                    $("#mahasiswa_id").val(res.mahasiswa_id);
                }
            });
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