<!-- register edit admin -->
<style>
    .modal-header {
        border:1px solid #ffffff;
        background-color: #040080;   
    }
    .modal-body {
        border-bottom:1px solid #ffffff;
        background-color:#02021a;
    }

</style>

<div class="modal fade" id="edit-admin-<?php echo $row['adminID'];?>" data-backdrop="static" data-keyboard="false"
    tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" >
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel" style="color: #fff;">Edit Administrator <code class="success3">[<?php echo ucwords($row['username']); ?>]</code>'s Profile</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" style="color: #fff;">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="functions.php" class="forms-sample" enctype="multipart/form-data">
                <input type="hidden" class="form-control" name="adminID" value="<?php echo $row['adminID']; ?>">
                <input type="hidden" class="form-control" name="adminID_armourerID" value="<?php echo  $_SESSION['adminID']=$adminID; ?>">
                <input type="hidden" class="form-control" name="armourer_admin_name" value="<?php echo $_SESSION['armourer_admin_name'] = $armourer_admin_name; ?>">
                <input type="hidden" class="form-control" name="admin_armourer_user_role" value="<?php echo  $_SESSION['admin_armourer_user_role'] =  $admin_armourer_user_role; ?>">  
                    <div class="form-group">
                        <label for="service_no"><code style="color:#fff;">Service Number</code></label>
                        <input type="text" class="form-control" name="service_no" id="service_no"
                            value="<?php echo $row['service_no']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="User_role"><code style="color:#fff;">User Role</code></label>
                      <div class="col-sm-9">
                            <select class="form-control" name="user_role">
                            <option value="<?php echo $row['user_role']; ?>"><?php echo $row['user_role']; ?></option>
                            <option value="Administrator">Administrator</option>
                            <option value="Armourer">Armourer</option>
                            </select>
                        </div> 
                    </div>
                    <div class="form-group">
                        <label for="unit_dept"><code style="color:#fff;">Gender</code></label>
                      <div class="col-sm-9">
                            <select class="form-control" name="gender">
                            <option value="<?php echo $row['gender']; ?>"><?php echo $row['gender']; ?></option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                            </select>
                        </div> 
                    </div>
                    <div class="form-group">
                        <label for="unit_dept"><code style="color:#fff;">Rank</code></label>
                      <div class="col-sm-9">
                            <select class="form-control" name="rank">
                            <option value="<?php echo $row['rank']; ?>"><?php echo $row['rank']; ?></option>
                            <option value="CONST">Constable</option>
                            <option value="L/CPL">Lance Corporal</option>
                            <option value="CPL">Corporal</option>
                            <option value="SGT">Sergeant</option>
                            <option value="INSPR">Inspector</option>
                            <option value="C/INSPR">Chief Inspector</option>
                            </select>
                        </div> 
                    </div>
                    <div class="form-group">
                        <label for="fullname"><code style="color:#fff;">Fullname</code></label>
                        <input type="text" class="form-control" name="fullname" id="fullname"
                            value="<?php echo $row['fullname']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="username"><code style="color:#fff;">Username</code></label>
                        <input type="text" class="form-control" name="username" id="username"
                            value="<?php echo $row['username']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="email"><code style="color:#fff;">Phone Number</code></label>
                        <input type="text" class="form-control" name="phone_number" id="phone_number"
                            value="<?php echo $row['phone_number']; ?>" pattern="^(\d{3}[-]?){1,2}(\d{4})$" placeholder="eg: 024-500-7000"/>
                    </div>
                    <div class="form-group">
                        <label for="email"><code style="color:#fff;">Email address</code></label>
                        <input type="email" class="form-control" name="admin_email" id="email"
                            value="<?php echo $row['admin_email']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="unit_dept"><code style="color:#fff;">Unit/Dept</code></label>
                            <div class="col-sm-9">
                            <select class="form-control" name="unit_dept">
                            <option value="<?php echo $row['unit_dept']; ?>"><?php echo $row['unit_dept']; ?></option>
                            <option value="NVU">National Visibility Unit (NVU)</option>
                            <option value="CTD">Counter Terrorism Dept (CTD)</option>
                            <option value="SWAT">Special Weapon and Tactics (SWAT)</option>
                            <option value="FPU">Formed Police Unit (FPU)</option>
                            </select>
                        </div> 
                    </div>
                    <div class="form-group">
                        <label><code style="color:#fff;">Profile Image upload</code></label>
                        <input type="file" class="form-control" name="profile_image" id="exampleFormControlFile1" value="<?php echo $row['profile_image']; ?>">
                        </div>
                    </div>
                    <!-- </div> -->
                    <div class="modal-footer">
                     <button type="submit" class="btn btn-inverse-success btn-fw" name="update-admin">Update</button>
                      <button type="button" class="btn btn-inverse-danger  btn-fw" data-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- edit administrator-->

