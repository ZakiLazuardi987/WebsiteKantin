<div class="container-fluid pt-2">
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body ">
                    <h5><b>{{ $title }}</b></h5>
                    <hr>

                    <form action="/admin/produk" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('POST')
                        <div class="form-group">
                            <label for="name">Nama Produk</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                name="name" placeholder="Nama Produk" value="{{ old('name') }}">

                            @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                            <label for="name">Kategori</label>
                            <select name="kategori_id" class="form-control @error('kategori_id') is-invalid @enderror">
                                <option value="">-- Pilih Kategori --</option>
                                @foreach ($kategori as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>

                            @error('kategori_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                            <label for="harga">Harga</label>
                                <input type="number" class="form-control @error('harga') is-invalid @enderror"
                                name="harga" placeholder="Harga" value="{{ old('harga') }}">

                            @error('harga')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                            <label for="stok">Stok</label>
                                <input type="number" class="form-control @error('stok') is-invalid @enderror"
                                name="stok" placeholder="Stok" value="{{ old('stok') }}">

                            @error('stok')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                            <label for="stok">Keterangan</label>
                                <input type="text" class="form-control @error('keterangan') is-invalid @enderror"
                                name="keterangan" placeholder="Keterangan" value="{{ old('keterangan') }}">

                            @error('keterangan')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                            <label for="gambar">Gambar</label>
                            <input type="file" class="form-control @error('gambar') is-invalid @enderror"
                                name="gambar" placeholder="Pilih Gambar" value="{{ old('gambar') }}">

                            @error('gambar')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <a href="/admin/produk" class="btn btn-secondary"><i
                                class="fas fa-arrow-left mr-2"></i>Kembali</a>
                        <button type="submit" class="btn btn-primary"><i class="fas fa-save mr-2"></i>Simpan</button>
                </div>
            </div>
        </div>
    </div>
</div>
