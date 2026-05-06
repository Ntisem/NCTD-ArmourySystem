<?php require("user_auth.php");?>
<style>
      input, select, textarea{
    color: #fff;
    }

    textarea:focus, input:focus {
        color: #fff;
    }
      .sidebar .nav .nav-item.active > .log-out:before{
        content: "";
        width: 3px;
        height: 100%;
        background: #dc3545;
        display: inline-block;
        position: absolute;
        left: 0;
        top: 0;
      }
    </style>
        <style>
      select option{
        color: rgb(175, 179, 201);
      }
      select.form-control, select.asColorPicker-input, .dataTables_wrapper select, .jsgrid .jsgrid-table .jsgrid-filter-row select, .select2-container--default select.select2-selection--single, .select2-container--default .select2-selection--single select.select2-search__field, select.typeahead, select.tt-query, select.tt-hint{
       
        color: rgb(175, 179, 201);

      }
    .sidebar .nav .nav-item.profile .profile-desc .dropdown-menu .dropdown-item {
    padding: 11px 13px;
    background: #191c24;
     }

   .sidebar .nav .nav-item.profile .profile-desc .dropdown-menu .dropdown-item:hover {
    padding: 11px 13px;
    background-color: #191c24; 
    color:#555;
    }
    .success2{
      color: #f9a602;
      padding: 7px;
      font-weight: 600;
      font-size: 0.775rem;
      background-color: #ffab001c;
      border-radius: 50%;
      display: inline-block;
      text-align: center;

    }
    .success3{
      color: #f9a602;
      padding: 7px;
      font-weight: 600;
      font-size: 1rem;
      background-color: #ffab001c;
      /* border-radius: 10%; */
      display: inline-block;
      text-align: center;

    }
    </style>
