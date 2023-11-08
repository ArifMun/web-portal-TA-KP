<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Form Sidang Skripsi</title>
</head>
<style>
    body {
        display: flex;
        justify-content: center;
        margin: 20px;
        /* left: 150px;
        /* margin-top: 100px; */
        /* border: 1px solid black; */
        font-family: 'Gill Sans', 'Gill Sans MT', 'Calibri', 'Trebuchet MS', sans-serif;
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
        position: absolute;
        /* left: 0px; */
        left: 20px;
        /* height: 150px; */
        bottom: 0px;
        /* margin-bottom: -150px; */
    }

    .underline {
        width: 100%;
        border-bottom: 2px dotted black;

    }

    .form-ceklist {
        text-align: left;
        line-height: 0.2;
        /* margin-right: 100px; */
        margin-left: 20px;
        /* font-family: 'Times New Roman', Times, serif; */
    }

    .logo {
        padding-left: 5px;
    }
</style>

{{-- form ceklist --}}

<body style="background-color: white; border:5px double black" class="hide-on-print">
    <header style="align:center;">
        <table style="width: 100%; ">
            <tr>
                <td class="logo" width="60px">
                    {{-- <span class=" kop-logo"> --}}
                        <img src="data:image/png;base64,{{ base64_encode(file_get_contents('assets/img/logo.jpeg')) }}"
                            width="70px">
                        {{-- </span> --}}
                </td>
                <td style="padding-left: 5px">
                    <span class="form-ceklist" style="line-height: 0.6">
                        <p style="font-size: 12px;font-style: bold">PROGRAM STUDI TEKNOLOGI INFORMASI</p>
                        <p style="font-size: 11PX;">FAKULTAS TEKNIK</p>
                        <p style="font-size: 11px;">UNIVERSITAS MUHAMMADIYAH PURWOREJO</p>
                    </span>
                </td>
                <td width="200px" style="text-align: right">
                    <p style="font-size: 16px;font-style: bold">FORM SO09-PSTI</p>
                    <p style="font-size: 12px;margin-top: -10px">REV: 18 JANUARI 2021</p>
                </td>
            </tr>
        </table><br>
        <hr style="border: 1px solid black;margin-top: -20px;width: 675px">
    </header>
    <!--<div class="content">-->
    <table
        style="width: 700px;margin-left: 7px;margin-top:-20px; border-collapse: collapse;text-align: left;margin-bottom: 10px">
        <tr style="text-align: center;">
            <td style="padding-bottom: 10px"><span style="font-size: 19px;font-style: bold;">
                    <b><u>LEMBAR CEKLIST PENDAFTARAN SIDANG SKRIPSI</u></b></span>
            </td>
        </tr>
    </table>
    <table style="margin-left: 20px;margin-bottom: 15px;line-height: 1.5">
        <tr>
            <td width="150px">NIM / Nama Mhs</td>
            <td>:</td>
            <td>{{
                $sidangta->daftarta->mahasiswa->biodata->no_induk}} / {{
                $sidangta->daftarta->mahasiswa->biodata->nama}}</td>
        </tr>
        <tr>
            <td>Email / Hp Aktif</td>
            <td>:</td>
            <td>{{
                $sidangta->daftarta->mahasiswa->biodata->email}} / {{
                $sidangta->daftarta->mahasiswa->biodata->no_telp}}</td>
        </tr>
        <tr>
            <td align="left" valign="top">Alamat Tinggal</td>
            <td align="left" valign="top">:</td>
            <td align="left" valign="top">{{
                $sidangta->daftarta->mahasiswa->biodata->alamat}} Kec. {{
                $sidangta->daftarta->mahasiswa->biodata->alamat_kec}} Kab / Kota {{
                $sidangta->daftarta->mahasiswa->biodata->alamat_kab}}</td>
        </tr>
    </table>

    <table style="width: 655px; border-collapse: collapse;line-height: 20px;margin:10px 13px 0 13px " border="1">
        <tr bgcolor="#f2f2f2">
            <th style="padding: 3px">NO</th>
            <th width="260px">DOKUMEN YANG DIPERLUKAN</th>
            <th style="padding: 3px">ADA</th>
            <th style="padding: 3px">TIDAK</th>
            <th>KETERANGAN</th>
        </tr>
        <tr>
            <td align="center">1</td>
            <td style="padding-left: 3px">FORM S04-PSTI</td>
            <td></td>
            <td></td>
            <td style="padding-left: 3px">Diisi oleh mahasiswa dan din disetor ke TU</td>
        </tr>
        <tr>
            <td align="center">2</td>
            <td style="padding-left: 3px">Kartu Bimbingan kedua pembimbing</td>
            <td></td>
            <td></td>
            <td style="padding-left: 3px">Asli semua disetor dan di arsip oleh TU</td>
        </tr>
        <tr>
            <td align="center">3</td>
            <td style="padding-left: 3px">Slip setoran / bukti transfer BRI</td>
            <td></td>
            <td></td>
            <td style="padding-left: 3px">Asli disetor dan di arsip TU</td>
        </tr>
        <tr>
            <td align="center">4</td>
            <td style="padding-left: 3px">FORM S05-PSTI dan FORM S06-PSTI</td>
            <td></td>
            <td></td>
            <td style="padding-left: 3px">Usul tim penguji. Disisipkan TU dan disampaikan ke ketua program studi</td>
        </tr>
        <tr>
            <td align="center">5</td>
            <td style="padding-left: 3px">Fotokopi KRS</td>
            <td></td>
            <td></td>
            <td style="padding-left: 3px">Dilampirkan</td>
        </tr>
        <tr>
            <td align="center">6</td>
            <td style="padding-left: 3px">Naskah skripsi rangkap 3</td>
            <td></td>
            <td></td>
            <td style="padding-left: 3px">Disetor ke TU untuk didistribusikan ke tim penguji</td>
        </tr>
    </table>

    <footer style="margin-bottom: 220px;margin-left: 440px">
        <table>
            <tr>
                <td>Purworejo,........................</td>
            </tr>
            <tr>
                <td>Tata Usaha Program Studi,</td>
            </tr>
            <tr>
                <td style="height: 60px;"> </td>
            </tr>
            <tr>
                @foreach ($biodata as $user)
                @if ($user->jabatan=="TU")

                <td>{{ $user->nama}}
                </td>
                @endif
                @endforeach
            </tr>
        </table>
    </footer>

