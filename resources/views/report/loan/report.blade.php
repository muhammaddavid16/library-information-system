<!DOCTYPE html>
<html lang="en">
<head>
    <title>{{ $title }}</title>
    <link rel="stylesheet" href="{{ url('dist/css/adminlte.min.css') }}">
</head>
<body>
    <div class="container-fluid mt-5">
        <div class="row">
            <div class="col-md-12">
                <h2 class="text-center">
                    <strong>
                        {{ $title }}
                    </strong>
                </h2>
                <h4 class="text-center">
                    <strong>
                        Bulan : {{ $month }}
                    </strong>
                </h4>
                <table class="table table-sm table-striped mt-5">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Anggota</th>
                            <th>Judul Buku</th>
                            <th class="text-center">Tanggal Pinjam</th>
                            <th class="text-center">Tenggat Waktu</th>
                            <th class="text-right">Pinjam</th>
                            <th class="text-right">Kembali</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($loans as $loan)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $loan->member->name }}</td>
                            <td>{{ $loan->book->title }}</td>
                            <td class="text-center">{{ $loan->loan_date->isoFormat('D MMMM Y') }}</td>
                            <td class="text-center">{{ $loan->due_date->isoFormat('D MMMM Y') }}</td>
                            <td class="text-right">{{ $loan->loanTracking->total_borrowed }} buku</td>
                            <td class="text-right">{{ $loan->loanTracking->total_returned }} buku</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center">Tidak ada data ☹</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>
