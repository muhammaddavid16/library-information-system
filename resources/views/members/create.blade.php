@extends('layouts.dashboard')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col">
            <form action="{{ route('members.store') }}" method="POST" autocomplete="off">
                @csrf
                <div class="card card-outline card-primary">
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col">
                                <a href="{{ route('members') }}" class="btn btn-dark" tabindex="8">
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
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nis">
                                        NIS
                                        <small class="text-danger">*wajib diisi</small>
                                    </label>
                                    <input type="text" name="nis" id="nis" class="form-control @error('nis') is-invalid @enderror" value="{{ old('nis') }}" @autofocus(($errors->has('nis') ? true : (old('nis') ? false : true))) tabindex="1" />
                                    @error('nis')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="name">
                                        Nama lengkap
                                        <small class="text-danger">*wajib diisi</small>
                                    </label>
                                    <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" @autofocus($errors->has('name')) tabindex="2" />
                                    @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="class">
                                        Kelas
                                        <small class="text-danger">*wajib diisi</small>
                                    </label>
                                    <input type="text" name="class" id="class" class="form-control @error('class') is-invalid @enderror" value="{{ old('class') }}" @autofocus($errors->has('class')) tabindex="3" />
                                    @error('class')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="phone_number">
                                        Nomor telepon
                                    </label>
                                    <input type="tel" name="phone_number" id="phone_number" class="form-control @error('phone_number') is-invalid @enderror" value="{{ old('phone_number') }}" placeholder="(opsional)" @autofocus($errors->has('phone_number')) tabindex="4" />
                                    @error('phone_number')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="address">
                                        Alamat
                                    </label>
                                    <textarea name="address" id="address" class="form-control" rows="3" placeholder="(opsional)" tabindex="5">{{ old('address') }}</textarea>
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