</body>
{{-- onload="window.print();" --}}
{{-- <script>
    window.onload = function() {
            var footer3 = document.getElementById("footer3");
            var footer4 = document.getElementById("footer4");
            footer3.style.position = "static"; // Mengubah properti position menjadi "static" pada footer ketiga
            footer4.style.position = "static"; // Mengubah properti position menjadi "static" pada footer ketiga
        };
</script> --}}


<body style="background-color: white; " class="hide-on-print">
    <header style="align:center;">
        <table style="width: 100%;margin-top: -15px">
            <tr>
                <td class="logo">
                    {{-- <span class=" kop-logo"> --}}
                        <img src="data:image/png;base64,{{ base64_encode(file_get_contents('assets/img/logo-biru.png')) }}"
                            width="110px">
                        {{-- </span> --}}
                </td>
                <td>
                    <span class="form-ceklist">
                        <p style="font-size: 15px;color: #002060">UNIVERSITAS MUHAMMADIYAH PURWOREJO
                        </p>
                        <p style="font-size: 15px;font-style: bold;color: #002060">FAKULTAS TEKNIK</p>
                        <p style="font-size: 20px;font-style: bold;color: #002060">PROGRAM STUDI TEKNOLOGI INFORMASI</p>
                        <p style="font-size: 14px;color: black">Jl. KH. Ahmad Dahlan No. 3 Purworejo, Jawa Tengah
                            Indonesia - 54114</p>
                    </span>
                </td>
            </tr>
        </table><br>

    </header>
    <table style="width: 700px;margin-left: 7px; border-collapse: collapse;text-align: left;line-height: 2">
        <tr style="text-align: center;">
            <td colspan="4" style="padding-bottom: 10px"><span style="font-size: 19px;font-style: bold;">
                    <b>BERITA ACARA SIDANG SKRIPSI</b></span>
            </td>
        </tr>
        <tr>
            <td colspan="4" style="padding-top: 10px; ">
                Pada hari ini .................. Tanggal ............. bulan ................................. tahun
                .....................
                telah <br>
                dilakukan
                sidang Skripsi
                mahasiswa:<br>
            </td>
        </tr>
        <tr align="left">
            <td width="100px" style="" align="left" valign="top">Nama / NIM</td>
            <td width="2px" align="left" valign="top">:</td>
            <td colspan="2" style="text-align: left;">{{
                $sidangta->daftarta->mahasiswa->biodata->nama}} / {{
                $sidangta->daftarta->mahasiswa->biodata->no_induk}}</td>

        </tr>
        <tr align="left">
            <td width="100px" style=" " align="left" valign="top">Judul Skripsi</td>
            <td width="2px" align="left" valign="top">:</td>
            <td colspan="2" style="overflow: auto;">{{ $sidangta->judul}}</td>
        </tr>

        <tr>
            <td colspan="4">Catatan setelah sidang Skripsi : </td>

        </tr>
        <tr>
            <td colspan=" 4">
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

    <footer style="line-height: 0;font-family: 'Times New Roman', Times, serif">
        <table style="margin:100px 0px 50px 450px;line-height: 1">
            <tr>
                <td>Mengetahui,</td>

            </tr>
            <tr>
                <td>Penguji Utama</td>
            </tr>
            <tr>
                <td style="height: 60px"></td>
            </tr>
            <tr>
                <td><u>{{ $sidangta->penguji_utama->biodata->nama
                        }}</u>
                </td>
            </tr>
            <tr>
                <td>NIDN.{{ $sidangta->penguji_utama->biodata->no_induk }}</td>
            </tr>
        </table>
        <p style="font-size: 15px;color:#002060;font-style: bold">PROGRAM STUDI TEKNOLOGI INFORMASI</p>
        <p style="font-size: 13px">Telp/Fax (0275) 321494 | Website: www.ti.umpwr.ac.id | Email: ti@umpwr.ac.id</p>
        <p style="font-size: 13px">Facebook: fb.me/pstiumpwr | Instagram: @psti.umpwr</p>
    </footer>

</body>


