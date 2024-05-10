<?php require '../layout/header.php' ; ?>
<?php require '../../Authentication/config.php ' ; ?>

<?php 
  

  if(!isset($_SESSION['AdminName'])){
    header('location:'.ADMINURL.'/admins/login-admins.php');
   }

   
 $select = $conn->query("SELECT * FROM worker WHERE status = 0 ");
 $select->execute();
 $workers = $select->fetchAll(PDO::FETCH_OBJ);

?>
          <div class="row pt-5">
        <div class="col">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title mb-4 d-inline">Worker</h5>
              <table class="table">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">image</th>
                    <th scope="col">name</th>
                    <th scope="col">email</th>
                    <th scope="col">Phone number</th>
                    <th scope="col">age</th>
                    <th scope="col">service type</th>
                    <th scope="col">experience</th>
                    <th scope="col">location</th>
                    <th scope="col"></th>
                    <th scope="col"></th>

                    
                  </tr>
                </thead>
                
                <tbody>
                  <tr>
                  <?php foreach( $workers as $worker) : ?>
                    <th scope="row"><?php  echo $worker->id ; ?></th>
                    <td> <img class="rounded-circle w-50 h-50" src="../../images/users_img/<?php echo $worker->img?>" alt="image"></td>
                    <td> <?php echo $worker->name ;  ?></td>
                    <td> <?php echo $worker->email ;  ?></td>
                    <td> <?php echo $worker->Phone ;  ?></td>
                    <td> <?php echo $worker->age ;  ?></td>
                    <td> <?php echo $worker->servicetype ;  ?></td>
                    <td> <?php echo $worker->experience ;  ?></td>
                    <td> <?php echo $worker->location ;  ?></td>
                    <td> <a href="workerScript.php?id=<?php echo $worker->id ?>&status=status" class="btn btn-success  text-center ">acceptance</a></td>
                    <td> <a href="workerScript.php?id=<?php echo $worker->id ?>&delete=delete" class="btn btn-danger  text-center ">delete</a></td>
                  </tr>
                  <?php endforeach ;  ?>
                </tbody>
              </table> 
            </div>
          </div>
        </div>
      </div>




<?php  require '../layout/footer.php' ;?>