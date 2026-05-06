           <footer class="footer">
               <div class="w-100 clearfix">
                   <span class="text-center text-sm-left d-md-inline-block"> Copyright &copy;<script>
                       document.write(new Date().getFullYear());
                       </script> All rights reserved |<span style="color: #f9a602;font-weight:600;"> <strong>Ghana Police Service | COUNTER TERRORISM DEPARTMENT </strong></span></span>
                   <span class="float-none float-sm-right mt-1 mt-sm-0 text-center"></span>
                   <div align="right">
                           Developed By:<a href="https://wonderlordgraphics.netlify.app/" target="_blank" style="color: #fff;font-weight:600;text-decoration:none">C/INSPR W. NTISEM</a>
                    </div>
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
                 <script src="assets/js/sweetalert.min.js"></script>
               <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="mdi mdi-arrow-up-bold"></i></a>
               <!-- <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>  -->
               <!-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script> -->
                <script src="jquery.bootstrap-growl.js"></script>
                <script src="assets/js/clock.js"></script>
                <?php
                if(isset($_SESSION['status']) && $_SESSION['status'] !=''){
                    ?>
                    <script>
                    swal({
                            title: "<?php echo $_SESSION['status'];?>",
                            // text: "You clicked the button!",
                            icon: "<?php echo $_SESSION['status_code'];?>",
                            button: "OK",
                        });
                </script>
                <?php
                unset($_SESSION['status']);
                }?>
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
