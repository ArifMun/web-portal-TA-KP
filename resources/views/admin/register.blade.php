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
                                @elseif (Auth::user()->level==2)
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
                                @if ($errors->any() )
                                @foreach ($errors->all() as $item)
                                @php
                                alert()->warning($item)
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
                                            <th>Jabatan</th>
                                            <th>Tempat Lahir</th>
                                            <th>Tanggal Lahir</th>
                                            <th>No Telpon</th>
                                            <th>Alamat</th>
                                            <th>Keahlian</th>
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
                                            <td class="text-capitalize">{{ $authUser->biodata->jabatan }}</td>
                                            <td>{{ $authUser->biodata->tempat_lahir }}</td>
                                            <td>{{ $authUser->biodata->tgl_lahir }}</td>
                                            <td>{{ $authUser->biodata->no_telp }}</td>
                                            <td>{{ $authUser->biodata->alamat }}</td>
                                            <td>{{ $authUser->biodata->keahlian }}</td>
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
                                            <td class="text-capitalize">{{ $row->jabatan }}</td>
                                            <td>{{ $row->tempat_lahir }}</td>
                                            <td>{{ $row->tgl_lahir }}</td>
                                            <td>{{ $row->no_telp }}</td>
                                            <td>{{ $row->alamat }}</td>
                                            <td>{{ $row->keahlian }}</td>
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

            <form method="POST" enctype="multipart/form-data" action="registrasi">
                @csrf
                <div class="modal-body">

                    <div class="form-group required">
                        <div class="row">
                            <div class="col">
                                <label class="control-label">Nama </label>
                                <input type="text" class="form-control" name="nama" id="nama" value="{{ old('nama') }}"
                                    placeholder="Nama" required>
                            </div>
                            <div class="col">
                                <label class="control-label">No Induk </label>
                                <input type="number" class="form-control" name="no_induk" value="{{ old('no_induk') }}"
                                    placeholder="No Induk .." required>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col">
                                <label class="control-label">Email </label>
                                <input type="text" class="form-control" name="email" value="{{ old('email') }}"
                                    placeholder="Email .." required>
                            </div>
                            <div class="col">
                                <label class="">No WhatsApp </label>
                                <input type="text" class="form-control" name="no_telp" value="{{ old('no_telp') }}"
                                    placeholder="No WhatsApp ..">
                            </div>
                        </div>
                    </div>

                    <div class="form-group required">
                        <div class="row">
                            <div class="col">
                                <label>Tempat Lahir</label>
                                <input type="text" class="form-control" name="tempat_lahir"
                                    value="{{ old('tempat_lahir') }}" placeholder="Tempat Lahir . .">
                            </div>
                            <div class="col">
                                <label>Tanggal Lahir</label>
                                <input type="date" class="form-control" name="tgl_lahir" value="{{ old('tgl_lahir') }}"
                                    placeholder="Tanggal Lahir ..">
                            </div>
                        </div>
                    </div>

                    <div class="form-group required">
                        <div class="row">
                            <div class="col">
                                <label>Alamat</label>
                                <input type="text" class="form-control" name="alamat" value="{{ old('alamat') }}"
                                    placeholder="contoh: Desa Kemiri Kidul RT/RW 02/06 ..">
                            </div>
                            <div class="col">
                                <label>Kecamatan</label>
                                <input type="text" class="form-control" name="alamat_kec"
                                    value="{{ old('alamat_kec') }}" placeholder="Kecamatan ..">
                            </div>
                        </div>
                    </div>

                    <div class="form-group required">
                        <div class="row">
                            <div class="col">
                                <label class="control-label">Jabatan </label>
                                <select class="form-control" name="jabatan" id="jabatan" required>
                                    <option value="" hidden="">-- Pilih Jabatan --</option>
                                    @php
                                    $position = array('mahasiswa'=>'Mahasiswa','dosen'=>'Dosen','TU'=>'Tata
                                    Usaha','kaprodi'=>'Kaprodi');
                                    @endphp
                                    @foreach ($position as $k=>$jabatan)
                                    <option value="{{ $k }}">{{ $jabatan }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col">
                                <label>Kabupaten</label>
                                <input type="text" class="form-control" name="alamat_kab"
                                    value="{{ old('alamat_kab') }}" placeholder="Kabupaten ..">
                            </div>
                        </div>
                    </div>

                    <div class="form-group required">
                        <div class="row">
                            <div class="col" id="kolomBaru_1">
                                <label>Konsentrasi </label>
                                <select class="form-control konsentrasi" id="keahlian" name="keahlian[]" multiple>
                                    @foreach ($konsentrasi as $item)
                                    <option value="{{ $item->nama_konsentrasi }}">{{ $item->nama_konsentrasi }}</option>
                                    @endforeach
                                </select>

                                {{-- <input type="hidden" name="keahlian[]" class="form-control" name="keahlian"
                                    placeholder="Keahlian .."> --}}
                            </div>
                            <div class="col">
                                <label class="control-label">Level </label>
                                <select class="form-control" name="level" required>
                                    <option value="" hidden>-- Pilih Level --</option>
                                    @php
                                    $levels = [0, 1, 2];
                                    $oldLevel = old('level'); // Mendapatkan nilai lama dari input "level"
                                    @endphp
                                    @foreach ($levels as $level)
                                    <option value="{{ $level }}" {{ $level==$oldLevel ? 'selected' : '' }}>{{ $level }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-group required">
                        <div class="row">
                            <div class="col">
                                <label>Nama Ayah</label>
                                <input type="text" class="form-control" id="nama_ayah" name="nama_ayah"
                                    value="{{ old('nama_ayah') }}" placeholder="Nama Ayah ..">
                            </div>
                            <div class="col">
                                <label class="control-label">Password </label>
                                <input type="password" class="form-control" name="password" placeholder="Password .."
                                    required>
                            </div>
                        </div>
                    </div>

                    <div class="form-group ">
                        <div class="row">
                            <div class="col">
                                <label>Nama Ibu</label>
                                <input type="text" class="form-control" id="nama_ibu" name="nama_ibu"
                                    value="{{ old('nama_ibu') }}" placeholder="Nama Ibu ..">
                            </div>
                            <div class="col">
                                <label>Alamat Orang Tua</label>
                                <input type="text" class="form-control" id="alamat_ortu" name="alamat_ortu"
                                    value="{{ old('alamat_ortu') }}" placeholder="Alamat Orang Tua ..">
                            </div>
                        </div>
                    </div>

                    <div class="form-group ">
                        <div class="row">
                            <div class="col">
                                <label>No HP Orang Tua</label>
                                <input type="text" class="form-control" id="no_hp_ortu" name="no_hp_ortu"
                                    value="{{ old('no_hp_ortu') }}" placeholder="Nomor Handphone Orang Tua ..">
                            </div>
                            <div class="col">
                                <label>Pekerjaan Orang Tua</label>
                                <input type="text" class="form-control" id="pekerjaan_ortu" name="pekerjaan_ortu"
                                    value="{{ old('pekerjaan_ortu') }}" placeholder="Pekerjaan Orang Tua ..">
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
            <form method="POST" enctype="multipart/form-data" action="registrasi/{{ $d->id }}">
                @method('put')
                @csrf
                <div class="modal-body">

                    @if ($d->users->level == 0)
                    {{-- <input type="text" class="form-control" name="level" value="{{ $d->users->level }}" readonly>
                    --}}
                    <input type="hidden" name="level" value="0">
                    @endif

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
                                    value="{{ old('email', $d->email) }}" required>
                            </div>
                            <div class="col">
                                <label class="control-label">No WA </label>
                                <input type="text" class="form-control" name="no_telp" placeholder="No WA .."
                                    value="{{ old('no_telp', $d->no_telp) }}" required>
                            </div>

                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col">
                                <label>Tempat Lahir</label>
                                <input type="text" class="form-control" name="tempat_lahir"
                                    placeholder="Tempat Lahir . ." value="{{ old('tempat_lahir',$d->tempat_lahir) }}">
                            </div>
                            <div class="col">
                                <label>Tanggal Lahir</label>
                                <input type="date" class="form-control" name="tgl_lahir" placeholder="Tanggal Lahir .."
                                    value="{{ old('tgl_lahir',$d->tgl_lahir)}}">
                            </div>

                        </div>
                    </div>

                    <div class="form-group required">
                        <div class="row">
                            <div class="col">
                                <label>Alamat</label>
                                <input type="text" class="form-control" name="alamat"
                                    value="{{ old('alamat', $d->alamat)}}"
                                    placeholder="contoh: Desa Kemiri Kidul RT/RW 02/06 ..">
                            </div>
                            <div class="col">
                                <label>Kecamatan</label>
                                <input type="text" class="form-control" name="alamat_kec"
                                    value="{{ old('alamat_kec', $d->alamat_kec) }}" placeholder="Kecamatan ..">
                            </div>
                        </div>
                    </div>

                    <div class="form-group required">
                        <div class="row">
                            {{-- @if (Auth::user()->level==2) --}}
                            <div class="col">
                                <label class="control-label">Jabatan </label>

                                @if ($d->jabatan=='mahasiswa' || $d->jabatan=='TU')
                                <select class="form-control text-capitalize" name="jabatan" id="jabatan_1" disabled
                                    required>
                                    <option value="" hidden="">-- Pilih Jabatan --</option>

                                    <option <?php if($d->jabatan == 'mahasiswa') echo "selected"; ?>
                                        value="mahasiswa">Mahasiswa
                                    <option <?php if($d->jabatan == 'TU') echo "selected"; ?>
                                        value="TU">Tata Usaha
                                    </option>
                                </select>
                                <input type="hidden" name="jabatan" value="{{ $d->jabatan }}">
                                @else

                                <select class="form-control text-capitalize" name="jabatan" id="jabatan_1" required>
                                    <option value="" hidden="">-- Pilih Jabatan --</option>

                                    <option <?php if($d->jabatan == 'kaprodi') echo "selected"; ?>
                                        value="kaprodi">Kaprodi
                                    </option>
                                    <option <?php if($d->jabatan == 'dosen') echo "selected"; ?> value="dosen">Dosen
                                    </option>
                                </select>
                                @endif
                            </div>
                            <div class="col">
                                <label>Kabupaten</label>
                                <input type="text" class="form-control" name="alamat_kab"
                                    value="{{ old('alamat_kab', $d->alamat_kab) }}" placeholder="Kabupaten ..">
                            </div>

                        </div>
                    </div>

                    @if (UserCheck::levelAdmin())
                    <div class="form-group required">
                        <div class="row">
                            {{-- <div class="col">
                                <label>Konsentrasi</label>
                                <select class="form-control konsentrasi_" name="keahlian[]"
                                    id="konsentrasi_{{ $d->id }}" multiple required size="1">
                                    @foreach ($konsentrasi as $item)
                                    <option value="{{ $item->nama_konsentrasi }}" {{ in_array($item->
                                        nama_konsentrasi,
                                        explode(',',
                                        $d->keahlian)) ? 'selected' : '' }}>
                                        {{ $item->nama_konsentrasi }}
                                    </option>
                                    @endforeach
                                </select>
                            </div> --}}
                            <div class="col">
                                <label>Keahlian </label>
                                <select class="form-control keahlian_" name="keahlian[]" id="keahlian_" multiple
                                    size="1">
                                    {{-- <option value="" hidden="">-- Konsentrasi --</option> --}}

                                    @foreach($konsentrasi as $option)
                                    <option value="{{ $option->nama_konsentrasi }}" {{ in_array($option->
                                        nama_konsentrasi,
                                        explode(',',
                                        $d->keahlian)) ? 'selected' : '' }}>
                                        {{ $option->nama_konsentrasi }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col">
                                <label class="control-label">Level </label>
                                @if ($d->users->level == 0)
                                <input type="text" class="form-control" name="level" value="{{ $d->users->level }}"
                                    readonly>
                                <input type="hidden" name="level" value="0">
                                @else
                                <select class="form-control" name="level" required>
                                    <option <?php if($d->users->level == 0) echo "selected"; ?> value="0">0
                                    </option>
                                    <option <?php if($d->users->level == 1) echo "selected"; ?>
                                        value="1">1</option>
                                    <option <?php if($d->users->level == 2) echo "selected"; ?>
                                        value="2">2</option>
                                </select>
                                @endif
                            </div>

                        </div>
                    </div>
                    @endif
                    <div class="form-group required">
                        <div class="row">
                            <div class="col">
                                <label>Nama Ayah</label>
                                <input type="text" class="form-control" id="nama_ayah_" name="nama_ayah"
                                    value="{{ old('nama_ayah', $d->nama_ayah) }}" placeholder="Nama Ayah ..">
                            </div>
                            <div class="col">
                                <label class="control-label">Password </label>
                                <input type="password" class="form-control" name="password" placeholder="Password ..">
                            </div>
                        </div>
                    </div>

                    <div class="form-group ">
                        <div class="row">
                            <div class="col">
                                <label>Nama Ibu</label>
                                <input type="text" class="form-control" id="nama_ibu_" name="nama_ibu"
                                    value="{{ old('nama_ibu',$d->nama_ibu) }}" placeholder="Nama Ibu ..">
                            </div>
                            <div class="col">
                                <label>Alamat Orang Tua</label>
                                <input type="text" class="form-control" id="alamat_ortu_" name="alamat_ortu"
                                    value="{{ old('alamat_ortu',$d->alamat_ortu) }}" placeholder="Alamat Orang Tua ..">
                            </div>
                        </div>
                    </div>

                    <div class="form-group ">
                        <div class="row">
                            <div class="col">
                                <label>No HP Orang Tua</label>
                                <input type="text" class="form-control" id="no_hp_ortu_" name="no_hp_ortu"
                                    value="{{ old('no_hp_ortu',$d->no_hp_ortu) }}"
                                    placeholder="Nomor Handphone Orang Tua ..">
                            </div>
                            <div class="col">
                                <label>Pekerjaan Orang Tua</label>
                                <input type="text" class="form-control" id="pekerjaan_ortu_" name="pekerjaan_ortu"
                                    value="{{ old('pekerjaan_ortu',$d->pekerjaan_ortu) }}"
                                    placeholder="Pekerjaan Orang Tua ..">
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
<script src="/assets/js/native/konsentrasi.js"></script>
<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

</script>
{{-- <script>
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
</script> --}}

<script>
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
                    $("#keahlian_").prop("disabled", false);
                }else {
                    $("#keahlian_").prop("disabled", true);
                }
            }
        });
    });
</script>

@endsection