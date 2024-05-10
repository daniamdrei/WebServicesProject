<?php require '../layout/header.php' ; ?>
<?php require '../../Authentication/config.php ' ; ?>

<?php 


if(!isset($_SESSION['AdminName'])){
  header('location:'.ADMINURL.'admins/login-admins.php');
}


 if(isset($_GET['id'])){
  $id = $_GET['id'];
  $services = $conn->query("SELECT * FROM  services where id = '$id' ");
  $services->execute();
  $service = $services->fetch(PDO::FETCH_OBJ);

 } if(isset($_POST['submit'])){

    if(empty($_POST['name']) AND empty($_POST['category']) AND  empty($_POST['descriptions']) AND empty($_POST['img'])){
       header('location:update-service.php?error=some input are empty');
       exit();
    }else{
      $name = $_POST['name'];
      $category = $_POST['category'];
      $descriptions = $_POST['descriptions'] ;
      $img = $_FILES['img']['name'];

      $fileTmpName = $_FILES['img']['tmp_name'];
      $fileDestination = '../../Services/Images/'.$img;

      $update = $conn->prepare("UPDATE services SET name = :name , category = :category ,descriptions = :descriptions ,
       img = :img WHERE id = '$id'");

       if(!empty($img)){
        unlink("../images/users_img/".$service->img."");
           $update->execute([
            ':name' => $name ,
             ':category'=>$category , 
             'descriptions'=>$descriptions ,
              'img'=>$img]);
           }else{
            $update->execute([
              ':name' => $name ,
               ':category'=>$category , 
               'descriptions'=>$descriptions ,
                'img'=>$service->img]);
           }
      header('location:show-services.php');
 }
}
    
    
?>

       <div class="row pt-5">
        <div class="col">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title mb-5 d-inline">Update Categories</h5>
          <form method="POST" action="update-service.php" enctype="multipart/form-data">
                <!-- Email input -->
                <?php if(isset($_GET['error'])): ?>
                  <p class="alert alert-danger"><?php  echo $_GET['error'] ;?> </p>
                  <?php endif ; ?>
                <div class="form-outline mb-4 mt-4">
                  <input type="text" name="name" id="form2Example1" class="form-control" placeholder="<?php echo $service->name ?>" value=" <?php echo $service->name ?>">
                 
                </div>
                <div class="form-outline mb-4 mt-4">
                  <input type="text" name="category" id="form2Example1" class="form-control" placeholder="<?php echo $service->category ?>"  value="<?php echo $service->category ?> " >
                 
                </div>
                <div class="form-floating pb-3">
                  <textarea class="form-control " id="comment" name="descriptions" placeholder="<?php echo $service->descriptions	?>" value=" <?php echo $service->descriptions	?>"></textarea>
                  </div>
                  <div class="mb-3">
                      <label for="formFile" class="form-label">Choose an image for the service</label>
                      <input class="form-control" type="file" id="formFile" name="img">
                      </div>
      
                <!-- Submit button -->
                <button type="submit" name="submit" class="btn btn-primary  mb-4 text-center">update</button>

          
              </form>

            </div>
          </div>
        </div>
      </div>
      <?php require'../layout/footer.php' ; ?>