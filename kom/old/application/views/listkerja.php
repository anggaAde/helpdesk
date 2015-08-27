<!DOCTYPE html>
<html lang="en">
<head>
<title>helpdesk IT PPNS</title>
<meta charset="utf-8">
<link rel="stylesheet" href="<?php echo base_url(''); ?>css/style.css">
<!--[if lt IE 9]>
<script src="js/html5shiv.js"></script>
<link rel="stylesheet" media="screen" href="css/ie.css">
<![endif]-->
</head>
<body>
<header>
  <div class="container_12">
    <div class="grid_12">
      <h1><a href="index.html"><img src="<?php echo base_url(''); ?>images/logo.png" alt=""></a></h1>
      <div class="menu_block">
        <nav>
          <ul class="sf-menu">
            <li><a href="<?php echo site_url('welcome/halamanpertama'); ?>">Home</a></li>
            <li class="current"><a href="">List Kerja</a></li>
          </ul>
        </nav>
        <div class="clear"></div>
      </div>
      <div class="clear"></div>
    </div>
  </div>
</header>
<div class="content">
  <div class="container_12">
    <h3 class="head1 h1">list kerja</h3>
    <div class="grid_12" style="width:1000px;height:400px;overflow: scroll;">
      
      <?php
      foreach ($masalah as $data)
      { 
        $idMasalah = $data->id;
        ?>
        
      <ul class="list1 col3">
        <li><b><?php echo anchor('detilmasalah/index/'.$idMasalah.'',$data->nama.' ('.$data->bagian.')') ?></b></br><?php echo $data->masalah; ?></br> <?php echo $data->tanggal;?></br></br></li>
      </ul>

        <?  
      }
      ?>
    </div>
  </div>
</div>
<footer>
  <div class="container_12">
    <div class="grid_12">
      <div class="socials"> <a href="#"></a> <a href="#"></a> <a href="#"></a> <a href="#"></a> </div>
      <div class="copy"> Web Design &copy; 2045 | <a href="#">Privacy Policy</a> | Design by: <a href="http://www.templatemonster.com/">TemplateMonster.com</a> </div>
    </div>
  </div>
</footer>
</body>
</html>