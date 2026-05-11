<?php require("user_auth.php");?>
<link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700&family=Roboto+Mono:wght@300;500&display=swap" rel="stylesheet">

<style>
/* --- TACTICAL CORE VARIABLES --- */
:root {
    --cmd-bg: #05070a;
    --cmd-panel: rgba(13, 17, 23, 0.95);
    --neon-cyan: #00f2ff;
    --neon-amber: #f9a602;
    --neon-red: #ff3e3e;
    --tactical-border: 1px solid rgba(0, 242, 255, 0.3);
}

body {
    background-color: var(--cmd-bg) !important;
    background-image: 
        linear-gradient(rgba(18, 16, 16, 0) 50%, rgba(0, 0, 0, 0.1) 50%),
        linear-gradient(90deg, rgba(255, 0, 0, 0.03), rgba(0, 255, 0, 0.01), rgba(0, 0, 255, 0.03));
    background-size: 100% 4px, 3px 100%;
    font-family: 'Roboto Mono', monospace;
    color: #c0c5ce;
}

/* --- HUD NAVIGATION --- */
.navbar {
    background: rgba(5, 7, 10, 0.98) !important;
    border-bottom: 2px solid var(--neon-cyan);
    box-shadow: 0 0 20px rgba(0, 242, 255, 0.15);
    backdrop-filter: blur(10px);
    height: 70px;
}

.navbar-brand-wrapper {
    background: #000 !important;
    border-right: 1px solid var(--neon-cyan);
}

/* --- TACTICAL BUTTONS --- */
.create-new-button {
    background: transparent !important;
    border: 1px solid var(--neon-cyan) !important;
    color: var(--neon-cyan) !important;
    text-transform: uppercase;
    letter-spacing: 2px;
    font-family: 'Roboto Mono', sans-serif;
    font-size: 0.7rem;
    transition: 0.3s;
    padding: 5px 15px;
}

.create-new-button:hover {
    background: var(--neon-cyan) !important;
    color: #000 !important;
    box-shadow: 0 0 15px var(--neon-cyan);
}

/* --- STREAMLINED CHRONOMETER SECTION --- */
.nav-status-group {
    border-left: 1px solid rgba(0, 242, 255, 0.2);
    padding: 0 20px;
    margin-left: 10px;
    display: flex;
    flex-direction: column;
    justify-content: center;
}

#clock {
    font-family: 'Orbitron', sans-serif;
    color: var(--neon-cyan);
    font-size: 1.1rem !important;
    font-weight: 700;
    margin: 0;
    line-height: 1;
    text-shadow: 0 0 10px rgba(0, 242, 255, 0.5);
    letter-spacing: 1px;
}

#date {
    color: var(--neon-amber);
    font-size: 9px !important;
    text-transform: uppercase;
    letter-spacing: 2px;
    margin: 2px 0 0 0;
    line-height: 1;
    font-family: 'Roboto Mono', monospace;
    opacity: 0.8;
}

/* --- DROPDOWN TACTICAL OVERRIDE --- */
.dropdown-menu {
    background: var(--cmd-panel) !important;
    border: 1px solid var(--neon-cyan) !important;
    border-radius: 0 !important;
    margin-top: 5px;
}

/* Custom display class for manual toggling */
.dropdown-menu.show {
    display: block !important;
    z-index: 10000 !important;
}

.dropdown-item {
    color: #fff !important;
    transition: background 0.2s ease-in-out, color 0.2s ease-in-out;
    padding: 0.5rem 1rem;
    border-bottom: 1px solid rgba(255,255,255,0.05);
}

.dropdown-item:hover {
    background-color: rgba(0, 242, 255, 0.15) !important;
    color: var(--neon-cyan) !important;
}

.dropdown-item.logout-item:hover {
    background-color: rgba(255, 62, 62, 0.15) !important;
    color: var(--neon-red) !important;
}

/* --- USER PROFILE TACTICAL --- */
.navbar-profile {
    border: 1px solid rgba(255,255,255,0.1);
    padding: 5px 12px;
    background: rgba(255,255,255,0.03);
    display: flex;
    align-items: center;
}

.navbar-profile-name {
    font-family: 'Roboto Mono', sans-serif;
    color: var(--neon-cyan);
    font-size: 0.8rem;
}
</style>

