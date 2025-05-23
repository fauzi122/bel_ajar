<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title>E-Spp</title>
    <link rel="shortcut icon" href="{{ asset('assets/img/avatar/icon.jpg') }}" type="image/x-icon">
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="https://fonts.googleapis.com/css?family=Quicksand:400,500,600,700&amp;display=swap" rel="stylesheet">
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
</head>

<body>
    <div class="card p-3 px-5 p-4">
        <h1 class="text-center text-uppercase fw-bold">Kuitansi Pembayaran SPP</h1>
        <p class="text-center text-capitalize fw-bold h5 ">Smk Mutiara Ilmu</p>
        <div class="text-center fw-bold">
            <p class="mt-2 mb-0">Jl. Goa Ria/Pa’bongkayya Laikang | Sudiang | Kel. Laikang | Kec. Biringkanaya |
                admin@mutiarailmu.sch.id</p>
        </div>
        <div class="border border-dark"></div>
        <div class="row py-4">
            <div class="col-md-12 px-4 bg-light">
                <table class="table">
                    <tbody>
                        <tr>
                            <td width="17%">Sudah Terima Dari</td>
                            <td width="2%">:</td>
                            <td width="50%">{{ $siswa->nis }} / {{ $siswa->nama }} / {{ $kelas->nama_kelas }}
                            </td>
                        </tr>
                        <tr>
                            <td width="25%">Untuk Pembayaran</td>
                            <td width="2%">:</td>
                            <td><span class="fw-bold">SPP Bulan</span> : <span
                                    class="text-capitalize">{{ $kwitansi->bulan }}</span></td>
                        </tr>
                        <tr>
                            <td>Jumlah Pembayaran</td>
                            <td width="2%">:</td>
                            <td class="fw-bold">Rp.{{ number_format($pembayaran) }},-</td>
                        </tr>
                        <tr>
                            <td>Terbilang</td>
                            <td width="2%">:</td>
                            <td class="fw-bold text-capitalize fst-italic">## {{ $terbilang }} ##</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <table class="d-flex flex-row-reverse bd-highlight pt-5 px-4 ">
                    <tbody>
                        <tr>
                            <td class="text-center h6 pb-2">Dicetak Tanggal <span
                                    class="fw-bold d-flex justify-content-center"><ins>{{ $tanggal }}</ins></span>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center pt-1 py-4 h6">Bendahara Sekolah,<span
                                    class="row pt-5 py-5 fw-bold mt-5 justify-content-center">Hasmawati.S.Pd</span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
<script>
    window.print()
</script>

</html>
