<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Form Bimbingan KP</title>
</head>
<style>
    body {
        display: flex;
        justify-content: center;
        /* left: 150px;
        right: 50px; */
        /* margin-top: 100px; */
        /* border: 1px solid black; */
        font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
    }

    /* img {
        margin-top: 15px;
        margin-bottom: 5px;
    } */

    .kop-judul p {
        /* line-height: 1.5; */
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

    header {
        text-align: center;
    }

    footer {
        position: fixed;
        /* left: 0px; */
        right: 0px;
        height: 150px;
        bottom: 200px;
        margin-bottom: -150px;
    }

    .underline {
        width: 100%;
        border-bottom: 2px dotted black;

    }
</style>
{{-- onload="window.print();" --}}

<body style="background-color: white;">
    <header style="align:center;">
        <table style=" width: 100%;padding-top:5px;text-align:center">
            <tr>
                <td>
                    {{-- <span class="kop-logo"> --}}
                        <img src="data:image/png;base64,{{ base64_encode(file_get_contents('assets/img/logo.jpeg')) }}"
                            width="110px">
                        {{-- </span> --}}
                </td>
                <td>
                    <span class="kop-judul">
                        <p style="font-size: 13px">UNIVERSITAS MUHAMMADIYAH PUREWOREJO</p>
                        <P style="font-size: 13px">FAKULTAS TEKNIK</P>
                        <p style="font-size: 16px"><b> PROGRAM STUDI TEKNOLOGI INFORMASI</b></p>
                        <p style="font-size: 13px">Jl. KH. Ahmad Dahlan 3 Purworejo - 54111</p>
                        <p style="font-size: 13px">Telp/faks. (0275) 321494, website http://ti.umpwr.ac.id
                            email:ti@umpwr.ac.id</p>
                    </span>
                </td>
            </tr>
        </table><br>
        <hr style="border: 1px solid black;margin-top: -22px;width: 722px">
    </header>
    <!--<div class="content">-->
    <table style="width: 700px;margin-left: 7px;margin-top:-20px; border-collapse: collapse;text-align: left;">
        <tr style="text-align: center;">
            <td colspan="4" style="padding-bottom: 10px"><span style="font-size: 19px;font-style: bold;">
                    BERITA ACARA SEMINAR KERJA PRAKTIK</span>
            </td>
        </tr>
        <tr>
            <td colspan="4" style="padding-top: 10px; line-height: 1.6;">
                Pada hari ini .................. Tanggal ............. bulan ................................. tahun
                .....................
                telah <br>
                dilakukan
                seminar KP
                mahasiswa:<br>
            </td>

        </tr>

        <tr align="left" style="line-height: 2;">
            <td width="200px" style="line-height: 1.6;">Nama / NIM</td>
            <td width="2px">:</td>
            <td style="text-align: left;">{{
                $seminarkp->daftarkp->mahasiswa->biodata->nama}} / {{
                $seminarkp->daftarkp->mahasiswa->biodata->no_induk}}</td>
            <td>

            </td>
        </tr>
        <tr align="left">
            <td width="200px" style="line-height: 1.6;">Judul KP</td>
            <td width="2px">:</td>
            <td>{{ $seminarkp->judul}}</td>
            <td></td>
        </tr>
        <tr>
            <td colspan="4" style="line-height: 2;">Catatan setelah seminar KP : </td>

        </tr>
        <tr>
            <td colspan="4">
                <p class="underline"></p>
            </td>
        </tr>
        <tr>
            <td colspan="4">
                <p class="underline"></p>
            </td>
        </tr>
        <tr>
            <td colspan="4">
                <p class="underline"></p>
            </td>
        </tr>
        <tr>
            <td colspan="4">
                <p class="underline"></p>
            </td>
        </tr>
        <tr>
            <td colspan="4">
                <p class="underline"></p>
            </td>
        </tr>
        <tr>
            <td colspan="4">
                <p class="underline"></p>
            </td>
        </tr>
        <tr>
            <td colspan="4">
                <p class="underline"></p>
            </td>
        </tr>
        <tr>
            <td colspan="4">
                <p class="underline"></p>
            </td>
        </tr>
        <tr>
            <td colspan="4">
                <p class="underline"></p>
            </td>
        </tr>

    </table>

    <!--</div>-->
    <footer>
        <table>
            <tr>
                <td>Mengetahui,</td>
            </tr>
            <tr>
                <td>Pembimbing</td>
            </tr>
            <tr>
                <td style="height: 60px;"> </td>
            </tr>
            <tr>
                <td><u>{{ $seminarkp->daftarkp->dosen->biodata->nama
                        }}</u>
                </td>
            </tr>
            <tr>
                <td>NIDN.{{ $seminarkp->daftarkp->dosen->biodata->no_induk }}</td>
            </tr>
        </table>
    </footer>

</body>

</html>