@extends('layouts.dashboard')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title">Informasi Profil</h3>
            
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="from-group">
                        <p>Perbarui informasi profil anda.</p>
                    </div>
                    <form action="{{ route('profile.update', $user->id) }}" method="POST" autocomplete="off">
                        @csrf
                        @method('PATCH')
                        <div class="form-group">
                            <label for="name">
                                Nama lengkap
                            </label>
                            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ $user->name }}" @autofocus($errors->has('name')) />
                            @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="username">
                                Nama pengguna
                            </label>
                            <input type="text" name="username" id="username" class="form-control @error('username') is-invalid @enderror" value="{{ $user->username }}" @autofocus($errors->has('username')) />
                            @error('username')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div>
                            <button type="reset" class="btn btn-dark">
                                Batal
                            </button>
                            <button type="submit" class="btn btn-primary">
                                Simpan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row">
        <div class="col">
            <div class="card card-outline card-danger">
                <div class="card-header">
                    <h3 class="card-title">Perbarui Kata Sandi</h3>
            
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <p>Pastikan akun Anda menggunakan kata sandi yang panjang dan acak agar tetap aman.</p>
                    </div>
                    <form action="{{ route('profile.change-password', $user->id) }}" method="POST" autocomplete="off">
                        @csrf
                        @method('PATCH')
                        <div class="form-group">
                            <label for="current_password">
                                Kata sandi saat ini
                            </label>
                            <input type="password" name="current_password" id="current_password" class="form-control @error('current_password') is-invalid @enderror" @autofocus($errors->has('current_password')) />
                            @error('current_password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password">
                                Kata sandi baru
                            </label>
                            <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" @autofocus($errors->has('password')) />
                            @error('password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password_confirmation">
                                Konfirmasi kata sandi
                            </label>
                            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" />
                            @error('password_confirmation')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div>
                            <button type="reset" class="btn btn-dark">
                                Batal
                            </button>
                            <button type="submit" class="btn btn-primary">
                                Simpan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <div class="card card-outline card-danger">
                <div class="card-header">
                    <h3 class="card-title">Hapus akun</h3>
            
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <p>Setelah akun Anda dihapus, semua sumber daya dan datanya akan dihapus secara permanen. Sebelum menghapus akun Anda, harap unduh data atau informasi apa pun yang ingin Anda simpan.</p>
                    </div>
                    <div>
                        <button class="btn btn-danger" data-toggle="modal" data-target="#deleteModal">
                            Hapus akun
                        </button>
            
                        <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="deleteModalLabel">Apakah Anda yakin ingin menghapus akun Anda ?</h5>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <p>Setelah akun Anda dihapus, semua sumber daya dan datanya akan dihapus secara permanen. Silakan masukkan kata sandi Anda untuk mengonfirmasi bahwa Anda ingin menghapus akun Anda secara permanen.</p>
                                        </div>
                                        <form action="{{ route('profile.destroy', $user->id) }}" method="POST" autocomplete="off">
                                            @csrf
                                            @method('DELETE')
                                            <div class="form-group">
                                                <input type="password" name="old_password" class="form-control" placeholder="Kata sandi" />
                                            </div>
                                            <div class="float-right">
                                                <button type="button" class="btn btn-dark" data-dismiss="modal">
                                                    Batal
                                                </button>
                                                <button type="submit" class="btn btn-danger ml-2">
                                                    Hapus
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection