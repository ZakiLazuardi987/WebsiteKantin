<div class="container-fluid pt-2">
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h4><b>{{ $title }}</b></h4>
                    <hr>

                    <form id="userForm">
                        <div class="form-group mt-2">
                            <label for=""><b>Nama Lengkap</b></label>
                            <input type="text" class="form-control" name="name" placeholder="Nama Lengkap" required>
                        </div>
                        <div class="form-group">
                            <label for=""><b>Email</b></label>
                            <input type="email" class="form-control" name="email" placeholder="Email" required>
                        </div>
                        <div class="form-group">
                            <label for=""><b>Password</b></label>
                            <div class="input-group">
                                <input type="password" class="form-control border-right-0" name="password"
                                    placeholder="Password" id="password" required>
                                <div class="input-group-append">
                                    <span class="input-group-text bg-white border-left-0 toggle-password"
                                        style="cursor: pointer;" data-target="password">
                                        <i class="fas fa-eye"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for=""><b>Konfirmasi Password</b></label>
                            <div class="input-group">
                                <input type="password" class="form-control border-right-0" name="re_password"
                                    placeholder="Konfirmasi Password" id="re_password" required>
                                <div class="input-group-append">
                                    <span class="input-group-text bg-white border-left-0 toggle-password"
                                        style="cursor: pointer;" data-target="re_password">
                                        <i class="fas fa-eye"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <a href="/admin/user" class="btn btn-secondary"><i
                                class="fas fa-arrow-left mr-2"></i>Kembali</a>
                        <button type="submit" class="btn btn-primary"><i class="fas fa-save mr-2"></i>Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
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

        // Form submission
        document.getElementById("userForm").addEventListener("submit", async function(event) {
            event.preventDefault();
            let token = localStorage.getItem("token");
            let name = document.querySelector("[name='name']").value;
            let email = document.querySelector("[name='email']").value;
            let password = document.querySelector("[name='password']").value;
            let re_password = document.querySelector("[name='re_password']").value;

            // Cek apakah password dan konfirmasi password sama
            if (password !== re_password) {
                Swal.fire("Gagal!", "Konfirmasi password tidak cocok!", "error");
                return;
            }

            try {
                let response = await fetch("http://127.0.0.1:8000/api/users", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "Authorization": "Bearer " + token
                    },
                    body: JSON.stringify({
                        name,
                        email,
                        password,
                        re_password
                    })
                });

                let result = await response.json();

                if (result.status === "success") {
                    Swal.fire("Sukses!", "User berhasil ditambahkan!", "success").then(() => {
                        window.location.href = "/admin/user";
                    });
                } else {
                    Swal.fire("Gagal!", result.message || "Gagal menambahkan user", "error");
                }
            } catch (error) {
                console.error("Error:", error);
                Swal.fire("Error!", "Terjadi kesalahan saat menambahkan user", "error");
            }
        });
    });
</script>
