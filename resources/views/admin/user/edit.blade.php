<div class="container-fluid pt-2">
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5><b>{{ $title }}</b></h5>
                    <hr>

                    @isset($user)
                        <form id="editForm" action="/admin/user/{{ $user->id }}" method="POST">
                            @method('PUT')
                        @else
                            <form id="editForm" action="/admin/user" method="POST">
                            @endisset
                            @csrf
                            <div class="form-group">
                                <label for=""><b>Nama Lengkap</b></label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    name="name" placeholder="Nama Lengkap"
                                    value="{{ isset($user) ? $user->name : '' }}">

                                @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for=""><b>Email</b></label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                    name="email" placeholder="Email" value="{{ isset($user) ? $user->email : '' }}">

                                @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for=""><b>Password Lama</b></label>
                                <div class="input-group">
                                    <input type="password"
                                        class="form-control @error('old_password') is-invalid @enderror border-right-0"
                                        name="old_password" placeholder="Password Lama" id="old_password">
                                    <div class="input-group-append">
                                        <span class="input-group-text bg-white border-left-0" id="toggle-old-password"
                                            style="cursor: pointer;">
                                            <i class="fas fa-eye"></i>
                                        </span>
                                    </div>
                                </div>
                                @error('old_password')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for=""><b>Password Baru</b></label>
                                <div class="input-group">

                                    <input type="password" class="form-control @error('password') is-invalid @enderror border-right-0"
                                        name="password" placeholder="Password Baru" id="password">
                                    <div class="input-group-append">
                                        <span class="input-group-text bg-white border-left-0" id="toggle-password"
                                            style="cursor: pointer;">
                                            <i class="fas fa-eye"></i>
                                        </span>
                                    </div>
                                </div>

                                @error('password')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for=""><b>Konfirmasi Password</b></label>
                                <div class="input-group">

                                    <input type="password"
                                        class="form-control @error('re_password') is-invalid @enderror border-right-0"
                                        name="re_password" placeholder="Password" id="re_password">
                                    <div class="input-group-append">
                                        <span class="input-group-text bg-white border-left-0" id="toggle-re-password"
                                            style="cursor: pointer;">
                                            <i class="fas fa-eye"></i>
                                        </span>
                                    </div>
                                </div>

                                @error('re_password')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <a href=" /admin/user" class="btn btn-secondary"><i
                                    class="fas fa-arrow-left mr-2"></i>Kembali</a>
                            {{-- <button type="submit"  class="btn btn-primary" onclick="return confirm('Apakah anda yakin ingin mengubah data ini?')"><i
                                    class="fas fa-save mr-2"></i>Simpan</button> --}}
                            <button type="button" id="saveButton" class="btn btn-primary"><i
                                    class="fas fa-save mr-2"></i>Simpan</button>


                        </form>
                </div>
            </div>
        </div>
    </div>
</div>
