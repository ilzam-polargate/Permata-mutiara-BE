<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="">
        <div class="sidebar-brand-text mx-3">{{ auth()->user()->role}}</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{ Str::startsWith(request()->route()->getName(), 'dashboard') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Data Management
    </div>

    <!-- Nav Item - Charts -->
    <li class="nav-item {{ Str::startsWith(request()->route()->getName(), 'kamar') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('kamar.index') }}">
            <i class="bi bi-houses"></i>
            <span>Kamar</span>
        </a>
    </li>

    @if(auth()->user() && auth()->user()->role == 'superadmin')
    <li class="nav-item {{ Str::startsWith(request()->route()->getName(), 'user') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('user.index') }}">
            <i class="bi bi-people-fill"></i>
            <span>Admin</span>
        </a>
    </li>
@endif

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Penyewaan
    </div>

    <li class="nav-item {{ Str::startsWith(request()->route()->getName(), 'pesanan.baru') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('pesanan.baru') }}">
            <i class="bi bi-journal-arrow-up"></i>
            <span>Pemesanan Baru</span>
        </a>
    </li>

    <li class="nav-item {{ Str::startsWith(request()->route()->getName(), 'sewa.berlangsung') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('sewa.berlangsung') }}">
            <i class="bi bi-journal-check"></i>
            <span>Sewa Berlangsung</span>
        </a>
    </li>

    <li class="nav-item {{ Str::startsWith(request()->route()->getName(), 'riwayat.transaksi') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('riwayat.transaksi') }}">
            <i class="bi bi-journal-arrow-down"></i>
            <span>Riwayat Transaksi</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Pages
    </div>

    <li class="nav-item {{ Str::startsWith(request()->route()->getName(), 'page.index') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('page.index') }}">
            <i class="bi bi-gear"></i>
            <span>Setting Halaman</span>
        </a>
    </li>

    <li class="nav-item {{ Str::startsWith(request()->route()->getName(), 'page.index') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('page.index') }}">
            <i class="bi bi-gear-wide-connected"></i>
            <span>Setting</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="/">
            <i class="fas fa-fxw fa-home"></i>
            <span>Halaman Utama</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>