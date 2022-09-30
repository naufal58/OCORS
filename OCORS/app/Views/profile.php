<div class="container-fluid" id="header">
            <div class="main">
                <div class="row">
                    <div class="col-md-4 mt-1">
                        <div class="card text-center sidebar" style="background-color: #1F1B1B;">
                            <div class="card-body">
                                <img src="<?php echo base_url('profpic')?>/<?php echo $tmpImg?>" class="rounded-circle" width="150">
                                <div class="mt-3">
                                    <h2 style="color: white;"><?php echo ucwords($tmpName) ?></h2>
                                    <br>
                                    <br>
                                    <a style="color: white; font-size: 20px;">Email : <?php echo $tmpEmail?></a>
                                    <br>
                                    <form action=<?php echo base_url('profile/change')?> method="post">
                                        <p>Change Password : </p>
                                        <?php if(session()->getFlashData('errors')):?>
                                            <div class="alert alert-danger" >
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
                                        <div class="form-group row">
                                            <label for="inputPassword" class="col col-form-label">Password :</label>
                                            <div class="col-sm-10">
                                                <input type="password" class="form-control" id="password" name='password' style="margin:0 30px">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputPassword" class="col col-form-label">Confirm Password :</label>
                                            <div class="col-sm-10">
                                                <input type="password" class="form-control" id="cpassword" name='cpassword'style="margin:0 30px">
                                            </div>
                                        </div>
                                            <!-- <div class="space">
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
                                            </div> -->
                                            <br>
                                            <input type="submit"  name="change" value="Change password">
                                    </form>
                                    <script>
                                        $(document).ready(function () {
                                            bsCustomFileInput.init()
                                            })
                                    </script>
                                    <form action="<?php echo base_url('profile/upload')?>" method="post"  enctype="multipart/form-data">
                                        <br>
                                        <br>
                                        <label for="picture">Profile Picture : </label><br>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="profpic" name='profpic' accept=".jpg,.jpeg,.png">
                                           <label class="custom-file-label" for="profpic">Choose file</label>
                                        </div>
                                        <br>
                                        <br>
                                        <input type="submit" name ='upload' value="Upload">
                                        <br>
                                        <br>
                                    </form>
                                    <!-- <br>
                                    <a style="color: white; font-size: 20px;">Phone Number : 123-45-789-101-112</a>
                                    <br>
                                    <a style="color: white; font-size: 20px;">Collection : Your Comics (5)</a>
                                    <br>
                                    <a style="color: white; font-size: 20px;">Address : Bogor, West Java, Indonesia</a> -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col md-8 mt-1">
                        <div class="card mb-3 content" style="background-color: #1F1B1B;">
                            <h1 class="m-3 pt-3" style="color: white; padding-left: 40px; padding-top: 40px;">Your Comics</h1>
                            <div class="card-body">
                                <div class="row">
                                    <?php foreach($mangas as $manga)
                                    {
                                        $src = base_url('img').'/'.$manga['coverImage'];
                                        $link = base_url('description').'/'.$manga['id'];
                                        echo <<<EOT
                                            <div class="col-sm-6 col-md-3 col-lg-2.5">
                                                <a href="$link" style="color: white; text-decoration: none">
                                                <div class="book-block">
                                                    <img class="book block-center img-responsive" style="width: 200px;" src="$src">
                                                    <br>
                                                    <br>
                                                    <p style="color: white;">{$manga["nama"]}</p>
                                                    
                                                    
                                                </div>
                                                </a>
                                            </div>
                                            EOT;
                                    }
                                    ?>
                                    <!-- <div class="col-sm-6 col-md-3 col-lg-2.5">
                                    <a href="#" style="color: white; text-decoration: none">
                                        <div class="book-block">
                                            
                                            <img class="block-center img-responsive" style="width: 200px;" src="img/8.png">
                                            <br>
                                            <br>
                                            <p style="color: white;">Kimetsu No Yaiba</p>
                                            
                                            
                                        </div>
                                        </a>
                                    </div>
                                    <div class="col-sm-6 col-md-3 col-lg-2.5">
                                    <a href="#" style="color: white; text-decoration: none">
                                        <div class="book-block">
                                        
                                            <img class="block-center img-responsive" style="width: 200px;" src="img/kaguya.png">
                                            <br>
                                            <br>
                                            <p style="color: white;">Kaguya-Sama</p>
                                            
                                            
                                        </div>
                                    </a>
                                    </div>
                                    <div class="col-sm-6 col-md-3 col-lg-2.5">
                                    <a href="#" style="color: white; text-decoration: none">
                                        <div class="book-block">
                                            
                                            <img class="block-center img-responsive" style="width: 200px;" src="img/Chainsaw.png">
                                            <br>
                                            <br>
                                            <p style="color: white;">Chainsaw Man</p>
                                            
                                            
                                        </div>
                                    </a>
                                    </div>
                                    <div class="col-sm-6 col-md-3 col-lg-2.5">
                                    <a href="#" style="color: white; text-decoration: none">
                                        <div class="book-block">
                                            
                                            <img class="block-center img-responsive" style="width: 200px;" src="img/one piece.png">
                                            <br>
                                            <br>
                                            <p style="color: white;">One Piece</p>
                                            
                                            
                                        </div>
                                    </a> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>