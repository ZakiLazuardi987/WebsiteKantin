<style>
    .dashboard-card {
        transition: all 0.3s ease;
        border: none;
        border-radius: 10px;
        overflow: hidden;
        padding: 23px;
    }

    .dashboard-card:hover {
        transform: translateY(-5px);
    }

    .icon-circle {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 15px;
    }

    .stats-container {
        display: flex;
        align-items: center;
    }

    .stats-number {
        font-size: 1.8rem;
        font-weight: bold;
        margin: 0;
    }

    .category-badge {
        position: absolute;
        top: 10px;
        right: 10px;
        border-radius: 10px;
    }

    .category-badge.badge.bg-warning.text-white {
        color: white !important;
    }

    card-body {
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .chart-container {
        height: 450px;
        margin-top: 20px;
        border-radius: 10px;
        overflow: hidden;
    }
</style>


<body>
    <div class="container-fluid pt-3">
        <!-- Dashboard Cards -->
        <div class="row g-4">
            <!-- Jumlah Produk -->
            <div class="col-lg-3 col-md-6">
                <div class="card dashboard-card shadow d-flex flex-row align-items-center">
                    <div class="icon-circle bg-primary bg-opacity-10">
                        <i class="fas fa-box fa-lg"></i>
                    </div>
                    <div>
                        <h6 class="text-muted mb-1">Jumlah Produk</h6>
                        <p class="stats-number text-primary" id="jumlahProduk">0</p>
                    </div>
                </div>
            </div>

            <!-- Jumlah User -->
            <div class="col-lg-3 col-md-6">
                <div class="card dashboard-card shadow d-flex flex-row align-items-center">
                    <div class="icon-circle bg-success bg-opacity-10">
                        <i class="fas fa-users fa-lg"></i>
                    </div>
                    <div>
                        <h6 class="text-muted mb-1">Jumlah User</h6>
                        <p class="stats-number text-success" id="jumlahUser">0</p>
                    </div>
                </div>
            </div>

            <!-- Jumlah Transaksi -->
            <div class="col-lg-3 col-md-6">
                <div class="card dashboard-card shadow d-flex flex-row align-items-center">
                    <div class="icon-circle bg-warning bg-opacity-10">
                        <i class="fas fa-handshake fa-lg text-white"></i>
                    </div>
                    <div>
                        <h6 class="text-muted mb-1">Jumlah Transaksi</h6>
                        <p class="stats-number text-warning" id="jumlahTransaksi">0</p>
                    </div>
                </div>
            </div>

            <!-- Jumlah Pendapatan -->
            <div class="col-lg-3 col-md-6">
                <div class="card dashboard-card shadow d-flex flex-row align-items-center">
                    <div class="icon-circle bg-danger bg-opacity-10">
                        <i class="fas fa-money-bill fa-lg"></i>
                    </div>
                    <div>
                        <h6 class="text-muted mb-1">Jumlah Pendapatan</h6>
                        <p class="stats-number text-danger" id="jumlahPendapatan">Rp 0</p>
                    </div>
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
        window.onload = () => {
            fetchDashboardData();
        };

        async function fetchDashboardData() {
            let token = localStorage.getItem('token');

            if (!token) {
                console.log("Token tidak ditemukan, mengalihkan ke halaman login.");
                window.location.href = "/login";
                return;
            }

            try {
                let response = await fetch('http://127.0.0.1:9000/api/dashboard', {
                    method: 'GET',
                    headers: {
                        'Authorization': 'Bearer ' + token,
                        'Accept': 'application/json'
                    }
                });

                let result = await response.json();
                console.log(result);

                if (result.success) {
                    // Update angka di dashboard
                    countUp("jumlahProduk", result.jumlahProduk);
                    countUp("jumlahUser", result.jumlahUser);
                    countUp("jumlahTransaksi", result.jumlahTransaksi);
                    countUp("jumlahPendapatan", result.jumlahPendapatan, true);

                    // Update Chart setelah data didapat
                    updatePendapatanChart(result.pendapatanPerHari);
                } else {
                    console.log("Gagal mengambil data dashboard:", result.message);
                }
            } catch (error) {
                console.error("Error saat mengambil data:", error);
            }
        }

        function updatePendapatanChart(pendapatanPerHariData) {
            if (!pendapatanPerHariData || Object.keys(pendapatanPerHariData).length === 0) {
                console.log("Data pendapatan per hari kosong atau tidak ditemukan.");
                return;
            }

            const labels = Object.keys(pendapatanPerHariData); // Tanggal
            const dataPendapatan = Object.values(pendapatanPerHariData); // Pendapatan

            const ctx = document.getElementById('pendapatanChart').getContext('2d');

            // Hapus chart lama jika ada
            if (window.pendapatanChart instanceof Chart) {
                window.pendapatanChart.destroy();
            }

            // Buat chart baru
            window.pendapatanChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Pendapatan Harian',
                        data: dataPendapatan,
                        borderColor: '#3b82f6',
                        backgroundColor: 'rgba(59, 130, 246, 0.2)',
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
        }


        // Mempercepat Animasi Counting dan Menambahkan Format "Rp"
        function countUp(elementId, endValue, isCurrency = false) {
            let startValue = 0;
            let increment = endValue / 100; // Menambah lebih cepat
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
    </script>

    <script>
        // Mendapatkan data dari controller (misalnya $pendapatanPerHari)
        var pendapatanPerHariData = result.pendapatanPerHari;

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
