<?php
session_start();

require_once __DIR__ . '/../src/controller/AuthController.php';
require_once __DIR__ . '/../src/controller/MahasiswaController.php';

use src\controller\AuthController;
use src\controller\MahasiswaController;


$page   = $_GET['page']   ?? 'login';
$action = $_GET['action'] ?? 'index';

if ($page === 'login') {

    $auth = new AuthController();

    if ($action === 'proses') {
        $auth->login();
    } else {
        $auth->index();
    }

} elseif ($page === 'logout') {

    session_destroy();
    header("Location: index.php?page=login");
    exit;

} elseif ($page === 'home') {

    if (!isset($_SESSION['login'])) {
        header("Location: index.php?page=login");
        exit;
    }

    require_once __DIR__ . '/../src/views/Home.php';
    exit;
}


// ================= MAHASISWA =================
 elseif ($page === 'mahasiswa') {

    if (!isset($_SESSION['login'])) {
        header("Location: index.php?page=login");
        exit;
    }

    $controller = new MahasiswaController();
    $action = $_GET['action'] ?? 'ListMahasiswa';

    switch ($action) {
        case 'ListMahasiswa':
            $controller->ListMahasiswa();
            break;

        case 'tambah':
            $controller->FormTambah();
            break;

        case 'simpan':
            $controller->InputData();
            break;

        case 'edit':
            $controller->FormEdit();
            break;

        case 'update':
            $controller->UpdateData();
            break;

        case 'hapus':
            $controller->HapusData();
            break;

        default:
            $controller->ListMahasiswa();
            break;
    }
}
else{
    
}

    echo "Halaman tidak ditemukan";

{

}    


