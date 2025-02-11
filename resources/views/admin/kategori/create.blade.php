<div class="container-fluid pt-2">
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h4><b>{{ $title }}</b></h4>
                    <hr>

                    <form id="kategoriForm">
                        <div class="form-group mt-2">
                            <label for="name"><b>Nama Kategori</b></label>
                            <input type="text" class="form-control" name="name" placeholder="Nama Kategori" required>
                        </div>

                        <a href="/admin/kategori" class="btn btn-secondary"><i class="fas fa-arrow-left mr-2"></i>Kembali</a>
                        <button type="submit" class="btn btn-primary"><i class="fas fa-save mr-2"></i>Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Form submission
        document.getElementById("kategoriForm").addEventListener("submit", async function(event) {
            event.preventDefault();
            
            let name = document.querySelector("[name='name']").value;
            let token = localStorage.getItem("token");

            try {
                let response = await fetch("http://127.0.0.1:8000/api/kategori", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "Authorization": "Bearer " + token
                    },
                    body: JSON.stringify({ name })
                });

                let result = await response.json();

                if (result.status === "success") {
                    Swal.fire("Sukses!", "Kategori berhasil ditambahkan!", "success").then(() => {
                        window.location.href = "/admin/kategori";
                    });
                } else if (result.message === "Nama kategori telah digunakan") {
                    Swal.fire("Gagal!", "Nama kategori telah digunakan", "error");
                } else {
                    Swal.fire("Gagal!", result.message || "Gagal menambahkan kategori", "error");
                }
            } catch (error) {
                console.error("Error:", error);
                Swal.fire("Error!", "Terjadi kesalahan saat menambahkan kategori", "error");
            }
        });
    });
</script>
