<?php require '../layout/header.php' ; ?>
<?php require '../../Authentication/config.php ' ; ?>

<?php
    

    if(isset($_GET['id']) AND isset($_GET['status'])){
        $id=$_GET['id'];
        

        $Status = $conn->query("UPDATE worker SET status = 1 WHERE id = '$id'");
        $Status->execute();
        header('location:'.ADMINURL.'Workers/workerRequest.php');
        exit();
    }

    if(isset($_GET['id']) AND isset($_GET['delete'])){
        $id = $_GET['id'];
        $delete = ("DELETE  FROM worker WHERE id = ' $id' ");
        $conn->exec($delete);
        header('location:'.ADMINURL.'Workers/show-workers.php');
        exit();
    }
    
    ?>