 <nav class="navbar navbar-dark bg-light">
     <div class="container-fluid">
         <h2 class="navbar-brand text-dark" href="{{ route('admin.dashboard') }}">📚 MyBook</h2>
         <a class="d-flex align-items-center text-white text-decoration-none border rounded px-3 py-2 bg-primary"
             data-bs-toggle="dropdown" aria-expanded="false">
             <i class="bi bi-person-circle me-2"></i> {{ auth()->user('admin')->name }}
         </a>
     </div>
 </nav>
