<?php session_start();
 define('URL' , 'http://localhost/php/theme/');

 ob_start();
 require '../Authentication/config.php' ;

?>
<?php
            if(isset($_GET['id'])){
            $id = $_GET['id'];
              
             $select = $conn->query("SELECT * FROM worker WHERE id = '$id'");
            $select->execute();
            $worker = $select->fetch(PDO::FETCH_OBJ);
            }
            else{
                header('location:workerProfile.php?id='.$_SESSION['worker_id'].'&error=غير مصرح لك بتعديل المعلومات');
                exit();
            }
            // script to update info inside the table
            if(isset($_POST['submit'])){
              if(empty($_POST['email']) AND empty($_POST['fullname'])  AND empty($_POST['phone']) AND empty($_POST['age']) AND empty($_POST['servicetype']) AND  empty($_POST['location']))
              {
                header('location:EditworkerProfile.php?id='.$_SESSION['worker_id'].'&error=الرجاء عدم ترك حقل فارغ ');
                exit();
              }else{
                $email = $_POST['email'];
                $fullname = $_POST['fullname'];
                $img = $_FILES['img']['name'];
                $Phone = $_POST['phone'];
                $age = $_POST['age'];   
                $servicetype = $_POST['servicetype'];
                $location = $_POST['location'];
                //upload image name into the file
                $fileTmpName = $_FILES['img']['tmp_name'];
                $fileDestination = '../images/users_img/'.$img;
                $Update =$conn->prepare("UPDATE worker SET fullname = :fullname ,email = :email , Phone = :Phone, age = :age , img = :img ,
                 servicetype = :servicetype  WHERE id ='$id'");
                if(!empty($img)){
                    unlink("../images/users_img/".$worker->img."");
                    $Update->execute([
                      ":fullname" =>$fullname  ,
                      ":email" =>$email  ,
                      ":Phone" =>$Phone  ,
                      ":age" => $age ,
                      ":img" =>$img  ,
                      ":servicetype"=>$servicetype,
                    ]);
                }else{
                    $Update->execute([
                      ":fullname" =>$fullname  ,
                      ":email" =>$email  ,
                      ":Phone" =>$Phone  ,
                      ":age" => $age ,
                      ":img" =>$worker->img ,
                      ":servicetype"=>$servicetype,
                        ]);
                }
                move_uploaded_file($fileTmpName,$fileDestination);
                    header('location:http://localhost/php/theme/Worker/workerProfile.php?id='.$_SESSION['worker_id'].'');
                    exit();
                

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
    <form action="EditworkerProfile.php?id=<?php echo $worker->id ;?>" method="post" dir="rtl" enctype="multipart/form-data">
    <div class="row">
      <div class="col-md-3 border-right">
        <div class="d-flex flex-column align-items-center text-center p-3 py-5">
          <div class="profile-pic">
            <label class="-label" for="file">
                <span class="glyphicon glyphicon-camera"></span>
                <span>Change Image</span>
            <input id="file" type="file" name="img">
            <img src="../images/users_img/<?php echo $worker->img ?>" id="output" width="200" />
               </label>
          </div>
        </div>
      </div>
        <div class="col-md-5 border-right">
            <div class="p-3 py-5">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="text-right">تعديل بيانات العامل</h4>
                </div>
                <div class="row mt-2" style="text-align: right;">
                    <div class="col-md-6"><label class="labels"> الاسم الثلاثي</label><input type="text" name="fullname" class="form-control" placeholder=" <?php  echo $worker->fullname ;?> " value="<?php  echo $worker->fullname ;?>  "  ></div>
                </div>
                <div class="row mt-3" style="text-align: right;">
                    <div class="col-md-12"><label class="labels">رقم الهاتف</label><input type="text" name="phone" class="form-control" placeholder="<?php  echo $worker->Phone ;?> " value="<?php  echo $worker->Phone ;?>"  ></div>
                    <div class="col-md-12"><label class="labels">العمر</label><input type="text" name="age" class="form-control" placeholder=<?php  echo $worker->age ;?>" value="<?php  echo $worker->age ;?>"  ></div>
                    <div class="col-md-12"><label class="labels">نوع الخدمة المقدمة</label><input type="text" name="servicetype" class="form-control" placeholder="<?php  echo $worker->servicetype ;?>" value="<?php  echo $worker->servicetype ;?>"  ></div>
                    <div class="col-md-12"><label class="labels">البريد الإلكتروني</label><input type="text" name="email" class="form-control" placeholder="<?php  echo $worker->email ;?>" value="<?php  echo $worker->email ;?>"  ></div>
                </div>
                
                <div class="mt-5 text-center"><button class="btn btn-primary profile-button" type="submit" name="submit" onclick="window.location.href='EditworkerProfile.html'">حفظ الملف الشخصي</button></div>
            </div>
        </div>
       
    </div>
</div>
</div>
</form>
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
  /*var loadFile = function(event) {
    var image = document.getElementById('output');
    image.src = URL.createObjectURL(event.target.files[0]);
    image.onload = function() {
        URL.revokeObjectURL(image.src); // Free up memory
    };
};*/
</script>

</body>

</html>
