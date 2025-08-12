    <title>Dashboard admin</title>

    <body>
        @include('admin.layout.admin_layout')
        <div class="container mt-3">
            <div class="row">
                <div class="col-md-12">
                    <h1>Dashboard</h1>
                    @if (auth()->user('admin'))
                        <p>Selamat datang di dashboard admin. </p>
                    @endif
                </div>
            </div>
        </div>

    </body>
