@extends('layouts.main')

@section('content')
    {{-- Tampilan untuk Admin --}}
    @if (auth()->user()->level === 'admin')
        <div class="container">
            <div class="white-block">
                <h2 class="main-title">Dashboard</h2>
                <p class="text-capitalize h5 px-4">Selamat Datang, {{ auth()->user()->nama_petugas }}!</p>
                <p class="text-capitalize h6 px-4">Aplikasi Pembayaran SPP Siswa - Versi UKK 2023</p>
            </div>
            <div class="row stat-cards">
                @foreach ([
                    ['icon' => 'user-3', 'title' => 'Total Petugas', 'value' => $petugas],
                    ['icon' => 'user-2', 'title' => 'Total Siswa', 'value' => $siswa],
                    ['icon' => 'home', 'title' => 'Total Kelas', 'value' => $kelas],
                    ['icon' => 'money', 'title' => 'Total SPP', 'value' => $spp],
                ] as $stat)
                    <div class="col-md-6 col-xl-3">
                        <article class="stat-cards-item">
                            <div class="sidebar-user-img bg-primary">
                                <i class="icon {{ $stat['icon'] }} py-4 mx-auto" aria-hidden="true"></i>
                            </div>
                            <div class="stat-cards-info">
                                <p class="stat-cards-info__num">{{ $stat['value'] }}</p>
                                <p class="stat-cards-info__title">{{ $stat['title'] }}</p>
                            </div>
                        </article>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    {{-- Tampilan untuk Petugas --}}
    @if (auth()->user()->level === 'petugas')
        <div class="container">
            <div class="white-block">
                <h2 class="main-title">Dashboard</h2>
                <p class="text-capitalize h5 px-4">Selamat Datang, {{ auth()->user()->nama_petugas }}!</p>
                <p class="text-capitalize h6 px-4">Aplikasi Pembayaran SPP Siswa - Grafik SPP</p>

                <div style="background-color: #104152; color: rgb(36, 78, 215); padding: 20px;">
                    <canvas id="grafikSPP" width="300" height="150"></canvas>
                </div>

                <hr>
                <br>
                <div class="row stat-cards">
                    <div class="col-12">
                        <table class="table users-table-info" id="dataTable">
                            <thead class="table-primary">
                                <tr>
                                    <th>Kelas</th>
                                    <th>Nominal</th>
                                    <th>Total Pembayaran</th>
                                    <th>Total Tunggakan</th>
                                    <th>Total Siswa</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($dataSpp as $data)
                                    @php
                                        $totalPembayaran = 0;
                                        $totalTunggakan = $data->nominal * count($data->siswa) * 12;
                                        foreach ($data->pembayaran as $pembayaran) {
                                            $totalPembayaran += $pembayaran['jumlah_bayar'];
                                            $totalTunggakan -= $pembayaran['jumlah_bayar'];
                                        }
                                        $totalTunggakan = max($totalTunggakan, 0);
                                    @endphp
                                    <tr>
                                        <td>{{ $data->level }}</td>
                                        <td>Rp.{{ number_format($data->nominal) }}</td>
                                        <td>Rp.{{ number_format($totalPembayaran) }}</td>
                                        <td>Rp.{{ number_format($totalTunggakan) }}</td>
                                        <td>{{ count($data->siswa) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- Chart.js CDN -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const ctx = document.getElementById('grafikSPP').getContext('2d');

            const chart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ["Kelas X", "Kelas XI", "Kelas XII"], // Labels for the X-axis
                    datasets: [
                        {
                            label: 'Total Pembayaran',
                            data: [12000000, 10000000, 8000000], // Total Pembayaran data
                            backgroundColor: 'rgba(54, 162, 235, 0.6)', // Blue
                            borderColor: 'rgba(54, 162, 235, 1)', // Blue border
                            borderWidth: 1
                        },
                        {
                            label: 'Total Tunggakan',
                            data: [3000000, 4000000, 6000000], // Total Tunggakan data
                            backgroundColor: 'rgba(255, 99, 132, 0.6)', // Red
                            borderColor: 'rgba(255, 99, 132, 1)', // Red border
                            borderWidth: 1
                        },
                        {
                            label: 'Total Siswa',
                            data: [30, 28, 25], // Total Siswa data
                            backgroundColor: 'rgba(255, 206, 86, 0.6)', // Yellow
                            borderColor: 'rgba(255, 206, 86, 1)', // Yellow border
                            borderWidth: 1
                        }
                    ]
                },
                options: {
                    responsive: true,
                    plugins: {
                        title: {
                            display: true,
                            text: 'Laporan Keuangan Per Kelas',
                            color: '#ffffff'
                        },
                        legend: {
                            labels: {
                                color: '#ffffff'
                            }
                        }
                    },
                    scales: {
                        x: {
                            ticks: {
                                color: '#ffffff'
                            }
                        },
                        y: {
                            beginAtZero: true,
                            ticks: {
                                color: '#ffffff'
                            }
                        }
                    }
                }
            });
        });
    </script>
@endsection
