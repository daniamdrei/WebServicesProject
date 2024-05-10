<?php require'layout/header.php' ?>
<?php require '../Authentication/config.php ' ; ?>
            

<?php 
if(!isset($_SESSION['AdminName'])){
   header('location:http://localhost/php/theme/');
}
//count number of job in the data base
 $servies = $conn->query("SELECT count(*) AS countservies FROM services");
 $servies->execute();
 $countservies = $servies->fetch(PDO::FETCH_OBJ);
 
 //count number of catagories in the data base
 $categories = $conn->query("SELECT count(*) AS categoriecount FROM categorie");
 $categories->execute();
 $categoriecount = $categories->fetch(PDO::FETCH_OBJ);

 //count number of worker in the data base 
 $worker=$conn->query("SELECT count(*) AS workercount FROM worker");
 $worker->execute();
 $workercount = $worker->fetch(PDO::FETCH_OBJ);

?>
      <div class="row pt-5">
        <div class="col-md-4">
          <div class="card">
            <div class="card-body">

              <h5 class="card-title">Services</h5>
              <!-- <h6 class="card-subtitle mb-2 text-muted">Bootstrap 4.0.0 Snippet by pradeep330</h6> -->
              <p class="card-text">number of services: <?php echo $countservies->countservies ;  ?></p>
             
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Categories</h5>
              
              <p class="card-text">number of categories: <?php echo $categoriecount->categoriecount; ?></p>
              
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Worker</h5>
              
              <p class="card-text">number of worker:  <?php echo $workercount->workercount ;  ?></p>
              
            </div>
          </div>
        </div>
      </div>
     <!--  <div class="row">
        <div class="col">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Card title</h5>
              <table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">First</th>
      <th scope="col">Last</th>
      <th scope="col">Handle</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">1</th>
      <td>Mark</td>
      <td>Otto</td>
      <td>@mdo</td>
    </tr>
    <tr>
      <th scope="row">2</th>
      <td>Jacob</td>
      <td>Thornton</td>
      <td>@fat</td>
    </tr>
    <tr>
      <th scope="row">3</th>
      <td>Larry</td>
      <td>the Bird</td>
      <td>@twitter</td>
    </tr>
  </tbody>
</table> -->
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php require'layout/footer.php' ; ?>