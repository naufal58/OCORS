<?php
    // require_once("config.php");
    // session_start();
    // if(isset($_SESSION["user"])) header("Location:index.php");

?>

<html lang="en">
  <head>
    <meta charset="utf-8">
  
    <title>Log In</title>
    <meta name="viewport" content="initial-scale=1">
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">

    <link href="img/logo.png" rel="shortcut icon"/>
    <link rel="stylesheet" href="styles.css">
  
  </head>

  <body>
    <div class="wrapper">
        <div class="box_login">
          <form action="<?php echo base_url('login')?>/auth" method="POST">
            <span class="detail_login" style="text-align: center"><p>Login</p></span>
            <?php if(session()->getFlashdata('msg')):?>
                    <div class="alert alert-danger" style="color:white"><?= session()->getFlashdata('msg') ?></div>
            <?php endif;?>
                <div class="space" style="height: 7%;"></div>
                <div class="space">
                    <span class="detail_login">Username</span>
                    <div class="space"></div>
                    <div class="box_input">
                        <input type="text" id="username" name="username" class="custom_input" placeholder="Enter Username" size="24" maxlength= "16" required>
                    </div>
                </div>
                <div class="space"></div>
                <div class="space">
                    <span class="detail_login">Password</span>
                    <div class="space"></div>
                    <div class="box_input">
                      <input type="password" id="password" name="password" class="custom_input" placeholder="Enter Password" size="24" maxlength="16" required>
                    </div>
                </div>
                  <p style="color:white">Don't have an account yet? <a href="<?php echo base_url("register")?>" style="color:white;">Click here to register!</a></p>
                <div class="space" style="height: 15%"></div>
                <span class="detail_login" style="margin-left: 30%">
                  <input type="submit" class="btn_register" name="login"value="Login">
                </span>
                </div>
            </form>
        </div>
    </div>
  </body>