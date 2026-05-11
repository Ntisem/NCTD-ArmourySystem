<?php
require_once('connections/connect-db.php');
require_once('functions.php');
require_once('includes/user_auth.php');

if(!isset($_SESSION["username"]) || $_SESSION["user_role"] != 'administrator') {
    header("location: login");
    exit();
}

// Generate a random 6-digit security code for the hidden input
$security_code = str_pad(mt_rand(0, 999999), 6, '0', STR_PAD_LEFT);
$created_by = $_SESSION['username'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>COMMAND_TERMINAL | ADD_NEW_administrator</title>
    <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="shortcut icon" href="assets/images/favicon.png" />
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700&family=Roboto+Mono:wght@300;500&display=swap" rel="stylesheet">
    <style>
        :root { --neon: #00f2ff; --bg-deep: #05070a; --card-bg: #0d1117; --danger: #ff3e3e; --success: #00ff88; }
        body { background: var(--bg-deep); font-family: 'Roboto Mono', monospace; color: #c0c5ce; }
        .tactical-card { background: var(--card-bg) !important; border: 1px solid rgba(0, 242, 255, 0.2); border-radius: 0; box-shadow: 0 0 30px rgba(0,0,0,0.5); }
        .form-control { background: #000 !important; color: #fff !important; border: 1px solid #333 !important; border-radius: 0; font-size: 13px; height: 45px; }
        .form-control:focus { border-color: var(--neon) !important; box-shadow: 0 0 10px rgba(0, 242, 255, 0.2); }
        label { font-size: 10px; text-transform: uppercase; color: var(--neon); letter-spacing: 1px; font-weight: bold; }
        
        /* Password Checklist */
        .pass-requirement { font-size: 11px; margin-bottom: 2px; color: #555; transition: 0.3s; }
        .pass-requirement.met { color: var(--success); }
        .pass-requirement i { margin-right: 5px; }

        /* Toast UI */
        #toast-container { position: fixed; top: 20px; right: 20px; z-index: 10000; }
        .t-toast { background: rgba(0, 10, 20, 0.95); border: 1px solid var(--neon); color: #fff; padding: 15px 25px; margin-bottom: 10px; border-left: 5px solid var(--neon); font-family: 'Orbitron', sans-serif; font-size: 13px; letter-spacing: 1px; box-shadow: 0 0 20px rgba(0, 242, 255, 0.2); display: none; }
        .t-toast.error { border-color: var(--danger); border-left-color: var(--danger); }
        
        .availability-badge { font-size: 9px; margin-top: 4px; display: block; font-weight: bold; }
        .input-group-text { background: #1a1f26; border: 1px solid #333; color: var(--neon); border-radius: 0; cursor: pointer; }
        
        #img_preview { width: 120px; height: 120px; border: 2px solid var(--neon); object-fit: cover; display: none; background: #000; }
        .btn-comm { background: transparent; border: 1px solid var(--neon); color: var(--neon); font-family: 'Orbitron'; font-size: 14px; transition: 0.4s; border-radius: 0; }
        .btn-comm:hover:not(:disabled) { background: var(--neon); color: #000; box-shadow: 0 0 15px var(--neon); }
    </style>
        <style>
        #toast-container { 
            position: fixed; 
            top: 30px; 
            right: 30px; 
            z-index: 10001; 
        }
        .t-toast { 
            background: rgba(5, 7, 10, 0.95); 
            border: 1px solid #00f2ff; 
            color: #ffffff; 
            padding: 18px 30px; 
            margin-bottom: 12px; 
            border-left: 6px solid #00f2ff; 
            font-family: 'Roboto Mono', monospace; 
            font-size: 13px; 
            letter-spacing: 1px; 
            box-shadow: 0 0 25px rgba(0, 242, 255, 0.15); 
            display: none;
            min-width: 320px;
        }
        .t-toast.error { 
            border-color: #ff3e3e; 
            border-left-color: #ff3e3e; 
            box-shadow: 0 0 25px rgba(255, 62, 62, 0.15);
        }
    </style>
</head>
<body>
    <div id="toast-container"></div>
    <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="content-wrapper d-flex align-items-center">
            <div class="row flex-grow justify-content-center">
                <div class="col-lg-10"> 
                   <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0 text-white" style="font-family:'Orbitron';"></h5>
                        <a href="administrators" class="btn btn-outline-secondary btn-sm" style="border-radius:0;"><i class="mdi mdi-arrow-left-bold"></i>BACK</a>
                    </div>
                    <div class="card tactical-card">
                        <div class="card-body p-5"> 
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <h3 style="font-family: 'Orbitron'; color: #fff; margin:0;">[ REGISTER_NEW_administrator ]</h3>
                                <small class="text-muted">OPS_ID: <?= $security_code ?></small>
                            </div>

                            <form action="process-administrator.php" method="POST" enctype="multipart/form-data" id="administratorForm">
                                <input type="hidden" name="action" value="add">
                                <input type="hidden" name="status" value="Verified">
                                <input type="hidden" name="code" value="<?= $security_code ?>">
                                <input type="hidden" name="created_by" value="<?= $created_by ?>">

                                <div class="row">
                                    <div class="col-md-3 text-center border-right border-secondary">
                                        <label>Profile Image</label>
                                        <div class="mb-3 d-flex justify-content-center">
                                            <img id="img_preview" src="#" alt="Preview">
                                            <div id="img_placeholder" style="width:120px; height:120px; border:1px dashed #444; display:flex; align-items:center; justify-content:center;">
                                                <i class="mdi mdi-account-outline" style="font-size:40px; color:#333;"></i>
                                            </div>
                                        </div>
                                        <input type="file" name="profile_image" id="profile_img" class="form-control mb-2" accept="image/*" required>
                                    </div>

                                    <div class="col-md-9">
                                        <div class="row">
                                            <div class="col-md-4 form-group">
                                                <label>Service Number</label>
                                                <input type="text" name="service_no" id="service_no" class="form-control" placeholder="eg: 12345" required>
                                                <span id="service-status" class="availability-badge"></span>
                                            </div>
                                            <div class="col-md-4 form-group">
                                                <label>Rank</label>
                                                <select name="rank" class="form-control" required>
                                                    <option value="CONST">Constable</option>
                                                    <option value="L/CPL">Lance Corporal</option>
                                                    <option value="CPL">Corporal</option>
                                                    <option value="SGT">Sergeant</option>
                                                    <option value="INSPR">Inspector</option>
                                                    <option value="C/INSPR">Chief Inspector</option>
                                                    <option value="ASP">ASP</option>
                                                    <option value="DSP">DSP</option>
                                                    <option value="SUPT">SUPT</option>
                                                    <option value="C/SUPT">C/SUPT</option>
                                                    <option value="ACP">ACP</option>
                                                    <option value="DCOP">DCOP</option>
                                                    <option value="COP">COP</option>
                                                </select>
                                            </div>
                                            <div class="col-md-4 form-group">
                                                <label>Unit / Department</label>
                                                <input type="text" name="unit_dept" class="form-control" value="NCTD" readonly>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6 form-group">
                                                <label>Full Name</label>
                                                <input type="text" name="fullname" class="form-control" placeholder="eg: William Ntisem" required>
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label>System Username</label>
                                                <input type="text" name="username" id="username" class="form-control" placeholder="william_ntisem" required>
                                                <span id="username-status" class="availability-badge"></span>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6 form-group">
                                                <label>Contact Email</label>
                                                <input type="email" name="admin_email" id="admin_email" class="form-control" placeholder="eg: william.ntisem@example.com" required>
                                                <span id="email-status" class="availability-badge"></span>
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label>Phone Number</label>
                                                <input type="text" name="phone_number" id="phone_number" class="form-control" placeholder="eg:0200123456" required>
                                                <span id="phone-status" class="availability-badge"></span>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6 form-group">
                                                <label>Uplink Password</label>
                                                <div class="input-group">
                                                    <input type="password" name="password" id="password" class="form-control" placeholder="eg: SecurePass123!" required>
                                                    <div class="input-group-append">
                                                        <span class="input-group-text toggle-pass"><i class="mdi mdi-eye"></i></span>
                                                    </div>
                                                </div>
                                                <div class="mt-2 p-2 bg-darker" style="background:#000;">
                                                    <div id="req-len" class="pass-requirement"><i class="mdi mdi-circle-outline"></i> 8+ Characters</div>
                                                    <div id="req-alpha" class="pass-requirement"><i class="mdi mdi-circle-outline"></i> Alphabet</div>
                                                    <div id="req-num" class="pass-requirement"><i class="mdi mdi-circle-outline"></i> Number</div>
                                                    <div id="req-spec" class="pass-requirement"><i class="mdi mdi-circle-outline"></i> Special (@#$!)</div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label>Confirm Password</label>
                                                <input type="password" id="confirm_password" class="form-control" placeholder="eg: SecurePass123!" required>
                                                <span id="match-status" class="availability-badge"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="mt-4 text-right">
                                    <button type="button" class="btn btn-secondary mr-2" style="border-radius:0;" onclick="window.history.back()">ABORT_COMMAND</button>
                                    <button type="submit" id="submitBtn" class="btn btn-comm px-5 py-3">EXECUTE_REGISTRATION</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
 <?php require_once('includes/footer.php'); ?>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <div id="toast-container"></div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        /**
         * TACTICAL TOAST ENGINE
         * Displays system signals with high-readability monospaced fonts
         */
        function showToast(msg, type = 'success') {
            const toastId = 'toast-' + Math.floor(Math.random() * 1000);
            let toastHtml = `
                <div id="${toastId}" class="t-toast ${type === 'error' ? 'error' : ''}">
                    <div class="d-flex align-items-center">
                        <i class="mdi ${type === 'success' ? 'mdi-check-decagram' : 'mdi-alert-decagram'} mr-2" style="font-size:18px;"></i>
                        <span>[SIGNAL]: ${msg}</span>
                    </div>
                </div>`;
            
            $('#toast-container').append(toastHtml);
            $(`#${toastId}`).fadeIn(400).delay(5000).fadeOut(600, function(){ $(this).remove(); });
        }

        // JS Logic to catch PHP Session Status
        <?php if(isset($_SESSION['status'])): ?>
            $(document).ready(function() {
                showToast("<?php echo $_SESSION['status']; ?>", "<?php echo $_SESSION['status_code']; ?>");
            });
            <?php 
                // Clear the status after displaying so it doesn't repeat on refresh
                unset($_SESSION['status']); 
                unset($_SESSION['status_code']); 
            ?>
        <?php endif; ?>
    </script>

    <script>
        // function showToast(msg, type = 'success') {
        //     let toast = $(`<div class="t-toast ${type === 'error' ? 'error' : ''}">[SIGNAL]: ${msg}</div>`);
        //     $('#toast-container').append(toast);
        //     toast.fadeIn(400).delay(5000).fadeOut(400, function(){ $(this).remove(); });
        // }

        // 1. Availability Validator (AJAX)
        function checkUniqueness(field, value, badgeID) {
            if(value.length < 3) return;
            $.post('check-uniqueness.php', { field: field, value: value }, function(data) {
                let res = JSON.parse(data);
                if(res.exists) {
                    $(`#${badgeID}`).html('<span class="text-danger">✖ UNAVAILABLE</span>');
                    $('#submitBtn').prop('disabled', true).css('opacity', '0.5');
                } else {
                    $(`#${badgeID}`).html('<span class="text-success">✔ CLEAR</span>');
                    $('#submitBtn').prop('disabled', false).css('opacity', '1');
                }
            });
        }

        $('#service_no').on('blur', function() { checkUniqueness('service_no', $(this).val(), 'service-status'); });
        $('#username').on('blur', function() { checkUniqueness('username', $(this).val(), 'username-status'); });
        $('#admin_email').on('blur', function() { checkUniqueness('admin_email', $(this).val(), 'email-status'); });
        $('#phone_number').on('blur', function() { checkUniqueness('phone_number', $(this).val(), 'phone-status'); });

        // 2. Profile Image Preview
        $('#profile_img').on('change', function(e) {
            const reader = new FileReader();
            reader.onload = function(event) {
                $('#img_preview').attr('src', event.target.result).show();
                $('#img_placeholder').hide();
            }
            reader.readAsDataURL(e.target.files[0]);
        });

        // 3. Password Visibility Toggle
        $('.toggle-pass').on('click', function() {
            let passInput = $('#password');
            let type = passInput.attr('type') === 'password' ? 'text' : 'password';
            passInput.attr('type', type);
            $(this).find('i').toggleClass('mdi-eye mdi-eye-off');
        });

        // 4. Password Security Logic
        $('#password').on('keyup', function() {
            let val = $(this).val();
            let hasAlpha = /[a-zA-Z]/.test(val);
            let hasNum = /\d/.test(val);
            let hasSpec = /[^a-zA-Z0-9]/.test(val);
            let isLong = val.length >= 8;

            $('#req-len').toggleClass('met', isLong).find('i').toggleClass('mdi-circle-outline', !isLong).toggleClass('mdi-check-circle', isLong);
            $('#req-alpha').toggleClass('met', hasAlpha).find('i').toggleClass('mdi-circle-outline', !hasAlpha).toggleClass('mdi-check-circle', hasAlpha);
            $('#req-num').toggleClass('met', hasNum).find('i').toggleClass('mdi-circle-outline', !hasNum).toggleClass('mdi-check-circle', hasNum);
            $('#req-spec').toggleClass('met', hasSpec).find('i').toggleClass('mdi-circle-outline', !hasSpec).toggleClass('mdi-check-circle', hasSpec);
        });

        // 5. Match Check
        $('#confirm_password, #password').on('keyup', function() {
            if($('#password').val() === $('#confirm_password').val() && $('#password').val() != "") {
                $('#match-status').html('<span class="text-success">✔ CIPHER_MATCH</span>');
            } else {
                $('#match-status').html('<span class="text-danger">✖ MISMATCH</span>');
            }
        });

        // 6. Form Submission Validation
        $('#administratorForm').on('submit', function(e) {
            let val = $('#password').val();
            let regex = /^(?=.*[a-zA-Z])(?=.*\d)(?=.*[^a-zA-Z0-9]).{8,}$/;
            if(!regex.test(val)) {
                e.preventDefault();
                showToast("STRENGTH_REQUIREMENTS_NOT_MET", "error");
            }
            if(val !== $('#confirm_password').val()){
                e.preventDefault();
                showToast("PASSWORD_SYNC_FAILED", "error");
            }
        });
    </script>
</body>
</html>