<?php
/**
 * API auth untuk login/logout
 * Endpoint: /apilogin.php
 */

session_start();

// CORS Headers
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With');
header('Access-Control-Allow-Credentials: true');
header('Content-Type: application/json; charset=utf-8');

// Handle preflight OPTIONS request
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

// Tampilkan error saat development
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Load controller auth
require_once __DIR__ . '/../src/controller/ApiAuthController.php';

use src\controller\ApiAuthController;

/**
 * Helper kirim respon JSON
 */
function respond(int $status, array $body): void
{
    http_response_code($status);
    echo json_encode($body, JSON_PRETTY_PRINT);
    exit;
}

/**
 * Helper untuk ambil input body (WAJIB JSON)
 */
function getRequestBody(): array
{
    $contentType = $_SERVER['CONTENT_TYPE'] ?? ($_SERVER['HTTP_CONTENT_TYPE'] ?? '');

    if (stripos($contentType, 'application/json') === false) {
        respond(415, [
            'success' => false,
            'message' => 'Content-Type harus application/json'
        ]);
    }

    $raw = file_get_contents('php://input');

    if (empty($raw)) {
        respond(400, [
            'success' => false,
            'message' => 'Body request kosong'
        ]);
    }

    $json = json_decode($raw, true);

    if (json_last_error() !== JSON_ERROR_NONE || !is_array($json)) {
        respond(400, [
            'success' => false,
            'message' => 'Format JSON tidak valid'
        ]);
    }

    return $json;
}

// Routing
$method = $_SERVER['REQUEST_METHOD'] ?? 'POST';
$action = isset($_GET['action']) ? trim((string) $_GET['action']) : 'login';

// GET /apilogin.php?action=me - Cek session aktif
if ($method === 'GET' && $action === 'me') {
    if (!empty($_SESSION['user'])) {
        respond(200, [
            'success' => true,
            'message' => 'Session aktif',
            'data' => [
                'username' => $_SESSION['user'],
            ],
        ]);
    }

    respond(401, [
        'success' => false,
        'message' => 'Session tidak ditemukan'
    ]);
}

// Hanya terima POST untuk login/logout
if ($method !== 'POST') {
    respond(405, [
        'success' => false,
        'message' => 'Method tidak diizinkan. Gunakan POST'
    ]);
}

// POST /apilogin.php?action=logout - Logout
if ($action === 'logout') {
    session_unset();
    session_destroy();
    respond(200, [
        'success' => true,
        'message' => 'Logout berhasil'
    ]);
}

// POST /apilogin.php - Login (default)
$controller = new ApiAuthController();
$input = getRequestBody();
$result = $controller->login($input);

// Simpan user ke session jika login sukses
if ($result['status'] === 200 && !empty($result['body']['data']['username'])) {
    $_SESSION['user'] = $result['body']['data']['username'];
}

respond($result['status'], $result['body']);