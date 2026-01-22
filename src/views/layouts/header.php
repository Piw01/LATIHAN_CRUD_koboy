<!doctype html>
<html lang="en" class="h-100">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Latihan CRUD - Mahasiswa</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome untuk Icon (Opsional, agar lebih bagus) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <style>
        /* Custom CSS sedikit untuk mempercantik */
        .navbar-brand { font-weight: bold; letter-spacing: 1px; }
        .table thead { background-color: #0d6efd; color: white; }
    </style>
    <style>
    body {
        background: linear-gradient(135deg, #e3f2fd, #f8f9fa);
    }

    .card-login {
        border-radius: 15px;
        box-shadow: 0 10px 25px rgba(0,0,0,0.1);
    }

    .card-login .form-control {
        border-radius: 10px;
    }

    .btn-login {
        border-radius: 10px;
        font-weight: 600;
        letter-spacing: 1px;
    }

    .page-title {
        font-weight: bold;
        color: #0d6efd;
    }

    .table {
        border-radius: 10px;
        overflow: hidden;
    }

    footer {
        background-color: #0d6efd;
        color: white;
        padding: 15px 0;
    }
</style>

</head>
<body class="d-flex flex-column h-100 bg-light">

<!-- Navbar dengan warna Biru (Primary) -->
<nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="index.php"><i class="fas fa-university me-2"></i>Latihan CRUD</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link active" href="index.php?page=home">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="index.php?page=mahasiswa&action=ListMahasiswa">Data Mahasiswa</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<main class="flex-shrink-0">
    <div class="container mt-4 mb-5">