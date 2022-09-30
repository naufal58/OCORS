<?php $this->extend('layout/template');?>


<?php $this->section('content');?>
<div class="container-fluid" id="header">
           <div class="row">
              <div class="col-md-3 col-lg-3" id="category">
                 <div style="background:#FF0000; color:#fff; border-top-left-radius: 10px; border-top-right-radius: 10px; border:none; padding:15px; margin-top: 20px"> Genre </div>
                 <ul style="border-bottom-left-radius: 10px; border-bottom-right-radius: 10px;">
                    <?php 
                       for($i = 0; $i<9; $i++){
                         echo "<li> <a href='/genre?genre=$genres[$i]' style='margin-left: 20px'> $genres[$i] </a> </li>";
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
                            echo "<li> <a href='/genre?genre=$genres[$i]' style='margin-left: 20px'> $genres[$i] </a> </li>";
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
                       foreach($popular as $isi)
                       {
                         echo <<<EOT
                         <li> <a href="description/{$isi['id']}" style="margin-left: 20px"> {$isi['nama']} </a> </li>
                         EOT;
                       }
                       ?>
                 </ul>
              </div>
           </div>
        </div>
     </div>
     <div class="container-fluid text-center" id="new" style = "background-color: #1F1B1B; border-radius: 10px; margin-top: 70px; margin-bottom: 70px;">
     <pre> 
         <h1 style="color:white;text-align:left">Manga List:</h1>
      </pre>
     <div class="row" id="listManga">
           <?php //$data = $db->query($sql);
            //   $data = $data->fetchAll();
            //   // var_dump($data);
            //   // var_dump($sql);
              if($data){
                foreach ($data as $isi) {
                  echo <<<EOT
                  <div class='col-sm-6 col-md-3 col-lg-2'>
                    <a href='description/{$isi['id']} ' style='color: white; text-decoration: none'>
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
        </div>

<?php $this->endSection();?>