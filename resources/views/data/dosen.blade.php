@extends('layouts.layout')

@section('content')

<div class="main-panel">
    <div class="content">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">Data Dosen</h4>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="data-dosen" class="display table table-striped table-hover">
                                    <thead>
                                        <tr align="center">
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>Email</th>
                                            <th>Konsentrasi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                        $no=1;
                                        @endphp
                                        @foreach ($dosen as $item)
                                        <tr align="center">
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $item->biodata->nama }}</td>
                                            <td>{{ $item->biodata->email }}</td>
                                            <td>{{ $item->biodata->keahlian }}</td>
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
        $('#data-dosen').DataTable({});
    });
</script>
@endsection