<nav class="navbar p-0 fixed-top d-flex flex-row">
    <div class="navbar-brand-wrapper d-flex d-lg-none align-items-center justify-content-center">
        <a class="navbar-brand brand-logo-mini" href="armourer">
            <img src="assets/images/gps_logo_armory_mini.png" alt="logo" style="height:35px; filter: drop-shadow(0 0 5px var(--neon-cyan));" />
        </a>
    </div>

    <div class="navbar-menu-wrapper flex-grow d-flex align-items-stretch">
        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
            <span class="mdi mdi-menu" style="color: var(--neon-cyan);"></span>
        </button>

        <ul class="navbar-nav w-100">
            <li class="nav-item w-100">
                <a href="search" class="ml-3"> 
                    <button class="btn btn-outline-danger btn-sm" style="border-radius: 0; font-size: 0.7rem; letter-spacing: 1px;">
                        <i class="mdi mdi-magnify"></i> INTEL SEARCH
                    </button>
                </a>
            </li>
        </ul>

        <ul class="navbar-nav navbar-nav-right">
            <li class="nav-item dropdown d-none d-lg-block">
                <a class="nav-link btn create-new-button" id="createbuttonDropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                    [ + ] Add New Asset              
                </a>
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="createbuttonDropdown">
                    <h6 class="p-3 mb-0" style="color: var(--neon-amber); letter-spacing: 2px; font-size: 0.7rem;">LOGISTICS COMMAND</h6>
                    <div class="dropdown-divider"></div>
                    <a href="add-new-weapon" class="dropdown-item preview-item">
                        <div class="preview-item-content">
                            <p class="preview-subject mb-1">Add Firearm/Ammo</p>
                        </div>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="add-faulty-weapon" class="dropdown-item preview-item">
                        <div class="preview-item-content">
                            <p class="preview-subject mb-1">Add Faulty Firearm/Ammo</p>
                        </div>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="booking" class="dropdown-item preview-item">
                        <div class="preview-item-content">
                            <p class="preview-subject mb-1">Booking</p>
                        </div>
                    </a>
                </div>
            </li>

            <!-- <li class="nav-item nav-status-group d-none d-sm-flex">
                <div class="d-flex flex-column align-items-end">
                    <p id="clock">12:45:08</p>
                    <p id="date">20 APR 2026</p>
                </div>
            </li> -->

            <li class="nav-item dropdown ml-3">
                <a class="nav-link" id="profileDropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                    <?php  
                        $username = $_SESSION['username'] ?? 'OPERATOR';
                        $profile_image = $_SESSION['profile_image'] ?? 'default.png';
                        echo '
                        <div class="navbar-profile">
                            <img class="img-xs rounded-circle border border-info" src="assets/images/armourer_images/'.$profile_image.'" alt="" style="width:30px; height:30px;">
                            <p class="mb-0 d-none d-sm-block navbar-profile-name ml-2">'.strtoupper($username).'</p>
                            <i class="mdi mdi-menu-down d-none d-sm-block text-cyan ml-1"></i>
                        </div>';
                    ?>
                </a>
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="profileDropdown">
                    <h6 class="p-3 mb-0" style="color: var(--neon-cyan); font-size: 0.7rem;">ADMIN SETTINGS</h6>
                    <div class="dropdown-divider"></div>
                    <a href="armourer-profile.php" class="dropdown-item preview-item" style=" background-color: rgba(255,255,255,0.05);">
                        <i class="mdi mdi-account-card-details text-info mr-2"></i> Profile  
                    </a>
                    
                    <div class="dropdown-divider"></div>
                    <a href="logout" class="dropdown-item preview-item logout-item" style=" background-color: rgba(255,255,255,0.05);">
                        <i class="mdi mdi-logout text-danger mr-2"></i> LOGOUT  
                    </a>
                </div>
            </li>
        </ul>
    </div>
</nav>

<script>
// Manually handle interaction overrides for drops
document.addEventListener('DOMContentLoaded', function () {
    const dropdownToggles = document.querySelectorAll('#createbuttonDropdown, #profileDropdown');
    const dropdownMenus = document.querySelectorAll('.dropdown-menu');

    dropdownToggles.forEach(toggle => {
        toggle.addEventListener('click', function (e) {
            e.preventDefault();
            e.stopPropagation();

            // Find the associated dropdown menu
            const menu = this.nextElementSibling;
            
            // Close all other menus
            dropdownMenus.forEach(m => {
                if (m !== menu) {
                    m.classList.remove('show');
                }
            });

            // Toggle active state
            menu.classList.toggle('show');
        });
    });

    // Close on document clicks
    document.addEventListener('click', function (e) {
        if (!e.target.closest('.nav-item.dropdown')) {
            dropdownMenus.forEach(menu => {
                menu.classList.remove('show');
            });
        }
    });
});
</script>