<!-- Update Armourer  -->
<div class="modal fade" id="edit-armourer-<?php echo $row['adminID'];?>" data-backdrop="static" data-keyboard="false"
    tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" style="">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel" style="color: #fff;">Edit Armourer <code class="success3">[<?php echo ucwords($row['username']); ?>]</code>'s Profile</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" style="color: #fff;">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="functions.php" class="forms-sample" enctype="multipart/form-data">
                <input type="hidden" class="form-control" name="adminID" value="<?php echo $row['adminID']; ?>">
                <input type="hidden" class="form-control" name="adminID_armourerID" value="<?php echo  $_SESSION['adminID']=$adminID; ?>">
                <input type="hidden" class="form-control" name="armourer_admin_name" value="<?php echo $_SESSION['armourer_admin_name'] = $armourer_admin_name; ?>">
                <input type="hidden" class="form-control" name="admin_armourer_user_role" value="<?php echo  $_SESSION['admin_armourer_user_role'] =  $admin_armourer_user_role; ?>">  
                    <div class="form-group">
                        <label for="service_no"><code style="color:#fff;">Service Number</code></label>
                        <input type="text" class="form-control" name="service_no" id="service_no"
                            value="<?php echo $row['service_no']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="User_role"><code style="color:#fff;">User Role</code></label>
                      <div class="col-sm-9">
                            <select class="form-control" name="user_role">
                            <option value="<?php echo $row['user_role']; ?>"><?php echo $row['user_role']; ?></option>
                            <option value="Administrator">Administrator</option>
                            <option value="Armourer">Armourer</option>
                            </select>
                        </div> 
                    </div>
                    <div class="form-group">
                        <label for="unit_dept"><code style="color:#fff;">Gender</code></label>
                      <div class="col-sm-9">
                            <select class="form-control" name="gender">
                            <option value="<?php echo $row['gender']; ?>"><?php echo $row['gender']; ?></option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                            </select>
                        </div> 
                    </div>
                    <div class="form-group">
                        <label for="unit_dept"><code style="color:#fff;">Rank</code></label>
                      <div class="col-sm-9">
                            <select class="form-control" name="rank">
                            <option value="<?php echo $row['rank']; ?>"><?php echo $row['rank']; ?></option>
                            <option value="CONST">Constable</option>
                            <option value="L/CPL">Lance Corporal</option>
                            <option value="CPL">Corporal</option>
                            <option value="SGT">Sergeant</option>
                            <option value="INSPR">Inspector</option>
                            <option value="C/INSPR">Chief Inspector</option>
                            </select>
                        </div> 
                    </div>
                    <div class="form-group">
                        <label for="fullname"><code style="color:#fff;">Fullname</code></label>
                        <input type="text" class="form-control" name="fullname" id="fullname"
                            value="<?php echo $row['fullname']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="username"><code style="color:#fff;">Username</code></label>
                        <input type="text" class="form-control" name="username" id="username"
                            value="<?php echo $row['username']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="email"><code style="color:#fff;">Phone Number</code></label>
                        <input type="text" class="form-control" name="phone_number" id="phone_number"
                            value="<?php echo $row['phone_number']; ?>" pattern="^(\d{3}[-]?){1,2}(\d{4})$" placeholder="eg: 024-500-7000"/>
                    </div>
                    <div class="form-group">
                        <label for="email"><code style="color:#fff;">Email address</code></label>
                        <input type="email" class="form-control" name="admin_email" id="email"
                            value="<?php echo $row['admin_email']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="unit_dept"><code style="color:#fff;">Unit/Dept</code></label>
                            <div class="col-sm-9">
                            <select class="form-control" name="unit_dept">
                            <option value="<?php echo $row['unit_dept']; ?>"><?php echo $row['unit_dept']; ?></option>
                            <option value="NVU">National Visibility Unit (NVU)</option>
                            <option value="CTD">Counter Terrorism Dept (CTD)</option>
                            <option value="SWAT">Special Weapon and Tactics (SWAT)</option>
                            <option value="FPU">Formed Police Unit (FPU)</option>
                            </select>
                        </div> 
                    </div>
                    <div class="form-group">
                        <label><code style="color:#fff;">Profile Image upload</code></label>
                        <input type="file" class="form-control" name="profile_image" id="exampleFormControlFile1" value="<?php echo $row['profile_image']; ?>">
                        </div>
                    </div>
                    <!-- </div> -->
                    <div class="modal-footer">
                     <button type="submit" class="btn btn-inverse-success btn-fw" name="update-armourer">Update</button>
                      <button type="button" class="btn btn-inverse-danger  btn-fw" data-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Ends of Editing Armourer -->


<!-- deleting admin -->
<div class="modal fade" id="delete-admin-<?php echo $row['adminID'];?>" data-backdrop="static" data-keyboard="false"
    tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content"  >
            <div class="modal-header" style="background-color:#EB1616 ;">
                <h4 class="modal-title" id="staticBackdropLabel">Delete Administrator Account</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p class="text-center">Are you sure you want to delete this Account ?</p>
                <h6 class="text-center">
                    
                    <div class="badge badge-outline-warning" role="progressbar" style="width: 100%"
                     aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"><?php echo  $row['rank']; ?>&#160;<?php echo  $row['fullname']; ?></div>
                   </div>
                </h6>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="feather icon-x"></i>
                        NO</button>
                    <a href="delete?adminID=<?php echo $row['adminID']; ?>&adminID-armourerID=<?php echo  $_SESSION['adminID_armourerID']=$adminID_armourerID; ?>&armourer-admin-name=<?php echo $_SESSION['armourer_admin_name'] = $armourer_admin_name; ?>&user-role=<?php echo $_SESSION['admin_armourer_user_role']; ?>&admin-name=<?php echo $row['user_role'].' '.$row['rank'].'  '.$row['fullname'].' ('.$row['username'].')'; ?>"
                     class="btn btn-danger"><i class="feather icon-trash-2"></i>YES</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- deleting admin -->

