<aside class="main-sidebar elevation-4" style=" background-color: white; position: fixed;">
    <!-- Brand Logo -->
    <a href="/admin/dashboard" 
        class="brand-link d-flex justify-content-center align-items-center py-3"
        style="color: #333; background-color: white; transition: background-color 0.2s, color 0.2s;"
        onmouseover="this.style.color='white'; this.style.backgroundColor='#007bff';"
        onmouseout="this.style.color='#333'; this.style.backgroundColor='white';">
        <img src="{{ asset('assets/img/logo-color.png') }}" class="mr-2" style="width: 30px; height: 30px;"/>
        <span class="brand-text font-weight-medium">Website Kantin</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-3">
            <ul class="nav nav-pills nav-sidebar flex-column"  data-widget="treeview" role="menu"
                data-accordion="false">
                <li class="nav-item">
                    <a href="/admin/dashboard" style="transition: background-color 0.3s, color 0.3s;" class="nav-link {{ Request::is('admin/dashboard') ? 'active' : '' }}"
                       onmouseover="this.style.color='white'; this.style.backgroundColor='#007bff';"
                       onmouseout="this.style.color=''; this.style.backgroundColor='';">
                        <i class="nav-icon fas fa-store"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/admin/transaksi" style="transition: background-color 0.3s, color 0.3s;" class="nav-link {{ Request::is('admin/transaksi*') ? 'active' : '' }}"
                       onmouseover="this.style.color='white'; this.style.backgroundColor='#007bff';"
                       onmouseout="this.style.color=''; this.style.backgroundColor='';">
                        <i class="nav-icon fas fa-credit-card"></i>
                        <p>
                            Transaksi
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/admin/produk" style="transition: background-color 0.3s, color 0.3s;" class="nav-link {{ Request::is('admin/produk*') ? 'active' : '' }}"
                       onmouseover="this.style.color='white'; this.style.backgroundColor='#007bff';"
                       onmouseout="this.style.color=''; this.style.backgroundColor='';">
                        <i class="nav-icon fas fa-table"></i>
                        <p>
                            Produk
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/admin/kategori" style="transition: background-color 0.3s, color 0.3s;" class="nav-link {{ Request::is('admin/kategori*') ? 'active' : '' }}"
                       onmouseover="this.style.color='white'; this.style.backgroundColor='#007bff';"
                       onmouseout="this.style.color=''; this.style.backgroundColor='';">
                        <i class="nav-icon fas fa-list"></i>
                        <p>
                            Kategori
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/admin/user" style="transition: background-color 0.3s, color 0.3s;" class="nav-link {{ Request::is('admin/user*') ? 'active' : '' }}"
                       onmouseover="this.style.color='white'; this.style.backgroundColor='#007bff';"
                       onmouseout="this.style.color=''; this.style.backgroundColor='';">
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
