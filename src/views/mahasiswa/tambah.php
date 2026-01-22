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
        background: linear-gradient(135deg, #0f3460, #16213e);
        color: white;
        padding: 30px;
        text-align: center;
        position: relative;
        overflow: hidden;
    }

    .form-header::before {
        content: '⚓';
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
        background: linear-gradient(135deg, #0f3460, #16213e);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
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
        color: #0f3460;
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
        border-color: #0f3460;
        box-shadow: 0 0 0 4px rgba(15, 52, 96, 0.1);
        background: white;
        transform: translateY(-2px);
    }

    .form-control:hover, .form-select:hover {
        border-color: #c0c0c0;
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
        background: linear-gradient(135deg, #28a745, #20c997);
        color: white;
        border: none;
        border-radius: 12px;
        font-size: 16px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1px;
        cursor: pointer;
        transition: all 0.3s ease;
        box-shadow: 0 6px 20px rgba(40, 167, 69, 0.3);
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
    }

    .btn-submit:hover {
        background: linear-gradient(135deg, #20c997, #28a745);
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(40, 167, 69, 0.4);
    }

    .btn-submit:active {
        transform: translateY(0);
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
        border-color: #0f3460;
        color: #0f3460;
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

    .helper-text i {
        font-size: 14px;
    }

    /* Loading state */
    .btn-submit.loading {
        position: relative;
        color: transparent;
        pointer-events: none;
    }

    .btn-submit.loading::after {
        content: "";
        position: absolute;
        width: 20px;
        height: 20px;
        top: 50%;
        left: 50%;
        margin-left: -10px;
        margin-top: -10px;
        border: 3px solid rgba(255,255,255,0.3);
        border-top-color: white;
        border-radius: 50%;
        animation: spin 0.8s linear infinite;
    }

    @keyframes spin {
        to { transform: rotate(360deg); }
    }

    /* Validation styles */
    .form-control.is-invalid,
    .form-select.is-invalid {
        border-color: #e94560;
    }

    .invalid-feedback {
        color: #e94560;
        font-size: 13px;
        margin-top: 6px;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .invalid-feedback i {
        font-size: 14px;
    }
</style>

<div class="form-card">
    <div class="form-header">
        <h2>
            <i class="fas fa-user-plus me-3"></i>
            Recruit New Crew Member
        </h2>
        <p>
            <i class="fas fa-anchor me-2"></i>
            Fill in the details to add a new member to the ship's registry
        </p>
    </div>

    <div class="form-body">
        <form action="index.php?page=mahasiswa&action=simpan" method="post" id="crewForm">
            
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
                        <i class="fas fa-id-badge"></i>
                        <input type="text" name="nim" class="form-control" 
                               placeholder="e.g., 2101010001" required 
                               pattern="[0-9]{10}" maxlength="10">
                    </div>
                    <div class="helper-text">
                        <i class="fas fa-info-circle"></i>
                        10-digit student ID number
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
                               placeholder="Enter full name" required>
                    </div>
                    <div class="helper-text">
                        <i class="fas fa-info-circle"></i>
                        Complete name as per official documents
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
                            <option value="Laki-laki">
                                <i class="fas fa-mars"></i> Male
                            </option>
                            <option value="Perempuan">
                                <i class="fas fa-venus"></i> Female
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
                               placeholder="e.g., 081234567890" required 
                               pattern="[0-9]{10,13}">
                    </div>
                    <div class="helper-text">
                        <i class="fas fa-info-circle"></i>
                        Active phone number (10-13 digits)
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
                              placeholder="Enter complete address including street, city, and postal code" 
                              required></textarea>
                </div>
                <div class="helper-text">
                    <i class="fas fa-info-circle"></i>
                    Include street name, number, city, and postal code
                </div>
            </div>

            <!-- Form Actions -->
            <div class="form-actions">
                <a href="index.php?page=mahasiswa&action=ListMahasiswa" class="btn-cancel">
                    <i class="fas fa-times"></i>
                    Cancel
                </a>
                <button type="submit" class="btn-submit" id="submitBtn">
                    <i class="fas fa-ship"></i>
                    Add to Crew
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    const form = document.getElementById('crewForm');
    const submitBtn = document.getElementById('submitBtn');

    // Form validation
    form.addEventListener('submit', function(e) {
        if (!form.checkValidity()) {
            e.preventDefault();
            e.stopPropagation();
        } else {
            // Add loading state
            submitBtn.classList.add('loading');
            submitBtn.disabled = true;
        }
        form.classList.add('was-validated');
    });

    // Real-time validation
    const inputs = form.querySelectorAll('input, select, textarea');
    inputs.forEach(input => {
        input.addEventListener('blur', function() {
            if (this.value) {
                if (this.checkValidity()) {
                    this.classList.remove('is-invalid');
                    this.classList.add('is-valid');
                } else {
                    this.classList.remove('is-valid');
                    this.classList.add('is-invalid');
                }
            }
        });
    });

    // NIM validation (only numbers)
    const nimInput = form.querySelector('input[name="nim"]');
    nimInput.addEventListener('input', function() {
        this.value = this.value.replace(/[^0-9]/g, '');
    });

    // Phone validation (only numbers)
    const phoneInput = form.querySelector('input[name="telepon"]');
    phoneInput.addEventListener('input', function() {
        this.value = this.value.replace(/[^0-9]/g, '');
    });
</script>

<?php include __DIR__ . '/../layouts/footer.php'; ?>