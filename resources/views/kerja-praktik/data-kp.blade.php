@extends('layouts.layout')

@section('content')

<div class="main-panel">
    <div class="content">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">Dosen Pembimbing Kerja Praktik</h4>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="data-kp" class="display table table-striped table-hover">
                                    <thead>
                                        <tr align="center">
                                            <th>No</th>
                                            <th>NIM</th>
                                            <th>Nama</th>
                                            <th>Dosen Pembimbing</th>
                                            <th>Tahun Akademik</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                        $no=1;
                                        @endphp
                                        @foreach ($data_kp as $item)
                                        <tr class="text-capitalize">
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $item->mahasiswa->biodata->no_induk }}</td>
                                            <td>{{ $item->mahasiswa->biodata->nama }}</td>
                                            <td>{{ $item->dosen->biodata->nama }}</td>
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

<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
<script>
    $(document).ready(function() {
        $('#data-kp').DataTable({});
    });
</script>
@endsection