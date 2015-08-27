<!DOCTYPE html>
<html lang="en">
<head>
<title>komplain</title>
<meta charset="utf-8">
<link rel="stylesheet" href="<?php echo base_url(''); ?>css/style.css">
<link rel="stylesheet" href="<?php echo base_url(''); ?>css/form.css">
<script src="<?php echo base_url(''); ?>js/superfish.js"></script>
<script src="<?php echo base_url(''); ?>js/forms.js"></script>
<!--[if lt IE 9]>
<script src="js/html5shiv.js"></script>
<link rel="stylesheet" media="screen" href="css/ie.css">
<![endif]-->
</head>
<body>
<header>
  <div class="container_12">
    <div class="grid_12">
      <h1><a href="index.html"><img src="images/logo.png" alt=""></a></h1>
      <div class="menu_block">
        <nav>
          <ul class="sf-menu">
            <li><a href="<?php echo site_url('welcome/halamanpertama'); ?>">Home</a></li>
            <li class="current"><a href="">komplain</a></li>
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
    <div class="grid_12">
      <h3><span>Laporan Masalah</span></h3>
    </div>
    <div class="grid_5">
      <div class="map">
        <figure class="">
          <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3957.677468882686!2d112.79595199999999!3d-7.277492!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x51044ba3763232d%3A0x17bb3cab27d545be!2sPoliteknik+Perkapalan+Negeri+Surabaya!5e0!3m2!1sen!2sid!4v1425960566679" width="400" height="300" frameborder="0" style="border:0"></iframe>
        </figure>
        <p>Our free themes go without support services. Support services and special offers come with premium <span class="col1"><a href="#">website templates.</a></span></p>
        <p>If you need help in customization of this theme, hire guys from <span class="col1"><a href="#">Template Tuning</a></span> to do it for you.</p>
        Leave us comments with any ideas about free website templates. </div>
    </div>
    <div class="grid_6 prefix_1" align="right">
        <?php echo form_open('simpankomplain',array('id'=>'form')); ?>
            <input type="text" placeholder="Nama:" name="nama">
            <br>
            <br>
            <input type="tel" placeholder="Bagian:" name="bagian">
            <br class="clear">
            <br>
            <input type="tel" placeholder="Ruangan / Posisi:" name="ruangan">
            <br class="clear">
            <br>
            <input type="text" placeholder="E-mail:" name="email">
            <br class="clear">
            <br>
            <textarea name="permasalahan" placeholder="Permasalahan :"></textarea>
            <br class="clear">
            <br>
          <button class="green" type="submit" name="submit" value="submit">Laporkan !!</button><br>
      Marketing Department: <br>
      E-mail: <span class="col1"><a href="#">email@domain.com</a></span> <br>
      Phone: 1-518-312-4162 </div>
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