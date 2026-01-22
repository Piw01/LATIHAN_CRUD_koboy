<?php
namespace src\controller;

require_once __DIR__ . '/../model/MahasiswaModel.php';
use src\model\MahasiswaModel;

class ApiMahasiswaController
{
    private $model;

    // FIX: Typo di __construct
    public function __construct()
    {
        $this->model = new MahasiswaModel();
    }

    /**
     * Ambil semua data mahasiswa.
     */
    public function index(): array
    {
        try {
            $data = $this->model->getAll();

            return [
                'status' => 200,
                'body' => [
                    'success' => true,
                    'data' => $data,
                ],
            ];

        } catch (\Throwable $e) {
            return $this->serverError($e);
        }
    }

    /**
     * Ambil detail mahasiswa berdasarkan NIM.
     */
    public function show(string $nim): array
    {
        if (trim($nim) === '') {
            return $this->badRequest('NIM tidak boleh kosong.');
        }

        try {
            $mahasiswa = $this->model->getByNim($nim);

            if (!$mahasiswa) {
                return [
                    'status' => 404,
                    'body' => [
                        'success' => false,
                        'message' => 'Mahasiswa tidak ditemukan.',
                    ],
                ];
            }

            return [
                'status' => 200,
                'body' => [
                    'success' => true,
                    'data' => $mahasiswa,
                ],
            ];

        } catch (\Throwable $e) {
            return $this->serverError($e);
        }
    }

    /**
     * Simpan data mahasiswa baru (CREATE).
     */
    public function store(array $input): array
    {
        // Validasi sederhana
        $required = ['nim', 'nama', 'tempat_lahir', 'tanggal_lahir', 'jenis_kelamin', 'telepon', 'alamat'];
        foreach ($required as $field) {
            if (empty($input[$field])) {
                return $this->badRequest("Field '$field' wajib diisi.");
            }
        }

        try {
            // FIX: Gunakan array untuk insertData sesuai dengan MahasiswaModel
            $data = [
                'nim' => $input['nim'],
                'nama' => $input['nama'],
                'tempat_lahir' => $input['tempat_lahir'],
                'tanggal_lahir' => $input['tanggal_lahir'],
                'jenis_kelamin' => $input['jenis_kelamin'],
                'telepon' => $input['telepon'],
                'alamat' => $input['alamat']
            ];

            $ok = $this->model->insertData($data);

            if (!$ok) {
                return $this->serverError(new \Exception('Gagal menyimpan data.'));
            }

            // Setelah insert, ambil lagi data-nya
            $mahasiswa = $this->model->getByNim($input['nim']);

            return [
                'status' => 201, // Created
                'body' => [
                    'success' => true,
                    'message' => 'Data mahasiswa berhasil ditambahkan.',
                    'data' => $mahasiswa,
                ],
            ];

        } catch (\Throwable $e) {
            return $this->serverError($e);
        }
    }

    /**
     * Update data mahasiswa berdasarkan NIM (UPDATE).
     */
    public function update(string $nim, array $input): array
    {
        if (trim($nim) === '') {
            return $this->badRequest('NIM tidak boleh kosong.');
        }

        // Validasi field wajib
        $required = ['nama', 'tempat_lahir', 'tanggal_lahir', 'jenis_kelamin', 'telepon', 'alamat'];
        foreach ($required as $field) {
            if (!isset($input[$field]) || $input[$field] === '') {
                return $this->badRequest("Field '$field' wajib diisi.");
            }
        }

        try {
            // Pastikan data ada dulu
            $existing = $this->model->getByNim($nim);
            if (!$existing) {
                return [
                    'status' => 404,
                    'body' => [
                        'success' => false,
                        'message' => 'Mahasiswa tidak ditemukan.',
                    ],
                ];
            }

            // FIX: Gunakan array untuk updateData
            $data = [
                'nim' => $nim,
                'nama' => $input['nama'],
                'tempat_lahir' => $input['tempat_lahir'],
                'tanggal_lahir' => $input['tanggal_lahir'],
                'jenis_kelamin' => $input['jenis_kelamin'],
                'telepon' => $input['telepon'],
                'alamat' => $input['alamat']
            ];

            $ok = $this->model->updateData($data);

            if (!$ok) {
                return $this->serverError(new \Exception('Gagal mengubah data.'));
            }

            $mahasiswa = $this->model->getByNim($nim);

            return [
                'status' => 200,
                'body' => [
                    'success' => true,
                    'message' => 'Data mahasiswa berhasil diperbarui.',
                    'data' => $mahasiswa,
                ],
            ];

        } catch (\Throwable $e) {
            return $this->serverError($e);
        }
    }

    /**
     * Hapus data mahasiswa (DELETE).
     */
    public function destroy(string $nim): array
    {
        if (trim($nim) === '') {
            return $this->badRequest('NIM tidak boleh kosong.');
        }

        try {
            $existing = $this->model->getByNim($nim);
            if (!$existing) {
                return [
                    'status' => 404,
                    'body' => [
                        'success' => false,
                        'message' => 'Mahasiswa tidak ditemukan.',
                    ],
                ];
            }

            $ok = $this->model->deleteData($nim);

            if (!$ok) {
                return $this->serverError(new \Exception('Gagal menghapus data.'));
            }

            return [
                'status' => 200,
                'body' => [
                    'success' => true,
                    'message' => 'Data mahasiswa berhasil dihapus.',
                ],
            ];

        } catch (\Throwable $e) {
            return $this->serverError($e);
        }
    }

    // ================= Helper Error =================

    private function badRequest(string $message): array
    {
        return [
            'status' => 400,
            'body' => [
                'success' => false,
                'message' => $message,
            ],
        ];
    }

    private function serverError(\Throwable $e): array
    {
        return [
            'status' => 500,
            'body' => [
                'success' => false,
                'message' => 'Terjadi kesalahan pada server.',
                // Uncomment untuk debugging:
                // 'error' => $e->getMessage(),
                // 'trace' => $e->getTraceAsString()
            ],
        ];
    }
}