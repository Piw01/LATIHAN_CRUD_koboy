<?php include __DIR__ . '/../layouts/header.php'; ?>

<div class="row mb-3 align-items-center">
    <div class="col-md-6">
        <h3 class="fw-bold text-secondary">Data Mahasiswa</h3>
    </div>
    <div class="col-md-6 text-md-end">
        <a href="index.php?page=mahasiswa&action=tambah" class="btn btn-success">
            <i class="fas fa-plus me-1"></i> Tambah Data
        </a>
    </div>
</div>

<!-- Alert Pesan (Opsional) -->
<?php if (isset($_GET['pesan'])): ?>
    <div class="alert alert-info alert-dismissible fade show" role="alert">
        Pesan: <strong><?= htmlspecialchars($_GET['pesan']) ?></strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<div class="card shadow-sm border-0">
    <div class="card-body">
        <div class="table-responsive">
            <!-- Table dengan style Striped dan Hover -->
            <table class="table table-striped table-hover align-middle">
                <thead class="table-primary">
                    <tr>
                        <th>#</th>
                        <th>NIM</th>
                        <th>Nama</th>
                        <th>TTL</th>
                        <th>Jenis Kelamin</th>
                        <th>Telepon</th>
                        <th>Alamat</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $no = 1;
                    foreach ($data as $m): 
                    ?>
                    <tr>
                        <th><?= $no++ ?></th>
                        <td><?= htmlspecialchars($m['nim']) ?></td>
                        <td class="fw-bold"><?= htmlspecialchars($m['nama']) ?></td>
                        <td><?= htmlspecialchars($m['tempat_lahir']) . ", " . htmlspecialchars($m['tanggal_lahir']) ?></td>
                        <td><?= htmlspecialchars($m['jenis_kelamin']) ?></td>
                        <td><?= htmlspecialchars($m['telepon']) ?></td>
                        <td><?= htmlspecialchars($m['alamat']) ?></td>
                        <td>
                            <div class="d-flex gap-1">
                                <a href="index.php?page=mahasiswa&action=edit&id=<?= $m['nim'] ?>" class="btn btn-warning btn-sm text-white">
                                    Edit
                                </a>
                                <a href="index.php?page=mahasiswa&action=hapus&id=<?= $m['nim'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus data ini?')">
                                    Hapus
                                </a>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include __DIR__ . '/../layouts/footer.php'; ?>