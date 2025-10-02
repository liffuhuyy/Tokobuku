    <title>Management Kategori</title>

    <body>
        @extends('admin.layout.admin_layout')
        @section('content')
            <div class="row">
                <div class="col-md-12">
                    <h1 class="mb-4">Management Kategori</h1>
                </div>
            </div>

            <!--modal tambah kategori-->
            <div class="row mb-2">
                <div class="col-md-12 d-flex justify-content-end">
                    <form class="d-flex" role="search">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#tambahKategoriModal">
                            Tambah
                        </button>
                    </form>
                </div>
            </div>

            <div class="modal fade" id="tambahKategoriModal" tabindex="-1" aria-labelledby="tambahKategoriModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header bg-white text-black">
                            <h5 class="modal-title" id="tambahKategoriModalLabel">Tambah Kategori</h5>
                            <button type="button" class="btn-close btn-close-black" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <form method="POST" action="{{ route('admin.tambah_kategori') }}">
                            @csrf
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="kategori" class="form-label">Kategori</label>
                                    <input type="text" class="form-control" id="kategori" name="kategori" required>
                                </div>
                                <div class="mb-3">
                                    <label for="jenis" class="form-label">Jenis</label>
                                    <input type="text" class="form-control" id="jenis" name="jenis" required>
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

            <!--table kategori-->
            <div class="row">
                <div class="col-md-12">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover align-middle">
                                <thead class="table-primary text-center border-0">
                                    <tr>
                                        <th scope="col" class="border-0 text-center">No</th>
                                        <th scope="col" class="border-0 text-center">Kategori</th>
                                        <th scope="col" class="border-0 text-center">Jenis</th>
                                        <th scope="col" class="border-0 text-center">Aksi</th>
                                    </tr>
                                </thead>

                                <tbody class="table-group-divider">
                                    @foreach ($kategori as $index => $item)
                                        <tr>
                                            <td class="text-center">{{ $index + 1 }}</td>
                                            <td class="text-center">{{ $item->kategori }}</td>
                                            <td class="text-center">{{ $item->jenis }}</td>
                                            <td class="text-center">
                                                <button class="btn btn-warning btn-sm text-white" data-bs-toggle="modal"
                                                    data-bs-target="#editKategoriModal" data-id="{{ $item->id }}"
                                                    data-kategori="{{ $item->kategori }}" data-jenis="{{ $item->jenis }}">
                                                    <i class="bi bi-pencil-fill"></i> Edit
                                                </button>
                                                <button class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                                    data-bs-target="#deleteModal" data-id="{{ $item->id }}">
                                                    <i class="bi bi-trash-fill"></i> Hapus
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal Sukses -->
            <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header bg-success text-white">
                            <h5 class="modal-title" id="successModalLabel">Berhasil</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
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
            <div class="modal fade" id="errorModal" tabindex="-1" aria-labelledby="errorModalLabel" aria-hidden="true">
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


            <!-- modal edit -->
            <div class="modal fade" id="editKategoriModal" tabindex="-1" aria-labelledby="editKategoriModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header bg-white text-black">
                            <h5 class="modal-title" id="editKategoriModalLabel">Edit Kategori</h5>
                            <button type="button" class="btn-close btn-close-black" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <form method="POST" action="">
                            @csrf
                            @method('PUT')
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="edit_kategori" class="form-label">Kategori</label>
                                    <input type="text" class="form-control" id="edit_kategori" name="kategori"
                                        required>
                                </div>
                                <div class="mb-3">
                                    <label for="edit_jenis" class="form-label">Jenis</label>
                                    <input type="text" class="form-control" id="edit_jenis" name="jenis" required>
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
            <!-- Modal delete -->
            <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header bg-primary text-white">
                            <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus</h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            Apakah Anda yakin ingin menghapus buku ini?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <form id="deleteForm" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Ya, Hapus</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <script>
                // Tangkap event ketika modal edit ditampilkan
                const editModal = document.getElementById('editKategoriModal');
                if (editModal) {
                    editModal.addEventListener('show.bs.modal', function(event) {
                        const button = event.relatedTarget;
                        const id = button.getAttribute('data-id');
                        const kategori = button.getAttribute('data-kategori');
                        const jenis = button.getAttribute('data-jenis');
                        const form = editModal.querySelector('form');
                        form.action = "{{ route('admin.update_kategori', ':id') }}".replace(':id', id);
                        document.getElementById('edit_kategori').value = kategori;
                        document.getElementById('edit_jenis').value = jenis;
                    });
                }

                // Tangkap event ketika modal delete ditampilkan
                const deleteModal = document.getElementById('deleteModal');
                if (deleteModal) {
                    deleteModal.addEventListener('show.bs.modal', function(event) {
                        const button = event.relatedTarget;
                        const id = button.getAttribute('data-id');
                        const form = document.getElementById('deleteForm');
                        form.action = "{{ route('admin.hapus_kategori', ':id') }}".replace(':id', id);
                    });
                }

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
