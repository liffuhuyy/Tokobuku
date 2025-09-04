    <title>Dashboard kasir</title>

    <body>
        @extends('kasir.layout.kasir_layout')
        @section('content')
            <div class="row">
                <div class="col-md-12">
                    <h1>Dashboard</h1>
                    @if (auth()->user('kasir'))
                        <p>Halo kasir!
                            Selamat datang di dashboard kasir.
                        </p>
                    @endif
                </div>
            </div>
        @endsection
    </body>