<!-- deleting armourer -->
<div class="modal fade" id="delete-armourer-<?php echo $row['adminID'];?>" data-backdrop="static" data-keyboard="false"
    tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content"  >
            <div class="modal-header" style="background-color:#EB1616 ;">
                <h4 class="modal-title" id="staticBackdropLabel">Delete Armourer Account</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p class="text-center">Are you sure you want to delete this Account ?</p>
                <h6 class="text-center">
                    
                    <div class="badge badge-outline-warning" role="progressbar" style="width: 100%"
                     aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"><?php echo  $row['rank'];?>&#160;<?php echo  $row['fullname']; ?></div>
                   </div>
                </h6>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="feather icon-x"></i>
                        NO</button>
                    <a href="delete?armourerID=<?php echo $row['adminID']; ?>&adminID-armourerID=<?php echo  $_SESSION['adminID_armourerID']=$adminID_armourerID; ?>&armourer-admin-name=<?php echo $_SESSION['armourer_admin_name'] = $armourer_admin_name; ?>&user-role=<?php echo $_SESSION['admin_armourer_user_role']; ?>&armourer-name=<?php echo $row['user_role'].' '.$row['rank'].'  '.$row['fullname'].' ('.$row['username'].')'; ?>"
                     class="btn btn-danger"><i class="feather icon-trash-2"></i>YES</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- deleting armourer -->
<!-- edit officer's profile -->
<div class="modal fade" id="edit-officer-<?php echo $row['officerID'];?>" data-backdrop="static" data-keyboard="false"
    tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" style="">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel" style="color: #fff;">Edit <code class="success3">[<?php echo $row['rank'].' '.ucwords($row['full_name']); ?>]</code>'s Profile</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" style="color: #fff;">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="functions.php" class="forms-sample" enctype="multipart/form-data">
                <input type="hidden" class="form-control" name="adminID" value="<?php echo  $_SESSION['adminID']=$adminID; ?>">
                <input type="hidden" class="form-control" name="armourer_admin_name" value="<?php echo $_SESSION['armourer_admin_name'] = $armourer_admin_name; ?>">
                <input type="hidden" class="form-control" name="user_role" value="<?php echo  $_SESSION['user_role'] =  $user_role; ?>">  
                <input type="hidden" class="form-control" name="officerID" value="<?php echo $row['officerID']; ?>">
                    <div class="form-group">
                        <label for="service_no"><code style="color:#fff;">Service Number</code></label>
                        <input type="text" class="form-control" name="officer_service_no" id="officer_service_no"
                            value="<?php echo $row['officer_service_no']; ?>">
                    </div>
                    <div class="form-group">
                        <input type="hidden" name="officer_status" class="form-control" id="exampleInputName1" value="<?php echo $row['officer_status']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="unit_dept"><code style="color:#fff;">Gender</code></label>
                      <div class="col-sm-9">
                            <select class="form-control" name="gender">
                            <option value="<?php echo $row['gender']; ?>"><?php echo $row['gender']; ?></option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                            </select>
                        </div> 
                    </div>
                    <div class="form-group">
                        <label for="unit_dept"><code style="color:#fff;">Rank</code></label>
                      <div class="col-sm-9">
                            <select class="form-control" name="rank">
                            <option value="<?php echo $row['rank']; ?>"><?php echo $row['rank']; ?></option>
                            <option value="CONST">Constable</option>
                            <option value="L/CPL">Lance Corporal</option>
                            <option value="CPL">Corporal</option>
                            <option value="SGT">Sergeant</option>
                            <option value="INSPR">Inspector</option>
                            <option value="C/INSPR">Chief Inspector</option>
                            <option value="ASP">Assistant Superintendent</option>
                            <option value="DSP">Deputy Superintendent</option>
                            <option value="SUP">Superintendent</option>
                            <option value="C/SUP">Chief Superintendent</option>
                            <option value="ACP">Assistant Commissioner</option>
                            <option value="DCOP">Deputy Commissioner</option>
                            </select>
                        </div> 
                    </div>
                    <div class="form-group">
                        <label for="fullname"><code style="color:#fff;">Full last_name</code></label>
                        <input type="text" class="form-control" name="full_name" id="full_name"
                            value="<?php echo $row['full_name']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="email"><code style="color:#fff;">Phone Number</code></label>
                        <input type="text" class="form-control" name="phone_no" id="phone_no"
                            value="<?php echo $row['phone_no']; ?>" pattern="^(\d{3}[-]?){1,2}(\d{4})$" placeholder="eg: 024-500-7000"/>
                    </div>
                    <div class="form-group">
                        <label for="email"><code style="color:#fff;">Email address</code></label>
                        <input type="email" class="form-control" name="officer_email" id="officer_email"
                            value="<?php echo $row['officer_email']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="unit_dept"><code style="color:#fff;">Unit/Dept</code></label>
                            <div class="col-sm-9">
                            <select class="form-control" name="dept_unit">
                            <option value="<?php echo $row['dept_unit']; ?>"><?php echo $row['dept_unit']; ?></option>
                            <option value="NVU">National Visibility Unit (NVU)</option>
                            <option value="CTD">Counter Terrorism Dept (CTD)</option>
                            <option value="SWAT">Special Weapon and Tactics (SWAT)</option>
                            <option value="FPU">Formed Police Unit (FPU)</option>
                            </select>
                        </div> 
                    </div>
                    <div class="form-group">
                        <label><code style="color:#fff;">Profile Image upload</code></label>
                        <input type="file" class="form-control" name="officer_image" id="exampleFormControlFile1">
                        </div>
                    </div>
                    <!-- </div> -->
                    <div class="modal-footer">
                     <button type="submit" class="btn btn-inverse-success btn-fw" name="update-officer">Update</button>
                      <button type="button" class="btn btn-inverse-danger  btn-fw" data-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- edit administrator-->
