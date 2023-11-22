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

    #mahasiswa_id {
        max-height: 50px;
        /* Atur tinggi maksimum elemen select */
        overflow-y: auto;
        /* Tampilkan scroll jika konten melebihi tinggi maksimum */
    }
</style>
<div class="main-panel">
    <div class="content">
        <div class="page-inner">
            <div class="page-header">
                @if (Auth::user()->level == 0)
                <h4 class="page-title">Kerja Praktik [Mahasiswa]</h4>
                @else
                <h4 class="page-title">Kerja Praktik</h4>
                @endif
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="card">

                        @if (empty($formakses))
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <div class="">Readme First
                                    <a href="kerja-praktik/view-pengumuman" data-toggle="modal"
                                        data-target="#viewPengumuman"><i class="fa fa-eye ml-2">
                                        </i>
                                    </a>
                                </div>

                                @if ($existKp)
                                <a href="/kerja-praktik/melanjutkan" class="btn btn-success btn-round ml-auto"
                                    data-toggle="modal" data-target="#modalMelanjutkan">
                                    <i class="fa fa-plus"></i>
                                    Melanjutkan
                                </a>
                                @elseif($newRegisterKp||UserCheck::levelAdmin())
                                <a href="/kerja-praktik/daftar" class="btn btn-primary btn-round ml-auto"
                                    data-toggle="modal" data-target="#modalDaftarKP" data-modal-type="tambah">
                                    <i class="fa fa-plus"></i>
                                    Daftar
                                </a>
                                @endif
                            </div>
                        </div>

                        @elseif(Auth::user()->level == 0 && $formakses->akses_kp == 1 ||
                        UserCheck::levelAdmin() )
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <div class="">Readme First
                                    <a href="kerja-praktik/view-pengumuman" data-toggle="modal"
                                        data-target="#viewPengumuman"><i class="fa fa-eye ml-2">
                                        </i>
                                    </a>
                                </div>

                                @if ($existKp)
                                <a href="/kerja-praktik/melanjutkan" class="btn btn-success btn-round ml-auto"
                                    data-toggle="modal" data-target="#modalMelanjutkan">
                                    <i class="fa fa-plus"></i>
                                    Melanjutkan
                                </a>
                                @elseif($newRegisterKp || UserCheck::levelAdmin())
                                <a href="/kerja-praktik/daftar" class="btn btn-primary btn-round ml-auto"
                                    data-toggle="modal" data-target="#modalDaftarKP" data-modal-type="tambah">
                                    <i class="fa fa-plus"></i>
                                    Daftar
                                </a>
                                @endif
                            </div>
                        </div>

                        @elseif(Auth::user()->level == 0 && $formakses->akses_kp == 0)
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <a class="badge badge-danger ml-auto">
                                    <h4 class="card-title text-light">Pendaftaran Kerja Praktik Sudah Ditutup</h4>
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
                                                <select data-column="12" class="form-control" id="filter-tahun">
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
                                                <select data-column="7" class="form-control text-capitalize"
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
                                    <div class="row">
                                        <div class="col col-stats ml-3 ml-sm-0">
                                            <p class="font-weight-bold h6">Status Pengajuan</p>
                                            <p class="font-weight-bold badge badge-success mr-1">
                                                Diterima: {{$kpDiterima}}
                                            </p>
                                            <p class="font-weight-bold badge badge-warning mr-1">
                                                Tertunda :
                                                {{
                                                $kpTertunda }}
                                            </p>
                                            <p class="font-weight-bold badge badge-danger">
                                                Ditolak
                                                :
                                                {{
                                                $kpDitolak
                                                }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="divider"></div>
                            @endif
                            <div class="table-responsive">
                                <table id="kerja-praktik" class="display table table-striped table-hover">
                                    <thead>
                                        <tr align="center">
                                            <th>No</th>
                                            @if (Auth::user()->level!=0)
                                            <th>NIM</th>
                                            <th>Nama</th>
                                            @endif
                                            <th>Dosen Pilihan 1</th>
                                            <th>Dosen Pilihan 2</th>
                                            <th>Ganti Dosen Pembimbing</th>
                                            <th>Dosen Pembimbing Lama</th>
                                            <th>Status Pengajuan</th>
                                            <th>Status KP</th>
                                            <th>Semester</th>
                                            <th>Judul</th>
                                            <th>Sertifikat Makrab</th>
                                            <th>Slip Pembayaran</th>
                                            <th>Tahun Akademik</th>
                                            <th>Konsentrasi</th>
                                            <th>Tanggal Daftar</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>

                                    @if (Auth::user()->level==0)
                                    <tbody>
                                        @php $no=1; @endphp
                                        @if (!empty(Auth::user()->biodata->mahasiswa->daftarkp))
                                        @foreach ($mhskps as $item)
                                        <tr class="text-capitalize text-center">
                                            <td>{{ $no++ }}</td>
                                            {{-- <td>{{ $item->mahasiswa->biodata->no_induk}}</td>
                                            <td>{{ $item->mahasiswa->biodata->nama }}</td> --}}
                                            <td class=" text-left">
                                                @foreach ($dosen as $k)
                                                {{ $k->id == $item->d_pembimbing_1 ?
                                                $k->biodata->nama :''
                                                }}
                                                @endforeach
                                            </td>
                                            <td class=" text-left">
                                                @foreach ($dosen as $k)
                                                {{ $k->id == $item->d_pembimbing_2 ?
                                                $k->biodata->nama :''
                                                }}
                                                @endforeach
                                            </td>
                                            <td class="">
                                                {{ $item->ganti_pembimbing }}
                                            </td>
                                            <td class=" text-left">
                                                @foreach ($dosen as $k)
                                                {{ $k->id == $item->pembimbing_lama ?
                                                $k->biodata->nama :''
                                                }}
                                                @endforeach
                                            </td>

                                            @if ($item->stts_pengajuan=='tertunda')
                                            <td>
                                                <span class="font-weight-bold text-light  badge badge-warning">
                                                    {{
                                                    $item->stts_pengajuan }}</span>
                                            </td>
                                            @elseif($item->stts_pengajuan=='diterima')
                                            <td>
                                                <span class="font-weight-bold text-light  badge badge-success ">
                                                    {{
                                                    $item->stts_pengajuan }}</span>
                                            </td>
                                            @else
                                            <td>
                                                <span class="badge badge-danger text-light font-weight-bold ">
                                                    {{
                                                    $item->stts_pengajuan }}</span>
                                            </td>
                                            @endif

                                            <td class="">{{ $item->stts_kp }}</td>
                                            <td>{{ $item->semester }}</td>
                                            <td>
                                                <a href="kerja-praktik/view-judul/{{ $item->id }}" data-toggle="modal"
                                                    data-target="#viewJudul{{ $item->id }}"
                                                    class="btn btn-primary btn-xs"><i class="fa fa-eye">
                                                    </i>
                                                </a>
                                            </td>
                                            <td>
                                                <a href="kerja-praktik/view-sertifikat-makrab/{{ $item->id }}"
                                                    data-toggle="modal"
                                                    data-target="#viewSertifikatMakrab{{ $item->id }}"><i
                                                        class="fa fa-file-image fa-2x">
                                                    </i> </a>
                                            </td>
                                            <td>
                                                <a href="kerja-praktik/view-slip/{{ $item->id }}" data-toggle="modal"
                                                    data-target="#viewSlip{{ $item->id }}"><i
                                                        class="fa fa-file-image fa-2x">
                                                    </i> </a>
                                            </td>
                                            <td>{{ $item->tahunakademik->tahun }} </td>
                                            <td>{{ $item->konsentrasi }}</td>
                                            <td>{{
                                                $item->created_at->locale('id')->translatedformat('l,d
                                                F
                                                Y, H:i')}}
                                            </td>
                                            <td>
                                                @if ($item->stts_pengajuan == 'diterima')

                                                @else
                                                <a href="kerja-praktik/edit/{{ $item->id }}" data-toggle="modal"
                                                    data-target="#modalEditKP{{ $item->id }}"
                                                    class="btn btn-warning btn-xs" data-modal-type="edit"><i
                                                        class="fa fa-edit">
                                                    </i>
                                                </a>
                                                <a href="kerja-praktik/hapus/{{ $item->id }}" data-toggle="modal"
                                                    data-target="#modalHapusKP{{ $item->id }}"
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
                                        @foreach ($daftarkp as $row)
                                        {{-- {{ $row->mahasiswa->biodata->no_induk }} --}}
                                        <tr class="text-capitalize text-center">
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $row->mahasiswa->biodata->no_induk }}</td>
                                            <td class=" text-left">{{ $row->mahasiswa->biodata->nama }}
                                            </td>
                                            <td class=" text-left">
                                                @foreach ($dosen as $k)
                                                {{ $k->id == $row->d_pembimbing_1 ?
                                                $k->biodata->nama :''
                                                }}
                                                @endforeach
                                            </td>
                                            <td class=" text-left">
                                                @foreach ($dosen as $k)
                                                {{ $k->id == $row->d_pembimbing_2 ?
                                                $k->biodata->nama :''
                                                }}
                                                @endforeach
                                            </td>
                                            <td class="">
                                                {{ $row->ganti_pembimbing }}
                                            </td>
                                            <td class=" text-left">
                                                @foreach ($dosen as $kp)
                                                {{ $kp->id == $row->pembimbing_lama ?
                                                $kp->biodata->nama :''
                                                }}
                                                @endforeach
                                            </td>
                                            @if ($row->stts_pengajuan=='tertunda')
                                            <td>
                                                <a href="/update-status-kp/{{ $row->id }}" data-toggle="modal"
                                                    data-target="#modalUpdateStatus{{ $row->id }}"
                                                    class="font-weight-bold text-light  badge badge-warning">
                                                    {{
                                                    $row->stts_pengajuan }}</a>
                                            </td>
                                            @elseif($row->stts_pengajuan=='diterima')
                                            <td>
                                                <a href="/update-status-kp/{{ $row->id }}" data-toggle="modal"
                                                    data-target="#modalUpdateStatus{{ $row->id }}"
                                                    class="font-weight-bold text-light  badge badge-success">
                                                    {{
                                                    $row->stts_pengajuan }}</a>
                                            </td>
                                            @else
                                            <td>
                                                <a href="update-status-kp/{{ $row->id }}" data-toggle="modal"
                                                    data-target="#modalUpdateStatus{{ $row->id }}"
                                                    class="font-weight-bold text-light  badge badge-danger">
                                                    {{
                                                    $row->stts_pengajuan }}</a>
                                            </td>
                                            @endif
                                            <td class="">{{ $row->stts_kp }}</td>
                                            <td>{{ $row->semester }}</td>
                                            <td><a href="kerja-praktik/view-judul/{{ $row->id }}" data-toggle="modal"
                                                    data-target="#viewJudul{{ $row->id }}"
                                                    class="btn btn-primary btn-xs"><i class="fa fa-eye">
                                                    </i>
                                                </a>
                                            </td>
                                            <td><a href="kerja-praktik/view-sertifikat-makrab/{{ $row->id }}"
                                                    data-toggle="modal"
                                                    data-target="#viewSertifikatMakrab{{ $row->id }}"><i
                                                        class="fa fa-file-image fa-2x">
                                                    </i>
                                                </a>
                                            </td>
                                            <td><a href="kerja-praktik/view-slip/{{ $row->id }}" data-toggle="modal"
                                                    data-target="#viewSlip{{ $row->id }}"><i
                                                        class="fa fa-file-image fa-2x">
                                                    </i>
                                                </a>
                                            </td>
                                            <td>{{ $row->tahunakademik->tahun }}</td>
                                            <td>{{ $row->konsentrasi }}</td>
                                            <td>{{
                                                $row->created_at->locale('id')->translatedformat('l,d
                                                F
                                                Y, H:i')}}
                                            </td>
                                            <td>
                                                {{-- <a href="kerja-praktik/view-slip/{{ $row->id }}"
                                                    data-toggle="modal" data-target="#viewDataBarang{{ $row->id }}"
                                                    class="btn btn-primary btn-xs"><i class="fa fa-eye">
                                                    </i> </a> --}}
                                                <a href="/kerja-praktik/edit/{{ $row->id }}" data-toggle="modal"
                                                    data-target="#modalEditKP{{ $row->id }}"
                                                    class="btn btn-warning btn-xs" data-modal-type="edit"><i
                                                        class="fa fa-edit">
                                                    </i> </a>
                                                <a href="/kerja-praktik/hapus/{{ $row->id }}" data-toggle="modal"
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
    aria-hidden="true" data-modal-type="tambah">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Daftar Kerja Praktik </h5>
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

                                @if (Auth::user()->level==0)
                                <input type="hidden" name="mahasiswa_id" value="{{ $mhskp->id}}">
                                <input type="text" class="form-control" value="{{ $mhskp->biodata->no_induk }} - {{
                                        $mhskp->biodata->nama }}" readonly>

                                @else
                                <select class="form-control " name="mahasiswa_id" id="mahasiswa_id" size="1" id=""
                                    required>
                                    <option value="">-- Pilih Mahasiswa--</option>
                                    @foreach ($mahasiswa as $k)

                                    @if (old('mahasiswa_id') == $k->id)
                                    <option value="{{ $k->id}}" selected>{{ $k->biodata->no_induk
                                        }} - {{ $k->biodata->nama
                                        }}</option>
                                    @else
                                    <option value="{{ $k->id}}">{{ $k->biodata->no_induk
                                        }} - {{ $k->biodata->nama
                                        }}</option>
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
                                <label class="control-label">Pilih Dosen Pembimbing </label>
                                <select class="form-control" name="d_pembimbing_1" size="1" required>
                                    <option value="" hidden="">-- Pilihan Ke-1 --</option>
                                    @foreach ($dosen as $k)

                                    @if (old('d_pembimbing_1') == $k->id)
                                    <option value="{{ $k->id }}" selected>{{ $k->biodata->nama }}</option>
                                    @else
                                    <option value="{{ $k->id }}">{{ $k->biodata->nama }}</option>
                                    @endif

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
                                    @if (old('d_pembimbing_2') == $k->id)
                                    <option value="{{ $k->id }}" selected>{{ $k->biodata->nama }}</option>
                                    @endif
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
                                <input type="number" class="form-control" name="semester"
                                    placeholder="Minimal Semester 6.." size="1" value="{{ old('semester') }}" min="6"
                                    max="13" required>
                            </div>
                            <div class="col">
                                <label class="control-label">Status Kerja Praktik </label>
                                @if ($newRegisterKp)
                                <input type="text" class="form-control text-capitalize" value="baru" name="stts_kp"
                                    readonly>

                                @elseif(UserCheck::levelAdmin())
                                {{-- <label class="control-label">Status Kerja Praktik </label> --}}
                                <select class="form-control" name="stts_kp" size="1" required>
                                    <option value="" hidden="">-- Status KP --</option>
                                    <option value="baru">Baru</option>
                                    <option value="melanjutkan">Melanjutkan</option>
                                </select>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="form-group required">
                        <div class="row">
                            <div class="col">
                                <label class="control-label">Tempat Kerja Praktik</label>
                                <input type="text" class="form-control" name="tempat_kp" placeholder="Tempat KP"
                                    value="{{ old('tempat_kp') }}">
                            </div>
                            <div class="col">
                                <label class="control-label">Konsentrasi </label>
                                <select class="form-control select2" name="konsentrasi[]" id="konsentrasi"
                                    style="width: 100%; " multiple="true" required>
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

                    <div class="form-group required">
                        <div class="row">
                            <div class="col" id="d_ganti">
                                <label class="control-label">Ganti Dosen Pembimbing </label><br>
                                @if ($newRegisterKp)
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
                                @elseif(UserCheck::levelAdmin())
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
                            <div class="col">
                                <label>Judul</label>
                                <input type="text" class="form-control" name="judul" placeholder="Judul .." size="1"
                                    value="{{ old('judul') }}">
                            </div>
                        </div>
                    </div>

                    <div class="form-group required">
                        <div class="row">
                            <div class="col">
                                <div class="kolom-baru mb-3" id="kolomBaru" style="display:none">
                                    <label>Dosen Pembimbing Lama</label>
                                    <select class="form-control" name="pembimbing_lama" size="1">
                                        <option value="">-- Pembimbing Lama --</option>
                                        @foreach ($dosen as $k)
                                        <option value="{{ $k->id }}">{{ $k->biodata->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="">
                                    <label for="image" class="form-label control-label">Sertifikat MAKRAB </label>
                                    <input type="file" class="form-control picture" id="image4" name="sertifikat_makrab"
                                        onchange="previewImage(4)" required maxlength="1024">
                                    <img class="img-preview img-fluid mb-3 col-sm-4 mt-2" id="preview4">
                                    <span class="font-italic text-muted">ukuran file maksimal <span
                                            class="text-danger">1024
                                            KB</span> </span>
                                </div>
                            </div>
                            <div class="col">
                                <label for="image" class="form-label control-label">Slip pembayaran </label>
                                <input type="file" class="form-control picture" id="image1" name="slip_pembayaran"
                                    onchange="previewImage(1)" required maxlength="1024">
                                <img class="img-preview img-fluid mb-3 col-sm-4 mt-2" id="preview1">
                                <span class="font-italic text-muted">ukuran file maksimal <span class="text-danger">1024
                                        KB</span> </span>
                            </div>
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
                    <button type="submit" class="btn btn-primary" onclick="submitForm()"><i class="fa fa-save"> </i>
                        Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>


{{-- Melanjutkan BELUM FIX?--}}
@if (Auth::user()->level!=0 || UserCheck::checkDaftarKP())

@else

<div class="modal fade modalMelanjutkan" id="modalMelanjutkan" tabindex="-1" role="dialog"
    aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Melanjutkan Kerja Praktik</h5><br>
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

            <form id="ganti_1" method="POST" enctype="multipart/form-data" action="kerja-praktik">
                @csrf
                <div class="modal-body">

                    <div class="form-group required">
                        <div class="row">
                            <div class="col">
                                <label class="control-label">NIM </label>
                                <input type="hidden" name="mahasiswa_id" id="mahasiswa_id"
                                    value="{{ $nextkp->mahasiswa_id }}">
                                <input type="text" class="form-control" size="1" readonly
                                    placeholder="{{ $nextkp->mahasiswa->biodata->no_induk }} - {{ $nextkp->mahasiswa->biodata->nama }}">
                            </div>
                            <div class="col">
                                <label class="control-label">Tahun Akademik </label>
                                <input type="text" value="{{ $last_year->tahun }}" class="form-control" size="1"
                                    readonly>
                                <input type="hidden" value="{{ $last_year->id }}" class="form-control"
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
                                    <option value="{{ $k->id }}" {{ $k->id == $nextkp->d_pembimbing_1 ?
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
                                    <option value="{{ $k->id }}" {{ $k->id == $nextkp->d_pembimbing_2 ?
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
                                <input type="number" class="form-control" name="semester"
                                    value="{{ $nextkp->semester }}" placeholder="Semester .." size="1" required>
                            </div>
                            <div class="col">
                                <label class="control-label">Status Kerja Praktik </label>
                                <input type="text" class="form-control text-capitalize" name="stts_kp"
                                    value="melanjutkan" readonly>
                                <input type="hidden" value="melanjutkan" name="stts_kp">
                            </div>

                        </div>
                    </div>

                    <div class="form-group required">
                        <div class="row">
                            <div class="col">
                                <label class="control-label">Tempat Kerja Praktik</label>
                                <input type="text" class="form-control" name="tempat_kp" placeholder="Tempat KP"
                                    value="{{ $nextkp->tempat_kp }}">
                            </div>
                            <div class="col">
                                <label class="control-label">Konsentrasi </label>
                                <select class="form-control konsentrasi_" name="konsentrasi[]"
                                    id="konsentrasi__{{ $nextkp->id }}" multiple required size="1">

                                    @foreach($konsentrasi as $option)
                                    <option value="{{ $option->nama_konsentrasi }}" {{ in_array($option->
                                        nama_konsentrasi,
                                        explode(',',
                                        $nextkp->konsentrasi)) ? 'selected' : '' }}>
                                        {{ $option->nama_konsentrasi }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-group required ">
                        <div class="row">
                            <div class="col d_ganti_2" id="d_ganti_2">
                                <label class="control-label">Ganti Dosen Pembimbing </label><br>
                                <label class="form-radio-label">
                                    <input class="form-radio-input" type="radio" name="ganti_pembimbing" value="ya" {{
                                        $nextkp->ganti_pembimbing == 'ya' ? 'checked' : '' }}>
                                    <span class="form-radio-sign">Ya</span>
                                </label>
                                <label class="form-radio-label ml-3">
                                    <input class="form-radio-input" type="radio" name="ganti_pembimbing" value="tidak"
                                        {{ $nextkp->ganti_pembimbing == 'tidak' ? 'checked' : '' }}
                                    checked="">
                                    <span class="form-radio-sign">Tidak</span>
                                </label>
                            </div>
                            <div class="col">
                                <label>Judul</label>
                                <input type="text" id="judul" class="form-control" name="judul" size="1"
                                    placeholder="Judul .." value="{{ $nextkp->judul }}">
                            </div>
                        </div>
                    </div>

                    <div class="form-group required">
                        <div class="row">
                            <div class="col">
                                <div class="mb-3" name="pembimbing_lama" style="display: none" id="kolomBaru_2">
                                    <label>Dosen Pembimbing Lama</label>
                                    <select class="form-control" size="1" name="pembimbing_lama">
                                        <option value="">-- Pembimbing Lama --</option>
                                        @foreach ($dosen as $k)
                                        <option value="{{ $k->id }}" {{ $k->id == $nextkp->pembimbing_lama ? 'selected'
                                            :'' }}>{{
                                            $k->biodata->nama}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="">
                                    <label for="image" class="form-label control-label">Sertifikat MAKRAB </label>
                                    <input type="file" class="form-control picture" id="image6" name="sertifikat_makrab"
                                        onchange="previewImage(6)" required maxlength="1024">
                                    <img class="img-preview img-fluid mb-3 col-sm-4 mt-2" id="preview6">
                                    <span class="font-italic text-muted">ukuran file maksimal <span
                                            class="text-danger">1024
                                            KB</span> </span>
                                </div>
                            </div>
                            <div class="col">
                                <input type="hidden" name="stts_pengajuan" value="tertunda">
                                <div>
                                    <label for="image" class="form-label control-label">Slip pembayaran </label>
                                    <input type="file" class="form-control picture" id="image3" name="slip_pembayaran"
                                        onchange="previewImage(3)" required>
                                    <img class="img-preview img-fluid mb-3 col-sm-4 mt-2" id="preview3">
                                    <span class="font-italic text-muted mt-1">ukuran file maksimal <span
                                            class="text-danger">1024
                                            KB</span> </span>
                                </div>
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

{{-- Edit --}}
@foreach ($daftarkp as $item)
<div class="modal fade modalEditKP" id="modalEditKP{{ $item->id }}" tabindex="-1" role="dialog"
    aria-labelledby="myLargeModalLabel" aria-hidden="true" data-modal-type="edit">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Ubah Data Kerja Praktik</h5>
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
            <form id="ganti_1" method="POST" enctype="multipart/form-data" action="kerja-praktik/{{ $item->id }}">
                @method('put')
                @csrf
                <div class="modal-body">
                    <div class="form-group required">
                        <div class="row">
                            <div class="col">
                                <label class="control-label">NIM </label>
                                <input type="hidden" name="mahasiswa_id" id="mahasiswa_id"
                                    value="{{ $item->mahasiswa_id }}">
                                <input type="text" class="form-control text-capitalize" size="1" readonly
                                    value="{{ $item->mahasiswa->biodata->no_induk }} - {{ $item->mahasiswa->biodata->nama }}">
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
                                <label class="control-label">Status Kerja Praktik </label>
                                <select class="form-control" name="stts_kp" size="1" required>
                                    <option value="" hidden="">-- Status KP --</option>
                                    <option @php if($item->stts_kp == 'baru') echo 'selected';
                                        @endphp value="baru">Baru</option>
                                    <option @php if($item->stts_kp == 'melanjutkan') echo 'selected';
                                        @endphp value="melanjutkan">Melanjutkan</option>
                                </select>
                            </div>
                            <div class="col">
                                <label class="control-label">Status Pengajuan </label>
                                @if (Auth::user()->level==0)
                                <input type="text" class="form-control text-capitalize"
                                    value="{{ $item->stts_pengajuan }}" readonly>
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
                        </div>
                    </div>

                    <div class="form-group required ">
                        <div class="row">
                            <div class="col">
                                <label class="">Tempat Kerja Praktik</label>
                                <input type="text" class="form-control" name="tempat_kp" placeholder="Tempat KP"
                                    value="{{ old('tempat_kp') }}">
                            </div>
                            <div class="col">
                                <label>Judul</label>
                                <input type="text" id="judul" class="form-control" name="judul" size="1"
                                    placeholder="Judul .." value="{{ $item->judul }}">
                            </div>
                        </div>
                    </div>

                    <div class="form-group required ">
                        <div class="row">
                            <div class="col">
                                <label class="control-label">Semester </label>
                                <input type="number" class="form-control" name="semester" value="{{ $item->semester }}"
                                    placeholder="Semester .." size="1" required>
                            </div>
                            <div class="col d_ganti_1" id="d_ganti_1">
                                <label class="control-label">Ganti Dosen Pembimbing </label><br>
                                <label class="form-radio-label">
                                    <input class="form-radio-input" type="radio" name="ganti_pembimbing" value="ya" {{
                                        $item->ganti_pembimbing == 'ya' ? 'checked' : '' }}>
                                    <span class="form-radio-sign">Ya</span>
                                </label>
                                <label class="form-radio-label ml-3">
                                    <input class="form-radio-input" type="radio" name="ganti_pembimbing" value="tidak"
                                        {{ $item->ganti_pembimbing == 'tidak' ? 'checked' : '' }}
                                    checked="">
                                    <span class="form-radio-sign">Tidak</span>
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group required">
                        <div class="row">
                            <div class="col">
                                <div>
                                    <label for="image" class="form-label">Slip pembayaran </label>
                                    <input type="hidden" name="oldImage" value="{{ $item->slip_pembayaran }}">
                                    <input type="file" class="form-control picture" id="image2" name="slip_pembayaran"
                                        onchange="previewImage(2)">

                                    @if ($item->slip_pembayaran)
                                    <img src="{{ asset('storage/' . $item->slip_pembayaran) }}"
                                        class="img-preview img-fluid mb-3 col-sm-5" id="preview2">
                                    @else
                                    <img class="img-preview img-fluid mb-3 col-sm-5" id="preview2">
                                    @endif

                                    <p class="mt-1 font-italic text-muted">biarkan kolom kosong
                                        jika tidak diganti | ukuran file maksimal <span class="text-danger">1024
                                            KB</span> </p>
                                </div>
                            </div>
                            <div class="col">
                                <div class="mb-3" name="pembimbing_lama" style="display: none" id="kolomBaru_1">
                                    <label>Dosen Pembimbing Lama</label>
                                    <select class="form-control" size="1" name="pembimbing_lama">
                                        <option value="">-- Pembimbing Lama --</option>
                                        @foreach ($dosen as $k)
                                        <option value="{{ $k->id }}" {{ $k->id == $item->pembimbing_lama ? 'selected'
                                            :'' }}>{{
                                            $k->biodata->nama}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div>
                                    <label class="control-label">Konsentrasi </label>
                                    <select class="form-control konsentrasi_" name="konsentrasi[]"
                                        id="konsentrasi_{{ $item->id }}" multiple required size="1">
                                        {{-- <option value="" hidden="">-- Konsentrasi --</option> --}}

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
                    </div>

                    <div class="form-group required">
                        <div class="row">
                            <div class="col-6">
                                <label for="image" class="form-label">Sertifikat MAKRAB </label>
                                <input type="hidden" name="oldImage1" value="{{ $item->sertifikat_makrab }}">
                                <input type="file" class="form-control picture" id="image5" name="sertifikat_makrab"
                                    onchange="previewImage(5)">

                                @if ($item->sertifikat_makrab)
                                <img src="{{ asset('storage/' . $item->sertifikat_makrab) }}"
                                    class="img-preview img-fluid mb-3 col-sm-5" id="preview5">
                                @else
                                <img class="img-preview img-fluid mb-3 col-sm-5" id="preview5">
                                @endif

                                <p class="mt-1 font-italic text-muted">biarkan kolom kosong
                                    jika tidak diganti | ukuran file maksimal <span class="text-danger">1024
                                        KB</span> </p>
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
                <h5 class="modal-title text-capitalize" id="exampleModalLongTitle">Slip Pembayaran - {{
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

{{-- view Sertifikat Makrab --}}
@foreach ($daftarkp as $item)
<div class="modal fade" id="viewSertifikatMakrab{{ $item->id }}" tabindex="-1" role="dialog"
    aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-capitalize" id="exampleModalLongTitle">Sertifikat MAKRAB - {{
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
                        @if ($item->sertifikat_makrab)
                        <div class="col">
                            <img src="{{ asset('storage/' . $item->sertifikat_makrab) }}" alt=""
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

{{-- Judul --}}
@foreach ($daftarkp as $item)
<div class="modal fade" id="viewJudul{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-capitalize" id="exampleModalLongTitle">Judul KP - {{
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
                            {!! $pengumuman->cttn_daftar_kp !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


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
                        <h3>Apakah anda yakin menghapus data
                            <span class="text-danger text-capitalize">{{ $kp->mahasiswa->biodata->nama }}</span> dengan
                            NIM
                            <span class="text-danger">{{
                                $kp->mahasiswa->biodata->no_induk
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
@foreach ($daftarkp as $kp)
<div class="modal fade" id="modalUpdateStatus{{ $kp->id }}" tabindex="-1" role="dialog"
    aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Perbarui Status Pengajuan | {{
                    $kp->mahasiswa->biodata->nama }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form method="POST" enctype="multipart/form-data" action="/update-status-kp/{{ $kp->id }}">
                @method('put')
                @csrf
                <div class="modal-body">

                    <input type="hidden" value="{{ $kp->id }}" name="id" required>

                    <div class="form-group">
                        <select class="form-control" name="stts_pengajuan" size="1" required>
                            <option value="" hidden="">-- Status Pengajuan --</option>
                            <option @php if($kp->stts_pengajuan == 'tertunda') echo 'selected';
                                @endphp value="tertunda">Tertunda</option>
                            <option @php if($kp->stts_pengajuan == 'diterima') echo 'selected';
                                @endphp value="diterima">Diterima</option>
                            <option @php if($kp->stts_pengajuan == 'ditolak') echo 'selected';
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
<script src="/assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js"></script>
<script src="/assets/js/select2.min.js"></script>
<script src="/assets/js/native/image.js"></script>
<script src="/assets/js/native/checkboxkp.js"></script>
<script src="/assets/js/native/konsentrasi.js"></script>
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


@endsection