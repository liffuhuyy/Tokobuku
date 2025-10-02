    <title>Stok dan Harga</title>

    <body>
        @extends('admin.layout.admin_layout')
        @section('content')
            <div class="row">
                <div class="col-md-12">
                    <h1 class="mb-4">Stok dan Harga</h1>
                </div>
            </div>

            <div class="row mb-2">
                <div class="col-md-12 d-flex justify-content-end">
                    <form class="d-flex" role="search">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            Tambah
                        </button>
                    </form>
                </div>
            </div>


            <!-- Modal Tambah Buku -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header bg-white text-black">
                            <h5 class="modal-title" id="exampleModalLabel">Tambah Harga dan Stok Buku</h5>
                            <button type="button" class="btn-close btn-close-black" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <form action="{{ route('admin.harga.store') }}" method="POST">
                            @csrf
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="buku_id" class="form-label">Pilih Buku</label>
                                    <select class="form-select" id="buku_id" name="buku_id" required>
                                        <option value="" disabled selected>-- Pilih Buku --</option>
                                        @foreach ($buku as $item)
                                            <option value="{{ $item->id }}">{{ $item->judul_buku }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="harga" class="form-label">Harga</label>
                                    <input type="number" class="form-control" id="harga" name="harga"
                                        placeholder="Masukkan Harga Buku" min="0" step="100" required>
                                </div>

                                <div class="mb-3">
                                    <label for="stok" class="form-label">Stok</label>
                                    <input type="number" class="form-control" id="stok" name="stok"
                                        placeholder="Masukkan Stok Buku" min="0" step="1" required>
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- Modal Edit Buku -->
            <div class="modal fade" id="editBukuModal" tabindex="-1" aria-labelledby="editBukuModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header bg-white text-black">
                            <h5 class="modal-title" id="editBukuModalLabel">Edit Harga dan Stok Buku</h5>
                            <button type="button" class="btn-close btn-close-black" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <form method="POST" id="editBukuForm">
                            @csrf
                            @method('PUT')
                            <div class="modal-body">
                                <input type="hidden" id="edit_buku_id" name="id">
                                <div class="mb-3">
                                    <label for="edit_judul_buku" class="form-label">Judul Buku</label>
                                    <input type="text" class="form-control" id="edit_judul_buku" name="judul_buku"
                                        readonly>
                                </div>
                                <div class="mb-3">
                                    <label for="edit_harga" class="form-label">Harga</label>
                                    <input type="number" class="form-control" id="edit_harga" name="harga"
                                        placeholder="Masukkan Harga Buku" min="0" step="100" required>
                                </div>

                                <div class="mb-3">
                                    <label for="edit_stok" class="form-label">Stok</label>
                                    <input type="number" class="form-control" id="edit_stok" name="stok"
                                        placeholder="Masukkan Stok Buku" min="0" step="1" required>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- Modal Hapus Buku -->
            <div class="modal fade" id="deleteBukuModal" tabindex="-1" aria-labelledby="deleteBukuModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header bg-primary text-white">
                            <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus</h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <form method="POST" id="deleteBukuForm">
                            @csrf
                            @method('DELETE')
                            <input type="hidden" id="delete_buku_id" name="id">
                            <div class="modal-body">
                                <p>Apakah Anda yakin ingin menghapus data buku ini?</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-danger">Hapus</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>



            <!-- Modal Success -->
            <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header bg-success text-white">
                            <h5 class="modal-title" id="successModalLabel">Berhasil</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Tutup"></button>
                        </div>
                        <div class="modal-body">
                            {{ session('success') }}
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-success" data-bs-dismiss="modal">OK</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal Error -->
            <div class="modal fade" id="errorModal" tabindex="-1" aria-labelledby="errorModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header bg-danger text-white">
                            <h5 class="modal-title" id="errorModalLabel">Gagal Menambahkan Data</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Tutup"></button>
                        </div>
                        <div class="modal-body">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Tutup</button>
                        </div>
                    </div>
                </div>
            </div>


            <!-- table buku -->
            <div class="row">
                <div class="col-md-12">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover align-middle">
                                <thead class="table-primary text-center border-0">
                                    <tr>
                                        <th scope="col" class="border-0 text-center">No</th>
                                        <th scope="col" class="border-0 text-center">Judul Buku</th>
                                        <th scope="col" class="border-0 text-center">Harga</th>
                                        <th scope="col" class="border-0 text-center">Stok</th>
                                        <th scope="col" class="border-0 text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($harga as $index => $item)
                                        <tr>
                                            <td class="text-center">{{ $index + 1 }}</td>
                                            <td class="text-center">{{ $item->buku->judul_buku }}</td>
                                            <td class="text-center">Rp {{ number_format($item->harga, 2, ',', '.') }}</td>
                                            <td class="text-center">{{ $item->stok }}</td>
                                            <td class="text-center">
                                                <button type="button" class="btn btn-warning btn-sm text-white"
                                                    data-bs-toggle="modal" data-bs-target="#editBukuModal"
                                                    data-id="{{ $item->id }}"
                                                    data-judul_buku="{{ $item->buku->judul_buku }}"
                                                    data-harga="{{ $item->harga }}" data-stok="{{ $item->stok }}">
                                                    <i class="bi bi-pencil-fill"></i> Edit
                                                </button>
                                                <button type="button" class="btn btn-danger btn-sm"
                                                    data-bs-toggle="modal" data-bs-target="#deleteBukuModal"
                                                    data-id="{{ $item->id }}">
                                                    <i class="bi bi-trash-fill"></i> Hapus
                                                </button>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="9" class="text-center">
                                                <div class="alert mb-0" role="alert">
                                                    📚 Belum ada data buku
                                                </div>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>


            <script>
                // Script untuk mengisi data pada modal edit
                var editBukuModal = document.getElementById('editBukuModal');
                editBukuModal.addEventListener('show.bs.modal', function(event) {
                    var button = event.relatedTarget;
                    var id = button.getAttribute('data-id');
                    var judul_buku = button.getAttribute('data-judul_buku');
                    var harga = button.getAttribute('data-harga');
                    var stok = button.getAttribute('data-stok');
                    var modalIdInput = editBukuModal.querySelector('#edit_buku_id');
                    var modalJudulInput = editBukuModal.querySelector('#edit_judul_buku');
                    var modalHargaInput = editBukuModal.querySelector('#edit_harga');
                    var modalStokInput = editBukuModal.querySelector('#edit_stok');
                    modalIdInput.value = id;
                    modalJudulInput.value = judul_buku;
                    modalHargaInput.value = harga;
                    modalStokInput.value = stok;
                });

                document.addEventListener('DOMContentLoaded', function() {
                    @if (session('success'))
                        var successModal = new bootstrap.Modal(document.getElementById('successModal'));
                        successModal.show();
                    @endif

                    @if ($errors->any())
                        var errorModal = new bootstrap.Modal(document.getElementById('errorModal'));
                        errorModal.show();
                    @endif
                });
            </script>
        @endsection
    </body>
