@extends('layouts.dashboard')

@section('styles')
<link rel="stylesheet" href="{{ url('plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ url('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endsection

@section('scripts')
<script src="{{ url('plugins/select2/js/select2.full.min.js') }}"></script>

<script type="text/javascript">
    $(function () {
        $('.select2').select2({
            theme: 'bootstrap4'
        });
    });
</script>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col">
            <form action="{{ route('users.update', $user->id) }}" method="POST" autocomplete="off">
                @csrf
                @method('PUT')
                <div class="card card-outline card-primary">
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col">
                                <a href="{{ route('users') }}" class="btn btn-dark" tabindex="8">
                                    <i class="fas fa-arrow-left"></i>
                                    <span class="d-none d-sm-inline ml-2">Kembali</span>
                                </a>
            
                                <div class="float-right">
                                    <button type="reset" class="btn btn-dark" tabindex="7">
                                        <i class="fas fa-times mr-2"></i>
                                        Batal
                                    </button>
                                    <button type="submit" class="btn btn-primary" tabindex="6">
                                        <i class="fas fa-save mr-2"></i>
                                        Simpan
                                    </button>
                                </div>
                            </div>
                        </div>
            
                        <div class="row">
                            <div class="col-lg-7">
                                <div class="form-group">
                                    <label for="name">
                                        Nama lengkap
                                        <small class="text-danger">*wajib diisi</small>
                                    </label>
                                    <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" @autofocus(($errors->has('name') ? true : (old('name') ? false : true))) value="{{ $user->name }}" tabindex="1" />
                                    @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="username">
                                        Nama pengguna
                                        <small class="text-danger">*wajib diisi</small>
                                    </label>
                                    <input type="text" name="username" id="username" class="form-control @error('username') is-invalid @enderror" value="{{ $user->username }}" @autofocus($errors->has('username')) tabindex="2" />
                                    @error('username')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
            
                            <div class="col-lg-5">
                                <div class="form-group">
                                    <label for="role">
                                        Peran
                                    </label>
                                    <select name="role" id="role" class="form-control select2 @error('role') is-invalid @enderror" data-placeholder="Pilih Peran" tabindex="5" style="width: 100%">
                                        <option value="admin" @selected($user->role == 'admin')>
                                            Administrator
                                        </option>
                                        <option value="staff" @selected($user->role == 'staff')>
                                            Staff
                                        </option>
                                    </select>
                                    @error('role')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection