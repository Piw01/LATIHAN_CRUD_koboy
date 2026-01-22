<?php
// API endpoint mahasiswa (JSON only)
session_start();

// DEBUG (hapus di production)
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Semua response JSON
header('Content-Type: application/json; charset=utf-8');

// ===== LOAD CONTROLLER (PATH BENAR) =====
require_once __DIR__ . '/../src/controller/ApiMahasiswaController.php';

use src\controller\ApiMahasiswaController;

// ===== HELPER RESPONSE =====
function respond(int $status, array $body): void
{
    http_response_code($status);
    echo json_encode($body);
    exit;
}

// ===== HELPER REQUEST BODY (JSON) =====
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
            'message' => 'Format JSON tidak valid'
        ]);
    }

    return $json;
}

// ===== BASIC ROUTING =====
$method = $_SERVER['REQUEST_METHOD'] ?? 'GET';
$nim    = $_GET['nim'] ?? null;

// Init controller
$controller = new ApiMahasiswaController();

try {
    switch ($method) {

        // ===== GET =====
        case 'GET':
            if ($nim) {
                $result = $controller->show($nim);
            } else {
                $result = $controller->index();
            }
            respond($result['status'], $result['body']);
            break;

        // ===== POST =====
        case 'POST':
            if (empty($_SESSION['user'])) {
                respond(401, [
                    'success' => false,
                    'message' => 'Unauthorized, silakan login'
                ]);
            }

            $input = getRequestBody();
            $result = $controller->store($input);
            respond($result['status'], $result['body']);
            break;

        // ===== PUT / PATCH =====
        case 'PUT':
        case 'PATCH':
            if (empty($_SESSION['user'])) {
                respond(401, [
                    'success' => false,
                    'message' => 'Unauthorized, silakan login'
                ]);
            }

            if (!$nim) {
                respond(400, [
                    'success' => false,
                    'message' => 'Parameter nim wajib'
                ]);
            }

            $input = getRequestBody();
            $result = $controller->update($nim, $input);
            respond($result['status'], $result['body']);
            break;

        // ===== DELETE =====
        case 'DELETE':
            if (empty($_SESSION['user'])) {
                respond(401, [
                    'success' => false,
                    'message' => 'Unauthorized, silakan login'
                ]);
            }

            if (!$nim) {
                respond(400, [
                    'success' => false,
                    'message' => 'Parameter nim wajib'
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
        'message' => $e->getMessage(),
        'file' => $e->getFile(),
        'line' => $e->getLine()
    ]);
}
