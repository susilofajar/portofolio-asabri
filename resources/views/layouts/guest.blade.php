<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'ASABRI Portfolio') }}</title>
    <link rel="icon" type="image/png" sizes="16x16" href="https://faq.asabri.co.id/images/Logo_asabri.png">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        :root {
            --asabri-navy: #002966;
            --asabri-blue: #004080;
            --asabri-gold: #D4AF37;
            --asabri-light: #F8FAFC;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, var(--asabri-navy) 0%, #001f4d 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .auth-card {
            background: white;
            border-radius: 24px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
            width: 100%;
            max-width: 450px;
            overflow: hidden;
            animation: slideUp 0.6s cubic-bezier(0.16, 1, 0.3, 1);
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .auth-header {
            background: #f8fafc;
            padding: 40px 30px;
            text-align: center;
            border-bottom: 1px solid #edf2f7;
        }

        .auth-body {
            padding: 40px 40px;
        }

        .btn-asabri {
            background: linear-gradient(135deg, var(--asabri-navy) 0%, var(--asabri-blue) 100%);
            color: white;
            border: none;
            padding: 12px 24px;
            border-radius: 12px;
            font-weight: 700;
            transition: all 0.3s;
            width: 100%;
            box-shadow: 0 4px 12px rgba(0, 41, 102, 0.15);
        }

        .btn-asabri:hover {
            background: linear-gradient(135deg, #001f4d 0%, var(--asabri-navy) 100%);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(0, 41, 102, 0.25);
        }

        .form-label {
            font-weight: 600;
            color: #475569;
            font-size: 0.85rem;
            margin-bottom: 8px;
        }

        .form-control {
            border-radius: 10px;
            padding: 12px 16px;
            border: 1px solid #e2e8f0;
            transition: all 0.2s;
        }

        .form-control:focus {
            border-color: var(--asabri-blue);
            box-shadow: 0 0 0 4px rgba(0, 90, 158, 0.1);
        }

        .text-asabri {
            color: var(--asabri-navy) !important;
        }

        .hover-underline:hover {
            text-decoration: underline !important;
        }
    </style>
</head>

<body>
    <div class="auth-card">
        <div class="auth-header">
            <a href="/">
                <img src="https://www.asabri.co.id/asset/images/logo/logo_header.png?r=1777569226" alt="Logo"
                    height="60">
            </a>
            <h5 class="mt-3 mb-0" style="font-weight: 800; color: var(--asabri-navy); letter-spacing: -0.5px;">ASABRI
                PORTFOLIO</h5>
            <p class="text-muted small mt-1">Monitoring & Laporan Investasi</p>
        </div>
        <div class="auth-body">
            {{ $slot }}
        </div>
    </div>

    @if(session('status'))
        <script>
            Swal.fire({
                icon: 'info',
                title: 'Info',
                text: "{{ session('status') }}",
                timer: 4000,
                showConfirmButton: false,
                toast: true,
                position: 'top-end',
                timerProgressBar: true,
            });
        </script>
    @endif

    @if(session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: "{{ session('error') }}",
                timer: 4000,
                showConfirmButton: false,
                toast: true,
                position: 'top-end',
                timerProgressBar: true,
            });
        </script>
    @endif
</body>

</html>