

<?php ob_start(); ?>
<?php require 'config.php'; ?>
<?php 
if(isset($_SESSION['user_name'])){
  header('location:http://localhost/php/theme/');
  exit();
  }
if(isset($_POST['submit']))
{  
 //check if the input is empty 
  if(empty($_POST['username'])){
  header("location:signin.php?error= *يجب عليك ادخال الاسم");
  }elseif(empty($_POST['email'] )){
    header("location:signin.php?error=*يجب عليك ادخال البريد الالكتروني");
    exit();
  }elseif(empty($_POST['passw'])){
    header("location:signin.php?error=*يجب عليك ادخال كلمة السر");
    exit();
  }else if(empty($_POST['re_passw'])){
    header("location:signin.php?error=*يجب عليك ادخال اعادة كلمة السر");
    exit();
  }else{
        //set the variables
        $username =$_POST['username'];
        $email = $_POST['email'];
        $passw = $_POST['passw'];
        $re_passw = $_POST['re_passw'];
        $usertype = $_POST['usertype'];
        $location = $_POST['location'];
        $img = 'defult.jpg';
         // check for password match
        if ($passw == $re_passw){
           //checking for username and email availability 
          if(strlen($username) >17 ){   
            header('location:signin.php?error=الاسم طويل حاول ان تجعله اقصر  ');
            exit();
          }else{
               //query statement to insert the variables into the table
                $available = $conn->query("SELECT * FROM user WHERE email = '$email' OR username = '$username'");
                $available->execute();
                if($available->rowCount()>0){
                  header('location:signin.php?error=تم استخدام البريد الالكتروني من قبل ');
                  exit();
                }else{
                  //  query to insert the value into the table
                  $stmt= $conn->prepare("INSERT INTO user (username	, email , password1	,usertype ,loc ,img ) 
                  VALUES(:username	, :email , :password1 ,:usertype ,:loc ,:img ) ");
                  $stmt->execute([
                  ':username' => $username ,
                  ':email' => $email ,
                  ':password1' =>password_hash($passw ,PASSWORD_DEFAULT),
                  ':usertype'=>$usertype,
                  ':loc'=>$location,
                  ':img'=>$img ,
                  ]);
                  header('location:login.php');
                  exit();
            
                }
          }
        }else{
          header('location:signin.php?passerror=*كلمة السر غير متطابقة');
          exit();
        }

  }

}
  ob_end_flush();
?>

<!DOCTYPE html>
<!---Coding By CoderGirl | www.codinglabweb.com--->
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Sign In</title>
  <!---Custom CSS File--->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="CSS FOLDER/stylesign.css">

</head>
<body>
  <div style="text-align: center;">
    <img src="IMAGES/logo.png" alt="" >
  </div>
  <div class="container">
    <div class="registration form">
      <header>انشاء حساب</header>
      <form action="<?php echo htmlentities('signin.php')?>" method="post">
      <!--  error message if some input are empty-->
      <?php if(isset($_GET['error'])){ ?>
                  <p dir="rtl" style="color: red;">
          <?php echo $_GET['error'] ; }?> </p>
          <!-- ----- -->
        <input type="text" placeholder="اسم المستخدم"  style="text-align: right;" name="username">
        <input type="ُemail" placeholder="البريد الإلكتروني"  style="text-align: right;" name="email">
        <!--  error message if the password not match-->
        <?php if(isset($_GET['passerror'])){?>
          <p dir="rtl" style="color:red;"> 
             <?php echo $_GET['passerror'];} ?>
         </p> 
         <!-- ------ -->
        <input type="password" placeholder="كلمة السر"  style="text-align: right; width: 100%;" name="passw">
        <input type="password" placeholder="تأكيد كلمة السر"  style="text-align: right;" name="re_passw" >
        <div style="text-align: right;">
      <select name="location"  style=" width: 100%;padding: 16px 20px;  border: 1px solid #ddd;; border-radius: 4px;text-align: right;" name="email" >
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
        <div style="text-align: right;">
        <select name="usertype" id="accountType">
          <option value="worker">مقدم خدمة أو عامل</option>
          <option value="client" selected>مستفيد من خدمة أو عميل</option>
        </select>
        </div>
        <div style="text-align: center;">
          <button type="submit"  name="submit" >انشاء حساب</button>
        </div>
      </form>
      <div class="signup">
        <span class="signup">عندك حساب؟
         <a href="Login.php">سجل دخول</a>
        </span>
      </div>
    </div>

  </div>
</body>
</html>
