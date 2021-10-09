<?php 
session_start();

include "db.php";


if(isset($_REQUEST['submit'])){
        $f_name=$_REQUEST['f_name'];
        $l_name=$_REQUEST['l_name'];
        $phone_no=$_REQUEST['phone_no'];
        $address=$_REQUEST['address'];
        $add_info=$_REQUEST['add_info'];
        $email=$_REQUEST['email'];
    $sql="INSERT INTO `contact_info`(`first name`, `last name`, `phone`, `email`, `address`,`additional_info`,`user_id`) VALUES ('".$f_name."','".$l_name."','".$phone_no."','".$email."','".$address."','".$add_info."','".$_SESSION['user_id']."')";
    // print_r($sql);
    if(mysqli_query($conn,$sql)){
    $_SESSION['contact_update']=1;
    }else{
        $_SESSION['contact_update']=0;
    }  
    header("location:add_contact.php"); 
}
?>