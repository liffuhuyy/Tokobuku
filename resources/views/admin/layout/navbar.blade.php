<nav class="navbar navbar-dark bg-light">
    <div class="container-fluid d-flex justify-content-between align-items-center">
        <!-- Brand -->
        <h2 class="navbar-brand text-dark mb-0">📚 MyBook</h2>

        <!-- Tanggal & Waktu -->
        <div id="datetime" class="text-dark fw-semibold me-3"></div>

        <!-- User -->
        <a class="d-flex align-items-center text-white text-decoration-none border rounded px-3 py-2 bg-primary"
            data-bs-toggle="dropdown" aria-expanded="false">
            <i class="bi bi-person-circle me-2"></i> {{ auth()->user()->name }}
        </a>
    </div>
</nav>

<!-- Script untuk update waktu -->
<script>
    function updateDateTime() {
        const now = new Date();

        // Format tanggal Indonesia
        const optionsDate = {
            weekday: 'long',
            year: 'numeric',
            month: 'long',
            day: 'numeric'
        };
        const tanggal = now.toLocaleDateString('id-ID', optionsDate);

        // Format jam:menit:detik
        const jam = now.toLocaleTimeString('id-ID');

        document.getElementById('datetime').innerHTML = `${tanggal} | ${jam}`;
    }

    setInterval(updateDateTime, 1000); // Update tiap detik
    updateDateTime(); // Panggil pertama kali
</script>
