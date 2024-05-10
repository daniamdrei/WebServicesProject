<?php
session_start();
define('URL' , 'http://localhost/php/theme/');

ob_start();
require '../Authentication/config.php' ;
if($_SESSION['user_type'] === 'worker'){
  header('location:'.URL.'');
}
 if(isset($_GET['id'])){
  $id = $_GET['id'];
  //select user info
  $select = $conn->query("SELECT * FROM user WHERE user_id = '$id' AND usertype = 'client' ");
  $select->execute();
  $clients = $select->fetch(PDO::FETCH_OBJ);
  // to update user info
  if(isset($_POST['submit'])){
    if(empty($_POST['username']) AND empty($_POST['phone']) AND empty($_POST['email']) ){
      header('location:EditClientProfile.php?id='.$_SESSION['user_id'].'&error=الرجاء عدم ترك حقل فارغ ');
      exit();
    }else{
       $username = $_POST['username'] ;
       $phone =  $_POST['phone'] ;
        $email =  $_POST['email'] ;
        //$img = $_FILES['img']['name'];
        //upload image name into the file
           // $fileTmpName = $_FILES['img']['tmp_name'];
            //$fileDestination = '../images/users_img/'.$img;
            $Update =$conn->prepare("UPDATE user SET username = :username ,email = :email , phone = :phone  WHERE user_id ='$id'");//,img = :img 
           // if(!empty($img)){
              //unlink("../images/users_img/".$clients->img."");
             // $Update->execute([
               // ":username" =>$username  ,
                //":email" =>$email  ,//":img" =>$img  ,
                //":phone"=>$phone,
            // ]);
          //}else{
              $Update->execute([
                ":username" =>$username  ,
                ":email" =>$email  , //":img" =>$clients->img ,
                ":phone"=>$phone,
                  ]);
         // }
          move_uploaded_file($fileTmpName,$fileDestination);
                    header('location:http://localhost/php/theme/Client/ClientProfile.php?id='.$_SESSION['user_id'].'');
                    exit();

    }
  }

   
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
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
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
    <form action="EditClientProfile.php?id=<?php  echo $clients->user_id?>" method="post" enctype="multipart/form-data">
    <div class="row">
      <div class="col-md-3 border-right">
        <div class="d-flex flex-column align-items-center text-center p-3 py-5">
            
          <div >
             <!--<label class="-label" for="file">
               <span class="glyphicon glyphicon-camera"></span> 
                <span>Change Image</span>
            </label>
            <input id="file" type="file" name="img">-->
            <img class="rounded-circle" src="../images/users_img/<?php echo $clients->img ?>" id="output" width="200" />
            
          </div>
          <!--<button class="btn btn-primary" onclick="resetImage()">Reset Image  <i class="fa-solid fa-trash fa-flip-horizontal"></i></button> <!-- Reset button -->
        
        </div>
      </div>
        <div class="col-md-5 border-right">
            <div class="p-3 py-5">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="text-right">بيانات العميل</h4>
                </div>
                <div class="row mt-2" style="text-align: right;">
                    <div class="col-md-6"><label class="labels"> الاسم </label><input type="text" name="username" class="form-control" placeholder="<?php  echo $clients -> username?>" value=" <?php  echo $clients -> username?> "  ></div>
                </div>
                <div class="row mt-3" style="text-align: right;">
                    <div class="col-md-12"><label class="labels">رقم الهاتف</label><input type="phone" name="phone" class="form-control" placeholder="<?php  echo $clients -> phone?> " value="<?php  echo $clients -> phone?>"  ></div>
            
                    <div class="col-md-12"><label class="labels">البريد الإلكتروني</label><input type="text" name="email" class="form-control" placeholder="<?php  echo $clients->email ?>" value="<?php  echo $clients->email ?>" ></div>
                </div>
                
                <div class="mt-5 text-center"><button class="btn btn-primary " type="submit" name="submit">حفظ الملف الشخصي </button></div>
            </div>
        </div>
        
</div>
</div></form>
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

<!-- Custom js -->
<script src="../js/script.js"></script>
<script src="https://unpkg.com/aos@next/dist/aos.js"></script>
<script>
  AOS.init();
</script>
<script> 
/*
  var loadFile = function(event) {
    var image = document.getElementById('output');
    image.src = URL.createObjectURL(event.target.files[0]);
    image.onload = function() {
        URL.revokeObjectURL(image.src); // Free up memory
    };
};*/
 function resetImage() {
    var image = document.getElementById('output');
    // Set to a default image or clear the image source
    image.src = "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcR1H81w4SmKH5DZmIbxU7EB0aMSkNQDoPQA1mRQxf2Y0wMF1NSa7vghbwwKASi1q4NPmNw&usqp=CAU";
}
</script>

</body>

</html>
