<?php
 include_once'db/connect_db.php';
 session_start();
 if(!isset($_SESSION['role'])){
  header('location:index.php');
}
if($_SESSION['role']!=="Admin"){
header('location:index.php');
}

$delete = $pdo->prepare("DELETE FROM tbl_category WHERE cat_id = '".$_GET['id']." '");
if($delete->execute()){
    header('location:category.php');
}


