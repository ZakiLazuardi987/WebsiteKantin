<div class="container-fluid pt-2">
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h4><b>{{ $title }}</b></h4>
                    <hr>

                    @isset($user)
                        <form id="editForm">
                        @else
                            <form id="editForm">
                            @endisset
                            @csrf
                            <div class="form-group m">
                                <label for=""><b>Nama Lengkap</b></label>
                                <input type="text" class="form-control" name="name" placeholder="Nama Lengkap">
                            </div>
                            <div class="form-group">
                                <label for=""><b>Email</b></label>
                                <input type="email" class="form-control" name="email" placeholder="Email">
                            </div>
                            <div class="form-group">
                                <label for=""><b>Password Lama</b></label>
                                <div class="input-group">
                                    <input type="password" class="form-control" name="old_password" placeholder="Password Lama" id="old_password">
                                    <div class="input-group-append">
                                        <span class="input-group-text bg-white border-left-0 toggle-password" data-target="old_password" style="cursor: pointer;">
                                            <i class="fas fa-eye"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for=""><b>Password Baru</b></label>
                                <div class="input-group">
                                    <input type="password" class="form-control" name="password" placeholder="Password Baru" id="password">
                                    <div class="input-group-append">
                                        <span class="input-group-text bg-white border-left-white toggle-password" data-target="password" style="cursor: pointer;">
                                            <i class="fas fa-eye"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for=""><b>Konfirmasi Password</b></label>
                                <div class="input-group">
                                    <input type="password" class="form-control" name="re_password" placeholder="Konfirmasi Password" id="re_password">
                                    <div class="input-group-append">
                                        <span class="input-group-text bg-white border-left-0 toggle-password" data-target="re_password" style="cursor: pointer;">
                                            <i class="fas fa-eye"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <a href="/admin/user" class="btn btn-secondary">Kembali</a>
                            <button type="button" id="saveButton" class="btn btn-primary">Simpan</button>
                        </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    const segments = window.location.pathname.split("/");
    const userId = segments[segments.length - 2];

    document.addEventListener("DOMContentLoaded", async function() {
        if (userId) {
            await fetchUserData(userId);
        }

        // Toggle password visibility
        document.querySelectorAll(".toggle-password").forEach(function(toggle) {
            toggle.addEventListener("click", function() {
                let inputId = this.getAttribute("data-target");
                let input = document.getElementById(inputId);
                let icon = this.querySelector("i");

                if (input.type === "password") {
                    input.type = "text";
                    icon.classList.remove("fa-eye");
                    icon.classList.add("fa-eye-slash");
                } else {
                    input.type = "password";
                    icon.classList.remove("fa-eye-slash");
                    icon.classList.add("fa-eye");
                }
            });
        });

        document.getElementById("saveButton").addEventListener("click", function(event) {
            event.preventDefault();
            updateUser(userId);
        });
    });

    async function fetchUserData(userId) {
        let token = localStorage.getItem("token");
        try {
            let response = await fetch(`http://127.0.0.1:8000/api/users/${userId}`, {
                method: "GET",
                headers: {
                    "Authorization": "Bearer " + token,
                    "Accept": "application/json"
                }
            });
            let result = await response.json();
            if (result.status === "success") {
                document.querySelector("input[name='name']").value = result.data.name;
                document.querySelector("input[name='email']").value = result.data.email;
            }
        } catch (error) {
            console.error("Error fetching data:", error);
        }
    }

    async function updateUser(userId) {
        let token = localStorage.getItem("token");
        let name = document.querySelector("input[name='name']").value;
        let email = document.querySelector("input[name='email']").value;
        let password = document.querySelector("input[name='password']").value;
        let re_password = document.querySelector("input[name='re_password']").value;
        let old_password = document.querySelector("input[name='old_password']").value;

        // Cek apakah password baru diisi, jika iya, validasi konfirmasi password
        if (password && password !== re_password) {
            Swal.fire("Gagal!", "Konfirmasi password tidak cocok!", "error");
            return;
        }

        let data = {
            name,
            email,
            old_password
        };

        if (password) {
            data.password = password;
            data.re_password = re_password;
        }

        Swal.fire({
            title: 'Konfirmasi Simpan',
            text: 'Apakah Anda yakin ingin mengubah data ini?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya, Simpan!',
            cancelButtonText: 'Batal',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33'
        }).then(async (result) => {
            if (result.isConfirmed) {
                try {
                    let response = await fetch(`http://127.0.0.1:8000/api/users/${userId}`, {
                        method: "PUT",
                        headers: {
                            "Authorization": "Bearer " + token,
                            "Content-Type": "application/json"
                        },
                        body: JSON.stringify(data)
                    });
                    let result = await response.json();
                    if (result.status === "success") {
                        Swal.fire("Sukses!", "Data berhasil diperbarui!", "success").then(() => {
                            window.location.href = "/admin/user";
                        });
                    } else {
                        Swal.fire("Gagal!", result.message || "Gagal memperbarui data", "error");
                    }
                } catch (error) {
                    console.error("Error updating user:", error);
                    Swal.fire("Error!", "Terjadi kesalahan saat memperbarui data", "error");
                }
            }
        });
    }
</script>
