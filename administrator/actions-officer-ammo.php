

 <!-- Returns Ammo  Modal -->
 <div class="modal fade" id="return-ammo-officer-<?php echo $row['book_ammoID'];?>" data-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
        <label for="exampleTextarea1"><code style="color:#fff;">Ammo Count/Returned</code></label>
        <input name="ammo_ammo_returned" id="ammo_returned" class="form-control" id="exampleTextarea1" rows="40">
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
        <input type="number" class="form-control" name="no_faulty_ammo" id="no_faulty_ammo" 
            placeholder="Number of Faulty Ammo">
        </div>
        <br>
        <div class="form-group">
        <label for="exampleTextarea1"><code style="color:#fff;">Comment</code></label>
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
        <button type="submit" class="btn btn-light btn-fw" name="returning-ammo-officer">Submit</button>
      </div>
      </form>
    </div>
  </div>
</div>
