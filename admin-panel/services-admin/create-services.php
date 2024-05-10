<?php require '../layout/header.php' ; ?>
<?php require '../../Authentication/config.php ' ; ?>

<?php  
  $select = $conn->query("SELECT * FROM categorie");
  $select->execute();
  $categories = $select->fetchAll(PDO::FETCH_OBJ);?>
<?php 
    if(!isset($_SESSION['AdminName'])){
    header('location:'.ADMINURL.'admins/login-admins.php');
    exit();
    }
    if(isset($_POST['submit'])){

    if(empty( $_POST['name'])){
        header('location:create-services.php?error= please enter name of service');
        exit();
    }else
        if(empty( $_POST['category'])){
            header('location:create-services.php?error= please enter categorys service');
            exit();
            }else{
              if(empty( $_POST['descriptions'])){
                header('location:create-services.php?error= please enter the description');
                exit();

              }else{
                if(empty( $_FILES['img'])){
                  header('location:create-services.php?error= please enter image');
                  exit();

                }else{
            

            $name = $_POST['name'];
            $category = $_POST['category'];
            $descriptions =  $_POST['descriptions'];
            $img =$_FILES['img']['name'];

            $fileTmpName = $_FILES['img']['tmp_name'];
            $fileDestination = '../../Services/Images/'.$img;


            $stmt= $conn->prepare("INSERT INTO services (name , category ,descriptions , img) 
            VALUES(:name , :category ,:descriptions ,:img ) ");
            $stmt->execute([
            ':name' => $name ,
            ':category'=>$category,
            ':descriptions'=>$descriptions,
            ':img'=>$img,
            ]);
            move_uploaded_file($fileTmpName,$fileDestination);
            header('location:'.ADMINURL.'services-admin/show-services.php');
                    exit();

            
    

    }
              }
            }
            
            
            
            
            
    
   }

?>
       <div class="row pt-5">
        <div class="col">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title mb-5 d-inline">Create Services </h5>
          <form method="POST" action="create-services.php" enctype="multipart/form-data">
                <!-- Email input -->
                <?php  if(isset($_GET['error'])):?>
                  <p class="alert alert-danger"> <?php echo $_GET['error'] ;?></p>
                  <?php endif ; ?>
                <div class="form-outline mb-4 mt-4">
                  <input type="text" name="name" id="form2Example1" class="form-control" placeholder="name" />
                </div>
                <div class="form-outline mb-4 mt-4">
                
                <select class="form-select form-control " name="category"> 
                   <?php foreach($categories as $category) :?>
                    <option ><?php echo $category->name?></option>
                    <?php endforeach ;?>
                   </select>
                   
                </div>
                <div class="form-floating pb-3">
                  <textarea class="form-control " id="comment" name="descriptions" placeholder="description"></textarea>
                  </div>
                  <div class="mb-3">
                      <label for="formFile" class="form-label">Choose an image for the service</label>
                      <input class="form-control" type="file" id="formFile" name="img">
                      </div>
                <!-- Submit button -->
                <button type="submit" name="submit" class="btn btn-primary  mb-4 text-center">create</button>

          
              </form>

            </div>
          </div>
        </div>
      </div>
      <?php require'../layout/footer.php' ; ?>