<!-- Sidebar -->
<div class="d-flex flex-column flex-shrink-0 p-3 text-dark bg-light" style="width: 250px; min-height: 100vh;">
    <div class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-dark text-decoration-none">
        <span class="fs-4">Fitur Owner</span>
    </div>
    <hr>

    <ul class="nav nav-pills flex-column mb-auto">
        <li class="nav-item">
            <a href="{{ route('owner.dashboard') }}"
                class="nav-link text-dark {{ request()->routeIs('owner.dashboard') ? 'active bg-primary text-white' : '' }}">
                <i class="bi bi-house"></i> Dashboard
            </a>
        </li>
        <li>
            <a href="{{ route('owner.buku') }}"
                class="nav-link text-dark {{ request()->routeIs('owner.buku') ? 'active bg-primary text-white' : '' }}">
                <i class="bi bi-book"></i> Management Buku
            </a>
        <li>
            <a href="{{ route('owner.data_user') }}"
                class="nav-link text-dark {{ request()->routeIs('owner.data_user') ? 'active bg-primary text-white' : '' }}">
                <i class="bi bi-person-badge"></i> Management user
            </a>
        </li>
        <li>
            <a href="{{ route('owner.penjualan') }}"
                class="nav-link text-dark {{ request()->routeIs('owner.penjualan') ? 'active bg-primary text-white' : '' }}">
                <i class="bi bi-cart"></i> Riwayat Penjualan
            </a>
        </li>
        <hr>
        <li>
            <!-- Tombol untuk buka modal logout -->
            <a href="#" class="nav-link text-dark" data-bs-toggle="modal" data-bs-target="#logoutModal">
                <i class="bi bi-box-arrow-right"></i> Logout
            </a>
        </li>
    </ul>
</div>
