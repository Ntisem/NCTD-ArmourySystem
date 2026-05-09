
<!-- Updating faulty Assets or Weapon  -->
<div class="modal fade" id="edit-faulty-firearm-<?php echo $row['faulty_weaponID'];?>" data-backdrop="static" data-keyboard="false"
    tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" style="">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel" style="color: #fff;">Edit Faulty Firearm <code class="success3">[FFA<?php echo $row['faulty_weaponID'] ?>]</code></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" style="color: #fff;">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <form method="POST" action="functions.php" class="forms-sample" enctype="multipart/form-data">
                <input type="hidden" class="form-control" name="adminID" value="<?php echo  $_SESSION['adminID']=$adminID; ?>">
                <input type="hidden" class="form-control" name="armourer_admin_name" value="<?php echo $_SESSION['armourer_admin_name'] = $armourer_admin_name; ?>">
                <input type="hidden" class="form-control" name="user_role" value="<?php echo  $_SESSION['user_role'] =  $user_role; ?>">  
    
                <input type="hidden" class="form-control" name="faulty_weaponID" value="<?php echo $row['faulty_weaponID']; ?>">
                    <div class="form-group">
                        <label for="service_no"><code style="color:#fff;">Faulty Firearm Serial No.</code></label>
                        <input type="text" class="form-control" name="faulty_firearm_serial_no" id="faulty_firearm_serial_no"
                            value="<?php echo $row['faulty_firearm_serial_no']; ?>">
                    </div>
                    <!-- <div class="form-group">
                        <input type="hidden" name="faulty_firearm_status" class="form-control" id="exampleInputName1" value="<?php echo $row['faulty_firearm_status']; ?>">
                    </div> -->
                    <div class="form-group">
                        <label for="unit_dept"><code style="color:#fff;">Faulty Firearm Class</code></label>
                      <div class="col-sm-9">
                            <select class="form-control" name="faulty_firearm_class">
                            <option value="<?php echo $row['faulty_firearm_class']; ?>"><?php echo $row['faulty_firearm_class']; ?></option>
                            <option value="Duty Weapon">Duty Weapon</option>
                            <option value="Spare Weapon">Spare Weapon</option>
                            <option value="Training Weapon">Training Weapon</option>
                            </select>
                        </div> 
                    </div>
                    <div class="form-group">
                        <label for="fullname"><code style="color:#fff;">Faulty Firearm Type</code></label>
                        <input type="text" class="form-control" name="faulty_firearm_type" id="faulty_firearm_type"
                            value="<?php echo $row['faulty_firearm_type']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="faulty_firearm_name"><code style="color:#fff;">Faulty Firearm Name</code></label>
                        <input type="text" class="form-control" name="faulty_firearm_name" id="faulty_firearm_name"
                            value="<?php echo $row['faulty_firearm_name']; ?>" />
                    </div>                 
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="exampleInputEmail3"><code style="color:#fff"> Fault Type </code></label>
                          <input type="text" class="form-control" name="faulty_type" id="faulty_type" value="<?php echo $row['faulty_type']; ?>">
                        </div>     
                        </div> 
                        <div class="col-md-6"> 
                        <div class="form-group">
                        <label for="faulty_nature"><code style="color:#fff">Fault Nature</code></label>
                          <select name="faulty_nature" class="form-control">
                            <option value="<?php echo $row['faulty_nature']; ?>"><?php echo $row['faulty_nature']; ?></option>
                            <option value="Serviceable">Serviceable</option>
                            <option value="Unserviceable">Unserviceable</option>
                          </select>
                          </div> 
                        </div>   

                    <div class="form-group">
                        <label><code style="color:#fff;"> Faulty Firearm Image</code></label>
                        <input type="file" class="form-control" name="faulty_firearm_image" id="faulty_firearm_image" 
                         value="<?php echo $row['faulty_firearm_image']; ?>">
                   
                    </div>
                    <div class="form-group">
                    <label for="exampleTextarea1"><code style="color:#fff;">Comment</code></label>
                    <textarea style="height:150px; background:#e1e4e8" name="faulty_firearm_comment" id="comment" class="form-control" id="exampleTextarea1" rows="40" value="<?php echo $row['faulty_firearm_comment']; ?>"></textarea>
                    </div>
                    <!-- </div> -->
                    <div class="modal-footer">
                     <button type="submit" class="btn btn-inverse-success btn-fw" name="update-faulty-firearm">Update</button>
                      <button type="button" class="btn btn-inverse-danger  btn-fw" data-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- edit Asset/Weapon-->


<!-- Updating faulty Ammunition -->
<div class="modal fade" id="edit-faulty-ammo-<?php echo $row['faulty_ammoID'];?>" data-backdrop="static" data-keyboard="false"
    tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" style="">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel" style="color: #fff;">Edit Faulty Ammunition <code class="success3">[FAM<?php echo $row['faulty_ammoID'] ?>]</code></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" style="color: #fff;">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <form method="POST" action="functions.php" class="forms-sample" enctype="multipart/form-data">
                <input type="hidden" class="form-control" name="adminID" value="<?php echo  $_SESSION['adminID']=$adminID; ?>">
                <input type="hidden" class="form-control" name="armourer_admin_name" value="<?php echo $_SESSION['armourer_admin_name'] = $armourer_admin_name; ?>">
                <input type="hidden" class="form-control" name="user_role" value="<?php echo  $_SESSION['user_role'] =  $user_role; ?>">  
    
                <input type="hidden" class="form-control" name="faulty_ammoID" value="<?php echo $row['faulty_ammoID']; ?>">
                    
                   
                    <div class="form-group">
                        <label for="fullname"><code style="color:#fff;">Faulty Ammo Type</code></label>
                        <input type="text" class="form-control" name="faulty_ammo_type" id="faulty_ammo_type"
                            value="<?php echo $row['faulty_ammo_type']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="faulty_ammo_name"><code style="color:#fff;">Faulty Ammo Name</code></label>
                        <input type="text" class="form-control" name="faulty_ammo_name" id="faulty_ammo_name"
                            value="<?php echo $row['faulty_ammo_name']; ?>" placeholder="faulty_Ammo Name"/>
                    </div>    
                    <div class="form-group">
                        <label for="fullname"><code style="color:#fff;">Faulty Ammo Quantity</code></label>
                        <input type="text" class="form-control" name="faulty_ammo_quantity" id="faulty_ammo_quantity"
                            value="<?php echo $row['faulty_ammo_quantity']; ?>">
                    </div>             
                    <div class="col-md-6">
                    <div class="form-group">
                      <label for="exampleInputEmail3"><code style="color:#fff"> Fault Type </code></label>
                      <input type="text" class="form-control" name="faulty_type" id="faulty_type" value="<?php echo $row['faulty_type']; ?>">
                    </div>     
                    </div> 
                    <div class="form-group">
                        <label><code style="color:#fff;"> Faulty Ammo Image</code></label>
                        <input type="file" class="form-control" name="faulty_ammo_image" id="faulty_ammo_image" 
                         value="<?php echo $row['faulty_ammo_image']; ?>">
                    </div>
                    <div class="form-group">
                    <label for="exampleTextarea1"><code style="color:#fff;">Comment</code></label>
                    <textarea style="height:150px; background:#e1e4e8" name="faulty_ammo_comment" id="comment" class="form-control" id="exampleTextarea1" rows="40" value="<?php echo $row['faulty_ammo_comment']; ?>"></textarea>
                    </div>
                    <!-- </div> -->
                    <div class="modal-footer">
                     <button type="submit" class="btn btn-inverse-success btn-fw" name="update-faulty-ammo">Update</button>
                      <button type="button" class="btn btn-inverse-danger  btn-fw" data-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- edit Asset/Weapon-->



<!-- Updating faulty Ammunition -->
<div class="modal fade" id="edit-faulty-asset-<?php echo $row['faulty_assetID'];?>" data-backdrop="static" data-keyboard="false"
    tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" style="">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel" style="color: #fff;">Edit Faulty Asset<code class="success3">[FAS<?php echo $row['faulty_assetID'] ?>]</code></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" style="color: #fff;">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <form method="POST" action="functions.php" class="forms-sample" enctype="multipart/form-data">
                <input type="hidden" class="form-control" name="adminID" value="<?php echo  $_SESSION['adminID']=$adminID; ?>">
                <input type="hidden" class="form-control" name="armourer_admin_name" value="<?php echo $_SESSION['armourer_admin_name'] = $armourer_admin_name; ?>">
                <input type="hidden" class="form-control" name="user_role" value="<?php echo  $_SESSION['user_role'] =  $user_role; ?>">  
    
                <input type="hidden" class="form-control" name="faulty_assetID" value="<?php echo $row['faulty_assetID']; ?>">
                    <div class="form-group">
                        <label for="faulty_asset_name" ><code style="color:#fff;">Faulty Asset Name</code></label>
                        <input type="text" class="form-control" name="faulty_asset_name" id="faulty_asset_name"
                            value="<?php echo $row['faulty_asset_name']; ?>" placeholder="faulty_Asset Name"/>
                    </div>                 
                    <div class="form-group">
                        <label><code style="color:#fff;">Quantity</code></label>
                        <input type="number" class="form-control" name="faulty_asset_quantity" id="faulty_asset_quantity" 
                         value="<?php echo $row['faulty_asset_quantity']; ?>">
                   </div>
                   <div class="col-md-6">
                        <div class="form-group">
                          <label for="exampleInputEmail3"><code style="color:#fff"> Fault Type </code></label>
                          <input type="text" class="form-control" name="faulty_type" id="faulty_type" value="<?php echo $row['faulty_type']; ?>">
                        </div>     
                        </div> 
                        <div class="col-md-6"> 
                        <div class="form-group">
                        <label for="faulty_nature"><code style="color:#fff">Fault Nature</code></label>
                          <select name="faulty_nature" class="form-control">
                            <option value="<?php echo $row['faulty_nature']; ?>"><?php echo $row['faulty_nature']; ?></option>
                            <option value="Serviceable">Serviceable</option>
                            <option value="Unserviceable">Unserviceable</option>
                          </select>
                          </div> 
                        </div>   

                    <div class="form-group">
                        <label><code style="color:#fff;"> Faulty Asset Image</code></label>
                        <input type="file" class="form-control" name="faulty_asset_image" id="faulty_asset_image" 
                         value="<?php echo $row['faulty_asset_image']; ?>">
                   
                    </div>
                    <div class="form-group">
                    <label for="exampleTextarea1"><code style="color:#fff;">Comment</code></label>
                    <textarea style="height:150px; background:#e1e4e8" name="faulty_asset_comment" id="comment" class="form-control" id="exampleTextarea1" rows="40" value="<?php echo $row['faulty_asset_comment']; ?>"></textarea>
                    </div>
                    <!-- </div> -->
                    <div class="modal-footer">
                     <button type="submit" class="btn btn-inverse-success btn-fw" name="update-faulty-asset">Update</button>
                      <button type="button" class="btn btn-inverse-danger  btn-fw" data-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- edit Asset/Weapon-->


