<?php
require_once('includes/user_auth.php');
?>
<!DOCTYPE html>
<html>
<head>
    <title>NCTD // INITIALIZING MASTER ARMOURY AUDIT</title>
    <link rel="shortcut icon" href="assets/images/favicon.png" />
    <script>
        window.onload = function() {
            // Automatically trigger the PDF in a new tab
            window.open('audit_engine.php?type=master', '_blank');
            // Return user to dashboard after 1 second
            setTimeout(function() {
                window.location.href = 'armourer.php';
            }, 1000);
        };
    </script>
</head>
<body style="background: #05070a; color: #00f2ff; font-family: 'Courier New'; text-align: center; padding-top: 50px;">
    <h2>[ ACCESSING_SECURE_DATABASE... ]</h2>
    <p>Generating Audit Master Report. Please allow pop-ups.</p>
</body>
</html>