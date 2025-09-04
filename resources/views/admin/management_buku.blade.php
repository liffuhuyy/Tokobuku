    <title>Management Buku</title>

    <body>
        @extends('admin.layout.admin_layout')
        @section('content')
            <div class="row">
                <div class="col-md-12">
                    <h1 class="mb-4">Management Buku</h1>
                </div>
            </div>

            <!-- search box dan tambah -->
            <div class="row mb-2">
                <div class="col-md-8">
                    <form class="d-flex" role="search">
                        <input class="form-control me-2 flex-grow-1" type="search" placeholder="Mencari Judul/Kode buku"
                            aria-label="Search">
                        <button class="btn btn-primary me-4" type="submit">Cari</button>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#exampleModal">
                            Tambah
                        </button>
                    </form>
                </div>
            </div>


            <!-- Table data -->
            <div class="row">
                <div class="col-md-12">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover align-middle">
                                <thead class="table-primary text-center border-0">
                                    <tr>
                                        <th class="border-0">ID</th>
                                        <th class="border-0">Kode Buku</th>
                                        <th class="border-0">Judul Buku</th>
                                        <th class="border-0">Cover Buku</th>
                                        <th class="border-0">Penerbit</th>
                                        <th class="border-0">Pengarang</th>
                                        <th class="border-0">Kategori</th>
                                        <th class="border-0">Tahun Terbit</th>
                                        <th class="border-0">Aksi</th>
                                    </tr>
                                </thead>

                                <tbody class="table-group-divider">
                                    @forelse ($buku as $item)
                                        <tr>
                                            <td class="text-center">{{ $loop->iteration }}</td>
                                            <td class="text-center">{{ $item->kode_buku }}</td>
                                            <td>{{ $item->judul_buku }}</td>
                                            <td class="text-center">
                                                @if ($item->cover_buku)
                                                    <img src="{{ asset('storage/' . $item->cover_buku) }}" alt="Cover Buku"
                                                        class="img-thumbnail" width="80">
                                                @else
                                                    <span class="badge bg-secondary">Tidak ada cover</span>
                                                @endif
                                            </td>
                                            <td class="text-center">{{ $item->penerbit }}</td>
                                            <td class="text-center">{{ $item->pengarang }}</td>
                                            <td class="text-center">{{ $item->kategori }}</td>
                                            <td class="text-center">{{ $item->tahun_terbit }}</td>
                                            <td class="text-center">
                                                <button type="button" class="btn btn-sm btn-warning" data-bs-toggle="modal"
                                                    data-bs-target="#editModal"
                                                    onclick="document.getElementById('editForm').action='{{ route('admin.management_buku.update', $item->id) }}';
                                                    document.getElementById('edit_kode_buku').value='{{ $item->kode_buku }}';
                                                    document.getElementById('edit_judul_buku').value='{{ $item->judul_buku }}';
                                                    document.getElementById('edit_penerbit').value='{{ $item->penerbit }}';
                                                    document.getElementById('edit_pengarang').value='{{ $item->pengarang }}';
                                                    document.getElementById('edit_kategori').value='{{ $item->kategori }}';
                                                    document.getElementById('edit_tahun_terbit').value='{{ $item->tahun_terbit }}';">
                                                    Edit
                                                </button>
                                                <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                                    data-bs-target="#deleteModal" data-id="{{ $item->id }}">
                                                    Hapus
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

            <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
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
                            <form id="deleteForm" method="POST" action="">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Ya, Hapus</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal tambah -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Tambah Buku</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('admin.management_buku.store') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label for="kode_buku" class="form-label">Kode Buku</label>
                                    <input type="text" class="form-control" id="kode_buku" name="kode_buku" required>
                                </div>
                                <div class="mb-3">
                                    <label for="judul_buku" class="form-label">Judul Buku</label>
                                    <input type="text" class="form-control" id="judul_buku" name="judul_buku"
                                        required>
                                </div>
                                <div class="mb-3">
                                    <label for="cover_buku" class="form-label">Cover Buku</label>
                                    <input type="file" class="form-control" id="cover_buku" name="cover_buku"
                                        accept="image/*">
                                </div>
                                <div class="mb-3">
                                    <label for="penerbit" class="form-label">Penerbit</label>
                                    <input type="text" class="form-control" id="penerbit" name="penerbit" required>
                                </div>
                                <div class="mb-3">
                                    <label for="pengarang" class="form-label">Pengarang</label>
                                    <input type="text" class="form-control" id="pengarang" name="pengarang" required>
                                </div>
                                <div class="mb-3">
                                    <label for="kategori" class="form-label">Kategori</label>
                                    <select class="form-select" id="kategori" name="kategori">
                                        <option selected disabled>Pilih kategori</option>
                                        @foreach ($kategori as $kat)
                                            <option value="{{ $kat->kategori }}">{{ $kat->kategori }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="tahun_terbit" class="form-label">Tahun Terbit</label>
                                    <input type="number" class="form-control" id="tahun_terbit" name="tahun_terbit"
                                        required>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Tutup</button>
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal edit -->
            <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editModalLabel">Edit Buku</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="editForm" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="mb-3">
                                    <label for="edit_kode_buku" class="form-label">Kode Buku</label>
                                    <input type="text" class="form-control" id="edit_kode_buku" name="kode_buku"
                                        required>
                                </div>
                                <div class="mb-3">
                                    <label for="edit_judul_buku" class="form-label">Judul Buku</label>
                                    <input type="text" class="form-control" id="edit_judul_buku" name="judul_buku"
                                        required>
                                </div>
                                <div class="mb-3">
                                    <label for="edit_cover_buku" class="form-label">Cover Buku</label>
                                    <input type="file" class="form-control" id="edit_cover_buku" name="cover_buku"
                                        accept="image/*">
                                </div>
                                <div class="mb-3">
                                    <label for="edit_penerbit" class="form-label">Penerbit</label>
                                    <input type="text" class="form-control" id="edit_penerbit" name="penerbit"
                                        required>
                                </div>
                                <div class="mb-3">
                                    <label for="edit_pengarang" class="form-label">Pengarang</label>
                                    <input type="text" class="form-control" id="edit_pengarang" name="pengarang"
                                        required>
                                </div>
                                <div class="mb-3">
                                    <label for="edit_kategori" class="form-label">Kategori</label>
                                    <select class="form-select" id="edit_kategori" name="kategori">
                                        <option selected disabled>Pilih kategori</option>
                                        @foreach ($kategori as $kat)
                                            <option value="{{ $kat->kategori }}">{{ $kat->kategori }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="edit_tahun_terbit" class="form-label">Tahun Terbit</label>
                                    <input type="number" class="form-control" id="edit_tahun_terbit"
                                        name="tahun_terbit" required>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Tutup</button>
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endsection
    </body>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var deleteModal = document.getElementById('deleteModal');
            deleteModal.addEventListener('show.bs.modal', function(event) {
                var button = event.relatedTarget; // tombol yang diklik
                var id = button.getAttribute('data-id'); // ambil data-id buku
                var form = document.getElementById('deleteForm');
                form.action = "/admin/management_buku/" + id; // ganti action form sesuai id
            });
        });
    </script>
