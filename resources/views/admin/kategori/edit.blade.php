<div class="container-fluid pt-2">
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5><b>{{ $title }}</b></h5>
                    <hr>

                    @isset($kategori)
                        <form id="editForm">
                        @else
                            <form id="editForm">
                            @endisset
                            @csrf
                            <div class="form-group">
                                <label for="name"><b>Nama Kategori</b></label>
                                <input type="text" class="form-control" name="name" id="name" placeholder="Nama Kategori" value="{{ isset($kategori) ? $kategori->name : ''}}">
                            </div>

                            <a href="/admin/kategori" class="btn btn-secondary">Kembali</a>
                            <button type="button" id="saveButton" class="btn btn-primary">Simpan</button>
                        </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    const segments = window.location.pathname.split("/");
    const kategoriId = segments[segments.length - 2];

    document.addEventListener("DOMContentLoaded", async function() {
        if (kategoriId) {
            await fetchKategoriData(kategoriId);
        }

        document.getElementById("saveButton").addEventListener("click", function(event) {
            event.preventDefault();
            updateKategori(kategoriId);
        });
    });

    async function fetchKategoriData(kategoriId) {
        let token = localStorage.getItem("token");
        try {
            let response = await fetch(`http://127.0.0.1:9000/api/kategori/${kategoriId}`, {
                method: "GET",
                headers: {
                    "Authorization": "Bearer " + token,
                    "Accept": "application/json"
                }
            });
            let result = await response.json();
            if (result.status === "success") {
                document.querySelector("input[name='name']").value = result.data.name;
            }
        } catch (error) {
            console.error("Error fetching category data:", error);
        }
    }

    async function updateKategori(kategoriId) {
        let token = localStorage.getItem("token");
        let name = document.querySelector("input[name='name']").value;

        let data = {
            name
        };

        Swal.fire({
            title: 'Konfirmasi Simpan',
            text: 'Apakah Anda yakin ingin mengubah kategori ini?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya, Simpan!',
            cancelButtonText: 'Batal',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33'
        }).then(async (result) => {
            if (result.isConfirmed) {
                try {
                    let response = await fetch(`http://127.0.0.1:9000/api/kategori/${kategoriId}`, {
                        method: "PUT",
                        headers: {
                            "Authorization": "Bearer " + token,
                            "Content-Type": "application/json"
                        },
                        body: JSON.stringify(data)
                    });
                    let result = await response.json();
                    if (result.status === "success") {
                        Swal.fire("Sukses!", "Kategori berhasil diperbarui!", "success").then(() => {
                            window.location.href = "/admin/kategori";
                        });
                    } else {
                        Swal.fire("Gagal!", result.message || "Gagal memperbarui kategori", "error");
                    }
                } catch (error) {
                    console.error("Error updating category:", error);
                    Swal.fire("Error!", "Terjadi kesalahan saat memperbarui kategori", "error");
                }
            }
        });
    }
</script>