<!-- deleting Officer -->
<div class="modal fade" id="delete-officer-<?php echo $row['officerID'];?>" data-backdrop="static" data-keyboard="false"
    tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content"  >
            <div class="modal-header" style="background-color:#EB1616 ;">
                <h4 class="modal-title" id="staticBackdropLabel">Delete Officer's Account</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p class="text-center">Are you sure you want to delete this Officer Account ?</p>
                <h6 class="text-center">
                    
                    <div class="badge badge-outline-warning" role="progressbar" style="width: 100%"
                     aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"><?php echo  $row['rank']; ?>&#160;<?php echo  $row['full_name']; ?></div>
                   </div>
                </h6>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="feather icon-x"></i>
                        NO</button>
                    
                    <a href="delete?officerID=<?php echo $row['officerID'];?>&adminID=<?php echo  $_SESSION['adminID']=$adminID; ?>
                    &armourer-admin-name=<?php echo $_SESSION['armourer_admin_name'] = $armourer_admin_name; ?>
                    &user-role=<?php echo  $_SESSION['user_role'] =  $user_role; ?>&officer-name=<?php echo $row['rank'].' ( '.$row['full_name'].' )'; ?>"
                     class="btn btn-danger"><i class="feather icon-trash-2"></i>YES</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- deleting admin -->



<!-- Updating Ammunition  -->
<div class="modal fade" id="edit-asset-<?php echo $row['assetID'];?>" data-backdrop="static" data-keyboard="false"
    tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" style="">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel" style="color: #fff;">Edit Asset <code class="success3">[<?php echo $row['asset_serial_no'].''.ucwords($row['asset_name']); ?>]</code></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" style="color: #fff;">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="functions.php" class="forms-sample" enctype="multipart/form-data">
                <input type="hidden" class="form-control" name="adminID" value="<?php echo  $_SESSION['adminID']=$adminID; ?>">
                <input type="hidden" class="form-control" name="armourer_admin_name" value="<?php echo $_SESSION['armourer_admin_name'] = $armourer_admin_name; ?>">
                <input type="hidden" class="form-control" name="user_role" value="<?php echo  $_SESSION['user_role'] =  $user_role; ?>">  
                    <input type="hidden" class="form-control" name="assetID" value="<?php echo $row['assetID']; ?>">
                    <div class="form-group">
                        <label for="service_no"><code style="color:#fff;">Asset Serial No.</code></label>
                        <input type="text" class="form-control" name="asset_serial_no" id="asset_serial_no"
                            value="<?php echo $row['asset_serial_no']; ?>">
                            <input type="hidden" class="form-control" name="assetID" id="assetID"
                            value="<?php echo $row['assetID']; ?>">
                        </div>                  
                    <div class="form-group">
                        <label for="asset_name"><code style="color:#fff;">Asset Name</code></label>
                        <input type="text" class="form-control" name="asset_name" id="asset_name"
                            value="<?php echo $row['asset_name']; ?>" placeholder="Asset Name"/>
                    </div>    
                    <div class="form-group">
                        <label><code style="color:#fff;">Asset Quantity</code></label>
                        <input type="number" class="form-control" name="asset_quantity" id="quantity" 
                         value="<?php echo $row['asset_quantity']; ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label><code style="color:#fff;"> Asset Image</code></label>
                        <input type="file" class="form-control" name="asset_image" id="asset_image" 
                         value="<?php echo $row['asset_image']; ?>">
                        </div>
                    <!-- </div> -->
                    <!-- </div> -->
                    <div class="modal-footer">
                     <button type="submit" class="btn btn-inverse-success btn-fw" name="update-asset">Update</button>
                      <button type="button" class="btn btn-inverse-danger  btn-fw" data-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- edit Ammunition-->

