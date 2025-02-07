<div class="container-fluid pt-2">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body ">
                    <h5><b>{{ $title }}</b></h5>
                    <hr>

                    <a href="/admin/kategori/create" class="btn btn-primary mt-2 mb-2"><i
                            class="fas fa-plus mr-2"></i>Tambah</a>
                    <table class="table mt-2" id="kategori-table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Kategori</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Data will be populated here by JavaScript -->
                        </tbody>
                    </table>

                    <div class="d-flex justify-content-right">
                        <!-- Pagination links will be populated here by JavaScript -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    let kategoriData = [];

    async function fetchKategori() {
        let token = localStorage.getItem('token');

        try {
            let response = await fetch('http://127.0.0.1:8000/api/kategori', {
                method: 'GET',
                headers: {
                    'Authorization': 'Bearer ' + token,
                    'Accept': 'application/json'
                }
            });

            let result = await response.json();

            if (result.status === "success") {
                kategoriData = result.data.data; // Ambil array kategori dari paginasi
                populateKategoriTable(kategoriData);
            } else {
                console.error("Gagal mengambil data kategori:", result.message);
            }
        } catch (error) {
            console.error("Error saat mengambil data kategori:", error);
        }
    }

    function populateKategoriTable(kategoris) {
        const kategoriTableBody = document.querySelector("#kategori-table tbody");
        kategoriTableBody.innerHTML = "";

        kategoris.forEach((kategori, index) => {
            const row = `
                    <tr>
                        <td>${index + 1}</td>
                        <td>${kategori.name}</td>
                        <td>
                            <div class="d-flex">
                                <a href="/admin/kategori/${kategori.id}/edit" class="btn btn-sm btn-info">
                                    <i class="fa fa-edit mr-1"></i>Edit
                                </a>
                                <button class="btn btn-sm btn-danger ml-1" onclick="deleteKategori(${kategori.id})">
                                    <i class="fa fa-trash mr-1"></i>Hapus
                                </button>
                            </div>
                        </td>
                    </tr>`;
            kategoriTableBody.innerHTML += row;
        });
    }

    async function deleteKategori(kategoriId) {
        const result = await Swal.fire({
            title: 'Konfirmasi Hapus',
            text: "Apakah Anda yakin ingin menghapus kategori ini?",
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
            let response = await fetch(`/api/kategori/${kategoriId}`, {
                method: 'DELETE',
                headers: {
                    'Authorization': 'Bearer ' + token,
                    'Content-Type': 'application/json',
                }
            });

            let data = await response.json();

            if (data.status === 'success') {
                Swal.fire('Sukses!', 'Kategori berhasil dihapus!', 'success');
                fetchKategori();
            } else {
                Swal.fire('Gagal!', 'Gagal menghapus kategori: ' + data.message, 'error');
            }
        } catch (error) {
            Swal.fire('Error!', 'Terjadi kesalahan saat menghapus kategori.', 'error');
            console.error('Error deleting kategori:', error);
        }
    }

    document.addEventListener("DOMContentLoaded", function() {
        fetchKategori();
    });
</script>
