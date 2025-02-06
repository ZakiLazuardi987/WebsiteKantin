<div class="container-fluid pt-2">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h5><b>{{ $title }}</b></h5>
                    <hr>

                    <div class="d-flex justify-content-between align-items-center mt-4 mb-3">
                        <a href="/admin/user/create" class="btn btn-primary"><i class="fas fa-plus mr-2"></i>Tambah</a>
                        <form class="form-inline">
                            <div class="input-group">
                                <input type="text" id="searchInput" class="form-control" placeholder="Cari User">
                                <div class="input-group-append">
                                    <button type="button" class="btn btn-secondary" onclick="filterUsers()">
                                        <i class="fas fa-search"></i> Cari
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>

                    @if (@session()->has('success'))
                        <div class="alert alert-success mt-2"><i class="fas fa-check mr-1"></i>
                            {{ session('success') }}
                        </div>
                    @endif

                    <table class="table pt-2">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="userTableBody">
                            <!-- Data akan diisi dengan JavaScript -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    let usersData = [];

    async function fetchUsers() {
        let token = localStorage.getItem('token');

        try {
            let response = await fetch('http://127.0.0.1:9000/api/users', {
                method: 'GET',
                headers: {
                    'Authorization': 'Bearer ' + token,
                    'Accept': 'application/json'
                }
            });

            let result = await response.json();

            if (result.status === "success") {
                usersData = result.data;
                populateTable(usersData);
            } else {
                console.error("Gagal mengambil data pengguna:", result.message);
            }
        } catch (error) {
            console.error("Error saat mengambil data:", error);
        }
    }

    function populateTable(users) {
        const userTableBody = document.getElementById("userTableBody");
        userTableBody.innerHTML = "";

        users.forEach((user, index) => {
            const row = `
                <tr>
                    <td>${index + 1}</td>
                    <td>${user.name}</td>
                    <td>${user.email}</td>
                    <td>
                        <div class="d-flex">
                            <a href="/admin/user/${user.id}/edit" class="btn btn-sm btn-info">
                                <i class="fa fa-edit mr-1"></i>Edit
                            </a>
                            <button class="btn btn-sm btn-danger ml-1" onclick="deleteUser(${user.id})">
                                <i class="fa fa-trash mr-1"></i>Hapus
                            </button>
                        </div>
                    </td>
                </tr>`;
            userTableBody.innerHTML += row;
        });
    }

    function filterUsers() {
        let searchValue = document.getElementById("searchInput").value.toLowerCase();
        let filteredUsers = usersData.filter(user =>
            user.name.toLowerCase().includes(searchValue) ||
            user.email.toLowerCase().includes(searchValue)
        );
        populateTable(filteredUsers);
    }

    document.getElementById("searchInput").addEventListener("keyup", filterUsers);

    async function deleteUser(userId) {
        const result = await Swal.fire({
            title: 'Konfirmasi Hapus',
            text: "Apakah Anda yakin ingin menghapus data ini?",
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
            let response = await fetch(`/api/users/${userId}`, {
                method: 'DELETE',
                headers: {
                    'Authorization': 'Bearer ' + token,
                    'Content-Type': 'application/json',
                }
            });

            let data = await response.json();

            if (data.status === 'success') {
                Swal.fire('Sukses!', 'User berhasil dihapus!', 'success');
                fetchUsers();
            } else {
                Swal.fire('Gagal!', 'Gagal menghapus user: ' + data.message, 'error');
            }
        } catch (error) {
            Swal.fire('Error!', 'Terjadi kesalahan saat menghapus user.', 'error');
            console.error('Error deleting user:', error);
        }
    }

    document.addEventListener("DOMContentLoaded", function() {
        fetchUsers();
    });
</script>
