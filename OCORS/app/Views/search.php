
<?php $this->extend('layout/template');?>

<?php $this->section('content');?>
<div class="container-fluid text-center" id="new" style = "background-color: #1F1B1B; border-radius: 10px; margin-top: 70px; margin-bottom: 70px;">
     <pre> 
         <h1 style="color:white;text-align:left">Manga List:</h1>
         <h5 style="color:white;text-align:left"><?php echo $text ?></h1>
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