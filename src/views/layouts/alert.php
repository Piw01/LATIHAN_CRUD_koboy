<?php
// Enhanced alert component with pirate theme
if (isset($_SESSION['message']) && isset($_SESSION['type'])):
    $alertType = $_SESSION['type'] == 'success' ? 'success' : 'danger';
    $icon = $_SESSION['type'] == 'success' ? 'fa-check-circle' : 'fa-exclamation-triangle';
    $title = $_SESSION['type'] == 'success' ? 'Success!' : 'Warning!';
    
    // Pirate-themed gradients
    if ($_SESSION['type'] == 'success') {
        $gradient = 'linear-gradient(135deg, #28a745 0%, #20c997 100%)';
        $iconBg = '#28a745';
    } else {
        $gradient = 'linear-gradient(135deg, #e94560 0%, #dc3545 100%)';
        $iconBg = '#e94560';
    }
?>

<style>
    @keyframes slideInDown {
        from {
            opacity: 0;
            transform: translateY(-30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes pulse {
        0%, 100% {
            transform: scale(1);
        }
        50% {
            transform: scale(1.05);
        }
    }

    .pirate-alert {
        background: white;
        border: none;
        border-radius: 20px;
        padding: 25px;
        margin-bottom: 25px;
        box-shadow: 
            0 10px 40px rgba(0, 0, 0, 0.15),
            0 0 0 1px rgba(0, 0, 0, 0.05);
        animation: slideInDown 0.5s ease, pulse 0.5s ease 0.2s;
        position: relative;
        overflow: hidden;
    }

    .pirate-alert::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 5px;
        background: <?= $gradient ?>;
    }

    .pirate-alert::after {
        content: '⚓';
        position: absolute;
        right: 20px;
        top: 50%;
        transform: translateY(-50%);
        font-size: 60px;
        opacity: 0.05;
    }

    .alert-content {
        display: flex;
        align-items: center;
        gap: 20px;
        position: relative;
        z-index: 1;
    }

    .alert-icon {
        width: 50px;
        height: 50px;
        background: <?= $gradient ?>;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 24px;
        flex-shrink: 0;
        box-shadow: 0 4px 15px rgba(<?= $alertType == 'success' ? '40, 167, 69' : '233, 69, 96' ?>, 0.3);
    }

    .alert-text {
        flex: 1;
    }

    .alert-title {
        font-weight: 700;
        font-size: 18px;
        color: #1a1a2e;
        margin-bottom: 5px;
    }

    .alert-message {
        color: #666;
        font-size: 15px;
        margin: 0;
        line-height: 1.5;
    }

    .alert-close {
        background: none;
        border: none;
        width: 35px;
        height: 35px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.3s ease;
        color: #999;
        font-size: 20px;
        flex-shrink: 0;
    }

    .alert-close:hover {
        background: rgba(0, 0, 0, 0.05);
        color: #666;
        transform: rotate(90deg);
    }

    .alert-progress {
        position: absolute;
        bottom: 0;
        left: 0;
        height: 3px;
        background: <?= $gradient ?>;
        width: 100%;
        animation: shrink 5s linear forwards;
    }

    @keyframes shrink {
        from {
            width: 100%;
        }
        to {
            width: 0%;
        }
    }
</style>

<div class="pirate-alert alert-<?= $alertType ?>" role="alert" id="pirateAlert">
    <div class="alert-content">
        <div class="alert-icon">
            <i class="fas <?= $icon ?>"></i>
        </div>
        <div class="alert-text">
            <div class="alert-title"><?= $title ?></div>
            <p class="alert-message"><?= htmlspecialchars($_SESSION['message']) ?></p>
        </div>
        <button type="button" class="alert-close" onclick="closeAlert()">
            <i class="fas fa-times"></i>
        </button>
    </div>
    <div class="alert-progress"></div>
</div>

<script>
    function closeAlert() {
        const alert = document.getElementById('pirateAlert');
        alert.style.animation = 'slideInDown 0.3s ease reverse';
        setTimeout(() => {
            alert.remove();
        }, 300);
    }

    // Auto close after 5 seconds
    setTimeout(closeAlert, 5000);
</script>

<?php
    // Clear session message
    unset($_SESSION['message']);
    unset($_SESSION['type']);
endif;
?>