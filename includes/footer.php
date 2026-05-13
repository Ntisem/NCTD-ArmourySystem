<style>
    .tactical-alert {
    background-color: #05070a !important;
    border: 1px solid var(--neon-cyan) !important;
}
.swal-title { color: var(--neon-cyan) !important; font-family: 'Orbitron'; }
.swal-text { color: #8a8d93 !important; font-family: 'Roboto Mono'; }
</style>
<footer class="footer" style="background: #0a0c10; border-top: 2px solid #f9a602; padding: 20px 0;">
    <div class="container-fluid">
        <div class="d-sm-flex justify-content-center justify-content-sm-between">
            <span class="text-muted text-center text-sm-left d-block d-sm-inline-block" style="color: #fff !important;">
                <span style="color: #f9a602;">[SECURE_SYSTEM: <span style="color: #28a745;">ACTIVE</span>]</span> GPS | NATIONAL COUNTER TERRORISM DEPT.
            </span>
            <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center" style="color: #6c7293;font-size: 0.8rem;">
                DEV: <span>C/INSPR W. NTISEM</span> | &copy; <?php echo date("Y"); ?>
            </span>
        </div>
    </div>
</footer>

<a href="#" class="back-to-top" style="position: fixed; bottom: 30px; right: 30px; z-index: 999; background: #f9a602; color: #000; padding: 10px 15px; border-radius: 2px; box-shadow: 0 0 10px rgba(249, 166, 2, 0.5);">
    <i class="mdi mdi-arrow-up-bold"></i>
</a>

<script>
<?php if(isset($_SESSION['status'])): ?>
    swal({
        title: "<?php echo $_SESSION['status'];?>",
        icon: "<?php echo $_SESSION['status_code'];?>",
        button: "ACKNOWLEDGE",
        className: "tactical-alert" // Apply custom CSS for dark theme
    });
<?php unset($_SESSION['status']); endif; ?>
</script>

<style>
.tactical-alert {
    background-color: #12151e !important;
    border: 2px solid #f9a602 !important;
}
.swal-title, .swal-text {
    color: #fff !important;
}
.swal-button {
    background-color: #f9a602 !important;
    color: #000 !important;
    border-radius: 0 !important;
}
</style>



<script src="assets/js/sweetalert.min.js"></script>
<script src="assets/js/clock.js"></script>

<?php if(isset($_SESSION['status']) && $_SESSION['status'] !=''): ?>
<script>
    swal({
        title: "<?php echo $_SESSION['status'];?>",
        icon: "<?php echo $_SESSION['status_code'];?>",
        button: "OK",
    });
</script>
<?php unset($_SESSION['status']); endif; ?>

<script>
    setInterval(function(){ check_user(); }, 2000);
    function check_user(){
        jQuery.ajax({
            url:'includes/user_auth.php', // Ensure path is correct
            type:'post',
            data:'type=ajax',
            success:function(result){
                if(result=='logout'){ window.location.href='logout'; }
            }
        });
    }
</script>