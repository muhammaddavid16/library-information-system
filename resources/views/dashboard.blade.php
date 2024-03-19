@extends('layouts.dashboard')

@section('scripts')
<script src="{{ url('https://cdn.jsdelivr.net/npm/chart.js') }}"></script>

<script type="text/javascript">
    $(async function () {
        const ctx = document.getElementById('loanChart').getContext('2d')
        const loadingElement = $('#loading');
        const chartCanvas = $('#loanChart');
        const url = "{{ route('api.loan-chart') }}";

        try {
            const csrfToken = "{{ csrf_token() }}";
            const response = await fetch(url, {
                method: 'GET',
                headers: {
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                }
            });

            const data = await response.json();

            chartCanvas.show();

            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: data.labels,
                    datasets: [{
                        label: data.datasets[0].label,
                        data: data.datasets[0].data,
                        backgroundColor: '#ffce56',
                    }, {
                        label: data.datasets[1].label,
                        data: data.datasets[1].data,
                        backgroundColor: '#dc3545',
                    }],
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true,
                        },
                    },
                },
            });

        } catch (error) {
            console.error('Error fetching data: ', error);
        } finally {
            loadingElement.hide();
        }
    });
</script>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-6 col-md-3">
            <div class="small-box bg-gradient-info">
                <div class="inner">
                    <h3>{{ $total_members }}</h3>
                    <p>Anggota</p>
                </div>
                <div class="icon">
                    <i class="fas fa-users"></i>
                </div>
                <a href="{{ route('members') }}" class="small-box-footer">
                    Lebih lanjut <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        <div class="col-sm-6 col-md-3">
            <div class="small-box bg-gradient-success">
                <div class="inner">
                    <h3>{{ $total_books }}</h3>
                    <p>Buku</p>
                </div>
                <div class="icon">
                    <i class="fas fa-book"></i>
                </div>
                <a href="{{ route('books') }}" class="small-box-footer">
                    Lebih lanjut <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        <div class="col-sm-6 col-md-3">
            <div class="small-box bg-gradient-warning">
                <div class="inner">
                    <h3>{{ $total_loans }}</h3>
                    <p>Peminjaman</p>
                </div>
                <div class="icon">
                    <i class="fas fa-clipboard"></i>
                </div>
                <a href="{{ route('loans') }}" class="small-box-footer">
                    Lebih lanjut <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        <div class="col-sm-6 col-md-3">
            <div class="small-box bg-gradient-danger">
                <div class="inner">
                    <h3>{{ $total_returns }}</h3>
                    <p>Pengembalian</p>
                </div>
                <div class="icon">
                    <i class="fas fa-clipboard-check"></i>
                </div>
                <a href="{{ route('loans.history') }}" class="small-box-footer">
                    Lebih lanjut <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Grafik Peminjaman Buku</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="chart">
                        <div id="loading" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%; display: flex; justify-content: center; align-items: center;">
                            <div class="spinner-border text-primary" role="status">
                                <span class="sr-only">Loading...</span>
                            </div>
                        </div>
                        <canvas id="loanChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;display: none;"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection