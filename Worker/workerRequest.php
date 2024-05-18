<?php 
session_start();
 require '../Authentication/config.php' ;
 define('URL' , 'http://localhost/php/theme/');
?>

<?php

 


// chack if the worker login
if(!isset($_SESSION['user_name'])){
  header('location:'.URL.'Authentication/Login.php?message=يجب عليك تسجيل الدخول لامكانية لتقديم خدمة ');
  exit();
} 
if($_SESSION['user_type'] == 'client'){
  header('location:'.URL.'index.php');
  exit();
}
 $worker_id = $_SESSION['user_id'];
 $select = $conn->query("SELECT * FROM worker where workerId = '$worker_id' ");
 $select->execute();
 if($select->rowCount()>0){
      header("location:".URL."index.php?Unauthorized=1");
      exit();
 }

    //script for inserting the data into worker table
    if(isset($_POST['submit'])){
        //check if inputs are empty or not
            if(empty( $_POST['fullname']) AND empty($_POST['email']) AND empty($_POST['location']) AND empty($_POST['experience'])AND empty($_POST['servertype']) AND empty($_POST['phone']) ){
                header("location:workerRequest.php?error= *الرجاء تعبئة جميع المتطلبات ");
                exit();
            }else{
                    //create var to store the input data 
                    $workerId = $_SESSION['user_id'];
                    $name = $_SESSION['user_name']; 
                    $fullname = $_POST['fullname'];
                    $email = $_POST['email'];
                    $location = $_POST['location'] ;
                    $age = $_POST['age'];
                    $experience = $_POST['experience'];
                    $servicetype = $_POST['servertype'];
                    $Phone = $_POST['phone'];
                    $cv = $_FILES['cv']['name'];

                    //upload image name into the file
                    $img = $_FILES['img']['name'];
                    $fileTmpName = $_FILES['img']['tmp_name'];
                    $fileDestination = '../images/users_img/'.$img;
                    move_uploaded_file($fileTmpName , $fileDestination);

                    // query to insert data into worker table
                    $insert = $conn->prepare("INSERT INTO worker ( workerId ,name,fullname, email, Phone, age, img, cv , servicetype, experience, location) VALUES(
                    :workerId,:name, :fullname,:email, :Phone, :age ,:img, :cv ,:servicetype,:experience,  :location)");
                    $insert->execute([
                        ':workerId'=>$workerId,
                        ':name' => $name,
                        ':fullname'=>$fullname ,
                        ':email' => $email,
                        ':Phone' => $Phone,
                        ':age' => $age,
                        ':img' => $img,
                        ':cv'=>$cv ,
                        ':servicetype' => $servicetype,
                        ':experience' => $experience,
                        ':location' => $location,
                ]);
                header('location:requestMessage.html');
                exit();
              }
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
  <link rel="stylesheet" href="../plugins/themefisher-font/style.css">
  <!-- bootstrap.min css -->
  <link rel="stylesheet" href="../plugins/bootstrap/bootstrap.min.css">
  <!-- Lightbox.min css -->
  <link rel="stylesheet" href="../plugins/lightbox2/css/lightbox.min.css">
  <!-- animation css -->
  <link rel="stylesheet" href="../plugins/animate/animate.css">
  <!-- Slick Carousel -->
  <link rel="stylesheet" href="../plugins/slick/slick.css">
  <!-- Main Stylesheet -->
  <link rel="stylesheet" href="../css/style.css">

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
        <img loading="lazy" class="logo-white" src="../images/logo.png" alt="logo" />
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
            <a class="nav-link" href="<?php echo URL ;?>#US" style="font-size: 17px; font-weight: 600;">من نحن</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo URL ;?>contact.html" style="font-size: 17px; font-weight: 600;">تواصل معنا</a>
          </li>
          <?php if(isset($_SESSION['user_name']) AND isset($_SESSION['user_type'])  AND $_SESSION['user_type'] == 'client'): ?>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#!" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <?php echo $_SESSION['user_name'];?>
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <li><a class="dropdown-item" href="Client/ClientProfile.html" style="text-align: right;">الملف الشخصي</a></li>
              <li><a class="dropdown-item Logout" href="<?php echo URL; ?>Authentication/logout.php" style="text-align: right;">تسجيل خروج</a></li>
            </ul>
            <?php endif; ?>
          </li> 
          <?php if(isset($_SESSION['user_name']) AND isset($_SESSION['user_type']) AND  $_SESSION['user_type'] == 'worker'): ?>
            <li class="nav-item ">
            <a class="nav-link" href="<?php echo URL ;?>Worker/workerRequest.php?id=<?php  echo $_SESSION['user_id'];  ?>" style="font-size: 17px; font-weight: 600;">انضم إلينا</a>
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
<!--
Welcome Slider
==================================== -->

<section class="hero-area">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="block mt-4">

         <div class="text-center" data-aos="fade-in">

           <h2 class="text-center backk" data-aos="zoom-in-down" data-aos-duration="2000">انضم إلينا لتقدم خدمة</h2>
           <h3 class="text-center backk" data-aos="zoom-in-down" data-aos-duration="2000" data-aos-delay="250">لا تتردد في تقديم طلب  </h3>

           <a data-scroll href="#form" data-aos="slide-up" data-aos-duration="2000">
             <i class="fa-solid fa-chevron-down fa-beat"></i>
           </a>
         </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--start form-->
<div class="back" style="background-color: #000;">
<div class="container formForJoin" id="form"  style="padding-top: 50px;">
    <section class="container">
        <header>طلب انضمام لخدماتي</header>
        <form class="form" action="workerRequest.php" method="post" enctype="multipart/form-data">
        <?php if(isset($_GET['error'])): ?>
    <p style="color:red;"><?php echo $_GET['age'] ;?></p>
    <?php endif ; ?>
            <div class="input-box">
                <label>الاسم الثلاثي</label>
                <input required="" placeholder="مثال:محمد احمد العيسى  
                " type="text" name="fullname">
            </div>
            <div class="input-box">
                <label>البريد الإلكتروني</label>
                <input required="" placeholder="abc@gmail.com      " type="text" name="email">
            </div>
            <div class="input-box address">
                <div class="column">
                <!--needed-->
                <div class="select-box">
                  <select name="experience">
                    <option hidden="">الخبرة</option>
                    <option>ثلاث سنوات</option>
                    <option>اقل من ثلاث سنوات</option>
                    <option>خمس سنين وأكثر</option>       
                  </select>
                </div>
                <!--needed-->
              
              
              
              </div>
            </div>
            <div class="column">
                <div class="input-box">
                    <label>رقم الهاتف</label>
                    <input required="" placeholder="071-2345678" type="telephone" name="phone">
                </div>
                
                <div class="input-box">
                <label> العمر</label>
                <input required="" placeholder="ادخل عمرك" type="number" name="age">
                </div>
            </div>
        
        <div class="input-box address">
            <div class="column">
            <!--needed-->
            <div class="select-box">
            <select name="location">
                 <option value="عمان">عمان</option>
                <option value="مادبا">مادبا</option>
                <option value="اربد" >اربد</option>
                <option value="السلط" >السلط</option>
                <option value="العقبة" >العقبة</option>
                <option value="المفرق" >المفرق</option>
                <option value="عجلون" >عجلون</option>
                <option value="جرش" >جرش</option>
                <option value="الزرقاء" >الزرقاء</option>                                                                                        
            </select>
            </div>
            <!--needed-->
        <div class="select-box">
            <select name="servertype">
                <option hidden="">نوع الخدمة</option>
                <option>كهربائية</option>
                <option>السباكة</option>
                <option>الدهان</option>
                <option>النجارة</option>
            </select>
            </div>
            </div>
        </div>
        <div class="input-box address">
        <div class="column">
        <div class="input-box">
            <label>صورة شخصية</label>
            <input required="" type="file" name="img">
        </div>
        <div class="input-box">
            <label> ادخل cv </label>
            <input required="" type="file" name="cv">
        </div>
        </div>
        </div>
        <button type="submit" class="btn btn-primary " name="submit" >إرسال الطلب</button>
    </form>
    </section>
</div>
</div>            
<!--
Start Call To Action
==================================== -->
<section class="call-to-action section">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-xl-6 col-lg-8 text-center">
				<h2  data-aos="zoom-in-down" data-aos-duration="1000">تواصل معنا</h2>
        <p  data-aos="zoom-in-down" data-aos-duration="1000">نحن دائمًا هنا لمساعدتك! إذا كان لديك أي استفسارات، أسئلة، أو تحتاج إلى المساعدة بشأن منتجاتنا أو خدماتنا، فلا تتردد في التواصل معنا. يمكنك إرسال رسالة من هٌنا .</p>
				<a  data-aos="zoom-in-down" data-aos-duration="1000" href="/contact.html" class="btn btn-main">تواصل معنا</a>
			</div>
		</div> <!-- End row -->
	</div> <!-- End container -->
</section> <!-- End section -->

<section class="counter-wrapper section-sm">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-xl-6 col-lg-8 text-center">
				<div class="title">
					<h2  data-aos="zoom-in-down" data-aos-duration="1000">إحصائيات خدماتنا</h2>

				</div>
			</div>
		</div>
		<div class="row">
			<!-- first count item -->
			<div class="col-md-3 col-sm-6 col-xs-6 text-center ">
				<div class="counters-item">
					<img src="/images/plumber-svgrepo-com.svg" alt="" style="width: 20%;">
					<div>
						<span class="counter" data-count="10" data-aos="zoom-in-down" data-aos-duration="1000">0</span>
					</div>
					<h3>السباكة</h3>
				</div>
			</div>
			<!-- end first count item -->

			<!-- second count item -->
			<div class="col-md-3 col-sm-6 col-xs-6 text-center ">
				<div class="counters-item">
					<img src="/images/electrician-svgrepo-com.svg" alt=""style="width: 20%;">
					<div>
						<span class="counter" data-count="20" data-aos="zoom-in-down" data-aos-duration="1000">0</span>
					</div>
					<h3>الكهرباء</h3>
				</div>
			</div>
			<!-- end second count item -->

			<!-- third count item -->
			<div class="col-md-3 col-sm-6 col-xs-6 text-center ">
				<div class="counters-item">
					<img src="/images/carpenter-svgrepo-com.svg" alt=""style="width: 20%;">
					<div>
						<span class="counter" data-count="99" data-aos="zoom-in-down" data-aos-duration="1000">0</span>
					</div>
					<h3>النجارة</h3>

				</div>
			</div>
			<!-- end third count item -->

			<!-- fourth count item -->
			<div class="col-md-3 col-sm-6 col-xs-6 text-center ">
				<div class="counters-item kill-border">
					<img src="/images/painter-svgrepo-com.svg" alt=""style="width: 20%;">
					<div>
						<span class="counter" data-count="100" data-aos="zoom-in-down" data-aos-duration="1000">0</span>
					</div>
					<h3>الدهان</h3>
				</div>
			</div>
			<!-- end fourth count item -->
		</div> <!-- end row -->
	</div> <!-- end container -->
</section> <!-- end section -->

<footer id="footer" class="bg-one">
  <div class="top-footer">
    <div class="container">
      <div class="row justify-content-around">
        <div class="col-lg-3 col-md-6 text-center">
          <img src="../images/logo.png" alt="">
        </div>
        <div class="col-lg-4 col-md-6 mb-5 mb-lg-0">
          <h3 class="text-center" >حول</h3>
          <p class="text-center" >
            خدماتي لتقديم الخدمات المنزلية مثل خدمات السباكو والخدمات الكهربائية والعديد من الخدمات الأخرى
          </p>
        </div>
        <!-- End of .col-sm-3 -->

        <!-- End of .col-sm-3 -->

        <div class="col-lg-2 col-md-6 mb-5 mb-md-0">
          <ul>
            <li>
              <h3 class="text-center" >روابط</h3>
            </li>
            <li class="text-center" ><a href="../Services/ourServices.html">الخدمات</a></li>
            <li class="text-center" ><a href="../Services/ourServices.html">قدم خدمة</a></li>
            <li class="text-center" ><a href="../Services/ourServices.html">اطلب خدمة</a></li>
          </ul>
        </div>
        <!-- End of .col-sm-3 -->

        <div class="col-lg-3 col-md-6">
          <ul>
            <li>
              <h3 class="text-center" style="text-align: right;">حساباتنا على مواقع التواصل الإجتماعي</h3>
            </li>
            <li style="text-align: center;"><a href="https://www.facebook.com//">فيسبوك</a></li>
            <li style="text-align: center;"><a href="https://www.twitter.com//">تويتر</a></li>
            <li style="text-align: center;"><a href="https://www.instagram.com//">انستغرام</a></li>
          </ul>
        </div>

        <!-- End of .col-sm-3 -->

      </div>
    </div> <!-- end container -->
  </div>

</footer> <!-- end footer -->


<!-- end Footer Area
========================================== -->

<!--
    Essential Scripts
    =====================================-->
<!-- Main jQuery -->
<script src="../plugins/jquery/jquery.min.js"></script>

<!-- Bootstrap4 -->
<script src="../plugins/bootstrap/bootstrap.min.js"></script>
<!-- Parallax -->
<script src="../plugins/parallax/jquery.parallax-1.1.3.js"></script>
<!-- lightbox -->
<script src="../plugins/lightbox2/js/lightbox.min.js"></script>
<!-- Owl Carousel -->
<script src="../plugins/slick/slick.min.js"></script>
<!-- filter -->
<script src="../plugins/filterizr/jquery.filterizr.min.js"></script>
<!-- Smooth Scroll js -->
<script src="../plugins/smooth-scroll/smooth-scroll.min.js"></script>
<!-- Google Map -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCcABaamniA6OL5YvYSpB3pFMNrXwXnLwU"></script>
<script src="../plugins/google-map/gmap.js"></script>

<!-- Custom js -->
<script src="../js/script.js"></script>
<script src="https://unpkg.com/aos@next/dist/aos.js"></script>
<script>
  AOS.init();
</script>
<script src="       "></script>

</body>

</html>
