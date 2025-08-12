    <title>Dashboard owner</title>

    <body>
        @include('owner.layout.owner_layout')
        <div class="container mt-3">
            <div class="row">
                <div class="col-md-12">
                    <h1>Dashboard</h1>
                    @if (auth()->user('owner'))
                        <p>Selamat datang di dashboard owner.</p>
                    @endif
                </div>
            </div>
        </div>
    </body>
