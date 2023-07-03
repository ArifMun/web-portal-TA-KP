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
</style>

<div class="main-panel">
    <div class="content">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">Data Akun</h4>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                @if(Auth::user()->level!=2)
                                <h4 class="card-title">Biodata Diri</h4>
                                {{-- <form method="post" enctype="multipart/form-data" action="import-excel">
                                    @csrf
                                    <div class="form-group">
                                        <table class="table">
                                            <tr>
                                                <td width="40%" align="right"><label>Select File for Upload</label></td>
                                                <td width="30">
                                                    <input type="file" name="file-import">
                                                </td>
                                                <td width="30%" align="left">
                                                    <input type="submit" name="upload"
                                                        class="btn btn-primary btn-round ml-auto" value="upload">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td width="40%" align="right"></td>
                                                <td width="30"><span class="text-muted">.xls, .xslx</span></td>
                                                <td width="30%" align="left"></td>
                                            </tr>
                                        </table>
                                    </div>
                                </form> --}}
                                @elseif (Auth::user()->level==2)
                                <h4 class="card-title">Tambah Akun</h4>
                                <a href="/akun/import" class="btn btn-success btn-round ml-auto" data-toggle="modal"
                                    data-target="#importFile">
                                    <i class="fas fa-file-import"></i>
                                    Import
                                </a>
                                <a href="/akun/tambah" class="btn btn-primary btn-round ml-auto" data-toggle="modal"
                                    data-target="#modalAddAkun">
                                    <i class="fa fa-plus"></i>
                                    Tambah Akun
                                </a>
                                @if ($errors->any())
                                @foreach ($errors->all() as $item)
                                @php
                                alert()->warning('Terdapat Data Yang Duplikat')
                                @endphp
                                @endforeach
                                @endif
                                @endif
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="add-row" class="display table table-striped table-hover">
                                    <thead>
                                        <tr align="center">
                                            <th>No</th>
                                            <th>NIM/Username</th>
                                            <th>Nama</th>
                                            <th>Email</th>
                                            <th>Keahlian</th>
                                            <th>Jabatan</th>
                                            <th>Tempat Lahir</th>
                                            <th>Tanggal Lahir</th>
                                            <th>No Wa</th>
                                            <th>Alamat</th>
                                            <th>Level</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>

                                    @if (Auth::user()->level!=2)
                                    <tbody>
                                        @php
                                        $no=1;
                                        @endphp

                                        <tr align="center">
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $authUser->biodata->no_induk }}</td>
                                            <td class="text-capitalize">{{ $authUser->biodata->nama }}</td>
                                            <td>{{ $authUser->biodata->email }}</td>
                                            <td>{{ $authUser->biodata->keahlian }}</td>
                                            <td class="text-capitalize">{{ $authUser->biodata->jabatan }}</td>
                                            <td>{{ $authUser->biodata->tempat_lahir }}</td>
                                            <td>{{ $authUser->biodata->tgl_lahir }}</td>
                                            <td>{{ $authUser->biodata->no_telp }}</td>
                                            <td>{{ $authUser->biodata->alamat }}</td>
                                            <td>{{ $authUser->level }}</td>
                                            <td>
                                                <a href="#editDataAkun{{ $authUser->biodata->id }}" data-toggle="modal"
                                                    class="btn btn-warning btn-xs"><i class="fa fa-edit">
                                                    </i> </a>
                                            </td>
                                        </tr>
                                    </tbody>

                                    @elseif(Auth::user()->level==2)
                                    <tbody>
                                        @php
                                        $no=1;
                                        @endphp
                                        @foreach ($biodata as $row)

                                        <tr align="center">
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $row->no_induk }}</td>
                                            <td class="text-capitalize">{{ $row->nama }}</td>
                                            <td>{{ $row->email }}</td>
                                            <td>{{ $row->keahlian }}</td>
                                            <td class="text-capitalize">{{ $row->jabatan }}</td>
                                            <td>{{ $row->tempat_lahir }}</td>
                                            <td>{{ $row->tgl_lahir }}</td>
                                            <td>{{ $row->no_telp }}</td>
                                            <td>{{ $row->alamat }}</td>
                                            <td>{{ $row->users->level }}</td>
                                            <td>
                                                {{-- <a href="#viewDataBarang{{ $row->id }}" data-toggle="modal"
                                                    class="btn btn-primary btn-xs"><i class="fa fa-eye">
                                                    </i> </a> --}}
                                                <a href="#editDataAkun{{ $row->id }}" data-toggle="modal"
                                                    class="btn btn-warning btn-xs"><i class="fa fa-edit">
                                                    </i> </a>
                                                <a href="#modalHapusAkun{{ $row->id }}" data-toggle="modal"
                                                    data-target="" class="btn btn-danger btn-xs"><i class="fa fa-trash">
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
<div class="modal fade modalTambahAkun" id="modalAddAkun" tabindex="-1" role="dialog"
    aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Tambah Akun</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form method="POST" enctype="multipart/form-data" action="registrasi">
                @csrf
                <div class="modal-body">

                    <div class="form-group required">
                        <div class="row">
                            <div class="col">
                                <label class="control-label">Nama </label>
                                <input type="text" class="form-control" name="nama" id="nama" required>
                            </div>
                            <div class="col">
                                <label class="control-label">No Induk </label>
                                <input type="number" class="form-control" name="no_induk" placeholder="No Induk .."
                                    required>
                            </div>
                        </div>
                    </div>

                    <div class="form-group required">
                        <div class="row">
                            <div class="col">
                                <label class="control-label">Email </label>
                                <input type="text" class="form-control" name="email" placeholder="Email ..">
                            </div>
                            <div class="col">
                                <label class="control-label">No WA </label>
                                <input type="text" class="form-control" name="no_telp" placeholder="No WA .." required>
                            </div>
                        </div>
                    </div>

                    <div class="form-group required">
                        <div class="row">
                            <div class="col">
                                <label>Tempat Lahir</label>
                                <input type="text" class="form-control" name="tempat_lahir"
                                    placeholder="Tempat Lahir . .">
                            </div>
                            <div class="col">
                                <label>Tanggal Lahir</label>
                                <input type="date" class="form-control" name="tgl_lahir" placeholder="Tanggal Lahir ..">
                            </div>
                        </div>
                    </div>

                    <div class="form-group required">
                        <div class="row">
                            <div class="col">
                                <label>Alamat</label>
                                <input type="text" class="form-control" name="alamat" placeholder="Alamat ..">
                            </div>
                            <div class="col">
                                <label class="control-label">Jabatan </label>
                                <select class="form-control" name="jabatan" id="jabatan" required>
                                    <option value="" hidden="">-- Pilih Jabatan --</option>
                                    @php
                                    $position = array('dosen'=>'Dosen','TU'=>'Tata
                                    Usaha','mahasiswa'=>'Mahasiswa','kaprodi'=>'Kaprodi');
                                    @endphp
                                    @foreach ($position as $k=>$jabatan)
                                    <option value="{{ $k }}">{{ $jabatan }}</option>
                                    @endforeach
                                </select>
                            </div>

                        </div>
                    </div>
                    <div class="form-group required">
                        <div class="row">
                            <div class="col-6">
                                <label class="control-label">Level </label>
                                <select class="form-control" name="level" required>
                                    <option value="" hidden="">-- Pilih Level --</option>
                                    @php
                                    $levels= array(0,1,2,3);
                                    @endphp
                                    @foreach ($levels as $k=>$level)
                                    <option value="{{ $level }}">{{ $level }}</option>
                                    @endforeach
                                </select>
                                <label class="control-label mt-3">Password </label>
                                <input type="password" class="form-control" name="password" placeholder="Password .."
                                    required>
                            </div>
                            <div class="col" id="kolomBaru_1" style="display: none">
                                <label>Konsentrasi </label>
                                <select class="form-control konsentrasi" name="keahlian[]" multiple>
                                    {{-- <option value="" hidden="">-- Konsentrasi --</option> --}}
                                    @foreach ($konsentrasi as $item)
                                    <option value="{{ $item->nama_konsentrasi }}">{{ $item->nama_konsentrasi }}</option>
                                    @endforeach
                                </select>

                                <input type="hidden" name="keahlian[]" class="form-control" name="keahlian"
                                    placeholder="Keahlian ..">
                            </div>
                        </div>
                    </div>

                    <div class="form-group required">
                        <div class="row">
                            <div class="col">

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
@foreach($biodata as $d)
<div class="modal fade modalEditAkun" id="editDataAkun{{ $d->id }}" tabindex="-1" role="dialog"
    aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Ubah Data Akun</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form method="POST" enctype="multipart/form-data" action="registrasi/{{ $d->id }}">
                @method('put')
                @csrf
                <div class="modal-body">
                    <div class="form-group required">
                        <div class="row">
                            <div class="col">
                                <label class="control-label">Nama </label>
                                <input type="text" class="form-control" name="nama" id="nama" value="{{ $d->nama }}"
                                    required>
                            </div>
                            <div class="col">
                                <label class="control-label">No Induk </label>
                                <input type="number" class="form-control" name="no_induk" id="no_induk"
                                    placeholder="No Induk .." value="{{ $d->no_induk }}" required>
                            </div>
                        </div>
                    </div>

                    <div class="form-group required">
                        <div class="row">
                            <div class="col">
                                <label class="control-label">Email </label>
                                <input type="text" class="form-control" name="email" placeholder="No WA .."
                                    value="{{ $d->email }}" required>
                            </div>
                            <div class="col">
                                <label class="control-label">No WA </label>
                                <input type="text" class="form-control" name="no_telp" placeholder="No WA .."
                                    value="{{ $d->no_telp }}" required>
                            </div>

                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col">
                                <label>Tempat Lahir</label>
                                <input type="text" class="form-control" name="tempat_lahir"
                                    placeholder="Tempat Lahir . ." value="{{ $d->tempat_lahir }}">
                            </div>
                            <div class="col">
                                <label>Tanggal Lahir</label>
                                <input type="date" class="form-control" name="tgl_lahir" placeholder="Tanggal Lahir .."
                                    value="{{ $d->tgl_lahir }}">
                            </div>

                        </div>
                    </div>


                    <div class="form-group required">
                        <div class="row">
                            <div class="col-6">
                                <label>Alamat</label>
                                <input type="text" class="form-control" name="alamat" placeholder="Alamat ..">
                            </div>
                            @if (Auth::user()->level==2)
                            <div class="col">
                                <label class="control-label">Jabatan </label>

                                @if ($d->jabatan=='mahasiswa' || $d->jabatan=='TU')
                                <input type="text" class="form-control" value="{{ $d->jabatan }}" id="jabatan_1"
                                    name="jabatan_1" readonly>
                                <input type="hidden" name="jabatan" value="{{ $d->jabatan }}">
                                @else

                                <select class="form-control" name="jabatan" id="jabatan_1" required>
                                    <option value="" hidden="">-- Pilih Jabatan --</option>

                                    <option <?php if($d->jabatan == 'kaprodi') echo "selected"; ?>
                                        value="kaprodi">Kaprodi
                                    </option>
                                    <option <?php if($d->jabatan == 'dosen') echo "selected"; ?> value="dosen">Dosen
                                    </option>
                                </select>
                                @endif
                            </div>
                            @else
                            <div class="col">
                                <label class="control-label">Password </label>
                                <input type="password" class="form-control" name="password" placeholder="Password ..">
                            </div>
                            @endif
                        </div>
                    </div>

                    @if (Auth::user()->level==2)
                    <div class="form-group required">
                        <div class="row">
                            <div class="col" id="kolomBaru_2" style="display: none">
                                <label>Konsentrasi</label>
                                <select class="form-control konsentrasi_" name="keahlian[]" id="keahlian_{{ $d->id }}"
                                    multiple>
                                    @foreach ($konsentrasi as $item)
                                    <option value="{{ $item->nama_konsentrasi }}" {{ in_array($item->
                                        nama_konsentrasi,
                                        explode(',', $d->keahlian)) ? 'selected' : '' }}>
                                        {{ $item->nama_konsentrasi }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-6">
                                <label class="control-label">Level </label>
                                <select class="form-control" name="level" required>
                                    <option <?php if($d->users->level == 0) echo "selected"; ?> value="0">0
                                    </option>
                                    <option <?php if($d->users->level == 1) echo "selected"; ?>
                                        value="1">1</option>
                                    <option <?php if($d->users->level == 2) echo "selected"; ?>
                                        value="2">2</option>
                                    <option <?php if($d->users->level == 3) echo "selected"; ?>
                                        value="3">3</option>
                                </select>
                                <label class="control-label mt-3">Password </label>
                                <input type="password" class="form-control" name="password" placeholder="Password ..">
                            </div>
                        </div>
                    </div>
                    @endif

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

<div class="modal fade" id="importFile" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-open">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Import File</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form method="POST" enctype="multipart/form-data" action="import-excel">
                @csrf
                <div class="modal-body">

                    <div class="form-group">
                        <div class="row">
                            <div class="col">
                                <label>Pilih File</label>
                                <input type="file" class="form-control" name="file-import">
                                <span class="text-muted">.xls, .xslx</span>
                            </div>

                        </div>
                    </div>


                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-undo">
                            </i> Kembali</button>
                        <button type="submit" class="btn btn-primary"><i class="fa fa-save"> </i> Upload</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
{{-- Hapus --}}
@foreach ($biodata as $d)
<div class="modal fade" id="modalHapusAkun{{ $d->id }}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-open">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="exampleModalLongTitle">Hapus Data Akun</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form method="POST" enctype="multipart/form-data" action="/registrasi/{{ $d->id }}">
                @method('delete')
                @csrf
                <div class="modal-body">

                    <input type="hidden" value="{{ $d->id }}" name="id" required>

                    <div class=" form-group">
                        <h3>Apakah anda yakin menghapus akun <span class="text-danger">{{ $d->nama }}
                            </span> dengan No Induk <span class="text-danger">{{ $d->no_induk }}</span> ?</h3>
                        <h4 class="btn btn-warning text-uppercase ">Data Terkait Nama tersebut juga akan terhapus!</h4>
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
<script src="/assets/js/select2.min.js"></script>

<script>
    $(document).ready(function() {
        $('.konsentrasi').select2({
            width: '100%',
            // theme: 'bootstrap'
        });
    });
    $(document).ready(function() {
        $('.konsentrasi_').select2({
            width: '100%'
        });
    });
</script>

<script>
    $(document).ready(function() {
        $('.modalTambahAkun').on('show.bs.modal', function() {
            var formId = '#' + $(this).attr('id');
            toggleKolomBaru_1(formId);
        
        $(formId + ' #jabatan').on('change', function() {
            toggleKolomBaru_1(formId);
        });
        
        function toggleKolomBaru_1(formId) {
                if ($(formId + ' select[name="jabatan"]').val() === 'dosen') {
                    $(formId + ' #kolomBaru_1').show();

                }
                else if ($(formId + ' select[name="jabatan"]').val() === 'kaprodi') {
                    $(formId + ' #kolomBaru_1').show();
                    
                } else {
                    $(formId + ' #kolomBaru_1').hide();
                }
            }
        });
    });

    // edit
    $(document).ready(function() {
        $('.modalEditAkun').on('show.bs.modal', function() {
            var formId = '#' + $(this).attr('id');
            toggleKolomBaru_2(formId);
        
        $(formId + ' #jabatan_1').on('change', function() {
            toggleKolomBaru_2(formId);
        });
        
        function toggleKolomBaru_2(formId) {
                if ($(formId + ' select[name="jabatan"]').val() === 'dosen') {
                    $(formId + ' #kolomBaru_2').show();
                }else if ($(formId + ' select[name="jabatan"]').val() === 'kaprodi') {
                    $(formId + ' #kolomBaru_1').show();
                }else {
                    $(formId + ' #kolomBaru_2').hide();
                }
            }
        });
    });
</script>

@endsection