<!-- Delete Faulty Asset From -->
<div class="modal fade" id="delete-faulty-asset-<?php echo $row['faulty_assetID'];?>" data-backdrop="static" data-keyboard="false"
    tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content"  >
            <div class="modal-header" style="background-color:#EB1616 ;">
                <h4 class="modal-title" id="staticBackdropLabel">Delete Faulty Asset </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p class="text-center">Are you sure you want to delete this Faulty Asset ?</p>
                <h6 class="text-center">
                    
                    <div class="badge badge-outline-warning" role="progressbar" style="width: 100%"
                     aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                     <?php echo  $row['faulty_asset_name']; ?>&#160;<?php echo  $row['faulty_asset_quantity']; ?></div>
                   </div>
                </h6>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="feather icon-x"></i>
                        NO</button> 
                    <a href="delete?faulty-assetID=<?php echo $row['faulty_assetID']; ?>&adminID=<?php echo  $_SESSION['adminID']=$adminID; ?>
                    &armourer-admin-name=<?php echo $_SESSION['armourer_admin_name'] = $armourer_admin_name; ?>
                    &user-role=<?php echo  $_SESSION['user_role'] =  $user_role; ?>&faulty-asset=<?php echo $row['faulty_asset_name'].' ( '.$row['faulty_asset_quantity'].' )'; ?>"
                     class="btn btn-danger"><i class="feather icon-trash-2"></i>YES</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- deleting faulty Asset -->


<!-- Delete Faulty Ammo From -->
<div class="modal fade" id="delete-faulty-ammo-<?php echo $row['faulty_ammoID'];?>" data-backdrop="static" data-keyboard="false"
    tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content"  >
            <div class="modal-header" style="background-color:#EB1616 ;">
                <h4 class="modal-title" id="staticBackdropLabel">Delete Faulty Ammo </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p class="text-center">Are you sure you want to delete this Faulty Ammo ?</p>
                <h6 class="text-center">
                    
                    <div class="badge badge-outline-warning" role="progressbar" style="width: 100%"
                     aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                 <?php echo  $row['faulty_ammo_name']; ?>&#160;<?php echo  $row['faulty_ammo_quantity']; ?></div>
                   </div>
                </h6>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="feather icon-x"></i>
                        NO</button>
                   
                    <a href="delete?faulty-ammoID=<?php echo $row['faulty_ammoID']; ?>&adminID=<?php echo  $_SESSION['adminID']=$adminID; ?>
                    &armourer-admin-name=<?php echo $_SESSION['armourer_admin_name'] = $armourer_admin_name; ?>
                    &user-role=<?php echo  $_SESSION['user_role'] =  $user_role; ?>&faulty-ammo=<?php echo $row['faulty_ammo_name'].' '.$row['faulty_ammo_type'].' [ '.$row['faulty_ammo_quantity'].' ]'; ?>"
                     class="btn btn-danger"><i class="feather icon-trash-2"></i>YES</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- deleting faulty Ammo -->



<!-- Delete Faulty Firearm From -->
<div class="modal fade" id="delete-faulty-firearm-<?php echo $row['faulty_weaponID'];?>" data-backdrop="static" data-keyboard="false"
    tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content"  >
            <div class="modal-header" style="background-color:#EB1616 ;">
                <h4 class="modal-title" id="staticBackdropLabel">Delete Faulty Firearm </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p class="text-center">Are you sure you want to delete this Faulty Firearm ?</p>
                <h6 class="text-center">
                  <div class="badge badge-outline-warning" role="progressbar" style="width: 100%"
                     aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                     <?php echo  $row['faulty_firearm_serial_no']; ?>&#160;<?php echo  $row['faulty_firearm_name']; ?>
                     &#160;[ <?php echo  $row['faulty_firearm_type']; ?> ]
                    </div>
                   </div>
                </h6>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="feather icon-x"></i>
                        NO</button>
                    <a href="delete?faulty-weaponID=<?php echo $row['faulty_weaponID']; ?>&adminID=<?php echo  $_SESSION['adminID']=$adminID; ?>
                    &armourer-admin-name=<?php echo $_SESSION['armourer_admin_name'] = $armourer_admin_name; ?>
                    &user-role=<?php echo  $_SESSION['user_role'] =  $user_role; ?>&faulty-firearm=<?php echo $row['faulty_firearm_serial_no'].' '.$row['faulty_firearm_name'].' '.$row['faulty_firearm_type']; ?>" class="btn btn-danger"><i class="feather icon-trash-2"></i>YES</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- deleting faulty Firearm Ends-->
 
