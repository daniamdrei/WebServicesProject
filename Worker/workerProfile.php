<?php
 session_start();
 define('URL' , 'http://localhost/php/theme/');

 ob_start();
 require '../Authentication/config.php' ;

 if($_SESSION['user_type'] === 'client'){
  header('location:http://localhost/php/theme/');
  exit();
}
 if(isset($_GET['id'])){
    $id = $_GET['id'];
    
 $select1 = $conn->query("SELECT * FROM worker WHERE workerId = '$id' ");
 $select1->execute();
 $worker = $select1->fetch(PDO::FETCH_OBJ);
 if($worker->status == 0 ){
  header('location:http://localhost/php/theme/');
  exit();
}
    $select2 = $conn->query("SELECT  book.id ,user.username , user.phone , user.user_id , user.img ,user.loc , book.booking_time , book.loc_type , book.loc_size , book.problem_details ,  book.serverName
     from book  INNER  JOIN user ON book.user_id = user.user_id WHERE book.worker_id = '$worker->id' ");
     $select2->execute();
     $bookInformation = $select2->fetchAll(PDO::FETCH_OBJ);

     //fetch the rating of the worker form rating table
  $ratings = $conn->query("SELECT * FROM rating WHERE worker_id = '$id'");
  $ratings->execute();
  $rating = $ratings->fetch(PDO::FETCH_OBJ);
  

 }
 if(isset($_GET['Bid'])){
  $Bid = $_GET['Bid'];

  $delete = ("DELETE FROM book  WHERE id = '$Bid' ");
  $conn->exec($delete);

  $update = $conn->prepare("UPDATE user SET finished = :finished WHERE user_id = '$bookInformation->user_id'");
  $update->execute([
    ':finished'=>'1',
  ]);
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
  <div class="container rounded bg-white mt-5 mb-5 py-3">
    <div class="row" >
        <div class="col-md-3 border-right">
            <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                <img class="rounded-circle mt-5" width="150px" src="../images/users_img/<?php echo $worker->img ;?>">
                <span class="font-weight-bold"> <?php  echo $worker->name ;?></span>
                <div class="my-rating" dir="ltr">
                 </div>
              </div>
        </div>
        <div class="col-md-5 border-right">
            <div class="p-3 py-5">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="text-right">بيانات العامل</h4>
                </div>
                <div class="row mt-2" style="text-align: right;">
                    <div class="col-md-6"><label class="labels"> الاسم الثلاثي</label><input type="text" class="form-control" placeholder="<?php  echo $worker->fullname ;?>"    readonly></div>
                </div>
                <div class="row mt-3" style="text-align: right;">
                    <div class="col-md-12"><label class="labels">رقم الهاتف</label><input type="text" class="form-control" placeholder="<?php  echo $worker->Phone ;?> " readonly></div>
                    <div class="col-md-12"><label class="labels">العمر</label><input type="text" class="form-control" placeholder="<?php  echo $worker->age ;?>"  readonly></div>
                    <div class="col-md-12"><label class="labels">نوع الخدمة المقدمة</label><input type="text" class="form-control" placeholder="<?php  echo $worker->servicetype ;?>"   readonly></div>
                    <div class="col-md-12"><label class="labels">مكان السكن</label><input type="text" class="form-control" placeholder="<?php  echo $worker->location ;?>"  readonly></div>
                    <div class="col-md-12"><label class="labels">البريد الإلكتروني</label><input type="text" class="form-control" placeholder="<?php  echo $worker->email ;?>" readonly></div>
                </div>
                <div class="mt-5 text-center"><a  href="script.php?availability=<?php echo $worker->availability; ?>&Wid=<?php echo $worker->workerId ; ?>" class="btn btn-<?php  if( $worker-> availability == 1  ){echo 'danger' ;}else{echo 'success' ;}?>" > <?php if( $worker-> availability == 1  ){echo 'غير متاح حاليا' ;}else{echo 'متاح حاليا' ;} ?></a></div>
                <div class="mt-5 text-center"><button class="btn btn-primary profile-button" type="button" onclick="window.location.href='EditworkerProfile.php?id=<?php echo $worker->id ;?>'">تعديل الملف الشخصي</button></div>
            </div>
        </div>
    </div>
    <h3 class="text-center mt-5">العملاء</h3>
    <div class="slideshow-container">
        <div class="slideshow-container">
            <div class="mySlides fadee">
                <div class="container mt-4 mb-4 p-3 d-flex justify-content-center"> 
                <?php  if($select2->rowCount()>0) : ?>
                  <?php foreach($bookInformation as $bookInfo) : ?>
                    <div class="card p-4"> 
                        <div class=" image d-flex flex-column justify-content-center align-items-center"> 
                                <img src="../images/users_img/<?php echo  $bookInfo->img ?>" height="100" width="100" style="clip-path: circle(50px);" />
                                <span class="name mt-3"> <?php echo $bookInfo->username ; ?> </span> 
                                <div class="d-flex flex-row justify-content-center align-items-center gap-2">
                                      </div> <div class="d-flex flex-column justify-content-center align-items-center mt-3"> 
                                        <span>نوع الخدمة : <?php echo $bookInfo->serverName ; ?> </span>
                                        <span>تفاصيل المشكلة :   <?php echo $bookInfo->problem_details ; ?>   </span>
                                        <span>وقت تقديم الخدمة : <?php echo $bookInfo->booking_time ; ?> </span>
                                        <span>رقم الهاتف: <?php echo $bookInfo->phone ; ?> </span>
                                        <span>المكان:  <?php echo $bookInfo->loc ; ?> </span>
                                        <div class=" d-flex mt-2"> <a href="script.php?Wid=<?php echo $worker->workerId ;?>&Uid=<?php  echo $bookInfo->user_id ;?>" class="btn btn-primary">إنهاء</a>
                                      </div><?php endforeach ; ?>

                                      </div>  <br><br>
        </div>
                    </div>
                  
  </div>
</div>

          </div>
            </div> 
                  </div>
<!--<a class="prev" onclick="plusSlides(-1)">❮</a>
<a class="next" onclick="plusSlides(1)">❯</a>
                  -->  
            </div>
            <br>
            <!--
            <div style="text-align:center">
              <span class="dot" onclick="currentSlide(1)"></span> 
              <span class="dot" onclick="currentSlide(2)"></span> 
              <span class="dot" onclick="currentSlide(3)"></span> 
            </div>-->
    </div>
</div>
</div>
<?php   else : ?>
          <div class="container mt-4 mb-4 p-3 d-flex justify-content-center">
          <div class="card" style="width: 18rem;">
             <div class="card-body">
                <h5 class="card-title text-danger text-center"> لا يوجد عملاء بعد</h5>
          <?php endif; ?> 

<!--
    Essential Scripts
    =====================================-->
<!-- Main jQuery -->
<script src="/plugins/jquery/jquery.min.js"></script>

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
<script>
  
    let slideIndex = 1;
showSlides(slideIndex);

// Next/previous controls
function plusSlides(n) {
  showSlides(slideIndex += n);
}

// Thumbnail image controls
function currentSlide(n) {
  showSlides(slideIndex = n);
}

function showSlides(n) {
  let i;
  let slides = document.getElementsByClassName("mySlides");
  let dots = document.getElementsByClassName("dot");
  if (n > slides.length) {slideIndex = 1}
  if (n < 1) {slideIndex = slides.length}
  for (i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";
  }
  for (i = 0; i < dots.length; i++) {
    dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display = "block";
  dots[slideIndex-1].className += " active";
}

</script>

<script src="../plugins/rating-plugin/dist/jquery.star-rating-svg.js"></script>
 
<script>

$(".my-rating").starRating({
    readOnly: true,
    starSize: 25,
    initialRating : <?php 
        if(isset($worker->rating)){
            echo $worker->rating ;
        }else{
            echo "0";    
            }
    ?>,
  })
 
</script> 
</body>

</html>
