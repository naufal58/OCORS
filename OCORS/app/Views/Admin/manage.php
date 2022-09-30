<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  
  <link href="<?php echo base_url('lib').'/'.$css5?>" rel="stylesheet">

  <link href="<?php echo base_url('lib').'/'.$css6?>s" rel="stylesheet" />
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('lib').'/'.$css1?>" />
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('lib').'/'.$css2?>" />

  <link href="<?php echo base_url('css').'/'.$css3?>" rel="stylesheet">
  <link href="<?php echo base_url('css').'/'.$css4?>" rel="stylesheet">

  
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
            <a class="active" href="<?=base_url('admin/manage')?>">
              <i class="fa fa-th"></i>
              <span>Manage Manga</span>
            </a>
          </li>
          <li class="sub-menu">
          
            <a href="<?=base_url('admin/upload')?>">
              <i class="fa fa-tasks"></i>
              <span>Upload Manga</span>
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
        <h2><i class="fa fa-angle-right"></i> Manage Manga</h2>
        <div class="row mt">
          <div class="col-lg-12">
            <div class="form-panel" >
              <h3 class="mb"><i class="fa fa-angle-right"></i> Manage</h3>
              <div class="container">
                <table style="font-size: 15px;">
                  <tr>
                    <th>Judul Manga</th>
                    <th>Harga Manga</th>
                    <th colspan="2">Action</th>
                  </tr>
                  <?php foreach($mangas as $isi):?>
                  <tr>
                    <td><?=$isi['nama']?></td>
                    <td><?=$isi['harga']?></td>
                    <td><a href="<?=base_url("admin/manage/edit/{$isi['id']}")?>"><button class="button-edit">Edit</button></a></td>
                    <td><a href="<?=base_url("admin/manage/delete/{$isi['id']}")?>"><button id="delete" name="delete" class="button-delete">Delete</button></a></td>
                  </tr>
                  <?php endforeach?>
              </div>
            </div>
          </div>
        </div>
      </section>
    </section>
  </section>
  <!-- js placed at the end of the document so the pages load faster -->
  <script src="<?=base_url('lib')?>/jquery/jquery.min.js"></script>
  <script src="<?=base_url('lib')?>/bootstrap/js/bootstrap.min.js"></script>
  <script class="include" type="text/javascript" src="<?=base_url('lib')?>/jquery.dcjqaccordion.2.7.js"></script>
  <script src="<?=base_url('lib')?>/jquery.scrollTo.min.js"></script>
  <script src="<?=base_url('lib')?>/jquery.nicescroll.js" type="text/javascript"></script>
  <!--common script for all pages-->
  <script src="<?=base_url('lib')?>/common-scripts.js"></script>
  <!--script for this page-->
  <script src="<?=base_url('lib')?>/jquery-ui-1.9.2.custom.min.js"></script>
  <!--custom switch-->
  <script src="<?=base_url('lib')?>/bootstrap-switch.js"></script>
  <!--custom tagsinput-->
  <script src="<?=base_url('lib')?>/jquery.tagsinput.js"></script>
  <!--custom checkbox & radio-->
  <script type="text/javascript" src="<?=base_url('lib')?>/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
  <script type="text/javascript" src="<?=base_url('lib')?>/bootstrap-daterangepicker/date.js"></script>
  <script type="text/javascript" src="<?=base_url('lib')?>/bootstrap-daterangepicker/daterangepicker.js"></script>
  <script type="text/javascript" src="<?=base_url('lib')?>/bootstrap-inputmask/bootstrap-inputmask.min.js"></script>
  <script src="<?=base_url('lib')?>/form-component.js"></script>
</body>
</html>