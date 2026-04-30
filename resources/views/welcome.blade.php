<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ASABRI Portfolio - Monitoring & Laporan Investasi</title>
    <link rel="icon" type="image/png" sizes="16x16" href="https://faq.asabri.co.id/assets/images/Logo_asabri.png">
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800&display=swap" rel="stylesheet" />

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        :root {
            --asabri-navy: #002966;
            --asabri-blue: #004080;
            --asabri-gold: #D4AF37;
            --asabri-light: #F8FAFC;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: white;
            color: #1e293b;
            overflow-x: hidden;
        }

        .navbar {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            padding: 20px 0;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        }

        .hero-section {
            padding: 120px 0 80px;
            background: linear-gradient(135deg, #f4f6f9 0%, #e2e8f0 100%);
            position: relative;
            overflow: hidden;
        }

        .hero-section::before {
            content: '';
            position: absolute;
            top: -100px;
            right: -100px;
            width: 400px;
            height: 400px;
            background: rgba(0, 58, 112, 0.03);
            border-radius: 50%;
        }

        .hero-title {
            font-size: 3.5rem;
            font-weight: 800;
            color: var(--asabri-navy);
            line-height: 1.2;
            margin-bottom: 25px;
        }

        .hero-subtitle {
            font-size: 1.25rem;
            color: #64748b;
            margin-bottom: 40px;
            max-width: 600px;
        }

        .btn-primary-asabri {
            background: var(--asabri-navy);
            color: white;
            padding: 15px 35px;
            border-radius: 12px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            border: none;
        }

        .btn-primary-asabri:hover {
            background: var(--asabri-blue);
            color: white;
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(0, 58, 112, 0.2);
        }

        .feature-card {
            padding: 40px;
            border-radius: 20px;
            background: white;
            border: 1px solid rgba(0, 47, 108, 0.08);
            transition: all 0.3s;
            height: 100%;
        }

        .feature-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.05);
        }

        .icon-box {
            width: 60px;
            height: 60px;
            background: rgba(0, 75, 156, 0.08);
            color: var(--asabri-navy);
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            margin-bottom: 25px;
        }

        .section-tag {
            text-transform: uppercase;
            font-weight: 700;
            font-size: 0.85rem;
            letter-spacing: 2px;
            color: var(--asabri-gold);
            margin-bottom: 15px;
            display: block;
        }

        footer {
            background: var(--asabri-navy);
            color: white;
            padding: 80px 0 40px;
        }

        .footer-logo {
            height: 60px;
            margin-bottom: 30px;
            filter: brightness(0) invert(1);
        }

        .fade-in {
            animation: fadeIn 1s ease-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center gap-2" href="#">
                <img src="https://faq.asabri.co.id/assets/images/Logo_asabri.png" alt="Logo" height="40">
                <span style="font-weight: 800; color: var(--asabri-navy); letter-spacing: -0.5px;">PORTFOLIO</span>
            </a>
            <div class="ms-auto">
                @auth
                    <a href="{{ url('/dashboard') }}" class="btn btn-primary-asabri py-2 px-4">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="btn btn-outline-primary border-2 px-4 me-2" style="border-radius: 12px; font-weight: 600;">Login</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="btn btn-primary-asabri py-2 px-4">Register</a>
                    @endif
                @endauth
            </div>
        </div>
    </nav>

    <section class="hero-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 fade-in">
                    <span class="section-tag">PT ASABRI (PERSERO)</span>
                    <h1 class="hero-title">Sistem Monitoring & Laporan Investasi</h1>
                    <p class="hero-subtitle">Platform digital terintegrasi untuk pengelolaan, pemantauan, dan pelaporan portofolio investasi secara profesional dan transparan.</p>
                    <div class="d-flex gap-3">
                        <a href="{{ route('login') }}" class="btn btn-primary-asabri">
                            Mulai Sekarang <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
                <div class="col-lg-6 d-none d-lg-block">
                    <img src="https://faq.asabri.co.id/assets/images/logo_asabri_2.svg" alt="Asabri Logo" class="img-fluid fade-in" style="max-height: 400px; opacity: 0.1;">
                </div>
            </div>
        </div>
    </section>

    <section class="py-5 my-5">
        <div class="container">
            <div class="text-center mb-5">
                <span class="section-tag">FITUR UTAMA</span>
                <h2 style="font-weight: 800; color: var(--asabri-navy);">Layanan Terintegrasi</h2>
            </div>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="feature-card">
                        <div class="icon-box">
                            <i class="fas fa-chart-pie"></i>
                        </div>
                        <h4 style="font-weight: 700;">Fund Fact Sheet</h4>
                        <p class="text-muted">Pantau kinerja reksa dana dan instrumen investasi lainnya secara real-time dengan data yang akurat.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card">
                        <div class="icon-box">
                            <i class="fas fa-file-contract"></i>
                        </div>
                        <h4 style="font-weight: 700;">Laporan Berkala</h4>
                        <p class="text-muted">Akses laporan investasi mingguan, bulanan, hingga tahunan dalam format digital yang mudah diunduh.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card">
                        <div class="icon-box">
                            <i class="fas fa-shield-alt"></i>
                        </div>
                        <h4 style="font-weight: 700;">Keamanan Data</h4>
                        <p class="text-muted">Sistem manajemen akses pengguna yang ketat untuk memastikan kerahasiaan data investasi perusahaan.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer>
        <div class="container text-center">
            <img src="https://faq.asabri.co.id/assets/images/logo_asabri_2.svg" alt="Logo White" class="footer-logo">
            <p style="opacity: 0.6; max-width: 600px; margin: 0 auto 30px;">
                Memberikan layanan asuransi sosial dan pembayaran pensiun bagi prajurit TNI, anggota Polri, dan ASN Kemhan Polri dengan integritas tinggi.
            </p>
            <hr style="opacity: 0.1; margin-bottom: 30px;">
            <p style="font-size: 0.9rem; opacity: 0.5;">&copy; 2024 PT ASABRI (Persero). All Rights Reserved.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
