@extends('layouts.dashboard')

@section('scripts')
<script type="text/javascript">
    $(function () {
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <a href="{{ route('loans.create') }}" class="btn btn-primary" title="Tambah data">
                        <i class="fas fa-plus"></i>
                        <span class="d-none d-sm-inline ml-2">Tambah data</span>
                    </a>
                        
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
                                <th>Pinjam</th>
                                <th>Kembali</th>
                                <th colspan="2">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($loans as $loan)
                                <tr>
                                    <td>{{ $loan->member?->name }}</td>
                                    <td>{{ $loan->book?->title }}</td>
                                    <td>{{ $loan->loan_date->isoFormat('D MMMM Y') }}</td>
                                    <td>{{ $loan->due_date->isoFormat('D MMMM Y') }}</td>
                                    <td>{{ $loan->loanTracking->total_borrowed }}</td>
                                    <td>{{ $loan->loanTracking->total_returned }}</td>
                                    <td>
                                        <div class="badge badge-warning">
                                            dipinjam
                                        </div>
                                    </td>
                                    <td style="width: 5%">
                                        <a href="{{ route('loans.process', $loan->id) }}" class="btn btn-sm btn-info" data-toggle="tooltip" data-placement="left" title="Proses transaksi">
                                            <i class="fas fa-cog"></i>
                                        </a>
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