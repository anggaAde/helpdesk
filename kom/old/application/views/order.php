<!DOCTYPE html>
<html lang="en">
<head>
<title>helpdesk IT PPNS</title>
<meta charset="utf-8">
<link rel="stylesheet" href="<?php echo base_url(''); ?>css/style.css">
<script src="<?php echo base_url(''); ?>js/jquery.js"></script>
<script src="<?php echo base_url(''); ?>js/jquery-migrate-1.1.1.js"></script>
<script src="<?php echo base_url(''); ?>js/superfish.js"></script>
<script src="<?php echo base_url(''); ?>js/jquery.equalheights.js"></script>
<script src="<?php echo base_url(''); ?>js/jquery.easing.1.3.js"></script>
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
            <li class="current"><a href="">Home</a></li>
            <li><a href="<?php echo site_url('welcome/listkerja'); ?>">List Kerja</a></li>
            <li><a href="<?php echo site_url('welcome/komplain'); ?>">Komplain</a></li>
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
    <div class="grid_5">
      <h3 class="head1">Menu Utama</h3>
      <ul class="list">
        <li>
          <div class="count">1</div>
          <div class="extra_wrapper">
            <div class="col3"><a href="<?php echo site_url('welcome/listkerja'); ?>">Urutan Antrian Pekerjaan. </a></div>
            Rerna is sed feugiat. Cras pulvinar lorem sagi isallvestibulumnisi nec gravida. </div>
        </li>
        <li>
          <div class="count">2</div>
          <div class="extra_wrapper">
            <div class="col3"><a href="<?php echo site_url('welcome/komplain'); ?>">Laporkan Masalah. </a></div>
            Rerna is sed feugiat. Cras pulvinar lorem sagi isallvestibulumnisi nec gravida. </div>
        </li>
      </ul>
      <h3 class="head1 h1">urutan kerja</h3>
      <?php
      foreach (array_slice($masalah, 0, 5) as $data)
      { ?>
        
      <ul class="list1 col3">
        <li><?php echo $data->nama; ?> <?php echo $data->bagian; ?></br><?php echo substr($data->masalah,0,50); ?></li>
      </ul>

      <?  
      }
      ?>
    </div>
    <div class="grid_6 prefix_1">
      <h3><span>Our Mission</span></h3>
      <p class="col3">Derto malice quis fermentum nisl tempus cometumylo. Geterna is sed nui feugiat. Cras pulvinar lorem sagi isallvestibulumnisi nec gravida merto maecnasturpis. In eget interdum dolor vermani lomito sanderilou.</p>
      Nulla fringilla nisi justo, et pulvinar metus eleifend vitae. Fusce quis orci commodom hendrerit quam quis, ullamcorper sem. Nulla gravida quam sed vehicula suscipite. Proin non ligula neque. Mauris porttitor vitae purus et pretium. Mauris ut viverrar amet tempus sapien. <br>
      <a href="#" class="btn">MORE</a>
      <h3 class="head2"><span>Meet our Work team</span></h3>
      <div class="team">
        <div class="grid_2"> <img src="<?php echo base_url(''); ?>images/page2_img1.jpg" alt="">
          <div class="col3"><a href="#">Irma Pool</a></div>
          Rerna is sed feugiat cras pulvinar lorem. </div>
        <div class="grid_2"> <img src="<?php echo base_url(''); ?>images/page2_img2.jpg" alt="">
          <div class="col3"><a href="#">Mark Johnson</a></div>
          Rerna is sed feugiat cras pulvinar lorem. </div>
        <div class="grid_2"> <img src="<?php echo base_url(''); ?>images/page2_img3.jpg" alt="">
          <div class="col3"><a href="#">David Kreinstein</a></div>
          Rerna is sed feugiat cras pulvinar lorem. </div>
        <div class="clear"></div>
        <div class="grid_2"> <img src="<?php echo base_url(''); ?>images/page2_img4.jpg" alt="">
          <div class="col3"><a href="#">Samantha Jackobs</a></div>
          Rerna is sed feugiat cras pulvinar lorem. </div>
        <div class="grid_2"> <img src="<?php echo base_url(''); ?>images/page2_img5.jpg" alt="">
          <div class="col3"><a href="#">Olivia Smith</a></div>
          Rerna is sed feugiat cras pulvinar lorem. </div>
      </div>
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