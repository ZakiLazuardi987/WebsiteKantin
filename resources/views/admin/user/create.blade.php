<div class="container-fluid pt-2">
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5><b>{{ $title }}</b></h5>
                    <hr>

                    <form action="/admin/user" method="POST">
                        @csrf  
                        <div class="form-group">
                            <label for=""><b>Nama Lengkap</b></label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="Nama Lengkap">

                            @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for=""><b>Email</b></label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="Email">

                            @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for=""><b>Password</b></label>
                            <div class="input-group">
                                <input type="password" class="form-control @error('password') is-invalid @enderror border-right-0" name="password" placeholder="Password" id="password">
                                <div class="input-group-append">
                                    <span class="input-group-text bg-white border-left-0" id="toggle-password" style="cursor: pointer;">
                                        <i class="fas fa-eye"></i>
                                    </span>
                                </div>
                                @error('password')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label for=""><b>Konfirmasi Password</b></label>
                            <div class="input-group">
                                <input type="password" class="form-control @error('re_password') is-invalid @enderror border-right-0" name="re_password" placeholder="Password" id="re_password">
                                <div class="input-group-append">
                                    <span class="input-group-text bg-white border-left-0" id="toggle-re-password" style="cursor: pointer;">
                                        <i class="fas fa-eye"></i>
                                    </span>
                                </div>
                                @error('re_password')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        

                        <a href=" /admin/user" class="btn btn-secondary"><i
                                class="fas fa-arrow-left mr-2"></i>Kembali</a>
                        <button type="submit" class="btn btn-primary"><i class="fas fa-save mr-2"></i>Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