<body style="background-color: white; " class="hide-on-print">
    <header style="align:center;">
        <table style="width: 100%;margin-top: -15px">
            <tr>
                <td class="logo">
                    {{-- <span class=" kop-logo"> --}}
                        <img src="data:image/png;base64,{{ base64_encode(file_get_contents('assets/img/logo-biru.png')) }}"
                            width="110px">
                        {{-- </span> --}}
                </td>
                <td>
                    <span class="form-ceklist">
                        <p style="font-size: 15px;color: #002060">UNIVERSITAS MUHAMMADIYAH PURWOREJO
                        </p>
                        <p style="font-size: 15px;font-style: bold;color: #002060">FAKULTAS TEKNIK</p>
                        <p style="font-size: 20px;font-style: bold;color: #002060">PROGRAM STUDI TEKNOLOGI INFORMASI</p>
                        <p style="font-size: 14px;color: black">Jl. KH. Ahmad Dahlan No. 3 Purworejo, Jawa Tengah
                            Indonesia - 54114</p>
                    </span>
                </td>
            </tr>
        </table><br>

    </header>
    <table style="width: 700px;margin-left: 7px; border-collapse: collapse;text-align: left;line-height: 2">
        <tr style="text-align: center;">
            <td colspan="4" style="padding-bottom: 10px"><span style="font-size: 19px;font-style: bold;">
                    <b>BERITA ACARA SIDANG SKRIPSI</b></span>
            </td>
        </tr>
        <tr>
            <td colspan="4" style="padding-top: 10px; ">
                Pada hari ini .................. Tanggal ............. bulan ................................. tahun
                .....................
                telah <br>
                dilakukan
                sidang Skripsi
                mahasiswa:<br>
            </td>
        </tr>
        <tr align="left">
            <td width=" 100px" style="" align="left" valign="top">Nama / NIM</td>
            <td width="2px" align="left" valign="top">:</td>
            <td colspan="2" style="text-align: left;">{{
                $sidangta->daftarta->mahasiswa->biodata->nama}} / {{
                $sidangta->daftarta->mahasiswa->biodata->no_induk}}</td>

        </tr>
        <tr align="left">
            <td width="100px" style=" " align="left" valign="top">Judul Skripsi</td>
            <td width="2px" align="left" valign="top">:</td>
            <td colspan="2" style="overflow: auto;">{{ $sidangta->judul}}</td>
        </tr>

        <tr>
            <td colspan="4">Catatan setelah sidang Skripsi : </td>

        </tr>
        <tr>
            <td colspan=" 4">
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

    <footer style="line-height: 0;font-family: 'Times New Roman', Times, serif">
        <table style="margin:100px 0px 50px 450px;line-height: 1">
            <tr>
                <td>Mengetahui,</td>

            </tr>
            <tr>
                <td>Ketua Sidang / Pembimbing I</td>
            </tr>
            <tr>
                <td style="height: 60px"></td>
            </tr>
            <tr>
                <td><u>{{ $sidangta->daftarta->dosen1->biodata->nama
                        }}</u>
                </td>
            </tr>
            <tr>
                <td>NIDN.{{ $sidangta->daftarta->dosen1->biodata->no_induk }}</td>
            </tr>
        </table>
        <p style="font-size: 15px;color:#002060;font-style: bold">PROGRAM STUDI TEKNOLOGI INFORMASI</p>
        <p style="font-size: 13px">Telp/Fax (0275) 321494 | Website: www.ti.umpwr.ac.id | Email: ti@umpwr.ac.id</p>
        <p style="font-size: 13px">Facebook: fb.me/pstiumpwr | Instagram: @psti.umpwr</p>
    </footer>

</body>

<body style="background-color: white; " class="hide-on-print">
    <header style="align:center;">
        <table style="width: 100%;margin-top: -15px">
            <tr>
                <td class="logo">
                    {{-- <span class=" kop-logo"> --}}
                        <img src="data:image/png;base64,{{ base64_encode(file_get_contents('assets/img/logo-biru.png')) }}"
                            width="110px">
                        {{-- </span> --}}
                </td>
                <td>
                    <span class="form-ceklist">
                        <p style="font-size: 15px;color: #002060">UNIVERSITAS MUHAMMADIYAH PURWOREJO
                        </p>
                        <p style="font-size: 15px;font-style: bold;color: #002060">FAKULTAS TEKNIK</p>
                        <p style="font-size: 20px;font-style: bold;color: #002060">PROGRAM STUDI TEKNOLOGI INFORMASI</p>
                        <p style="font-size: 14px;color: black">Jl. KH. Ahmad Dahlan No. 3 Purworejo, Jawa Tengah
                            Indonesia - 54114</p>
                    </span>
                </td>
            </tr>
        </table><br>

    </header>
    <table style="width: 700px;margin-left: 7px; border-collapse: collapse;text-align: left;line-height: 2">
        <tr style="text-align: center;">
            <td colspan="4" style="padding-bottom: 10px"><span style="font-size: 19px;font-style: bold;">
                    <b>BERITA ACARA SIDANG SKRIPSI</b></span>
            </td>
        </tr>
        <tr>
            <td colspan="4" style="padding-top: 10px; ">
                Pada hari ini .................. Tanggal ............. bulan ................................. tahun
                .....................
                telah <br>
                dilakukan
                sidang Skripsi
                mahasiswa:<br>
            </td>
        </tr>
        <tr align="left">
            <td width=" 100px" style="" align="left" valign="top">Nama / NIM</td>
            <td width="2px" align="left" valign="top">:</td>
            <td colspan="2" style="text-align: left;">{{
                $sidangta->daftarta->mahasiswa->biodata->nama}} / {{
                $sidangta->daftarta->mahasiswa->biodata->no_induk}}</td>

        </tr>
        <tr align="left">
            <td width="100px" style=" " align="left" valign="top">Judul Skripsi</td>
            <td width="2px" align="left" valign="top">:</td>
            <td colspan="2" style="overflow: auto;">{{ $sidangta->judul}}</td>
        </tr>

        <tr>
            <td colspan="4">Catatan setelah sidang Skripsi : </td>

        </tr>
        <tr>
            <td colspan=" 4">
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

    <footer style="line-height: 0;font-family: 'Times New Roman', Times, serif">
        <table style="margin:100px 0px 50px 450px;line-height: 1">
            <tr>
                <td>Mengetahui,</td>

            </tr>
            <tr>
                <td>Penguji I / Pembimbing II</td>
            </tr>
            <tr>
                <td style="height: 60px"></td>
            </tr>
            <tr>
                <td><u>{{ $sidangta->daftarta->dosen2->biodata->nama
                        }}</u>
                </td>
            </tr>
            <tr>
                <td>NIDN.{{ $sidangta->daftarta->dosen2->biodata->no_induk }}</td>
            </tr>
        </table>
        <p style="font-size: 15px;color:#002060;font-style: bold">PROGRAM STUDI TEKNOLOGI INFORMASI</p>
        <p style="font-size: 13px">Telp/Fax (0275) 321494 | Website: www.ti.umpwr.ac.id | Email: ti@umpwr.ac.id</p>
        <p style="font-size: 13px">Facebook: fb.me/pstiumpwr | Instagram: @psti.umpwr</p>
    </footer>

