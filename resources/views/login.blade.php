<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'Log in' }}</title>
    <link rel="shortcut icon" href="{{ url('favicon.png') }}" type="image/x-icon">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="{{ url('/plugins/fontawesome-free/css/all.min.css') }}">
    @if (Session::has('success') || Session::has('info') || Session::has('error'))
    <link rel="stylesheet" href="{{ url('plugins/toastr/toastr.min.css') }}">
    @endif
    <link rel="stylesheet" href="{{ url('/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ url('/dist/css/adminlte.min.css') }}">
</head>
<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <h2>
                <strong>SISTEM INFORMASI PERPUSTAKAAN</strong>
            </h2>
        </div>

        @error('error')
        <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            {{ $message }}
        </div>
        @enderror

        <div class="card mb-3">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Selamat Datang</p>

                <form action="{{ route('authenticate') }}" method="POST" autocomplete="off">
                    @csrf
                    <div class="mb-3">
                        <div class="input-group">
                            <input type="text" name="username" class="form-control @error('username') is-invalid @enderror" placeholder="Nama pengguna" value="{{ old('username') }}" {{ $errors->has('username') ? 'autofocus' : '' }} />
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-user"></span>
                                </div>
                            </div>
                        </div>

                        @error('username')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <div class="input-group">
                            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Kata sandi" {{ $errors->has('password') ? 'autofocus' : '' }} />
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                        </div>
                        @error('password')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="row">
                        <div class="col-sm-8 gap-2">
                            <div class="icheck-primary">
                                <input type="checkbox" name="remember" id="remember" @checked(old('remember')) />
                                <label for="remember">
                                    Ingat saya
                                </label>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <button type="submit" class="btn btn-primary btn-block">Masuk</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <script src="{{ url('/plugins/jquery/jquery.min.js') }}" type="text/javascript"></script>
    <script src="{{ url('/plugins/bootstrap/js/bootstrap.bundle.min.js') }}" type="text/javascript"></script>
    @if (Session::has('success') || Session::has('info') || Session::has('error'))
    <script src="{{ url('plugins/toastr/toastr.min.js') }}" type="text/javascript"></script>
    @endif
    <script src="{{ url('/dist/js/adminlte.min.js') }}" type="text/javascript"></script>
    @if (Session::has('success'))
    <script type="text/javascript">
        $(function () {
            toastr.success("{{ Session::get('success') }}", "Berhasil!");
        });
    </script>
    @endif

    @if (Session::has('info'))
    <script type="text/javascript">
        $(function () {
            toastr.info("{{ Session::get('info') }}", "Informasi!");
        });
    </script>
    @endif

    @if (Session::has('error'))
    <script type="text/javascript">
        $(function () {
            toastr.error("{{ Session::get('error') }}", "Gagal!");
        });
    </script>
    @endif
</body>
</html>
