<div class="container-fluid pt-2">
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h4><b>{{ $title }}</b></h4>
                    <hr>
                    <form id="editForm">
                        @csrf
                        <div class="form-group mt-2">
                            <label for="name">Nama Produk</label>
                            <input type="text" class="form-control" name="name" id="name" placeholder="Nama Produk">

                            <label for="kategori_id">Kategori</label>
                            <select name="kategori_id" id="kategori_id" class="form-control">
                                <option value="">-- Pilih Kategori --</option>
                                @foreach ($kategori as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>

                            <label for="harga">Harga</label>
                            <input type="number" class="form-control" name="harga" id="harga" placeholder="Harga">

                            <label for="stok">Stok</label>
                            <input type="number" class="form-control" name="stok" id="stok" placeholder="Stok">

                            <label for="keterangan">Keterangan</label>
                            <input type="text" class="form-control" name="keterangan" id="keterangan" placeholder="Keterangan">

                            <label for="gambar">Gambar</label>
                            <input type="file" class="form-control" name="gambar" id="gambar">
                            
                            <!-- Tambahkan Preview Gambar -->
                            <div class="mt-3">
                                <img id="previewImage" src="" alt="Preview Gambar" class="img-fluid" style="max-height: 120px; display: none;">
                            </div>
                        </div>

                        <a href="/admin/produk" class="btn btn-secondary">Kembali</a>
                        <button type="button" id="saveButton" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    const BASE_IMAGE_URL = "http://127.0.0.1:8000/"; // Sesuaikan dengan URL folder penyimpanan gambar
    const segments = window.location.pathname.split("/");
    const produkId = segments[segments.length - 2];
    
    document.addEventListener("DOMContentLoaded", async function() {
        if (produkId) {
            await fetchProdukData(produkId);
        }
        
        document.getElementById("saveButton").addEventListener("click", function(event) {
            event.preventDefault();
            updateProduk(produkId);
        });

        document.getElementById("gambar").addEventListener("change", function(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById("previewImage").src = e.target.result;
                    document.getElementById("previewImage").style.display = "block";
                };
                reader.readAsDataURL(file);
            }
        });
    });

    async function fetchProdukData(produkId) {
        let token = localStorage.getItem("token");

        try {
            let response = await fetch(`http://127.0.0.1:8000/api/produk/${produkId}`, {
                method: "GET",
                headers: {
                    "Authorization": "Bearer " + token,
                    "Accept": "application/json"
                }
            });
            let result = await response.json();
            if (result.status === "success") {
                document.getElementById("name").value = result.data.name;
                document.getElementById("kategori_id").value = result.data.kategori_id;
                document.getElementById("harga").value = result.data.harga;
                document.getElementById("stok").value = result.data.stok;
                document.getElementById("keterangan").value = result.data.keterangan;

                if (result.data.gambar) {
                    document.getElementById("previewImage").src = BASE_IMAGE_URL + result.data.gambar;
                    document.getElementById("previewImage").style.display = "block";
                }
            }
        } catch (error) {
            console.error("Error fetching product data:", error);
        }
    }

    async function updateProduk(produkId) {
        let token = localStorage.getItem("token");
        let formData = new FormData(document.getElementById("editForm"));

        Swal.fire({
            title: 'Konfirmasi Simpan',
            text: 'Apakah Anda yakin ingin mengubah produk ini?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya, Simpan!',
            cancelButtonText: 'Batal',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33'
        }).then(async (result) => {
            if (result.isConfirmed) {
                try {
                    let response = await fetch(`http://127.0.0.1:8000/api/produk/${produkId}`, {
                        method: "POST",
                        headers: {
                            "Authorization": "Bearer " + token,
                            "X-HTTP-Method-Override": "PUT"
                        },
                        body: formData
                    });
                    let result = await response.json();
                    if (result.status === "success") {
                        Swal.fire("Sukses!", "Produk berhasil diperbarui!", "success").then(() => {
                            window.location.href = "/admin/produk";
                        });
                    } else {
                        Swal.fire("Gagal!", result.message || "Gagal memperbarui produk", "error");
                    }
                } catch (error) {
                    console.error("Error updating product:", error);
                    Swal.fire("Error!", "Terjadi kesalahan saat memperbarui produk", "error");
                }
            }
        });
    }
</script>
