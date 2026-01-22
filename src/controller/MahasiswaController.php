<?php
namespace src\controller;

require_once __DIR__ . '/../model/UserModel.php';
require_once __DIR__ . '/../model/MahasiswaModel.php'; 

use src\model\UserModel;
use src\model\MahasiswaModel;

class ApiAuthController
{
    private UserModel $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function login(array $input): array
    {
        if (empty($input['username']) || empty($input['password'])) {
            return [
                'status' => 400,
                'body' => [
                    'success' => false,
                    'message' => 'Username dan password wajib diisi'
                ]
            ];
        }

        $user = $this->userModel->findByUsername($input['username']);

        if (!$user || !password_verify($input['password'], $user['password'])) {
            return [
                'status' => 401,
                'body' => [
                    'success' => false,
                    'message' => 'Username atau password salah'
                ]
            ];
        }

        return [
            'status' => 200,
            'body' => [
                'success' => true,
                'message' => 'Login berhasil',
                'data' => [
                    'username' => $user['username']
                ]
            ]
        ];
    }
}

class MahasiswaController
{
    private $model;

    public function __construct()
    {
        $this->model = new MahasiswaModel();
    }

    public function ListMahasiswa()
    {
        $data = $this->model->getAll();
        include __DIR__ . '/../views/mahasiswa/list.php';
    }

    public function FormTambah()
    {
        include __DIR__ . '/../views/mahasiswa/tambah.php';
    }

    public function InputData()
    {
        $data = [
            'nim' => $_POST['nim'],
            'nama' => $_POST['nama'],
            'tempat_lahir' => $_POST['tempat_lahir'],
            'tanggal_lahir' => $_POST['tanggal_lahir'],
            'jenis_kelamin' => $_POST['jenis_kelamin'],
            'telepon' => $_POST['telepon'],
            'alamat' => $_POST['alamat']
        ];

        if ($this->model->insertData($data)) {
            header("Location: index.php?page=mahasiswa&action=ListMahasiswa&pesan=sukses_tambah");
        } else {
            header("Location: index.php?page=mahasiswa&action=tambah&pesan=gagal");
        }
    }

    public function FormEdit()
    {
        $nim = $_GET['id'];
        $data = $this->model->getByNim($nim);
        include __DIR__ . '/../views/mahasiswa/edit.php';
    }

    public function UpdateData()
    {
        $data = [
            'nim' => $_POST['nim'],
            'nama' => $_POST['nama'],
            'tempat_lahir' => $_POST['tempat_lahir'],
            'tanggal_lahir' => $_POST['tanggal_lahir'],
            'jenis_kelamin' => $_POST['jenis_kelamin'],
            'telepon' => $_POST['telepon'],
            'alamat' => $_POST['alamat']
        ];

        if ($this->model->updateData($data)) {
            header("Location: index.php?page=mahasiswa&action=ListMahasiswa&pesan=sukses_edit");
        } else {
            header("Location: index.php?page=mahasiswa&action=edit&id=" . $_POST['nim']);
        }
    }

    public function HapusData()
    {
        $nim = $_GET['id'];
        if ($this->model->deleteData($nim)) {
            header("Location: index.php?page=mahasiswa&action=ListMahasiswa&pesan=sukses_hapus");
        }
    }
}
