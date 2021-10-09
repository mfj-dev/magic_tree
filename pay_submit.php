<?php
include "db.php";
session_start();
require("config_pay.php");
if(isset($_POST['stripeToken'])){
\Stripe\Stripe::setVerifySslCerts(false);
$token=$_POST['stripeToken'];
$data=\Stripe\charge::create(
    array(
    "amount"=>3000,
    "currency"=>"usd",
    "description"=>"joining fee",
    "source"=>$token,
    )
);
echo "<pre>";
//  print_r($_POST);
//  print_r($data);
//  print_r($data['billing_details']['name']);
 $amount=$data['amount_captured'];
 echo $amount/100;
 echo $_SESSION['r_id'];
 echo $_SESSION['r_name'];
 echo $_SESSION['amount']=$amount/100;;
echo $sql_pay="INSERT INTO `pay_info`( `email`, `user_id`, `amount`,`stripe_id`) VALUES ('".$data['billing_details']['name']."','".$_SESSION['r_id']."','".$_SESSION['amount']."','".$data['id']."')";
if(mysqli_query($conn,$sql_pay)){
    header('Location: login-2.php');
}else{
    echo 'query error : ' . mysqli_error($conn);
}

}
else{
    echo 'something went wrong';
}
?>