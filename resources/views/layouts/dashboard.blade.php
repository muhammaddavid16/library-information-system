<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>{{ $title ?? 'Perpustakaan' }}</title>

    <link rel="shortcut icon" href="{{ url('favicon.png') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ url('https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback') }}" />
    <link rel="stylesheet" href="{{ url('plugins/fontawesome-free/css/all.min.css') }}" />
    @if (Session::has('success') || Session::has('info') || Session::has('error') || $errors->has('error'))
    <link rel="stylesheet" href="{{ url('plugins/toastr/toastr.min.css') }}">
    @endif
    <link rel="stylesheet" href="{{ url('dist/css/adminlte.min.css') }}" />
    {{-- Page Styles --}}
    @yield('styles')
</head>
<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        {{-- Preloader --}}
        <div class="preloader flex justify-content-center align-items-center">
            <img src="{{ url('dist/img/GlobalPrimaIslamicLogo.png') }}" alt="Logo Global Prima Islamic School" height="60" width="60" />
        </div>

        {{-- Navbar --}}
        @include('layouts.partials.navbar')

        {{-- Main Sidebar Container --}}
        @include('layouts.partials.sidebar')

        {{-- Content Wrapper --}}
        <div class="content-wrapper">
            {{-- Content Header --}}
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">{{ $title ?? '' }}</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                @if (route('dashboard') === URL::current())
                                <li class="breadcrumb-item active">Beranda</li>
                                @else
                                <li class="breadcrumb-item">
                                    <a href="{{ route('dashboard') }}">Beranda</a>
                                </li>
                                <li class="breadcrumb-item active">{{ $title ?? '' }}</li>
                                @endif
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Main Content --}}
            <div class="content">
                @yield('content')
            </div>
        </div>

        {{-- Footer --}}
        @include('layouts.partials.footer')
    </div>

    <script src="{{ url('plugins/jquery/jquery.min.js') }}" type="text/javascript"></script>
    <script src="{{ url('plugins/bootstrap/js/bootstrap.bundle.min.js') }}" type="text/javascript"></script>
    @if (Session::has('success') || Session::has('info') || Session::has('error') || $errors->has('error'))
    <script src="{{ url('plugins/toastr/toastr.min.js') }}" type="text/javascript"></script>
    @endif
    <script src="{{ url('dist/js/adminlte.min.js') }}" type="text/javascript"></script>

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

    @if ($errors->has('error'))
    <script type="text/javascript">
        $(function () {
            toastr.error("{{ $errors->first('error') }}", "Gagal!");
        });
    </script>
    @endif
    {{-- Page specific script --}}
    @yield('scripts')
</body>
</html>
