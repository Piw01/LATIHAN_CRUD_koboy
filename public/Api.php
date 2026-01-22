<?php
/**
 * API endpoint mahasiswa (JSON only)
 * Endpoint: /api.php
 */

session_start();

// CORS Headers - PENTING untuk akses dari domain berbeda
header('Access-Control-Allow-Origin: *'); // Atau ganti dengan domain frontend Anda
header('Access-Control-Allow-Methods: GET, POST, PUT, PATCH, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With');
header('Access-Control-Allow-Credentials: true');
header('Content-Type: application/json; charset=utf-8');

// Handle preflight OPTIONS request
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

// Tampilkan error saat development (NONAKTIFKAN di production!)
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Load controller
require_once __DIR__ . '/../src/controller/ApiMahasiswaController.php';

use src\controller\ApiMahasiswaController;

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
    $contentType = $_SERVER['CONTENT_TYPE'] ?? '';

    if (stripos($contentType, 'application/json') === false) {
        respond(415, [
            'success' => false,
            'message' => 'Content-Type harus application/json'
        ]);
    }

    $raw = file_get_contents('php://input');

    if (!$raw) {
        respond(400, [
            'success' => false,
            'message' => 'Body request kosong'
        ]);
    }

    $json = json_decode($raw, true);

    if (json_last_error() !== JSON_ERROR_NONE) {
        respond(400, [
            'success' => false,
            'message' => 'Format JSON tidak valid: ' . json_last_error_msg()
        ]);
    }

    return $json;
}

// Routing
$method = $_SERVER['REQUEST_METHOD'] ?? 'GET';
$nim = $_GET['nim'] ?? null;

// Init controller
$controller = new ApiMahasiswaController();

try {
    switch ($method) {

        // GET - Ambil semua atau satu data
        case 'GET':
            if ($nim) {
                $result = $controller->show($nim);
            } else {
                $result = $controller->index();
            }
            respond($result['status'], $result['body']);
            break;

        // POST - Tambah data baru
        case 'POST':
            // Cek auth (opsional, sesuaikan kebutuhan)
            if (empty($_SESSION['user'])) {
                respond(401, [
                    'success' => false,
                    'message' => 'Unauthorized. Silakan login terlebih dahulu.'
                ]);
            }

            $input = getRequestBody();
            $result = $controller->store($input);
            respond($result['status'], $result['body']);
            break;

        // PUT/PATCH - Update data
        case 'PUT':
        case 'PATCH':
            if (empty($_SESSION['user'])) {
                respond(401, [
                    'success' => false,
                    'message' => 'Unauthorized. Silakan login terlebih dahulu.'
                ]);
            }

            if (!$nim) {
                respond(400, [
                    'success' => false,
                    'message' => 'Parameter nim wajib diisi'
                ]);
            }

            $input = getRequestBody();
            $result = $controller->update($nim, $input);
            respond($result['status'], $result['body']);
            break;

        // DELETE - Hapus data
        case 'DELETE':
            if (empty($_SESSION['user'])) {
                respond(401, [
                    'success' => false,
                    'message' => 'Unauthorized. Silakan login terlebih dahulu.'
                ]);
            }

            if (!$nim) {
                respond(400, [
                    'success' => false,
                    'message' => 'Parameter nim wajib diisi'
                ]);
            }

            $result = $controller->destroy($nim);
            respond($result['status'], $result['body']);
            break;

        default:
            respond(405, [
                'success' => false,
                'message' => 'Method tidak diizinkan'
            ]);
    }

} catch (Throwable $e) {
    respond(500, [
        'success' => false,
        'message' => 'Internal server error',
        'error' => $e->getMessage(),
        'file' => $e->getFile(),
        'line' => $e->getLine()
    ]);
}