<!-- Delete Asset  BOOKING Ticket -->
<div class="modal fade" id="delete-booking-asset-<?php echo $row['bookAssetID'];?>" data-backdrop="static" data-keyboard="false"
    tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content"  >
            <div class="modal-header" style="background-color:#EB1616 ;">
                <h4 class="modal-title" id="staticBackdropLabel">Delete Asset Booking Ticket</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p class="text-center">Are you sure you want to delete this Asset Booking Ticket ?</p>
                <h6 class="text-center">
                    
                    <div class="badge badge-outline-warning" role="progressbar" style="width: 100%"
                     aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                     <?php echo 'Ticket-GPS-BookA'.$row['bookAssetID'].''. $row['officerID'].' '.$row['to_officer']; ?>
                     <br>
                     <br>
                     &#160;<?php echo  $row['asset_name'].' ( '.$row['asset_quantity'].' )' ?>
                    </div>
                   </div>
                </h6>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="feather icon-x"></i>
                        NO</button>
                    <?php $ticket = $row['to_officer'].' '.$row['asset_name'].' ( '.$row['asset_quantity'].' )'; ?>
                    <a href="delete?booked-assetID=<?php echo $row['bookAssetID'];?>&adminID=<?php echo  $_SESSION['adminID']=$adminID; ?>
                    &armourer-admin-name=<?php echo $_SESSION['armourer_admin_name'] = $armourer_admin_name;?>
                    &user-role=<?php echo  $_SESSION['user_role'] = $user_role; ?>&booked-asset-ticket=<?php echo $ticket;?>"
                     class="btn btn-danger"><i class="feather icon-trash-2"></i>YES</a>     
                </div>
            </div>
        </div>
    </div>
</div>
<!-- deleting booking ticket weapon -->
 

<!-- Delete ammo BOOKING Ticket -->
<div class="modal fade" id="delete-ammo-booking-<?php echo $row['book_ammoID'];?>" data-backdrop="static" data-keyboard="false"
    tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content"  >
            <div class="modal-header" style="background-color:#EB1616 ;">
                <h4 class="modal-title" id="staticBackdropLabel">Delete Ammo Booking Ticket</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p class="text-center">Are you sure you want to delete this Ammo Booking Ticket ?</p>
                <h6 class="text-center">
                    
                    <div class="badge badge-outline-warning" role="progressbar" style="width: 100%"
                     aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                     <?php echo 'Ticket-GPS-BookA'.$row['book_ammoID'].''. $row['officerID'].' '.$row['to_officer']; ?>
                     <br>
                     <br>
                     &#160;<?php echo  $row['ammo_name'].' ( '.$row['ammo_rounds'].' )' ?>
                    </div>
                   </div>
                </h6>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="feather icon-x"></i>
                        NO</button>
                    <?php $booking_ticket = $row['to_officer'].' '.$row['ammo_name'].' ( '.$row['ammo_rounds'].' )'; ?>
                    <a href="delete?booked-ammoID=<?php echo $row['book_ammoID'];?>&adminID=<?php echo  $_SESSION['adminID']=$adminID; ?>&armourer-admin-name=<?php echo $_SESSION['armourer_admin_name'] = $armourer_admin_name;?>&user-role=<?php echo  $_SESSION['user_role'] = $user_role; ?>&booked-ammo-ticket=<?php echo $booking_ticket;?>"
                     class="btn btn-danger"><i class="feather icon-trash-2"></i>YES</a>     
                </div>
            </div>
        </div>
    </div>
</div>
<!-- deleting ammo booking ticket ends -->



