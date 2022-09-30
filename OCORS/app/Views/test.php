<?php
  
  require_once("config.php");
  session_start();
  $loggedin = 0;
  if(isset($_SESSION["user"])) $loggedin = 1;

  $tmpImg = "profile.png";
  $tmpName = "Guest";
  $tmpPrivilege = '0';
  $popular = [];
  if($loggedin){
    // echo '<pre>';
    // var_dump($_SESSION["user"]);
    // echo '</pre>';
    $user = $_SESSION["user"];
    $tmpImg = $user['profileImg'];
    $tmpName = $user['username'];
    $tmpPrivilege = $user['privilege'];
  }
  
  
  $sql = "SELECT * from manga limit 10";
  if(isset($_GET['search'])){
    $search = filter_input(INPUT_GET,'search',FILTER_SANITIZE_STRING);
    $search = "'%".$search."%'";
    $sql = "SELECT * from manga WHERE nama LIKE {$search} limit 10";
  }

  if(isset($_GET['genre'])){
    $search = filter_input(INPUT_GET,'genre',FILTER_SANITIZE_STRING);
    $search = "'%".$search."%'";
    $sql = "SELECT * from manga WHERE genre LIKE {$search} limit 10";
  }
?>

<!DOCTYPE html>
<html lang = "en">
    <head>
      
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>OCORS</title>
        <link href="imG/logo.png" rel="shortcut icon"/>
        <link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;1,100;1,200;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">

        <!-- Bootstrap -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
        <link href="css/my.css" rel="stylesheet">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
      
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
  	  }
      </style>
    </head>
    <body>
      <nav class="navbar navbar-expand-lg navbar-dark">

        <a class="navbar-brand" href="index.php" style="color: white; font-size: 30px; font-family: Salsa; margin-left: 20px;">
            OCORS
        </a>
            
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
    
        <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
            <ul class="navbar-nav nav-pills nav-fill btn-group">
                <li class="nav-item">
                  <a href = "cart.php"><img src="img/cart.png" class="cart"></a>
                </li>
                <!--Jika sudah Login-->
                <?php if($loggedin == 1):?>
                  <?php if($tmpPrivilege == '3'):?>
                    <li class="nav-item active">
                      <a class="nav-link" href="#" style="color: white; font-family: Poppins">Admin Page <span class="sr-only">(current)</span></a>
                    </li>
                  <?php endif?>
                <li class="nav-item active">
                  <a class="nav-link" href="logout.php" style="color: white; font-family: Poppins">Logout <span class="sr-only">(current)</span></a>
                </li>
                <?php endif ?>
                <!--jika belum login tukar sama yg atas-->
                <?php if($loggedin == 0):?>
                <li class="nav-item active">
                  <a class="nav-link" href="login.php" style="color: white; font-family: Poppins">Login <span class="sr-only">(current)</span></a>
                </li>
               <li class="nav-item">
                  <a class="nav-link" href="registration.php" style="color: white; font-family: Poppins">Register</a>
                </li>
                <?php endif?>
            </ul>
        </div>
    
      </nav>
      <div id="top">
        <a href = "profile.php"><img  src="profpic/<?php echo $tmpImg?>" class="profile rounded-circle"></a>
        <p class="text-name"><?php echo ucwords($tmpName) ?></a>
        <div id="searchbox" class="container-fluid" style="width:112%; margin-left:-12%; margin-right:-6%">
          <div>
            <form action ="" role="search" method="GET">
              <input type="search"  name="search" class="searchbar" placeholder="Search for Manga , Manhwa Or Author">
            </form>
          </div>
        </div>
        <div class="container-fluid" id="header">
          <div class="row">
            <div class="col-md-3 col-lg-3" id="category">
              <div style="background:#FF0000; color:#fff; border-top-left-radius: 10px; border-top-right-radius: 10px; border:none; padding:15px; margin-top: 20px"> Genre </div>
                <ul style="border-bottom-left-radius: 10px; border-bottom-right-radius: 10px;">
                <?php $genres = [
                  "Action"
                  ,"Comedy"
                  ,"Drama"
                  ,"Ecchi"
                  ,"Fantasy"
                  ,"Harem"
                  ,"Historical"
                  ,'Horror'
                  ,'Isekai'
                  ,"Josei"
                  ,'Romance'
                  ,"School"
                  ,"Sci-fi"
                  ,"Seinen"
                  ,"Shoujo"
                  ,"Shounen"
                  ,"Slice of Life"
                  ,"Supernatural"
                ];
                  for($i = 0; $i<9; $i++){
                    echo "<li> <a href='index.php?genre=$genres[$i]' style='margin-left: 20px'> $genres[$i] </a> </li>";
                  }
                ?>
                  
                  <div class="more" id="more">
                  </div>
                  <a class='button' id="show-more" href = '#category' onclick='showMore()'>Show More</a>
                  <script>
                    let a = false;
                    function showMore(){
                      a = !a;
                      console.log(a);
                      if(a){
                        let b = `<?php
                            for($i = 9; $i<count($genres);$i++){
                              echo "<li> <a href='index.php?genre=$genres[$i]' style='margin-left: 20px'> $genres[$i] </a> </li>";
                            }
                          ?>`;
                        document.getElementById('more').innerHTML = b;
                        document.getElementById('show-more').innerHTML="Show Less";
                      }
                      else{
                        document.getElementById('more').innerHTML = "";
                        document.getElementById('show-more').innerHTML="Show More";
                      }
                    }
                    
                  </script>
                </ul>
            </div>
            <div class="col-md-6 col-lg-6">
              <div id="demo" class="carousel slide" data-ride="carousel">

                <!-- Indicators -->
                <ul class="carousel-indicators">
                  <li data-target="#demo" data-slide-to="0" class="active"></li>
                  <li data-target="#demo" data-slide-to="1"></li>
                  <li data-target="#demo" data-slide-to="2"></li>
                </ul>
                
                <!-- The slideshow -->
                <div class="carousel-inner">
                  <div class="carousel-item active">
                    <img src="img/1.jpg"  width="1000" height="450">
                  </div>
                  <div class="carousel-item">
                    <img src="img/4.jpg"  width="1000" height="450">
                  </div>
                  <div class="carousel-item">
                    <img src="img/6.jpg"  width="1000" height="450">
                  </div>
                </div>
                
                <!-- Left and right controls -->
                <a class="carousel-control-prev" href="#demo" data-slide="prev">
                  <span class="carousel-control-prev-icon"></span>
                </a>
                <a class="carousel-control-next" href="#demo" data-slide="next">
                  <span class="carousel-control-next-icon"></span>
                </a>
              </div>              
            </div>
              <div class="col-md-3 col-lg-3" id="category">
                <div style="background:#FF0000; color:#fff; border-top-left-radius: 10px; border-top-right-radius: 10px; border:none;padding:15px; margin-top: 20px"> Popular </div>
                  <ul style="border-bottom-left-radius: 10px; border-bottom-right-radius: 10px;" id="popular">
                    <?php 
                      $popular = $db->query("SELECT * FROM manga ORDER BY VISITED desc limit 10")->fetchAll();
                      foreach($popular as $isi)
                      {
                        echo <<<EOT
                        <li> <a href="description.php?manga={$isi['id']}" style="margin-left: 20px"> {$isi['nama']} </a> </li>
                        EOT;
                      }
                    ?>
                    <!-- <li> <a href="#" style="margin-left: 20px"> Yakusoku No Neverland </a> </li>
                    <li> <a href="#" style="margin-left: 20px"> Kaguya-Sama </a> </li>
                    <li> <a href="#" style="margin-left: 20px"> Kimetsu No Yaiba </a> </li>
                    <li> <a href="#" style="margin-left: 20px"> Attack On Titan </a> </li>
                    <li> <a href="#" style="margin-left: 20px"> Chainsaw Man </a> </li>
                    <li> <a href="#" style="margin-left: 20px"> Black Clover </a> </li>
                    <li> <a href="#" style="margin-left: 20px"> One Piece </a> </li>
                    <li> <a href="#" style="margin-left: 20px"> Boku No Hero Academia </a> </li>
                    <li> <a href="#" style="margin-left: 20px"> Jujutsu Kaise </a> </li>
                    <li> <a href="#" style="margin-left: 20px"> Tonikaku Kawaii </a> </li> -->
                  </ul>
              </div>
            </div>
          </div>
        </div>
        <div class="container-fluid text-center" id="new" style = "background-color: #1F1B1B; border-radius: 10px; margin-top: 70px; margin-bottom: 70px;">
          <div class="row" id="listManga">
            <?php $data = $db->query($sql);
              $data = $data->fetchAll();
              // var_dump($data);
              // var_dump($sql);
              if($data){
                foreach ($data as $isi) {
                  echo <<<EOT
                  <div class='col-sm-6 col-md-3 col-lg-2'>
                    <a href='description.php?manga={$isi['id']} ' style='color: white; text-decoration: none'>
                      <div class='book-block'>
                        <img class='book block-center img-responsive' style='width: 220px;' src="img/{$isi['coverImage']}">
                        <br>
                        <br>
                        {$isi['nama']} <br>
                        \${$isi['harga']}
                      </div>
                    </a>
                  </div>
                  EOT;
                }
              }
              else{
                echo "
                <div class='no-result'>
                  <p style='color:white;padding-top:50px'>No Result!</p>;
                </div>";
              }
          ?>
              <!-- <div class="col-sm-6 col-md-3 col-lg-2">
                <a href="#" style="color: white; text-decoration: none">
                  <div class="book-block">
                      
                      <img class="book block-center img-responsive" style="width: 220px;" src="img/7.png">
                      <br>
                      <br>
                      Jujutsu Kaisen <br>
                      $5
                      
                  </div>
                </a>
              </div>
              <div class="col-sm-6 col-md-3 col-lg-2">
                <a href="#" style="color: white; text-decoration: none">
                  <div class="book-block">
                      
                      <img class="block-center img-responsive" style="width: 220px;" src="img/8.png">
                      <br>
                      <br>
                      Kimetsu No Yaiba  <br>
                      $6
                      
                  </div>
                </a>
              </div>
              <div class="col-sm-6 col-md-3 col-lg-2">
                <a href="#" style="color: white; text-decoration: none">
                  <div class="book-block">
                     
                      <img class="block-center img-responsive" style="width: 220px;" src="img/kaguya.png">
                      <br>
                      <br>
                      Kaguya-Sama  <br>
                      $5,5
                      
                  </div>
                </a>
              </div>
              <div class="col-sm-6 col-md-3 col-lg-2">
                <a href="#" style="color: white; text-decoration: none">
                  <div class="book-block">
                      
                      <img class="block-center img-responsive" style="width: 220px;" src="img/Chainsaw.png">
                      <br>
                      <br>
                      Chainsaw Man  <br>
                      $5,4
                      
                  </div>
                </a>
              </div>
              <div class="col-sm-6 col-md-3 col-lg-2">
                <a href="#" style="color: white; text-decoration: none">
                  <div class="book-block">
                      
                      <img class="block-center img-responsive" style="width: 220px;" src="img/one piece.png">
                      <br>
                      <br>
                      One Piece  <br>
                      $5,4
                      
                  </div>
                </a>
              </div> -->
          </div>
      </div>
      <footer style="width:112%; margin-left:-12%; margin-right:-6%;">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-1 col-md-1 col-lg-1">
                </div>
                <div class="col-sm-7 col-md-5 col-lg-5">
                    <div class="row text-center">
                        <h2>Let's Get In Touch!</h2>
                        <hr class = "primary" style="color: black">
                        
                    </div>
                    <div class="row">
                        <div class="col-md-6 text-center">
                            <span class="glyphicon glyphicon-earphone"></span>
                            <p style="font-size: 20px;">123-456-6789</p>
                        </div>
                        <div class="col-md-6 text-center">
                            <span class="glyphicon glyphicon-envelope"></span>
                            <p style="font-size: 20px;">OCORS123@gmail.com</p>
                        </div>
                    </div>
                </div>
                <div class="hidden-sm-down col-md-2 col-lg-2">
                </div>
                <div class="col-sm-4 col-md-3 col-lg-3 text-center">
                    <h2 style="color: white;">Follow Us At</h2>
                    <hr style="color: black;">
                    <div>
                        <a href="#">
                        <img title="Twitter" alt="Twitter" src="img/twitter.png" width="35" height="35" />
                    </div>
                </div>
            </div>
        </div>
    </footer>
  </body>
</html>