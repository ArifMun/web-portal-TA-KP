@extends('guest.layout')

@section('content')
<style>
    .divider {
        width: 100%;
        height: 2px;
        background: #BBB;
        margin: 1rem 0;
        margin-top: -5px;
    }
</style>

<div class="sidebar">
    <div class="sidebar-background"></div>
    <div class="sidebar-wrapper scrollbar-inner">
        <div class="sidebar-content">
            <ul class="nav">
                @if (empty($pengumuman->cttn_daftar_kp))
                <li class="nav-item mr-2">
                    <a>
                        <span class="text-center text-dark font-weight-bold h2">Tidak ada Pengumuman</span>
                    </a>
                </li>
                @else
                <li class="nav-item mr-2">
                    <a>
                        <span class="text-center text-dark font-weight-bold h2">PENGUMUMAN</span>
                    </a>
                    <a>
                        <span class="divider"></span>
                    </a>
                    <a href="">
                        <span style="margin: -20px 0 0 0px">{!! $pengumuman->cttn_daftar_kp !!}</span>
                    </a>
                </li>
                @endif
            </ul>
        </div>
    </div>
</div>

<div class="main-panel">
    <div class="content">
        <div class="page-inner">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <h4 class="card-title text-center">DAFTAR DOSEN PEMBIMBING KERJA PRAKTIK</h4>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="col-sm-6 col-md-3">
                                <div class="row align-items-center">
                                    <div class="col col-stats ml-3 ml-sm-0">
                                        <div class="filter tahun">
                                            <label class="font-weight-bold h6">Filter Tahun</label>
                                            <select data-column="5" class="form-control" id="filter-tahun">
                                                <option value="">-- Pilih Tahun --</option>
                                                @foreach ($thn_akademik as $k)
                                                <option value="{{ $k->tahun }}">{{ $k->tahun }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="dropdown-divider"></div>
                            <div class="table-responsive">
                                <table id="daftar-pembimbing" class="display table table-striped table-hover">
                                    <thead>
                                        <tr class="text-center">
                                            <th>No</th>
                                            <th>NIM</th>
                                            <th>Nama</th>
                                            <th>Dosen Pembimbing</th>
                                            <th>Status KP</th>
                                            <th>Tahun Akademik</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @php $no=1; @endphp
                                        @foreach ($list_acc_kp as $item)
                                        <tr class="text-capitalize ">
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $item->mahasiswa->biodata->no_induk}}</td>
                                            <td>{{ $item->mahasiswa->biodata->nama}}</td>
                                            <td class="text-capitalize">
                                                @foreach ($dosen as $k)
                                                {{ $k->id == $item->d_pembimbing_1 ?
                                                $k->biodata->nama :''
                                                }}
                                                @endforeach
                                            </td>
                                            <td class="text-center">{{ $item->stts_kp }}</td>
                                            <td class="text-center">{{ $item->tahunakademik->tahun }}</td>
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
<script src="/assets/js/core/jquery.3.2.1.min.js"></script>
<script src="/assets/js/native/filter-tahun.js"></script>
<script>
    $(document).ready(function() {
            $('#daftar-pembimbing').DataTable({
                $("#filter-tahun").change(function () {
                table.column($(this).data("column")).search($(this).val()).draw();
                });
            });
        });

</script>
@endsection