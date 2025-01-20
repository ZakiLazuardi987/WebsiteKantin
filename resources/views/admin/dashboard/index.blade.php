<style>
    .welcome-banner {
        background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
        transition: transform 0.3s ease;
    }

    .welcome-banner:hover {
        transform: translateY(-5px);
    }

    .dashboard-card {
        transition: all 0.3s ease;
        border: none;
    }

    .dashboard-card:hover {
        transform: translateY(-5px);
    }

    .icon-circle {
        width: 70px;
        height: 70px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto;
    }

    .card-bottom-bar {
        height: 4px;
        width: 100%;
    }

    .stats-number {
        font-size: 2.5rem;
        font-weight: bold;
    }

    .category-badge {
        position: absolute;
        top: 15px;
        right: 15px;
    }

    .category-badge.badge.bg-warning.text-white {
        color: white !important;
    }

    .card-body {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        padding: 20px;
    }

    /* Styling untuk Chart Container */
    .chart-container {
        /* width: 100%;
        max-width: 100%; */
        height: 400px;
        margin-top: 40px;
    }

    /* Membuat chart responsif */
    /* .chart {
        width: 100% !important;
        height: 100% !important;
    } */

    /* .container-fluid {
        max-width: 100%;
        padding-left: 0;
        padding-right: 0;
    } */
</style>

<body>
    <div class="container-fluid pt-3">
        <!-- Welcome Message -->
        <div class="welcome-banner card mb-3 shadow" style="font-family: 'Poppins'">
            <div class="card-body d-flex align-items-center py-4">
                <i class="fas fa-hand- text-white display-4 me-3"></i>
                <h4 class="text-white m-0">Halo {{ Auth::user()->name }}, Selamat Datang di Website Kantin!</h4>
            </div>
        </div>

        <!-- Dashboard Cards -->
        <div class="row g-4">
            <!-- Jumlah Produk -->
            <div class="col-lg-3 col-md-6">
                <div class="card dashboard-card shadow">
                    <div class="card-body position-relative">
                        <span class="category-badge badge bg-primary">Produk</span>
                        <div class="icon-circle bg-primary bg-opacity-10 mb-3">
                            <i class="fas fa-box fa-2x"></i>
                        </div>
                        <h5 class="card-title text-center text-muted">Jumlah Produk</h5>
                    </div>
                    <p class="stats-number text-center text-primary" id="jumlahProduk">0</p>
                    <div class="card-bottom-bar bg-primary"></div>
                </div>
            </div>

            <!-- Jumlah User -->
            <div class="col-lg-3 col-md-6">
                <div class="card dashboard-card shadow">
                    <div class="card-body position-relative">
                        <span class="category-badge badge bg-success">Users</span>
                        <div class="icon-circle bg-success bg-opacity-10 mb-3">
                            <i class="fas fa-users fa-2x"></i>
                        </div>
                        <h5 class="card-title text-center text-muted">Jumlah User</h5>
                    </div>
                    <p class="stats-number text-center text-success" id="jumlahUser">0</p>
                    <div class="card-bottom-bar bg-success"></div>
                </div>
            </div>

            <!-- Jumlah Transaksi -->
            <div class="col-lg-3 col-md-6">
                <div class="card dashboard-card shadow">
                    <div class="card-body position-relative">
                        <span class="category-badge badge bg-warning text-white">Transaksi</span>
                        <div class="icon-circle bg-warning bg-opacity-10 mb-3">
                            <i class="fas fa-handshake fa-2x text-white"></i>
                        </div>
                        <h5 class="card-title text-center text-muted">Jumlah Transaksi</h5>
                    </div>
                    <p class="stats-number text-center text-warning" id="jumlahTransaksi">0</p>
                    <div class="card-bottom-bar bg-warning"></div>
                </div>
            </div>

            <!-- Jumlah Pendapatan -->
            <div class="col-lg-3 col-md-6">
                <div class="card dashboard-card shadow">
                    <div class="card-body position-relative">
                        <span class="category-badge badge bg-danger">Pendapatan</span>
                        <div class="icon-circle bg-danger bg-opacity-10 mb-3">
                            <i class="fas fa-money-bill fa-2x"></i>
                        </div>
                        <h5 class="card-title text-center text-muted">Jumlah Pendapatan</h5>
                    </div>
                    <p class="stats-number text-center text-danger" id="jumlahPendapatan">Rp 0</p>
                    <div class="card-bottom-bar bg-danger"></div>
                </div>
            </div>
        </div>

        <!-- Chart Container -->
        <div class="card dashboard-card shadow">
            <div class="chart-container">
                <canvas id="pendapatanChart" class="chart"></canvas>
            </div>
        </div>
    </div>

    <script>
        // Mempercepat Animasi Counting dan Menambahkan Format "Rp"
        function countUp(elementId, endValue, isCurrency = false) {
            let startValue = 0;
            let increment = endValue / 70; // Menambah lebih cepat
            let interval = setInterval(() => {
                startValue += increment;
                if (startValue >= endValue) {
                    startValue = endValue;
                    clearInterval(interval);
                }
                // Menambahkan format angka jika currency
                if (isCurrency) {
                    document.getElementById(elementId).textContent = 'Rp ' + new Intl.NumberFormat().format(Math
                        .floor(startValue));
                } else {
                    document.getElementById(elementId).textContent = Math.floor(startValue);
                }
            }, 10); // Interval lebih cepat
        }

        // Memulai counting untuk setiap elemen
        window.onload = () => {
            countUp("jumlahProduk", {{ $jumlahProduk }});
            countUp("jumlahUser", {{ $jumlahUser }});
            countUp("jumlahTransaksi", {{ $jumlahTransaksi }});
            countUp("jumlahPendapatan", {{ $jumlahPendapatan }}, true);

            // Data untuk Chart
            const labels = {!! json_encode(array_keys($pendapatanPerHari)) !!};
            const dataPendapatan = {!! json_encode(array_values($pendapatanPerHari)) !!};

            const ctx = document.getElementById('pendapatanChart').getContext('2d');
            const pendapatanChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Pendapatan Harian',
                        data: dataPendapatan,
                        borderColor: '#28a745',
                        backgroundColor: 'rgba(40, 167, 69, 0.2)',
                        fill: true,
                        tension: 0.4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        x: {
                            title: {
                                display: true,
                                text: 'Tanggal'
                            }
                        },
                        y: {
                            title: {
                                display: true,
                                text: 'Pendapatan (Rp)'
                            },
                            beginAtZero: true
                        }
                    }
                }
            });
        };
    </script>

    <script>
        // Mendapatkan data dari controller (misalnya $pendapatanPerHari)
        var pendapatanPerHariData = @json($pendapatanPerHari);

        // Format data untuk Chart.js
        var labels = Object.keys(pendapatanPerHariData); // Hari-hari (keys)
        var data = Object.values(pendapatanPerHariData); // Pendapatan per hari (values)

        // Membuat chart pendapatan per hari
        var ctx = document.getElementById('pendapatanPerHariChart').getContext('2d');
        var pendapatanPerHariChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels, // X-axis labels (hari)
                datasets: [{
                    label: 'Pendapatan',
                    data: data, // Y-axis data (pendapatan)
                    fill: false,
                    borderColor: 'rgba(255, 99, 132, 1)',
                    tension: 0.1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    title: {
                        display: true,
                        text: 'Pendapatan Per Hari'
                    },
                    tooltip: {
                        mode: 'index',
                        intersect: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</body>