<!-- Updating Assets  -->
<div class="modal fade" id="edit-ammo-<?php echo $row['ammoID'];?>" data-backdrop="static" data-keyboard="false"
    tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel" style="color: orange;">Update Ammunition <code class="success3">[<?php echo $row['ammo_serial_no'].''.ucwords($row['ammo_name']); ?>]</code></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" style="color: #fff;">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="functions.php" class="forms-sample" enctype="multipart/form-data"> 
                <input type="hidden" class="form-control" name="adminID" value="<?php echo  $_SESSION['adminID']=$adminID; ?>">
                <input type="hidden" class="form-control" name="armourer_admin_name" value="<?php echo $_SESSION['armourer_admin_name'] = $armourer_admin_name; ?>">
                <input type="hidden" class="form-control" name="user_role" value="<?php echo  $_SESSION['user_role'] =  $user_role; ?>">  
                <input type="hidden" class="form-control" name="ammoID" value="<?php echo $row['ammoID']; ?>">
                    <div class="form-group">
                        <label for="service_no"><code style="color:#fff;">Ammo Serial No.</code></label>
                        <input type="text" class="form-control" name="ammo_serial_no" id="ammo_serial_no"
                            value="<?php echo $row['ammo_serial_no']; ?>">
                    </div>
                    <!-- <div class="form-group">
                        <input type="hidden" name="ammo_status" class="form-control" id="exampleInputName1" value="<?php echo $row['ammo_status']; ?>">
                    </div> -->
                    <div class="form-group">
                    <label class="col-sm-6 col-form-label"><code style="color:#fff;">Ammunition Type</code></label>
                    <div class="col-sm-9">
                        <select name="ammo_type" class="form-control">
                        <option value="<?php echo $row['ammo_type']; ?>"><?php echo $row['ammo_type']; ?></option>
                        <option value="Elite-Hunter">Elite Hunter</option>
                        <option value="Full-Metal-Jacket">Full-Metal-Jacket(FMJ)</option>
                        <option value="Jacketed-Hollow-Point">Jacketed Hollow Point(JHP)</option>
                        <option value="Open-Tip-Match">Open Tip Match(OTM)</option>
                        </select>
                    </div>
                    </div>
                    <div class="form-group">
                        <label for="ammo_name"><code style="color:#fff;">Ammo Name</code></label>
                        <input type="text" class="form-control" name="ammo_name" id="ammo_name"
                            value="<?php echo $row['ammo_name']; ?>" />
                            <input type="hidden" class="form-control" name="ammoID" id="ammoID"
                            value="<?php echo $row['ammoID']; ?>"/>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-6 col-form-label"><code style="color:#fff;">Ammunition Application</code></label>
                        <div class="col-sm-9">
                            <select name="ammo_application" class="form-control">
                            <option value="<?php echo $row['ammo_application']; ?>"> <?php echo $row['ammo_application']; ?></option>
                            <option value="Defensive">Defensive</option>
                            <option value="Hunting">Hunting</option>
                            <option value="Match-Grade">Match-Grade</option>
                            <option value="Practice">Practice</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                                <label class="col-sm-6 col-form-label"><code style="color:#fff;">Grain Weight </code></label>
                                <div class="col-sm-9">
                                  <select name="grain_weight" class="form-control">
                                    <option value="<?php echo $row['grain_weight']; ?>"><?php echo $row['grain_weight']; ?></option>
                                    <option value="40-Grain">40-Grain</option>
                                    <option value="55-Grain">55-Grain</option>
                                    <option value="60-Grain">60-Grain</option>
                                    <option value="70-Grain">70-Grain</option>        
                                    <option value="80-Grain">80-Grain</option>
                                    <option value="90-Grain">90-Grain</option>
                                    <option value="100-Grain">100-Grain</option>
                                    <option value="107-Grain">107-Grain</option>
                                    <option value="115-Grain">115-Grain</option>
                                    <option value="120-Grain">120-Grain</option>
                                    <option value="124-Grain">124-Grain</option>
                                    <option value="125-Grain">125-Grain</option>
                                    <option value="168-Grain">168-Grain</option>
                                    <option value="175-Grain">175-Grain</option>
                                    <option value="180-Grain">180-Grain</option>
                                    <option value="185-Grain">185-Grain</option>
                                    <option value="190-Grain">190-Grain</option>
                                    <option value="200-Grain">200-Grain</option>
                                    <option value="220-Grain">220-Grain</option>
                                    <option value="230-Grain">230-Grain</option>                          
                                  </select>
                                </div>
                              </div>
                    <div class="form-group">
                        <label><code style="color:#fff;">Quantity</code></label>
                        <input type="number" class="form-control" name="ammo_rounds" id="quantity" 
                         value="<?php echo $row['ammo_rounds']; ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label><code style="color:#fff;"> Ammo Image</code></label>
                        <input type="file" class="form-control" name="ammo_image" id="ammo_image" 
                         value="<?php echo $row['ammo_image']; ?>">
                        </div>
                    <!-- </div> -->
                    <!-- </div> -->
                    <div class="modal-footer">
                     <button type="submit" class="btn btn-inverse-success btn-fw" name="update-ammo">Update</button>
                      <button type="button" class="btn btn-inverse-danger  btn-fw" data-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- edit Asset/Weapon-->

