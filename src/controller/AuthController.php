<?php
namespace src\controller;

class AuthController
{
    public function index()
    {
        require __DIR__ . '/../views/login.php';
    }

    public function login()
    {

        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';

        if ($username === 'admin' && $password === 'admin') {
            $_SESSION['login'] = true;
            header("Location: index.php?page=home");
            exit;
        }

        echo "Login gagal";
    }
}
