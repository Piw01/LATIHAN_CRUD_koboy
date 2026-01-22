<!doctype html>
<html lang="en" class="h-100">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pirate_Crud - Student Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <style>
        :root {
            --pirate-dark: #0f3460;
            --pirate-darker: #16213e;
            --pirate-darkest: #1a1a2e;
            --pirate-gold: #e94560;
            --pirate-light: #533483;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #1a1a2e 0%, #0f3460 50%, #16213e 100%);
            min-height: 100vh;
            position: relative;
            overflow-x: hidden;
        }

        /* Nautical background pattern */
        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: 
                repeating-linear-gradient(
                    45deg,
                    transparent,
                    transparent 10px,
                    rgba(255,255,255,.015) 10px,
                    rgba(255,255,255,.015) 20px
                ),
                radial-gradient(circle at 20% 50%, rgba(83, 52, 131, 0.1) 0%, transparent 50%),
                radial-gradient(circle at 80% 80%, rgba(233, 69, 96, 0.1) 0%, transparent 50%);
            pointer-events: none;
            z-index: 0;
        }

        /* Floating anchors decoration */
        .anchor-decoration {
            position: fixed;
            opacity: 0.03;
            font-size: 150px;
            color: #fff;
            animation: float 8s ease-in-out infinite;
            pointer-events: none;
            z-index: 1;
        }

        .anchor-1 { top: 10%; left: 5%; animation-delay: 0s; }
        .anchor-2 { top: 60%; right: 8%; animation-delay: 3s; transform: rotate(45deg); }
        .anchor-3 { bottom: 15%; left: 50%; animation-delay: 5s; transform: rotate(-20deg); }

        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-30px) rotate(10deg); }
        }

        /* Navbar Styling */
        .navbar {
            background: rgba(26, 26, 46, 0.95) !important;
            backdrop-filter: blur(10px);
            border-bottom: 2px solid rgba(233, 69, 96, 0.3);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
            position: relative;
            z-index: 1000;
        }

        .navbar-brand {
            font-weight: 700;
            font-size: 24px;
            color: #fff !important;
            letter-spacing: 2px;
            text-transform: uppercase;
            display: flex;
            align-items: center;
            gap: 12px;
            transition: all 0.3s ease;
        }

        .navbar-brand:hover {
            transform: scale(1.05);
            color: #e94560 !important;
        }

        .navbar-brand i {
            font-size: 28px;
            animation: swing 3s ease-in-out infinite;
        }

        @keyframes swing {
            0%, 100% { transform: rotate(0deg); }
            25% { transform: rotate(-10deg); }
            75% { transform: rotate(10deg); }
        }

        .nav-link {
            color: rgba(255, 255, 255, 0.8) !important;
            font-weight: 500;
            padding: 8px 20px !important;
            border-radius: 8px;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .nav-link::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(233, 69, 96, 0.2), transparent);
            transition: left 0.5s ease;
        }

        .nav-link:hover::before {
            left: 100%;
        }

        .nav-link:hover {
            color: #fff !important;
            background: rgba(233, 69, 96, 0.2);
            transform: translateY(-2px);
        }

        .nav-link.active {
            color: #e94560 !important;
            background: rgba(233, 69, 96, 0.1);
        }

        .nav-link i {
            margin-right: 6px;
        }

        /* Main content wrapper */
        main {
            position: relative;
            z-index: 10;
            min-height: calc(100vh - 140px);
            padding-top: 30px;
            padding-bottom: 30px;
        }

        .container {
            position: relative;
            z-index: 10;
        }

        /* Card styling */
        .card {
            background: rgba(255, 255, 255, 0.98);
            border: none;
            border-radius: 20px;
            box-shadow: 
                0 10px 40px rgba(0, 0, 0, 0.2),
                0 0 0 1px rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 
                0 15px 50px rgba(0, 0, 0, 0.3),
                0 0 0 1px rgba(233, 69, 96, 0.3);
        }

        .card-header {
            background: linear-gradient(135deg, var(--pirate-dark), var(--pirate-darker)) !important;
            color: white !important;
            border: none;
            padding: 20px 25px;
            font-weight: 600;
            letter-spacing: 1px;
            position: relative;
            overflow: hidden;
        }

        .card-header::before {
            content: '⚓';
            position: absolute;
            right: 20px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 40px;
            opacity: 0.1;
        }

        .card-body {
            padding: 25px;
        }

        /* Button styling */
        .btn-primary {
            background: linear-gradient(135deg, var(--pirate-dark), var(--pirate-darker));
            border: none;
            padding: 10px 24px;
            border-radius: 10px;
            font-weight: 600;
            letter-spacing: 0.5px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(15, 52, 96, 0.3);
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, var(--pirate-darker), var(--pirate-dark));
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(15, 52, 96, 0.4);
        }

        .btn-success {
            background: linear-gradient(135deg, #28a745, #20c997);
            border: none;
            box-shadow: 0 4px 15px rgba(40, 167, 69, 0.3);
        }

        .btn-warning {
            background: linear-gradient(135deg, #ffc107, #ff9800);
            border: none;
            color: #1a1a2e;
            font-weight: 600;
            box-shadow: 0 4px 15px rgba(255, 193, 7, 0.3);
        }

        .btn-danger {
            background: linear-gradient(135deg, #dc3545, #e94560);
            border: none;
            box-shadow: 0 4px 15px rgba(220, 53, 69, 0.3);
        }

        /* Table styling */
        .table {
            border-radius: 12px;
            overflow: hidden;
            margin-bottom: 0;
        }

        .table thead {
            background: linear-gradient(135deg, var(--pirate-dark), var(--pirate-darker));
            color: white;
        }

        .table thead th {
            border: none;
            padding: 15px;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 13px;
            letter-spacing: 0.5px;
        }

        .table tbody tr {
            transition: all 0.3s ease;
        }

        .table tbody tr:hover {
            background: rgba(15, 52, 96, 0.05);
            transform: scale(1.01);
        }

        .table tbody td {
            padding: 15px;
            vertical-align: middle;
            border-color: rgba(0, 0, 0, 0.05);
        }

        /* Form styling */
        .form-control, .form-select {
            border: 2px solid #e0e0e0;
            border-radius: 10px;
            padding: 12px 16px;
            transition: all 0.3s ease;
            background: #f8f9fa;
        }

        .form-control:focus, .form-select:focus {
            border-color: var(--pirate-dark);
            box-shadow: 0 0 0 4px rgba(15, 52, 96, 0.1);
            background: white;
        }

        .form-label {
            font-weight: 600;
            color: var(--pirate-darkest);
            margin-bottom: 8px;
            font-size: 14px;
        }

        /* Footer styling */
        footer {
            background: rgba(26, 26, 46, 0.95);
            color: rgba(255, 255, 255, 0.8);
            padding: 20px 0;
            border-top: 2px solid rgba(233, 69, 96, 0.3);
            position: relative;
            z-index: 1000;
            margin-top: auto;
        }

        footer::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: 
                radial-gradient(circle at 20% 50%, rgba(83, 52, 131, 0.1) 0%, transparent 50%),
                radial-gradient(circle at 80% 50%, rgba(233, 69, 96, 0.1) 0%, transparent 50%);
            pointer-events: none;
        }

        footer .text-muted {
            color: rgba(255, 255, 255, 0.6) !important;
            position: relative;
            z-index: 1;
        }

        /* Page title */
        .page-title {
            color: white;
            font-weight: 700;
            margin-bottom: 25px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .page-title i {
            color: var(--pirate-gold);
        }

        /* Alert styling */
        .alert {
            border: none;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        /* Logout button in navbar */
        .btn-logout {
            background: linear-gradient(135deg, #dc3545, #e94560);
            border: none;
            padding: 8px 20px;
            border-radius: 8px;
            color: white;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(220, 53, 69, 0.3);
        }

        .btn-logout:hover {
            background: linear-gradient(135deg, #e94560, #dc3545);
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(220, 53, 69, 0.4);
            color: white;
        }

        /* Loading spinner */
        .spinner-border-sm {
            width: 1rem;
            height: 1rem;
            border-width: 0.15em;
        }
    </style>
</head>
<body class="d-flex flex-column h-100">
    <!-- Background decorations -->
    <div class="anchor-decoration anchor-1">⚓</div>
    <div class="anchor-decoration anchor-2">⚓</div>
    <div class="anchor-decoration anchor-3">⚓</div>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="index.php">
                <i class="fas fa-skull-crossbones"></i>
                <span>PIRATE_CRUD</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item">
                        <a class="nav-link <?= (!isset($_GET['page']) || $_GET['page'] === 'home') ? 'active' : '' ?>" href="index.php?page=home">
                            <i class="fas fa-home"></i> Pelabuhan
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= (isset($_GET['page']) && $_GET['page'] === 'mahasiswa') ? 'active' : '' ?>" href="index.php?page=mahasiswa&action=ListMahasiswa">
                            <i class="fas fa-users"></i> Crew Registry
                        </a>
                    </li>
                    <li class="nav-item ms-2">
                        <a href="index.php?page=logout" class="btn btn-logout btn-sm">
                            <i class="fas fa-sign-out-alt me-1"></i> Tinggalkan Kapal
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <main class="flex-shrink-0">
        <div class="container">