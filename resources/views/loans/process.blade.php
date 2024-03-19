@extends('layouts.dashboard')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col">
            <form action="{{ route('loans.update', $loan->id) }}" method="POST" autocomplete="off">
                @csrf
                @method('PATCH')
                <div class="card card-outline card-primary">
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col">
                                <a href="{{ route('loans') }}" class="btn btn-dark" tabindex="4">
                                    <i class="fas fa-arrow-left"></i>
                                    <span class="d-none d-sm-inline ml-2">Kembali</span>
                                </a>
            
                                <div class="float-right">
                                    <button type="reset" class="btn btn-dark" tabindex="3">
                                        <i class="fas fa-times mr-2"></i>
                                        Batal
                                    </button>
                                    <button type="submit" class="btn btn-primary" tabindex="2">
                                        <i class="fas fa-save mr-2"></i>
                                        Simpan
                                    </button>
                                </div>
                            </div>
                        </div>
            
                        <div class="row">
                            <div class="col-md-6 mb-3 mb-md-0">
                                <table class="table table-sm table-borderless">
                                    <tbody>
                                        <tr>
                                            <th>Anggota</th>
                                            <td>:</td>
                                            <td>{{ $loan->member?->name }}</td>
                                        </tr>
                                        <tr>
                                            <th>Buku</th>
                                            <td>:</td>
                                            <td>{{ $loan->book?->title }}</td>
                                        </tr>
                                        <tr>
                                            <th>Tanggal pinjam</th>
                                            <td>:</td>
                                            <td>{{ $loan->loan_date->isoFormat('D MMMM Y, HH:mm A') }}</td>
                                        </tr>
                                        <tr>
                                            <th>Tenggat waktu</th>
                                            <td>:</td>
                                            <td>{{ $loan->due_date->isoFormat('D MMMM Y, HH:mm A') }}</td>
                                        </tr>
                                        <tr>
                                            <th>Pinjam</th>
                                            <td>:</td>
                                            <td>{{ $loan->loanTracking?->total_borrowed }} buku</td>
                                        </tr>
                                        <tr>
                                            <th>Dikembalikan</th>
                                            <td>:</td>
                                            <td>{{ $loan->loanTracking?->total_returned }} buku</td>
                                        </tr>
                                        @can('activate-fine-setting')
                                        <tr>
                                            <th>Denda</th>
                                            <td>:</td>
                                            <td>{{ $loan->getFine() }}</td>
                                        </tr>
                                        @endcan
                                    </tbody>
                                </table>
                            </div>
            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="total_returned">
                                        Jumlah buku
                                        <small class="text-danger">*wajib diisi</small>
                                    </label>
                                    <input type="number" name="total_returned" id="total_returned" class="form-control @error('total_returned') is-invalid @enderror" placeholder="Jumlah buku yang dikembalikan" min="0" max="{{ $loan->loanTracking->getUnreturnedBook() }}" />
                                    @error('total_returned')
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