<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FertInnovation - AI-Driven Agri Supply Chain</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root {
            --primary: #2ecc71;
            --secondary: #27ae60;
        }
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .hero {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            padding: 100px 0;
            margin-bottom: 50px;
        }
        .hero h1 {
            font-size: 3.5rem;
            font-weight: bold;
            margin-bottom: 20px;
        }
        .hero p {
            font-size: 1.3rem;
            margin-bottom: 30px;
        }
        .feature-card {
            background: white;
            border: none;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s, box-shadow 0.3s;
            height: 100%;
        }
        .feature-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 8px 12px rgba(0, 0, 0, 0.15);
        }
        .feature-icon {
            font-size: 3rem;
            color: var(--primary);
            margin-bottom: 15px;
        }
        .btn-primary {
            background-color: var(--primary);
            border-color: var(--primary);
        }
        .btn-primary:hover {
            background-color: var(--secondary);
            border-color: var(--secondary);
        }
        .navbar {
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .navbar-brand {
            font-weight: bold;
            color: var(--primary) !important;
            font-size: 1.5rem;
        }
        footer {
            background-color: #2c3e50;
            color: white;
            padding: 40px 0;
            margin-top: 60px;
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="/">🌾 FertInnovation</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <div class="ms-auto">
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ route('dashboard') }}" class="btn btn-sm btn-outline-primary me-2">Dashboard</a>
                            <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-danger">Logout</button>
                            </form>
                        @else
                            <a href="{{ route('login') }}" class="btn btn-sm btn-outline-primary me-2">Login</a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="btn btn-sm btn-primary">Daftar</a>
                            @endif
                        @endauth
                    @endif
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="hero text-center">
        <div class="container">
            <h1>Sistem Manajemen Rantai Pasok Pertanian Berbasis AI</h1>
            <p>Optimalkan hasil panen, kelola air & pupuk efisien, dan pantau harga pasar secara real-time</p>
            @auth
                <a href="{{ route('dashboard') }}" class="btn btn-light btn-lg">Buka Dashboard</a>
            @else
                <a href="{{ route('register') }}" class="btn btn-light btn-lg">Mulai Sekarang</a>
            @endauth
        </div>
    </div>

    <!-- Features Section -->
    <div class="container mb-60">
        <div class="row mb-5">
            <div class="col-md-4 mb-4">
                <div class="feature-card p-4">
                    <div class="feature-icon">📊</div>
                    <h5 class="card-title">Dashboard Monitoring</h5>
                    <p class="card-text">Pantau semua data pertanian Anda dalam satu dashboard intuitif yang mudah dipahami.</p>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="feature-card p-4">
                    <div class="feature-icon">🌤️</div>
                    <h5 class="card-title">Data Cuaca Real-time</h5>
                    <p class="card-text">Dapatkan informasi cuaca terkini dan prediksi untuk perencanaan tanam yang lebih baik.</p>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="feature-card p-4">
                    <div class="feature-icon">💰</div>
                    <h5 class="card-title">Harga Pasar Terkini</h5>
                    <p class="card-text">Pantau harga produk pertanian di berbagai pasar untuk keputusan penjualan yang optimal.</p>
                </div>
            </div>
        </div>
        <div class="row mb-5">
            <div class="col-md-4 mb-4">
                <div class="feature-card p-4">
                    <div class="feature-icon">💧</div>
                    <h5 class="card-title">Manajemen Air</h5>
                    <p class="card-text">Kelola penggunaan air secara efisien untuk mengurangi biaya dan limbah air.</p>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="feature-card p-4">
                    <div class="feature-icon">🌱</div>
                    <h5 class="card-title">Manajemen Pupuk</h5>
                    <p class="card-text">Aplikasi pupuk yang tepat untuk meningkatkan hasil panen dan mengurangi dampak lingkungan.</p>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="feature-card p-4">
                    <div class="feature-icon">🤖</div>
                    <h5 class="card-title">ChatBot AI</h5>
                    <p class="card-text">Dapatkan saran berbasis AI untuk pertanyaan seputar pertanian dan rantai pasok.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistics Section -->
    <div style="background-color: #f8f9fa; padding: 50px 0;">
        <div class="container text-center">
            <div class="row">
                <div class="col-md-3 mb-4">
                    <h3 style="color: var(--primary); font-size: 2.5rem;">1000+</h3>
                    <p>Petani Aktif</p>
                </div>
                <div class="col-md-3 mb-4">
                    <h3 style="color: var(--primary); font-size: 2.5rem;">5000+</h3>
                    <p>Lahan Terpantau</p>
                </div>
                <div class="col-md-3 mb-4">
                    <h3 style="color: var(--primary); font-size: 2.5rem;">100K+</h3>
                    <p>Data Tersimpan</p>
                </div>
                <div class="col-md-3 mb-4">
                    <h3 style="color: var(--primary); font-size: 2.5rem;">98%</h3>
                    <p>Akurasi Prediksi</p>
                </div>
            </div>
        </div>
    </div>

    <!-- CTA Section -->
    <div class="container my-5 text-center">
        <h2 class="mb-4">Siap Mengoptimalkan Pertanian Anda?</h2>
        @guest
            <a href="{{ route('register') }}" class="btn btn-primary btn-lg me-2">Daftar Gratis</a>
            <a href="{{ route('login') }}" class="btn btn-outline-primary btn-lg">Login</a>
        @endguest
    </div>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-4">
                    <h5>FertInnovation</h5>
                    <p>Solusi cerdas untuk pertanian modern berbasis teknologi AI</p>
                </div>
                <div class="col-md-4 mb-4">
                    <h5>Fitur Utama</h5>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-decoration-none text-light">Dashboard</a></li>
                        <li><a href="#" class="text-decoration-none text-light">Monitoring</a></li>
                        <li><a href="#" class="text-decoration-none text-light">ChatBot AI</a></li>
                    </ul>
                </div>
                <div class="col-md-4 mb-4">
                    <h5>Kontak</h5>
                    <p>Email: info@fertinnovation.com<br>
                    Telepon: +62 123 456 7890</p>
                </div>
            </div>
            <hr class="bg-light">
            <p class="text-center mb-0">&copy; 2025 FertInnovation. Semua hak dilindungi.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
