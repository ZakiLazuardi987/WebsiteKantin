<div class="row pl-2 pt-2">
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <div class="row mt-2">
                    <div class="col-md-4">
                        <label for="">Kode Produk</label>
                    </div>
                    <div class="col-md-8">
                        <form id="produkForm" method="GET">
                            <div class="d-flex">
                                <select name="produk_id" class="form-control" id="produk_id">
                                    <option value="">-- {{ isset($detail_produk) ? $detail_produk->name : 'Pilih Produk' }} --</option>
                                    @foreach ($produk as $item)
                                        <option value="{{ $item->id }}">{{ $item->id . ' - ' . $item->name }}</option>
                                    @endforeach
                                </select>
                                <button type="submit" class="btn btn-primary ml-1">Pilih</button>
                            </div>
                        </form>
                    </div>
                </div>

                <form action="/admin/transaksi/detail/create" method="POST">
                    @csrf

                    <input type="hidden" name='transaksi_id' value="{{ Request::segment(3) }}">
                    <input type="hidden" name='produk_id' value="{{ isset($detail_produk) ? $detail_produk->id : '' }}">
                    <input type="hidden" name='produk_name' value="{{ isset($detail_produk) ? $detail_produk->name : '' }}">
                    <input type="hidden" name='subtotal' value="{{ $subtotal }}">

                    <div class="row mt-2">
                        <div class="col-md-4">
                            <label for="">Nama Produk</label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" value="{{ isset($detail_produk) ? $detail_produk->name : '' }}" class="form-control" disabled name="nama_produk" placeholder="Nama Produk">
                        </div>
                    </div>

                    <div class="row mt-2">
                        <div class="col-md-4">
                            <label for="">Harga Satuan</label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" value="{{ isset($detail_produk) ? $detail_produk->harga : '' }}" class="form-control" disabled name="harga_satuan" placeholder="Harga Satuan">
                        </div>
                    </div>

                    <div class="row mt-2">
                        <div class="col-md-4">
                            <label for="">QTY</label>
                        </div>
                        <div class="col-md-8">
                            <div class="d-flex">
                                <a href="?produk_id={{ request('produk_id') }}&action=minus&qty={{ $qty }}" class="btn btn-primary"><i class="fas fa-minus"></i></a>
                                <input type="number" value="{{ $qty }}" class="form-control ml-1 mr-1" name="qty" id="qty" placeholder="QTY" disabled>
                                <a href="?produk_id={{ request('produk_id') }}&action=plus&qty={{ $qty }}" class="btn btn-primary"><i class="fas fa-plus"></i></a>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-2">
                        <div class="col-md-4"></div>
                        <div class="col-md-8">
                            <span class="text-primary">
                                <h5>Subtotal : Rp. {{ format_rupiah($subtotal) }}</h5>
                            </span>
                        </div>
                    </div>

                    <div class="row mt-2">
                        <div class="col-md-4"></div>
                        <div class="col-md-8">
                            <a href="/admin/transaksi" class="btn btn-secondary"><i class="fas fa-arrow-left mr-2"></i>Kembali</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <table class="table mt-2">
                    <tr>
                        <th>No</th>
                        <th>Nama Produk</th>
                        <th>QTY</th>
                        <th>Subtotal</th>
                    </tr>

                    @foreach ($detail_transaksi as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->produk_name }}</td>
                            <td>{{ $item->qty }}</td>
                            <td>Rp. {{ format_rupiah($item->subtotal) }}</td>
                        </tr>
                    @endforeach
                </table>

                <a href="/admin/transaksi/detail/done/{{ Request::segment(3) }}" id="selesaiTransaksi" class="btn btn-success">
                    <i class="fas fa-check mr-2"></i>Selesai
                </a>
            </div>
        </div>
    </div>
</div>

<div class="row pl-2">
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <form id="hitungForm" action="" method="GET">
                    <div class="form-group">
                        <label for="">Total Belanja</label>
                        <input type="number" value="{{ $transaksi->total }}" name="total_belanja" class="form-control" id="total_belanja">
                    </div>

                    <div class="form-group">
                        <label for="">Jumlah Bayar</label>
                        <input type="number" value="{{ request('jumlah_bayar') }}" name="jumlah_bayar" class="form-control" id="jumlah_bayar">
                    </div>

                    <button type="submit" class="btn btn-primary btn-block mr-2">Hitung</button>
                </form>
                <hr>
                <div class="form-group">
                    <label for="">Uang Kembalian</label>
                    <input type="number" value="{{ format_rupiah($kembalian) }}" disabled name="kembalian" class="form-control" id="kembalian">
                </div>
            </div>
        </div>
    </div>
</div>

