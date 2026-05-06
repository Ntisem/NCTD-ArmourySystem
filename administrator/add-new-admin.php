
<?php  require_once('connections/connect-db.php');
      require_once('functions.php');
      require_once('includes/user_auth.php');

    // session_start();
    if(!isset($_SESSION["username"])) {
        header("location: login");
        exit();
    }
?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>GPS ARMOURY SYSTEM - ADD NEW ADMINISTRATORS</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="assets/vendors/select2/select2.min.css">
    <link rel="stylesheet" href="assets/vendors/select2-bootstrap-theme/select2-bootstrap.min.css">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="assets/css/style.css">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="assets/images/favicon.png" />
    <style>
      code {
    padding: 5px;
    color: #fff;
    font-weight: 300;
    font-size: 0.875rem;
    border-radius: 4px;
    font-family: var(--bs-font-monospace);
}
      .message{
          position: absolute;
          bottom: -30px;
          color: #fff;
          font-size: 15px;
          display: none;
      }
      ::placeholder{
          font-size: 15px;
      }
      .form-group .labs{
        width: 100%;
        display: flex;
        border-width:0px 0px 2px 0px;
        align-items: center;
        /* border-bottom-style: solid; */
        /* background:transparent; */
        }
      .form-group {
        width: 100%;
        display: flex;
        border-width:0px 0px 2px 0px;
        align-items: center;
        background:transparent;
        }
        .form-group input{
          width: 100%;
            font-size:16px;
            border:none;
            outline:none;
           
            color:#adc4b2;
            /* background:transparent; */
        }
        .form-group .icon-img{
        margin-top:10px;
        width:20px;
        height: 20px;
        cursor:pointer;
        }

    </style>
  </head>
  <body onload=display_ct();>
    <div class="container-scroller">
    <!-- partial:includes/_sidebar.html -->
    <?php  require_once('includes/sidebar.php');?>
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        <!-- partial:includes/_navbar.html -->
        <?php  require_once('includes/navbar.php');?>
        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">
            <div class="page-header">
              <h3 class="page-title"> Add New Administrator </h3>
              <nav aria-label="breadcrumb">
               
              </nav>
            </div>
            <div class="row">
              <div class="col-12 grid-margin">
                <div class="card">
                  <div class="card-body">
                    <!-- <h4 class="card-title">Horizontal Two column</h4> -->
              
                      <!-- <p class="card-description"> Personal info </p> -->
                          <p class="card-description" style="color:orange">Personal Info</p>
                          <form method="POST" action="functions.php" class="forms-sample" enctype="multipart/form-data">
                          <?php  
                            $username=$_SESSION['username']; 
                            $query = mysqli_query($connect_db,"SELECT * FROM `admin_lists` WHERE `username` ='$username'")
                            or die( mysqli_error($connect_db));
                            while ($row = mysqli_fetch_array($query)) {
                              $profile_image = $row['profile_image'];
                              $fullname = $row['fullname'];
                              $_SESSION['fullname'] =  $fullname;
                            
                              $user_status= $row['user_role'];
                              $_SESSION['user_status'] =  $user_status; 
                              $service_no = $row['service_no'];
                              $_SESSION['service_no']=$service_no;
                              $admin_rank =$row['rank'];
                              $_SESSION['rank']=$admin_rank;
                              $adminID_armourerID =$row['adminID'];
                              $_SESSION['adminID']=$adminID_armourerID;    
                              $_SESSION['adminID_armourerID']=$adminID_armourerID; 
                              $admin_armourer_user_role = $row['user_role'];
                              $_SESSION['user_role'] =  $admin_armourer_user_role;   
                              $_SESSION['admin_armourer_user_role'] =  $admin_armourer_user_role;                
                              $armourer_admin_name  =  $service_no.' '.$admin_rank.' '.$fullname;
                              $_SESSION['armourer_admin_name'] = $armourer_admin_name;  
                            }?>      
                              <input type="hidden" name="armourer_admin_name" class="form-control" id="exampleInputName1" value="<?php echo $service_no.' '.$admin_rank.' '.$fullname ?>">
                              <input type="hidden" name="adminID_armourerID" class="form-control" id="exampleInputName1" value="<?php echo  $_SESSION['adminID_armourerID']; ?>"> 
                              <input type="hidden" name="adminID" class="form-control" id="exampleInputName1" value="<?php echo $adminID; ?>">
                              <input type="hidden" name="admin_armourer_user_role" class="form-control" id="exampleInputName1" value="<?php echo $admin_armourer_user_role; ?>">
                          <div class="row">
                            <div class="col-md-4"> 
                            <div class="form-group">
                            <label class="labs" for="exampleInputEmail3"><code style="color:#fff"> Service No.</code> </label>
                            </div>                    
                            <div class="form-group">
                              <input type="text" name="service_no" class="form-control" id="exampleInputName1"
                               placeholder="Service Number" required>
                            </div>                        
                          </div>
                          <div class="col-md-4"> 
                          <div class="form-group">
                            <label class="labs" for="exampleInputEmail3"><code style="color:#fff"> Rank</code> </label>
                            </div>                    
                              <div class="form-group">                 
                                <div class="col-sm-9">
                                  <select class="form-control" name="rank" required>
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
                              </div>                        
                          </div>
                          <div class="col-md-4">
                          <div class="form-group">
                            <label class="labs" for="exampleInputEmail3"><code style="color:#fff"> Gender</code> </label>
                            </div>
                          <div class="form-group">
                           <select name="gender" class="form-control" id="exampleSelectGender" required>
                          <option value="Male">Male</option>
                          <option value="Female">Female</option>
                        </select>
                      </div>
                        </div>
                         </div> 
                            <div class="form-group">
                            <label class="labs" for="exampleInputEmail3"><code style="color:#fff"> User Role</code> </label>
                            </div>  
                            <div class="form-group">
                            <select name="user_role" class="form-control" id="exampleSelectGender" required>
                            <option value="None">None</option>
                            <option value="Administrator">Administrator</option>
                            <option value="Armourer">Armourer</option>
                           </select>
                            </div>
                          
                            <div class="form-group">
                            <label class="labs" for="exampleInputEmail3"><code style="color:#fff"> Surname</code> </label>
                            </div>
                            <div class="form-group">
                              <input type="text" name="last_name" class="form-control" id="exampleInputName1" placeholder="Surname" required>
                            </div>
                            <div class="form-group">
                            <label class="labs" for="exampleInputEmail3"><code style="color:#fff"> Other Names</code> </label>
                            </div>
                            <div class="form-group">
                              <input type="text" name="first_name" class="form-control" id="exampleInputName1" placeholder="Other names" required>
                            </div>
                            <div class="form-group">
                            <label class="labs" for="exampleInputEmail3"><code style="color:#fff"> Email Address</code> </label>
                            </div>
                            <div class="form-group">
                              <input type="email" class="form-control" name="admin_email" id="email" placeholder="Email">
                            </div>
                            <div class="form-group">
                            <label class="labs" for="exampleInputEmail3"><code style="color:#fff"> Phone Number</code> </label>
                            </div>
                            <div class="form-group">
                              <input type="text" class="form-control" name="phone_number" id="phone_number" pattern="^(\d{3}[-]?){1,2}(\d{4})$"  placeholder="eg: 020-800-7000" required>
                            </div>
                            <div class="form-group">
                            <label class="labs" for="exampleInputEmail3"><code style="color:#fff"> Username</code> </label>
                            </div>
                            <div class="form-group">
                              <input type="text" name="username" class="form-control" id="exampleInputName1" placeholder=" Username" required>
                            </div>
                            <div class="row">
                            <div class="col-md-6">
                            <div class="form-group">
                            <label class="labs" for="exampleInputEmail3"><code style="color:#fff"> Password</code> </label>
                            </div>
                            <div class="form-group">
                              <input type="password" name="password_1" class="form-control" id="password" placeholder="Password" required>
                              <img  class="icon-img" src="assets/images/password_images/eye-close.png" alt="" id="eye_icon">                            
                            </div>
                            <p id="message"> <span id="strength"></span></p>
                            </div>
                            <div class="col-md-6">
                            <div class="form-group">
                            <label class="labs" for="exampleInputEmail3"><code style="color:#fff"> Confirm Password</code> </label>
                            </div>
                            <div class="form-group">
                              <input type="password" name="password_2" class="form-control" id="password2" placeholder="Password">
                              <img  class="icon-img" src="assets/images/password_images/eye-close2.png" alt="" id="eye_icon2">
                            </div>
                            <p id="message2"> <span id="strength2"></span></p>
                            </div>
                            </div>
                            <div class="row">
                          
                            <div class="col-md-6">
                            <div class="form-group">
                            <label class="labs" for="exampleInputEmail3"><code style="color:#fff"> Unit/Department</code> </label>
                            </div>
                          <div class="form-group ">
                            <div class="col-sm-9">
                              <select class="form-control" name="unit_dept">
                                <option value="NVU">National Visibility Unit (NVU)</option>
                                <option value="CTD">Counter Terrorism Dept (CTD)</option>
                                <option value="SWAT">Special Weapon and Tactics (SWAT)</option>
                                <option value="FPU">Formed Police Unit (FPU)</option>
                              </select>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                        <div class="form-group">
                        <label class="labs" for="exampleInputEmail3"><code style="color:#fff">Upload Passport Image</code> </label>
                        </div>
                        <div class="form-group">
                        <input type="file" class="form-control" name="profile_image" id="profile_image" id="exampleFormControlFile1">
                        </div> 
                        </div>             
                         </div>
                          <button type="submit" name="add_admin" class="btn btn-inverse-success me-2">Submit</button>
                          <a href="administrators" class="btn btn-inverse-danger" >Cancel</a>
                         </form>
                  </div>
                </div>
              </div>
            </div>
         
          <!-- content-wrapper ends -->
            <!-- partial:partials/footer.php-->
            <?php  require_once('includes/footer.php');?>
          
          <!-- partial -->
        </div>
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="assets/js/script.js"></script>
    <script src="assets/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="assets/vendors/select2/select2.min.js"></script>
    <script src="assets/vendors/typeahead.js/typeahead.bundle.min.js"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="assets/js/off-canvas.js"></script>
    <script src="assets/js/hoverable-collapse.js"></script>
    <script src="assets/js/misc.js"></script>
    <script src="assets/js/settings.js"></script>
    <script src="assets/js/todolist.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <script src="assets/js/file-upload.js"></script>
    <script src="assets/js/typeahead.js"></script>
    <script src="assets/js/select2.js"></script>
    <!-- End custom js for this page -->
    <script>
    let eye_icon = document.getElementById("eye_icon");
    let password = document.getElementById("password");
    eye_icon.onclick = function(){
        if(password.type == "password"){
        password.type = "text";
        eye_icon.src = "assets/images/password_images/eye-open.png";
        }else{
        password.type = "password";
        eye_icon.src = "assets/images/password_images/eye-close.png";
        }
    }


    let eye_icon2 = document.getElementById("eye_icon2");
    let password2 = document.getElementById("password2");
    eye_icon2.onclick = function(){
        if(password2.type == "password"){
        password2.type = "text";
        eye_icon2.src = "assets/images/password_images/eye-open2.png";
        }else{
        password2.type = "password";
        eye_icon2.src = "assets/images/password_images/eye-close2.png";
        }
    }



    var pass_1 = document.getElementById('password');
    var pass_2 = document.getElementById('password2');
    var msg = document.getElementById('message');
    var str = document.getElementById('strength');
    var msg2 = document.getElementById('message2');
    var str2 = document.getElementById('strength2');
    pass_2.addEventListener('input',()=>{
      if(pass_2.value.length >0){
        msg2.style.display = 'block';

      }else{
        msg2.style.display = 'none';
      }
      if(pass_1.value!= pass_2.value){
        str2.innerHTML = 'Passwords do not match';
        str2.style.color ='red';
        str2.style.borderColor ='red';
      }else{
        str2.innerHTML = 'Passwords match';
        str2.style.color = 'green';
        str2.style.borderColor = 'green';
      }
    }); 
    pass_1.addEventListener('input',()=>{
          if(pass_1.value.length >0){
            msg.style.display = 'block';

          }else{
            msg.style.display = 'none';
          }
          if(pass_1.value.length < 4){
            str.innerHTML = 'Password is weak';
            str.style.color = 'red';
            str.style.borderColor = 'red';
          
        }else if(pass_1.value.length >= 4 && pass_1.value.length< 8){
            str.innerHTML = 'Password is medium';
            str.style.color = 'orange';
            str.style.borderColor = 'orange';
            
          }else if(pass_1.value.length >= 8){
            str.innerHTML = 'Password is strong';
            str.style.color = 'green';
            str.style.borderColor = 'green';
          }
    });
</script>
  </body>
</html>