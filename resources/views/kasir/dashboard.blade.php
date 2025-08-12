    <title>Dashboard kasir</title>

    <body>
        @include('kasir.layout.kasir_layout')
        <div class="container mt-3">
            <div class="row">
                <div class="col-md-12">
                    <h1>Dashboard</h1>
                    @if (auth()->user('kasir'))
                        <p>Halo Kasir!
                            Selamat datang di dashboard kasir.
                        </p>
                    @endif
                </div>
            </div>
        </div>
    </body>
