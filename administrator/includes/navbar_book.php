    
    <?php require("user_auth.php");?>
    <style>
      .navbar .navbar-menu-wrapper .navbar-nav .nav-item.dropdown .dropdown-menu.navbar-dropdown .dropdown-item {
    margin-bottom: 0;
    padding: 11px 13px;
    cursor: pointer;
    background: #191c24;
}
.btn-group > .btn, .ajax-upload-dragdrop .btn-group > .ajax-file-upload, .btn-group-vertical > .btn, .ajax-upload-dragdrop .btn-group-vertical > .ajax-file-upload {
    position: relative;
    flex: 1 1 auto;
    padding: 10px 10px;
    background-color: #f2edf3;
}
select.form-control, select.asColorPicker-input, .dataTables_wrapper select, .jsgrid .jsgrid-table .jsgrid-filter-row select, .select2-container--default select.select2-selection--single, .select2-container--default .select2-selection--single select.select2-search__field, select.typeahead, select.tt-query, select.tt-hint {
    color: #242323;
}
    </style>
      <style>
    .body-clock {
        background: black;
    }

  .clock {
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translateX(-50%) translateY(-50%);
      color: #17D4FE;
      font-size: 30px;
      font-weight: bold;
      font-family: Orbitron;
      letter-spacing: 7px;
  }
  /* #date {
      letter-spacing:3px;
      font-size:14px;
      font-family:arial,sans-serif;
      color:#fff;
  } */
  @font-face{
    font-family: 'Digital-7';
    src:  url('fonts/digital-7.ttf') format('woff2'),
    url('digital-7.woff') format('woff');
}
/* .clockdate-wrapper {
    background: #141E30; */
      /* fallback for old browsers */
    /* background: -webkit-linear-gradient(to right, #243B55, #141E30);   */
    /* Chrome 10-25, Safari 5.1-6 */
    /* background: linear-gradient(to right, #243B55, #141E30); */
     /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
    /* padding:25px;
    max-width:350px;
    width:100%;
    text-align:center;
    border-radius:5px;
    margin:0 auto;
  
} */
#clock{
    font-family:  Orbitron;
    font-size:30px;
    text-shadow:0px 0px 1px #fff;
    color: #17D4FE;
    margin-top: 30px;
    
}
#clock span {
    color: rgba(255, 255, 255, 0.8);
    text-shadow:0px 0px 1px #333;
    font-size:15px;
    position:relative;
    top:-5px; 
    left:3px;
}
#date {
    letter-spacing:3px;
    font-size:12px;
    font-family: Orbitron;
    color:#f9a602;
    font-weight:bold;
    margin-top: -10px;
}
code {
    padding: 5px;
    color: #fff;
    font-weight: 300;
    font-size: 0.875rem;
    border-radius: 4px;
}
.danger{
  color: #fc424a;
}
.success{
  color:#00d25b;
  padding: 5px;
  font-weight: 600;
  font-size: 0.875rem;
  border-radius: 4px;
}
.success2{
  color: #f9a602;
  padding: 7px;
  font-weight: 600;
  font-size: 0.775rem;
  height: 25px;
  width: 25px;
  background-color: #ffab001c;
  border-radius: 50%;
  display: inline-block;
  text-align: center;

}
  </style>
    <nav class="navbar p-0 fixed-top d-flex flex-row">
          <div class="navbar-brand-wrapper d-flex d-lg-none align-items-center justify-content-center">
            <a class="navbar-brand brand-logo-mini" href="index"><img style="height:50px; width: 100px;" src="assets/images/gps_logo_armory_mini.png" alt="logo" /></a>
          </div>
          <div class="navbar-menu-wrapper flex-grow d-flex align-items-stretch">
            <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
              <span class="mdi mdi-menu"></span>
            </button>
            <ul class="navbar-nav w-100">
              <li class="nav-item w-100">
                <!-- <form class="nav-link mt-2 mt-md-0 d-none d-lg-flex search"> -->
                  <!-- <input type="text" class="form-control" name="search_inventory" placeholder="Search Assets or Weapons"> -->
                 <a href="search.php"> <button  class="badge badge-danger"><i class="mdi mdi-magnify f-22"></i></button></a>
                <!-- </form> -->
              </li>
            </ul>

            <ul class="navbar-nav navbar-nav-right">
            <li class="nav-item dropdown">
                <a class="nav-link count-indicator dropdown-toggle" id="messageDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                <p  id="clock"></p>
                <p id="date"></p>
                </a>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link" id="profileDropdown" href="#" data-bs-toggle="dropdown">
                <?php  
                    $username=$_SESSION['username'];
                    $query = mysqli_query($connect_db,"SELECT * FROM `admin_lists` WHERE `username` ='$username'")
                    or die( mysqli_error($connect_db));
                    while ($row = mysqli_fetch_array($query)) {
                        $profile_image = $row['profile_image'];
                        $fullname = $row['fullname'];
                        $_SESSION['fullname'] =  $fullname;             
                        $output = "";
                        if(empty($profile_image)){
                        echo 
                        $output .='
                        <div class="navbar-profile">
                        <img class="img-xs rounded-circle" src="assets/images/profile_images/avatar_placeholder.png" alt="">
                        <p class="mb-0 d-none d-sm-block navbar-profile-name">'.ucwords($fullname).'</p>
                        
                        </div>
                        ';

                        }else{
                            echo 
                            $output .='
                            <div class="navbar-profile">
                            <img class="img-xs rounded-circle" src="assets/images/profile_images/'.$row['profile_image'].'" alt="">
                            <p class="mb-0 d-none d-sm-block navbar-profile-name">'.ucwords($fullname).'</p>
                            
                            </div>';
                        }
                    }
                ?>
                </a>
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="profileDropdown">
                  <h6 class="p-3 mb-0">Profile</h6>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item preview-item">
                    <div class="preview-thumbnail">
                      <div class="preview-icon bg-dark rounded-circle">
                        <i class="mdi mdi-settings text-success"></i>
                      </div>
                    </div>
                    <div class="preview-item-content">
                      <p class="preview-subject mb-1">Settings</p>
                    </div>
                  </a>
                  <?php require_once('redirect.php') ?>
                  <div class="dropdown-divider"></div>
                  <a  href="../logout?page_url=<?php echo $redirect_link_var;?>" class="dropdown-item preview-item">
                    <div class="preview-thumbnail">
                      <div class="preview-icon bg-dark rounded-circle">
                        <i class="mdi mdi-logout text-danger"></i>
                      </div>
                    </div>
                    <div class="preview-item-content">
                      <p class="preview-subject mb-1">Log out</p>
                    </div>
                  </a>
              </li>
            </ul>
            <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
              <span class="mdi mdi-format-line-spacing"></span>
            </button>
          </div>
        </nav>