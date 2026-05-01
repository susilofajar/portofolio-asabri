<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/png" sizes="16x16"
        href="{{ asset('https://faq.asabri.co.id/images/Logo_asabri.png') }}">
    <title>ASABRI Portfolio</title>

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
            --asabri-navy-dark: #001f4d;
            --asabri-blue: #004080;
            --asabri-gold: #D4AF37;
            --asabri-gold-light: #F4D03F;
            --asabri-gold-dark: #B5952F;
            --asabri-light: #F8FAFC;
            --asabri-grey: #64748B;
            --asabri-dark: #0F172A;
            --sidebar-width: 280px;
            --card-shadow: 0 4px 20px rgba(0, 0, 0, 0.03);
            --card-shadow-hover: 0 10px 30px rgba(0, 41, 102, 0.08);
            --glass-bg: rgba(255, 255, 255, 0.85);
            --border-radius-lg: 20px;
            --border-radius-md: 14px;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--asabri-light);
            color: var(--asabri-dark);
            overflow-x: hidden;
            -webkit-font-smoothing: antialiased;
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }
        ::-webkit-scrollbar-track {
            background: var(--asabri-light);
        }
        ::-webkit-scrollbar-thumb {
            background: #CBD5E1;
            border-radius: 10px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: var(--asabri-navy);
        }

        /* Sidebar Customization */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            width: var(--sidebar-width);
            background: linear-gradient(160deg, var(--asabri-navy) 0%, var(--asabri-navy-dark) 100%);
            padding: 0;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            z-index: 1050;
            box-shadow: 4px 0 24px rgba(0, 0, 0, 0.08);
        }

        .sidebar::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('https://www.transparenttextures.com/patterns/cubes.png');
            opacity: 0.03;
            pointer-events: none;
        }

        .sidebar .logo-container {
            padding: 35px 20px;
            background: rgba(0, 0, 0, 0.15);
            margin-bottom: 25px;
            text-align: center;
            border-bottom: 1px solid rgba(255,255,255,0.05);
        }

        .sidebar .nav-link {
            color: rgba(255, 255, 255, 0.65);
            padding: 14px 24px;
            display: flex;
            align-items: center;
            text-decoration: none;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            margin: 6px 16px;
            border-radius: var(--border-radius-md);
            font-weight: 500;
            font-size: 0.95rem;
            position: relative;
            overflow: hidden;
        }

        .sidebar .nav-link i {
            margin-right: 14px;
            font-size: 1.15rem;
            width: 24px;
            text-align: center;
            transition: color 0.3s;
        }

        .sidebar .nav-link:hover {
            background: rgba(255, 255, 255, 0.06);
            color: white;
            transform: translateX(4px);
        }

        .sidebar .nav-link.active {
            background: linear-gradient(135deg, var(--asabri-gold) 0%, var(--asabri-gold-dark) 100%);
            color: var(--asabri-navy-dark);
            font-weight: 700;
            box-shadow: 0 4px 15px rgba(212, 175, 55, 0.35);
        }

        .sidebar .nav-link.active i {
            color: var(--asabri-navy-dark);
        }

        /* Main Content */
        .main-content {
            margin-left: var(--sidebar-width);
            min-height: 100vh;
            transition: all 0.4s;
            position: relative;
            background: #F8FAFC;
        }

        /* Header Enhancement */
        .top-header {
            background: var(--glass-bg);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            padding: 20px 40px;
            position: sticky;
            top: 0;
            z-index: 1000;
            border-bottom: 1px solid rgba(0, 41, 102, 0.06);
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 4px 20px rgba(0,0,0,0.01);
        }

        .top-header h4 {
            color: var(--asabri-navy);
            font-weight: 800;
            margin: 0;
            letter-spacing: -0.5px;
            font-size: 1.4rem;
        }

        .user-profile {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 8px 12px 8px 16px;
            background: white;
            border-radius: 50px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.04);
            border: 1px solid rgba(0, 41, 102, 0.08);
            transition: all 0.3s;
        }

        .user-profile:hover {
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.06);
            border-color: rgba(0, 41, 102, 0.15);
        }

        /* Cards Enhancement */
        .stat-card {
            background: white;
            border-radius: var(--border-radius-lg);
            padding: 28px;
            border: 1px solid rgba(0, 41, 102, 0.05);
            box-shadow: var(--card-shadow);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
            display: flex;
            flex-direction: column;
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background: linear-gradient(90deg, var(--asabri-navy), var(--asabri-gold));
            opacity: 0;
            transition: 0.4s;
        }

        .stat-card:hover {
            transform: translateY(-6px);
            box-shadow: var(--card-shadow-hover);
            border-color: rgba(0, 41, 102, 0.1);
        }

        .stat-card:hover::before {
            opacity: 1;
        }

        .stat-card .icon-box {
            width: 54px;
            height: 54px;
            border-radius: var(--border-radius-md);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            margin-bottom: 20px;
            transition: transform 0.3s;
        }

        .stat-card:hover .icon-box {
            transform: scale(1.05);
        }

        .stat-card h3 {
            font-size: 32px;
            font-weight: 800;
            color: var(--asabri-navy);
            margin: 10px 0;
            letter-spacing: -1px;
            line-height: 1.2;
        }

        .stat-card .label {
            color: var(--asabri-grey);
            font-weight: 600;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        /* Tables & Content Containers */
        .content-card {
            background: white;
            border-radius: var(--border-radius-lg);
            padding: 28px;
            box-shadow: var(--card-shadow);
            border: 1px solid rgba(0, 41, 102, 0.05);
            transition: box-shadow 0.3s;
        }

        .content-card:hover {
            box-shadow: var(--card-shadow-hover);
        }

        .table {
            margin-bottom: 0;
        }

        .table thead th {
            background: linear-gradient(135deg, var(--asabri-navy) 0%, var(--asabri-navy-dark) 100%);
            color: white;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.8rem;
            letter-spacing: 0.5px;
            padding: 18px 20px;
            border: none;
            white-space: nowrap;
        }
        
        .table thead th:first-child {
            border-top-left-radius: 12px;
        }

        .table thead th:last-child {
            border-top-right-radius: 12px;
        }

        .table tbody td {
            padding: 16px 20px;
            vertical-align: middle;
            color: var(--asabri-grey);
            border-bottom: 1px solid #F1F5F9;
            font-weight: 500;
            transition: background 0.2s;
        }

        .table tbody tr:hover td {
            background: rgba(248, 250, 252, 0.8);
        }

        /* Form & Badges Enhancement */
        .form-control:focus, .form-select:focus {
            border-color: var(--asabri-gold);
            box-shadow: 0 0 0 0.25rem rgba(212, 175, 55, 0.15);
        }

        .badge {
            font-weight: 600;
            padding: 0.5em 0.8em;
            letter-spacing: 0.3px;
        }
        
        .badge.bg-info { background-color: rgba(0, 64, 128, 0.1) !important; color: var(--asabri-blue) !important; border: 1px solid rgba(0,64,128,0.15); }
        .badge.bg-success { background-color: rgba(16, 185, 129, 0.1) !important; color: #059669 !important; border: 1px solid rgba(16,185,129,0.15); }
        .badge.bg-warning { background-color: rgba(212, 175, 55, 0.1) !important; color: var(--asabri-gold-dark) !important; border: 1px solid rgba(212,175,55,0.2); }
        .badge.bg-danger { background-color: rgba(239, 68, 68, 0.1) !important; color: #DC2626 !important; border: 1px solid rgba(239,68,68,0.15); }
        .badge.bg-secondary { background-color: rgba(100, 116, 139, 0.1) !important; color: var(--asabri-grey) !important; border: 1px solid rgba(100,116,139,0.15); }

        /* Pagination */
        .pagination {
            margin-bottom: 0;
            gap: 5px;
        }
        .page-link {
            border-radius: 8px !important;
            border: 1px solid rgba(0,41,102,0.1);
            color: var(--asabri-navy);
            font-weight: 600;
            padding: 8px 14px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.02);
            transition: all 0.3s;
        }
        .page-link:hover {
            background-color: var(--asabri-light);
            color: var(--asabri-navy-dark);
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.05);
        }
        .page-item.active .page-link {
            background: linear-gradient(135deg, var(--asabri-navy) 0%, var(--asabri-blue) 100%);
            border-color: transparent;
            color: white;
            box-shadow: 0 4px 10px rgba(0,41,102,0.25);
        }
        .page-item.disabled .page-link {
            background-color: #F8FAFC;
            color: #94A3B8;
            border-color: #E2E8F0;
            box-shadow: none;
        }

        /* Alerts */
        .alert {
            border: none;
            border-radius: 12px;
            padding: 16px 20px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.04);
            font-weight: 500;
        }
        .alert-success {
            background-color: #ECFDF5;
            color: #065F46;
            border-left: 4px solid #10B981;
        }
        .alert-danger {
            background-color: #FEF2F2;
            color: #991B1B;
            border-left: 4px solid #EF4444;
        }
        .alert-dismissible .btn-close {
            padding: 1.25rem 1rem;
        }

        /* Modals */
        .modal-content {
            border: none;
            border-radius: var(--border-radius-lg);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
            overflow: hidden;
        }
        .modal-header {
            background: linear-gradient(135deg, var(--asabri-navy) 0%, var(--asabri-navy-dark) 100%) !important;
            border-bottom: none;
            padding: 20px 24px;
        }
        .modal-header .modal-title {
            font-weight: 700;
            letter-spacing: 0.5px;
        }
        .modal-body {
            padding: 24px;
        }
        .modal-footer {
            border-top: 1px solid rgba(0,0,0,0.05);
            padding: 16px 24px;
            background: #F8FAFC;
        }

        /* Buttons */
        .btn-asabri {
            background: linear-gradient(135deg, var(--asabri-navy) 0%, var(--asabri-blue) 100%);
            color: white;
            border: none;
            padding: 12px 24px;
            border-radius: var(--border-radius-md);
            font-weight: 600;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            box-shadow: 0 4px 12px rgba(0, 41, 102, 0.15);
        }

        .btn-asabri:hover {
            background: linear-gradient(135deg, var(--asabri-navy-dark) 0%, var(--asabri-navy) 100%);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(0, 41, 102, 0.25);
        }

        /* Animations */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(15px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .fade-in {
            animation: fadeIn 0.6s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        }

        /* Responsive */
        @media (max-width: 992px) {
            .sidebar {
                transform: translateX(-100%);
            }
            .sidebar.show {
                transform: translateX(0);
            }
            .main-content {
                margin-left: 0;
            }
            .content-wrapper {
                padding: 20px;
            }
        }

        .content-wrapper {
            padding: 40px;
            max-width: 1600px;
            margin: 0 auto;
        }
    </style>
</head>

<body>
    @include('layouts.sidebar')

    <div class="main-content">
        <div class="top-header">
            <h4>{{ $pageTitle ?? 'Dashboard' }}</h4>

            @auth
                <div class="user-profile">
                    <div class="d-flex align-items-center gap-3">
                        <div class="avatar-circle bg-light d-flex align-items-center justify-content-center"
                            style="width: 35px; height: 35px; border-radius: 50%; color: var(--asabri-navy);">
                            <i class="fas fa-user-tie"></i>
                        </div>
                        <div class="d-none d-md-block text-start">
                            <div style="font-size: 0.85rem; font-weight: 700; color: var(--asabri-navy); line-height: 1;">
                                {{ auth()->user()->name }}
                            </div>
                            <div
                                style="font-size: 0.7rem; color: var(--asabri-grey); text-transform: uppercase; font-weight: 600;">
                                {{ auth()->user()->role }}
                            </div>
                        </div>
                    </div>
                    <div class="ms-3 ps-3 border-start">
                        <form method="POST" action="{{ route('logout') }}" class="m-0">
                            @csrf
                            <button type="submit" class="btn btn-link p-0 text-danger text-decoration-none" title="Logout">
                                <i class="fas fa-power-off"></i>
                            </button>
                        </form>
                    </div>
                </div>
            @else
                <div class="user-info">
                    <a href="{{ route('login') }}" class="btn btn-asabri shadow-sm">
                        <i class="fas fa-sign-in-alt me-2"></i>Login Area
                    </a>
                </div>
            @endauth
        </div>

        <div class="content-wrapper">
            @if(session('success'))
                <script>
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: "{{ session('success') }}",
                        timer: 3000,
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

            @if(session('status'))
                <script>
                    Swal.fire({
                        icon: 'info',
                        title: 'Info',
                        text: "{{ session('status') }}",
                        timer: 3000,
                        showConfirmButton: false,
                        toast: true,
                        position: 'top-end',
                        timerProgressBar: true,
                    });
                </script>
            @endif

            {{ $slot }}
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Global Delete Confirmation
        document.addEventListener('click', function(e) {
            if (e.target.closest('.delete-confirm')) {
                e.preventDefault();
                const form = e.target.closest('form');
                const message = e.target.closest('.delete-confirm').dataset.message || 'Data yang dihapus tidak dapat dikembalikan!';
                
                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: message,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#002966',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, Hapus!',
                    cancelButtonText: 'Batal',
                    reverseButtons: true,
                    borderRadius: '15px'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            }
        });

        // Add class to all delete forms found via grep earlier
        document.addEventListener('DOMContentLoaded', function() {
            // This is a helper for legacy forms if we don't want to manual edit every single one
            // but it's better to explicitly add the class to buttons.
        });
    </script>
</body>

</html>