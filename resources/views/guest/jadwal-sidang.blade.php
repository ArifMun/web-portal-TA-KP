@extends('guest.layout')

@section('content')
{{-- <div class="container"> --}}
    <div class="content">
        <div class="page-inner">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <h4 class="card-title text-center">JADWAL SIDANG TUGAS AKHIR</h4>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="divider"></div>
                            <div class="table-responsive">
                                <table id="jadwal-sidang" class="display table table-striped table-hover">
                                    <thead>
                                        <tr align="center">
                                            <th>No</th>
                                            <th>NIM</th>
                                            <th>Nama</th>
                                            <th>Dosen Penguji Utama</th>
                                            <th>Dosen Penguji 1</th>
                                            <th>Dosen Penguji 2</th>
                                            <th>Judul</th>
                                            <th>Tempat</th>
                                            <th>Status</th>
                                            <th>Tahun Akademik</th>
                                            <th>Tanggal Sidang</th>
                                            <th>Jam Sidang</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @php $no=1; @endphp
                                        @foreach ($jadwalSidang as $item)
                                        <tr class="text-capitalize">
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $item->daftarta->mahasiswa->biodata->no_induk}}</td>
                                            <td>{{ $item->daftarta->mahasiswa->biodata->nama}}</td>
                                            <td>
                                                @foreach ($dosen as $k)
                                                {{ $k->id == $item->d_penguji ?
                                                $k->biodata->nama :''
                                                }}
                                                @endforeach
                                            </td>
                                            <td>
                                                @foreach ($dosen as $k)
                                                {{ $k->id == $item->daftarta->d_pembimbing_1 ?
                                                $k->biodata->nama :''
                                                }}
                                                @endforeach
                                            </td>
                                            <td>
                                                @foreach ($dosen as $k)
                                                {{ $k->id == $item->daftarta->d_pembimbing_2 ?
                                                $k->biodata->nama :''
                                                }}
                                                @endforeach
                                            </td>
                                            <td>{{ $item->judul }}</td>
                                            <td>{{ $item->tempat }}</td>
                                            @if ($item->daftarta->sidangta->stts_sidang=='proses')
                                            <td>
                                                <a
                                                    class="font-weight-bold text-light text-capitalize badge badge-warning">
                                                    {{
                                                    $item->stts_sidang }}</a>
                                            </td>
                                            @elseif($item->stts_sidang=='selesai')
                                            <td>
                                                <a
                                                    class="font-weight-bold text-light text-capitalize badge badge-success">
                                                    {{
                                                    $item->stts_sidang }}</a>
                                            </td>
                                            @else
                                            <td>
                                                <a
                                                    class="font-weight-bold text-light text-capitalize badge badge-primary">
                                                    {{
                                                    $item->stts_sidang }}</a>
                                            </td>
                                            @endif
                                            <td>{{ $item->thnakademik->tahun }}</td>
                                            <td>{{
                                                Carbon\Carbon::parse($item->tgl_sidang)->locale('id')->translatedformat('l,d
                                                F
                                                Y')}}
                                            </td>
                                            <td>{{
                                                Carbon\Carbon::parse($item->jam_mulai_sidang)->locale('id')->format('H:i')}}
                                                - {{
                                                Carbon\Carbon::parse($item->jam_akhir_sidang)->locale('id')->format('H:i')
                                                }} WIB
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
    {{--
</div> --}}
<script src="/assets/js/core/jquery.3.2.1.min.js"></script>
<script>
    $(document).ready(function() {
            $('#jadwal-sidang').DataTable({

            });
        });

    
</script>
@endsection