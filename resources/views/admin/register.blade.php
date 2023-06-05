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
                                <h4 class="card-title">Tambah Akun</h4>
                                <a href="/akun/tambah" class="btn btn-primary btn-round ml-auto" data-toggle="modal"
                                    data-target="#modalAddAkun">
                                    <i class="fa fa-plus"></i>
                                    Tambah Akun
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
                                        <tr align="center">
                                            <th>No</th>
                                            <th>No Induk</th>
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

                                    <tbody>
                                        @php
                                        $no=1;
                                        @endphp
                                        @foreach ($users as $row)

                                        <tr align="center">
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $row->no_induk }}</td>
                                            <td>{{ $row->nama }}</td>
                                            <td>{{ $row->email }}</td>
                                            <td>{{ $row->keahlian }}</td>
                                            <td>{{ $row->jabatan }}</td>
                                            <td>{{ $row->tempat_lahir }}</td>
                                            <td>{{ $row->tgl_lahir }}</td>
                                            <td>{{ $row->no_telp }}</td>
                                            <td>{{ $row->alamat }}</td>
                                            <td>{{ $row->level }}</td>
                                            <td>
                                                <a href="#viewDataBarang{{ $row->id }}" data-toggle="modal"
                                                    class="btn btn-primary btn-xs"><i class="fa fa-eye">
                                                    </i> </a>
                                                <a href="#editDataAkun{{ $row->id }}" data-toggle="modal"
                                                    class="btn btn-warning btn-xs"><i class="fa fa-edit">
                                                    </i> </a>
                                                <a href="#modalHapusBarang{{ $row->id }}" data-toggle="modal"
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
                            <div class="col">
                                <label id="kolomBaru_1" style="display: none">Konsentrasi </label>
                                <select id="kolomBaru_1" style="display: none" class="form-control keahlian"
                                    name="keahlian[]" id="keahlian" size="5" multiple>
                                    <option value="" hidden="">-- Konsentrasi --</option>
                                    @foreach ($konsentrasi as $item)
                                    <option value="{{ $item->nama_konsentrasi }}">{{ $item->nama_konsentrasi }}</option>
                                    @endforeach
                                </select>

                                <input type="hidden" name="keahlian[]" class="form-control" name="keahlian"
                                    placeholder="Keahlian ..">
                            </div>
                            <div class="col">
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
                            <div class="col">
                                <label>Alamat</label>
                                <input type="text" class="form-control" name="alamat" placeholder="Alamat ..">
                            </div>
                            <div class="col">
                                <label class="control-label">Jabatan </label>
                                <input type="text" class="form-control" value="{{ $d->jabatan }}" id="jabatan_1"
                                    name="jabatan_1" readonly>
                                {{-- <select class="form-control" name="jabatan" required>
                                    <option value="" hidden="">-- Pilih Jabatan --</option>
                                    <option <?php if($d->jabatan == 'dosen') echo "selected"; ?> value="dosen">Dosen
                                    </option>
                                    <option <?php if($d->jabatan == 'mahasiswa') echo "selected"; ?>
                                        value="mahasiswa">Mahasiswa</option>
                                    <option <?php if($d->jabatan == 'TU') echo "selected"; ?>
                                        value="TU">TU</option>
                                </select> --}}
                            </div>
                        </div>
                    </div>

                    <div class="form-group required">
                        <div class="row">
                            <div class="col">
                                <label>Keahlian</label>
                                <select class="form-control keahlian-select" name="keahlian[]"
                                    id="keahlian_{{ $d->id }}" size="5" multiple>
                                    @foreach ($konsentrasi as $item)
                                    <option value="{{ $item->nama_konsentrasi }}" {{ in_array($item->nama_konsentrasi,
                                        explode(',',$d->keahlian)) ? 'selected':'' }}>
                                        {{ $item->nama_konsentrasi }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col">
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
@foreach ($biodata as $d)
<div class="modal fade" id="modalHapusBarang{{ $d->id }}" tabindex="-1" role="dialog"
    aria-labelledby="myLargeModalLabel" aria-hidden="true">
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
                        <b><span class="text-danger"> Data terkait akun tersebut akan ikut terhapus !</span></b>
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
    document.addEventListener('DOMContentLoaded', function() {
    var selectElements = document.getElementsByClassName("keahlian");
    
    for (var i = 0; i < selectElements.length; i++) { 
        var selectElement=selectElements[i];
        selectElement.addEventListener("mousedown", function(e) { 
                e.preventDefault(); e.target.selected=!e.target.selected;
                this.focus(); 
                }); 
            } 
        });

    document.addEventListener('DOMContentLoaded', function() {
    var selectElements = document.getElementsByClassName("keahlian-select");
    
    for (var i = 0; i < selectElements.length; i++) { 
        var selectElement=selectElements[i];
        selectElement.addEventListener("mousedown", function(e) { 
        e.preventDefault(); e.target.selected=!e.target.selected;
        this.focus(); 
                }); 
            } 
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
                if ($(formId + ' input[name="jabatan_1"]').val() === 'dosen') {
                    $(formId + ' #keahlian_').show();
                }
                else {
                    $(formId + ' #keahlian_').hide();
                }
            }
        });
    });
</script>

@endsection