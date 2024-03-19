<aside class="main-sidebar sidebar-dark-primary elevation-4">
    {{-- Brand Logo --}}
    <a href="{{ route('dashboard') }}" class="brand-link">
        <img src="{{ url('dist/img/GlobalPrimaIslamicLogo.png') }}" alt="Logo Global Prima Islamic School" class="brand-image img-circle elevation-3" />
        <span class="brand-text font-weight-light">Perpustakaan</span>
    </a>

    @php
        $urlCurrent = URL::current();
    @endphp
    {{-- Sidebar --}}
    <div class="sidebar">
        {{-- Sidebar Menu --}}
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column nav-legacy" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-header">MENU UTAMA</li>
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}" class="nav-link {{ route('dashboard') === $urlCurrent ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Beranda</p>
                    </a>
                </li>
                <li class="nav-item {{ route('members') === $urlCurrent || route('books') === $urlCurrent || route('categories') === $urlCurrent || route('bookshelves') === $urlCurrent ? 'menu-is-opening menu-open' : '' }}">
                    <a href="javascript:void(0)" class="nav-link {{ route('members') === $urlCurrent || route('books') === $urlCurrent || route('categories') === $urlCurrent || route('bookshelves') === $urlCurrent ? 'active' : '' }}">
                        <i class="nav-icon fas fa-folder"></i>
                        <p>
                            Data Utama
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview" {!! route('members') === $urlCurrent || route('books') === $urlCurrent || route('categories') === $urlCurrent || route('bookshelves') === $urlCurrent ? 'style="display: block;"' : '' !!}>
                        <li class="nav-item">
                            <a href="{{ route('members') }}" class="nav-link {{ route('members') === $urlCurrent ? 'active' : '' }}">
                                <i class="fas fa-users nav-icon"></i>
                                <p>Anggota</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('books') }}" class="nav-link {{ route('books') === $urlCurrent ? 'active' : '' }}">
                                <i class="fas fa-book nav-icon"></i>
                                <p>Buku</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('categories') }}" class="nav-link {{ route('categories') === $urlCurrent ? 'active' : '' }}">
                                <i class="fas fa-tags nav-icon"></i>
                                <p>Kategori</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('bookshelves') }}" class="nav-link {{ route('bookshelves') === $urlCurrent ? 'active' : '' }}">
                                <i class="fas fa-archive nav-icon"></i>
                                <p>Rak Buku</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item {{ route('loans') === $urlCurrent || route('loans.history') === $urlCurrent ? 'menu-is-opening menu-open' : '' }}">
                    <a href="javascript:void(0)" class="nav-link {{ route('loans') === $urlCurrent || route('loans.history') === $urlCurrent ? 'active' : '' }}">
                        <i class="nav-icon fas fa-cogs"></i>
                        <p>
                            Layanan
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview" {!! route('loans') === $urlCurrent || route('loans.history') === $urlCurrent ? 'style="display: block;"' : '' !!}>
                        <li class="nav-item">
                            <a href="{{ route('loans') }}" class="nav-link {{ route('loans') === $urlCurrent ? 'active' : '' }}">
                                <i class="fas fa-clipboard nav-icon"></i>
                                <p>Peminjaman Buku</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('loans.history') }}" class="nav-link {{ route('loans.history') === $urlCurrent ? 'active' : '' }}">
                                <i class="nav-icon fas fa-clipboard-check"></i>
                                <p>Riwayat Peminjaman</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item {{ route('report.loan') === $urlCurrent || route('report.return') === $urlCurrent ? 'menu-is-opening menu-open' : '' }}">
                    <a href="javascript:void(0)" class="nav-link {{ route('report.loan') === $urlCurrent || route('report.return') === $urlCurrent ? 'active' : '' }}">
                        <i class="nav-icon fas fa-file"></i>
                        <p>
                            Laporan
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview" {!! route('report.loan') === $urlCurrent || route('report.return') === $urlCurrent ? 'style="display: block;"' : '' !!}>
                        <li class="nav-item">
                            <a href="{{ route('report.loan') }}" class="nav-link {{ route('report.loan') === $urlCurrent ? 'active' : '' }}">
                                <i class="fas fa-clipboard nav-icon"></i>
                                <p>Peminjaman Buku</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('report.return') }}" class="nav-link {{ route('report.return') === $urlCurrent ? 'active' : '' }}">
                                <i class="fas fa-clipboard-check nav-icon"></i>
                                <p>Pengembalian Buku</p>
                            </a>
                        </li>
                    </ul>
                </li>
                @can('access-admin')
                <li class="nav-header">MENU ADMIN</li>
                <li class="nav-item">
                    <a href="{{ route('users') }}" class="nav-link {{ route('users') === $urlCurrent ? 'active' : '' }}">
                        <i class="nav-icon fas fa-user"></i>
                        <p>Pengguna</p>
                    </a>
                </li>
                @endcan
            </ul>
        </nav>
    </div>
</aside>