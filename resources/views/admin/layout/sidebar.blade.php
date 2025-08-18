<div class="d-flex flex-column flex-shrink-0 p-3 text-dark bg-light" style="width: 250px; min-height: 100vh;">
    <div class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-dark text-decoration-none">
        <span class="fs-4">Fitur Admin</span>
    </div>
    <hr>
    <ul class="nav nav-pills flex-column mb-auto">
        <li class="nav-item">
            <a href="{{ route('admin.dashboard') }}"
                class="nav-link text-dark {{ request()->routeIs('admin.dashboard') ? 'active bg-primary text-white' : '' }}">
                <i class="bi bi-house"></i> Dashboard
            </a>
        </li>
        <li>
            <a href="{{ route('admin.management_buku') }}"
                class="nav-link text-dark {{ request()->routeIs('admin.management_buku') ? 'active bg-primary text-white' : '' }}">
                <i class="bi bi-book"></i> Management Buku
            </a>
        </li>
        <li>
            <a href="{{ route('admin.management_kasir') }}"
                class="nav-link text-dark {{ request()->routeIs('admin.management_kasir') ? 'active bg-primary text-white' : '' }}">
                <i class="bi bi-person-badge"></i> Management Kasir
            </a>
        </li>
        <li>
            <a href="{{ route('admin.riwayat_transaksi') }}"
                class="nav-link text-dark {{ request()->routeIs('admin.riwayat_transaksi') ? 'active bg-primary text-white' : '' }}">
                <i class="bi bi-cart"></i> Riwayat Transaksi
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

        <!-- Modal Konfirmasi Logout -->
        <div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title" id="logoutModalLabel">Konfirmasi Logout</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Apakah Anda yakin ingin logout?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="btn btn-primary">Ya, Logout</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </ul>
</div>
