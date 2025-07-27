<ul class="sidebar-menu">
    <li class="menu-header">Menu Utama</li>

    {{-- Menu untuk Polsek --}}
    @if(auth()->user()->isUser())
        <li class="{{ request()->routeIs('polsek.beranda') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('polsek.beranda') }}">
                <i class="fas fa-fire"></i> <span>Beranda</span>
            </a>
        </li>
        <li class="{{ request()->routeIs('polsek.pengajuan.*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('polsek.pengajuan.riwayat') }}">
                <i class="fas fa-file-alt"></i> <span>Riwayat Pengajuan</span>
            </a>
        </li>
    @endif

    {{-- Menu untuk Admin (Polres & Super Admin) --}}
    @if(auth()->user()->isAdmin() || auth()->user()->isSuperAdmin())
        <li class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('admin.dashboard') }}">
                <i class="fas fa-tachometer-alt"></i> <span>Dashboard</span>
            </a>
        </li>
        <li class="{{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('admin.users.index') }}">
                <i class="fas fa-users"></i> <span>Manajemen User</span>
            </a>
        </li>
        <li class="{{ request()->routeIs('admin.police-stations.*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('admin.police-stations.index') }}">
                <i class="fas fa-building"></i> <span>Manajemen Lokasi</span>
            </a>
        </li>
    @endif

    {{-- Menu HANYA untuk Super Admin --}}
    @if(auth()->user()->isSuperAdmin())
        <li class="menu-header">Pengaturan Global</li>
        <li class="{{ request()->routeIs('admin.settings') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('admin.settings') }}">
                <i class="fas fa-cogs"></i> <span>Pengaturan Umum</span>
            </a>
        </li>
        <li class="{{ request()->routeIs('admin.sliders.*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('admin.sliders.index') }}">
                <i class="fas fa-images"></i> <span>Manajemen Slider</span>
            </a>
        </li>
        @endif
</ul>
