<?php
//     require("config.php");
// session_start();
// if(isset($_SESSION["user"])) header("Location: index.php");

// if(isset($_POST['register'])){


//     if($_POST['password'] != $_POST['cpassword']){
//       echo '<script>alert("Password did not match! Please confirm your password again!")</script>';
//       echo "<script>document.location = 'registration.php' </script>";
//     }
//     else{

//       // filter data yang diinputkan
//       $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
//       // enkripsi password
//       $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
//       $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
//       $profileImg = "profile.png";

//       // menyiapkan query
//       $sql = "SELECT * FROM users WHERE username='{$username}' or email='$email' limit 1";
//       $duplicate = $db->query($sql);
//       if($duplicate->fetch() != NULL){
//         echo '<script>alert("Username or Email already exists!")</script>';
//         echo "<script>document.location = 'registration.php' </script>";
//       }
//       else{
//         // // menyiapkan query
//         $sql = "INSERT INTO users (username, email, password,profileImg,privilege) 
//                 VALUES (:username, :email, :password,:profileImg,'1')";
//         $stmt = $db->prepare($sql);
        
//         // bind parameter ke query
//         $params = array(
//           ":username" => $username,
//           ":password" => $password,
//           ":email" => $email,
//           ":profileImg" => $profileImg
//         );
        
//         // eksekusi query untuk menyimpan ke database
//         $saved = $stmt->execute($params);
        
//         // // jika query simpan berhasil, maka user sudah terdaftar
//         // // maka alihkan ke halaman login
//         if($saved)
//         {
//           echo '<script>alert("You have been registered. Please Log in!")</script>';
//           // echo '<script>console.log("Test")</script>';
//           header("Location: login.php");
//         }
//       }
//     }
//   }
  ?>
<html lang="en">
  <head>
    <meta charset="utf-8">
  
    <title>Registration</title>
     <meta name="viewport" content="initial-scale=1">
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">

    <link href="img/logo.png" rel="shortcut icon"/>
    <link rel="stylesheet" href="styles.css">
  
  </head>
  
  <body>
    <div class="wrapper">
      <div class="box_registration">
        <form action="<?php echo base_url('register')?>/save" method="POST">
          <span class="detail_login">Registration</span>
          <?php if(session()->getFlashData('errors')):?>
                    <div class="alert alert-danger" style="color:white">
                    <?php
                      // dd($errors); 
                      $errors = [];
                      $errors = session()->getFlashData('errors');
                      foreach($errors as $error){
                        echo <<<EOT
                          $error
                          </br>
                        EOT;
                      }
                    ?>
                    </div>
          <?php endif;?>
          <!-- <div class="line"></div>  -->
          <div class="space"></div>
          <div class="space">
            <span class="detail_register">Username</span>
            <div class="box_input_registration">
              <input type="text" id="username" name="username" class="custom_input" placeholder="Enter Username" size="24" maxlength= "16" required>
            </div>
          </div>
          <div class="space">
            <span class="detail_register">Email</span>
            <div class="box_input_registration">
              <input type="email" id="email" name="email" class="custom_input" placeholder="Enter Email" size="24" required>
            </div>
          </div>
          <div class="space">
            <span class="detail_register">Password</span>
            <div class="box_input_registration">
              <input type="password" id="password" name="password" class="custom_input" placeholder="Enter Password" size="24" maxlength="16" required>
            </div>
          </div>
          <div class="space">
            <span class="detail_register">Confirm Password</span>
            <div class="box_input_registration">
              <input type="password" id="cpassword" name="cpassword" class="custom_input" placeholder="Confirm Your Password" size="24" maxlength="16" required>
            </div>
          </div>
          <div class="space" style="height: 7%"></div>
          <p style="color:white">Do you already have an account? <a href="<?php echo base_url("login")?>" style="color:white;">Click here to login!</a></p>
          <span class="detail_register" style="margin-left: 40%">
            <input type="submit" class="btn_register" name="register" value="Register">
          </span>
          </div>
        </form>
      </div>
  </body>
</html>