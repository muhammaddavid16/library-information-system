@extends('layouts.dashboard')

@section('styles')
<link rel="stylesheet" href="{{ url('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
@endsection

@section('scripts')
<script src="{{ url('plugins/moment/moment.min.js') }}"></script>
<script src="{{ url('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>

<script type="text/javascript">
    $(function () {
        $('#month').datetimepicker({
            viewMode: 'months',
            format: 'MM/YYYY',
        });
    });
</script>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title">
                        Pilih Bulan untuk Laporan Pengembalian
                    </h3>
                </div>

                <div class="card-body">
                    <form action="{{ route('report.generate-return') }}" method="POST" autocomplete="off">
                        @csrf
                        <div class="form-group">
                            <label for="month">
                                Bulan
                            </label>
                            <input type="text" name="month" id="month" class="form-control @error('month') is-invalid @enderror" value="{{ date('m/Y') }}" data-toggle="datetimepicker" data-target="#month" />
                            @error('month')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Buat Laporan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection