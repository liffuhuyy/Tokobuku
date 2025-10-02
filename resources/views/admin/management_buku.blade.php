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
                                        <th class="border-0">Aksi</th>
                                    </tr>
                                </thead>

                                <tbody class="table-group-divider">
                                    @forelse ($buku as $item)
                                        <tr>
                                            <td class="text-center">{{ $loop->iteration }}</td>
                                            <td class="text-center">{{ $item->kode_buku }}</td>
                                            <td class="text-center">{{ $item->judul_buku }}</td>
                                            <td class="text-center">
                                                @if ($item->cover_buku)
                                                    <img src="{{ asset('storage/' . $item->cover_buku) }}" alt="Cover Buku"
                                                        class="img-thumbnail" width="80">
                                                @else
                                                    <span class="badge bg-secondary">Tidak ada cover</span>
                                                @endif
                                            </td>

                                            <td class="text-center">
                                                <!-- Modal detail-->
                                                <div class="modal fade" id="detailModal{{ $item->id }}" tabindex="-1"
                                                    aria-labelledby="detailModalLabel{{ $item->id }}"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog modal-lg">
                                                        <div class="modal-content">

                                                            <div class="modal-header">
                                                                <h5 class="modal-title"
                                                                    id="detailModalLabel{{ $item->id }}">Detail Buku -
                                                                    {{ $item->judul_buku }}</h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>

                                                            <div class="modal-body">
                                                                <ul class="list-unstyled mb-0">
                                                                    <li><strong>Penerbit:</strong> {{ $item->penerbit }}
                                                                    </li>
                                                                    <li><strong>Pengarang:</strong> {{ $item->pengarang }}
                                                                    </li>
                                                                    <li><strong>Kategori:</strong> {{ $item->kategori }}
                                                                    </li>
                                                                    <li><strong>Tahun Terbit:</strong>
                                                                        {{ $item->tahun_terbit }}</li>
                                                                </ul>
                                                            </div>

                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">Tutup</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- button akasi -->
                                                <button class="btn btn-info btn-sm text-white" data-bs-toggle="modal"
                                                    data-bs-target="#detailModal{{ $item->id }}">
                                                    <i class="bi bi-eye-fill"></i> Detail
                                                </button>
                                                <button class="btn btn-warning btn-sm text-white" data-bs-toggle="modal"
                                                    data-bs-target="#editModal"
                                                    onclick='editBuku(@json($item))'>
                                                    <i class="bi bi-pencil-fill"></i> Edit
                                                </button>
                                                <button class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                                    data-bs-target="#deleteModal" data-id="{{ $item->id }}">
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

            <!-- Modal tambah -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Tambah Buku</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('admin.management_buku.store') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf

                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label for="kode_buku" class="form-label">Kode Buku</label>
                                        <input type="text" id="kode_buku" name="kode_buku" class="form-control"
                                            readonly>
                                    </div>

                                    <div class="mb-3">
                                        <label for="judul_buku" class="form-label">Judul Buku</label>
                                        <input type="text" name="judul_buku" id="judul_buku" class="form-control"
                                            required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="cover_buku" class="form-label">Cover Buku</label>
                                        <input type="file" name="cover_buku" id="cover_buku" class="form-control"
                                            accept="image/*">
                                    </div>

                                    <div class="mb-3">
                                        <label for="penerbit" class="form-label">Penerbit</label>
                                        <input type="text" name="penerbit" id="penerbit" class="form-control"
                                            required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="pengarang" class="form-label">Pengarang</label>
                                        <input type="text" name="pengarang" id="pengarang" class="form-control"
                                            required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="tahun_terbit" class="form-label">Tahun Terbit</label>
                                        <input type="number" name="tahun_terbit" id="tahun_terbit" class="form-control"
                                            required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="kategori" class="form-label">Kategori</label>
                                        <select class="form-select" id="kategori" name="kategori" required>
                                            <option selected disabled>Pilih kategori</option>
                                            @foreach ($kategori as $kat)
                                                <option value="{{ $kat->id }}">
                                                    {{ $kat->kategori }} -- {{ $kat->jenis }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Batal</button>
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

                                <!-- Kode Buku (readonly) -->
                                <div class="mb-3">
                                    <label for="edit_kode_buku" class="form-label">Kode Buku</label>
                                    <input type="text" class="form-control" id="edit_kode_buku" name="kode_buku"
                                        readonly>
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
                                    <select class="form-select" id="edit_kategori" name="kategori" required>
                                        <option selected disabled>Pilih kategori</option>
                                        @foreach ($kategori as $kat)
                                            <option value="{{ $kat->id }}">
                                                {{ $kat->kategori }} -- {{ $kat->jenis }}
                                            </option>
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
                                        data-bs-dismiss="modal">Batal</button>
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
        // Fungsi umum untuk generate kode buku
        async function generateKodeBuku(kategori, inputTarget) {
            if (!kategori) {
                inputTarget.value = '';
                return;
            }

            try {
                const response = await fetch(`/admin/management_buku/kode/${kategori}`);
                if (!response.ok) throw new Error('Gagal ambil kode buku');

                const data = await response.json();
                inputTarget.value = data.kode ?? '';
            } catch (err) {
                console.error('Error fetch kode buku:', err);
                inputTarget.value = '';
            }
        }

        // Fungsi untuk edit buku (isi modal edit)
        function editBuku(item) {
            document.getElementById('editForm').action = `/admin/management_buku/${item.id}`;

            document.getElementById('edit_kode_buku').value = item.kode_buku;
            document.getElementById('edit_judul_buku').value = item.judul_buku;
            document.getElementById('edit_penerbit').value = item.penerbit;
            document.getElementById('edit_pengarang').value = item.pengarang;
            document.getElementById('edit_kategori').value = item.kategori;
            document.getElementById('edit_tahun_terbit').value = item.tahun_terbit;

            if (item.cover_buku) {
                document.getElementById('preview_cover').src = `/storage/${item.cover_buku}`;
            } else {
                document.getElementById('preview_cover').src = '';
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            // === Modal Tambah ===
            const createKategoriSelect = document.getElementById('kategori');
            const createKodeInput = document.getElementById('kode_buku');

            if (createKategoriSelect && createKodeInput) {
                createKategoriSelect.addEventListener('change', function() {
                    generateKodeBuku(this.value, createKodeInput);
                });
            }

            // === Modal Edit ===
            const editKategoriSelect = document.getElementById('edit_kategori');
            const editKodeInput = document.getElementById('edit_kode_buku');

            if (editKategoriSelect && editKodeInput) {
                editKategoriSelect.addEventListener('change', function() {
                    generateKodeBuku(this.value, editKodeInput);
                });
            }

            // === Modal Hapus ===
            const deleteModal = document.getElementById('deleteModal');
            if (deleteModal) {
                deleteModal.addEventListener('show.bs.modal', function(event) {
                    const button = event.relatedTarget;
                    const id = button.getAttribute('data-id');
                    const form = document.getElementById('deleteForm');
                    form.action = "{{ route('admin.management_buku.destroy', ':id') }}".replace(':id', id);
                });
            }
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
