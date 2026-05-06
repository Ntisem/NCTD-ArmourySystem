<style>
    #toast-container {
        position: fixed;
        top: 20px;
        right: 20px;
        z-index: 9999;
    }
    .tactical-toast {
        min-width: 300px;
        background: #0d1117;
        color: #fff;
        border-left: 5px solid #00f2ff;
        padding: 15px 20px;
        margin-bottom: 10px;
        border-radius: 4px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.5);
        font-family: 'JetBrains Mono', monospace;
        text-transform: uppercase;
        font-size: 13px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        animation: slideIn 0.4s ease forwards;
    }
    .toast-success { border-left-color: #00ff88; }
    .toast-error { border-left-color: #ff3e3e; }
    
    @keyframes slideIn {
        from { transform: translateX(100%); opacity: 0; }
        to { transform: translateX(0); opacity: 1; }
    }
    .toast-fade-out {
        animation: fadeOut 0.5s ease forwards;
    }
    @keyframes fadeOut {
        to { opacity: 0; transform: translateY(-20px); }
    }
</style>

<div id="toast-container"></div>

<script>
function showToast(message, type = 'success') {
    const container = document.getElementById('toast-container');
    const toast = document.createElement('div');
    toast.className = `tactical-toast toast-${type}`;
    toast.innerHTML = `<span>[ ${type.toUpperCase()} ]: ${message}</span>`;
    
    container.appendChild(toast);

    setTimeout(() => {
        toast.classList.add('toast-fade-out');
        setTimeout(() => toast.remove(), 500);
    }, 4000);
}

// Trigger from PHP Session
<?php if(isset($_SESSION['status'])): ?>
    showToast("<?php echo $_SESSION['status']; ?>", "<?php echo $_SESSION['status_code']; ?>");
    <?php unset($_SESSION['status'], $_SESSION['status_code']); ?>
<?php endif; ?>
</script>