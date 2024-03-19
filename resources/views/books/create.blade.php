@extends('layouts.dashboard')

@section('styles')
<link rel="stylesheet" href="{{ url('plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ url('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endsection

@section('scripts')
<script src="{{ url('plugins/select2/js/select2.full.min.js') }}"></script>

<script type="text/javascript">
    $(function() {
        $('.select2').select2({
            theme: 'bootstrap4',
            width: 'resolve',
        });
    });
</script>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col">
            <form action="{{ route('books.store') }}" method="POST" autocomplete="off">
                @csrf
                <div class="card card-outline card-primary">
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col">
                                <a href="{{ route('books') }}" class="btn btn-dark" tabindex="10">
                                    <i class="fas fa-arrow-left"></i>
                                    <span class="d-none d-sm-inline ml-2">Kembali</span>
                                </a>

                                <div class="float-right">
                                    <button type="reset" class="btn btn-dark" tabindex="9">
                                        <i class="fas fa-times mr-2"></i>
                                        Batal
                                    </button>
                                    <button type="submit" class="btn btn-primary" tabindex="8">
                                        <i class="fas fa-save mr-2"></i>
                                        Simpan
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-7">
                                <div class="form-group">
                                    <label for="isbn">
                                        ISBN
                                        <small class="text-danger">*wajib diisi</small>
                                    </label>
                                    <input type="text" name="isbn" id="isbn" class="form-control @error('isbn') is-invalid @enderror" value="{{ old('isbn') }}" @autofocus(($errors->has('isbn') ? true : (old('isbn') ? false : true))) tabindex="1" />
                                    @error('isbn')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="title">
                                        Judul
                                        <small class="text-danger">*wajib diisi</small>
                                    </label>
                                    <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}" @autofocus($errors->has('title')) tabindex="2" />
                                    @error('title')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="publisher">
                                        Penerbit
                                    </label>
                                    <input type="text" name="publisher" id="publisher" class="form-control @error('publisher') is-invalid @enderror" value="{{ old('publisher') }}" @autofocus($errors->has('publisher')) tabindex="3" />
                                    @error('publisher')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="row">
                                    <div class="col-xl-6">
                                        <div class="form-group">
                                            <label for="publication_year">
                                                Tahun terbit
                                                <small class="text-danger">*wajib diisi</small>
                                            </label>
                                            <input type="number" name="publication_year" id="publication_year" class="form-control @error('publication_year') is-invalid @enderror" min="1900" max="{{ date('Y') }}" value="{{ old('publication_year') }}" placeholder="1900 ~ {{ date('Y') }}" @autofocus($errors->has('publication_year')) tabindex="4" />
                                            @error('publication_year')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="form-group">
                                            <label for="quantity">
                                                Stok buku
                                            </label>
                                            <input type="number" name="quantity" id="quantity" class="form-control @error('quantity') is-invalid @enderror" min="0" value="{{ old('quantity') }}" @autofocus($errors->has('quantity')) tabindex="5" />
                                            @error('quantity')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
            
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="category_id">
                                        Kategori
                                        <small class="text-danger">*wajib diisi</small>
                                    </label>
                                    <select name="category_id" id="category_id" class="select2 @error('category_id') is-invalid @enderror" data-tags="true" data-placeholder="Pilih kategori" tabindex="6" style="width: 100%">
                                        <option></option>
                                        @foreach ($categories as $category)
                                        <option value="{{ $category['id'] }}" @selected(old('category_id') === $category['id'])>{{ $category['name'] }}</option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="bookshelf_id">
                                        Rak buku
                                        <small class="text-danger">*wajib diisi</small>
                                    </label>
                                    <select name="bookshelf_id" id="bookshelf_id" class="select2 @error('bookshelf_id') is-invalid @enderror" data-tags="true" data-placeholder="Pilih rak buku" tabindex="7" style="width: 100%">
                                        <option></option>
                                        @foreach ($bookshelves as $bookshelf)
                                        <option value="{{ $bookshelf['id'] }}" @selected(old('bookshelf_id') === $bookshelf['id'])>{{ $bookshelf['name'] }}</option>
                                        @endforeach
                                    </select>
                                    @error('bookshelf_id')
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