<?php 
session_start();
define('URL' , 'http://localhost/php/theme/');

ob_start();
require '../Authentication/config.php' ;

if( isset($_GET['Wid']) AND isset($_GET['Uid'])){
  $Wid = $_GET['Wid'];
  $Uid = $_GET['Uid'];
  

  $update = $conn->prepare("UPDATE book SET finished = :finished WHERE user_id = '$Uid' ");
  $update->execute([
    ':finished'=>'1',
  ]);
  header('location:workerProfile.php?id='.$Wid.'');
  exit();
 } 

 if(isset($_GET['Wid']) AND isset($_GET['availability'])){

  $Wid= $_GET['Wid'] ;
  $availability = $_GET['availability'];
   
  if($availability === '1'){
    $update = $conn->prepare("UPDATE worker SET availability = :availability WHERE id = '$Wid' ");
    $update->execute([
      ':availability'=>0 ,
    ]);
    header('location:workerProfile.php?id='.$Wid.'');
    exit();
  }elseif($availability === '0'){
    $update = $conn->prepare("UPDATE worker SET availability = :availability WHERE id = '$Wid' ");
    $update->execute([
      ':availability'=>1,
    ]);
    header('location:workerProfile.php?id='.$Wid.'');
    exit();
  }
}