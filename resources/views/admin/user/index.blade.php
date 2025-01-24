<div class="container-fluid pt-2">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h5><b>{{ $title }}</b></h5>
                    <hr>

                    <div class="d-flex justify-content-between align-items-center mt-4 mb-3">
                        <a href="/admin/user/create" class="btn btn-primary"><i class="fas fa-plus mr-2"></i>Tambah</a>
                        <form action="/admin/user" method="GET" class="form-inline">
                            <div class="input-group">
                                <input type="text" name="search" class="form-control" placeholder="Cari User" value="{{ request('search') }}">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-secondary"><i class="fas fa-search"></i> Cari</button>
                                </div>
                            </div>
                        </form>
                    </div>

                    @if (@session()->has('success'))
                        <div class="alert alert-success mt-2"><i class="fas fa-check mr-1"></i>
                            {{ session('success') }}
                        </div>
                    @endif

                    <table class="table mt-2 ">
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Action</th>
                        </tr>

                        @foreach ($user as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->email }}</td>
                                <td>
                                    <div class="d-flex">
                                        <a href="/admin/user/{{ $item->id }}/edit" class="btn btn-sm btn-info"><i
                                                class="fa fa-edit mr-1"></i>Edit</a>
                                        <form action="/admin/user/{{ $item->id }}" method="POST"
                                            class="delete-form">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger ml-1"><i
                                                    class="fa fa-trash mr-1"></i>Hapus</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
