<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  
  <link href="<?=base_url('lib')?>/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
  <link href="<?=base_url('lib')?>/font-awesome/css/font-awesome.css" rel="stylesheet" />

  <link href="<?=base_url('css')?>/style.css" rel="stylesheet">
  <link href="<?=base_url('css')?>/style-responsive.css" rel="stylesheet">
</head>

<body>
  <section id="container">
    
    <!--header start-->
    <header class="header black-bg" style="background-color: #0E205F;">
      <div class="sidebar-toggle-box">
        <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Toggle Navigation"></div>
      </div>
     
      <a href="" class="logo"><b>OCORS</b></a>
     
      <div class="top-menu">
        <ul class="nav pull-right top-menu">
          <li><a class="logout" href="<?=base_url('logout')?>">Logout</a></li>
        </ul>
      </div>
    </header>
    <!--header end-->

    <!--sidebar start-->
    <aside>
      <div id="sidebar" class="nav-collapse" style="background-color: black">
        <!-- sidebar menu start-->
        <ul class="sidebar-menu" id="nav-accordion">
          <p class="centered"><a href="<?= base_url('profile')?>"><img src="<?=base_url('profpic')?>/<?=$tmpImg?>" class="img-circle" width="80"></a></p>
          <h5 class="centered"><?= ucwords($tmpName)?></h5>
          <li class="sub-menu">
            <a href="<?=base_url('admin/manage')?>">
              <i class="fa fa-th"></i>
              <span>Manage Manga</span>
            </a>
          </li>
          <li class="sub-menu">
          
            <a class="active" href="<?=base_url('admin/upload')?>">
              <i class="fa fa-tasks"></i>
              <span><?=$text?> Manga</span>
            </a>
          </li>
        </ul>
        <!-- sidebar menu end-->
      </div>
    </aside>
    <!--sidebar end-->
    <!--main content start-->
    <section id="main-content">
      <section class="wrapper">
        <h3><i class="fa fa-angle-right"></i> <?=$text?> Manga</h3>
        <!-- BASIC FORM ELELEMNTS -->
        <div class="row mt">
          <div class="col-lg-12">
            <div class="form-panel" >
              <h4 class="mb"><i class="fa fa-angle-right"></i> <?=$text?></h4>

              <?php if($isEdit == 'required'):?>
              <form class="form-horizontal style-form" action="<?=base_url('admin/upload/save')?>" method="post"  put enctype="multipart/form-data" >
              <?php endif?>
              <?php if($isEdit != 'required'):?>
              <form class="form-horizontal style-form" action="<?=base_url('admin/manage/save/'.$id)?>" method="post"  put enctype="multipart/form-data" >
              <?php endif?>
                <div class="form-group">
                  <label class="col-sm-2 col-sm-2 control-label">Judul Manga</label>
                  <div class="col-sm-10">
                    <input type="text" id='judul' name='judul' class="form-control"  value="<?=$judul?>" required>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 col-sm-2 control-label">Harga Manga</label>
                  <div class="col-sm-10">
                    <input type="text"id='harga' name='harga' class="form-control" value="<?=$harga?>" required>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 col-sm-2 control-label">Genres Manga<br><p style="font-size:11px;"><i>Ex : Action,Drama,Historical</i></p></label>
                  <div class="col-sm-10">
                    <input type="text"id='genres' name='genres' class="form-control" value="<?=$genres?>" required>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 col-sm-2 control-label">Deskripsi Manga</label>
                  <div class="col-sm-10">
                    <textarea class="form-control form-control" id='deskripsi' name='deskripsi'style="height: 100px;" required><?=$deskripsi?></textarea>
                  </div>
                </div>
                <?php if($isEdit == 'required'):?>
                <div class="form-group">
                  <label class="col-sm-2 col-sm-2 control-label">File Manga<p style="font-size:11px;"><i>Zip structue : "chapterFolder/pageImage"<br>1/0001.png -> it means Chapter 1 page 1</i></p></label>
                  <div class="col-sm-10">
                    <div class="custom-file">
                      <input type="file" accept=".zip" class="custom-file-input" id="fileManga" name="fileManga" <?=$isEdit?>>
                      <label class="custom-file-label" for="fileManga" >Choose file</label>
                    </div>
                  </div>
                </div>
                <?php endif?>
                <div class="form-group">
                  <label class="col-sm-2 col-sm-2 control-label">Manga Cover Image</label>
                  <div class="col-sm-10">
                    <div class="custom-file">
                      <input type="file" accept=".jpg,.jpeg,.png" class="custom-file-input" id="coverImage" name="coverImage"<?=$isEdit?>>
                      <label class="custom-file-label" for="coverImage">Choose file</label>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-sm-10">
                    <input type="submit" class="button" style="font-size: 12px;">
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </section>
    </section>
  </section>
  
  <script src="<?=base_url('lib')?>/jquery/jquery.min.js"></script> 
  <script src="https://cdn.jsdelivr.net/npm/bs-custom-file-input/dist/bs-custom-file-input.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bs-custom-file-input/dist/bs-custom-file-input.min.js"></script>
  <script>
    $(document).ready(function () {
      bsCustomFileInput.init()
    });
  </script>
  <script src="<?=base_url('lib')?>/bootstrap/js/bootstrap.min.js"></script>
  

  <script src="<?=base_url('lib')?>/common-scripts.js"></script>
  

</body>

</html>
