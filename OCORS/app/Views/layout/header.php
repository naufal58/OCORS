<!DOCTYPE html>
<html lang = "en">
    <head>
      
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>OCORS</title>
        <link href="<?php echo base_url('img');?>/logo.png" rel="shortcut icon"/>
        <link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;1,100;1,200;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">

        <!-- Bootstrap -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
        <link href="<?php echo base_url('css');?>/<?php echo $css;?>" rel="stylesheet">
        <script src="https://polyfill.io/v3/polyfill.min.js?version=3.52.1&features=fetch"></script>
    <script src="https://js.stripe.com/v3/"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bs-custom-file-input/dist/bs-custom-file-input.min.js"></script>
      
      <style>
        @media(max-width:767px){
        #query_button {padding: 5px 20px;}
        .text-name{
          display: none;
        }
        .profile{
            width: 50px;
            height: 50px;
            margin-top: 22px;
            margin-left: 28px;
        }
        .searchbar{
            font-size: 15px;
        }
        .cart{
            margin: 0px;
        }
        .cart1{
            margin: 0px;
        }
  	  }
      </style>
    </head>
    <body>
      <nav class="navbar navbar-expand-lg navbar-dark">

        <a class="navbar-brand" href="<?php echo base_url('/');?>" style="color: white; font-size: 30px; font-family: Salsa; margin-left: 20px;">
            OCORS
        </a>
            
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
    
        <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
            <ul class="navbar-nav nav-pills nav-fill btn-group">
                <li class="nav-item">
                  <a href = "<?php echo base_url('cart');?>"><img src="<?php echo base_url('img');?>/cart.png" class="cart1"></a>
                </li>
                <!--Jika sudah Login-->
                <?php if($loggedin == 1):?>
                  <?php if($tmpPrivilege == '3'):?>
                    <li class="nav-item active">
                      <a class="nav-link" href="<?=base_url('admin')?>" style="color: white; font-family: Poppins">Admin Page <span class="sr-only">(current)</span></a>
                    </li>
                  <?php endif?>
                <li class="nav-item active">
                  <a class="nav-link" href="<?php echo base_url('logout');?>" style="color: white; font-family: Poppins">Logout <span class="sr-only">(current)</span></a>
                </li>
                <?php endif ?>
                <!--jika belum login tukar sama yg atas-->
                <?php if($loggedin == 0):?>
                <li class="nav-item active">
                  <a class="nav-link" href="<?php echo base_url('login');?>" style="color: white; font-family: Poppins">Login <span class="sr-only">(current)</span></a>
                </li>
               <li class="nav-item">
                  <a class="nav-link" href="<?php echo base_url('register');?>" style="color: white; font-family: Poppins">Register</a>
                </li>
                <?php endif?>
            </ul>
        </div>
      </nav>




        <div id="top">
            <a href = "<?php echo base_url('profile');?>"><img  src="<?php echo base_url('profpic');?>/<?php echo $tmpImg?>" class="profile rounded-circle"></a>
            <p class="text-name"><?php echo ucwords($tmpName) ?></a>
            <div id="searchbox" class="container-fluid" style="width:112%; margin-left:-12%; margin-right:-6%">
                <div>
                    <form action ="<?php echo base_url('search')?>" role="search" method="GET">
                    <input type="search"  name="search" class="searchbar" placeholder="Search for Manga , Manhwa Or Author">
                    </form>
                </div>
            </div>

        </div>