</body>

<body style="background-color: white; " class="hide-on-print">
    <header style="align:center;">
        <table style="width: 100%;margin-top: -15px">
            <tr>
                <td class="logo">
                    {{-- <span class=" kop-logo"> --}}
                        <img src="data:image/png;base64,{{ base64_encode(file_get_contents('assets/img/logo-biru.png')) }}"
                            width="110px">
                        {{-- </span> --}}
                </td>
                <td>
                    <span class="form-ceklist">
                        <p style="font-size: 15px;color: #002060">UNIVERSITAS MUHAMMADIYAH PURWOREJO
                        </p>
                        <p style="font-size: 15px;font-style: bold;color: #002060">FAKULTAS TEKNIK</p>
                        <p style="font-size: 20px;font-style: bold;color: #002060">PROGRAM STUDI TEKNOLOGI INFORMASI</p>
                        <p style="font-size: 14px;color: black">Jl. KH. Ahmad Dahlan No. 3 Purworejo, Jawa Tengah
                            Indonesia - 54114</p>
                    </span>
                </td>
            </tr>
        </table><br>

    </header>
    <table style="width: 700px;margin-left: 7px; border-collapse: collapse;text-align: left;line-height: 1.5">
        <tr style="text-align: center;">
            <td colspan="4" style="padding-bottom: 10px"><span style="font-size: 19px;font-style: bold;">
                    <b>FORM PENILAIAN SIDANG SKRIPSI</b></span>
            </td>
        </tr>
        <tr>
            <td colspan="4" style="padding-top: 10px; ">
                Pada hari ini .................. Tanggal ............. bulan ................................. tahun
                .....................
                telah <br>
                dilakukan
                sidang Skripsi
                mahasiswa:<br>
            </td>
        </tr>
        <tr align="left">
            <td width=" 100px" style="" align="left" valign="top">Nama / NIM</td>
            <td width="2px" align="left" valign="top">:</td>
            <td colspan="2" style="text-align: left;">{{
                $sidangta->daftarta->mahasiswa->biodata->nama}} / {{
                $sidangta->daftarta->mahasiswa->biodata->no_induk}}</td>

        </tr>
        <tr align="left" style="line-height: 1">
            <td width="100px" style=" " align="left" valign="top">Judul Skripsi</td>
            <td width="2px" align="left" valign="top">:</td>
            <td colspan="2" style="overflow: auto;">{{ $sidangta->judul}}</td>
        </tr>

    </table>
    <h4 style="margin-left: 5px;margin-bottom: 0px">A. Aspek Penilain Produk</h4>

    <table style="width: 700px; border-collapse: collapse;line-height: 25px" border="1">
        <tr>
            <th width="40px" align="center">NO.</th>
            <th width="500px" align="center">Aspek Yang Dinilai</th>
            <th align="center">Nilai angka 0 - 25</th>
        </tr>
        <tr bgcolor="#f2f2f2">
            <td align="center">1.</td>
            <td style="padding-left: 10px">Tingkat kesulitan</td>
            <td></td>
        </tr>
        <tr>
            <td align="center">2.</td>
            <td style="padding-left: 10px">Keterkaitan laporan dan produk</td>
            <td></td>
        </tr>
        <tr bgcolor="#f2f2f2">
            <td align="center">3.</td>
            <td style="padding-left: 10px">Keterbaruan Produk</td>
            <td></td>
        </tr>
        <tr>
            <td align="center">4.</td>
            <td style="padding-left: 10px">Kegunaan di Masyarakat / Stakeholder / Instansi</td>
            <td></td>
        </tr>
    </table>

    <h4 style="margin-left: 5px;margin-bottom: 0px">B. Aspek Penilain Presentasi</h4>

    <table style="width: 700px; border-collapse: collapse;line-height: 25px" border="1">
        <tr>
            <th width="40px" align="center">NO.</th>
            <th width="500px" align="center">Aspek Yang Dinilai</th>
            <th align="center">Nilai angka 0 - 25</th>
        </tr>
        <tr bgcolor="#f2f2f2">
            <td align="center">1.</td>
            <td style="padding-left: 10px">Penampilan</td>
            <td></td>
        </tr>
        <tr>
            <td align="center">2.</td>
            <td style="padding-left: 10px">Penyajian isi Laporan</td>
            <td></td>
        </tr>
        <tr bgcolor="#f2f2f2">
            <td align="center">3.</td>
            <td style="padding-left: 10px">Penguasaan Materi</td>
            <td></td>
        </tr>
        <tr>
            <td align="center">4.</td>
            <td style="padding-left: 10px">Mutu Jawaban</td>
            <td></td>
        </tr>
    </table>
    <br>
    <table style="width: 700px; border-collapse: collapse;line-height: 25px" border="1">
        <tr>
            <th>Nilai Angka Total = ( A + B ) / 2</th>
            <th width="150px"></th>
        </tr>
    </table>

    <footer style="line-height: 0;font-family: 'Times New Roman', Times, serif">
        <table style="margin:100px 0px 50px 450px;line-height: 1">
            <tr>
                <td>Mengetahui,</td>

            </tr>
            <tr>
                <td>Penguji Utama</td>
            </tr>
            <tr>
                <td style="height: 60px"></td>
            </tr>
            <tr>
                <td><u>{{ $sidangta->penguji_utama->biodata->nama
                        }}</u>
                </td>
            </tr>
            <tr>
                <td>NIDN.{{ $sidangta->penguji_utama->biodata->no_induk }}</td>
            </tr>
        </table>
        <p style="font-size: 15px;color:#002060;font-style: bold">PROGRAM STUDI TEKNOLOGI INFORMASI</p>
        <p style="font-size: 13px">Telp/Fax (0275) 321494 | Website: www.ti.umpwr.ac.id | Email: ti@umpwr.ac.id</p>
        <p style="font-size: 13px">Facebook: fb.me/pstiumpwr | Instagram: @psti.umpwr</p>
    </footer>