<!-- Returns Ammo  Modal -->
<div class="modal fade" id="return-ammo-<?php echo $row['book_ammoID'];?>" data-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background:orange;" >
        <h5 class="modal-title" id="exampleModalLabel" style="color:#000;">Booking Ticket-[GPSAMB<?php echo $row['book_ammoID']; ?><?php echo $row['officerID']; ?>]</h5>     
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form method="POST" action="functions.php" enctype="multipart/form-data">
      <input type="hidden" class="form-control" name="adminID" value="<?php echo  $_SESSION['adminID']=$adminID; ?>">
        <input type="hidden" class="form-control" name="armourer_admin_name" value="<?php echo $_SESSION['armourer_admin_name'] = $armourer_admin_name; ?>">
        <input type="hidden" class="form-control" name="user_role" value="<?php echo  $_SESSION['user_role'] =  $user_role; ?>">  

        <div class="form-group">
        <h5 class="modal-title" id="exampleModalLabel"><code style="color:#fff;">Officer: </code><code style="color:#fff;"><?php echo $row['to_officer']; ?></code></h5>
        <br>
        <h5 class="modal-title" id="exampleModalLabel"><code style="color:#fff;">Ammo: 
        </code><code style="color:#fff;"><?php echo $row['ammo_name'].' ['.$row['ammo_rounds'].']' ?></code></h5>
        <br>
        <label for="returns" style="color:#fff;"><code style="color:#fff;">Ammunition Returning</code></label>
        <div class="col-sm-9">
        <select class="form-control" name="ammo_returns">
        <option value="<?php echo $row['ammo_returns']; ?>"><?php echo $row['ammo_returns']; ?></option>
        <option value="Returned">Returning</option>
        <option value="Not-Return">Not Return</option>
        </select>
        </div> 
        <br>
        <div class="form-group">
        <label for="exampleTextarea1"><code style="color:#fff;">Ammunition Count/Returned</code></label>
        <input name="ammo_returned" id="ammo_returned" class="form-control" id="exampleTextarea1" rows="40">
        </div>
        <br>
        <div class="form-group">
        <label for="returns"><code style="color:#fff;">Ammo State</code></label>
        <div class="col-sm-9">
        <select class="form-control" name="ammo_state">
        <option>None</option>
        <option value="Not-Faulty">Not Faulty</option>
        <option value="Faulty">Faulty</option>
        </select>
        </div> 
        <br>
        <div class="form-group">
        <label><code style="color:#fff;"> No. Faulty Ammo(s) <code>If (Faulty)</code></label>
        <input type="number" class="form-control" name="ammo_returned" id="ammo_returned" 
            placeholder="Number of Faulty Ammo">
        </div>
        <br>
        <div class="form-group">
        <label for="exampleTextarea1"><code style="color:#fff;"> Comment</code> </label>
        <textarea style="height:150px; background:#e1e4e8" name="ammo_comment" id="comment" class="form-control" id="exampleTextarea1" rows="40"></textarea>
        </div>
        <input type="hidden" name="book_ammoID" value="<?php echo $row['book_ammoID']; ?>">
        <input type="hidden" name="officerID" value="<?php echo $row['officerID']; ?>">
        <input type="hidden" name="duty_type" value="<?php echo $row['duty_type']; ?>">
        <input type="hidden" name="duty_location" value="<?php echo $row['duty_location']; ?>">
        <input type="hidden" name="armourer_issuer" value="<?php echo $row['armourer_issuer']; ?>">
        <input type="hidden" name="booking_time" value="<?php echo $row['booking_time']; ?>">
        <input type="hidden" name="to_officer" value="<?php echo $row['to_officer']; ?>">
        <input type="hidden" name="officer_image" value="<?php echo $row['officer_image']; ?>">
        <input type="hidden" name="ammo_name" value="<?php echo $row['ammo_name']; ?>">    
        <input type="hidden" name="ammoID" value="<?php echo $row['ammoID']; ?>">       
      </div> 
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger btn-fw" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-light btn-fw" name="returning-ammo">Submit</button>
      </div>
      </form>
    </div>
  </div>
</div>
