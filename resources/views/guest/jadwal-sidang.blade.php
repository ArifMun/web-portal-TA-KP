@extends('guest.layout')

@section('content')
<div class="main-panel">
    <div class="content">
        <div class="page-inner">
            <div class="row">
                <div class="col-md-12">
                    <div class="card-body">
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
                                        <th>Judul</th>
                                        <th>Slip Pembayaran</th>
                                        <th>Tahun Akademik</th>
                                        <th>Konsentrasi</th>
                                        <th>Tanggal Daftar</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="/assets/js/core/jquery.3.2.1.min.js"></script>
<script>
    $(document).ready(function() {
            $('#kerja-praktik').DataTable({

            });
        });

    
</script>
@endsection