<?php include __DIR__ . '/../layouts/header.php'; ?>

<style>
    .form-card {
        max-width: 900px;
        margin: 0 auto;
        background: rgba(255, 255, 255, 0.98);
        border-radius: 25px;
        overflow: hidden;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.2);
    }

    .form-header {
        background: linear-gradient(135deg, #ffc107, #ff9800);
        color: #1a1a2e;
        padding: 30px;
        text-align: center;
        position: relative;
        overflow: hidden;
    }

    .form-header::before {
        content: '⚙️';
        position: absolute;
        right: -20px;
        top: 50%;
        transform: translateY(-50%);
        font-size: 120px;
        opacity: 0.1;
    }

    .form-header h2 {
        font-size: 32px;
        font-weight: 700;
        margin: 0;
        position: relative;
        z-index: 1;
    }

    .form-header p {
        margin: 10px 0 0 0;
        opacity: 0.9;
        font-size: 15px;
        position: relative;
        z-index: 1;
    }

    .form-body {
        padding: 40px;
    }

    .section-title {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 25px;
        padding-bottom: 15px;
        border-bottom: 2px solid #e0e0e0;
    }

    .section-title i {
        width: 40px;
        height: 40px;
        background: linear-gradient(135deg, #ffc107, #ff9800);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #1a1a2e;
        font-size: 18px;
    }

    .section-title h5 {
        margin: 0;
        color: #1a1a2e;
        font-weight: 700;
        font-size: 18px;
    }

    .form-label {
        font-weight: 600;
        color: #1a1a2e;
        margin-bottom: 10px;
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 14px;
    }

    .form-label i {
        color: #ff9800;
        font-size: 16px;
    }

    .form-label .required {
        color: #e94560;
        font-weight: 700;
    }

    .form-control, .form-select {
        border: 2px solid #e0e0e0;
        border-radius: 12px;
        padding: 14px 16px;
        font-size: 15px;
        transition: all 0.3s ease;
        background: #f8f9fa;
    }

    .form-control:focus, .form-select:focus {
        border-color: #ffc107;
        box-shadow: 0 0 0 4px rgba(255, 193, 7, 0.1);
        background: white;
        transform: translateY(-2px);
    }

    .form-control:disabled {
        background: #e9ecef;
        cursor: not-allowed;
    }

    .input-icon {
        position: relative;
    }

    .input-icon input,
    .input-icon select,
    .input-icon textarea {
        padding-left: 45px;
    }

    .input-icon i {
        position: absolute;
        left: 16px;
        top: 50%;
        transform: translateY(-50%);
        color: #999;
        font-size: 18px;
    }

    .input-icon textarea ~ i {
        top: 18px;
        transform: none;
    }

    .form-actions {
        display: flex;
        gap: 15px;
        margin-top: 35px;
        padding-top: 30px;
        border-top: 2px solid #e0e0e0;
    }

    .btn-submit {
        flex: 1;
        padding: 16px;
        background: linear-gradient(135deg, #ffc107, #ff9800);
        color: #1a1a2e;
        border: none;
        border-radius: 12px;
        font-size: 16px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1px;
        cursor: pointer;
        transition: all 0.3s ease;
        box-shadow: 0 6px 20px rgba(255, 193, 7, 0.3);
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
    }

    .btn-submit:hover {
        background: linear-gradient(135deg, #ff9800, #ffc107);
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(255, 193, 7, 0.4);
    }

    .btn-cancel {
        flex: 1;
        padding: 16px;
        background: white;
        color: #666;
        border: 2px solid #e0e0e0;
        border-radius: 12px;
        font-size: 16px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1px;
        cursor: pointer;
        transition: all 0.3s ease;
        text-decoration: none;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
    }

    .btn-cancel:hover {
        background: #f8f9fa;
        border-color: #ffc107;
        color: #ff9800;
        transform: translateY(-3px);
    }

    .helper-text {
        font-size: 12px;
        color: #999;
        margin-top: 6px;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .nim-locked-badge {
        background: linear-gradient(135deg, #6c757d, #495057);
        color: white;
        padding: 8px 16px;
        border-radius: 8px;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        font-weight: 600;
        font-size: 13px;
        margin-top: 8px;
    }
</style>

<div class="form-card">
    <div class="form-header">
        <h2>
            <i class="fas fa-user-edit me-3"></i>
            Update Crew Member
        </h2>
        <p>
            <i class="fas fa-wrench me-2"></i>
            Modify the crew member's information in the ship's registry
        </p>
    </div>

    <div class="form-body">
        <form action="index.php?page=mahasiswa&action=update" method="post" id="crewForm">
            
            <!-- Identity Section -->
            <div class="section-title">
                <i class="fas fa-id-card"></i>
                <h5>Identity Information</h5>
            </div>

            <div class="row g-4 mb-4">
                <div class="col-md-4">
                    <label class="form-label">
                        <i class="fas fa-hashtag"></i>
                        NIM <span class="required">*</span>
                    </label>
                    <div class="input-icon">
                        <i class="fas fa-lock"></i>
                        <input type="text" name="nim" class="form-control" 
                               value="<?= htmlspecialchars($data['nim'] ?? '') ?>" 
                               readonly required>
                    </div>
                    <div class="nim-locked-badge">
                        <i class="fas fa-lock"></i>
                        <span>NIM cannot be changed</span>
                    </div>
                </div>

                <div class="col-md-8">
                    <label class="form-label">
                        <i class="fas fa-user"></i>
                        Full Name <span class="required">*</span>
                    </label>
                    <div class="input-icon">
                        <i class="fas fa-signature"></i>
                        <input type="text" name="nama" class="form-control" 
                               value="<?= htmlspecialchars($data['nama'] ?? '') ?>"
                               placeholder="Enter full name" required>
                    </div>
                </div>
            </div>

            <!-- Birth Information Section -->
            <div class="section-title">
                <i class="fas fa-birthday-cake"></i>
                <h5>Birth Information</h5>
            </div>

            <div class="row g-4 mb-4">
                <div class="col-md-6">
                    <label class="form-label">
                        <i class="fas fa-map-marker-alt"></i>
                        Birth Place <span class="required">*</span>
                    </label>
                    <div class="input-icon">
                        <i class="fas fa-city"></i>
                        <input type="text" name="tempat_lahir" class="form-control" 
                               value="<?= htmlspecialchars($data['tempat_lahir'] ?? '') ?>"
                               placeholder="e.g., Jakarta" required>
                    </div>
                </div>

                <div class="col-md-6">
                    <label class="form-label">
                        <i class="fas fa-calendar-alt"></i>
                        Birth Date <span class="required">*</span>
                    </label>
                    <div class="input-icon">
                        <i class="fas fa-calendar-day"></i>
                        <input type="date" name="tanggal_lahir" class="form-control" 
                               value="<?= htmlspecialchars($data['tanggal_lahir'] ?? '') ?>"
                               required max="<?= date('Y-m-d') ?>">
                    </div>
                </div>
            </div>

            <!-- Personal Information Section -->
            <div class="section-title">
                <i class="fas fa-user-circle"></i>
                <h5>Personal Information</h5>
            </div>

            <div class="row g-4 mb-4">
                <div class="col-md-6">
                    <label class="form-label">
                        <i class="fas fa-venus-mars"></i>
                        Gender <span class="required">*</span>
                    </label>
                    <div class="input-icon">
                        <i class="fas fa-genderless"></i>
                        <select name="jenis_kelamin" class="form-select" required>
                            <option value="">-- Select Gender --</option>
                            <option value="Laki-laki" <?= (($data['jenis_kelamin'] ?? '') === 'Laki-laki') ? 'selected' : '' ?>>
                                Male
                            </option>
                            <option value="Perempuan" <?= (($data['jenis_kelamin'] ?? '') === 'Perempuan') ? 'selected' : '' ?>>
                                Female
                            </option>
                        </select>
                    </div>
                </div>

                <div class="col-md-6">
                    <label class="form-label">
                        <i class="fas fa-phone"></i>
                        Phone Number <span class="required">*</span>
                    </label>
                    <div class="input-icon">
                        <i class="fas fa-mobile-alt"></i>
                        <input type="tel" name="telepon" class="form-control" 
                               value="<?= htmlspecialchars($data['telepon'] ?? '') ?>"
                               placeholder="e.g., 081234567890" required 
                               pattern="[0-9]{10,13}">
                    </div>
                </div>
            </div>

            <!-- Address Section -->
            <div class="section-title">
                <i class="fas fa-home"></i>
                <h5>Address Information</h5>
            </div>

            <div class="mb-4">
                <label class="form-label">
                    <i class="fas fa-map-marked-alt"></i>
                    Complete Address <span class="required">*</span>
                </label>
                <div class="input-icon">
                    <i class="fas fa-home"></i>
                    <textarea name="alamat" class="form-control" rows="4" 
                              placeholder="Enter complete address" 
                              required><?= htmlspecialchars($data['alamat'] ?? '') ?></textarea>
                </div>
            </div>

            <!-- Form Actions -->
            <div class="form-actions">
                <a href="index.php?page=mahasiswa&action=ListMahasiswa" class="btn-cancel">
                    <i class="fas fa-times"></i>
                    Cancel
                </a>
                <button type="submit" class="btn-submit" id="submitBtn">
                    <i class="fas fa-save"></i>
                    Update Information
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    const form = document.getElementById('crewForm');
    const submitBtn = document.getElementById('submitBtn');

    form.addEventListener('submit', function() {
        submitBtn.classList.add('loading');
        submitBtn.disabled = true;
    });

    // Phone validation (only numbers)
    const phoneInput = form.querySelector('input[name="telepon"]');
    phoneInput.addEventListener('input', function() {
        this.value = this.value.replace(/[^0-9]/g, '');
    });
</script>

<?php include __DIR__ . '/../layouts/footer.php'; ?>