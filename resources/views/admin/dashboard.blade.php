    <title>Dashboard admin</title>

    <body>
        @extends('admin.layout.admin_layout')
        @section('content')
            <div class="row">
                <div class="col-md-12">
                    <h1>Dashboard</h1>
                    @if (auth()->user('admin'))
                        <p>Halo Admin!
                            Selamat datang di dashboard admin.
                        </p>
                    @endif
                </div>
            </div>

            <div class="row">
                <!-- Card Total Buku -->
                <div class="col-md-4">
                    <div class="card text-white bg-primary mb-3">
                        <div class="card-body d-flex justify-content-between align-items-center">
                            <div>
                                <h5 class="card-title">Total Buku</h5>
                                <p class="card-text">{{ $totalBuku }}</p>
                            </div>
                            <i class="bi bi-book-fill fs-1 opacity-75"></i>
                        </div>
                    </div>
                </div>

                <!-- Card Total User -->
                <div class="col-md-4">
                    <div class="card text-white bg-success mb-3">
                        <div class="card-body d-flex justify-content-between align-items-center">
                            <div>
                                <h5 class="card-title">Total User</h5>
                                <p class="card-text">{{ $totaluser }}</p>
                            </div>
                            <i class="bi bi-people-fill fs-1 opacity-75"></i>
                        </div>
                    </div>
                </div>
            </div>


            <!--data buku-->
            <div class="container mt-4">
                <div class="row">
                    @foreach ($buku as $item)
                        <div class="col-md-2 col-sm-4 col-6 mb-4">
                            <div class="card h-100 shadow-sm rounded-3 text-center p-2">
                                <!-- Cover Buku -->
                                @if ($item->cover_buku)
                                    <img src="{{ asset('storage/' . $item->cover_buku) }}" alt="Cover Buku"
                                        class="img-thumbnail mx-auto d-block mt-2"
                                        style="width: 100px; height: 140px; object-fit: cover;">
                                @else
                                    <span class="badge bg-secondary m-3">Tidak ada cover</span>
                                @endif

                                <!-- Detail Buku -->
                                <div class="card-body p-2">
                                    <h6 class="card-title fw-bold text-truncate" title="{{ $item->judul_buku }}">
                                        {{ $item->judul_buku }}
                                    </h6>
                                    <p class="mb-1 text-muted small">
                                        <i class="bi bi-tag-fill text-primary"></i> {{ $item->kategori }}
                                    </p>
                                    <p class="mb-2 text-muted small">
                                        <i class="bi bi-calendar-fill text-success"></i> {{ $item->tahun_terbit }}
                                    </p>
                                    <!-- Tombol Detail -->
                                    <button class="btn btn-sm btn-outline-primary w-100" data-bs-toggle="modal"
                                        data-bs-target="#detailModal{{ $item->id }}">
                                        <i class="bi bi-eye-fill"></i> Detail
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Modal Detail -->
                        <div class="modal fade" id="detailModal{{ $item->id }}" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header bg-primary text-white">
                                        <h5 class="modal-title">Detail Buku</h5>
                                        <button type="button" class="btn-close btn-close-white"
                                            data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <!-- Cover Buku -->
                                            <div class="col-md-4 text-center">
                                                @if ($item->cover_buku)
                                                    <img src="{{ asset('storage/' . $item->cover_buku) }}" alt="Cover Buku"
                                                        class="img-fluid rounded shadow-sm mb-3">
                                                @else
                                                    <span class="badge bg-secondary">Tidak ada cover</span>
                                                @endif
                                            </div>

                                            <!-- Data Buku -->
                                            <div class="col-md-8">
                                                <table class="table table-borderless">
                                                    <tr>
                                                        <th class="text-end">Kode Buku :</th>
                                                        <td>{{ $item->kode_buku }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th class="text-end">Judul Buku :</th>
                                                        <td>{{ $item->judul_buku }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th class="text-end">Penerbit :</th>
                                                        <td>{{ $item->penerbit }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th class="text-end">Pengarang :</th>
                                                        <td>{{ $item->pengarang }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th class="text-end">Kategori :</th>
                                                        <td>{{ $item->kategori }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th class="text-end">Tahun Terbit :</th>
                                                        <td>{{ $item->tahun_terbit }}</td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endsection
    </body>
