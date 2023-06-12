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

    .kolomBaru {
        display: none;
    }
</style>

<div class="main-panel">
    <div class="content">
        <div class="page-inner">
            <div class="page-header">
                @if (Auth::user()->level ==0)
                <h4 class="page-title">Tugas Akhir [Mahasiswa]</h4>
                @else
                <h4 class="page-title">Tugas Akhir</h4>
                @endif
            </div>
            @if (empty($pwngumuman))
            @else
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="d-flex align-items-center">
                            <p><i> {{ $pengumuman->cttn_daftar_ta }}</i> </p>
                        </div>
                    </div>
                </div>
            </div>
            @endif
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        @if (empty($formakses))
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <h4 class="card-title"></h4>
                                <a href="/tugas-akhir/daftar" class="btn btn-primary btn-round ml-auto"
                                    data-toggle="modal" data-target="#modalDaftarTA">
                                    <i class="fa fa-plus"></i>
                                    Daftar
                                </a>
                            </div>
                        </div>
                        @elseif(Auth::user()->level == 0 && $formakses->akses_ta == 1 ||
                        Auth::user()->level==1 )
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <h4 class="card-title"></h4>
                                <a href="/tugas-akhir/daftar" class="btn btn-primary btn-round ml-auto"
                                    data-toggle="modal" data-target="#modalDaftarTA">
                                    <i class="fa fa-plus"></i>
                                    Daftar
                                </a>
                            </div>
                        </div>
                        @elseif(Auth::user()->level == 0 && $formakses->akses_ta == 0)
                        <div class="card-header ">
                            <div class="d-flex align-items-center">
                                <a href="#" class="btn btn-danger ml-auto">
                                    <h4 class="card-title text-light">Pendaftaran Tugas Akhir Sudah Ditutup</h4>
                                </a>

                            </div>
                        </div>
                        @endif

                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-6 col-md-3">
                                    <div class="row align-items-center">
                                        <div class="col col-stats ml-3 ml-sm-0">
                                            <div class="filter tahun">
                                                <label class="font-weight-bold h6">Filter Tahun</label>
                                                <select data-column="11" class="form-control" id="filter-tahun">
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
                                                <select data-column="8" class="form-control" id="filter-stts">
                                                    <option value="">-- Pilih Status --</option>
                                                    @foreach ($filterStts as $item)
                                                    <option value="{{ $item->stts_pengajuan }}" class="text-capitalize">
                                                        {{
                                                        $item->stts_pengajuan }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-6 col-md-3">
                                    <div class="row align-items-center">
                                        <div class="col col-stats ml-3 ml-sm-0">
                                            <p class="font-weight-bold h6">Status Pengajuan</p>
                                            <p class="font-weight-bold badge badge-success mr-1">
                                                Diterima
                                                : {{
                                                $d_diterima->count()}}
                                            </p>
                                            <p class="font-weight-bold badge badge-warning mr-1">
                                                Tertunda :
                                                {{
                                                $d_tertunda }}
                                            </p>
                                            <p class="font-weight-bold badge badge-danger">
                                                Ditolak
                                                :
                                                {{
                                                $d_ditolak
                                                }}</p>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            {{-- <div class="row" style="">
                                <div class="col-2">
                                    <div class="body-panel mb-2">
                                        <label class="font-weight-bold h6">Filter Tahun</label>
                                        <select data-column="11" class="form-control" id="filter-tahun">
                                            <option value="">-- Pilih Tahun --</option>
                                            @foreach ($thnakademik as $k)
                                            <option value="{{ $k->tahun }}">{{ $k->tahun }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="body-panel">
                                        <label class="font-weight-bold h6">Filter Status</label>
                                        <select data-column="7" class="form-control" id="filter-stts">
                                            <option value="">-- Pilih Status --</option>
                                            @foreach ($filterStts as $item)
                                            <option value="{{ $item->stts_pengajuan }}" class="text-capitalize">{{
                                                $item->stts_pengajuan }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="body-panel">
                                        <label class="font-weight-bold p-1 mb-1">Status
                                            Kerja Praktik </label>
                                    </div>
                                    <div class="body-panel col-6 btn-success mb-2">
                                        <label class="font-weight-bold text-light p-1">Diterima : {{ $kpDiterima}}
                                        </label>
                                    </div>
                                    <div class="body-panel col-6 btn-warning mb-2">
                                        <label class="font-weight-bold text-light p-1">Tertunda : {{ $kpTertunda }}
                                        </label>
                                    </div>
                                    <div class="body-panel col-6 btn-danger mb-2">
                                        <label class="font-weight-bold text-light p-1">Ditolak &nbsp;&nbsp;&nbsp;&nbsp;:
                                            {{
                                            $kpDitolak
                                            }}</label>
                                    </div>
                                </div>
                            </div> --}}
                            <div class="divider"></div>
                            <div class="table-responsive">
                                <table id="kerja-praktik" class="display table table-striped table-hover">
                                    <thead>
                                        <tr align="center">
                                            <th>No</th>
                                            <th>NIM</th>
                                            <th>Nama</th>
                                            <th>Dosen Pilihan 1</th>
                                            <th>Dosen Pilihan 2</th>
                                            <th>Ganti Dosen Pembimbing</th>
                                            <th>Dosen Pembimbing Lama 1</th>
                                            <th>Dosen Pembimbing Lama 2</th>
                                            <th>Status Pengajuan</th>
                                            <th>Status TA</th>
                                            <th>KRS</th>
                                            <th>Tahun</th>
                                            <th>Konsentrasi</th>
                                            <th>Tanggal Daftar</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>

                                    @if (Auth::user()->level==0)
                                    <tbody>
                                        @php $no=1; @endphp
                                        @if (!empty(Auth::user()->biodata->mahasiswa->daftarta))
                                        @foreach ($mhsta as $item)
                                        <tr align="center">
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
                                                @foreach ($dosen as $kp)
                                                {{ $kp->id == $item->pembimbing_lama_1 ?
                                                $kp->biodata->nama :''
                                                }}
                                                @endforeach
                                            </td>
                                            <td>
                                                @foreach ($dosen as $kp)
                                                {{ $kp->id == $item->pembimbing_lama_2 ?
                                                $kp->biodata->nama :''
                                                }}
                                                @endforeach
                                            </td>

                                            @if ($item->stts_pengajuan=='tertunda')
                                            <td>
                                                <a
                                                    class="font-weight-bold badge badge-warning text-light text-capitalize">
                                                    {{
                                                    $item->stts_pengajuan }}</a>
                                            </td>
                                            @elseif($item->stts_pengajuan=='diterima')
                                            <td>
                                                <a
                                                    class="font-weight-bold badge badge-success text-light text-capitalize">
                                                    {{
                                                    $item->stts_pengajuan }}</a>
                                            </td>
                                            @else
                                            <td>
                                                <a
                                                    class="font-weight-bold badge badge-danger text-light text-capitalize">
                                                    {{
                                                    $item->stts_pengajuan }}</a>
                                            </td>
                                            @endif

                                            <td>{{ $item->stts_ta }}</td>
                                            <td><a href="daftar-ta/view-krs/{{ $item->id }}" data-toggle="modal"
                                                    data-target="#viewKRS{{ $item->id }}"
                                                    class="btn btn-primary btn-xs"><i class="fa fa-file-image">
                                                    </i> </a>

                                            <td>{{ $item->tahunakademik->tahun }} </td>
                                            <td>{{ $item->konsentrasi }}</td>
                                            <td>{{ $item->created_at }}</td>
                                            <td>
                                                @if ($item->stts_pengajuan == 'diterima')

                                                @else
                                                <a href="daftar-ta/edit/{{ $item->id }}" data-toggle="modal"
                                                    data-target="#modalEditTA{{ $item->id }}"
                                                    class="btn btn-warning btn-xs"><i class="fa fa-edit">
                                                    </i>
                                                </a>
                                                <a href="daftar-ta/hapus/{{ $item->id }}" data-toggle="modal"
                                                    data-target="#modalHapusTA{{ $item->id }}"
                                                    class="btn btn-danger btn-xs"><i class="fa fa-trash">
                                                    </i>
                                                </a>
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

                                    @elseif(Auth::user()->level!=0)
                                    <tbody> @php $no=1; @endphp
                                        @foreach ($daftarta as $row)
                                        <tr align="center">
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $row->mahasiswa->biodata->no_induk }}</td>
                                            <td class="text-capitalize">{{ $row->mahasiswa->biodata->nama }}</td>
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
                                                {{ $row->ganti_pembimbing }}
                                            </td>
                                            <td>
                                                @foreach ($dosen as $kp)
                                                {{ $kp->id == $row->pembimbing_lama_1 ?
                                                $kp->biodata->nama :''
                                                }}
                                                @endforeach
                                            </td>
                                            <td>
                                                @foreach ($dosen as $kp)
                                                {{ $kp->id == $row->pembimbing_lama_2 ?
                                                $kp->biodata->nama :''
                                                }}
                                                @endforeach
                                            </td>
                                            @if ($row->stts_pengajuan=='tertunda')
                                            <td>
                                                <a
                                                    class="font-weight-bold badge badge-warning text-light text-capitalize">
                                                    {{
                                                    $row->stts_pengajuan }}</a>
                                            </td>
                                            @elseif($row->stts_pengajuan=='diterima')
                                            <td>
                                                <a
                                                    class="font-weight-bold badge badge-success text-light text-capitalize">
                                                    {{
                                                    $row->stts_pengajuan }}</a>
                                            </td>
                                            @else
                                            <td>
                                                <a
                                                    class="font-weight-bold badge badge-danger text-light text-capitalize">
                                                    {{
                                                    $row->stts_pengajuan }}</a>
                                            </td>
                                            @endif
                                            <td class="text-capitalize">{{ $row->stts_ta }}</td>
                                            {{-- <td>{{ $row->krs }}</td> --}}
                                            <td><a href="daftar-ta/view-krs/{{ $row->id }}" data-toggle="modal"
                                                    data-target="#viewKRS{{ $row->id }}"
                                                    class="btn btn-success btn-xs"><i class="fa fa-file-image">
                                                    </i> </a>

                                            <td>{{ $row->tahunakademik->tahun }}</td>
                                            <td>{{ $row->konsentrasi }}</td>
                                            <td>{{ $row->created_at }}</td>
                                            <td>
                                                {{-- <a href="kerja-praktik/view-slip/{{ $row->id }}"
                                                    data-toggle="modal" data-target="#viewDataBarang{{ $row->id }}"
                                                    class="btn btn-primary btn-xs"><i class="fa fa-eye">
                                                    </i> </a> --}}
                                                <a href="daftar-ta/edit/{{ $row->id }}" data-toggle="modal"
                                                    data-target="#modalEditTA{{ $row->id }}"
                                                    class="btn btn-warning btn-xs"><i class="fa fa-edit">
                                                    </i>
                                                </a>
                                                <a href="daftar-ta/hapus/{{ $row->id }}" data-toggle="modal"
                                                    data-target="#modalHapusTA{{ $row->id }}"
                                                    class="btn btn-danger btn-xs"><i class="fa fa-trash">
                                                    </i>
                                                </a>
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
<div class="modal fade" id="modalDaftarTA" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Daftar Tugas Akhir</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form method="POST" enctype="multipart/form-data" action="daftar-ta" id="tambah">
                @csrf
                <div class="modal-body">

                    <select name="stts_pengajuan" id="" hidden>
                        <option value="tertunda" selected>tertunda</option>
                    </select>
                    <div class="form-group required">
                        <div class="row">
                            <div class="col">
                                <label class="control-label">NIM - Nama </label>
                                <select class="form-control" name="mahasiswa_id" onchange="no_biodata()" size="1"
                                    required>
                                    <option value="" hidden="">-- Pilih NIM --</option>

                                    @if (Auth::user()->level==0 )
                                    @foreach ($mhsDaftar as $item)

                                    <option value="{{ $item->daftarkp->mahasiswa_id }}">{{
                                        $item->daftarkp->mahasiswa->biodata->no_induk }}
                                        - {{
                                        $item->daftarkp->mahasiswa->biodata->nama }}
                                    </option>
                                    @endforeach

                                    @else
                                    @foreach ($mhs_dDaftar as $item)
                                    <option value="{{ $item->daftarkp->mahasiswa_id}}">{{
                                        $item->daftarkp->mahasiswa->biodata->no_induk
                                        }} - {{ $item->daftarkp->mahasiswa->biodata->nama}}
                                    </option>
                                    @endforeach

                                    @endif
                                </select>

                            </div>
                            <div class="col">
                                <label class="control-label">Tahun Akademik </label>
                                <select class="form-control" name="thn_akademik_id" size="1" required>
                                    <option value="" hidden="">-- Tahun Akademik --</option>
                                    @foreach ($thnakademik as $k)
                                    <option value="{{ $k->id }}">{{ $k->tahun }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-group required">
                        <div class="row">
                            <div class="col">
                                <label class="control-label">Pilih Dosen Pembimbing 1</label>
                                <select class="form-control" name="d_pembimbing_1" size="1" required>
                                    <option value="" hidden="">-- Pilihan Ke-1 --</option>
                                    @foreach ($dosen as $k)
                                    <option value="{{ $k->id }}">{{ $k->biodata->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col">
                                <label class="control-label">
                                    Pilih Dosen Pembimbing 2
                                </label>
                                <select class="form-control" name="d_pembimbing_2" size="1" required>
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
                                <label class="control-label">Status Tugas Akhir </label>
                                <select class="form-control" name="stts_ta" size="1" required>
                                    <option value="" hidden="">-- Status Tugas Akhir --</option>
                                    <option value="baru">Baru</option>
                                    <option value="melanjutkan">Melanjutkan</option>
                                </select>
                            </div>
                            <div class="col">
                                <label class="control-label">Ganti Dosen Pembimbing </label>
                                <select class="form-control" id="d_ganti" name="ganti_pembimbing" size="1" required>
                                    <option value="" hidden="">-- Ganti --</option>
                                    <option value="ya">Ya</option>
                                    <option value="tidak">Tidak</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-group required" id="kolomBaru" style="display:none">
                        <div class="row">
                            <div class="col">
                                <label>Dosen Pembimbing Lama 1</label>
                                <select class="form-control" name="pembimbing_lama_1" size="1">
                                    <option value="" hidden="">-- Pembimbing Lama 1--</option>
                                    @foreach ($dosen as $k)
                                    <option value="{{ $k->id }}">{{ $k->biodata->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col">
                                <label>Dosen Pembimbing Lama 2</label>
                                <select class="form-control" name="pembimbing_lama_2" size="1">
                                    <option value="" hidden="">-- Pembimbing Lama 2--</option>
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
                                <div class="mb-3">
                                    <label>Judul</label>
                                    <input type="text" class="form-control" name="judul" placeholder="Judul .."
                                        size="1">
                                </div>
                                <label for="image" class="form-label control-label">KRS (Tertera Mata Kuliah Skripsi)
                                </label>
                                <input type="file" class="form-control picture" id="krs" name="krs"
                                    onchange="previewImage()">
                                <img class="img-preview img-fluid mb-3 col-sm-4 mt-2">
                                <span class="font-italic text-muted mr-5">ukuran file maksimal <span
                                        class="text-danger">1024
                                        KB</span></span>
                            </div>
                            <div class="col">
                                <label class="control-label">Konsentrasi </label>
                                <select class="form-control" name="konsentrasi[]" id="konsentrasi" required multiple>
                                    <option value="" hidden="">-- Konsentrasi --</option>
                                    @foreach ($konsentrasi as $item)
                                    <option value="{{ $item->nama_konsentrasi }}">{{ $item->nama_konsentrasi }}</option>
                                    @endforeach
                                </select>
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
                        <button type="submit" class="btn btn-primary"><i class="fa fa-save"> </i>
                            Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Edit --}}
@foreach ($daftarta as $item)
<div class="modal fade modalEditTA" id="modalEditTA{{ $item->id }}" tabindex="-1" role="dialog"
    aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Edit Data KP</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form method="POST" enctype="multipart/form-data" action="daftar-ta/{{ $item->id }}" id="edit">
                @method('put')
                @csrf
                <div class="modal-body">
                    <div class="form-group required">
                        <div class="row">
                            <div class="col">
                                <label class="control-label">NIM - Nama</label>
                                <select class="form-control" name="mahasiswa_id" id="mahasiswa_id" size="1" required>
                                    <option value="{{ $item->mahasiswa_id }}">{{
                                        $item->mahasiswa->biodata->no_induk }} - {{ $item->mahasiswa->biodata->nama }}
                                    </option>
                                </select>
                            </div>
                            <div class="col">
                                <label class="control-label">Tahun Akademik </label>
                                <input type="text" value="{{ $item->tahunakademik->tahun }}" class="form-control"
                                    size="1" readonly>
                                <input type="hidden" value="{{ $item->tahunakademik->id }}" class="form-control"
                                    name="thn_akademik_id">
                            </div>
                        </div>
                    </div>

                    <div class="form-group required">
                        <div class="row">
                            <div class="col">
                                <label class="control-label">Pilih Dosen Pembimbing 1 </label>
                                <select class="form-control" name="d_pembimbing_1" size="1" required>
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
                                <label class="control-label">Pilihan Dosen Pembimbing 2 </label>
                                <select class="form-control" name="d_pembimbing_2" size="1" required>
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

                    <div class="form-group required">
                        <div class="row">
                            <div class="col">
                                <label class="control-label">Status Tugas Akhir </label>
                                <select class="form-control" name="stts_ta" required>
                                    <option value="" hidden="">-- Status TA --</option>
                                    <option @php if($item->stts_ta == 'baru') echo 'selected';
                                        @endphp value="baru">Baru</option>
                                    <option @php if($item->stts_ta == 'melanjutkan') echo 'selected';
                                        @endphp value="melanjutkan">Melanjutkan</option>
                                </select>
                            </div>
                            <div class="col">
                                <label class="control-label">Ganti Dosen Pembimbing </label>
                                <select class="form-control" name="ganti_pembimbing" id="d_ganti_1" size="1" required>
                                    <option value="" hidden="">-- Ganti --</option>
                                    <option @php if($item->ganti_pembimbing == 'iya') echo 'selected';
                                        @endphp value="ya">Ya</option>
                                    <option @php if($item->ganti_pembimbing == 'tidak') echo 'selected';
                                        @endphp value="tidak">Tidak</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-group required" id="kolomBaru_1" style="display: none">
                        <div class="row">
                            <div class="col">
                                <label>Dosen Pembimbing Lama 1</label>
                                <select class="form-control" name="pembimbing_lama_1">
                                    <option value="" hidden="">-- Pembimbing Lama --</option>
                                    @foreach ($dosen as $k)
                                    <option value="{{ $k->id }}" {{ $k->id == $item->pembimbing_lama_1 ?
                                        'selected':''}}>{{
                                        $k->biodata->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col">
                                <label>Dosen Pembimbing Lama 2</label>
                                <select class="form-control" name="pembimbing_lama_2">
                                    <option value="" hidden="">-- Pembimbing Lama --</option>
                                    @foreach ($dosen as $k)
                                    <option value="{{ $k->id }}" {{ $k->id == $item->pembimbing_lama_2 ? 'selected'
                                        :''}}>{{
                                        $k->biodata->nama }}</option>
                                    @endforeach
                                </select>
                            </div>

                        </div>
                    </div>

                    <div class="form-group required">
                        <div class="row">
                            <div class="col">
                                <label>Judul</label>
                                <input type="text" id="judul" class="form-control" name="judul" placeholder="Judul .."
                                    value="{{ $item->judul }}">
                            </div>
                            <div class="col">
                                <label class="control-label">Status Pengajuan </label>
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

                    <div class="form-group required">
                        <div class="row">
                            <div class="col">
                                <label class="control-label">Konsentrasi </label>
                                <select class="form-control konsentrasi_" name="konsentrasi[]"
                                    id="konsentrasi_{{ $item->id }}" multiple required>
                                    <option value="" hidden="">-- Konsentrasi --</option>

                                    @foreach($konsentrasi as $option)
                                    <option value="{{ $option->nama_konsentrasi }}" {{ in_array($option->
                                        nama_konsentrasi,
                                        explode(',',
                                        $item->konsentrasi)) ? 'selected' : '' }}>
                                        {{ $option->nama_konsentrasi }}
                                    </option>
                                    @endforeach

                                </select>
                            </div>
                            <div class="col">
                                <label for="image" class="form-label ">KRS (Tertera Mata Kuliah Skripsi) </label>
                                <input type="hidden" name="oldImage" value="{{ $item->krs }}">
                                <input type="file" class="form-control picture" id="krs" name="krs"
                                    onchange="Previews()">

                                @if ($item->krs)
                                <img src="{{ asset('storage/' . $item->krs) }}"
                                    class="img-preview img-fluid mb-3 col-sm-4 mt-1" id="img-p">
                                @else
                                <img class="img-preview img-fluid mb-3 col-sm-5" alt="" id="img-p">
                                @endif

                                <p class="mt-1 font-italic">biarkan kolom kosong
                                    jika tidak diganti | ukuran file maksimal <span class="text-danger">1024 KB</span>
                                </p>
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
                        <button type="submit" class="btn btn-primary"><i class="fa fa-save"> </i>
                            Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach

{{-- view KRS --}}
@foreach ($daftarta as $item)
<div class="modal fade" id="viewKRS{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-capitalize" id="exampleModalLongTitle">Kartu Rencana Studi - {{
                    $item->mahasiswa->biodata->nama
                    }} | {{ $item->mahasiswa->biodata->no_induk }} </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <div class="form-group">
                    <div class="row">
                        @if ($item->krs)
                        <div class="col">
                            <img src="{{ asset('storage/' . $item->krs) }}" alt="" class="rounded mx-auto d-block"
                                style="width: 30%">
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

{{-- Hapus --}}
@foreach ($daftarta as $item)
<div class="modal fade" id="modalHapusTA{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-open">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="exampleModalLongTitle">Hapus Data TA</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form method="POST" enctype="multipart/form-data" action="/daftar-ta/{{ $item->id }}">
                @method('delete')
                @csrf
                <div class="modal-body">

                    <input type="hidden" value="{{ $item->id }}" name="id" required>

                    <div class=" form-group">
                        <h3>Apakah anda yakin menghapus data
                            dari <span class="text-danger text-capitalize">{{ $item->mahasiswa->biodata->nama }}</span>
                            dengan
                            NIM
                            <span class="text-danger">{{
                                $item->mahasiswa->biodata->no_induk
                                }} </span> ?
                        </h3>
                        <h4 class="btn btn-warning text-uppercase ">Data Terkait NIM tersebut juga akan terhapus!</h4>
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
        $('#konsentrasi').select2({
            placeholder: '-- Pilih Konsentrasi --',
            width: '100%'
        });
    });

    $(document).ready(function() {
        $('.konsentrasi_').select2({
            width: '100%'
        });
    });
</script>

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

<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

</script>
<script>
    function previewImage() {
        const image = document.querySelector('#krs');
        const imgPriview = document.querySelector('.img-preview');

        imgPriview.style.display = 'block';

        const oFReader = new FileReader();
        oFReader.readAsDataURL(image.files[0]);

        oFReader.onload = function (oFREvent) {
            imgPriview.src = oFREvent.target.result;
        }
    }

    $(document).ready(function () {
    var table = $("#kerja-praktik").DataTable({});
        $("#filter-tahun").change(function () {
        table.column($(this).data("column")).search($(this).val()).draw();
    });
        $("#filter-stts").change(function () {
        table.column($(this).data("column")).search($(this).val()).draw();
    });
    });

</script>
<script>
    function Previews() {
        const slip = document.querySelector('#slip_pembayarans');
        const slipimgPriview = document.querySelector('.img-previews');

        slipimgPriview.style.display = 'block';

        const oFReader = new FileReader();
        oFReader.readAsDataURL(slip.files[0]);

        oFReader.onload = function (oFREvent) {
            slipimgPriview.src = oFREvent.target.result;
        }
    }

    // Tambah
    $(document).ready(function() {
        toggleKolomBaru('#tambah');
    $('#d_ganti').on('change', function() {
        toggleKolomBaru('#tambah');
    });
    
    function toggleKolomBaru(formId) {
            if ($(formId + ' select[name="ganti_pembimbing"]').val() === 'ya') {
                $(formId + ' #kolomBaru').show();
            } else {
                $(formId + ' #kolomBaru').hide();
            }
        }
    });

</script>

{{-- Edit --}}
<script>
    $(document).ready(function() {
        $('.modalEditTA').on('show.bs.modal', function() {
            var formId = '#' + $(this).attr('id');
            toggleKolomBaru_1(formId);
        
        $(formId + ' #d_ganti_1').on('change', function() {
            toggleKolomBaru_1(formId);
        });
        
        function toggleKolomBaru_1(formId) {
                if ($(formId + ' select[name="ganti_pembimbing"]').val() === 'ya') {
                    $(formId + ' #kolomBaru_1').show();
                } else {
                    $(formId + ' #kolomBaru_1').hide();
                }
            }
        });
    });
</script>
@endsection