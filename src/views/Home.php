<?php require_once __DIR__ . '/layouts/header.php'; ?>

<style>
    .hero-card {
        background: linear-gradient(135deg, rgba(15, 52, 96, 0.95), rgba(22, 33, 62, 0.95));
        color: white;
        border-radius: 25px;
        padding: 50px 40px;
        margin-bottom: 30px;
        box-shadow: 
            0 20px 60px rgba(0, 0, 0, 0.3),
            inset 0 0 50px rgba(255, 255, 255, 0.05);
        position: relative;
        overflow: hidden;
    }

    .hero-card::before {
        content: '🏴‍☠️';
        position: absolute;
        right: -30px;
        top: 50%;
        transform: translateY(-50%);
        font-size: 200px;
        opacity: 0.1;
        animation: float 6s ease-in-out infinite;
    }

    .hero-card h1 {
        font-size: 48px;
        font-weight: 700;
        margin-bottom: 15px;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
    }

    .hero-card p {
        font-size: 20px;
        margin-bottom: 25px;
        opacity: 0.9;
    }

    .hero-card .btn {
        padding: 15px 40px;
        font-size: 18px;
        font-weight: 600;
        border-radius: 12px;
        text-transform: uppercase;
        letter-spacing: 1px;
        box-shadow: 0 8px 25px rgba(233, 69, 96, 0.4);
        background: linear-gradient(135deg, #e94560, #dc3545);
        border: none;
        transition: all 0.3s ease;
    }

    .hero-card .btn:hover {
        background: linear-gradient(135deg, #dc3545, #e94560);
        transform: translateY(-3px);
        box-shadow: 0 12px 35px rgba(233, 69, 96, 0.5);
    }

    .feature-cards {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 25px;
        margin-bottom: 30px;
    }

    .feature-card {
        background: rgba(255, 255, 255, 0.98);
        border-radius: 20px;
        padding: 30px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
        transition: all 0.3s ease;
        border: 2px solid transparent;
        position: relative;
        overflow: hidden;
    }

    .feature-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 5px;
        background: linear-gradient(90deg, #0f3460, #e94560);
    }

    .feature-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.2);
        border-color: rgba(15, 52, 96, 0.2);
    }

    .feature-icon {
        width: 70px;
        height: 70px;
        background: linear-gradient(135deg, #0f3460, #16213e);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 32px;
        color: white;
        margin-bottom: 20px;
        box-shadow: 0 8px 20px rgba(15, 52, 96, 0.3);
    }

    .feature-card h3 {
        font-size: 22px;
        font-weight: 700;
        color: #1a1a2e;
        margin-bottom: 12px;
    }

    .feature-card p {
        color: #666;
        font-size: 15px;
        line-height: 1.6;
        margin: 0;
    }

    .stats-section {
        background: rgba(255, 255, 255, 0.98);
        border-radius: 20px;
        padding: 40px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
        margin-bottom: 30px;
    }

    .stats-section h2 {
        font-size: 28px;
        font-weight: 700;
        color: #1a1a2e;
        margin-bottom: 30px;
        text-align: center;
    }

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 20px;
    }

    .stat-box {
        background: linear-gradient(135deg, #0f3460, #16213e);
        color: white;
        padding: 25px;
        border-radius: 15px;
        text-align: center;
        box-shadow: 0 8px 20px rgba(15, 52, 96, 0.3);
        transition: all 0.3s ease;
    }

    .stat-box:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 30px rgba(15, 52, 96, 0.4);
    }

    .stat-number {
        font-size: 42px;
        font-weight: 700;
        margin-bottom: 8px;
        color: #e94560;
    }

    .stat-label {
        font-size: 14px;
        text-transform: uppercase;
        letter-spacing: 1px;
        opacity: 0.9;
    }

    .welcome-badge {
        display: inline-block;
        background: rgba(233, 69, 96, 0.2);
        color: #e94560;
        padding: 8px 20px;
        border-radius: 25px;
        font-weight: 600;
        font-size: 14px;
        margin-bottom: 20px;
        text-transform: uppercase;
        letter-spacing: 1px;
    }
</style>

<!-- Hero Section -->
<div class="hero-card">
    <div class="welcome-badge">
        <i class="fas fa-anchor me-2"></i>Welcome Aboard, Captain!
    </div>
    <h1>⚓ Welcome to Pirate_Crud</h1>
    <p class="mb-4">
        <i class="fas fa-ship me-2"></i>
        Jelajahi sistem manajemen siswa dengan mudah. ​​Daftar kru Anda sudah menunggu!
    </p>
    <a class="btn btn-lg" href="?page=mahasiswa&action=ListMahasiswa">
        <i class="fas fa-users me-2"></i>Daftar Crew
    </a>
</div>


<!-- Stats Section -->
<div class="stats-section">
    <h2>
        <i class="fas fa-compass me-2"></i>
        Ship's 
    </h2>
    <div class="stats-grid">

        <div class="stat-box">
            <div class="stat-number">
                <i class="fas fa-clock"></i>
                <span id="currentTime"></span>
            </div>
            <div class="stat-label">Waktu Sekarang</div>
        </div>
    </div>
</div>

<script>
    // Update current time
    function updateTime() {
        const now = new Date();
        const hours = String(now.getHours()).padStart(2, '0');
        const minutes = String(now.getMinutes()).padStart(2, '0');
        document.getElementById('currentTime').textContent = hours + ':' + minutes;
    }
    
    updateTime();
    setInterval(updateTime, 1000);

    // Simulate crew count (you can fetch from API)
    document.getElementById('totalCrew').textContent = Math.floor(Math.random() * 50) + 10;
</script>

<?php require_once __DIR__ . '/layouts/footer.php'; ?>