<?php include __DIR__ . '/../layouts/header.php'; ?>

<div class="card shadow-sm col-md-8 mx-auto">
    <div class="card-header bg-success text-white">
        <h5 class="mb-0">Tambah Data Mahasiswa</h5>
    </div>
    <div class="card-body">
        <form action="index.php?page=mahasiswa&action=simpan" method="post">
            <div class="mb-3">
                <label class="form-label">NIM</label>
                <input type="number" name="nim" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Nama Lengkap</label>
                <input type="text" name="nama" class="form-control" required>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Tempat Lahir</label>
                    <input type="text" name="tempat_lahir" class="form-control" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Tanggal Lahir</label>
                    <input type="date" name="tanggal_lahir" class="form-control" required>
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label">Jenis Kelamin</label>
                <select name="jenis_kelamin" class="form-select" required>
                    <option value="">-- Pilih --</option>
                    <option value="Laki-laki">Laki-laki</option>
                    <option value="Perempuan">Perempuan</option>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Telepon</label>
                <input type="text" name="telepon" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Alamat</label>
                <textarea name="alamat" class="form-control" rows="3" required></textarea>
            </div>
            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-success">Simpan Data</button>
                <a href="index.php?page=mahasiswa&action=ListMahasiswa" class="btn btn-secondary">Kembali</a>
            </div>
        </form>
    </div>
</div>

<?php include __DIR__ . '/../layouts/footer.php'; ?>