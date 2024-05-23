<!--After user click submit from Book.html and check him on DB it will be switched here-->
<?php
session_start();
require '../Authentication/config.php' ;
$id= $_SESSION['user_id'];

$select = $conn->query("SELECT * FROM books WHERE user_id = '$id'");
$select->execute();
$info = $select->fetch(PDO::FETCH_OBJ);

$worker_id = $info->worker_id ;


if(isset($_POST['submit'])){
   global $id ;
   global $worker_id ;
 
  $user_id= $_SESSION['user_id'];
  $worker_id = $_POST['worker_id'];
  $rating= $_POST['rating'];
  $comment = $_POST['comment'];

  $insert = $conn->prepare("INSERT INTO ratings(user_id , worker_id , comment , rating) VALUES (:user_id , :worker_id , :comment , :rating )");
  $insert->execute([
    ':user_id' => $user_id ,
    ':worker_id' =>$worker_id ,
    ':comment' =>$comment,
    ':rating' => $rating ,
  ]);

   $update = $conn->prepare("UPDATE  worker SET rating= :rating WHERE id = '$worker_id' ");
   $update->execute([
            ':rating'=>$rating,
   ]);

   $delete = ("DELETE FROM books  WHERE user_id = '$id' ");
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
<link rel="stylesheet" type="text/css" href="../plugins/rating-plugin/src/css/star-rating-svg.css">
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
/*
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

*/


</style>
<body>
<div class="container"></div>
<form id="regForm" action="" style="margin-top: 150px;" action="thankful.php" method="post">
  <div class="tab mt-5  " style="text-align: right; ">
    <h2>
        <br>
         .وشكرا على ثقتكم
    </h2>
    <div class="container">
        <div class="row" style="margin: auto; text-align: center;">
            <div class="col-md-12">
                <h3>قيم الخدمة </h3>
                <div class=" my-rating" >
                <input type="text" name="rating" hidden id="rating" value="" >
                <input type="text" name="worker_id" id="worker_id" hidden value="<?php echo $info->worker_id ; ?>" >

                </div>
                <br>
                <textarea name="comment" id="" cols="30" rows="2"></textarea>
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


<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
<script src="../plugins/rating-plugin/dist/jquery.star-rating-svg.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

<script>
$(".my-rating").starRating({
    starSize: 25,
   // initialRating : <php 
     //   if(isset($rates->rating)){
      //      echo $rates->rating ;
     //   }else{
        //    echo "0";    
//}
//>,
   callback: function(currentRating, $el){
        // make a server call here
        $('#rating').val(currentRating);

       /*  $(".my-rating").click(function(e){
            e.preventDefault();
            var formdata = $("#regForm").serialize()+'&insert=insert';
            $.ajax({
               type: "POST",
               url:"thankful.php",
               data: formdata ,
               success:function(){
                alert(formdata);

               }
            })
        })*/
       }
})

</script>