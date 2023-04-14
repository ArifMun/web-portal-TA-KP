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
                <h4 class="page-title">Kerja Praktik</h4>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        @if (Auth::user()->level == 0 && $formakses->akses == 'buka' || Auth::user()->level==1)
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <h4 class="card-title"></h4>
                                <a href="/kerja-praktik/daftar" class="btn btn-primary btn-round ml-auto"
                                    data-toggle="modal" data-target="#modalDaftarKP">
                                    <i class="fa fa-plus"></i>
                                    Daftar
                                </a>
                            </div>
                        </div>
                        @elseif(Auth::user()->level == 0 && $formakses->akses == 'tutup')
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <a href="#" class="btn btn-danger">
                                    <h4 class="card-title text-light">Pendaftaran Kerja Praktik Sudah Ditutup</h4>
                                </a>

                            </div>
                        </div>
                        @endif

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
                                        <tr>
                                            <th>No</th>
                                            <th>NIM</th>
                                            <th>Nama</th>
                                            <th>Dosen Pilihan 1</th>
                                            <th>Dosen Pilihan 2</th>
                                            <th>Ganti Dosen Pembimbing</th>
                                            <th>Dosen Pembimbing Lama</th>
                                            <th>Status Pengajuan</th>
                                            <th>Status KP</th>
                                            <th>Semester</th>
                                            <th>Slip Pembayaran</th>
                                            <th>Tahun</th>
                                            <th>Konsentrasi</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>

                                    @if (Auth::user()->level==0)
                                    <tbody>
                                        @if (!empty(Auth::user()->biodata->mahasiswa->daftarkp))
                                        @foreach ($mhskps as $item)
                                        {{-- {{ $item }} --}}
                                        <tr>@php $no=1; @endphp
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $item->mahasiswa->biodata->no_induk}}</td>
                                            <td>{{ $item->mahasiswa->biodata->nama }}</td>
                                            <td class="text-capitalize">
                                                @foreach ($dosen as $k)
                                                {{ $k->id == $item->d_pembimbing_1 ?
                                                $k->biodata->nama :''
                                                }}
                                                @endforeach
                                            </td>
                                            <td class="text-capitalize">
                                                @foreach ($dosen as $k)
                                                {{ $k->id == $item->d_pembimbing_2 ?
                                                $k->biodata->nama :''
                                                }}
                                                @endforeach
                                            </td>
                                            <td class="text-capitalize">
                                                {{ $item->ganti_pembimbing }}
                                            </td>
                                            <td>
                                                @foreach ($dosen as $k)
                                                {{ $k->id == $item->d_pembimbing_lama ?
                                                $k->biodata->nama :''
                                                }}
                                                @endforeach
                                            </td>

                                            @if ($item->stts_pengajuan=='tertunda')
                                            <td>
                                                <a
                                                    class="btn-warning btn-round p-1 font-weight-bold text-light text-capitalize">
                                                    {{
                                                    $item->stts_pengajuan }}</a>
                                            </td>
                                            @elseif($item->stts_pengajuan=='diterima')
                                            <td>
                                                <a
                                                    class="btn-success btn-round p-1 font-weight-bold text-light text-capitalize">
                                                    {{
                                                    $item->stts_pengajuan }}</a>
                                            </td>
                                            @else
                                            <td>
                                                <a
                                                    class="btn-danger btn-round p-1 font-weight-bold text-light text-capitalize">
                                                    {{
                                                    $item->stts_pengajuan }}</a>
                                            </td>
                                            @endif

                                            <td>{{ $item->stts_kp }}</td>
                                            <td>{{ $item->semester }}</td>
                                            <td><a href="kerja-praktik/view-slip/{{ $item->id }}" data-toggle="modal"
                                                    data-target="#viewSlip{{ $item->id }}"
                                                    class="btn btn-primary btn-xs"><i class="fa fa-eye">
                                                    </i> </a>

                                            <td>{{ $item->tahunakademik->tahun }} </td>
                                            <td>{{ $item->konsentrasi->nama_konsentrasi }}</td>
                                            <td>
                                                @if ($item->stts_pengajuan == 'diterima')

                                                @else
                                                <a href="kerja-praktik/edit/{{ $item->id }}" data-toggle="modal"
                                                    data-target="#modalEditKP{{ $item->id }}"
                                                    class="btn btn-warning btn-xs"><i class="fa fa-edit">
                                                    </i> </a>
                                                @endif
                                            </td>
                                        </tr>
                                        @endforeach

                                        @else
                                        <tr>
                                            <td colspan="12">
                                                <p align="center"><i>Data Tidak Tersedia</i></p>
                                            </td>
                                        </tr>
                                        @endif
                                    </tbody>

                                    @elseif(Auth::user()->level==1)
                                    <tbody> @php $no=1; @endphp
                                        @foreach ($daftarkp as $row)
                                        {{-- {{ $row->mahasiswa->biodata->no_induk }} --}}
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $row->mahasiswa->biodata->no_induk }}</td>
                                            <td>{{ $row->mahasiswa->biodata->nama }}</td>
                                            <td class="text-capitalize">
                                                @foreach ($dosen as $k)
                                                {{ $k->id == $row->d_pembimbing_1 ?
                                                $k->biodata->nama :''
                                                }}
                                                @endforeach
                                            </td>
                                            <td class="text-capitalize">
                                                @foreach ($dosen as $k)
                                                {{ $k->id == $row->d_pembimbing_2 ?
                                                $k->biodata->nama :''
                                                }}
                                                @endforeach
                                            </td>
                                            <td class="text-capitalize">
                                                {{ $k->ganti_pembimbing }}
                                            </td>
                                            <td>
                                                @foreach ($dosen as $kp)
                                                {{ $kp->id == $k->d_pembimbing_lama ?
                                                $k->biodata->nama :''
                                                }}
                                                @endforeach
                                            </td>
                                            @if ($row->stts_pengajuan=='tertunda')
                                            <td>
                                                <a
                                                    class="btn-warning btn-round p-1 font-weight-bold text-light text-capitalize">
                                                    {{
                                                    $row->stts_pengajuan }}</a>
                                            </td>
                                            @elseif($row->stts_pengajuan=='diterima')
                                            <td>
                                                <a
                                                    class="btn-success btn-round p-1 font-weight-bold text-light text-capitalize">
                                                    {{
                                                    $row->stts_pengajuan }}</a>
                                            </td>
                                            @else
                                            <td>
                                                <a
                                                    class="btn-danger btn-round p-1 font-weight-bold text-light text-capitalize">
                                                    {{
                                                    $row->stts_pengajuan }}</a>
                                            </td>
                                            @endif
                                            <td>{{ $row->stts_kp }}</td>
                                            <td>{{ $row->semester }}</td>
                                            <td><a href="kerja-praktik/view-slip/{{ $row->id }}" data-toggle="modal"
                                                    data-target="#viewSlip{{ $row->id }}"
                                                    class="btn-round btn-success btn-xs"><i class="fa fa-eye">
                                                    </i> </a>


                                            <td>{{ $row->tahunakademik->tahun }}</td>
                                            <td>{{ $row->konsentrasi->nama_konsentrasi }}</td>
                                            <td>
                                                <a href="kerja-praktik/view-slip/{{ $row->id }}" data-toggle="modal"
                                                    data-target="#viewDataBarang{{ $row->id }}"
                                                    class="btn btn-primary btn-xs"><i class="fa fa-eye">
                                                    </i> </a>
                                                <a href="kerja-praktik/edit/{{ $row->id }}" data-toggle="modal"
                                                    data-target="#modalEditKP{{ $row->id }}"
                                                    class="btn btn-warning btn-xs"><i class="fa fa-edit">
                                                    </i> </a>
                                                <a href="kerja-praktik/hapus/{{ $row->id }}" data-toggle="modal"
                                                    data-target="#modalHapusKP{{ $row->id }}"
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
<div class="modal fade" id="modalDaftarKP" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Daftar Kerja Praktik</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form method="POST" enctype="multipart/form-data" action="kerja-praktik">
                @csrf
                <div class="modal-body">

                    <select name="stts_pengajuan" id="" hidden>
                        <option value="tertunda" selected>tertunda</option>
                    </select>
                    <div class="form-group required">
                        <div class="row">
                            <div class="col">
                                <label class="control-label">NIM </label>
                                <select class="form-control" name="mahasiswa_id" onchange="no_biodata()" id="biodata"
                                    required>
                                    <option value="" hidden="">-- Pilih NIM --</option>

                                    @if (Auth::user()->level==0)
                                    <option value="{{ $mhskp->id }}">{{ $mhskp->biodata->no_induk }}
                                    </option>

                                    @else

                                    {{-- PERMASALAHAN solved--}}
                                    @foreach ($mahasiswa as $k)
                                    <option value="{{ $k->id }}">{{ $k->biodata->no_induk
                                        }}</option>
                                    @endforeach

                                    @endif
                                </select>
                            </div>
                            <div class="col">
                                <label>Nama</label>
                                <input type="text" class="form-control" name="nama" id="nama" readonly>
                            </div>
                        </div>
                    </div>

                    <div class="form-group required">
                        <div class="row">
                            <div class="col">
                                <label class="control-label">Pilih Dosen Pembimbing </label>
                                <select class="form-control" name="d_pembimbing_1" required>
                                    <option value="" hidden="">-- Pilihan Ke-1 --</option>
                                    @foreach ($dosen as $k)
                                    <option value="{{ $k->id }}">{{ $k->biodata->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col">
                                <label class="control-label">
                                    Pilihan Ke-2
                                </label>
                                <select class="form-control" name="d_pembimbing_2" required>
                                    <option value="" hidden="">-- Pilihan Ke-2 --</option>
                                    @foreach ($dosen as $k)
                                    <option value="{{ $k->id }}">{{ $k->biodata->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-group required">
                        <div class="row">
                            <div class="col">
                                <label class="control-label">Semester </label>
                                <input type="number" class="form-control" name="semester" placeholder="Semester .."
                                    required>
                            </div>

                            <div class="col">
                                <label class="control-label">Tahun Akademik </label>
                                <select class="form-control" name="thn_akademik_id" required>
                                    <option value="" hidden="">-- Tahun Akademik --</option>
                                    @foreach ($thnakademik as $k)
                                    <option value="{{ $k->id }}">{{ $k->tahun }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-group required">
                        <div class=" row">
                            <div class="col">
                                <label class="control-label">Ganti Dosen Pembimbing </label>
                                <select class="form-control" name="ganti_pembimbing" required>
                                    <option value="" hidden="">-- Ganti --</option>
                                    <option value="iya">Iya</option>
                                    <option value="tidak">Tidak</option>
                                </select>
                            </div>
                            <div class="col">
                                <label>Dosen Pembimbing Lama</label>
                                <select class="form-control" name="pembimbing_lama">
                                    <option value="" hidden="">-- Pembimbing Lama --</option>
                                    @foreach ($dosen as $k)
                                    <option value="{{ $k->id }}">{{ $k->biodata->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-group required">
                        <div class="row">
                            <div class="col">
                                <label>Judul</label>
                                <input type="text" class="form-control" name="judul" placeholder="Judul ..">
                            </div>
                            <div class="col">
                                <label class="control-label">Konsentrasi </label>
                                <select class="form-control" name="konsentrasi_id" required>
                                    <option value="" hidden="">-- Konsentrasi --</option>
                                    @foreach ($konsentrasi as $k)
                                    <option value="{{ $k->id }}">{{ $k->nama_konsentrasi }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-group required">
                        <div class="row">
                            <div class="col">
                                <label class="control-label">Status Kerja Praktik </label>
                                <select class="form-control" name="stts_kp" required>
                                    <option value="" hidden="">-- Status KP --</option>
                                    <option value="baru">Baru</option>
                                    <option value="melanjutkan">Melanjutkan</option>
                                </select>
                            </div>
                            <div class="col">
                                <label for="image" class="form-label control-label">Slip pembayaran </label>
                                <img class="img-preview img-fluid mb-3 col-sm-5" alt="">
                                <input type="file" class="form-control picture" id="slip_pembayaran"
                                    name="slip_pembayaran" onchange="previewImage()">
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        {{-- <div class="form-group required">
                            <label class="control-label">Wajib Diisi</label>
                        </div> --}}
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-undo">
                            </i> Kembali</button>
                        <button type="submit" class="btn btn-primary"><i class="fa fa-save"> </i>
                            Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Edit --}}
@foreach ($daftarkp as $item)
<div class="modal fade" id="modalEditKP{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Edit Data KP</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form method="POST" enctype="multipart/form-data" action="kerja-praktik/{{ $item->id }}">
                @method('put')
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <div class="row">
                            <div class="col">
                                <label>NIM</label>
                                <select class="form-control" name="mahasiswa_id" onchange="no_biodata()"
                                    id="mahasiswa_id" required>
                                    <option value="{{ $item->mahasiswa_id }}">{{
                                        $item->mahasiswa->biodata->no_induk }}
                                    </option>
                                </select>
                            </div>
                            <div class="col">
                                <label>Nama</label>
                                <input type="text" class="form-control" name="nama" id="nama"
                                    value="{{ $item->mahasiswa->biodata->nama }}" readonly>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col">
                                <label>Pilih Dosen Pembimbing 2</label>
                                <select class="form-control" name="d_pembimbing_1" required>
                                    <option value="" hidden="">-- Pilihan Ke-1 --</option>
                                    @foreach ($dosen as $k)
                                    <option value="{{ $k->id }}" {{ $k->id == $item->d_pembimbing_1 ?
                                        'selected' :''
                                        }}>{{ $k->biodata->nama
                                        }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col">
                                <label>Pilihan ke2</label>
                                <select class="form-control" name="d_pembimbing_2" required>
                                    <option value="" hidden="">-- Pilihan Ke-2 --</option>
                                    @foreach ($dosen as $k)
                                    <option value="{{ $k->id }}" {{ $k->id == $item->d_pembimbing_2 ?
                                        'selected' :''
                                        }}>{{ $k->biodata->nama
                                        }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col">
                                <label>Semester</label>
                                <input type="number" class="form-control" name="semester" value="{{ $item->semester }}"
                                    placeholder="Semester .." required>
                            </div>

                            <div class="col">
                                <label>Tahun Akademik</label>
                                {{-- <select class="form-control" name="thn_akademik_id" required>
                                    <option value="" hidden="">-- Tahun Akademik --</option>
                                    @foreach ($thnakademik as $k)
                                    <option value="{{ $k->id }}" {{ $k->id == $item->thn_akademik_id ?
                                        'selected' :''
                                        }}>{{ $k->tahun }}
                                    </option>
                                    @endforeach
                                </select> --}}
                                <input type="text" value="{{ $item->tahunakademik->tahun }}" class="form-control"
                                    readonly>
                                <input type="hidden" value="{{ $item->tahunakademik->id }}" class="form-control"
                                    name="thn_akademik_id">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col">
                                <label>Ganti Dosen Pembimbing</label>
                                <select class="form-control" name="ganti_pembimbing" required>
                                    <option value="" hidden="">-- Ganti --</option>
                                    <option @php if($item->ganti_pembimbing == 'iya') echo 'selected';
                                        @endphp value="iya">IYA</option>
                                    <option @php if($item->ganti_pembimbing == 'tidak') echo 'selected';
                                        @endphp value="tidak">TIDAK</option>
                                </select>
                            </div>
                            <div class="col">
                                <label>Dosen Pembimbing Lama</label>
                                <select class="form-control" name="pembimbing_lama">
                                    <option value="" hidden="">-- Pembimbing Lama --</option>
                                    @foreach ($dosen as $k)
                                    <option value="{{ $k->id }}" {{ $k->id == $item->pembimbing_lama }}>{{
                                        $k->biodata->nama }}</option>
                                    @endforeach
                                </select>
                            </div>

                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col">
                                <label>Status Kerja Praktik</label>
                                <select class="form-control" name="stts_kp" required>
                                    <option value="" hidden="">-- Status KP --</option>
                                    <option @php if($item->stts_kp == 'baru') echo 'selected';
                                        @endphp value="baru">Baru</option>
                                    <option @php if($item->stts_kp == 'melanjutkan') echo 'selected';
                                        @endphp value="melanjutkan">Melanjutkan</option>
                                </select>
                            </div>

                            <div class="col">
                                <label>Status Pengajuan</label>
                                @if (Auth::user()->level==0)
                                <select class="form-control" disabled>
                                    <option value="" hidden="">-- Status Pengajuan --</option>
                                    <option @php if($item->stts_pengajuan == 'tertunda') echo 'selected';
                                        @endphp value="tertunda">Tertunda</option>
                                    <option @php if($item->stts_pengajuan == 'diterima') echo 'selected';
                                        @endphp value="diterima">Diterima</option>
                                    <option @php if($item->stts_pengajuan == 'ditolak') echo 'selected';
                                        @endphp value="ditolak">Ditolak</option>
                                </select>
                                <input type="hidden" name="stts_pengajuan" value="tertunda">
                                @else
                                <select class="form-control" name="stts_pengajuan" required>
                                    <option value="" hidden="">-- Status Pengajuan --</option>
                                    <option @php if($item->stts_pengajuan == 'tertunda') echo 'selected';
                                        @endphp value="tertunda">Tertunda</option>
                                    <option @php if($item->stts_pengajuan == 'diterima') echo 'selected';
                                        @endphp value="diterima">Diterima</option>
                                    <option @php if($item->stts_pengajuan == 'ditolak') echo 'selected';
                                        @endphp value="ditolak">Ditolak</option>
                                </select>
                                @endif

                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col">
                                <label>Judul</label>
                                <input type="text" id="judul" class="form-control" name="judul" placeholder="Judul ..">
                                <trix-editor input="judul"></trix-editor>
                            </div>
                            <div class="col">
                                <label>Konsentrasi</label>
                                <select class="form-control" name="konsentrasi_id" required>
                                    <option value="" hidden="">-- Konsentrasi --</option>
                                    @foreach ($konsentrasi as $k)
                                    <option value="{{ $k->id }}" {{ $k->id == $item->konsentrasi_id ?
                                        'selected' : ''
                                        }}>{{ $k->nama_konsentrasi }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-6">
                                <label for="image" class="form-label">Slip pembayaran</label>
                                <input type="hidden" name="oldImage" value="{{ $item->slip_pembayaran }}">


                                @if ($item->slip_pembayaran)
                                <img src="{{ asset('storage/' . $item->slip_pembayaran) }}"
                                    class="img-preview img-fluid mb-2 col-sm-2 d-block">
                                @endif

                                <img class="img-preview img-fluid mb-3 col-sm-5" alt="">
                                <input type="file" class="form-control picture" id="slip_pembayaran"
                                    name="slip_pembayaran" onchange="previewImage()">
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-undo">
                            </i> Kembali</button>
                        <button type="submit" class="btn btn-primary"><i class="fa fa-save"> </i>
                            Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach

{{-- view Slip Pembayaran --}}
@foreach ($daftarkp as $item)
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
@foreach ($daftarkp as $kp)
<div class="modal fade" id="modalHapusKP{{ $kp->id }}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-open">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="exampleModalLongTitle">Hapus Data KP</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form method="POST" enctype="multipart/form-data" action="/kerja-praktik/{{ $kp->id }}">
                @method('delete')
                @csrf
                <div class="modal-body">

                    <input type="hidden" value="{{ $kp->id }}" name="id" required>

                    <div class=" form-group">
                        <h3>Apakah anda ingin menghapus data ini ?</h>
                            <p class="text-danger">Dengan Nama {{ $kp->nama }} dan No Induk {{ $kp->no_induk
                                }}</p>
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
    function no_biodata() {
        let biodata = $("#biodata").val();
        $("#nama").children().remove();
        if (biodata != '' && biodata != null) {
            $.ajax({

                url: "{{ url('') }}/kerja-praktik/biodata/" + biodata,
                success: function (res) {
                    $("#nama").val(res.nama);
                }
            });
        }
    }
</script>
@endsection