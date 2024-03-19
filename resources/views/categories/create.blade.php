@extends('layouts.dashboard')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col">
            <form action="{{ route('categories.store') }}" method="POST" autocomplete="off">
                @csrf
                <div class="card card-outline card-primary">
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col">
                                <a href="{{ route('categories') }}" class="btn btn-dark" tabindex="5">
                                    <i class="fas fa-arrow-left"></i>
                                    <span class="d-none d-sm-inline ml-2">Kembali</span>
                                </a>
            
                                <div class="float-right">
                                    <button type="reset" class="btn btn-dark" tabindex="4">
                                        <i class="fas fa-times mr-2"></i>
                                        Batal
                                    </button>
                                    <button type="submit" class="btn btn-primary" tabindex="3">
                                        <i class="fas fa-save mr-2"></i>
                                        Simpan
                                    </button>
                                </div>
                            </div>
                        </div>
            
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="name">
                                        Kategori
                                        <small class="text-danger">*wajib diisi</small>
                                    </label>
                                    <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" @autofocus(($errors->has('name') ? true : (old('name') ? false : true))) tabindex="1" />
                                    @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="description">
                                        Keterangan
                                    </label>
                                    <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror" rows="4" placeholder="(opsional)" tabindex="2">{{ old('description') }}</textarea>
                                    @error('description')
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