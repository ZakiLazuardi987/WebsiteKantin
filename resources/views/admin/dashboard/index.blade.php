
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
    </style>
</head>
<body>
<div class="container-fluid mt-4">
    <!-- Welcome Message -->
    <div class="welcome-banner card mb-4 shadow" style="font-family: 'Poppins'">
        <div class="card-body d-flex align-items-center py-4">
            <i class="fas fa-hand- text-white display-4 me-3"></i>
            <h4 class="text-white m-0">Halo {{ Auth::user()->name }}, Selamat Datang di Website Kantin!</h4>
        </div>
    </div>

    <!-- Dashboard Cards -->
    <div class="row g-4">
        <!-- Jumlah Produk -->
        <div class="col-lg-3 col-md-6">
            <div class="card dashboard-card shadow h-100">
                <div class="card-body position-relative">
                    <span class="category-badge badge bg-primary">Produk</span>
                    <div class="icon-circle bg-primary bg-opacity-10 mb-3">
                        <i class="fas fa-box fa-2x"></i>
                    </div>
                    <h5 class="card-title text-center text-muted mb-3">Jumlah Produk</h5>
                    <p class="stats-number text-center text-primary mb-0">{{ $jumlahProduk }}</p>
                </div>
                <div class="card-bottom-bar bg-primary"></div>
            </div>
        </div>

        <!-- Jumlah User -->
        <div class="col-lg-3 col-md-6">
            <div class="card dashboard-card shadow h-100">
                <div class="card-body position-relative">
                    <span class="category-badge badge bg-success">Users</span>
                    <div class="icon-circle bg-success bg-opacity-10 mb-3">
                        <i class="fas fa-users fa-2x"></i>
                    </div>
                    <h5 class="card-title text-center text-muted mb-3">Jumlah User</h5>
                    <p class="stats-number text-center text-success mb-0">{{ $jumlahUser }}</p>
                </div>
                <div class="card-bottom-bar bg-success"></div>
            </div>
        </div>

        <!-- Jumlah Transaksi -->
        <div class="col-lg-3 col-md-6">
            <div class="card dashboard-card shadow h-100">
                <div class="card-body position-relative">
                    <span class="category-badge badge bg-warning">Transaksi</span>
                    <div class="icon-circle bg-warning bg-opacity-10 mb-3">
                        <i class="fas fa-handshake fa-2x text-white"></i>
                    </div>
                    <h5 class="card-title text-center text-muted mb-3">Jumlah Transaksi</h5>
                    <p class="stats-number text-center text-warning mb-0">{{ $jumlahTransaksi }}</p>
                </div>
                <div class="card-bottom-bar bg-warning"></div>
            </div>
        </div>

        <!-- Jumlah Pendapatan -->
        <div class="col-lg-3 col-md-6">
            <div class="card dashboard-card shadow h-100">
                <div class="card-body position-relative">
                    <span class="category-badge badge bg-danger">Pendapatan</span>
                    <div class="icon-circle bg-danger bg-opacity-10 mb-3">
                        <i class="fas fa-money-bill fa-2x"></i>
                    </div>
                    <h5 class="card-title text-center text-muted mb-3">Jumlah Pendapatan</h5>
                    <p class="stats-number text-center text-danger mb-0">Rp {{ number_format($jumlahPendapatan, 0, ',', '.') }}</p>
                </div>
                <div class="card-bottom-bar bg-danger"></div>
            </div>
        </div>
    </div>
</div>