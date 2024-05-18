
<?php
//count number of electrician worker 
 $worker=$conn->query("SELECT count(*) AS electrician FROM worker WHERE servicetype = 'كهربائية' ");
 $worker->execute();
 $electrician = $worker->fetch(PDO::FETCH_OBJ);

 //count number of plumber worker 
 $worker = $conn->query("SELECT count(*) AS plumber FROM worker WHERE servicetype = 'السباكة' ");
 $worker->execute();
 $plumber = $worker->fetch(PDO::FETCH_OBJ);

 //count number of carpenter worker 
 $worker = $conn->query("SELECT count(*) AS carpenter FROM worker WHERE servicetype = 'النجارة' ");
 $worker->execute();
 $carpenter = $worker->fetch(PDO::FETCH_OBJ);

 //count number of painter worker 
 $worker = $conn->query("SELECT count(*) AS painter FROM worker WHERE servicetype = 'الدهان' ");
 $worker->execute();
 $painter = $worker->fetch(PDO::FETCH_OBJ);
