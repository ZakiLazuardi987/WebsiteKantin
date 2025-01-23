<aside class="main-sidebar elevation-4" style="font-family: 'Poppins'; background-color: white; position: fixed;">
    <!-- Brand Logo -->
    <a href="/admin/dashboard" 
        class="brand-link d-flex justify-content-center align-items-center py-3"
        style="color: #333; background-color: white; transition: background-color 0.2s, color 0.2s;"
        onmouseover="this.style.color='#007bff'; this.style.backgroundColor='#f4f4f4';"
        onmouseout="this.style.color='#333'; this.style.backgroundColor='white';">
        <i class="fas fa-pizza-slice mr-2"></i>
        <span class="brand-text font-weight-medium">Website Kantin</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column"  data-widget="treeview" role="menu"
                data-accordion="false">
                <li class="nav-item">
                    <a href="/admin/dashboard" style="transition: background-color 0.3s, color 0.3s;" class="nav-link {{ Request::is('admin/dashboard') ? 'active' : '' }}">
                        <img src="assets/img/logo-bw.jpg" alt="">
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/admin/transaksi" style="transition: background-color 0.3s, color 0.3s;" class="nav-link {{ Request::is('admin/transaksi*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-credit-card"></i>
                        <p>
                            Transaksi
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/admin/produk" style="transition: background-color 0.3s, color 0.3s;" class="nav-link {{ Request::is('admin/produk*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-table"></i>
                        <p>
                            Produk
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/admin/kategori" style="transition: background-color 0.3s, color 0.3s;" class="nav-link {{ Request::is('admin/kategori*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-list"></i>
                        <p>
                            Kategori
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/admin/user" style="transition: background-color 0.3s, color 0.3s;" class="nav-link {{ Request::is('admin/user*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            User
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>

<div class="content-wrapper">
