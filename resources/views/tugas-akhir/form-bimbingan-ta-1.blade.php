<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{--
    <link rel="stylesheet" href="/assets/css/bootstrap.min.css"> --}}
    <title>Cetak Laporan</title>
</head>
<style>
    body {
        display: flex;
        justify-content: center;
        /* margin-top: 100px; */
        border: 1px solid black;
    }

    img {
        margin-top: 30px;
    }

    .kop-judul p {
        line-height: 1.5;
        /* font-weight: bold; */
        margin-top: -10px;
        font-size: 12px;
        margin-right: 100px
    }

    .kop-logo {
        line-height: 1.6;
        font-weight: bold;
    }

    .content {
        margin-top: 90px;
    }
</style>
{{-- onload="window.print();" --}}

<body style="background-color: white;">
    <header style="position: fixed">
        <table style="width: 100%;border:none;">
            <tr>
                <td>
                    <span class="kop-logo">
                        <img src="assets/img/logo.jpeg" width="70px">
                    </span>
                </td>
                <td>
                    <span class="kop-judul">
                        <p><b> PROGRAM STUDI TEKNOLOGI INFORMASI</b>
                            <br>FAKULTAS TEKNIK
                            <br>UNIVERSITAS MUHAMMADIYAH PUREWOREJO
                        </p>
                    </span>
                </td>
                <td>
                    <span class="kop-judul" style="margin-left: ">
                        <p><b>FORM SO2-PSTI</b>
                    </span>
                </td>
            </tr>
        </table>
        <hr style="border: 1px solid black;margin-top: -22px;width: 722px">
    </header>
    <div class="content">
        <table style="width: 700px;margin-left: 7px;  border-collapse: collapse; margin-bottom:15px;text-align: left;">
            <tr style=" text-align: center;">
                <td colspan="3" style="padding-bottom: 10px"> <u><span style="font-size: 15px;font-style: bold;">KARTU
                            BIMBINGAN
                            SKRIPSI</span></u>
                </td>
            </tr>
            <tr align="left">
                <td width="200px">NAMA / NIM</td>
                <td width="2px">:</td>
                <td style="text-align: left;">{{ $mhstas->mahasiswa->biodata->no_induk}} / {{
                    $mhstas->mahasiswa->biodata->nama}}</td>
            </tr>
            <tr align="left">
                <td width="200px">JUDUL SKRIPSI</td>
                <td width="2px">:</td>
                <td>{{ $mhstas->judul}}</td>
            </tr>
            <tr align="left">
                <td width="200px">DOSEN PEMBIMBING I</td>
                <td width="2px">:</td>
                <td></td>
            </tr>
        </table>

    </div>

    <table style="width: 700px; margin:auto; border-collapse: collapse; border:1px solid black" border="1">
        <thead style="font-weight: bold;">
            <td align="center">NO</td>
            <td align="center">Hari / Tgl</td>
            <td align="center">Judul Bimbingan</td>
            <td align="center">Uraian Bimbingan</td>
            <td align="center">Ttd Pembimbing</td>
        </thead>
        @php
        $no=1;
        @endphp
        @foreach ($bimbinganTA as $row)
        <tr align="center">
            <td style="">{{ $no++ }}</td>
            <td>{{
                $row->created_at->locale('id')->translatedformat('l, d
                F
                Y')}}</td>
            <td>{{ $row->judul_bimbingan }}</td>
            <td>{{ $row->catatan }}</td>
            <td></td>

        </tr>
        @endforeach
    </table>
    <footer>
        <table style="width: 300px; margin-right: -60px" align="right">
            <p align="left">Purworejo, </p>
            <p align="left">Dosen Pembimbing I</p><br><br>
            <p align="left">{{ $mhstas->dosen1->biodata->nama }}</p>
        </table>
    </footer>
</body>

</html>