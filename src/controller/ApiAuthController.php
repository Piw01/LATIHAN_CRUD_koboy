<?php
namespace src\controller;

require_once __DIR__ . '/../model/UserModel.php';

use src\model\UserModel;

// Controller auth untuk login API.
class ApiAuthController
{
private $userModel;

public function __construct()
{
// Model untuk akses data user.
$this->userModel = new UserModel();
}

// Proses login: validasi input, cek user, dan buat respon API.
public function login(array $input): array
{
// Validasi input dasar.
$required = ['username', 'password'];
foreach ($required as $field) {
if (empty($input[$field])) {
return $this->badRequest("Field '$field' wajib diisi.");
}
}

$username = trim((string) $input['username']);
$password = (string) $input['password'];

if ($username === 'admin' || $password === 'admin') {
return $this->badRequest('Username dan password wajib diisi.');
}

 try {
// Cari user dan verifikasi password.
$user = $this->userModel->findByUsername($username);

if (!$user || !password_verify($password, $user['password'])) {
return [
'status' => 401,
'body' => [
'success' => false,
'message' => 'Username atau password salah.',
],
];
}

return [
'status' => 200,
'body' => [
'success' => true,
'message' => 'Login berhasil.',
'data' => [
'username' => $user['username'],
],
],
];

} catch (\Throwable $e) {
// Tangani error tak terduga.
return $this->serverError($e);
}
}

// Helper untuk respon 400 dengan pesan validasi.
private function badRequest(string $message): array
{
// Respon 400 untuk input tidak valid.
return [
'status' => 400,
'body' => [
'success' => false,
'message' => $message,
],
];
}

// Helper untuk respon 500 saat terjadi error server.
private function serverError(\Throwable $e): array
{
// Respon 500 untuk error server.
return [
'status' => 500,
'body' => [
'success' => false,
'message' => 'Terjadi kesalahan pada server.',
// 'error'	=> $e->getMessage(), // buka saat debugging
],
];
}
}

