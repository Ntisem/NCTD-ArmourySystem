<?php 
require_once("user_auth.php");

// Retrieve current count of faulty weapons
try {
    $stmtFaultyCount = $pdo->query("SELECT COUNT(*) FROM `faulty_weapons` WHERE `faulty_nature` != 'Serviceable'");
    $faultyCount = $stmtFaultyCount->fetchColumn();
} catch (PDOException $e) {
    $faultyCount = 0;
}
?>

<link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700&family=Roboto+Mono:wght@400;700&display=swap" rel="stylesheet">

<style>
/* --- TACTICAL SIDEBAR VARIABLES --- */
:root {
    --side-bg: #030508;
    --neon-cyan: #00f2ff;
    --neon-amber: #f9a602;
    --neon-red: #ff3e3e;
    --glass-blue: rgba(0, 242, 255, 0.05);
}

/* --- BASE SIDEBAR STYLING --- */
#sidebar {
    background: var(--side-bg) !important;
    border-right: 1px solid rgba(0, 242, 255, 0.2);
    box-shadow: 5px 0 15px rgba(0, 0, 0, 0.5);
}

.sidebar-brand-wrapper {
    background: #000 !important;
    border-bottom: 2px solid var(--neon-cyan);
    height: 100px !important;
    overflow: hidden;
    position: relative;
}

.sidebar-brand-wrapper::after {
    content: "";
    position: absolute;
    top: 0; left: 0; width: 100%; height: 2px;
    background: rgba(0, 242, 255, 0.5);
    box-shadow: 0 0 10px var(--neon-cyan);
    animation: scanLine 4s linear infinite;
    z-index: 10;
}

@keyframes scanLine {
    0% { top: 0; }
    100% { top: 100%; }
}

.sidebar .nav .nav-item .nav-link {
    font-family: 'Roboto Mono', monospace;
    color: #8a8d93 !important;
    text-transform: uppercase;
    font-size: 0.8rem;
    letter-spacing: 1px;
    padding: 12px 25px;
    transition: all 0.3s ease;
    border-left: 3px solid transparent;
}

.sidebar .nav .nav-item:hover > .nav-link,
.sidebar .nav .nav-item.active > .nav-link {
    background: linear-gradient(90deg, rgba(0, 242, 255, 0.1) 0%, transparent 100%) !important;
    color: #fff !important;
    border-left: 3px solid var(--neon-cyan);
    text-shadow: 0 0 8px rgba(0, 242, 255, 0.7);
}

.profile-desc {
    border-bottom: 1px solid rgba(0, 242, 255, 0.1);
    padding: 20px 0;
}

.profile-name h5 {
    font-family: 'Orbitron', sans-serif !important;
    color: var(--neon-cyan);
    font-size: 0.9rem !important;
    letter-spacing: 1.5px;
}

.profile-name span {
    color: var(--neon-amber);
    font-family: 'Roboto Mono', monospace;
    font-size: 0.65rem;
    text-transform: uppercase;
    opacity: 0.8;
}

.count-indicator img {
    border: 2px solid var(--neon-cyan);
    padding: 2px;
}

.nav-category .nav-link {
    color: var(--neon-amber) !important;
    font-size: 0.6rem !important;
    font-weight: 700;
    opacity: 0.6;
    margin-top: 15px;
}

.sidebar .nav {
    overflow: hidden;
    flex-wrap: nowrap;
    flex-direction: column;
    margin-bottom: 60px;
    padding-top: 10px;
}
</style>

