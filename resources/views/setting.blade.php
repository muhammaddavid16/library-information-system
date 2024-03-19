@extends('layouts.dashboard')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title">Pengaturan Denda</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <p>Atur tarif denda.</p>
                    </div>
                    <form action="{{ route('settings.update') }}" method="POST" autocomplete="off">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="is_active">
                                Aktivasi
                                <small class="text-danger">*aktifkan fitur denda</small>
                            </label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" name="is_active" id="is_active" class="custom-control-input" @checked($fineSetting->is_active) />
                                <label class="custom-control-label" for="is_active"></label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="fine_rate">
                                Tarif Denda <sub>(per hari)</sub>
                            </label>
                            <input type="text" name="fine_rate" id="fine_rate" class="form-control @error('fine_rate') is-invalid @enderror" value="{{ $fineSetting->fine_rate }}" @autofocus($errors->has('fine_rate')) />
                            @error('fine_rate')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <button type="reset" class="btn btn-dark">
                                Batal
                            </button>
                            <button type="submit" class="btn btn-primary">
                                Simpan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
