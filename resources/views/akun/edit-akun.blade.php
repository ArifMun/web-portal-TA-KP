@extends('layouts.layout')

@section('content')
<div class="main-panel">
    <div class="content">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">Edit Data Akun</h4>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <form method="POST" enctype="multipart/form-data"
                            action="{{ route('registrasi.update', $biodata->id) }}">
                            @method('PUT')
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col">
                                            <label>Nama</label>
                                            <input type="text" class="form-control" name="nama" id="nama"
                                                value="{{ old('nama',$biodata->nama) }}" required>
                                        </div>
                                        <div class="col">
                                            <label>No Induk</label>
                                            <input type="number" class="form-control" name="no_induk"
                                                placeholder="No Induk .." value="{{ old('no_induk',$biodata->no_induk)
                                            }}" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col">
                                            <label>Tempat Lahir</label>
                                            <input type="text" class="form-control" name="tempat_lahir"
                                                placeholder="Tempat Lahir . ."
                                                value="{{ old('tempat_lahir', $biodata->tempat_lahir) }}" required>
                                        </div>
                                        <div class="col">
                                            <label>Tanggal Lahir</label>
                                            <input type="date" class="form-control" name="tgl_lahir"
                                                placeholder="Tanggal Lahir .."
                                                value="{{ old('tgl_lahir', $biodata->tgl_lahir) }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col">
                                            <label>No WA</label>
                                            <input type="text" class="form-control" name="no_telp"
                                                placeholder="No WA .." value="{{ old('no_telp',$biodata->no_telp) }}"
                                                required>
                                        </div>
                                        <div class="col">
                                            <label>Password</label>
                                            <input type="password" class="form-control" name="password"
                                                placeholder="Password .." required>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col">
                                            <label>Keahlian</label>
                                            <input type="text" class="form-control" name="keahlian"
                                                placeholder="Keahlian .."
                                                value="{{ old('keahlian', $biodata->keahlian) }}">
                                        </div>
                                        <div class="col">
                                            <label>Jabatan</label>
                                            <input type="text" class="form-control" name="jabatan"
                                                value="{{ $biodata->jabatan }}" readonly>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col">
                                            <label>Level</label>
                                            <select class="form-control" name="level" required>
                                                <option value="" hidden="">-- Pilih Level --</option>

                                                <option <?php if ($biodata->users->level == 0)
                                                    echo "selected"
                                                    ;?> value="0">User</option>
                                                <option <?php if ($biodata->users->level == 1)
                                                    echo "selected"
                                                    ;?> value="1">Admin</option>
                                                <option <?php if ($biodata->users->level == 2)
                                                    echo "selected"
                                                    ;?> value="2">SuperAdmin</option>
                                            </select>
                                        </div>
                                        <div class="col">
                                            <label>Alamat</label>
                                            <input type="text" class="form-control" name="alamat"
                                                placeholder="Alamat .." value="{{ old('alamat',$biodata->alamat) }}"
                                                required>
                                        </div>
                                    </div>
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i
                                            class="fa fa-undo">
                                        </i> Kembali</button>
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-save"> </i>
                                        Simpan</button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>

        </div>
    </div>

</div>
@endsection