<div class="container-fluid pt-2">
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h4><b>{{ $title }}</b></h4>
                    <hr>
                    
                    <form id="produkForm" enctype="multipart/form-data">
                        <div class="form-group mt-2">
                            <label for="name"><b>Nama Produk</b></label>
                            <input type="text" class="form-control" name="name" placeholder="Nama Produk" required>
                        </div>
                        <div class="form-group">
                            <label for="kategori_id"><b>Kategori</b></label>
                            <select name="kategori_id" class="form-control" required>
                                <option value="">-- Pilih Kategori --</option>
                                @foreach ($kategori as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="harga"><b>Harga</b></label>
                            <input type="number" class="form-control" name="harga" placeholder="Harga" required>
                        </div>
                        <div class="form-group">
                            <label for="stok"><b>Stok</b></label>
                            <input type="number" class="form-control" name="stok" placeholder="Stok" required>
                        </div>
                        <div class="form-group">
                            <label for="keterangan"><b>Keterangan</b></label>
                            <input type="text" class="form-control" name="keterangan" placeholder="Keterangan">
                        </div>
                        <div class="form-group">
                            <label for="gambar"><b>Gambar</b></label>
                            <input type="file" class="form-control" name="gambar" accept="image/*">
                        </div>
                        
                        <a href="/admin/produk" class="btn btn-secondary"><i class="fas fa-arrow-left mr-2"></i>Kembali</a>
                        <button type="submit" class="btn btn-primary"><i class="fas fa-save mr-2"></i>Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        document.getElementById("produkForm").addEventListener("submit", async function(event) {
            event.preventDefault();
            
            let formData = new FormData(this);
            let token = localStorage.getItem("token");

            // Check if the gambar field is empty
            if (!formData.get('gambar').name) {
                // Append the default image to the formData
                let defaultImage = await fetch('/assets/img/default.jpg').then(res => res.blob());
                formData.append('gambar', defaultImage, 'default.jpg');
            }

            try {
                let response = await fetch("http://127.0.0.1:8000/api/produk", {
                    method: "POST",
                    headers: {
                        "Authorization": "Bearer " + token
                    },
                    body: formData
                });
                
                let result = await response.json();
                
                if (result.status === "success") {
                    Swal.fire("Sukses!", "Produk berhasil ditambahkan!", "success").then(() => {
                        window.location.href = "/admin/produk";
                    });
                } else if (result.message && result.message.includes("Nama produk sudah digunakan")) {
                    Swal.fire("Gagal!", "Nama produk sudah digunakan, silakan gunakan nama lain.", "error");
                } else {
                    Swal.fire("Gagal!", result.message || "Gagal menambahkan produk", "error");
                }
            } catch (error) {
                console.error("Error:", error);
                Swal.fire("Error!", "Terjadi kesalahan saat menambahkan produk", "error");
            }
        });
    });
</script>