</body>

<body style="background-color: white; " class="hide-on-print">
    <header style="align:center;">
        <table style="width: 100%;margin-top: -15px">
            <tr>
                <td class="logo">
                    {{-- <span class=" kop-logo"> --}}
                        <img src="data:image/png;base64,{{ base64_encode(file_get_contents('assets/img/logo-biru.png')) }}"
                            width="110px">
                        {{-- </span> --}}
                </td>
                <td>
                    <span class="form-ceklist">
                        <p style="font-size: 15px;color: #002060">UNIVERSITAS MUHAMMADIYAH PURWOREJO
                        </p>
                        <p style="font-size: 15px;font-style: bold;color: #002060">FAKULTAS TEKNIK</p>
                        <p style="font-size: 20px;font-style: bold;color: #002060">PROGRAM STUDI TEKNOLOGI INFORMASI</p>
                        <p style="font-size: 14px;color: black">Jl. KH. Ahmad Dahlan No. 3 Purworejo, Jawa Tengah
                            Indonesia - 54114</p>
                    </span>
                </td>
            </tr>
        </table><br>

    </header>
    <table style="width: 700px;margin-left: 7px; border-collapse: collapse;text-align: left;line-height: 1.5">
        <tr style="text-align: center;">
            <td colspan="4" style="padding-bottom: 10px"><span style="font-size: 19px;font-style: bold;">
                    <b>FORM PENILAIAN SIDANG SKRIPSI</b></span>
            </td>
        </tr>
        <tr>
            <td colspan="4" style="padding-top: 10px; ">
                Pada hari ini .................. Tanggal ............. bulan ................................. tahun
                .....................
                telah <br>
                dilakukan
                sidang Skripsi
                mahasiswa:<br>
            </td>
        </tr>
        <tr align="left">
            <td width=" 100px" style="" align="left" valign="top">Nama / NIM</td>
            <td width="2px" align="left" valign="top">:</td>
            <td colspan="2" style="text-align: left;">{{
                $sidangta->daftarta->mahasiswa->biodata->nama}} / {{
                $sidangta->daftarta->mahasiswa->biodata->no_induk}}</td>

        </tr>
        <tr align="left" style="line-height: 1">
            <td width="100px" style=" " align="left" valign="top">Judul Skripsi</td>
            <td width="2px" align="left" valign="top">:</td>
            <td colspan="2" style="overflow: auto;">{{ $sidangta->judul}}</td>
        </tr>

    </table>
    <h4 style="margin-left: 5px;margin-bottom: 0px">A. Aspek Penilain Produk</h4>

    <table style="width: 700px; border-collapse: collapse;line-height: 25px" border="1">
        <tr>
            <th width="40px" align="center">NO.</th>
            <th width="500px" align="center">Aspek Yang Dinilai</th>
            <th align="center">Nilai angka 0 - 25</th>
        </tr>
        <tr bgcolor="#f2f2f2">
            <td align="center">1.</td>
            <td style="padding-left: 10px">Tingkat kesulitan</td>
            <td></td>
        </tr>
        <tr>
            <td align="center">2.</td>
            <td style="padding-left: 10px">Keterkaitan laporan dan produk</td>
            <td></td>
        </tr>
        <tr bgcolor="#f2f2f2">
            <td align="center">3.</td>
            <td style="padding-left: 10px">Keterbaruan Produk</td>
            <td></td>
        </tr>
        <tr>
            <td align="center">4.</td>
            <td style="padding-left: 10px">Kegunaan di Masyarakat / Stakeholder / Instansi</td>
            <td></td>
        </tr>
    </table>

    <h4 style="margin-left: 5px;margin-bottom: 0px">B. Aspek Penilain Presentasi</h4>

    <table style="width: 700px; border-collapse: collapse;line-height: 25px" border="1">
        <tr>
            <th width="40px" align="center">NO.</th>
            <th width="500px" align="center">Aspek Yang Dinilai</th>
            <th align="center">Nilai angka 0 - 25</th>
        </tr>
        <tr bgcolor="#f2f2f2">
            <td align="center">1.</td>
            <td style="padding-left: 10px">Penampilan</td>
            <td></td>
        </tr>
        <tr>
            <td align="center">2.</td>
            <td style="padding-left: 10px">Penyajian isi Laporan</td>
            <td></td>
        </tr>
        <tr bgcolor="#f2f2f2">
            <td align="center">3.</td>
            <td style="padding-left: 10px">Penguasaan Materi</td>
            <td></td>
        </tr>
        <tr>
            <td align="center">4.</td>
            <td style="padding-left: 10px">Mutu Jawaban</td>
            <td></td>
        </tr>
    </table>
    <br>
    <table style="width: 700px; border-collapse: collapse;line-height: 25px" border="1">
        <tr>
            <th>Nilai Angka Total = ( A + B ) / 2</th>
            <th width="150px"></th>
        </tr>
    </table>

    <footer style="line-height: 0;font-family: 'Times New Roman', Times, serif">
        <table style="margin:100px 0px 50px 450px;line-height: 1">
            <tr>
                <td>Mengetahui,</td>

            </tr>
            <tr>
                <td>Ketua Sidang / Pembimbing I</td>
            </tr>
            <tr>
                <td style="height: 60px"></td>
            </tr>
            <tr>
                <td><u>{{ $sidangta->daftarta->dosen1->biodata->nama
                        }}</u>
                </td>
            </tr>
            <tr>
                <td>NIDN.{{ $sidangta->daftarta->dosen1->biodata->no_induk }}</td>
            </tr>
        </table>
        <p style="font-size: 15px;color:#002060;font-style: bold">PROGRAM STUDI TEKNOLOGI INFORMASI</p>
        <p style="font-size: 13px">Telp/Fax (0275) 321494 | Website: www.ti.umpwr.ac.id | Email: ti@umpwr.ac.id</p>
        <p style="font-size: 13px">Facebook: fb.me/pstiumpwr | Instagram: @psti.umpwr</p>
    </footer>

