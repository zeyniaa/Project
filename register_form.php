<?php
session_start();

@include 'config.php';

if(isset($_POST['submit'])){
 
   $user = mysqli_real_escape_string($conn, $_POST['user']);
   $plat = mysqli_real_escape_string($conn, $_POST['plat']);
   $pass = md5($_POST['password']);
   $cpass = md5($_POST['cpassword']);
   $user_type = $_POST['user_type'];

   $select = " SELECT * FROM user_form WHERE plat = '$plat' && password = '$pass' ";

   $result = mysqli_query($conn, $select);

   if(mysqli_num_rows($result) > 0){

      $error[] = 'user already exist!';
                                                                                                                                                                                       
   }else{

      if($pass != $cpass){
         $error[] = 'password not matched!';
      }else{
         $insert = "INSERT INTO user_form(user, plat, password, user_type) VALUES('$user','$plat','$pass','$user_type')";
         mysqli_query($conn, $insert);
         $_SESSION['success_message'] = "you have successfully registered!";
         header('location:login_form.php');
         exit();
      }
   }
};
?>

<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>register form</title>

      <!-- custom css file link  -->
      <link rel="stylesheet" href="css/style.css">

   </head>
   <body>
      
      <div class="form-container">

         <form action="" method="post">
            <h3>Register</h3>
            <?php
            if(isset($error)){
               foreach($error as $error){
                  echo '<span class="error-msg">'.$error.'</span>';
               };
            };
            ?>
            <input type="text" name="user" required placeholder="enter your username">
            <input type="text" name="plat" required placeholder="enter your plat number">
            <input type="password" name="password" required placeholder="enter your password">
            <input type="password" name="cpassword" required placeholder="confirm your password">
            <select name="user_type">
               <option value="user">user</option>
               <option value="admin">admin</option>
            </select>
            <input type="submit" name="submit" value="Register Now" class="form-btn">
            <p>already have an account? <a href="login_form.php">login now</a></p>
         </form>
      </div>
   </body>
</html>