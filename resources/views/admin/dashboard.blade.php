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
        @endsection
    </body>