</body>

<body style="background-color: white; " class="hide-on-print">
    <header style="align:center;">
        <table style="width: 100%;margin-top: -15px">
            <tr>
                <td class="logo">
                    {{-- <span class=" kop-logo"> --}}
                        <img src="data:image/png;base64,{{ base64_encode(file_get_contents('assets/img/logo-biru.png')) }}"
                            width="110px">
                        {{-- </span> --}}
                </td>
                <td>
                    <span class="form-ceklist">
                        <p style="font-size: 15px;color: #002060">UNIVERSITAS MUHAMMADIYAH PURWOREJO
                        </p>
                        <p style="font-size: 15px;font-style: bold;color: #002060">FAKULTAS TEKNIK</p>
                        <p style="font-size: 20px;font-style: bold;color: #002060">PROGRAM STUDI TEKNOLOGI INFORMASI</p>
                        <p style="font-size: 14px;color: black">Jl. KH. Ahmad Dahlan No. 3 Purworejo, Jawa Tengah
                            Indonesia - 54114</p>
                    </span>
                </td>
            </tr>
        </table><br>

    </header>
    <table style="width: 700px;margin-left: 7px; border-collapse: collapse;text-align: left;line-height: 1.5">
        <tr style="text-align: center;">
            <td colspan="4" style="padding-bottom: 10px"><span style="font-size: 19px;font-style: bold;">
                    <b>FORM PENILAIAN SIDANG SKRIPSI</b></span>
            </td>
        </tr>
        <tr>
            <td colspan="4" style="padding-top: 10px; ">
                Pada hari ini .................. Tanggal ............. bulan ................................. tahun
                .....................
                telah <br>
                dilakukan
                sidang Skripsi
                mahasiswa:<br>
            </td>
        </tr>
        <tr align="left">
            <td width=" 100px" style="" align="left" valign="top">Nama / NIM</td>
            <td width="2px" align="left" valign="top">:</td>
            <td colspan="2" style="text-align: left;">{{
                $sidangta->daftarta->mahasiswa->biodata->nama}} / {{
                $sidangta->daftarta->mahasiswa->biodata->no_induk}}</td>

        </tr>
        <tr align="left" style="line-height: 1">
            <td width="100px" style=" " align="left" valign="top">Judul Skripsi</td>
            <td width="2px" align="left" valign="top">:</td>
            <td colspan="2" style="overflow: auto;">{{ $sidangta->judul}}</td>
        </tr>

    </table>
    <h4 style="margin-left: 5px;margin-bottom: 0px">A. Aspek Penilain Produk</h4>

    <table style="width: 700px; border-collapse: collapse;line-height: 25px" border="1">
        <tr>
            <th width="40px" align="center">NO.</th>
            <th width="500px" align="center">Aspek Yang Dinilai</th>
            <th align="center">Nilai angka 0 - 25</th>
        </tr>
        <tr bgcolor="#f2f2f2">
            <td align="center">1.</td>
            <td style="padding-left: 10px">Tingkat kesulitan</td>
            <td></td>
        </tr>
        <tr>
            <td align="center">2.</td>
            <td style="padding-left: 10px">Keterkaitan laporan dan produk</td>
            <td></td>
        </tr>
        <tr bgcolor="#f2f2f2">
            <td align="center">3.</td>
            <td style="padding-left: 10px">Keterbaruan Produk</td>
            <td></td>
        </tr>
        <tr>
            <td align="center">4.</td>
            <td style="padding-left: 10px">Kegunaan di Masyarakat / Stakeholder / Instansi</td>
            <td></td>
        </tr>
    </table>

    <h4 style="margin-left: 5px;margin-bottom: 0px">B. Aspek Penilain Presentasi</h4>

    <table style="width: 700px; border-collapse: collapse;line-height: 25px" border="1">
        <tr>
            <th width="40px" align="center">NO.</th>
            <th width="500px" align="center">Aspek Yang Dinilai</th>
            <th align="center">Nilai angka 0 - 25</th>
        </tr>
        <tr bgcolor="#f2f2f2">
            <td align="center">1.</td>
            <td style="padding-left: 10px">Penampilan</td>
            <td></td>
        </tr>
        <tr>
            <td align="center">2.</td>
            <td style="padding-left: 10px">Penyajian isi Laporan</td>
            <td></td>
        </tr>
        <tr bgcolor="#f2f2f2">
            <td align="center">3.</td>
            <td style="padding-left: 10px">Penguasaan Materi</td>
            <td></td>
        </tr>
        <tr>
            <td align="center">4.</td>
            <td style="padding-left: 10px">Mutu Jawaban</td>
            <td></td>
        </tr>
    </table>
    <br>
    <table style="width: 700px; border-collapse: collapse;line-height: 25px" border="1">
        <tr>
            <th>Nilai Angka Total = ( A + B ) / 2</th>
            <th width="150px"></th>
        </tr>
    </table>

    <footer style="line-height: 0;font-family: 'Times New Roman', Times, serif">
        <table style="margin:100px 0px 50px 450px;line-height: 1">
            <tr>
                <td>Mengetahui,</td>

            </tr>
            <tr>
                <td>Ketua Sidang / Pembimbing II</td>
            </tr>
            <tr>
                <td style="height: 60px"></td>
            </tr>
            <tr>
                <td><u>{{ $sidangta->daftarta->dosen2->biodata->nama
                        }}</u>
                </td>
            </tr>
            <tr>
                <td>NIDN.{{ $sidangta->daftarta->dosen2->biodata->no_induk }}</td>
            </tr>
        </table>
        <p style="font-size: 15px;color:#002060;font-style: bold">PROGRAM STUDI TEKNOLOGI INFORMASI</p>
        <p style="font-size: 13px">Telp/Fax (0275) 321494 | Website: www.ti.umpwr.ac.id | Email: ti@umpwr.ac.id</p>
        <p style="font-size: 13px">Facebook: fb.me/pstiumpwr | Instagram: @psti.umpwr</p>
    </footer>

