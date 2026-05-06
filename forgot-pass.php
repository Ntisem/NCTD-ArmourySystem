<?php


// Forgot Password 
if(isset($_POST["forgot_password_submit"])){
    $selector = bin2hex(random_bytes(8));
    $token = random_bytes(32);
    $url = "localhost/create-new-password.php?selector=".$selector."&validator=".bin2hex($token);
    $expires = date("U") + 1800;
    $forgot_email =$_POST['forgot_email'];
  
    $sql = "DELETE FROM passwordrest WHERE pwdResetEmail=?";
    $stmt = mysqli_stmt_init($connect_db);
    if(!mysqli_stmt_prepare($stmt, $sql)){
    if(!mysqli_stmt_prepare($stmt, $sql)){
      echo "Error occurred while connecting";
      echo $forgot_email;
      exit();
    }else{
      mysqli_stmt_bind_param($stmt, "s", $forgot_email);
      mysqli_stmt_execute($stmt);
    }
    $sql = "INSERT INTO passwordrest (pwdResetEmail,pwdResetSelector, pwdResetToken, pwdResetExpires) 
    VALUES (?,?,?,?)";
     if(!mysqli_stmt_prepare($stmt, $sql)){
       echo "There was an error when submitting input. Please try again";
       exit();
     }else{
       $hashedToken = password_hash($token, PASSWORD_DEFAULT);
       mysqli_stmt_bind_param($stmt, "ssss", $forgot_email,$selector,
       $hashedToken,$expires);
       mysqli_stmt_execute($stmt);
     }
     mysqli_stmt_close($stmt);
     mysqli_close($connect_db);
  
     $to = $forgot_email;
  
     $subject = "Reset your password";
  
     $message = '<p>We received a password reset request. 
     The link to reset your password is below. If you did not make 
     this request, you can ignore this email</p>';
  
     $message.= '<p>Here is your password reset link: </br>';
     $message.= "<a href='".$url."'>".$url."</a></p>";
  
     $headers = "from: GPD ARMOURER SYSTEM <williamntisem123@gmail.com>\r\n";
     $headers.= "Reply-To: <williamntisem123@gmail.com";
     $headers.= "content-type: text/html\r\n";
     
     mail($to, $subject, $message, $headers);
     header('location:forgot-password?reset=success');
  }else{
   header('location:login');
  }
  }
  
  if(isset($_POST["reset_password_submit"]))
  {
   $selector =$_POST["selector"];
   $validator = $_POST["validator"];
   $new_password = $_POST["new_password"];
   $confirm_password = $_POST["confirm_password"];
   if(empty($new_password) || empty($confirm_password)){
     // echo "Please fill in all fields";
     header("location: create-new-password");
     exit();
  
   }else if($new_password != $confirm_password){
   header("location: create-new-password");
   }
    $currentDate = date("U");
    $sql = "SELECT * FROM passwordrest WHERE pwdResetSelector=? 
    AND pwdResetExpires >=?";
     $stmt = mysqli_stmt_init($connect_db);
  
     if(!mysqli_stmt_prepare($stmt, $sql)){
       echo "There was an error during the processing of the query";
       exit();
     }else{
       mysqli_stmt_bind_param($stmt, "s", $selector);
       mysqli_stmt_execute($stmt);
       $result = mysqli_stmt_get_result($stmt);
  
       if(!$row = mysqli_fetch_assoc($result)){
         echo "You need to re-submit your request";
         exit();
       }
       else{
         $tokenBin = hex2bin($validator);
         $tokenCheck = password_verify($tokenBin, $row["pwdResetToken"]);
  
         if($tokenCheck === false){
           echo "You need to re-submit your request";
           exit();
         }
         elseif($tokenCheck === true){
           $tokenEmail = $row["pwdResetEmail"];
           $sql = "SELECT * FROM admin_lists WHERE email=?";
           $stmt = mysqli_stmt_init($connect_db);
  
           if(!mysqli_stmt_prepare($stmt, $sql)){
             echo "Error or Something went wrong";
             exit();
           }
           else{
             mysqli_stmt_bind_param($stmt, "s", $tokenEmail);
             mysqli_stmt_execute($stmt);
             $result = mysqli_stmt_get_result($stmt);
  
             if(!$row = mysqli_fetch_assoc($result)){
               echo "Error Occurred :)";
               exit();
             }
             else{
               $sql = "UPDATE admin_lists SET password=? WHERE email=?";
               $stmt = mysqli_stmt_init($connect_db);
  
               if(!mysqli_stmt_prepare($stmt, $sql)){
                 echo "Something went wrong";
                 exit();
               }
               else{
                 $newPwdHash = password_hash($new_password, PASSWORD_DEFAULT);
                 mysqli_stmt_bind_param($stmt, "ss", $newPwdHash, $tokenEmail);
                 mysqli_stmt_execute($stmt);
                 // header("location:login");
                 // exit();
                 $sql = "DELETE FROM passwordrest WHERE pwdResetEmail=?";
                 $stmt = mysqli_stmt_init($connect_db);
                 if(!mysqli_stmt_prepare($stmt, $sql)){
                   echo "There was an error trying to Update Password";
                   exit();
                 }else{
                   mysqli_stmt_bind_param($stmt, "s", $forgot_email);
                   mysqli_stmt_execute($stmt);
                  header("Location:login?new-password=passwordUpdated");
  
                 }
                 
               }
             }
           }
         }
       }
     }
  }else {
     header("location:login");
  }
  
  
?>