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
                <h4 class="page-title">Kerja Praktik</h4>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        @if (empty($formakses->akses))
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
                        @elseif(Auth::user()->level == 0 && $formakses->akses == 1 ||
                        Auth::user()->level==1 )
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
                        @elseif(Auth::user()->level == 0 && $formakses->akses == 0)
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <a href="#" class="btn btn-danger">
                                    <h4 class="card-title text-light">Pendaftaran Kerja Praktik Sudah Ditutup</h4>
                                </a>

                            </div>
                        </div>
                        @endif

                        <div class="card-body">
                            <div class="row" style="">
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
                            </div>
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
                                        @php $no=1; @endphp
                                        @if (!empty(Auth::user()->biodata->mahasiswa->daftarkp))
                                        @foreach ($mhskps as $item)
                                        {{-- {{ $item }} --}}
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

                                            <td class="text-capitalize">{{ $item->stts_kp }}</td>
                                            <td>{{ $item->semester }}</td>
                                            <td><a href="kerja-praktik/view-slip/{{ $item->id }}" data-toggle="modal"
                                                    data-target="#viewSlip{{ $item->id }}"
                                                    class="btn btn-primary btn-xs"><i class="fa fa-file-image">
                                                    </i> </a>

                                            <td>{{ $item->tahunakademik->tahun }} </td>
                                            <td>{{ $item->konsentrasi }}</td>
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

                                    @elseif(Auth::user()->level!=0)
                                    <tbody> @php $no=1; @endphp
                                        @foreach ($daftarkp as $row)
                                        {{-- {{ $row->mahasiswa->biodata->no_induk }} --}}
                                        <tr align="center">
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
                                                {{ $row->ganti_pembimbing }}
                                            </td>
                                            <td>
                                                @foreach ($dosen as $kp)
                                                {{ $kp->id == $row->pembimbing_lama ?
                                                $kp->biodata->nama :''
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
                                            <td class="text-capitalize">{{ $row->stts_kp }}</td>
                                            <td>{{ $row->semester }}</td>
                                            <td><a href="kerja-praktik/view-slip/{{ $row->id }}" data-toggle="modal"
                                                    data-target="#viewSlip{{ $row->id }}"
                                                    class="btn btn-success btn-xs"><i class="fa fa-file-image">
                                                    </i> </a>


                                            <td>{{ $row->tahunakademik->tahun }}</td>
                                            <td>{{ $row->konsentrasi }}</td>
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

            <form method="POST" enctype="multipart/form-data" action="kerja-praktik" id="ganti">
                @csrf
                <div class="modal-body">

                    <select name="stts_pengajuan" id="" hidden>
                        <option value="tertunda" selected>tertunda</option>
                    </select>
                    <div class="form-group required">
                        <div class="row">
                            <div class="col">
                                <label class="control-label">NIM - Nama </label>
                                <select class="form-control" name="mahasiswa_id" size="1" required>
                                    <option value="" hidden="">-- Pilih NIM --</option>

                                    @if (Auth::user()->level==0)
                                    <option value="{{ $mhskp->id }}">{{ $mhskp->biodata->no_induk }} - {{
                                        $mhskp->biodata->nama }}
                                    </option>

                                    @else
                                    @foreach ($mahasiswa as $k)
                                    <option value="{{ $k->id}}">{{ $k->biodata->no_induk
                                        }} - {{ $k->biodata->nama
                                        }}</option>

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
                                <label class="control-label">Pilih Dosen Pembimbing </label>
                                <select class="form-control" name="d_pembimbing_1" size="1" required>
                                    <option value="" hidden="">-- Pilihan Ke-1 --</option>
                                    @foreach ($dosen as $k)
                                    <option value="{{ $k->id }}">{{ $k->biodata->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col">
                                <label class="control-label">
                                    Pilihan Pembimbing Ke-2
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
                                <label class="control-label">Semester </label>
                                <input type="number" class="form-control" name="semester" placeholder="Semester .."
                                    size="1" required>
                            </div>
                            <div class="col">
                                <label class="control-label">Status Kerja Praktik </label>
                                <select class="form-control" name="stts_kp" size="1" required>
                                    <option value="" hidden="">-- Status KP --</option>
                                    <option value="baru">Baru</option>
                                    <option value="melanjutkan">Melanjutkan</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-group required">
                        <div class="row">
                            <div class="col" id="ganti">
                                <label class="control-label">Ganti Dosen Pembimbing </label>
                                <select class="form-control" name="ganti_pembimbing" id="d_ganti" size="1" required>
                                    <option value="" hidden="">-- Ganti --</option>
                                    <option value="iya">Iya</option>
                                    <option value="tidak">Tidak</option>
                                </select>
                            </div>
                            <div class="col">
                                <label>Judul</label>
                                <input type="text" class="form-control" name="judul" placeholder="Judul .." size="1">
                            </div>
                        </div>
                    </div>

                    <div class="form-group required">
                        <div class="row">
                            <div class="col">
                                <div class="mb-3 kolom-baru" id="kolomBaru" style="display:none">
                                    <label>Dosen Pembimbing Lama</label>
                                    <select class="form-control" name="pembimbing_lama" size="1">
                                        <option value="" hidden="">-- Pembimbing Lama --</option>
                                        @foreach ($dosen as $k)
                                        <option value="{{ $k->id }}">{{ $k->biodata->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <label for="image" class="form-label control-label">Slip pembayaran </label>
                                <input type="file" class="form-control picture" id="slip_pembayaran"
                                    name="slip_pembayaran" onchange="previewImage()">
                                <img class="img-preview img-fluid mb-3 col-sm-4 mt-2">
                            </div>
                            <div class="col">
                                <label class="control-label">Konsentrasi </label>
                                <select class="form-control" name="konsentrasi[]" id="konsentrasi" size="5" multiple
                                    required>
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
@foreach ($daftarkp as $item)
<div class="modal fade modalEditKP" id="modalEditKP{{ $item->id }}" tabindex="-1" role="dialog"
    aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Edit Data KP</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form id="ganti_1" method="POST" enctype="multipart/form-data" action="kerja-praktik/{{ $item->id }}">
                @method('put')
                @csrf
                <div class="modal-body">
                    <div class="form-group required">
                        <div class="row">
                            <div class="col">
                                <label class="control-label">NIM </label>
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
                                <label class="control-label">Pilih Dosen Pembimbing </label>
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
                                <label class="control-label">Pilihan Pembimbing ke-2 </label>
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
                                <label class="control-label">Semester </label>
                                <input type="number" class="form-control" name="semester" value="{{ $item->semester }}"
                                    placeholder="Semester .." size="1" required>
                            </div>
                            <div class="col">
                                <label class="control-label">Status Kerja Praktik </label>
                                <select class="form-control" name="stts_kp" size="1" required>
                                    <option value="" hidden="">-- Status KP --</option>
                                    <option @php if($item->stts_kp == 'baru') echo 'selected';
                                        @endphp value="baru">Baru</option>
                                    <option @php if($item->stts_kp == 'melanjutkan') echo 'selected';
                                        @endphp value="melanjutkan">Melanjutkan</option>
                                </select>
                            </div>

                        </div>
                    </div>

                    <div class="form-group required ">
                        <div class="row">
                            <div class="col">
                                <label class="control-label">Ganti Dosen Pembimbing </label>
                                <select class="form-control" name="ganti_pembimbing" id="d_ganti_1" size="1" required>
                                    <option value="" hidden="">-- Ganti --</option>
                                    <option @php if($item->ganti_pembimbing == 'iya') echo 'selected';
                                        @endphp value="iya">Iya</option>
                                    <option @php if($item->ganti_pembimbing == 'tidak') echo 'selected';
                                        @endphp value="tidak">Tidak</option>
                                </select>
                            </div>
                            <div class="col">
                                <label>Judul</label>
                                <input type="text" id="judul" class="form-control" name="judul" size="1"
                                    placeholder="Judul .." value="{{ $item->judul }}">
                            </div>
                        </div>
                    </div>

                    <div class="form-group required">
                        <div class="row">
                            <div class="col">
                                {{-- @if ($item->ganti_pembimbing=="iya") --}}
                                <div class="mb-3" name="pembimbing_lama" style="display: none" id="kolomBaru_1">
                                    <label>Dosen Pembimbing Lama</label>
                                    {{-- <input class="form-control" type="text"
                                        value="{{ $item->dosen->biodata->nama }}"> --}}
                                    <select class="form-control" size="1">
                                        <option value="" hidden="">-- Pembimbing Lama --</option>
                                        @foreach ($dosen as $k)
                                        <option value="{{ $k->id }}" {{ $k->id == $item->pembimbing_lama ? 'selected'
                                            :'' }}>{{
                                            $k->biodata->nama}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                {{-- @else
                                .
                                @endif --}}
                                <div>
                                    <label class="control-label">Konsentrasi </label>
                                    <input type="text" class="form-control" value="{{ $item->konsentrasi }}"
                                        name="konsentrasi" size="1" readonly>
                                </div>
                            </div>
                            <div class="col">
                                <div class="mb-3">
                                    <label class="control-label">Status Pengajuan </label>
                                    @if (Auth::user()->level==0)
                                    <select class="form-control" size="1" disabled>
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
                                    <select class="form-control" name="stts_pengajuan" size="1" required>
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
                                <div>
                                    <label for="image" class="form-label control-label">Slip pembayaran </label>
                                    <input type="hidden" name="oldImage" value="{{ $item->slip_pembayaran }}">
                                    <input type="file" class="form-control picture" id="slip_pembayarans"
                                        name="slip_pembayaran" onchange="Previews()">

                                    @if ($item->slip_pembayaran)
                                    <img src="{{ asset('storage/' . $item->slip_pembayaran) }}"
                                        class="img-preview img-fluid mb-3 col-sm-4 mt-1" id="img-p">
                                    @else
                                    <img class="img-preview img-fluid mb-3 col-sm-5" alt="" id="img-p">
                                    @endif

                                    <p class="mt-1 font-italic">biarkan kolom kosong
                                        jika tidak diganti</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group required">
                        <div class="row">
                            <div class="col">

                            </div>
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
                <h5 class="modal-title" id="exampleModalLongTitle">Slip Pembayaran - {{ $item->mahasiswa->biodata->nama
                    }}</h5>
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
                        <h3>Apakah anda ingin menghapus data </h3>
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
    function previewImage() {
        const image = document.querySelector('#slip_pembayaran');
        const imgPriview = document.querySelector('.img-preview');

        imgPriview.style.display = 'block';

        const oFReader = new FileReader();
        oFReader.readAsDataURL(image.files[0]);

        oFReader.onload = function (oFREvent) {
            imgPriview.src = oFREvent.target.result;
        }
        // const blob = URL.createObjectURL(image.files[0]);
        // imgPreview.src = blob;
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
    var selectElement = document.getElementById("konsentrasi");

    selectElement.addEventListener("mousedown", function(e) {
        e.preventDefault(); // Mencegah pemilihan default
            var originalScrollTop = this.scrollTop;

            e.target.selected = !e.target.selected;

            setTimeout(() => {
            this.scrollTop = originalScrollTop;
        }, 0);
    });
</script>

<script>
    $(document).ready(function() {
    // Tampilkan/menyembunyikan kolom baru saat halaman dimuat
        toggleKolomBaru('#ganti');
        // toggleKolomBaru_1('#ganti_1');
    
    // Tampilkan/menyembunyikan kolom baru saat kondisi terpilih berubah di form pertama
    $('#d_ganti').on('change', function() {
        toggleKolomBaru('#ganti');
    });
    
    // Tampilkan/menyembunyikan kolom baru saat kondisi terpilih berubah di form kedua
    // $('#d_ganti_1').on('change', function() {
    //     toggleKolomBaru_1('#ganti_1');
    // });
    
    // Fungsi untuk menampilkan/menyembunyikan kolom baru dalam form tertentu
    function toggleKolomBaru(formId) {
        if ($(formId + ' select[name="ganti_pembimbing"]').val() === 'iya') {
            $(formId + ' #kolomBaru').show();
        } else {
            $(formId + ' #kolomBaru').hide();
        }
    }

    // function toggleKolomBaru_1(formId) {
    //     if ($(formId + ' select[name="ganti_pembimbing"]').val() === 'iya') {
    //         $(formId + ' #kolomBaru_1').show();
    //     } else {
    //         $(formId + ' #kolomBaru_1').hide();
    //     }
    // }
    
    });

</script>

<script>
    $(document).ready(function() {
        $('.modalEditKP').on('show.bs.modal', function() {
            var formId = '#' + $(this).attr('id');
            toggleKolomBaru_1(formId);
        
        $(formId + ' #d_ganti_1').on('change', function() {
            toggleKolomBaru_1(formId);
        });
        
        function toggleKolomBaru_1(formId) {
                if ($(formId + ' select[name="ganti_pembimbing"]').val() === 'iya') {
                    $(formId + ' #kolomBaru_1').show();
                } else {
                    $(formId + ' #kolomBaru_1').hide();
                }
            }
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
        // const blob = URL.createObjectURL(image.files[0]);
        // imgPreview.src = blob;
    }

</script>
@endsection