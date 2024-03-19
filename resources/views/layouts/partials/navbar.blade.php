<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    {{-- Left navbar links --}}
    <ul class="navbar-nav">
        <li class="nav-item">
            <a href="javascript:void(0)" class="nav-link" data-widget="pushmenu" role="button">
                <i class="fas fa-bars"></i>
            </a>
        </li>
    </ul>

    {{-- Right navbar links --}}
    <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown">
            <a href="javascript:void(0)" class="nav-link" data-toggle="dropdown">
                <i class="fas fa-user-circle"></i>
                <span class="ml-2">{{ Auth::user()->name ?? 'Guest' }}</span>
            </a>
            <div class="dropdown-menu py-2 dropdown-menu-lg dropdown-menu-right">
                <a href="{{ route('profile') }}" class="dropdown-item">
                    <i class="fas fa-user-cog mr-2"></i> Profil Saya
                </a>
                @can('access-admin')
                <a href="{{ route('settings') }}" class="dropdown-item">
                    <i class="fas fa-cog mr-2"></i> Pengaturan
                </a>
                @endcan
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="dropdown-item">
                        <i class="fas fa-sign-out-alt mr-2"></i> Keluar
                    </button>
                </form>
            </div>
        </li>
    </ul>
</nav>