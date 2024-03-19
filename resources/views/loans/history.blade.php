@extends('layouts.dashboard')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title">
                        Riwayat Peminjaman Buku
                    </h3>
                        
                    <div class="card-tools">
                        <form autocomplete="off">
                            <div class="input-group input-group-sm" style="width: 150px;">
                                <input type="text" name="cari" class="form-control float-right" value="{{ request('cari') ?? '' }}" placeholder="Cari..." />
            
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-default">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>Anggota</th>
                                <th>Buku</th>
                                <th>Tanggal Pinjam</th>
                                <th>Tenggat Waktu</th>
                                <th>Tanggal Kembali</th>
                                <th>Jumlah</th>
                                <th>Denda</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($loans as $loan)
                                <tr>
                                    <td>{{ $loan->member?->name }}</td>
                                    <td>{{ $loan->book?->title }}</td>
                                    <td>{{ $loan->loan_date->isoFormat('D MMMM Y') }}</td>
                                    <td>{{ $loan->due_date->isoFormat('D MMMM Y') }}</td>
                                    <td>{{ $loan->return_date->isoFormat('D MMMM Y') }}</td>
                                    <td>{{ $loan->loanTracking?->total_borrowed }}</td>
                                    <td>Rp. {{ number_format($loan->fine_amount, 2, ',', '.') }}</td>
                                    <td>
                                        <div class="badge badge-success">
                                            dikembalikan
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center">Tidak ada data ☹</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col flex-grow-0">
            {{ $loans->links() }}
        </div>
    </div>
</div>
@endsection