</body>

{{-- REKAPITULASI NILAI SIDANG --}}

<body style="background-color: white; " class="hide-on-print">
    <header style="align:center;">
        <table style="width: 100%;margin-top: -15px">
            <tr>
                <td class="logo">
                    {{-- <span class=" kop-logo"> --}}
                        <img src="data:image/png;base64,{{ base64_encode(file_get_contents('assets/img/logo-biru.png')) }}"
                            width="110px">
                        {{-- </span> --}}
                </td>
                <td>
                    <span class="form-ceklist">
                        <p style="font-size: 15px;color: #002060">UNIVERSITAS MUHAMMADIYAH PURWOREJO
                        </p>
                        <p style="font-size: 15px;font-style: bold;color: #002060">FAKULTAS TEKNIK</p>
                        <p style="font-size: 20px;font-style: bold;color: #002060">PROGRAM STUDI TEKNOLOGI INFORMASI</p>
                        <p style="font-size: 14px;color: black">Jl. KH. Ahmad Dahlan No. 3 Purworejo, Jawa Tengah
                            Indonesia - 54114</p>
                    </span>
                </td>
            </tr>
        </table><br>

    </header>
    <table
        style="width: 700px;margin-left: 7px;margin-bottom: 10px; border-collapse: collapse;text-align: left;line-height: 1.5">
        <tr style="text-align: center;">
            <td colspan="4" style="padding-bottom: 10px">
                <span style="font-size: 19px;font-style: bold;">
                    <b>REKAPITULASI NILAI SIDANG SKRIPSI</b> </span>
            </td>
        </tr>
        <tr height="60px" style="text-align: center">
            <td colspan="4" style="padding-bottom: 30px">
                <span
                    style="font-size: 19px;font-style: bold;border:2px solid black;outline: 4px solid black;outline-offset: 2px;padding: 5px">
                    <b>NILAI AKHIR
                </span>
            </td>
        </tr>
        <tr align="left">
            <td width="100px" style="" align="left" valign="top"><b>Nama / NIM</b></td>
            <td width="2px" align="left" valign="top">:</td>
            <td colspan="2" style="text-align: left;">{{
                $sidangta->daftarta->mahasiswa->biodata->nama}} / {{
                $sidangta->daftarta->mahasiswa->biodata->no_induk}}</td>

        </tr>
    </table>
    <h4 style="margin-left: 5px;margin-bottom: 0px">a. Nilai Angka</h4>

    <table style="width: 600px; border-collapse: collapse;line-height: 25px;margin-left: 50px" border="1">
        <tr>
            <th width="40px" align="center">NO.</th>
            <th width="400px" align="center">Tim Penguji Skripsi </th>
            <th align="center">Nilai </th>
        </tr>
        <tr bgcolor="#f2f2f2">
            <td align="center">1.</td>
            <td style="padding-left: 10px">Penguji Utama : <br>
                {{ $sidangta->penguji_utama->biodata->nama }}</td>
            <td style="padding-left: 10px"></td>
        </tr>
        <tr>
            <td align="center">2.</td>
            <td style="padding-left: 10px">Ketua Sidang / Pembimbing I : <br> {{
                $sidangta->daftarta->dosen1->biodata->nama }}</td>
            <td style="padding-left: 10px"></td>
        </tr>
        <tr bgcolor="#f2f2f2">
            <td align="center">3.</td>
            <td style="padding-left: 10px">Penguji I / Pembimbing II : <br> {{
                $sidangta->daftarta->dosen2->biodata->nama }}</td>
            <td style="padding-left: 10px"></td>
        </tr>
        <tr>
            <td align="center"></td>
            <td style="padding-left: 10px"><b>Jumlah Nilai di bagi 3</b></td>
            <td></td>
        </tr>
    </table>

    <h4 style="margin-left: 5px;margin-bottom: 0px">b. Nilai Huruf</h4>

    <table style="width: 600px; border-collapse: collapse;line-height: 25px;margin-left: 50px" border="1">
        <tr>
            <th align="center"><b>A</b></th>
            <th align="center"><b>A-</b></th>
            <th align="center"><b>B+</b></th>
            <th align="center"><b>B</b></th>
            <th align="center"><b>B-</b></th>
            <th align="center"><b>C+</b></th>
            <th align="center"><b>C</b></th>

        </tr>

    </table>
    <br>
    <table style="width: 700px; border-collapse: collapse;line-height: 25px;margin-left: 50px">
        <tr>
            <td align="left"><b>Keterangan :</b></td>
        </tr>
        <tr>
            <td align="left">86,00 – 99,99 = A</td>
        </tr>
        <tr>
            <td align="left">81,00 – 85,99 = A-</td>
        </tr>
        <tr>
            <td align="left">76,00 – 80,99 = B+</td>
        </tr>
        <tr>
            <td align="left">71,00 – 75,99 = B</td>
        </tr>
        <tr>
            <td align="left">66,00 – 70,99 = B-</td>
        </tr>
        <tr>
            <td align="left">61,00 – 65,99 = C+</td>
        </tr>
        <tr>
            <td align="left">56,00 – 60,99 = C</td>
        </tr>
        <tr>
            <td><b>*lingkari nilai huruf yang sesuai dengan nilai angka</b></td>
        </tr>
    </table>

    <footer style="line-height: 0;font-family: 'Times New Roman', Times, serif">
        <p style="font-size: 15px;color:#002060;font-style: bold">PROGRAM STUDI TEKNOLOGI INFORMASI</p>
        <p style="font-size: 13px">Telp/Fax (0275) 321494 | Website: www.ti.umpwr.ac.id | Email: ti@umpwr.ac.id</p>
        <p style="font-size: 13px">Facebook: fb.me/pstiumpwr | Instagram: @psti.umpwr</p>
    </footer>