{{-- <div class="row pl-2 pt-2">
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <div class="row mt-2">
                    <div class="col-md-4">
                        <label for="">Kode Produk</label>
                    </div>
                    <div class="col-md-8">
                        <form id="produkForm" method="GET">
                            <div class="d-flex">
                                <select name="produk_id" class="form-control" id="produk_id">
                                    <option value="">-- Pilih Produk --</option>
                                    <!-- Options will be populated by JavaScript -->
                                </select>
                                <button type="submit" class="btn btn-primary ml-1">Pilih</button>
                            </div>
                        </form>
                    </div>
                </div>

                <form action="/admin/transaksi/detail/create" method="POST">
                    @csrf

                    <input type="hidden" name='transaksi_id' value="{{ Request::segment(3) }}">
                    <input type="hidden" name='produk_id' id="hidden_produk_id" value="">
                    <input type="hidden" name='produk_name' id="hidden_produk_name" value="">
                    <input type="hidden" name='subtotal' id="hidden_subtotal" value="">

                    <div class="row mt-2">
                        <div class="col-md-4">
                            <label for="">Nama Produk</label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" value="" class="form-control" disabled name="nama_produk"
                                id="nama_produk" placeholder="Nama Produk">
                        </div>
                    </div>

                    <div class="row mt-2">
                        <div class="col-md-4">
                            <label for="">Harga Satuan</label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" value="" class="form-control" disabled name="harga_satuan"
                                id="harga_satuan" placeholder="Harga Satuan">
                        </div>
                    </div>

                    <div class="row mt-2">
                        <div class="col-md-4">
                            <label for="">QTY</label>
                        </div>
                        <div class="col-md-8">
                            <div class="d-flex">
                                <a href="#" class="btn btn-primary" id="qty-minus"><i
                                        class="fas fa-minus"></i></a>
                                <input type="number" value="1" class="form-control ml-1 mr-1" name="qty"
                                    id="qty" placeholder="QTY" disabled>
                                <a href="#" class="btn btn-primary" id="qty-plus"><i class="fas fa-plus"></i></a>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-2">
                        <div class="col-md-4"></div>
                        <div class="col-md-8">
                            <span class="text-primary">
                                <h5>Subtotal : Rp. <span id="subtotal">0</span></h5>
                            </span>
                        </div>
                    </div>

                    <div class="row mt-2">
                        <div class="col-md-4"></div>
                        <div class="col-md-8">
                            <a href="/admin/transaksi" class="btn btn-secondary"><i
                                    class="fas fa-arrow-left mr-2"></i>Kembali</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <table class="table mt-2">
                    <tr>
                        <th>No</th>
                        <th>Nama Produk</th>
                        <th>QTY</th>
                        <th>Subtotal</th>
                    </tr>
                    <!-- Rows will be populated by JavaScript -->
                </table>

                <a href="#" id="selesaiTransaksi" class="btn btn-success">
                    <i class="fas fa-check mr-2"></i>Selesai
                </a>
            </div>
        </div>
    </div>
</div>

<div class="row pl-2">
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <form id="hitungForm" action="" method="GET">
                    <div class="form-group">
                        <label for="">Total Belanja</label>
                        <input type="number" value="" name="total_belanja" class="form-control"
                            id="total_belanja">
                    </div>

                    <div class="form-group">
                        <label for="">Jumlah Bayar</label>
                        <input type="number" value="" name="jumlah_bayar" class="form-control"
                            id="jumlah_bayar">
                    </div>

                    <button type="submit" class="btn btn-primary btn-block mr-2">Hitung</button>
                </form>
                <hr>
                <div class="form-group">
                    <label for="">Uang Kembalian</label>
                    <input type="number" value="" disabled name="kembalian" class="form-control"
                        id="kembalian">
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const transaksiId = document.querySelector("input[name='transaksi_id']").value;

        document.getElementById("produkForm").addEventListener("submit", async function(e) {
            e.preventDefault();
            const produkId = document.getElementById("produk_id").value;
            if (produkId) {
                const selectedOption = document.querySelector(
                    `#produk_id option[value="${produkId}"]`);
                const produkName = selectedOption ? selectedOption.textContent.split(' - ')[1] : '';
                const hargaSatuan = selectedOption ? selectedOption.dataset.harga : '';

                document.getElementById("hidden_produk_id").value = produkId;
                document.getElementById("hidden_produk_name").value = produkName;
                document.getElementById("nama_produk").value = produkName;
                document.getElementById("harga_satuan").value = hargaSatuan;

                updateTransaksi(transaksiId, produkId, 'plus', 1);
                fetchTransactionDetails();
            }
        });

        async function updateTransaksi(id, produkId, action = 'plus', qty = 1) {
            console.log("Updating transaksi with:", {
                id,
                produkId,
                action,
                qty
            }); // Debugging sebelum request

            try {
                const response = await fetch(`/api/transaksi/${id}/edit`, {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json"
                    },
                    body: JSON.stringify({
                        produk_id: produkId,
                        action,
                        qty
                    })
                });

                const result = await response.json();
                console.log("Response from updateTransaksi:", result); // Debugging

                if (result.status === "success") {
                    await fetchTransactionDetails();
                } else {
                    console.error("Update transaction failed:", result.message);
                }
            } catch (error) {
                console.error("Error updating transaksi:", error);
            }
        }

        document.querySelectorAll("#qty-minus, #qty-plus").forEach(button => {
            button.addEventListener("click", function(e) {
                e.preventDefault();

                // Pastikan elemen tombol memiliki ikon <i>
                const icon = this.querySelector("i");
                if (!icon) {
                    console.error("Icon tidak ditemukan di dalam tombol:", this);
                    return;
                }

                const action = icon.classList.contains("fa-plus") ? "plus" : "minus";
                const qtyInput = document.getElementById("qty");

                if (!qtyInput) {
                    console.error("Elemen input QTY tidak ditemukan.");
                    return;
                }

                let qty = parseInt(qtyInput.value) || 1;
                if (action === "minus" && qty > 1) {
                    qty--;
                } else if (action === "plus") {
                    qty++;
                }
                qtyInput.value = qty;

                // Pastikan transaksiId dan produk_id tidak null
                const transaksiId = document.querySelector("input[name='transaksi_id']").value;
                const produkId = document.querySelector("input[name='produk_id']").value;

                if (!transaksiId || !produkId) {
                    document.querySelectorAll("#qty-minus, #qty-plus").forEach(button => {
                        button.addEventListener("click", function(e) {
                            e.preventDefault();
                            const icon = this.querySelector("i");
                            if (!icon) {
                                console.error(
                                    "Icon tidak ditemukan di dalam tombol:",
                                    this);
                                return;
                            }
                            const action = icon.classList.contains("fa-plus") ?
                                "plus" : "minus";
                            const qtyInput = document.getElementById("qty");
                            let qty = parseInt(qtyInput.value) || 1;
                            if (action === "minus" && qty > 1) {
                                qty--;
                            } else if (action === "plus") {
                                qty++;
                            }
                            qtyInput.value = qty;
                            updateTransaksi(transaksiId, document
                                .getElementById("hidden_produk_id").value,
                                action, qty);
                        });
                    });
                    console.error("Icon tidak ditemukan di dalam tombol:", this);
                    return;
                }
            });
        });

        document.getElementById("selesaiTransaksi").addEventListener("click", async function(e) {
            e.preventDefault();
            try {
                const response = await fetch(`/api/transaksi/detail/done/${transaksiId}`, {
                    method: "GET",
                    headers: {
                        "X-CSRF-TOKEN": document.querySelector("meta[name='csrf-token']")
                            .content
                    }
                });
                const result = await response.json();
                if (result.message === "Transaksi berhasil diselesaikan") {
                    alert("Transaksi selesai!");
                    location.href = "/admin/transaksi";
                }
            } catch (error) {
                console.error("Error finishing transaksi:", error);
            }
        });

        document.getElementById("hitungForm").addEventListener("submit", async function(e) {
            e.preventDefault();
            const jumlahBayar = document.getElementById("jumlah_bayar").value;
            try {
                const response = await fetch(`/api/transaksi/${transaksiId}/edit`, {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": document.querySelector("meta[name='csrf-token']")
                            .content
                    },
                    body: JSON.stringify({
                        jumlah_bayar: jumlahBayar
                    })
                });
                const result = await response.json();
                document.getElementById("kembalian").value = result.data.kembalian;
            } catch (error) {
                console.error("Error calculating change:", error);
            }
        });

        // Fetch and populate product options
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
                    const products = result.data.data;
                    const produkSelect = document.getElementById('produk_id');
                    products.forEach(product => {
                        const option = document.createElement('option');
                        option.value = product.id;
                        option.textContent = `${product.id} - ${product.name}`;
                        produkSelect.appendChild(option);
                    });
                } else {
                    console.error("Gagal mengambil data produk:", result.message);
                }
            } catch (error) {
                console.error("Error saat mengambil data:", error);
            }
        }

        // Fetch and populate transaction details
        async function fetchTransactionDetails() {
            try {
                const response = await fetch(`/api/transaksi/${transaksiId}`);
                const transaction = await response.json();

                console.log("Parsed Response:", transaction); // Debugging

                if (!transaction || !transaction.data) {
                    console.error("Transaction data is missing or invalid");
                    return;
                }

                // Pastikan mengambil data dengan benar
                const transaksiData = transaction.data;
                const detailTransaksi = transaksiData.details || [];

                // Update form dengan data transaksi (jika ada)
                document.querySelector("input[name='subtotal']").value = transaksiData.total || 0;
                document.getElementById("subtotal").textContent = transaksiData.total || 0;

                // Update tabel detail transaksi
                if (detailTransaksi.length > 0) {
                    const tableBody = document.querySelector("table tbody");
                    tableBody.innerHTML = "";

                    detailTransaksi.forEach((item, index) => {
                        const row = document.createElement("tr");
                        row.innerHTML = `
                    <td>${index + 1}</td>
                    <td>${item.produk_name}</td>
                    <td>${item.qty}</td>
                    <td>Rp. ${item.subtotal}</td>
                `;
                        tableBody.appendChild(row);
                    });
                }
            } catch (error) {
                console.error("Error fetching transaction details:", error);
            }
        }

        fetchProducts();
        fetchTransactionDetails();
    });
</script> --}}
