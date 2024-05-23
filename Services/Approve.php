
<?php
 session_start();
 define('URL' , 'http://localhost/php/theme/');
 ob_start();
 require '../Authentication/config.php' ;
?>
<?php 
if(isset($_GET['Uid']) AND isset($_GET['Sid'])){
  $Uid = $_GET['Uid'] ;
  $Sid = $_GET['Sid'] ;

if( isset($_POST['submit'])){
          if(empty($_POST['booking_time']) AND empty($_POST['locType']) AND empty($_POST['locSize'])
           AND empty($_POST['details']) AND  empty($_POST['worker'])){
            header("location:Book.php?");
            exit();
          }else{
            $booking_time =  $_POST['booking_time'];
            $locType = $_POST['locType'] ;
            $locSize = $_POST['locSize'] ;
            $details =  $_POST['details'];
            $worker_id = $_POST['worker'];
           // $payment = $_POST['payment'] ;
                //fetch info about the user who booked the service 
            $select = $conn->query("SELECT * FROM user WHERE user_id = '$Uid' ");
            $select->execute();
            $client = $select->fetch(PDO::FETCH_OBJ);

            //fetch info about the booked service 
            $select = $conn->query("SELECT * FROM services WHERE id = '$Sid' ");
            $select->execute();
            $service = $select->fetch(PDO::FETCH_OBJ);

            //fetch info about the worker who provide the booked service 
            $select = $conn->query("SELECT * FROM worker WHERE id = '$worker_id' ");
            $select->execute();
            $worker = $select->fetch(PDO::FETCH_OBJ);
            
            
            $insert = $conn->prepare("INSERT INTO books (booking_time ,loc_type , loc_size , problem_details , worker_id , user_id , serverName , serverCategory)
             VALUES(:booking_time ,:loc_type ,:loc_size ,:problem_details ,:worker_id , :user_id , :serverName , :serverCategory)");
             $insert->execute([
              ':booking_time'=> $booking_time ,
              ':loc_type'=>$locType,
              ':loc_size' =>$locSize,
              ':problem_details'=>$details,
              ':worker_id'=>$worker_id,
              ':user_id'=>$_SESSION['user_id'],
              ':serverName'=>$service->name,
              ':serverCategory'=>$service->category,




             ]);
          }
    }
  }
?>
<!--After user click submit from Book.html and check him on DB it will be switched here-->
<!DOCTYPE html>
<html>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="../plugins/bootstrap/bootstrap.min.css">
<style>
* {
  box-sizing: border-box;
}

body {
  background-image: url("../images/slider/slider-bg-1.jpg");
}

#regForm {
  background-color: #ffffff;
  margin: 100px auto;
  font-family: Raleway;
  padding: 40px;
  width: 70%;
  min-width: 300px;
}

h1 {
  text-align: center;  
} 
</style>
<body>
<div class="container"></div>
<form id="regForm" action="" style="margin-top: 150px;">
  <div class="tab mt-5  " style="text-align: right; direction: rtl;">
    <h1>
        تم تقديم طلبك بنجاح !
            <br>
        سنتواصل معك بأقصر وقت ممكن
    </h1>
    <a class="btn btn-primary" href="<?php  echo URL ;?>"> الرجوع الى الصفحة الرئيسة</a>
  </div>
</form>
</div> 
</body>
</html>
