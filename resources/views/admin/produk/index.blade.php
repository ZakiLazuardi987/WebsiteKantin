<div class="container-fluid pt-2">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h5><b>Kelola Produk</b></h5>
                    <hr>

                    <div class="d-flex justify-content-between align-items-center mt-4 mb-3">
                        <a href="/admin/produk/create" class="btn btn-primary">
                            <i class="fas fa-plus mr-2"></i>Tambah
                        </a>
                        <form class="form-inline">
                            <div class="input-group">
                                <input type="text" id="searchInput" class="form-control" placeholder="Cari Produk">
                                <div class="input-group-append">
                                    <button type="button" class="btn btn-secondary" onclick="filterProducts()">
                                        <i class="fas fa-search"></i> Cari
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>

                    <table class="table mt-2">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Gambar</th>
                                <th>Nama Produk</th>
                                <th>Kategori</th>
                                <th>Harga</th>
                                <th>Stok</th>
                                <th>Keterangan</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="productTableBody">
                            <!-- Data akan diisi dengan JavaScript -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    let productsData = [];

    async function fetchProducts() {
        let token = localStorage.getItem('token');

        try {
            let response = await fetch('http://127.0.0.1:8000/api/produk', {
                method: 'GET',
                headers: {
                    'Authorization': 'Bearer ' + token,
                    'Accept': 'application/json'
                }
            });

            let result = await response.json();
            console.log(result);

            if (result.status === "success") {
                productsData = result.data.data;
                populateTable(productsData);
                console.log(productsData);
            } else {
                console.error("Gagal mengambil data produk:", result.message);
            }
        } catch (error) {
            console.error("Error saat mengambil data:", error);
        }
    }

    function populateTable(products) {
        const productTableBody = document.getElementById("productTableBody");
        productTableBody.innerHTML = "";

        products.forEach((product, index) => {
            const row = `
            <tr>
                <td>${index + 1}</td>
                <td><img src="/${product.gambar}" width="70px" height="70px" alt=""></td>
                <td>${product.name}</td>
                <td>${product.kategori.name}</td>
                <td>${product.harga}</td>
                <td>${product.stok}</td>
                <td>${product.keterangan || '-'} </td>
                <td>
                    <div class="d-flex">
                        <a href="/admin/produk/${product.id}/edit" class="btn btn-sm btn-info">
                            <i class="fa fa-edit mr-1"></i>Edit
                        </a>
                        <button class="btn btn-sm btn-danger ml-1" onclick="deleteProduct(${product.id})">
                            <i class="fa fa-trash mr-1"></i>Hapus
                        </button>
                    </div>
                </td>
            </tr>`;
            productTableBody.innerHTML += row;
        });
    }

    function filterProducts() {
        let searchValue = document.getElementById("searchInput").value.toLowerCase();
        let filteredProducts = productsData.filter(product =>
            product.name.toLowerCase().includes(searchValue) ||
            product.kategori.name.toLowerCase().includes(searchValue)
        );
        populateTable(filteredProducts);
    }

    document.getElementById("searchInput").addEventListener("keyup", filterProducts);

    async function deleteProduct(productId) {
        const result = await Swal.fire({
            title: 'Konfirmasi Hapus',
            text: "Apakah Anda yakin ingin menghapus produk ini?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33'
        });

        if (!result.isConfirmed) return;

        let token = localStorage.getItem('token');

        try {
            let response = await fetch(`/api/produk/${productId}`, {
                method: 'DELETE',
                headers: {
                    'Authorization': 'Bearer ' + token,
                }
            });

            let data = await response.json();

            if (data.status === 'success') {
                Swal.fire('Sukses!', 'Produk berhasil dihapus!', 'success');
                fetchProducts();
            } else {
                Swal.fire('Gagal!', 'Gagal menghapus produk: ' + data.message, 'error');
            }
        } catch (error) {
            Swal.fire('Error!', 'Terjadi kesalahan saat menghapus produk.', 'error');
            console.error('Error deleting product:', error);
        }
    }

    document.addEventListener("DOMContentLoaded", function() {
        fetchProducts();
    });
</script>
