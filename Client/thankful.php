<!--After user click submit from Book.html and check him on DB it will be switched here-->
<?php
session_start();
require '../Authentication/config.php' ;

if(isset($_POST['submit'])){
   $id= $_SESSION['user_id'];
  $delete = ("DELETE FROM book  WHERE user_id = '$id' ");
  $conn->exec($delete);
  header('location:http://localhost/php/theme/');
  exit();
}
?>



<!DOCTYPE html>
<html>

<meta charset="utf-8">
<title>خدماتي | للخدمات المنزلية</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="description" content="One page parallax responsive HTML Template">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">
<!-- Favicon -->
<link rel="shortcut icon" type="image/x-icon" href="../images/favicon.ico" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="../plugins/bootstrap/bootstrap.min.css">
<style>
    
    @media (max-width:767px)
    {
.container {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
}
.container .rating {
    display: flex;
    flex-direction: row;
    justify-content: center;
    align-items: center;
}
.container textarea {
    margin: auto;
    display: flex;
    justify-content: center;
    align-items: center;
    width: 100%;
}

#regForm {
  background-color: #ffffff;
  margin: 100px auto;
  font-family: Raleway;
  padding: 40px;
  width: 50%;
}

h1 {
  text-align: center;  
} 
    }
* {
  box-sizing: border-box;
}
body {
  background-image: url("../images/slider/slider-bg-1.jpg");
  height: 100vh;
}
.container {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
}
.container .rating {
    display: flex;
    flex-direction: row;
    justify-content: center;
    align-items: center;
}
#regForm {
  background-color: #ffffff;
  margin: 100px auto;
  font-family: Raleway;
  padding: 5px 0 30px 0;
  width: 70%;
  
}
h2 {
  text-align: center;  
  margin-bottom: 50px;
} 
.rating:not(:checked) > input {
  position: absolute;
  appearance: none;
}

.rating:not(:checked) > label {
  float: right;
  cursor: pointer;
  font-size: 30px;
  color: #666;
}

.rating:not(:checked) > label:before {
  content: '★';
}

.rating > input:checked + label:hover,
.rating > input:checked + label:hover ~ label,
.rating > input:checked ~ label:hover,
.rating > input:checked ~ label:hover ~ label,
.rating > label:hover ~ input:checked ~ label {
  color: #e58e09;
}

.rating:not(:checked) > label:hover,
.rating:not(:checked) > label:hover ~ label {
  color: #ff9e0b;
}

.rating > input:checked ~ label {
  color: #ffa723;
}




</style>
<body>
<div class="container"></div>
<form id="regForm" action="" style="margin-top: 150px;" action="thankful.php" method="post">
  <div class="tab mt-5  " style="text-align: right; direction: rtl;">
    <h2>
        <br>
         وشكرا على ثقتكم.
    </h2>
    <div class="container">
        <div class="row" style="margin: auto; text-align: center;">
            <div class="col-md-12">
                <h3>قيم الخدمة </h3>
                <div class="rating" >
                    <input value="5" name="rate" id="star5" type="radio">
                    <label title="text" for="star5"></label>
                    <input value="4" name="rate" id="star4" type="radio">
                    <label title="text" for="star4"></label>
                    <input value="3" name="rate" id="star3" type="radio" checked="">
                    <label title="text" for="star3"></label>
                    <input value="2" name="rate" id="star2" type="radio">
                    <label title="text" for="star2"></label>
                    <input value="1" name="rate" id="star1" type="radio">
                    <label title="text" for="star1"></label>
                </div>
                <br>
                <textarea name="" id="" cols="30" rows="2"></textarea>
                <br>
                <button type="submit" name="submit" class="btn btn-primary">إرسال</button>
            </div>
            
        </div>
    </div>
  </div>
</form>
</div> 
</body>
</html>
