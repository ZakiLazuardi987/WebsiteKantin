
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
        document.addEventListener('DOMContentLoaded', function () {
            fetchKategoriData();
        });

        function fetchKategoriData() {
            axios.get('/api/kategori')
                .then(function (response) {
                    const kategori = response.data.data;
                    const kategoriTableBody = document.querySelector('#kategori-table tbody');
                    kategoriTableBody.innerHTML = '';

                    kategori.forEach((item, index) => {
                        const row = `
                            <tr>
                                <td>${index + 1}</td>
                                <td>${item.name}</td>
                                <td>
                                    <div class="d-flex">
                                        <a href="/admin/kategori/${item.id}/edit" class="btn btn-sm btn-info"><i
                                                class="fa fa-edit mr-1"></i>Edit</a>
                                        <form action="/admin/kategori/${item.id}" method="POST" class="delete-form">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger ml-1"><i
                                                    class="fa fa-trash mr-1"></i>Hapus</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        `;
                        kategoriTableBody.insertAdjacentHTML('beforeend', row);
                    });

                    // Handle pagination if needed
                    // const paginationLinks = response.data.links;
                    // document.querySelector('.d-flex.justify-content-right').innerHTML = paginationLinks;
                })
                .catch(function (error) {
                    console.error('Error fetching kategori data:', error);
                });
        }
    </script>
