<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

$conn=mysqli_connect("localhost","root","","zam21");

if(!$conn){
    echo "Connection Error";
}

?>