<!DOCTYPE html>
<html lang="en">
<head>
<title>Web Design</title>
<meta charset="utf-8">
<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="css/form.css">
<link rel="stylesheet" href="css/camera.css">
</head>
<body class="page1">
<header>
  <div class="container_12">
    <div class="grid_12">
      <h1><a href="index.html"><img src="images/logo.png" alt=""></a></h1>
      <div class="menu_block">
        <nav>
          <ul class="sf-menu">
            <li class="current"><a href="index.html">Home</a></li>
            <li><a href="about.html">about</a></li>
            <li><a href="portfolio.html">Portfolio</a></li>
            <li><a href="clients.html">Clients</a></li>
            <li><a href="contacts.html">Contacts</a></li>
          </ul>
        </nav>
        <div class="clear"></div>
      </div>
      <div class="clear"></div>
    </div>
  </div>
</header>
<div class="slider_wrapper">
  <div id="camera_wrap" class="">
    <div data-src="images/slide.jpg"> </div>
    <div data-src="images/slide1.jpg"> </div>
    <div data-src="images/slide2.jpg"> </div>
  </div>
</div>
<div class="content">
  <div class="container_12">
    <div class="grid_12">
      <h2>WELCOME TO MY SITE WHERE YOU CAN FIND<span>A RANGE OF CREATIVE HIGH-QUALITY <span class="col1">DESIGNS</span> THAT CAN HELP YOUR BUSINESS FLOURISH.</span></h2>
    </div>
    <div class="grid_6 prefix_3" align="right">  
      <?php echo form_open('welcome/login',array('id' =>'form'));?>
      <input type="text" placeholder="Username :" name="username"></br></br><input type="text" placeholder="Password :" name="password"></br></br>
       <button class="green">Masuk</button>
    </div>
    <div class="grid_12">  
      <h3><span>SERVICES</span></h3>
    </div>
    <div class="grid_4">
      <div class="icon"> <img src="images/icon1.png" alt="">
        <div class="title">PLANNING</div>
        Fusce quis fermentum nisl. Ut tempus cometum urna is sed feugiat. Cras pulvinar lorem sagi isallvestibulumnisi nec gravida maecenas sit amet eros conr, convallis. </div>
    </div>
    <div class="grid_4">
      <div class="icon"> <img src="images/icon2.png" alt="">
        <div class="title">DESIGN</div>
        <span class="col1"><a href="#"> Find here</a></span> more information about this free template designed by TemplateMonster.com. Visit the category of premium <span class="col1"><a href="#">Design Website Templates</a></span> to get more themes of this kind. </div>
    </div>
    <div class="grid_4">
      <div class="icon"> <img src="images/icon3.png" alt="">
        <div class="title">DEVELOPMENT</div>
        Fusce quis fermentum nisl. Ut tempus cometum urna is sed feugiat. Cras pulvinar lorem sagi isallvestibulumnisi nec gravida maecenas sit amet eros conr, convallis. </div>
    </div>
    <div class="grid_12">
      <h3><span>Recent Works</span></h3>
    </div>
    <div class="clear"></div>
    <div class="works">
      <div class="grid_4"><a href="#"><img src="images/page1_img1.jpg" alt=""></a></div>
      <div class="grid_4"><a href="#"><img src="images/page1_img2.jpg" alt=""></a></div>
      <div class="grid_4"><a href="#"><img src="images/page1_img3.jpg" alt=""></a></div>
      <div class="clear"></div>
      <div class="grid_4"><a href="#"><img src="images/page1_img4.jpg" alt=""></a></div>
      <div class="grid_4"><a href="#"><img src="images/page1_img5.jpg" alt=""></a></div>
      <div class="grid_4"><a href="#"><img src="images/page1_img6.jpg" alt=""></a></div>
    </div>
    <div class="clear"></div>
    <div class="grid_12">
      <h3><span>Testimonials</span></h3>
    </div>
    <div class="grid_6">
      <blockquote> <img src="images/page1_img7.jpg" alt="" class="img_inner fleft">
        <div class="extra_wrapper">
          <p>“Lorem ipsum dolor sit amet, consecteturdiing elit. Ut sit amet lorem sit amet nunc mattisrt imperdiet ac sit amet dui.”</p>
          <span class="col2 upp">Lisa Smith </span> - client </div>
      </blockquote>
    </div>
    <div class="grid_6">
      <blockquote> <img src="images/page1_img8.jpg" alt="" class="img_inner fleft">
        <div class="extra_wrapper">
          <p>“Lorem ipsum dolor sit amet, consecteturdiing elit. Ut sit amet lorem sit amet nunc mattisrt imperdiet ac sit amet dui.”</p>
          <span class="col2 upp">James Bond </span> - client </div>
      </blockquote>
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