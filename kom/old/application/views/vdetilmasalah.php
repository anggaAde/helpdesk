<!DOCTYPE html>
<html lang="en">
<head>
<title>komplain</title>
<meta charset="utf-8">
<link rel="stylesheet" href="<?php echo base_url(''); ?>css/style.css">
<link rel="stylesheet" href="<?php echo base_url(''); ?>css/form.css">
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
            <li class="current"><a href="">detil masalah</a></li>
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
    <div class="grid_6 prefix_1">
        <?php echo form_open('simpankomplain/masalahselesai',array('id'=>'form')); 
        foreach ($detilmasalah as $detil)
        {
          $idmasalah = $detil->id;
          $nama = $detil->nama;
          $bagian = $detil->bagian;
          $ruangan = $detil->ruang;
          $email = $detil->email;
          $permasalahan = $detil->masalah;
          $action = $detil->action;
          $executor = $detil->executor;
        }
        ?>
            <input type="text" value="<?php echo $nama;?>" name="nama">
            <br>
            <br>
            <input type="tel" value="<?php echo $bagian;?>" name="bagian">
            <br class="clear">
            <br>
            <input type="tel" value="<?php echo $ruangan;?>" name="ruangan">
            <br class="clear">
            <br>
            <input type="text" value="<?php echo $email;?>" name="email">
            <br class="clear">
            <br>
            <textarea name="permasalahan"><?php echo $permasalahan;?></textarea>
            <br class="clear"><br>
              <select name="executor">
                <option value="">Savior Solver</option>
                <option value="kom01" <?php if($executor=="kom01"){echo "selected";} ?>>munir</option>
                <option value="kom02" <?php if($executor=="kom02"){echo "selected";} ?>>nur w</option>
                <option value="kom03" <?php if($executor=="kom03"){echo "selected";} ?>>angga</option>
                <option value="kom04" <?php if($executor=="kom04"){echo "selected";} ?>>irul</option>
                <option value="kom05" <?php if($executor=="kom05"){echo "selected";} ?>>moko</option>
              </select>
            <br class="clear"><br>
              <select name="action">
                <option value="">status pekerjaan</option>
                <option value="1" <?php if($action=="1"){echo "selected";} ?>>Selesai</option>
                <option value="2" <?php if($action=="2"){echo "selected";} ?>>dilanjut besok</option>
                <option value="3" <?php if($action=="3"){echo "selected";} ?>>tunggu sparepart</option>
                <option value="4" <?php if($action=="4"){echo "selected";} ?>>rusak total / tidak bisa di perbaiki</option>
              </select>
            <br class="clear"><br>
            <input type="hidden" name="idmasalah" value="<?php echo $idmasalah;?>">
            <input type="hidden" name="exeday" value="<?php echo date("y-m-d H:i:s");?>">
          <button type="submit" name="submit" value="submit" class="green">Update</button><br>
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