<!-- Delete Weapon From Inventory -->
<div class="modal fade" id="delete-firearm-<?php echo $row['firearmID'];?>" data-backdrop="static" data-keyboard="false"
    tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content"  >
            <div class="modal-header" style="background-color:#EB1616 ;">
                <h4 class="modal-title" id="staticBackdropLabel">Delete Firearm</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p class="text-center">Are you sure you want to delete this Firearm ?</p>
                <h6 class="text-center">
                    
                    <div class="badge badge-outline-warning" role="progressbar" style="width: 100%"
                     aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                     <?php echo  $row['firearm_serial_no']; ?>&#160;<?php echo  $row['firearm_name'].' ('. $row['firearm_type'].')'; ?></div>
                   </div>
                </h6>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="feather icon-x"></i>
                        NO</button>
                  
                    <a href="delete?firearmID=<?php echo $row['firearmID']; ?>&adminID=<?php echo  $_SESSION['adminID']=$adminID; ?>
                    &armourer-admin-name=<?php echo $_SESSION['armourer_admin_name'] = $armourer_admin_name; ?>
                    &user-role=<?php echo  $_SESSION['user_role'] =  $user_role; ?>&firearm=<?php echo $row['firearm_serial_no'].' '.$row['firearm_name'].' ( '.$row['firearm_type'].' )'; ?>"
                     class="btn btn-danger"><i class="feather icon-trash-2"></i>YES</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- deleting weapon-->

<!-- Delete   BOOKING Ticket -->
<div class="modal fade" id="delete-booking-<?php echo $row['bookingID'];?>" data-backdrop="static" data-keyboard="false"
    tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content"  >
            <div class="modal-header" style="background-color:#EB1616 ;">
                <h4 class="modal-title" id="staticBackdropLabel">Delete Booking Ticket <?php echo $row['bookingCode'];?> </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p class="text-center">Are you sure you want to delete this Booking Ticket ?</p>
                <h6 class="text-center">
                    
                    <div class="badge badge-outline-warning" role="progressbar" style="width: 100%"
                     aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                     <?php echo 'Ticket '.$row['bookingCode'];?>
                     <br>
                     <br>
                     &#160;<?php echo  $row['firearm_name']; ?>
                    </div>
                   </div>
                </h6>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="feather icon-x"></i>
                        NO</button>
                    <a href="delete?bookingID=<?php echo $row['bookingID'];?>&adminID=<?php echo  $_SESSION['adminID']=$adminID; ?>
                    &armourer-admin-name=<?php echo $_SESSION['armourer_admin_name'] = $armourer_admin_name; ?>
                    &user-role=<?php echo  $_SESSION['user_role'] =  $user_role; ?>&booking-ticket=<?php echo $row['bookingID'].''.$row['officerID'].' ( '.$row['firearm_name'].' )'; ?>"
                     class="btn btn-danger"><i class="feather icon-trash-2"></i>YES</a>        
                </div>
            </div>
        </div>
    </div>
</div>
<!-- deleting booking ticket weapon -->


<!-- Modal  Returns -->
<div class="modal fade" id="returns-details-<?php echo $row['bookingID'];?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Ticket# <code><?php echo $row['bookingCode'];?></code></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <label><code style="color:#fff;"> Return:</code><code> <?php echo $row['returns'];?></code></label>
      <hr>
      <label><code style="color:#fff;"> Issued Date: <?php echo $row['booking_time'];?></code></label>
      <hr>
      <label><code style="color:#fff;"> Armourer / Issuing Officer: <?php echo $row['armourer_issuer'];?></code></label>
      <hr>
      <label><code style="color:#fff;"> To Officer: <?php echo $row['to_officer'];?></code></label>
      <hr>
      <label><code style="color:#fff;">Firearm Image</code></label>:
       <img src="assets/images/firearm_images/<?php echo $row['firearm_image'];?>" alt="">
      <hr>
      <label><code style="color:#fff;">Firearm Serial No.:<?php echo $row['firearm_serial_no'];?></code></label>
      <hr>
      <hr>
      <label><code style="color:#fff;">Firearm Name: <?php echo $row['firearm_name'];?></code></label> 
      <hr>   
      <label><code style="color:#fff;"> Quantity: <?php echo $row['quantity_issued'];?></code></label>
      <hr>
      <label><code style="color:#fff;">Firearm Class: <?php echo $row['firearm_class'];?></code></label>
      <hr>
      <label><code style="color:#fff;">Firearm State: <?php echo $row['firearm_state'];?></code></label>
      <hr>
      <label><code style="color:#fff;"> Duty Type: <?php echo $row['duty_type'];?></code></label>
      <hr>
      <label><code style="color:#fff;">DutyLocation: <?php echo $row['duty_location'];?></code></label>
      <hr>
      <label><code style="color:#fff;"> Exact Time/Date: <?php echo $row['datetime'];?></code></label>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!-- the end of returns  -->


