<?php 
session_start();
define('URL' , 'http://localhost/php/theme/');

ob_start();
require '../Authentication/config.php' ;

if($_SESSION['user_type'] === 'worker'){
  header('location:'.URL.'');
  exit();
}
 if(isset($_GET['id'])){
  //fetch user id 
  $id = $_GET['id'];
  //fetch info about the user 
  $select1 = $conn->query("SELECT * FROM user WHERE user_id = '$id' AND usertype = 'client' ");
  $select1->execute();
  $clients = $select1->fetch(PDO::FETCH_OBJ);

  //fetch the rating of the worker form rating table
  $ratings = $conn->query("SELECT * FROM ratings WHERE user_id = '$id'");
  $ratings->execute();
  $rating = $ratings->fetch(PDO::FETCH_OBJ);
  
  //fetch info about booking
  $select2 = $conn->query("SELECT worker.fullname , worker.Phone , worker.img , worker.rating , worker.availability ,worker.experience , books.booking_time , books.serverName  , books.finished , books.serverCategory 
  from books INNER JOIN worker ON books.worker_id = worker.id WHERE books.user_id = '$id' ");
  $select2->execute();
  $bookInfo = $select2->fetch(PDO::FETCH_OBJ);
 }
 // check if the worker finished or not
 if( isset($bookInfo->finished) AND $bookInfo->finished == 1){
    header('location:'.URL.'Client/thankful.php');
  }
 // Delete reservation when the user click on 'الغاء'
 if(isset($_GET['delete'] )){
  
   $id = $_GET['id'];
  $delete = ("DELETE FROM books  WHERE user_id = '$id' ");
  $conn->exec($delete);
   header('location:ClientProfile.php?id='.$id.'');
   }

 ob_end_flush();
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
  <link rel="stylesheet" href="ProfileStyle.css">
  <link rel="stylesheet" type="text/css" href="../plugins/rating-plugin/src/css/star-rating-svg.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  

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
  <div class="container rounded bg-white mt-5 mb-5">
    <div class="row">
        <div class="col-md-3 border-right">
            <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                <img class="rounded-circle mt-5" width="150px" src="../images/users_img/<?php echo $clients->img ?>"><span class="font-weight-bold"> <?php  echo $clients -> username?> </span></div>
               
               <br><br><br><br><br><br><br><br><br><br><a class="btn btn-primary btn-sm" href='<?php echo URL ;?> '">  الرجوع للصفحة الرئيسية</a>
              </div>
        
        <div class="col-md-5 border-right">
            <div class="p-3 py-5">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="text-right">بيانات العميل</h4>
                </div>
                <div class="row mt-2" style="text-align: right;">
                    <div class="col-md-6"><label class="labels">  الاسم</label><input type="text" class="form-control" placeholder="<?php  echo $clients -> username?>" value=" <?php  echo $clients -> username?> " readonly></div>
                </div>
                <div class="row mt-3" style="text-align: right;">
                    <div class="col-md-12"><label class="labels">رقم الهاتف</label><input type="text" class="form-control" placeholder="<?php  echo $clients -> phone?> " value="<?php  echo $clients -> phone?>" readonly></div>
                    <div class="col-md-12"><label class="labels">مكان السكن</label><input type="text" class="form-control" placeholder=""<?php  echo $clients->loc?>" value="<?php  echo $clients->loc?>" readonly></div>
                    <div class="col-md-12"><label class="labels">البريد الإلكتروني</label><input type="text" class="form-control" placeholder="<?php  echo $clients->email ?>" value="<?php  echo $clients->email ?>" readonly></div>
                </div>
                
                <div class="mt-5 text-center"><a class="btn btn-primary profile-button" href='EditClientProfile.php?id=<?php  echo $clients->user_id ?>'">تعديل الملف الشخصي</a></div>
            </div>
           
        </div>
        <div class="col-md-4 mt-5" style="text-align: center;">
            <h3>الخدمة المحجوزة</h3>
            <?php  if($select2->rowCount()>0) : ?>
            <div class="container mt-4 mb-4 p-3 d-flex justify-content-center"> 
                <div class="card p-4">
                    <div class=" image d-flex flex-column justify-content-center align-items-center"> 
                        
                            <img src="../images/users_img/<?php echo $bookInfo->img ;?>" height="100" width="100" style="clip-path: circle(50px);" />
                        
                            <span class="name mt-3"> اسم مُقدم الخدمة :   <?php echo $bookInfo-> fullname ; ?></span> 
                            <div class="d-flex flex-row justify-content-center align-items-center gap-2">
                                 </div> <div class="d-flex flex-column justify-content-center align-items-center mt-3"> 
                                    <span>نوع الخدمة المطلوبة:  <?php echo $bookInfo->serverCategory.' - '. $bookInfo->serverName; ?> </span>
                                    <span>    وقت الحجز: <?php  echo $bookInfo->booking_time; ?> </span>
                                    <span> عدد سنين الخبرة: <?php  echo $bookInfo->experience ;?> </span>
                                    <span>   رقم الهاتف: <?php  echo $bookInfo->Phone ;?> </span>
                                    <span class="text-<?php if($bookInfo->availability == 1 ) {echo 'success' ;}else{ echo 'danger' ; }?>"> <?php if( $bookInfo->availability == 1) { echo  "  متاح حاليا" ; }else{ echo "  غير متاح حاليا" ; }?> </span>
                                    <div class="my-rating" dir="ltr">
                                    
                                    </div>
                                    <div class=" d-flex mt-2"> <a href="ClientProfile.php?delete=delete&id=<?php echo $_SESSION['user_id'] ;?>" class="btn btn-primary">الغاء</a> </div> 
    </div>
    </div>
            </div>  
        </div>
        <?php   else : ?>
          <div class="container mt-4 mb-4 p-3 d-flex justify-content-center">
          <div class="card" style="width: 18rem;">
             <div class="card-body">
                <h5 class="card-title text-danger"> لا يوجد خدمة محجوزة بعد</h5>
  </div>
</div>

          </div>
          <?php endif; ?>
    </div>
</div>
</div>
</div>

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

<script src="../plugins/rating-plugin/dist/jquery.star-rating-svg.js"></script>
<!-- Custom js -->
<script src="../js/script.js"></script>
<script src="https://unpkg.com/aos@next/dist/aos.js"></script>
<script>
  AOS.init();

  $(".my-rating").starRating({
    readOnly: true,
    starSize: 25,
    initialRating : <?php 
        if(isset($bookInfo->rating)){
            echo $bookInfo->rating ;
        }else{
            echo "0";    
            }
    ?>,
  })
</script>
<script src="function.js"></script>

</body>

</html>
