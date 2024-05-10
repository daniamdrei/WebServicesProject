<?php require '../layout/header.php' ; ?>
<?php require '../../Authentication/config.php ' ; ?>

<?php 
  

  if(!isset($_SESSION['AdminName'])){
    header('location:'.ADMINURL.'/admins/login-admins.php');
   }

   $user_type = $_SESSION['user_type'];
 $select = $conn->query("SELECT * FROM user where usertype = '$user_type' ");
 $select->execute();
 $admins = $select->fetchAll(PDO::FETCH_OBJ);

?>
          <div class="row pt-5">
        <div class="col">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title mb-4 d-inline">Admins</h5>
             <a  href="<?php echo ADMINURL?>/admins/create-admins.php" class="btn btn-primary mb-4 text-center float-right">Create Admins</a>
              <table class="table">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">username</th>
                    <th scope="col">email</th>
                  </tr>
                </thead>
                
                <tbody>
                  <tr>
                  <?php foreach( $admins as $admin) : ?>
                    <th scope="row"><?php  echo $admin->user_id ; ?></th>
                    <td> <?php echo $admin->username ; ?></td>
                    <td> <?php echo $admin->email ;  ?></td>
                  </tr>
                  <?php endforeach ;  ?>
                </tbody>
              </table> 
            </div>
          </div>
        </div>
      </div>




<?php  require '../layout/footer.php' ;?>