<!-- Modal  Booking Details -->
<div class="modal fade" id="booking-details-<?php echo $row['bookingID'];?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Booking Ticket# <code><?php echo $row['bookingCode'];?></code></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <label><code style="color:#fff;"> Return:</code><code> <?php echo $row['returns'];?></code></label>
      <hr>
      <label><code style="color:#fff;"> Booking Date/Time: <?php echo $row['booking_time'];?></code></label>
      <hr>
      <label><code style="color:#fff;"> Returned Date/Time: <?php echo $row['returned_time'];?></code></label>
      <hr>
      <label><code style="color:#fff;"> Armourer / Issuing Officer: <?php echo $row['armourer_issuer'];?></code></label>
      <hr>
      <label><code style="color:#fff;"> To Officer: <?php echo $row['to_officer'];?></code></label>
      <hr>
      <label><code style="color:#fff;"> Firearm Name: <?php echo $row['firearm_name'];?></code></label>
      <hr>   
      <label><code style="color:#fff;"> Quantity: <?php echo $row['quantity_issued'];?></code></label>
      <hr>
      <label><code style="color:#fff;"> Firearm Class: <?php echo $row['firearm_class'];?></code></label>
      <hr>
      <label><code style="color:#fff;"> Firearm State: <?php echo $row['firearm_state'];?></code></label>
      <hr>
      <label><code style="color:#fff;"> No. Faulty Ammo(s): <?php echo $row['ammo_state'];?></code></label>
      <hr>
      <label><code style="color:#fff;"> Duty Type: <?php echo $row['duty_type'];?></code></label>
      <hr>
      <label><code style="color:#fff;"> Duty Location: <?php echo $row['duty_location'];?></code></label>
      <hr>
      <label><code style="color:#fff;"> Duty Duration: <?php echo $row['duty_duration'];?></code></label>
      <hr>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


<!-- Modal  Booking Details -->
<div class="modal fade" id="ammo-booking-details-<?php echo $row['book_ammoID'];?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Booking Ticket# <code><?php echo $row['bookingCode'];?></code></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <label><code style="color:#fff;"> Return:</code><code> <?php echo $row['ammo_returns'];?></code></label>
      <hr>
      <label><code style="color:#fff;"> Booking Date/Time: <?php echo $row['booking_time'];?></code></label>
      <hr>
      <label><code style="color:#fff;"> Returned Date/Time: <?php echo $row['returned_time'];?></code></label>
      <hr>
      <label><code style="color:#fff;"> Armourer / Issuing Officer: <?php echo $row['armourer_issuer'];?></code></label>
      <hr>
      <label><code style="color:#fff;"> To Officer: <?php echo $row['to_officer'];?></code></label>
      <hr>
      <label><code style="color:#fff;"> Ammo Name: <?php echo $row['ammo_name'];?></code></label>  
      <hr>   
      <label><code style="color:#fff;"> Ammo Rounds: <?php echo $row['ammo_rounds'];?></code></label>
      <hr>   
      <label><code style="color:#fff;"> Returned Rounds: <?php echo $row['ammo_returned'];?></code></label>
      <hr>
      <label><code style="color:#fff;"> Ammo State:  <?php echo $row['ammo_state'];?></code></label>
      <hr>
      <label><code style="color:#fff;"> No. Faulty Ammo(s): <?php echo $row['no_faulty_ammo'];?></code></label>
      <hr>
      <label><code style="color:#fff;"> Duty Type: <?php echo $row['duty_type'];?></code></label>
      <hr>
      <label><code style="color:#fff;"> Duty Location: <?php echo $row['duty_location'];?></code></label>
      <hr>
      <label><code style="color:#fff;"> Duty Duration: <?php echo $row['duty_duration'];?></code></label>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


<!-- Modal  Asset Booking Details -->
<div class="modal fade" id="asset-booking-details-<?php echo $row['bookAssetID'];?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Booking Ticket# <code><?php echo $row['bookingCode'];?></code></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <label><code style="color:#fff;"> Return:</code><code> <?php echo $row['asset_returns'];?></code></label>
      <hr>
      <label><code style="color:#fff;"> Booking Date/Time: <?php echo $row['booking_time'];?></code></label>
      <hr>
      <label><code style="color:#fff;"> Returned Date/Time: <?php echo $row['returned_time'];?></code></label>
      <hr>
      <label><code style="color:#fff;"> Armourer / Issuing Officer: <?php echo $row['armourer_issuer'];?></code></label>
      <hr>
      <label><code style="color:#fff;"> To Officer: <?php echo $row['to_officer'];?></code></label>
      <hr>
      <label><code style="color:#fff;"> Asset Name: <?php echo $row['asset_name'];?></code></label>
      <hr>   
      <label><code style="color:#fff;"> Asset Quantity: <?php echo $row['asset_quantity'];?></code></label>
      <hr>
      <label><code style="color:#fff;"> Asset State:  <?php echo $row['asset_state'];?></code></label>
      <hr>
      <label><code style="color:#fff;"> Duty Type: <?php echo $row['duty_type'];?></code></label>
      <hr>
      <label><code style="color:#fff;"> Duty Location: <?php echo $row['duty_location'];?></code></label>
      <hr>
      <label><code style="color:#fff;"> Duty Duration: <?php echo $row['duty_duration'];?></code></label>
     
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!-- Delete Ammunition From Inventory -->
<div class="modal fade" id="delete-ammo-<?php echo $row['ammoID'];?>" data-backdrop="static" data-keyboard="false"
    tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content"  >
            <div class="modal-header" style="background-color:#EB1616 ;">
                <h4 class="modal-title" id="staticBackdropLabel">Delete Asset/Weapon</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p class="text-center">Are you sure you want to delete this Ammunition ?</p>
                <h6 class="text-center">
                    
                    <div class="badge badge-outline-warning" role="progressbar" style="width: 100%"
                     aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                     <?php echo  $row['ammo_serial_no']; ?>&#160;<?php echo  $row['ammo_name'].' ('. $row['ammo_type'].')'; ?></div>
                   </div>
                </h6>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="feather icon-x"></i>
                        NO</button>
                    <a href="delete?ammoID=<?php echo $row['ammoID']; ?>&adminID=<?php echo  $_SESSION['adminID']=$adminID; ?>
                    &armourer-admin-name=<?php echo $_SESSION['armourer_admin_name'] = $armourer_admin_name; ?>
                    &user-role=<?php echo  $_SESSION['user_role'] =  $user_role; ?>&name-ammo=<?php echo $row['ammo_name'].'-'.$row['ammo_rounds'].' ( '.$row['ammo_type'].' )'; ?>"
                     class="btn btn-danger"><i class="feather icon-trash-2"></i>YES</a>  
                </div>
            </div>
        </div>
    </div>
