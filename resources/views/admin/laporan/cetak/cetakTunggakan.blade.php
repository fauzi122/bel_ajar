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
    <h1 class="text-center text-uppercase fw-bold">Tunggakan Kelas {{ $RekapKelas->nama_kelas }} Pembayaran SPP</h1>
    <p class="text-center text-capitalize fw-bold h5 ">Smk Mutiara Ilmu</p>
    <div class="text-center fw-bold">
        <p class="mt-2 mb-0">Jl. Goa Ria/Pa’bongkayya Laikang | Sudiang | Kel. Laikang | Kec. Biringkanaya |
            admin@mutiarailmu.sch.id
        </p>
    </div>
    <div class="border border-dark"></div>
    <div class="row py-2 float-none">
        <div class="col-md-12 px-4 py-2">
            <table class="table table-bordered border-dark" cellpadding="5">
                <thead>
                    <tr>
                        <th rowspan="2" class="text-center pb-4">No</th>
                        <th rowspan="2" class="text-center pb-4">Nis</th>
                        <th rowspan="2" class="text-center pb-4">Nama</th>
                        <th colspan="12" class="text-center">Rinciaan Pembayaran</th>
                        <th rowspan="2" class="text-center pb-4">Total</th>
                    </tr>
                    <tr>
                        @foreach ($dataMonth as $RekapBulan)
                            <th class="text-center">{{ str()->limit($RekapBulan, 3, '') }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @foreach ($RekapKelas->siswa as $siswa)
                        <tr class="">
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $siswa->nis }}</td>
                            <td>{{ $siswa->nama }}</td>
                            @foreach ($dataMonth as $RekapBulan)
                                <td class="text-center">
                                    <span class="text-sm font-weight-normal">
                                        {{ in_array($RekapBulan, $siswa->pembayaran->pluck('bulan_dibayar')->toArray())
                                            ? 'Telah Lunas'
                                            : 'Rp.' . number_format($siswa->spp->nominal) }}
                                    </span>
                                </td>
                            @endforeach
                            <td class="text-center">
                                @php
                                    $total_pembayaran = $siswa->pembayaran->sum('spp.nominal');
                                    $total_nominal = 12 * $siswa->spp->nominal;
                                    $tunggakan = $total_nominal - $total_pembayaran;
                                @endphp
                                Rp.{{ number_format($tunggakan) }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>
<script>
    window.print()
</script>

</html>
