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

    .footer {
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

    .form-ceklist {
        text-align: left;
        line-height: 0.5;
        margin-right: 200px;
        margin-left: 15px;
    }

    .logo {
        padding-left: 5px;
    }
</style>

{{-- onload="window.print();" --}}
<script>
    window.onload = function() {
            var footer3 = document.getElementById("footer3");
            var footer4 = document.getElementById("footer4");
            footer3.style.position = "static"; // Mengubah properti position menjadi "static" pada footer ketiga
            footer4.style.position = "static"; // Mengubah properti position menjadi "static" pada footer ketiga
        };
</script>

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
            <td width="200px" style="line-height: 1.6;" align="left" valign="top">Nama / NIM</td>
            <td width="2px" align="left" valign="top">:</td>
            <td colspan="2" style="text-align: left;">{{
                $seminarkp->daftarkp->mahasiswa->biodata->nama}} / {{
                $seminarkp->daftarkp->mahasiswa->biodata->no_induk}}</td>

        </tr>
        <tr align="left">
            <td width="200px" style="line-height: 1.6; " align="left" valign="top">Judul KP</td>
            <td width="2px" align="left" valign="top">:</td>
            <td colspan="2" style="overflow: auto;">{{ $seminarkp->judul}}</td>
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
        {{-- <tr>
            <td colspan="4">
                <p class="underline"></p>
            </td>
        </tr>
        <tr>
            <td colspan="4">
                <p class="underline"></p>
            </td>
        </tr> --}}

    </table>
    <!--</div>-->
    <footer class="footer">
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

{{-- FORM PENILAIAN SEMINAR KP --}}

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
                    FORM PENILAIAN SEMINAR KERJA PRAKTIK</span>
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
            <td width="200px" style="line-height: 1.6;" align="left" valign="top">Nama / NIM</td>
            <td width="2px" align="left" valign="top">:</td>
            <td colspan="2" style="text-align: left;">{{
                $seminarkp->daftarkp->mahasiswa->biodata->nama}} / {{
                $seminarkp->daftarkp->mahasiswa->biodata->no_induk}}</td>

        </tr>
        <tr align="left">
            <td width="200px" style="line-height: 1.6; " align="left" valign="top">Judul KP</td>
            <td width="2px" align="left" valign="top">:</td>
            <td colspan="2" style="overflow: auto;">{{ $seminarkp->judul}}</td>
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

    <h4 style="margin-left: 5px;margin-bottom: 0px">A. Aspek Penilain Presentasi</h4>

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

    <footer class="footer">
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

{{-- form ceklist --}}

<body style="background-color: white; border:1px solid black" class="hide-on-print">
    <header style="align:center;">
        <table style="width: 100%;margin-top: -15px">
            <tr>
                <td class="logo">
                    {{-- <span class=" kop-logo"> --}}
                        <img src="data:image/png;base64,{{ base64_encode(file_get_contents('assets/img/logo.jpeg')) }}"
                            width="80px">
                        {{-- </span> --}}
                </td>
                <td style="padding-top: 20px">
                    <span class="form-ceklist">
                        <p style="font-size: 15px;font-style: bold">PROGRAM STUDI TEKNOLOGI INFFORMASI</p>
                        <p style="font-size: 14px;">FAKULTAS TEKNIK</p>
                        <p style="font-size: 14px;">UNIVERSITAS MUHAMMADIYAH PUREWOREJO</p>
                    </span>
                </td>
                <td width="200px">
                    <p style="font-size: 20px;font-style: bold">FORM KP02-PSTI</p>
                    <p style="font-size: 15px;margin-top: -10px">REV: 12 JANUARI 2021</p>
                </td>
            </tr>
        </table><br>
        <hr style="border: 1px solid black;margin-top: -32px;width: 722px">
    </header>
    <!--<div class="content">-->
    <table style="width: 700px;margin-left: 7px;margin-top:-20px; border-collapse: collapse;text-align: left;">
        <tr style="text-align: center;">
            <td style="padding-bottom: 10px"><span style="font-size: 19px;font-style: bold;">
                    <b><u>LEMBAR CEKLIST SEMINAR KERJA PRAKTIK</u></b></span>
            </td>
        </tr>
    </table>
    <table style="margin-left: 20px">
        <tr>
            <td width="150px">NIM / Nama Mhs</td>
            <td>:</td>
            <td>{{
                $seminarkp->daftarkp->mahasiswa->biodata->no_induk}} / {{
                $seminarkp->daftarkp->mahasiswa->biodata->nama}}</td>
        </tr>
        <tr>
            <td>Email / Hp Aktif</td>
            <td>:</td>
            <td>{{
                $seminarkp->daftarkp->mahasiswa->biodata->email}} / {{
                $seminarkp->daftarkp->mahasiswa->biodata->no_telp}}</td>
        </tr>
        <tr>
            <td align="left" valign="top">Alamat Tinggal</td>
            <td align="left" valign="top">:</td>
            <td align="left" valign="top">{{
                $seminarkp->daftarkp->mahasiswa->biodata->alamat}} Kec. {{
                $seminarkp->daftarkp->mahasiswa->biodata->alamat_kec}} Kab / Kota {{
                $seminarkp->daftarkp->mahasiswa->biodata->alamat_kab}}</td>
        </tr>
    </table>

    <table style="width: 700px; border-collapse: collapse;line-height: 20px;margin:10px 13px 0 13px " border="1">
        <tr bgcolor="#f2f2f2">
            <th style="padding: 3px">NO</th>
            <th width="280px">DOKUMEN YANG DIPERLUKAN</th>
            <th style="padding: 3px">ADA</th>
            <th style="padding: 3px">TIDAK</th>
            <th>KETERANGAN</th>
        </tr>
        <tr style="padding: 13px">
            <td align="center">1</td>
            <td>Surat keterangan selesai KP</td>
            <td></td>
            <td></td>
            <td>Asli dilampirkan laporan KP</td>
        </tr>
        <tr>
            <td align="center">2</td>
            <td>Kartu Bimbingan KP</td>
            <td></td>
            <td></td>
            <td>Asli diserahkan dan di arsip TU, FC, lampiran di laporan KP</td>
        </tr>
        <tr>
            <td align="center">3</td>
            <td>Kartu seminar KP</td>
            <td></td>
            <td></td>
            <td>Asli diserahkan dan di arsip TU</td>
        </tr>
        <tr>
            <td align="center">4</td>
            <td>Berita Acara seminar KP</td>
            <td></td>
            <td></td>
            <td>Serahkan ke pembimbing setelah seminar hasil</td>
        </tr>
        <tr>
            <td align="center">5</td>
            <td>Daftar hadir peserta seminar KP</td>
            <td></td>
            <td></td>
            <td>Dibawa mahasiswa yang bersangkutan</td>
        </tr>
        <tr>
            <td align="center">6</td>
            <td>Laporan KP</td>
            <td></td>
            <td></td>
            <td>Rangkap 1 belum dijilid (di klip)</td>
        </tr>
        <tr>
            <td align="center">7</td>
            <td>Materi seminar KP</td>
            <td></td>
            <td></td>
            <td>Digandakan 10 rangkap / sesuai jumlah peserta</td>
        </tr>
    </table>

    <footer id="footer3" style="margin: 20px 0 0 450px">
        <table>
            <tr>
                <td>Purworejo,.................</td>
            </tr>
            <tr>
                <td>Mahasiswa yang bersangkutan,</td>
            </tr>
            <tr>
                <td style="height: 60px;"> </td>
            </tr>
            <tr>
                <td><u>{{ $seminarkp->daftarkp->mahasiswa->biodata->nama
                        }}</u>
                </td>
            </tr>
            <tr>
                <td>NIDN.{{ $seminarkp->daftarkp->mahasiswa->biodata->no_induk }}</td>
            </tr>
        </table>
    </footer>

    <footer id="footer4" style="margin-top: 70px">
        <table width="100%" style="text-align: center">
            <tr>
                <td>Tata Usaha Program Studi</td>
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

</html>