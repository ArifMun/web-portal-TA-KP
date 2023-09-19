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

            <div class="row">
                <div class="col-md-12">
                    <div class="card">

                        @if (empty($formakses))
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <div class="">Readme First
                                    <a href="tugas-akhir/view-pengumuman" data-toggle="modal"
                                        data-target="#viewPengumuman"><i class="fa fa-eye ml-2">
                                        </i>
                                    </a>
                                </div>

                                @if ($existTA)
                                <a href="/tugas-akhir/melanjutkan" class="btn btn-success btn-round ml-auto"
                                    data-toggle="modal" data-target="#modalMelanjutkan">
                                    <i class="fa fa-plus"></i>
                                    Melanjutkan
                                </a>
                                @elseif($newRegisterTA|| UserCheck::levelAdmin())
                                <a href="/tugas-akhir/daftar" class="btn btn-primary btn-round ml-auto"
                                    data-toggle="modal" data-target="#modalDaftarTA">
                                    <i class="fa fa-plus"></i>
                                    Daftar
                                </a>
                                @endif
                            </div>
                        </div>

                        @elseif(Auth::user()->level == 0 && $formakses->akses_ta == 1 ||
                        UserCheck::levelAdmin() )
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <div class="">Readme First
                                    <a href="tugas-akhir/view-pengumuman" data-toggle="modal"
                                        data-target="#viewPengumuman"><i class="fa fa-eye ml-2">
                                        </i>
                                    </a>
                                </div>

                                @if ($existTA)
                                <a href="/tugas-akhir/melanjutkan" class="btn btn-success btn-round ml-auto"
                                    data-toggle="modal" data-target="#modalMelanjutkan">
                                    <i class="fa fa-plus"></i>
                                    Melanjutkan
                                </a>
                                @elseif($newRegisterTA|| UserCheck::levelAdmin())
                                <a href="/tugas-akhir/daftar" class="btn btn-primary btn-round ml-auto"
                                    data-toggle="modal" data-target="#modalDaftarTA">
                                    <i class="fa fa-plus"></i>
                                    Daftar
                                </a>
                                @endif
                            </div>
                        </div>
                        @elseif(Auth::user()->level == 0 && $formakses->akses_ta == 0)
                        <div class="card-header ">
                            <div class="d-flex align-items-center">
                                <a class="badge badge-danger ml-auto">
                                    <h4 class="card-title text-light">Pendaftaran Tugas Akhir Sudah Ditutup</h4>
                                </a>

                            </div>
                        </div>
                        @endif

                        <div class="card-body">
                            @if (UserCheck::levelAdmin())
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
                                                <label class="font-weight-bold h6">Filter Status Pengajuan</label>
                                                <select data-column="8" class="form-control text-capitalize"
                                                    id="filter-stts">
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
                                                $d_tertunda->count() }}
                                            </p>
                                            <p class="font-weight-bold badge badge-danger">
                                                Ditolak
                                                :
                                                {{
                                                $d_ditolak->count()
                                                }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="divider"></div>
                            @else
                            @endif
                            <div class="table-responsive">
                                <table id="kerja-praktik" class="display table table-striped table-hover">
                                    <thead>
                                        <tr align="center">
                                            <th>No</th>
                                            @if (Auth::user()->level !=0)
                                            <th>NIM</th>
                                            <th>Nama</th>

                                            @endif
                                            <th>Dosen Pilihan 1</th>
                                            <th>Dosen Pilihan 2</th>
                                            <th>Ganti Dosen Pembimbing</th>
                                            <th>Dosen Pembimbing Lama 1</th>
                                            <th>Dosen Pembimbing Lama 2</th>
                                            <th>Status Pengajuan</th>
                                            <th>Status TA</th>
                                            <th>Judul</th>
                                            <th>Tahun Akademik</th>
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
                                        <tr align="center" class="text-capitalize">
                                            <td>{{ $no++ }}</td>
                                            {{-- <td>{{ $item->mahasiswa->biodata->no_induk}}</td>
                                            <td>{{ $item->mahasiswa->biodata->nama }}</td> --}}
                                            <td>
                                                @foreach ($dosen as $k)
                                                {{ $k->id == $item->d_pembimbing_1 ?
                                                $k->biodata->nama :''
                                                }}
                                                @endforeach
                                            </td>
                                            <td>
                                                @foreach ($dosen as $k)
                                                {{ $k->id == $item->d_pembimbing_2 ?
                                                $k->biodata->nama :''
                                                }}
                                                @endforeach
                                            </td>
                                            <td>
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
                                                <a class="font-weight-bold badge badge-warning text-light">
                                                    {{
                                                    $item->stts_pengajuan }}</a>
                                            </td>
                                            @elseif($item->stts_pengajuan=='diterima')
                                            <td>
                                                <a class="font-weight-bold badge badge-success text-light">
                                                    {{
                                                    $item->stts_pengajuan }}</a>
                                            </td>
                                            @else
                                            <td>
                                                <a class="font-weight-bold badge badge-danger text-light">
                                                    {{
                                                    $item->stts_pengajuan }}</a>
                                            </td>
                                            @endif

                                            <td>{{ $item->stts_ta }}</td>
                                            <td>
                                                <a href="daftar-ta/view-judul/{{ $item->id }}" data-toggle="modal"
                                                    data-target="#viewJudul{{ $item->id }}"
                                                    class="btn btn-primary btn-xs"><i class="fa fa-eye">
                                                    </i>
                                                </a>
                                            </td>
                                            <td>{{ $item->tahunakademik->tahun }} </td>
                                            <td>{{ $item->konsentrasi }}</td>
                                            <td>{{ $item->created_at->locale('id')->translatedformat('l,dFY, H:i') }}
                                            </td>
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

                                    @elseif(Auth::user()->level==2)
                                    <tbody> @php $no=1; @endphp
                                        @foreach ($daftarta as $row)
                                        <tr align="center" class="text-capitalize">
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $row->mahasiswa->biodata->no_induk }}</td>
                                            <td>{{ $row->mahasiswa->biodata->nama }}</td>
                                            <td>
                                                @foreach ($dosen as $k)
                                                {{ $k->id == $row->d_pembimbing_1 ?
                                                $k->biodata->nama :''
                                                }}
                                                @endforeach
                                            </td>
                                            <td>
                                                @foreach ($dosen as $k)
                                                {{ $k->id == $row->d_pembimbing_2 ?
                                                $k->biodata->nama :''
                                                }}
                                                @endforeach
                                            </td>
                                            <td>
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
                                                <a href="update-status-ta/{{ $row->id }}" data-toggle="modal"
                                                    data-target="#modalUpdateStatus{{ $row->id }}"
                                                    class="font-weight-bold badge badge-warning text-light text-capitalize">
                                                    {{
                                                    $row->stts_pengajuan }}</a>
                                            </td>
                                            @elseif($row->stts_pengajuan=='diterima')
                                            <td>
                                                <a href="update-status-ta/{{ $row->id }}" data-toggle="modal"
                                                    data-target="#modalUpdateStatus{{ $row->id }}"
                                                    class="font-weight-bold badge badge-success text-light text-capitalize">
                                                    {{
                                                    $row->stts_pengajuan }}</a>
                                            </td>
                                            @else
                                            <td>
                                                <a href="update-status-ta/{{ $row->id }}" data-toggle="modal"
                                                    data-target="#modalUpdateStatus{{ $row->id }}"
                                                    class="font-weight-bold badge badge-danger text-light text-capitalize">
                                                    {{
                                                    $row->stts_pengajuan }}</a>
                                            </td>
                                            @endif
                                            <td>{{ $row->stts_ta }}</td>
                                            <td>
                                                <a href="daftar-ta/view-judul/{{ $row->id }}" data-toggle="modal"
                                                    data-target="#viewJudul{{ $row->id }}"
                                                    class="btn btn-primary btn-xs"><i class="fa fa-eye">
                                                    </i>
                                                </a>
                                            </td>
                                            <td>{{ $row->tahunakademik->tahun }}</td>
                                            <td>{{ $row->konsentrasi }}</td>
                                            <td>{{ $row->created_at->locale('id')->translatedformat('l,dFY, H:i') }}
                                            </td>
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

            <form method="POST" enctype="multipart/form-data" action="daftar-ta" id="tambah">
                @csrf
                <div class="modal-body">

                    <select name="stts_pengajuan" id="" hidden>
                        <option value="tertunda" selected>tertunda</option>
                    </select>
                    <div class="form-group required">
                        <div class="row">
                            <div class="col ">
                                <label class="control-label">NIM - Nama </label>
                                @if (Auth::user()->level==0 )
                                <input type="text" class="form-control text-capitalize" value="{{ $mhsAuth->biodata->no_induk }} - {{
                                    $mhsAuth->biodata->nama }}" readonly>
                                <input type="hidden" name="mahasiswa_id" value="{{ $mhsAuth->id}}">
                                @else
                                <select class="form-control text-capitalize" name="mahasiswa_id" onchange="no_biodata()"
                                    size="1" required>
                                    <option value="">-- Pilih Mahasiswa--</option>
                                    @foreach ($mhs_dDaftar as $item)

                                    @if (old('mahasiswa_id')== $item->daftarkp->mahasiswa->id)
                                    <option value="{{ $item->daftarkp->mahasiswa_id}}" selected>{{
                                        $item->daftarkp->mahasiswa->biodata->no_induk
                                        }} - {{ $item->daftarkp->mahasiswa->biodata->nama}}
                                    </option>
                                    @else
                                    <option value="{{ $item->daftarkp->mahasiswa_id}}">{{
                                        $item->daftarkp->mahasiswa->biodata->no_induk
                                        }} - {{ $item->daftarkp->mahasiswa->biodata->nama}}
                                    </option>
                                    @endif
                                    @endforeach

                                </select>
                                @endif

                            </div>
                            <div class="col">
                                <label class="control-label">Tahun Akademik </label>
                                <input type="text" class="form-control" value="{{ $last_year->tahun }}" readonly>
                                <input type="hidden" class="form-control" value="{{ $last_year->id }}"
                                    name="thn_akademik_id">
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

                                    @if (old('d_pembimbing_1')== $k->id)
                                    <option value="{{ $k->id }}" selected>{{ $k->biodata->nama }}</option>
                                    @else
                                    <option value="{{ $k->id }}">{{ $k->biodata->nama }}</option>
                                    @endif
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
                                    @if (old('d_pembimbing_2')== $k->id)
                                    <option value="{{ $k->id }}" selected>{{ $k->biodata->nama }}</option>
                                    @else
                                    <option value="{{ $k->id }}">{{ $k->biodata->nama }}</option>
                                    @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-group required">
                        <div class="row">
                            <div class="col">
                                <label class="control-label">Status Tugas Akhir </label>
                                @if ($newRegisterTA)
                                <input type="text" class="form-control text-capitalize" name="stts_ta" value="baru"
                                    readonly>
                                @elseif(UserCheck::levelAdmin())
                                <select class="form-control" name="stts_ta" size="1" required>
                                    <option value="" hidden="">-- Status Tugas Akhir --</option>
                                    <option value="baru">Baru</option>
                                    <option value="melanjutkan">Melanjutkan</option>
                                </select>
                                @endif
                            </div>
                            <div class="col">
                                <label class="control-label">Ganti Dosen Pembimbing </label><br>
                                @if ($newRegisterTA)
                                <label class="form-radio-label">
                                    <input class="form-radio-input" type="radio" name="ganti_pembimbing" value="ya"
                                        disabled>
                                    <span class="form-radio-sign">Ya</span>
                                </label>
                                <label class="form-radio-label ml-3">
                                    <input class="form-radio-input" type="radio" name="ganti_pembimbing" value="tidak"
                                        checked="">
                                    <span class="form-radio-sign">Tidak</span>
                                </label>
                                @else
                                <label class="form-radio-label">
                                    <input class="form-radio-input" type="radio" name="ganti_pembimbing" value="ya">
                                    <span class="form-radio-sign">Ya</span>
                                </label>
                                <label class="form-radio-label ml-3">
                                    <input class="form-radio-input" type="radio" name="ganti_pembimbing" value="tidak"
                                        checked="">
                                    <span class="form-radio-sign">Tidak</span>
                                </label>
                                @endif
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
                                        value="{{old('judul')}}" size="1">
                                </div>
                            </div>
                            <div class="col">
                                <label class="control-label">Konsentrasi </label>
                                <select class="form-control" name="konsentrasi[]" id="konsentrasi" size="1" required
                                    multiple>
                                    {{-- <option value="" hidden="">-- Konsentrasi --</option> --}}
                                    @foreach ($konsentrasi as $item)
                                    @if (is_array(old('konsentrasi')) && in_array($item->nama_konsentrasi,
                                    old('konsentrasi')))
                                    <option value="{{ $item->nama_konsentrasi }}" selected>{{ $item->nama_konsentrasi }}
                                    </option>
                                    @else
                                    <option value="{{ $item->nama_konsentrasi }}">{{ $item->nama_konsentrasi }}
                                    </option>
                                    @endif
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
                <h5 class="modal-title" id="exampleModalLongTitle">Edit Data TA</h5>
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
                                <input type="hidden" value="{{ $item->thn_akademik_id }}" class="form-control"
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
                            <div class="col d_ganti_1" id="d_ganti_1">
                                <label class="control-label">Ganti Dosen Pembimbing </label><br>
                                <label class="form-radio-label">
                                    <input class="form-radio-input" type="radio" name="ganti_pembimbing" value="ya" {{
                                        $item->ganti_pembimbing ==
                                    'ya' ? 'checked' : '' }}>
                                    <span class="form-radio-sign">Ya</span>
                                </label>
                                <label class="form-radio-label ml-3">
                                    <input class="form-radio-input" type="radio" name="ganti_pembimbing" value="tidak"
                                        {{ $item->ganti_pembimbing
                                    == 'tidak' ? 'checked' : '' }}
                                    checked="">
                                    <span class="form-radio-sign">Tidak</span>
                                </label>
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
                            <div class="col-6">
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

