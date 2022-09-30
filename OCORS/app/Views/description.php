<?php $this->extend('layout/template');?>


<?php $this->section('content');?>

<div class="container-fluid" id="new" style = "background-color: #1F1B1B; border-radius: 10px; margin-top: 70px; margin-bottom: 70px;">
            <div class="row">
            <div class='col-sm-3'>
                    <div class='row'>
                        <img class='book block-center img-responsive' style='margin: 45px 35px 45px 35px;' src='<?php echo base_url('img')?>/<?php echo $data['coverImage']?>'>
                    </div>
                </div>
                <div class='col-sm-8' style='color: white;'>
                    <h1 style="padding-top: 35px; padding-bottom: 20px; padding-left: 30px; font-family: 'Poppins';"><?php echo $data['nama']?></h1>
                    <h6 style="font-family:'Poppins'; font-weight: 200 ; padding-left: 30px;">
                        <?php 
                            foreach($genres as $genre){
                                $base = base_url('genre');
                                echo "<a href='$base?genre=$genre' style='color: white;text-decoration:none'>$genre </a>";
                            }
                            echo "<br><br><span>Visited : {$data['visited']}</span>";
                        ?>
                    </h4>
                    <p style="font-size: 20px; font-family: 'Poppins';font-weight: 300; text-align: justify; margin-left: 30px;"><?php echo $data['deskripsi']?></p>
                    <?php if($tmpBought==0):?>
                    <?php echo anchor("cart/addtocart/{$id}",'<div class="button" style="text-align: center;text-decoration:none; margin-left: 30px;">Buy and Read <br> $5 </div>')?>
                    
                    <?php endif?>
                    <?php 
                        if($tmpBought == 1){
                            // $chapters = $db->query("SELECT chapters FROM mangaChapters where mangaId = {$_GET['manga']} limit 11")->fetchAll();
                            echo "<p style='margin-left:30px'>Chapters list :</p>";
                            foreach($chapters as $isi)
                            {
                                $link = base_url('read').'/'.$isi['mangaId'].'/'.$isi['chapters'];
                                echo <<<EOT
                                <ul style="padding-left: 50px">
                                <li> <a href="$link" style="padding-left: 20px;font-family:'Poppins';font-weight:200;color:white;text-decoration:none"> Chapter {$isi['chapters']} </a> </li>
                                </ul>
                                EOT;
                            }
                        }
                    ?>
                </div>
            </div>
        </div>

<?php $this->endSection();?>