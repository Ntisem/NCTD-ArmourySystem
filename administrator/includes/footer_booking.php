           <footer class="footer">
               <div class="w-100 clearfix">
                   <span class="text-center text-sm-left d-md-inline-block"> Copyright &copy;<script>
                       document.write(new Date().getFullYear());
                       </script> All rights reserved |<span style="color: #f9a602;font-weight:600;"> <strong>Ghana Police Service</strong></span></span>
                   <span class="float-none float-sm-right mt-1 mt-sm-0 text-center"></span>
               </div>
           </footer>
           </div>
           </div>
      
              <div class="modal fade" id="add-faq" data-backdrop=" static" data-keyboard="false" tabindex="-1"
               aria-labelledby="staticBackdropLabel" aria-hidden="true">
               <div class="modal-dialog modal-lg">
                   <div class="modal-content" style="background-color: #183c46;">
                       <div class="modal-header">
                           <h5 class="modal-title" id="staticBackdropLabel" style="color: #fff;">Add New FAQ</h5>
                           <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                               <span aria-hidden="true" style="color: #fff;">&times;</span>
                           </button>
                       </div>
                       <div class="modal-body">
                           <form method="POST" action="functions.php" class="forms-sample">
                               <div class="form-group">
                                   <label for="question" style="color: #fff;font-size:large;">Question</label>
                                   <input type="text" class="form-control" name="question" id="question"
                                       placeholder="Question">
                               </div>
                               <div class="form-group">
                                   <label for="answer" style="color: #fff;font-size:large;">Answer</label>
                                   <textarea class="form-control" name="answer" id="answer" rows="8"></textarea>
                               </div>
                               <div class="modal-footer">
                                   <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                   <button type="submit" class="btn" style="background-color:#ffa600;color:#fff"
                                       name="faq-btn">Submit</button>
                               </div>
                           </form>
                       </div>
                   </div>
               </div>

                 <!-- Back to Top -->
               <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="mdi mdi-arrow-up-bold"></i></a>
               <!-- <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>  -->
               <!-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script> -->
                <script src="jquery.bootstrap-growl.js"></script>
                <script src="assets/js/clock.js"></script>
                <?php
                  $username = $_SESSION['username'];
                  $message = $_SESSION['status'];
                if(isset($_GET['login_success'])){
                    echo " <script type='text/javascript'>
                    $.bootstrapGrowl('Hi ".ucwords($username).", $message', {
                    ele: 'body', // which element to append to
                    type: 'success', // (null, 'info', 'danger', 'success')
                    offset: {from: 'top', amount: 50}, // 'top', or 'bottom'
                    align: 'right', // ('left', 'right', or 'center')
                    width: 330, // (integer, or 'auto')
                    height: 100,
                    delay: 8000, // Time while the message will be displayed. It's not equivalent to the *demo* timeOut!
                    allow_dismiss: true, // If true then will display a cross to close the popup.
                    stackup_spacing: 10 // spacing between consecutively stacked growls.
                    });
                </script>";
                }
                // if(!empty($_GET['InvestorID'])){
                //     echo " <script type='text/javascript'>
                //     $.bootstrapGrowl('Hi ".ucwords($username).", $message', {
                //     ele: 'body', // which element to append to
                //     type: 'success', // (null, 'info', 'danger', 'success')
                //     offset: {from: 'top', amount: 50}, // 'top', or 'bottom'
                //     align: 'right', // ('left', 'right', or 'center')
                //     width: 330, // (integer, or 'auto')
                //     height: 100,
                //     delay: 8000, // Time while the message will be displayed. It's not equivalent to the *demo* timeOut!
                //     allow_dismiss: true, // If true then will display a cross to close the popup.
                //     stackup_spacing: 10 // spacing between consecutively stacked growls.
                //     });
                // </script>";
                // }
                if(isset($_GET['phone_number_error'])){
                    echo " <script type='text/javascript'>
                    $.bootstrapGrowl('Phone Number already Exists :)', {
                    ele: 'body', // which element to append to
                    type: 'danger', // (null, 'info', 'danger', 'success')
                    offset: {from: 'top', amount: 50}, // 'top', or 'bottom'
                    align: 'right', // ('left', 'right', or 'center')
                    width: 350, // (integer, or 'auto')
                    height: 100,
                    delay: 10000, // Time while the message will be displayed. It's not equivalent to the *demo* timeOut!
                    allow_dismiss: true, // If true then will display a cross to close the popup.
                    stackup_spacing: 10 // spacing between consecutively stacked growls.
                    });
                </script>";
                }
                if(isset($_GET['phone_no_error'])){
                    echo " <script type='text/javascript'>
                    $.bootstrapGrowl('Phone Number already Exists :)', {
                    ele: 'body', // which element to append to
                    type: 'danger', // (null, 'info', 'danger', 'success')
                    offset: {from: 'top', amount: 50}, // 'top', or 'bottom'
                    align: 'right', // ('left', 'right', or 'center')
                    width: 350, // (integer, or 'auto')
                    height: 100,
                    delay: 10000, // Time while the message will be displayed. It's not equivalent to the *demo* timeOut!
                    allow_dismiss: true, // If true then will display a cross to close the popup.
                    stackup_spacing: 10 // spacing between consecutively stacked growls.
                    });
                </script>";
                }

                if(isset($_GET['ammo_number_error'])){
                    echo " <script type='text/javascript'>
                    $.bootstrapGrowl('Sorry, insufficient Ammunition available :)', {
                    ele: 'body', // which element to append to
                    type: 'danger', // (null, 'info', 'danger', 'success')
                    offset: {from: 'top', amount: 50}, // 'top', or 'bottom'
                    align: 'right', // ('left', 'right', or 'center')
                    width: 450, // (integer, or 'auto')
                    height: 100,
                    delay: 10000, // Time while the message will be displayed. It's not equivalent to the *demo* timeOut!
                    allow_dismiss: true, // If true then will display a cross to close the popup.
                    stackup_spacing: 10 // spacing between consecutively stacked growls.
                    });
                </script>";
                }
                
                if(isset($_GET['assetID_error'])){
                    echo " <script type='text/javascript'>
                    $.bootstrapGrowl('Asset already Exists :)', {
                    ele: 'body', // which element to append to
                    type: 'danger', // (null, 'info', 'danger', 'success')
                    offset: {from: 'top', amount: 50}, // 'top', or 'bottom'
                    align: 'right', // ('left', 'right', or 'center')
                    width: 350, // (integer, or 'auto')
                    height: 100,
                    delay: 10000, // Time while the message will be displayed. It's not equivalent to the *demo* timeOut!
                    allow_dismiss: true, // If true then will display a cross to close the popup.
                    stackup_spacing: 10 // spacing between consecutively stacked growls.
                    });
                </script>";
                }
                if(isset($_GET['image_exists_error'])){
                    echo " <script type='text/javascript'>
                    $.bootstrapGrowl('Image already Exists :)', {
                    ele: 'body', // which element to append to
                    type: 'danger', // (null, 'info', 'danger', 'success')
                    offset: {from: 'top', amount: 50}, // 'top', or 'bottom'
                    align: 'right', // ('left', 'right', or 'center')
                    width: 350, // (integer, or 'auto')
                    height: 100,
                    delay: 10000, // Time while the message will be displayed. It's not equivalent to the *demo* timeOut!
                    allow_dismiss: true, // If true then will display a cross to close the popup.
                    stackup_spacing: 10 // spacing between consecutively stacked growls.
                    });
                </script>";
                }    if(isset($_GET['upload_error'])){
                    echo " <script type='text/javascript'>
                    $.bootstrapGrowl('An error  occurred while uploading the file :)', {
                    ele: 'body', // which element to append to
                    type: 'danger', // (null, 'info', 'danger', 'success')
                    offset: {from: 'top', amount: 50}, // 'top', or 'bottom'
                    align: 'right', // ('left', 'right', or 'center')
                    width: 350, // (integer, or 'auto')
                    height: 100,
                    delay: 10000, // Time while the message will be displayed. It's not equivalent to the *demo* timeOut!
                    allow_dismiss: true, // If true then will display a cross to close the popup.
                    stackup_spacing: 10 // spacing between consecutively stacked growls.
                    });
                </script>";
                }
                if(isset($_GET['allow_error'])){
                    echo " <script type='text/javascript'>
                    $.bootstrapGrowl('There was an Error uploading the file :)', {
                    ele: 'body', // which element to append to
                    type: 'danger', // (null, 'info', 'danger', 'success')
                    offset: {from: 'top', amount: 50}, // 'top', or 'bottom'
                    align: 'right', // ('left', 'right', or 'center')
                    width: 330, // (integer, or 'auto')
                    height: 100,
                    delay: 10000, // Time while the message will be displayed. It's not equivalent to the *demo* timeOut!
                    allow_dismiss: true, // If true then will display a cross to close the popup.
                    stackup_spacing: 10 // spacing between consecutively stacked growls.
                    });
                </script>";
                }
                if(isset($_GET['type_error'])){
                    echo " <script type='text/javascript'>
                    $.bootstrapGrowl('Please you cannot upload this type of file :)', {
                    ele: 'body', // which element to append to
                    type: 'danger', // (null, 'info', 'danger', 'success')
                    offset: {from: 'top', amount: 50}, // 'top', or 'bottom'
                    align: 'right', // ('left', 'right', or 'center')
                    width: 300, // (integer, or 'auto')
                    height: 100,
                    delay: 10000, // Time while the message will be displayed. It's not equivalent to the *demo* timeOut!
                    allow_dismiss: true, // If true then will display a cross to close the popup.
                    stackup_spacing: 10 // spacing between consecutively stacked growls.
                    });
                </script>";
                }
                if(isset($_GET['size_error'])){
                    echo " <script type='text/javascript'>
                    $.bootstrapGrowl('The size of the file is big! Max-Size: less than 1MB/1000000KB :)', {
                    ele: 'body', // which element to append to
                    type: 'danger', // (null, 'info', 'danger', 'success')
                    offset: {from: 'top', amount: 50}, // 'top', or 'bottom'
                    align: 'right', // ('left', 'right', or 'center')
                    width: 350, // (integer, or 'auto')
                    height: 100,
                    delay: 10000, // Time while the message will be displayed. It's not equivalent to the *demo* timeOut!
                    allow_dismiss: true, // If true then will display a cross to close the popup.
                    stackup_spacing: 10 // spacing between consecutively stacked growls.
                    });
                </script>";
                }
                if(isset($_GET['blank_error'])){
                    echo " <script type='text/javascript'>
                    $.bootstrapGrowl('Please, Fill in the blank fields... :)', {
                    ele: 'body', // which element to append to
                    type: 'danger', // (null, 'info', 'danger', 'success')
                    offset: {from: 'top', amount: 50}, // 'top', or 'bottom'
                    align: 'right', // ('left', 'right', or 'center')
                    width: 300, // (integer, or 'auto')
                    height: 100,
                    delay: 10000, // Time while the message will be displayed. It's not equivalent to the *demo* timeOut!
                    allow_dismiss: true, // If true then will display a cross to close the popup.
                    stackup_spacing: 10 // spacing between consecutively stacked growls.
                    });
                </script>";
                }
                if(isset($_GET['add_error'])){
                    echo " <script type='text/javascript'>
                    $.bootstrapGrowl('Please, Something went wrong whiles submitting... :)', {
                    ele: 'body', // which element to append to
                    type: 'danger', // (null, 'info', 'danger', 'success')
                    offset: {from: 'top', amount: 50}, // 'top', or 'bottom'
                    align: 'right', // ('left', 'right', or 'center')
                    width: 400, // (integer, or 'auto')
                    height: 100,
                    delay: 10000, // Time while the message will be displayed. It's not equivalent to the *demo* timeOut!
                    allow_dismiss: true, // If true then will display a cross to close the popup.
                    stackup_spacing: 10 // spacing between consecutively stacked growls.
                    });
                </script>";
                }
                if(isset($_GET['images_error'])){
                    echo " <script type='text/javascript'>
                    $.bootstrapGrowl('Some of the Images, already Exists :)', {
                    ele: 'body', // which element to append to
                    type: 'danger', // (null, 'info', 'danger', 'success')
                    offset: {from: 'top', amount: 50}, // 'top', or 'bottom'
                    align: 'right', // ('left', 'right', or 'center')
                    width: 300, // (integer, or 'auto')
                    height: 100,
                    delay: 10000, // Time while the message will be displayed. It's not equivalent to the *demo* timeOut!
                    allow_dismiss: true, // If true then will display a cross to close the popup.
                    stackup_spacing: 10 // spacing between consecutively stacked growls.
                    });
                </script>";
                }
                if(isset($_GET['passwords_error'])){
                    echo " <script type='text/javascript'>
                    $.bootstrapGrowl('Passwords does not Match :)', {
                    ele: 'body', // which element to append to
                    type: 'danger', // (null, 'info', 'danger', 'success')
                    offset: {from: 'top', amount: 50}, // 'top', or 'bottom'
                    align: 'right', // ('left', 'right', or 'center')
                    width: 300, // (integer, or 'auto')
                    height: 100,
                    delay: 10000, // Time while the message will be displayed. It's not equivalent to the *demo* timeOut!
                    allow_dismiss: true, // If true then will display a cross to close the popup.
                    stackup_spacing: 10 // spacing between consecutively stacked growls.
                    });
                </script>";
                }
                if(isset($_GET['username_error'])){
                    echo " <script type='text/javascript'>
                    $.bootstrapGrowl('Username already exists :)', {
                    ele: 'body', // which element to append to
                    type: 'danger', // (null, 'info', 'danger', 'success')
                    offset: {from: 'top', amount: 50}, // 'top', or 'bottom'
                    align: 'right', // ('left', 'right', or 'center')
                    width: 270, // (integer, or 'auto')
                    height: 100,
                    delay: 10000, // Time while the message will be displayed. It's not equivalent to the *demo* timeOut!
                    allow_dismiss: true, // If true then will display a cross to close the popup.
                    stackup_spacing: 10 // spacing between consecutively stacked growls.
                    });
                </script>";
                }
                if(isset($_GET['email_error'])){
                    echo " <script type='text/javascript'>
                    $.bootstrapGrowl('Email already exists :)', {
                    ele: 'body', // which element to append to
                    type: 'danger', // (null, 'info', 'danger', 'success')
                    offset: {from: 'top', amount: 50}, // 'top', or 'bottom'
                    align: 'right', // ('left', 'right', or 'center')
                    width: 350, // (integer, or 'auto')
                    height: 100,
                    delay: 10000, // Time while the message will be displayed. It's not equivalent to the *demo* timeOut!
                    allow_dismiss: true, // If true then will display a cross to close the popup.
                    stackup_spacing: 10 // spacing between consecutively stacked growls.
                    });
                </script>";
                }
                if(isset($_GET['returning_error'])){
                    echo " <script type='text/javascript'>
                    $.bootstrapGrowl('Error Occurred when Returning :)', {
                    ele: 'body', // which element to append to
                    type: 'danger', // (null, 'info', 'danger', 'success')
                    offset: {from: 'top', amount: 50}, // 'top', or 'bottom'
                    align: 'right', // ('left', 'right', or 'center')
                    width: 350, // (integer, or 'auto')
                    height: 100,
                    delay: 10000, // Time while the message will be displayed. It's not equivalent to the *demo* timeOut!
                    allow_dismiss: true, // If true then will display a cross to close the popup.
                    stackup_spacing: 10 // spacing between consecutively stacked growls.
                    });
                </script>";
                }
                if(isset($_GET['register_success'])){
                    echo " <script type='text/javascript'>
                    $.bootstrapGrowl('Added successfully :)', {
                    ele: 'body', // which element to append to
                    type: 'success', // (null, 'info', 'danger', 'success')
                    offset: {from: 'top', amount: 50}, // 'top', or 'bottom'
                    align: 'right', // ('left', 'right', or 'center')
                    width: 300, // (integer, or 'auto')
                    height: 100,
                    delay: 10000, // Time while the message will be displayed. It's not equivalent to the *demo* timeOut!
                    allow_dismiss: true, // If true then will display a cross to close the popup.
                    stackup_spacing: 10 // spacing between consecutively stacked growls.
                    });
                </script>";
                }
                if(isset($_GET['return_success'])){
                    echo " <script type='text/javascript'>
                    $.bootstrapGrowl('Returned Successfully :)', {
                    ele: 'body', // which element to append to
                    type: 'success', // (null, 'info', 'danger', 'success')
                    offset: {from: 'top', amount: 50}, // 'top', or 'bottom'
                    align: 'right', // ('left', 'right', or 'center')
                    width: 300, // (integer, or 'auto')
                    height: 100,
                    delay: 10000, // Time while the message will be displayed. It's not equivalent to the *demo* timeOut!
                    allow_dismiss: true, // If true then will display a cross to close the popup.
                    stackup_spacing: 10 // spacing between consecutively stacked growls.
                    });
                </script>";
                }
              
                if(isset($_GET['add_success'])){
                    echo " <script type='text/javascript'>
                    $.bootstrapGrowl('Added successfully :)', {
                    ele: 'body', // which element to append to
                    type: 'success', // (null, 'info', 'danger', 'success')
                    offset: {from: 'top', amount: 50}, // 'top', or 'bottom'
                    align: 'right', // ('left', 'right', or 'center')
                    width: 350, // (integer, or 'auto')
                    height: 100,
                    delay: 10000, // Time while the message will be displayed. It's not equivalent to the *demo* timeOut!
                    allow_dismiss: true, // If true then will display a cross to close the popup.
                    stackup_spacing: 10 // spacing between consecutively stacked growls.
                    });
                </script>";
                }
                if(isset($_GET['update_success'])){
                    echo " <script type='text/javascript'>
                    $.bootstrapGrowl('Updated successfully :)', {
                    ele: 'body', // which element to append to
                    type: 'success', // (null, 'info', 'danger', 'success')
                    offset: {from: 'top', amount: 50}, // 'top', or 'bottom'
                    align: 'right', // ('left', 'right', or 'center')
                    width: 350, // (integer, or 'auto')
                    height: 100,
                    delay: 10000, // Time while the message will be displayed. It's not equivalent to the *demo* timeOut!
                    allow_dismiss: true, // If true then will display a cross to close the popup.
                    stackup_spacing: 10 // spacing between consecutively stacked growls.
                    });
                </script>";
                }
                if(isset($_GET['delete_success'])){
                    echo " <script type='text/javascript'>
                    $.bootstrapGrowl('Deleted successfully :)', {
                    ele: 'body', // which element to append to
                    type: 'success', // (null, 'info', 'danger', 'success')
                    offset: {from: 'top', amount: 50}, // 'top', or 'bottom'
                    align: 'right', // ('left', 'right', or 'center')
                    width: 350, // (integer, or 'auto')
                    height: 100,
                    delay: 10000, // Time while the message will be displayed. It's not equivalent to the *demo* timeOut!
                    allow_dismiss: true, // If true then will display a cross to close the popup.
                    stackup_spacing: 10 // spacing between consecutively stacked growls.
                    });
                </script>";
                }
                if(isset($_GET['serial_no_error'])){
                    echo " <script type='text/javascript'>
                    $.bootstrapGrowl('Serial Number Already Exists :)', {
                    ele: 'body', // which element to append to
                    type: 'danger', // (null, 'info', 'danger', 'success')
                    offset: {from: 'top', amount: 50}, // 'top', or 'bottom'
                    align: 'right', // ('left', 'right', or 'center')
                    width: 300, // (integer, or 'auto')
                    height: 100,
                    delay: 10000, // Time while the message will be displayed. It's not equivalent to the *demo* timeOut!
                    allow_dismiss: true, // If true then will display a cross to close the popup.
                    stackup_spacing: 10 // spacing between consecutively stacked growls.
                    });
                </script>";
                }
                if(isset($_GET['weapon_number_error'])){
                    echo " <script type='text/javascript'>
                    $.bootstrapGrowl('Weapon Number Already Exists  :)', {
                    ele: 'body', // which element to append to
                    type: 'danger', // (null, 'info', 'danger', 'success')
                    offset: {from: 'top', amount: 50}, // 'top', or 'bottom'
                    align: 'right', // ('left', 'right', or 'center')
                    width: 350, // (integer, or 'auto')
                    height: 100,
                    delay: 10000, // Time while the message will be displayed. It's not equivalent to the *demo* timeOut!
                    allow_dismiss: true, // If true then will display a cross to close the popup.
                    stackup_spacing: 10 // spacing between consecutively stacked growls.
                    });
                </script>";
                }
                if(isset($_GET['productID_error'])){
                    echo " <script type='text/javascript'>
                    $.bootstrapGrowl('Firearm Already Exists  :)', {
                    ele: 'body', // which element to append to
                    type: 'danger', // (null, 'info', 'danger', 'success')
                    offset: {from: 'top', amount: 50}, // 'top', or 'bottom'
                    align: 'right', // ('left', 'right', or 'center')
                    width: 300, // (integer, or 'auto')
                    height: 100,
                    delay: 10000, // Time while the message will be displayed. It's not equivalent to the *demo* timeOut!
                    allow_dismiss: true, // If true then will display a cross to close the popup.
                    stackup_spacing: 10 // spacing between consecutively stacked growls.
                    });
                </script>";
                }

                if(isset($_GET['submit_success'])){
                    echo " <script type='text/javascript'>
                    $.bootstrapGrowl('Submitted successfully :)', {
                    ele: 'body', // which element to append to
                    type: 'success', // (null, 'info', 'danger', 'success')
                    offset: {from: 'top', amount: 50}, // 'top', or 'bottom'
                    align: 'right', // ('left', 'right', or 'center')
                    width: 350, // (integer, or 'auto')
                    height: 100,
                    delay: 10000, // Time while the message will be displayed. It's not equivalent to the *demo* timeOut!
                    allow_dismiss: true, // If true then will display a cross to close the popup.
                    stackup_spacing: 10 // spacing between consecutively stacked growls.
                    });
                </script>";
                }

                     
                if(isset($_GET['update_error'])){
                    echo " <script type='text/javascript'>
                    $.bootstrapGrowl('Please, Something went wrong while Updating :)', {
                    ele: 'body', // which element to append to
                    type: 'danger', // (null, 'info', 'danger', 'success')
                    offset: {from: 'top', amount: 50}, // 'top', or 'bottom'
                    align: 'right', // ('left', 'right', or 'center')
                    width: 370, // (integer, or 'auto')
                    height: 100,
                    delay: 10000, // Time while the message will be displayed. It's not equivalent to the *demo* timeOut!
                    allow_dismiss: true, // If true then will display a cross to close the popup.
                    stackup_spacing: 10 // spacing between consecutively stacked growls.
                    });
                </script>";
                }
                
                if(isset($_GET['delete_error'])){
                    echo " <script type='text/javascript'>
                    $.bootstrapGrowl('Please, Something went wrong while deleting :)', {
                    ele: 'body', // which element to append to
                    type: 'danger', // (null, 'info', 'danger', 'success')
                    offset: {from: 'top', amount: 50}, // 'top', or 'bottom'
                    align: 'right', // ('left', 'right', or 'center')
                    width: 370, // (integer, or 'auto')
                    height: 100,
                    delay: 10000, // Time while the message will be displayed. It's not equivalent to the *demo* timeOut!
                    allow_dismiss: true, // If true then will display a cross to close the popup.
                    stackup_spacing: 10 // spacing between consecutively stacked growls.
                    });
                </script>";
                }
                ?>
                <script>
                setInterval(function(){
                    check_user();
                },2000);
                function check_user(){
                    jQuery.ajax({
                        url:'user_auth.php',
                        type:'post',
                        data:'type=ajax',
                        success:function(result){
                            if(result=='logout'){
                                window.location.href='logout';
                            }
                        }
                        
                    });
                }
                </script>
