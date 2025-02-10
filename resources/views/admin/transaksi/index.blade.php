<div class="container-fluid pt-2"> 
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h5><b>{{ $title }}</b></h5>
                    <hr>

                    <div class="d-flex justify-content-between align-items-center mt-4 mb-3">
                        <a href="/admin/transaksi/create" class="btn btn-primary">
                            <i class="fas fa-plus mr-2"></i>Tambah
                        </a>
                        <form class="form-inline">
                            <div class="input-group">
                                <input type="text" id="searchInput" class="form-control"
                                    placeholder="Cari Transaksi">
                                <div class="input-group-append">
                                    <button type="button" class="btn btn-secondary" onclick="filterTransaksi()">
                                        <i class="fas fa-search"></i> Cari
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>

                    <table class="table pt-2">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal Transaksi</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="transaksiTableBody">
                            <!-- Data akan diisi dengan JavaScript -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    let transaksiData = [];

    async function fetchTransaksi() {
        let token = localStorage.getItem('token');

        try {
            let response = await fetch('http://127.0.0.1:8000/api/transaksi', {
                method: 'GET',
                headers: {
                    'Authorization': 'Bearer ' + token,
                    'Accept': 'application/json'
                }
            });

            let result = await response.json();
            

            if (result.status === "success" && Array.isArray(result.data)) {
                transaksiData = result.data;
                console.log(transaksiData);
                populateTable(transaksiData);
            } else {
                console.error("Gagal mengambil data transaksi:", result.message);
            }
        } catch (error) {
            console.error("Error saat mengambil data:", error);
        }
    }

    function populateTable(transaksi) {
        const transaksiTableBody = document.getElementById("transaksiTableBody");
        transaksiTableBody.innerHTML = "";

        transaksi.forEach((item, index) => {
            const row = `
                <tr>
                    <td>${index + 1}</td>
                    <td>${item.created_at}</td>
                    <td>${item.status}</td>
                    <td>
                        <div class="d-flex">
                            <a href="/admin/transaksi/${item.id}/edit" class="btn btn-sm btn-info">
                                <i class="fa fa-edit mr-1"></i>Edit
                            </a>
                            <button class="btn btn-sm btn-danger ml-1" onclick="deleteTransaksi(${item.id})">
                                <i class="fa fa-trash mr-1"></i>Hapus
                            </button>
                        </div>
                    </td>
                </tr>`;
            transaksiTableBody.innerHTML += row;
        });
    }

    function filterTransaksi() {
        let searchValue = document.getElementById("searchInput").value.toLowerCase();
        let filteredTransaksi = transaksiData.filter(item =>
            item.status.toLowerCase().includes(searchValue) ||
            item.created_at.toLowerCase().includes(searchValue)
        );
        populateTable(filteredTransaksi);
    }

    document.getElementById("searchInput").addEventListener("keyup", filterTransaksi);

    async function deleteTransaksi(transaksiId) {
        const result = await Swal.fire({
            title: 'Konfirmasi Hapus',
            text: "Apakah Anda yakin ingin menghapus transaksi ini?",
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
            let response = await fetch(`/api/transaksi/${transaksiId}`, {
                method: 'DELETE',
                headers: {
                    'Authorization': 'Bearer ' + token,
                    'Content-Type': 'application/json',
                }
            });

            let data = await response.json();

            if (data.status === 'success') {
                Swal.fire('Sukses!', 'Transaksi berhasil dihapus!', 'success');
                fetchTransaksi();
            } else {
                Swal.fire('Gagal!', 'Gagal menghapus transaksi: ' + data.message, 'error');
            }
        } catch (error) {
            Swal.fire('Error!', 'Terjadi kesalahan saat menghapus transaksi.', 'error');
            console.error('Error deleting transaksi:', error);
        }
    }

    document.addEventListener("DOMContentLoaded", function() {
        fetchTransaksi();
    });
</script>