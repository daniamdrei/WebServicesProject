
<?php
session_start();
ob_start(); ?>
<?php require 'config.php';
define('URL' , 'http://localhost/php/theme/');
      ?>
<?php 
if(isset($_SESSION['user_name'])){
  header('location:http://localhost/php/theme/');
  exit();
}
    if(isset($_POST['submit'])){
    if(empty($_POST['email'])){
    header("location:login.php?error=*يجب عليك ادخال البريد الالكتروني");
    exit();
    }else if(empty($_POST['passw'])){
    header("location:login.php?error=*يجب عليك ادخال كلمة السر");
    exit();
    }else {
        //set the data into a variables
        $email = $_POST['email'];
        $password = $_POST['passw'];
         // query to select the data from db
         $result = $conn->query("SELECT * FROM user Where email ='$email' "); 
         // $result = $conn->query("SELECT * FROM uers Where Uemail ='$email' ");  
        $result->execute();
        $row = $result->fetch(PDO::FETCH_ASSOC);
        if( $result->rowCount()>0){
          
            // $password == $row['password1'] password_verify($password,$row['Upassword'])
            //echo password_verify($password,$row['password1']);
            if(password_verify($password,$row['password1'])){

             
              if($row['usertype'] === 'admin'){
                $_SESSION['AdminName']= $row['username'];
                $_SESSION['AdmineEmail'] = $row['email'];
                $_SESSION['user_type'] = $row['usertype'];
                header('location:'.URL.'admin-panel/index.php');
              
             }
        
            else{
                  $_SESSION['user_name']= $row['username'];
                  $_SESSION['user_id'] = $row['user_id'];
                  $_SESSION['user_type'] = $row['usertype'];
                  $_SESSION['user_email'] = $row['email'];
                  //$_SESSION['user_img'] =$row['Uimg'];
                  header("location:".URL."");
                 } 
          }else {
            header('location:login.php?error= كلمة السر غير صحيح*');
            exit();
                }

    }else {
      header('location:login.php?error=بريدك الالكتروني غير صحيح*');
      exit();
          }
}
    }
ob_end_flush();
?>

<!DOCTYPE html>
<!---Coding By CoderGirl | www.codinglabweb.com--->
<html lang="en">
<header>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Login</title>
  <!---Custom CSS File--->
  <link rel="stylesheet" href="CSS FOLDER/stylelogin.css">
  <style>
        .alertCheckbox {
  display: none;
}
:checked + .alert {
  display: none;
}
.alertText {
  display: table;
  margin: 0 auto;
  text-align: center;
  font-size: 16px;
  padding: 15px;
}
.alertClose {
  float: right;
  padding-top: 5px;
  font-size:15px;
  padding: 10px;
}
.clear {
  clear: both;
}
.error {
  background-color: #FEE;
  border: 1px solid #EDD;
  color: #A66;
}
    </style>
</header>
<body>
  <div style="text-align: center;">
    <img src="IMAGES/logo.png" alt="">
  </div>
  <div class="container">
    <div class="login form">
      <?php if(isset($_GET['message'])){ ?>
    <label>
  <input type="checkbox" class="alertCheckbox" autocomplete="off" />
  <div class="alert error">
    <span class="alertClose">X</span>
    <span class="alertText"><?php echo $_GET['message'] ;?> </p>
    <br class="clear"/></span>
  </div>
</label>
<?php } ?>
      <header>سجل دخول لحسابك</header>
      <form action="<?php echo htmlspecialchars('Login.php')?>" method="post">
          <?php if(isset($_GET['error'])){ ?>
                  <p dir="rtl" style="color: red;">
           <?php echo $_GET['error'] ; }?> </p>
        <input type="text" placeholder="البريد الإلكتروني" name="email" style="text-align: right;">
        <input type="password" placeholder="كلمة السر" name="passw" style="text-align: right;">
        <div style="text-align: right;">
<!--         <a href="#">نسيت كلمة السر؟</a>-->
        </div>
        <div style="text-align: center;">
          <button type="submit" name="submit">تسجيل الدخول</button>
        </div>
      </form>
      <div class="signup">
        <span class="signup">لا تمتلك حساب؟
        <a href="signin.php">انشأ حساب</a>
        </span>
      </div>
    </div>

  </div>