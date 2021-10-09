<?php
session_start();
include "db.php";
if(!isset($_SESSION['name'])){
    header('Location:login-2.php');
  }
  if(isset($_REQUEST['id']))
 {
    $sql="DELETE FROM `contact_info` WHERE `id`=".$_REQUEST['id']."";
    if(mysqli_query($conn,$sql)){
        $_SESSION['contact_delete']=1;
        header("location:show_contact.php");
    }else
    {
        $_SESSION['contact_delete']=0;
    }
}

?>
