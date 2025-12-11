@extends('layouts.admin')

@section('breadcrumbs', 'Dashboard')

@section('css')
    <style>
        /* Card Statistik */
        .stat-card {
            background: #fff;
            border-radius: 12px;
            padding: 25px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.03);
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 25px;
            transition: transform 0.3s;
            border: none;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.08);
        }

        .stat-icon {
            width: 60px;
            height: 60px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 28px;
        }

        .text-navy {
            color: #2c3e50;
        }

        .bg-soft-navy {
            background: rgba(44, 62, 80, 0.1);
            color: #2c3e50;
        }

        .bg-soft-orange {
            background: rgba(243, 156, 18, 0.1);
            color: #f39c12;
        }

        .bg-soft-green {
            background: rgba(39, 174, 96, 0.1);
            color: #27ae60;
        }

        .stat-content h2 {
            font-size: 32px;
            font-weight: 800;
            margin: 0;
            color: #333;
        }

        .stat-content span {
            font-size: 14px;
            color: #888;
            font-weight: 600;
            text-transform: uppercase;
        }
    </style>
@endsection

@section('content')

    {{-- Statistik Atas --}}
    <div class="row">
        <div class="col-lg-4 col-md-6">
            <div class="stat-card">
                <div class="stat-content">
                    <span>Status Website</span>
                    <div class="mt-2">
                        {{-- Tombol Kunjungi Website --}}
                        <a href="{{ url('/') }}" class="btn btn-sm shadow-sm"
                            style="background-color: #27ae60; color: white; border-radius: 30px; padding: 8px 20px; font-weight: 700; border: none; transition: 0.3s;">
                            <i class="fa fa-globe mr-1"></i> Kunjungi
                        </a>
                    </div>
                </div>
                <div class="stat-icon bg-soft-green">
                    <i class="fa fa-check-circle"></i>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6">
            <div class="stat-card">
                <div class="stat-content">
                    <span>Total Katalog</span>
                    {{-- Gunakan ?? '0' untuk mencegah error jika variabel tidak ada --}}
                    <h2>{{ $total_katalog ?? '0' }}</h2>
                </div>
                <div class="stat-icon bg-soft-navy">
                    <i class="fa fa-cube"></i>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-md-6">
            <div class="stat-card">
                <div class="stat-content">
                    <span>Pengunjung</span>
                    <h2>{{ $total_pengunjung ?? '0' }}</h2>
                </div>
                <div class="stat-icon bg-soft-orange">
                    <i class="fa fa-users"></i>
                </div>
            </div>
        </div>
    </div>

    {{-- Grafik / Chart --}}
    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-sm" style="border-radius: 12px;">
                <div class="card-body">
                    <h4 class="card-title mb-4 font-weight-bold" style="color: #2c3e50">Statistik Pengunjung</h4>
                    <div style="height: 350px;">
                        <canvas id="trafficChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var ctx = document.getElementById('trafficChart');
            if (ctx) {
                ctx = ctx.getContext('2d');

                var gradient = ctx.createLinearGradient(0, 0, 0, 400);
                gradient.addColorStop(0, 'rgba(243, 156, 18, 0.4)');
                gradient.addColorStop(1, 'rgba(255, 255, 255, 0)');

                // --- INI KUNCI AGAR REALTIME (DINAMIS) ---
                // Mengambil data JSON yang dikirim dari Controller
                var dbLabels = {!! json_encode($chartLabels) !!};
                var dbValues = {!! json_encode($chartValues) !!};
                // ------------------------------------------

                new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: dbLabels, // Pakai label tanggal otomatis
                        datasets: [{
                            label: 'Pengunjung',
                            data: dbValues, // Pakai data jumlah pengunjung asli
                            backgroundColor: gradient,
                            borderColor: '#f39c12',
                            borderWidth: 3,
                            pointBackgroundColor: '#fff',
                            pointBorderColor: '#f39c12',
                            pointRadius: 5,
                            fill: true,
                            tension: 0.4
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                display: false
                            }
                        },
                        scales: {
                            y: {
                                beginAtZero: true,
                                grid: {
                                    borderDash: [5, 5]
                                },
                                ticks: {
                                    stepSize: 1
                                } // Agar sumbu Y bilangan bulat
                            },
                            x: {
                                grid: {
                                    display: false
                                }
                            }
                        }
                    }
                });
            }
        });
    </script>
@endsection