</body>

{{-- PRESENSI KEHADIRAN --}}

<body style="background-color: white; " class="hide-on-print">
    <header style="align:center;">
        <table style="width: 100%;margin-top: -15px">
            <tr>
                <td class="logo">
                    {{-- <span class=" kop-logo"> --}}
                        <img src="data:image/png;base64,{{ base64_encode(file_get_contents('assets/img/logo-biru.png')) }}"
                            width="110px">
                        {{-- </span> --}}
                </td>
                <td>
                    <span class="form-ceklist">
                        <p style="font-size: 15px;color: #002060">UNIVERSITAS MUHAMMADIYAH PURWOREJO
                        </p>
                        <p style="font-size: 15px;font-style: bold;color: #002060">FAKULTAS TEKNIK</p>
                        <p style="font-size: 20px;font-style: bold;color: #002060">PROGRAM STUDI TEKNOLOGI INFORMASI</p>
                        <p style="font-size: 14px;color: black">Jl. KH. Ahmad Dahlan No. 3 Purworejo, Jawa Tengah
                            Indonesia - 54114</p>
                    </span>
                </td>
            </tr>
        </table><br>

    </header>
    <table
        style="width: 700px;margin-left: 7px;margin-bottom: 10px; border-collapse: collapse;text-align: left;line-height: 2">
        <tr style="text-align: center;">
            <td colspan="4" style="padding-bottom: 10px">
                <span style="font-size: 19px;font-style: bold;">
                    <b>PRESENSI KEHADIRAN SIDANG SKRIPSI</b> </span>
            </td>
        </tr>
        <tr align="left">
            <td width="100px" style="" align="left" valign="top">Hari, Tanggal </td>
            <td>:</td>
        </tr>
        <tr align="left">
            <td width="100px" style="" align="left" valign="top">Waktu </td>
            <td>:</td>
        </tr>
    </table>

    <table style="width: 600px; border-collapse: collapse;line-height: 25px;margin-left: 50px" border="1">
        <tr>
            <th width="40px" align="center">NO.</th>
            <th width="400px" align="center">Tim Penguji Skripsi </th>
            <th align="center">TTD</th>
        </tr>
        <tr bgcolor="#f2f2f2">
            <td align="center">1.</td>
            <td style="padding-left: 10px">Penguji Utama : <br>
                {{ $sidangta->penguji_utama->biodata->nama }}</td>
            <td style="padding-left: 10px"></td>
        </tr>
        <tr>
            <td align="center">2.</td>
            <td style="padding-left: 10px">Ketua Sidang / Pembimbing I : <br> {{
                $sidangta->daftarta->dosen1->biodata->nama }}</td>
            <td style="padding-left: 10px"></td>
        </tr>
        <tr bgcolor="#f2f2f2">
            <td align="center">3.</td>
            <td style="padding-left: 10px">Penguji I / Pembimbing II : <br> {{
                $sidangta->daftarta->dosen2->biodata->nama }}</td>
            <td style="padding-left: 10px"></td>
        </tr>
        <tr>
            <td align="center">4.</td>
            <td style="padding-left: 10px">Mahasiswa <br> {{ $sidangta->daftarta->mahasiswa->biodata->nama }}</td>
            <td style="padding-left: 10px"></td>
        </tr>
    </table>

    <table style="margin:100px 0px 50px 450px;line-height: 1">
        <tr>
            <td>Ketua Program Studi,</td>
        </tr>
        <tr>
            <td style="height: 60px"></td>
        </tr>
        <tr>
            @foreach ($biodata as $user)
            @if ($user->jabatan=="kaprodi")

            <td>
                <u>
                    {{ $user->nama}}
                </u>
            </td>
            @endif
            @endforeach
        </tr>
        <tr>
            @foreach ($biodata as $user)
            @if ($user->jabatan=="kaprodi")

            <td>
                0{{ $user->no_induk}}
            </td>
            @endif
            @endforeach
        </tr>
    </table>

    <footer style="line-height: 0;font-family: 'Times New Roman', Times, serif">
        <p style="font-size: 15px;color:#002060;font-style: bold">PROGRAM STUDI TEKNOLOGI INFORMASI</p>
        <p style="font-size: 13px">Telp/Fax (0275) 321494 | Website: www.ti.umpwr.ac.id | Email: ti@umpwr.ac.id</p>
        <p style="font-size: 13px">Facebook: fb.me/pstiumpwr | Instagram: @psti.umpwr</p>
    </footer>

</body>


</html>