{{-- Melanjutkan --}}
@if (Auth::user()->level!=0 || UserCheck::checkDaftarTA())

@else
<div class="modal fade" id="modalMelanjutkan" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Melanjutkan Tugas Akhir</h5>
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
                                @if (Auth::user()->level==0 )
                                <input type="hidden" name="mahasiswa_id" value="{{ $mhsAuth->id}}">
                                <input type="text" class="form-control" value="{{ $mhsAuth->biodata->no_induk }} - {{
                                        $mhsAuth->biodata->nama }}" readonly>
                                @else
                                <select class="form-control" name="mahasiswa_id" onchange="no_biodata()" size="1"
                                    required>

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
                                <input type="text" class="form-control" value="{{ $last_year->tahun }}" readonly>
                                <input type="hidden" class="form-control" value="{{ $last_year->id }}"
                                    name="thn_akademik_id">
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
                                    <option value="{{ $k->id }}" {{ $k->id == $nextTA->d_pembimbing_1 ?
                                        'selected' :''
                                        }}>{{ $k->biodata->nama }}</option>
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
                                    <option value="{{ $k->id }}" {{ $k->id == $nextTA->d_pembimbing_2 ?
                                        'selected' :''
                                        }}>{{ $k->biodata->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-group required">
                        <div class="row">
                            <div class="col">
                                <label class="control-label">Status Tugas Akhir </label>
                                <input type="text" class="form-control text-capitalize" value="melanjutkan" readonly>
                                <input type="hidden" name="stts_ta" value="melanjutkan">
                            </div>
                            <div class="col d_ganti_2" id="d_ganti_2">
                                <label class="control-label">Ganti Dosen Pembimbing </label><br>
                                <label class="form-radio-label">
                                    <input class="form-radio-input" type="radio" name="ganti_pembimbing" value="ya" {{
                                        $nextTA->ganti_pembimbing ==
                                    'ya' ? 'checked' : '' }}>
                                    <span class="form-radio-sign">Ya</span>
                                </label>
                                <label class="form-radio-label ml-3">
                                    <input class="form-radio-input" type="radio" name="ganti_pembimbing" value="tidak"
                                        {{ $nextTA->ganti_pembimbing
                                    == 'tidak' ? 'checked' : '' }}
                                    checked="">
                                    <span class="form-radio-sign">Tidak</span>
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group required" id="kolomBaru_2" style="display:none">
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
                                    <input type="text" class="form-control" name="judul" placeholder="Judul .." size="1"
                                        value="{{ old('judul'.$nextTA->judul) }}">
                                </div>

                            </div>
                            <div class="col">
                                <label class="control-label">Konsentrasi </label>
                                <select class="form-control " name="konsentrasi[]" id="konsentrasi__" size="1" required
                                    multiple>
                                    {{-- <option value="" hidden="">-- Konsentrasi --</option> --}}
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
@endif

{{-- Judul --}}
@foreach ($daftarta as $item)
<div class="modal fade" id="viewJudul{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Judul Tugas Akhir - {{
                    $item->mahasiswa->biodata->no_induk }}
                    | {{ $item->mahasiswa->biodata->nama
                    }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <div class="form-group">
                    <div class="row">
                        <div class="col">
                            {{ $item->judul }}
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
                            {!! $pengumuman->cttn_daftar_ta !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

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

{{-- update status pengajuan --}}
@foreach ($daftarta as $ta)
<div class="modal fade" id="modalUpdateStatus{{ $ta->id }}" tabindex="-1" role="dialog"
    aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Perbarui Status Pengajuan | {{
                    $ta->mahasiswa->biodata->nama }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form method="POST" enctype="multipart/form-data" action="/update-status-ta/{{ $ta->id }}">
                @method('put')
                @csrf
                <div class="modal-body">

                    <input type="hidden" value="{{ $ta->id }}" name="id" required>

                    <div class="form-group">
                        <select class="form-control" name="stts_pengajuan" size="1" required>
                            <option value="" hidden="">-- Status Pengajuan --</option>
                            <option @php if($ta->stts_pengajuan == 'tertunda') echo 'selected';
                                @endphp value="tertunda">Tertunda</option>
                            <option @php if($ta->stts_pengajuan == 'diterima') echo 'selected';
                                @endphp value="diterima">Diterima</option>
                            <option @php if($ta->stts_pengajuan == 'ditolak') echo 'selected';
                                @endphp value="ditolak">Ditolak</option>
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
<script src="/assets/js/select2.min.js"></script>
<script src="/assets/js/native/checkboxTA.js"></script>
<script src="/assets/js/native/konsentrasi.js"></script>
<script src="/assets/js/native/image.js"></script>

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

</script>

@endsection