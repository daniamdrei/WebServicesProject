<<?php require '../layout/header.php' ; ?>
<?php require '../../Authentication/config.php ' ; ?>

<?php 
if(!isset($_SESSION['AdminName'])){
  header('location:'.ADMINURL.'');
}

if(isset($_POST['submit']))
{  
 //check if the input is empty 

if(empty($_POST['email'] )){
  header("location:create-admins.php?error= email is requird .");
  exit();
}else if(empty($_POST['username'])){
  header("location:create-admins.php?username= name is requird .");
  exit();
}else if(empty($_POST['passw'])){
  header("location:create-admins.php?error= password is requird .");
  exit();
}else{
  //set the variables
  $name =$_POST['username'];
  $email = $_POST['email'];
  $password = $_POST['passw'];
  $user_type = $_SESSION['user_type'];


 
        //checking for username and email availability
        $stmt= $conn->prepare("INSERT INTO user (username, email , password1 , usertype) 
        VALUES(:username , :email ,:password1 , :usertype) ");
        $stmt->execute([
        ':username' => $name ,
        ':email' => $email ,
        ':password1' =>password_hash($password ,PASSWORD_DEFAULT),
        ':usertype'=>$user_type,
          ]);
          header('location:'.ADMINURL.'admins/admins.php');
        $conn = null;
        }
      }
?>


       <div class="row pt-5">
        <div class="col">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title mb-5 d-inline">Create Admins</h5>
          <form method="POST" action="create-admins.php" enctype="multipart/form-data">
                <!-- Email input -->
                <?php if(isset($_GET['error'])): ?>
                  <p class="alert alert-danger"> <?php  echo $_GET['error']?></p>
                  <?php  endif ;?>
                <div class="form-outline mb-4 mt-4">
                  <input type="email" name="email" id="form2Example1" class="form-control" placeholder="email" />
                 
                </div>

                <div class="form-outline mb-4">
                  <input type="text" name="username" id="form2Example1" class="form-control" placeholder="username" />
                </div>
                <div class="form-outline mb-4">
                  <input type="password" name="passw" id="form2Example1" class="form-control" placeholder="password" />
                </div>

               
            
                
              


                <!-- Submit button -->
                <button type="submit" name="submit" class="btn btn-primary  mb-4 text-center">create</button>

          
              </form>

            </div>
          </div>
        </div>
      </div>
      <?php  require '../layout/footer.php' ;?>