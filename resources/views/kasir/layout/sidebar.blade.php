<div class="d-flex flex-column flex-shrink-0 p-3 text-dark bg-light" style="width: 250px; min-height: 100vh;">
    <div class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-dark text-decoration-none">
        <span class="fs-4">Fitur Kasir</span>
    </div>
    <hr>
    <ul class="nav nav-pills flex-column mb-auto">
        <li class="nav-item">
            <a href="{{ route('kasir.dashboard') }}"
                class="nav-link text-dark {{ request()->routeIs('kasir.dashboard') ? 'active bg-primary text-white' : '' }}">
                <i class="bi bi-house"></i> Dashboard
            </a>
        </li>
        <li>
            <a href="{{ route('kasir.data_buku') }}"
                class="nav-link text-dark {{ request()->routeIs('kasir.data_buku') ? 'active bg-primary text-white' : '' }}">
                <i class="bi bi-book"></i> Data Buku
            </a>
        </li>
        <li>
            <a href="{{ route('kasir.transaksi') }}"
                class="nav-link text-dark {{ request()->routeIs('kasir.transaksi') ? 'active bg-primary text-white' : '' }}">
                <i class="bi bi-cart"></i> Transaksi
            </a>
        </li>
        <li>
            <a href="{{ route('kasir.riwayat_transaksi') }}"
                class="nav-link text-dark {{ request()->routeIs('kasir.riwayat_transaksi') ? 'active bg-primary text-white' : '' }}">
                <i class="bi bi-receipt"></i> Riwayat Transaksi
            </a>
        </li>
        <hr>
        <ul class="nav flex-column">
            <li>
                <!-- Tombol untuk buka modal logout -->
                <a href="#" class="nav-link text-dark" data-bs-toggle="modal" data-bs-target="#logoutModal">
                    <i class="bi bi-box-arrow-right"></i> Logout
                </a>
            </li>
        </ul>

    </ul>
</div>
