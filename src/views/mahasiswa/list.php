<?php include __DIR__ . '/../layouts/header.php'; ?>

<style>
    .page-header {
        background: rgba(255, 255, 255, 0.98);
        border-radius: 20px;
        padding: 25px 30px;
        margin-bottom: 25px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 15px;
    }

    .page-header h3 {
        color: #1a1a2e;
        font-weight: 700;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .page-header h3 i {
        color: #e94560;
        font-size: 32px;
    }

    .badge-count {
        background: linear-gradient(135deg, #0f3460, #16213e);
        color: white;
        padding: 8px 16px;
        border-radius: 20px;
        font-size: 14px;
        font-weight: 600;
        margin-left: 10px;
    }

    .search-filter-section {
        background: rgba(255, 255, 255, 0.98);
        border-radius: 20px;
        padding: 25px;
        margin-bottom: 25px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
    }

    .search-box {
        position: relative;
    }

    .search-box input {
        padding-left: 45px;
    }

    .search-box i {
        position: absolute;
        left: 16px;
        top: 50%;
        transform: translateY(-50%);
        color: #999;
        font-size: 18px;
    }

    .filter-label {
        font-weight: 600;
        color: #1a1a2e;
        font-size: 13px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 8px;
    }

    .table-card {
        background: rgba(255, 255, 255, 0.98);
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
    }

    .table-header {
        background: linear-gradient(135deg, #0f3460, #16213e);
        color: white;
        padding: 20px 25px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .table-header h5 {
        margin: 0;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .table-wrapper {
        padding: 25px;
    }

    .table {
        margin: 0;
    }

    .table thead th {
        background: linear-gradient(135deg, #0f3460, #16213e);
        color: white;
        border: none;
        padding: 16px 12px;
        font-weight: 600;
        text-transform: uppercase;
        font-size: 12px;
        letter-spacing: 0.5px;
        white-space: nowrap;
    }

    .table tbody td {
        padding: 14px 12px;
        vertical-align: middle;
        border-color: rgba(0, 0, 0, 0.05);
    }

    .table tbody tr {
        transition: all 0.3s ease;
    }

    .table tbody tr:hover {
        background: rgba(15, 52, 96, 0.05);
        transform: scale(1.005);
    }

    .nim-badge {
        background: linear-gradient(135deg, #0f3460, #16213e);
        color: white;
        padding: 6px 12px;
        border-radius: 8px;
        font-weight: 600;
        font-size: 13px;
        display: inline-block;
    }

    .nama-cell {
        font-weight: 600;
        color: #1a1a2e;
        font-size: 15px;
    }

    .gender-badge {
        padding: 5px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
        display: inline-block;
    }

    .gender-male {
        background: rgba(15, 52, 96, 0.1);
        color: #0f3460;
    }

    .gender-female {
        background: rgba(233, 69, 96, 0.1);
        color: #e94560;
    }

    .action-buttons {
        display: flex;
        gap: 6px;
    }

    .btn-action {
        padding: 8px 12px;
        border-radius: 8px;
        font-size: 13px;
        font-weight: 600;
        border: none;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }

    .btn-edit {
        background: linear-gradient(135deg, #ffc107, #ff9800);
        color: #1a1a2e;
        box-shadow: 0 4px 12px rgba(255, 193, 7, 0.3);
    }

    .btn-edit:hover {
        background: linear-gradient(135deg, #ff9800, #ffc107);
        transform: translateY(-2px);
        box-shadow: 0 6px 16px rgba(255, 193, 7, 0.4);
        color: #1a1a2e;
    }

    .btn-delete {
        background: linear-gradient(135deg, #dc3545, #e94560);
        color: white;
        box-shadow: 0 4px 12px rgba(220, 53, 69, 0.3);
    }

    .btn-delete:hover {
        background: linear-gradient(135deg, #e94560, #dc3545);
        transform: translateY(-2px);
        box-shadow: 0 6px 16px rgba(220, 53, 69, 0.4);
        color: white;
    }

    .empty-state {
        text-align: center;
        padding: 60px 20px;
        color: #999;
    }

    .empty-state i {
        font-size: 80px;
        margin-bottom: 20px;
        opacity: 0.3;
    }

    .empty-state h4 {
        color: #666;
        margin-bottom: 10px;
    }

    .empty-state p {
        color: #999;
        font-size: 14px;
    }
</style>

<!-- Page Header -->
<div class="page-header">
    <h3>
        <i class="fas fa-users"></i>
        Crew Registry
        <span class="badge-count">
            <i class="fas fa-anchor me-1"></i>
            <?= count($data) ?> Members
        </span>
    </h3>
    <a href="index.php?page=mahasiswa&action=tambah" class="btn btn-success">
        <i class="fas fa-user-plus me-2"></i>Rekrut Member Baru
    </a>
</div>

<!-- Alert Messages -->
<?php include __DIR__ . '/../layouts/alert.php'; ?>

<?php if (isset($_GET['pesan'])): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="fas fa-check-circle me-2"></i>
        <strong>Success!</strong>
        <?php
        $messages = [
            'sukses_tambah' => 'New crew member has been recruited successfully!',
            'sukses_edit' => 'Crew member information has been updated!',
            'sukses_hapus' => 'Crew member has been removed from the registry.'
        ];
        echo $messages[$_GET['pesan']] ?? htmlspecialchars($_GET['pesan']);
        ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
<?php endif; ?>

<!-- Search and Filter Section -->
<div class="search-filter-section">
    <div class="row g-3">
        <div class="col-md-5">
            <label class="filter-label">
                <i class="fas fa-search me-1"></i>Cari Crew
            </label>
            <div class="search-box">
                <i class="fas fa-search"></i>
                <input type="text" class="form-control" id="searchInput" 
                       placeholder="Search by NIM, name, or location...">
            </div>
        </div>
        <div class="col-md-3">
            <label class="filter-label">
                <i class="fas fa-filter me-1"></i>Filter Jenis Kelamin
            </label>
            <select class="form-select" id="filterGender">
                <option value="">Jenis Kelamin</option>
                <option value="Laki-laki">Male</option>
                <option value="Perempuan">Female</option>
            </select>
        </div>
        <div class="col-md-2">
            <label class="filter-label">
                <i class="fas fa-sort me-1"></i>Sort
            </label>
            <select class="form-select" id="sortBy">
                <option value="nama">Name</option>
                <option value="nim">NIM</option>
                <option value="tanggal_lahir">Birth Date</option>
            </select>
        </div>
        <div class="col-md-2">
            <label class="filter-label">&nbsp;</label>
            <button class="btn btn-outline-secondary w-100" onclick="resetFilters()">
                <i class="fas fa-redo me-1"></i>Reset
            </button>
        </div>
    </div>
</div>

<!-- Data Table -->
<div class="table-card">
    <div class="table-header">
        <h5>
            <i class="fas fa-list me-2"></i>
            Ship's Crew
        </h5>
        <span class="badge bg-light text-dark">
            <i class="fas fa-database me-1"></i>
            <span id="filteredCount"><?= count($data) ?></span> of <?= count($data) ?> records
        </span>
    </div>
    
    <div class="table-wrapper">
        <?php if (empty($data)): ?>
            <div class="empty-state">
                <i class="fas fa-ship"></i>
                <h4>No Crew Members Found</h4>
                <p>The ship's registry is empty. Start recruiting crew members!</p>
                <a href="index.php?page=mahasiswa&action=tambah" class="btn btn-primary mt-3">
                    <i class="fas fa-user-plus me-2"></i>Add First Member
                </a>
            </div>
        <?php else: ?>
            <div class="table-responsive">
                <table class="table table-hover align-middle" id="crewTable">
                    <thead>
                        <tr>
                            <th style="width: 50px;">#</th>
                            <th>NIM</th>
                            <th>Name</th>
                            <th>Birth Place & Date</th>
                            <th>Gender</th>
                            <th>Phone</th>
                            <th>Address</th>
                            <th style="width: 150px;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $no = 1;
                        foreach ($data as $m): 
                        ?>
                        <tr data-nim="<?= htmlspecialchars($m['nim']) ?>" 
                            data-nama="<?= htmlspecialchars($m['nama']) ?>" 
                            data-gender="<?= htmlspecialchars($m['jenis_kelamin']) ?>">
                            <td class="text-center"><?= $no++ ?></td>
                            <td>
                                <span class="nim-badge">
                                    <i class="fas fa-id-card me-1"></i>
                                    <?= htmlspecialchars($m['nim']) ?>
                                </span>
                            </td>
                            <td class="nama-cell">
                                <i class="fas fa-user me-2 text-muted"></i>
                                <?= htmlspecialchars($m['nama']) ?>
                            </td>
                            <td>
                                <i class="fas fa-map-marker-alt me-2 text-muted"></i>
                                <?= htmlspecialchars($m['tempat_lahir']) ?>, 
                                <?= date('d M Y', strtotime($m['tanggal_lahir'])) ?>
                            </td>
                            <td>
                                <span class="gender-badge <?= $m['jenis_kelamin'] === 'Laki-laki' ? 'gender-male' : 'gender-female' ?>">
                                    <i class="fas fa-<?= $m['jenis_kelamin'] === 'Laki-laki' ? 'mars' : 'venus' ?> me-1"></i>
                                    <?= htmlspecialchars($m['jenis_kelamin']) ?>
                                </span>
                            </td>
                            <td>
                                <i class="fas fa-phone me-2 text-muted"></i>
                                <?= htmlspecialchars($m['telepon']) ?>
                            </td>
                            <td>
                                <i class="fas fa-home me-2 text-muted"></i>
                                <?= htmlspecialchars($m['alamat']) ?>
                            </td>
                            <td>
                                <div class="action-buttons">
                                    <a href="index.php?page=mahasiswa&action=edit&id=<?= $m['nim'] ?>" 
                                       class="btn-action btn-edit" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="index.php?page=mahasiswa&action=hapus&id=<?= $m['nim'] ?>" 
                                       class="btn-action btn-delete" 
                                       onclick="return confirm('🏴‍☠️ Are you sure you want to remove this crew member from the ship?\n\nThis action cannot be undone!')"
                                       title="Delete">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>
</div>

<script>
    // Search and Filter Functionality
    const searchInput = document.getElementById('searchInput');
    const filterGender = document.getElementById('filterGender');
    const sortBy = document.getElementById('sortBy');
    const tableRows = document.querySelectorAll('#crewTable tbody tr');
    const filteredCount = document.getElementById('filteredCount');
    const totalCount = tableRows.length;

    function filterTable() {
        const searchTerm = searchInput.value.toLowerCase();
        const selectedGender = filterGender.value;
        let visibleCount = 0;

        tableRows.forEach(row => {
            const nim = row.dataset.nim.toLowerCase();
            const nama = row.dataset.nama.toLowerCase();
            const gender = row.dataset.gender;
            const rowText = row.textContent.toLowerCase();

            const matchesSearch = !searchTerm || nim.includes(searchTerm) || nama.includes(searchTerm) || rowText.includes(searchTerm);
            const matchesGender = !selectedGender || gender === selectedGender;

            if (matchesSearch && matchesGender) {
                row.style.display = '';
                visibleCount++;
            } else {
                row.style.display = 'none';
            }
        });

        filteredCount.textContent = visibleCount;
    }

    function sortTable() {
        const sortField = sortBy.value;
        const tbody = document.querySelector('#crewTable tbody');
        const rows = Array.from(tableRows);

        rows.sort((a, b) => {
            let aVal, bVal;
            
            if (sortField === 'nim') {
                aVal = a.dataset.nim;
                bVal = b.dataset.nim;
            } else if (sortField === 'nama') {
                aVal = a.dataset.nama;
                bVal = b.dataset.nama;
            } else if (sortField === 'tanggal_lahir') {
                aVal = a.cells[3].textContent;
                bVal = b.cells[3].textContent;
            }

            return aVal.localeCompare(bVal);
        });

        rows.forEach((row, index) => {
            row.cells[0].textContent = index + 1;
            tbody.appendChild(row);
        });
    }

    function resetFilters() {
        searchInput.value = '';
        filterGender.value = '';
        sortBy.value = 'nama';
        filterTable();
    }

    searchInput.addEventListener('input', filterTable);
    filterGender.addEventListener('change', filterTable);
    sortBy.addEventListener('change', sortTable);
</script>

<?php include __DIR__ . '/../layouts/footer.php'; ?>