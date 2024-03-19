@extends('layouts.dashboard')

@section('styles')
<link rel="stylesheet" href="{{ url('plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ url('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ url('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
@endsection

@section('scripts')
<script src="{{ url('plugins/select2/js/select2.full.min.js') }}"></script>
<script src="{{ url('plugins/moment/moment.min.js') }}"></script>
<script src="{{ url('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>

<script>
    $(function () {
        $('.select2').select2({
            theme: 'bootstrap4'
        });

        $('#loan_date').datetimepicker({
            icons: { time: 'far fa-clock' },
            defaultDate: new Date()
        });

        let tomorrow = new Date();
        tomorrow.setDate(tomorrow.getDate() + 1);
        $('#due_date').datetimepicker({
            icons: { time: 'far fa-clock' },
            defaultDate: tomorrow,
        });
    });
</script>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col">
            <form action="{{ route('loans.store') }}" method="POST" autocomplete="off">
                @csrf
                <div class="card card-outline card-blue">
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col">
                                <a href="{{ route('loans') }}" class="btn btn-dark" tabindex="8">
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
                            <div class="col-md-7 order-2 order-md-1">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="loan_date">
                                                Tanggal pinjam
                                                <small class="text-danger">*wajib diisi</small>
                                            </label>
                                            <input type="text" name="loan_date" id="loan_date" class="form-control datetimepicker datetimepicker-input" value="{{ old('loan_date') }}" tabindex="1" data-toggle="datetimepicker" data-target="#loan_date" @autofocus(($errors->has('loan_date') ? true : (old('loan_date') ? false : true))) />
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="due_date">
                                                Tenggat waktu
                                                <small class="text-danger">*wajib diisi</small>
                                            </label>
                                            <input type="text" name="due_date" id="due_date" class="form-control datetimepicker datetimepicker-input" value="{{ old('due_date') }}" tabindex="2" data-toggle="datetimepicker" data-target="#due_date" @autofocus($errors->has('due_date')) />
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="total_borrowed">
                                        Jumlah buku
                                        <small class="text-danger">*wajib diisi</small>
                                    </label>
                                    <input type="number" name="total_borrowed" id="total_borrowed" class="form-control @error('total_borrowed') is-invalid @enderror" min="1" value="{{ old('total_borrowed') }}" @autofocus($errors->has('total_borrowed')) tabindex="3" />
                                    @error('total_borrowed')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
            
                            <div class="col-md-5 order-1 order-md-2">
                                <div class="form-group">
                                    <label for="member_id">
                                        Anggota
                                        <small class="text-danger">*wajib diisi</small>
                                    </label>
                                    <select name="member_id" id="member_id" class="form-control select2 @error('member_id') is-invalid @enderror" data-placeholder="Pilih Anggota" @autofocus($errors->has('member_id')) tabindex="4" style="width: 100%">
                                        <option></option>
                                        @foreach ($members as $member)
                                            <option value="{{ $member['id'] }}" @selected(old('member_id'))>
                                                {{ $member['name'] }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('member_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="book_id">
                                        Buku
                                        <small class="text-danger">*wajib diisi</small>
                                    </label>
                                    <select name="book_id" id="book_id" class="form-control select2 @error('book_id') is-invalid @enderror" data-placeholder="Pilih Buku" @autofocus($errors->has('book_id')) tabindex="5" style="width: 100%">
                                        <option></option>
                                        @foreach ($books as $book)
                                            <option value="{{ $book['id'] }}" @selected(old('book_id'))>
                                                {{ $book['title'] }}
                                                ({{ $book['quantity'] }} buku)
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('book_id')
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