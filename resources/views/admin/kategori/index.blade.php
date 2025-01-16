<div class="container-fluid pt-2">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body ">
                    <h5><b>{{ $title }}</b></h5>
                    <hr>

                    <a href="/admin/kategori/create" class="btn btn-primary mt-2 mb-2"><i
                            class="fas fa-plus mr-2"></i>Tambah</a>
                    <table class="table mt-2">
                        <tr>
                            <th>No</th>
                            <th>Nama Kategori</th>
                            <th>Action</th>
                        </tr>

                        @foreach ($kategori as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->name }}</td>
                                <td>
                                    <div class="d-flex">
                                        <a href="/admin/kategori/{{ $item->id }}/edit" class="btn btn-sm btn-info"><i
                                                class="fa fa-edit mr-1"></i>Edit</a>
                                        {{-- <a href="" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i>Hapus</a> --}}
                                        <form action="/admin/kategori/{{ $item->id }}" method="POST">
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

                    <div class="d-flex justify-content-right">
                        {{ $kategori->links() }}
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
