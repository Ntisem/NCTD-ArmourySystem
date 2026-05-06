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
          <li class="nav-item nav-category">
            <span class="nav-link">Bookings</span>
          </li>
          <li class="nav-item menu-items">
            <a class="nav-link" href="booking">
              <span class="menu-icon">
                <i class="mdi mdi-pistol"></i>
              </span>
              <span class="menu-title">Firearms</span>
            </a>
          </li>
          <li class="nav-item menu-items">
            <a class="nav-link" href="booking-ammo">
              <span class="menu-icon">
                <i class="mdi mdi-ammunition"></i>
              </span>
              <span class="menu-title">Ammunition</span>
            </a>
          </li>
          <li class="nav-item menu-items">
            <a class="nav-link" href="booking-other-assets">
              <span class="menu-icon">
                <i class="mdi mdi-keg"></i>
              </span>
              <span class="menu-title">Assets</span>
            </a>
          </li>
          <li class="nav-item nav-category">
            <span class="nav-link">Booking History</span>
          </li>
          <li class="nav-item menu-items">
            <a class="nav-link" href="booked-firearms">
              <span class="menu-icon">
                <i class="mdi mdi-pistol"></i>
              </span>
              <span class="menu-title">Firearms</span>
            </a>
          </li>
          <li class="nav-item menu-items">
            <a class="nav-link" href="booked-ammo">
              <span class="menu-icon">
                <i class="mdi mdi-ammunition"></i>
              </span>
              <span class="menu-title">Ammunition</span>
            </a>
          </li>
          <li class="nav-item menu-items">
            <a class="nav-link" href="booked-other-assets">
              <span class="menu-icon">
                <i class="mdi mdi-keg"></i>
              </span>
              <span class="menu-title"> Assets</span>
            </a>
          </li>
          <li class="nav-item menu-items">
            <a class="nav-link" href="returns">
              <span class="menu-icon">
                <i class="mdi mdi-history"></i>
              </span>
              <span class="menu-title">Returns</span>
            </a>
          </li>
        </ul>
      </nav>
      <!-- close tag of the sidebar -->
   
   