</div>
<!-- deleting weapon-->

<!-- Delete Other Asset From Inventory -->
<div class="modal fade" id="delete-asset-<?php echo $row['assetID'];?>" data-backdrop="static" data-keyboard="false"
    tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content"  >
            <div class="modal-header" style="background-color:#EB1616 ;">
                <h4 class="modal-title" id="staticBackdropLabel">Delete Asset/Weapon</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p class="text-center">Are you sure you want to delete this Asset ?</p>
                <h6 class="text-center">
                    
                    <div class="badge badge-outline-warning" role="progressbar" style="width: 100%"
                     aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                     <?php echo  $row['asset_serial_no']; ?>&#160;<?php echo  $row['asset_name']; ?></div>
                   </div>
                </h6>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="feather icon-x"></i>
                        NO</button>
                    <a href="delete?assetID=<?php echo $row['assetID']; ?>&adminID=<?php echo  $_SESSION['adminID']=$adminID; ?>
                    &armourer-admin-name=<?php echo $_SESSION['armourer_admin_name'] = $armourer_admin_name; ?>
                    &user-role=<?php echo  $_SESSION['user_role'] =  $user_role; ?>&name-asset=<?php echo $row['asset_name'].' ( '.$row['asset_quantity'].' )'; ?>"
                     class="btn btn-danger"><i class="feather icon-trash-2"></i>YES</a> 
                </div>
            </div>
        </div>
    </div>
</div>
<!-- deleting weapon-->


<!-- Modal  Booking Ammo Details -->
<div class="modal fade" id="booking-ammo-details-<?php echo $row['book_ammoID'];?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Booking Ticket# <code><?php echo $row['bookingCode'];?></code></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <label><code style="color:#fff;"> Return:</code><code> <?php echo $row['ammo_returns'];?></code></label>
      <hr>
      <label><code style="color:#fff;"> Issued Date: <?php echo $row['booking_time'];?></code></label>
      <hr>
      <label><code style="color:#fff;"> Armourer / Issuing Officer: <?php echo $row['armourer_issuer'];?></code></label>
      <hr>
      <label><code style="color:#fff;"> To Officer: <?php echo $row['to_officer'];?></code></label>
      <hr>
      <label><code style="color:#fff;"> Ammunition Name: <?php echo $row['ammo_name'];?></code></label>
    
      <hr>   
      <label><code style="color:#fff;"> Quantity(Rounds): <?php echo $row['ammo_rounds'];?></code></label>

      <hr>
      <label><code style="color:#fff;"> Duty Type: <?php echo $row['duty_type'];?></code></label>
      <hr>
      <label><code style="color:#fff;"> Duty Location: <?php echo $row['duty_location'];?></code></label>
      <hr>
      <label><code style="color:#fff;"> Exact Time/Date: <?php echo $row['datetime'];?></code></label>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


<!-- Modal  Booking Asset Details -->
<div class="modal fade" id="booking-asset-details-<?php echo $row['bookAssetID'];?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Booking Ticket# <code><?php echo $row['bookingCode'];?></code></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <label><code style="color:#fff;"> Return:</code><code> <?php echo $row['asset_returns'];?></code></label>
      <hr>
      <label><code style="color:#fff;"> Issued Date: <?php echo $row['booking_time'];?></code></label>
      <hr>
      <label><code style="color:#fff;"> Armourer / Issuing Officer: <?php echo $row['armourer_issuer'];?></code></label>
      <hr>
      <label><code style="color:#fff;"> To Officer: <?php echo $row['to_officer'];?></code></label>
      <hr>
      <label><code style="color:#fff;"> Asset Name: <?php echo $row['asset_name'];?></code></label>
    
      <hr>   
      <label><code style="color:#fff;"> Quantity: <?php echo $row['asset_quantity'];?></code></label>

      <hr>
      <label><code style="color:#fff;"> Duty Type: <?php echo $row['duty_type'];?></code></label>
      <hr>
      <label><code style="color:#fff;"> Duty Location: <?php echo $row['duty_location'];?></code></label>
      <hr>
      <label><code style="color:#fff;"> Exact Time/Date: <?php echo $row['datetime'];?></code></label>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>