<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <div class="sidebar-brand-wrapper d-none d-lg-flex align-items-center justify-content-center fixed-top">
        <a class="sidebar-brand brand-logo" href="administrator">
            <img src="assets/images/gps_logo_armory.png" alt="Tactical Command Logo" style="width: 180px; height: auto; filter: drop-shadow(0 0 5px rgba(0, 242, 255, 0.3));" />
        </a>
        <a class="sidebar-brand brand-logo-mini" href="administrator">
            <img src="assets/images/gps_logo_armory_mini.png" alt="logo" style="width: 50px; height: auto;" />
        </a>
    </div>
    
    <ul class="nav">
        <li class="nav-item profile">
            <div class="profile-desc">
                <div class="profile-pic">
                    <?php  
                        $session_user = $_SESSION['username']; 
                        $stmt = $pdo->prepare("SELECT * FROM `admin_lists` WHERE `username` = ?");
                        $stmt->execute([$session_user]);
                        
                        while ($row = $stmt->fetch()) {
                            $img = !empty($row['profile_image']) ? $row['profile_image'] : 'default.png';
                            $disp_username = $row['username'];
                            $profile_image = $row['profile_image'];
                            $_SESSION['profile_image'] = $profile_image;
                            $user_role = $row['user_role'];
                            ?>
                            <div class="count-indicator">
                                <img class="img-xs rounded-circle" src="assets/images/administrator_images/<?= $img ?>" alt="">
                                <span class="count bg-success"></span>
                            </div>
                            <div class="profile-name">
                                <h5 class="mb-0 font-weight-normal"><?= strtoupper($disp_username) ?></h5> 
                                <span> [ <?= $user_role ?> ]</span>
                            </div>
                            <?php
                        }
                    ?>
                </div>
            </div>
        </li>

        <li class="nav-item nav-category">
            <span class="nav-link">Dashboard</span>
        </li>

        <li class="nav-item menu-items">
            <a class="nav-link" href="administrator">
                <span class="menu-icon"><i class="mdi mdi-view-dashboard"></i></span>
                <span class="menu-title">Command Center</span>
            </a>
        </li>
        
        <li class="nav-item menu-items">
            <a class="nav-link" data-bs-toggle="collapse" href="#categories" aria-expanded="false" aria-controls="categories">
                <span class="menu-icon"><i class="mdi mdi-pen"></i></span>
                <span class="menu-title">CATEGORIES</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="categories">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="add-firearm-name">Add Firearm Name</a></li>
                    <li class="nav-item"> <a class="nav-link" href="add-firearm-categories">Add Type/Caliber</a></li>
                </ul>
            </div>
        </li>

        <li class="nav-item menu-items">
            <a class="nav-link" data-bs-toggle="collapse" href="#weapon" aria-expanded="false" aria-controls="weapon">
                <span class="menu-icon"><i class="mdi mdi-pistol"></i></span>
                <span class="menu-title">Armory Intel</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="weapon">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="firearm-names">Firearms Stock</a></li>
                    <li class="nav-item"> <a class="nav-link" href="ammunition">Munitions Stock</a></li>
                    <li class="nav-item"> <a class="nav-link" href="add-new-weapon">Add Firearm</a></li>
                </ul>
            </div>
        </li>

        <li class="nav-item menu-items">
            <a class="nav-link" data-bs-toggle="collapse" href="#booking" aria-expanded="false" aria-controls="booking">
                <span class="menu-icon"><i class="mdi mdi-shield-check-outline"></i></span>
                <span class="menu-title">Deployments</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="booking">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="booking">Issue Firearm</a></li>
                    <li class="nav-item"> <a class="nav-link" href="booking-ammo">Issue Ammo</a></li>
                    <li class="nav-item"> <a class="nav-link" href="booked-firearms?firearm-name=AK47">Firearm Log</a></li>
                    <li class="nav-item"> <a class="nav-link" href="booked-ammo">Ammo Log</a></li>
                    <li class="nav-item">
                        <span id="overdue-counter" class="badge badge-pill badge-danger ml-auto" style="display:none; box-shadow: 0 0 10px #ff3e3e;">
                            0
                        </span>
                    </li>
                </ul>
            </div>
        </li>

        <li class="nav-item menu-items">
            <a class="nav-link" data-bs-toggle="collapse" href="#returns" aria-expanded="false" aria-controls="returns">
                <span class="menu-icon"><i class="mdi mdi-history"></i></span>
                <span class="menu-title">Deployed</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="returns">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="not-returns-firearms">Deployed Firearm </a></li>
                    <li class="nav-item"> <a class="nav-link" href="not-returns-ammo">Deployed Ammo</a></li>
                </ul>
            </div>
        </li>

        <li class="nav-item menu-items">
            <a class="nav-link" data-bs-toggle="collapse" href="#officer" aria-expanded="false" aria-controls="officer">
                <span class="menu-icon"><i class="mdi mdi-account-group-outline"></i></span>
                <span class="menu-title">Officers</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="officer">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="officers-list?Rank=CONST">Officers-List</a></li>
                    <li class="nav-item"> <a class="nav-link" href="add-officer">Add Personnel</a></li>
                </ul>
            </div>
        </li>
    <li class="nav-item menu-items">
            <a class="nav-link" data-bs-toggle="collapse" href="#administrators" aria-expanded="false" aria-controls="administrators">
                <span class="menu-icon"><i class="mdi mdi-account-group-outline"></i></span>
                <span class="menu-title">Administrators</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="administrators">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="administrators">Administrators</a></li>
                    <li class="nav-item"> <a class="nav-link" href="add-new-administrator">Add Administrators</a></li>
                </ul>
            </div>
        </li>
     
        <li class="nav-item menu-items">
            <a class="nav-link" data-bs-toggle="collapse" href="#faulty" aria-expanded="false" aria-controls="faulty">
                <span class="menu-icon"><i class="mdi mdi-alert-decagram-outline text-danger"></i></span>
                <span class="menu-title" style="color: var(--neon-red);">Damaged Firearms</span>
                <?php if ($faultyCount > 0): ?>
                    <span class="badge badge-pill badge-danger ml-auto tactical-pulse" style="font-size: 10px; padding: 4px 6px;">
                        <?= $faultyCount ?>
                    </span>
                <?php endif; ?>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="faulty">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="add-faulty-weapon">Report Damage</a></li>
                    <li class="nav-item"> <a class="nav-link" href="faulty-weapon">Maintenance List</a></li>
                </ul>
            </div>
        </li>

        <li class="nav-item nav-category">
            <span class="nav-link">REPORTS_CENTER</span>
        </li>
        <li class="nav-item menu-items">
            <a class="nav-link" data-bs-toggle="collapse" href="#audit-reports" aria-expanded="false" aria-controls="audit-reports">
                <span class="menu-icon"><i class="mdi mdi-file-document-box-outline"></i></span>
                <span class="menu-title">Generate Audits</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="audit-reports">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" target="_blank" href="audit_engine.php?type=master">Full Master Audit</a></li>
                    <li class="nav-item"> <a class="nav-link" target="_blank" href="report-unified.php">Unified Report</a></li>
                </ul>
            </div>
        </li>

        <li class="nav-item nav-category">
            <span class="nav-link">SYSTEM_ADMIN</span>
        </li>
        <li class="nav-item menu-items">
            <a class="nav-link" href="export-db.php">
                <span class="menu-icon">
                    <i class="mdi mdi-database-export text-warning"></i>
                </span>
                <span class="menu-title">DOWNLOAD_BACKUP</span>
            </a>
        </li>
    </ul>
</nav>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const toggles = document.querySelectorAll('[data-bs-toggle="collapse"]');
        
        toggles.forEach(toggle => {
            toggle.addEventListener('click', function(e) {
                e.preventDefault();
                
                const targetSelector = this.getAttribute('href') || this.getAttribute('data-bs-target');
                const targetElement = document.querySelector(targetSelector);
                
                if (targetElement) {
                    // Initialize or use basic Bootstrap-like toggle method
                    const isVisible = targetElement.classList.contains('show');
                    
                    // Close all other open sibling drop downs if they exist (optional, for accordion effect)
                    const openCollapses = document.querySelectorAll('.collapse.show');
                    openCollapses.forEach(open => {
                        if (open !== targetElement && !targetElement.contains(open)) {
                            open.classList.remove('show');
                            const relatedToggle = document.querySelector(`[data-bs-toggle="collapse"][href="#${open.id}"], [data-bs-toggle="collapse"][data-bs-target="#${open.id}"]`);
                            if (relatedToggle) relatedToggle.setAttribute('aria-expanded', 'false');
                        }
                    });

                    targetElement.classList.toggle('show');
                    this.setAttribute('aria-expanded', isVisible ? 'false' : 'true');
                }
            });
        });
    });
</script>