<!-- starting tag of the sidebar -->
   <nav class="sidebar sidebar-offcanvas" id="sidebar">
    <div class="sidebar-brand-wrapper d-none d-lg-flex align-items-center justify-content-center fixed-top">
      <a class="sidebar-brand brand-logo" href="index"><img style="height: fit-content;" src="assets/images/gps_logo_armory.png" alt="logo" /></a>
      <a class="sidebar-brand brand-logo-mini" href="index"><img style="height:50px; width: 50px;" src="assets/images/gps_logo_armory_mini.png" alt="logo" /></a>
        </div>
        <ul class="nav">
          <li class="nav-item profile">
            <div class="profile-desc">
              <div class="profile-pic">
                <?php  
                    $username=$_SESSION['username']; 
                    $query = mysqli_query($connect_db,"SELECT * FROM `admin_lists` WHERE `username` ='$username'")
                    or die( mysqli_error($connect_db));
                    while ($row = mysqli_fetch_array($query)) {
                        $profile_image = $row['profile_image'];
                        $fullname = $row['fullname'];
                        $_SESSION['fullname'] =  $fullname;
                        $user_role = $row['user_role'];
                        $_SESSION['user_role'] =  $user_role;     
                        $adminID = $row['adminID'];
                        $_SESSION['adminID'] = $adminID;             
                        $output = "";
                        if(empty($profile_image)){
                        echo 
                        $output .='
                        <div class="count-indicator">
                        <img class="img-xs rounded-circle " src="assets/images/profile_images/avatar_placeholder.png" alt="">
                        <span class="count bg-success"></span>
                        </div>
                        ';
                        }else{
                            echo 
                            $output .='
                            <div class="count-indicator">
                            <img class="img-xs rounded-circle " src="assets/images/profile_images/'.$row['profile_image'].'" alt="">
                            <span class="count bg-success"></span>
                            </div>
                            ';
                        }
                    }
                ?>
                <div class="profile-name">
                    <?php   $fullname=$_SESSION['fullname']; 
                            $_SESSION['user_role'] =  $user_role;
                     echo '<h5 class="mb-0 font-weight-normal"><span class="count bg-success"></span> '.ucwords($fullname).'</h5> 
                           <span>'.$user_role.'</span>'?>
                </div>
              </div>
              <a href="#" id="profile-dropdown" data-bs-toggle="dropdown"><i class="mdi mdi-dots-vertical"></i></a>
              <div class="dropdown-menu dropdown-menu-right sidebar-dropdown preview-list" aria-labelledby="profile-dropdown">
                <a href="update-administrator?Update-adminID=<?php echo $_SESSION['adminID'] = $adminID;?>" class="dropdown-item preview-item">
                  <div class="preview-thumbnail">
                    <div class="preview-icon bg-dark rounded-circle">
                      <i class="mdi mdi-settings text-primary"></i>
                    </div>
                  </div>
                  <div class="preview-item-content">
                    <p class="preview-subject ellipsis mb-1 text-small">Account settings</p>
                  </div>
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item preview-item">
                  <div class="preview-thumbnail">
                    <div class="preview-icon bg-dark rounded-circle">
                      <i class="mdi mdi-onepassword  text-info"></i>
                    </div>
                  </div>
                  <div class="preview-item-content">
                    <p class="preview-subject ellipsis mb-1 text-small">Change Password</p>
                  </div>
                </a>
                <div class="dropdown-divider"></div>
                <a href="taskboard" class="dropdown-item preview-item">
                  <div class="preview-thumbnail">
                    <div class="preview-icon bg-dark rounded-circle">
                      <i class="mdi mdi-calendar-today text-success"></i>
                    </div>
                  </div>
                  <div class="preview-item-content">
                    <p class="preview-subject ellipsis mb-1 text-small">To-do list</p>
                  </div>
                </a>
              </div>
            </div>
          </li>
          <li class="nav-item nav-category">
            <span class="nav-link">Navigation</span>
          </li>
          <li class="nav-item menu-items">
            <a class="nav-link" href="index">
              <span class="menu-icon">
                <i class="mdi mdi-speedometer"></i>
              </span>
              <span class="menu-title">Dashboard</span>
            </a>
          </li>
          <li class="nav-item menu-items">
            <a class="nav-link" data-bs-toggle="collapse" href="#weapon" aria-expanded="false" aria-controls="weapon">
              <span class="menu-icon">
                <i class="mdi mdi-arrow-down-bold-box-outline"></i>
              </span>
              <span class="menu-title">Inventory</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="weapon">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="all">All Weapons/Assets</a></li>
                <li class="nav-item"> <a class="nav-link" href="add-new-weapon">Add New Asset/Firearm</a></li>
              </ul>
            </div>
          </li>
          <li class="nav-item menu-items">
            <a class="nav-link" data-bs-toggle="collapse" href="#booking" aria-expanded="false" aria-controls="booking">
              <span class="menu-icon">
                <i class="mdi mdi-account-box-multiple"></i>
              </span>
              <span class="menu-title">Bookings</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="booking">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="booking"> Booking </a></li>
                <li class="nav-item"> <a class="nav-link" href="booked-firearms"> Booking History</a></li>
              </ul>
            </div>
          </li>
          <li class="nav-item menu-items">
            <a class="nav-link" data-bs-toggle="collapse" href="#returns" aria-expanded="false" aria-controls="booking">
              <span class="menu-icon">
                <i class="mdi mdi-history"></i>
              </span>
              <span class="menu-title">Returns</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="returns">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="returns"> Firearm Returns </a></li>
                <li class="nav-item"> <a class="nav-link" href="returns-ammo">Ammo Returns</a></li>
                <li class="nav-item"> <a class="nav-link" href="returns-assets">Asset Returns </a></li>
              </ul>
            </div>
          </li>
          <li class="nav-item menu-items">
            <a class="nav-link" data-bs-toggle="collapse" href="#faulty" aria-expanded="false" aria-controls="faulty">
              <span class="menu-icon">
                <i class="mdi mdi-pistol text-danger"></i>
              </span>
              <span class="menu-title">Faulty Asset/Firearm</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="faulty">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="add-faulty-weapon">Add New Asset/Firearm</a></li>
                <li class="nav-item"> <a class="nav-link" href="faulty-weapon">Faulty Asset/Firearm</a></li>
              </ul>
            </div>
          </li>
          <!-- <li class="nav-item menu-items">
            <a class="nav-link" href="departments">
              <span class="menu-icon">
                <i class="mdi mdi-home-account"></i>
              </span>
              <span class="menu-title">Unit/Department</span>
            </a>
          </li> -->
          <li class="nav-item menu-items">
            <a class="nav-link" data-bs-toggle="collapse" href="#officer" aria-expanded="false" aria-controls="officer">
              <span class="menu-icon">
                <i class="mdi mdi-account-box-multiple"></i>
              </span>
              <span class="menu-title">Officers Lists</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="officer">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="officers-list">Officers List </a></li>
                <li class="nav-item"> <a class="nav-link" href="add-new-officer">Add New Officer </a></li>
              </ul>
            </div>
          </li>
          <li class="nav-item menu-items">
            <a class="nav-link" data-bs-toggle="collapse" href="#App" aria-expanded="false" aria-controls="App">
              <span class="menu-icon">
                <i class="mdi mdi-cellphone-link"></i>
              </span>
              <span class="menu-title">Apps</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="App">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="mailbox"> MailBox </a></li>
                <li class="nav-item"> <a class="nav-link" href="taskboard"> Task Board </a></li>
                <li class="nav-item"> <a class="nav-link" href="Calendar"> Calendar </a></li>
                <li class="nav-item"> <a class="nav-link" href="calculator"> calculator </a></li>
              </ul>
            </div>
          </li>
          <li class="nav-item menu-items">
            <a class="nav-link" data-bs-toggle="collapse" href="#administrators" aria-expanded="false" aria-controls="administrators">
              <span class="menu-icon">
                <i class="mdi mdi mdi-account-key"></i>
              </span>
              <span class="menu-title">Administrators &nbsp;&nbsp;
              <span class="success2">  
              <?php                            
                $sql="SELECT * FROM `admin_lists` WHERE user_role = 'Administrator'";

                if ($result=mysqli_query($connect_db,$sql))
                {
                // Return the number of rows in result set
                $rowcount=mysqli_num_rows($result);
                printf(" %d \n",$rowcount);
                // Free result set
                mysqli_free_result($result);
                }
                ?>
              </span>
              </span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="administrators">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="add-new-admin"> Add New Admin</a></li>
                <li class="nav-item"> <a class="nav-link" href="administrators"> Administrators </a></li>
              </ul>
            </div>
          </li>
          <li class="nav-item menu-items">
            <a class="nav-link" data-bs-toggle="collapse" href="#armourers" aria-expanded="false" aria-controls="armourers">
              <span class="menu-icon">
                <i class="mdi mdi mdi-account-key"></i>
              </span>
              <span class="menu-title">Armourers
              <span class="success2">  
              <?php                            
                $sql="SELECT * FROM `admin_lists` WHERE user_role = 'Armourer'";

                if ($result=mysqli_query($connect_db,$sql))
                {
                // Return the number of rows in result set
                $rowcount=mysqli_num_rows($result);
                printf(" %d \n",$rowcount);
                // Free result set
                mysqli_free_result($result);
                }
                ?>
              </span>
              </span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="armourers">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="add-new-armourer"> Add New Armourer</a></li>
                <li class="nav-item"> <a class="nav-link" href="armourers"> Armourers </a></li>
              </ul>
            </div>
          </li>
          <li class="nav-item menu-items">
            <a class="nav-link" data-bs-toggle="collapse" href="#activities" aria-expanded="false" aria-controls="activities">
              <span class="menu-icon">
                <i class="mdi mdi mdi-debug-step-over"></i>
              </span>
              <span class="menu-title">Activities</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="activities">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="admin-logs"> Admin Log Activity</a></li>
                <li class="nav-item"> <a class="nav-link" href="daily-activities">  Activity Log </a></li>
              </ul>
            </div>
          </li>
          <!-- <li class="nav-item menu-items">
            <a class="nav-link" href="backup_db">
              <span class="menu-icon">
                <i class="mdi mdi-layers"></i>
              </span>
              <span class="menu-title">Database</span>
            </a>
          </li> 
         -->
        </ul>
      </nav>
      <!-- close tag of the sidebar -->
   
   