

<?php
 session_start();
 define('URL' , 'http://localhost/php/theme/');
 require 'Authentication/config.php' ;
 if(isset($_SESSION['user_id'])){
  $worker_id = $_SESSION['user_id'];
 $select = $conn->query("SELECT status FROM worker where workerId = '$worker_id' ");
 $select->execute();
 $workerStauts = $select->fetchAll(PDO::FETCH_OBJ);
 }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>خدماتي | للخدمات المنزلية</title>
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="description" content="One page parallax responsive HTML Template">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">
  <!-- Favicon -->
  <link rel="shortcut icon" type="image/x-icon" href="../images/favicon.ico" />
  <!-- CSS
  ================================================== -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
  <!-- Themefisher Icon font -->
  <link rel="stylesheet" href="plugins/themefisher-font/style.css">
  <!-- bootstrap.min css -->
  <link rel="stylesheet" href="plugins/bootstrap/bootstrap.min.css">
  <!-- Lightbox.min css -->
  <link rel="stylesheet" href="plugins/lightbox2/css/lightbox.min.css">
  <!-- animation css -->
  <link rel="stylesheet" href="plugins/animate/animate.css">
  <!-- Slick Carousel -->
  <link rel="stylesheet" href="plugins/slick/slick.css">
  <!-- Main Stylesheet -->
  <link rel="stylesheet" href="css/style.css">

</head>
<body id="body">

  <!--
  Start Preloader
  ==================================== 
  <div id="preloader">
    <div class='preloader'>
      <span></span>
      <span></span>
      <span></span>
      <span></span>
      <span></span>
      <span></span>
    </div>
  </div>
  <!--
  End Preloader
  ==================================== -->
<!--ToTopButton
<a href="#" class="to-top">
  <i class="fa-solid fa-arrow-up"></i>
</a>
<!--ToTopButton-->
<!--
Fixed Navigation
==================================== -->
<header class="navigation fixed-top">
  <div class="container">
    <!-- main nav -->
    <nav class="navbar navbar-expand-lg navbar-light px-0">
      <!-- logo -->
      <a class="navbar-brand logo" href="index.html" data-aos="slide-down" data-aos-duration="1000">
        <img loading="lazy" class="logo-white" src="images/logo.png" alt="logo" />
      </a>
      <!-- /logo -->
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation"
        aria-controls="navigation" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>

      </button>

      <div class="collapse navbar-collapse" id="navigation" data-aos="slide-down" data-aos-duration="1000">
        <ul class="navbar-nav ml-auto text-center">

          <li class="nav-item active">
            <a class="nav-link" href="<?php echo URL; ?>" style="font-size: 17px; font-weight: 600;">الصفحة الرئيسية</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo URL; ?>Services/ourServices.php" style="font-size: 17px; font-weight: 600;">
              خدماتنا
            </a>
          </li>
    
          
         
          <li class="nav-item">
            <a class="nav-link" href="#US" style="font-size: 17px; font-weight: 600;">من نحن</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="contact.html" style="font-size: 17px; font-weight: 600;">تواصل معنا</a>
          </li>
          <?php if(isset($_SESSION['user_name']) AND isset($_SESSION['user_type'])  AND $_SESSION['user_type'] == 'client'): ?>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#!" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <?php echo $_SESSION['user_name'];?>
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <li><a class="dropdown-item" href="<?php echo URL; ?>Client/ClientProfile.php?id=<?php echo $_SESSION['user_id']; ?>" style="text-align: right;">الملف الشخصي</a></li>
              <li><a class="dropdown-item Logout" href="<?php echo URL; ?>Authentication/logout.php" style="text-align: right;">تسجيل خروج</a></li>
            </ul>
            <?php endif; ?>
          </li> 
          <?php if(isset($_SESSION['user_name']) AND isset($_SESSION['user_type']) AND  $_SESSION['user_type'] == 'worker'): ?>
            <li class="nav-item ">
            <a class="nav-link" href="<?php echo URL; ?>Worker/workerRequest.php" style="font-size: 17px; font-weight: 600;">انضم إلينا</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#!" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <?php echo $_SESSION['user_name'];?>
            </a>
            
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <php></php>
              <li><a class="dropdown-item" href="<?php echo URL; ?>Worker/workerProfile.php?id=<?php echo $_SESSION['user_id']; ?>" style="text-align: right;">الملف الشخصي</a></li>
              <li><a class="dropdown-item Logout" href="<?php echo URL; ?>Authentication/logout.php" style="text-align: right;">تسجيل خروج</a></li>
              </ul> 
              
              <?php endif;?>
          </li>
          <?php if(!isset($_SESSION['user_name'])): ?>
          <li class="nav-item" style="margin: auto;">
            <a class="" href="<?php echo  URL ?>Authentication/Login.php" style="font-size: 17px; font-weight: 600;">
            <button class="button" onclick=>
              تسجيل الدخول
            </button></a>

          </li>
          <?php endif ;?>
        </ul>
      </div>
    </nav>
    <!-- /main nav -->
  </div>
</header>

<!--
End Fixed Navigation
==================================== -->