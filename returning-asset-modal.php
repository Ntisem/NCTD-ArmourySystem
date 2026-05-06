
<!-- Returns Asset Modal -->
<div class="modal fade" id="return-asset-<?php echo $row['bookAssetID'];?>" 
           data-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background:orange;" >
        <h5 class="modal-title" id="exampleModalLabel" style="color:#000;">Booking Ticket-[GPSASB<?php echo $row['bookAssetID']; ?><?php echo $row['officerID']; ?>]</h5>     
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
        <h5 class="modal-title" id="exampleModalLabel"><code style="color:#fff;">Officer: 
        </code><code style="color:#fff;"><?php echo $row['to_officer']; ?></code></h5>
        <br>
        <h5 class="modal-title" id="exampleModalLabel"><code style="color:#fff;">Asset: 
        </code><code style="color:#fff;"><?php echo $row['asset_name'].' ['.$row['asset_quantity'].']' ?></code></h5>
        <br>
        <label for="returns" style="color:#fff;"><code style="color:#fff;">Asset Returning</code></label>
        <div class="col-sm-9">
        <select class="form-control" name="asset_returns">
        <option value="<?php echo $row['asset_returns']; ?>"><?php echo $row['asset_returns']; ?></option>
        <option value="Returned">Returning</option>
        <option value="Not-Return">Not Return</option>
        </select>
        </div> 
        <br>
        <div class="form-group">
        <label for="exampleTextarea1"><code style="color:#fff;">Quantity</code></label>
        <input name="asset_quantity" id="asset_quantity" class="form-control" id="exampleTextarea1" rows="40">
        </div>
        <br>
        <div class="form-group">
        <label for="returns"><code style="color:#fff;">Asset State</code></label>
        <div class="col-sm-9">
        <select class="form-control" name="asset_state">
        <option>None</option>
        <option value="Not-Faulty">Not Faulty</option>
        <option value="Faulty">Faulty</option>
        </select>
        </div> 
        <br>
        <div class="form-group">
        <label for="exampleTextarea1"><code style="color:#fff;">Comment</code></label>
        <textarea style="height:150px; background:#e1e4e8" name="asset_comment" id="comment" class="form-control" id="exampleTextarea1" rows="40"></textarea>
        </div>
        <input type="hidden" name="bookAssetID" value="<?php echo $row['bookAssetID']; ?>">
        <input type="hidden" name="officerID" value="<?php echo $row['officerID']; ?>">
        <input type="hidden" name="duty_type" value="<?php echo $row['duty_type']; ?>">
        <input type="hidden" name="duty_location" value="<?php echo $row['duty_location']; ?>">
        <input type="hidden" name="armourer_issuer" value="<?php echo $row['armourer_issuer']; ?>">
        <input type="hidden" name="booking_time" value="<?php echo $row['booking_time']; ?>">
        <input type="hidden" name="to_officer" value="<?php echo $row['to_officer']; ?>">
        <input type="hidden" name="officer_image" value="<?php echo $row['officer_image']; ?>">
        <input type="hidden" name="asset_name" value="<?php echo $row['asset_name']; ?>"> 
        <input type="hidden" name="assetID" value="<?php echo $row['assetID']; ?>">      
      </div>   
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger btn-fw" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-light btn-fw" name="returning-asset">Submit</button>
      </div>
      </form>
    </div>
  </div>
</div>
