<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Landing Page Penyewaan Kontrakan</title>

        <!-- Bootstrap CSS -->
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
            .hero {
                background: url('https://source.unsplash.com/1600x900/?house') no-repeat center center;
                background-size: cover;
                height: 100vh;
                color: white;
                display: flex;
                align-items: center;
                justify-content: center;
                text-align: center;
            }
            .hero h1 {
                font-size: 4rem;
                font-weight: 700;
            }
            .hero p {
                font-size: 1.5rem;
            }
            .section {
                padding: 60px 0;
            }
            .section h2 {
                font-size: 2.5rem;
                font-weight: 700;
                margin-bottom: 20px;
            }
            .section p {
                font-size: 1.2rem;
                margin-bottom: 40px;
            }
            .card img {
                height: 200px;
                object-fit: cover;
            }
        </style>
    </head>
    <body>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="#">Penyewaan Kontrakan</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    @if (Route::has('login'))
                        @auth
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('/home') }}">Home</a>
                            </li>
                        @else
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">Log in</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">Register</a>
                                </li>
                            @endif
                        @endauth
                    @endif
                </ul>
            </div>
        </nav>

        <div class="hero">
            <div>
                <h4 style="color: black;">Selamat Datang di Penyewaan Kontrakan</h4>
                <p style="color: black;">Temukan kontrakan terbaik untuk kebutuhan Anda</p>
                <a href="{{ route('register') }}" class="btn btn-primary btn-lg">Daftar Sekarang</a>
            </div>
        </div>

        <div class="container mt-5">
            <div class="section">
                <h2>Empower your brilliant idea with stunning design</h2>
                <p>We launch, refine and redefine global brands through creative Innovation.</p>
                <div class="row">
                    <div class="col-md-4">
                        <div class="card">
                            <img src="https://source.unsplash.com/400x300/?house" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title">Sewa Rumah</h5>
                                <p class="card-text">Temukan rumah yang sesuai dengan kebutuhan Anda.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <img src="https://source.unsplash.com/400x300/?apartment" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title">Sewa Apartemen</h5>
                                <p class="card-text">Temukan apartemen yang nyaman untuk tempat tinggal Anda.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <img src="https://source.unsplash.com/400x300/?villa" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title">Sewa Villa</h5>
                                <p class="card-text">Temukan villa terbaik untuk liburan Anda.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bootstrap JS and dependencies -->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    </body>
</html>
