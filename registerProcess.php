<?php
session_start();
include "db.php";

if(isset($_REQUEST['submit'])){
    $email=$_REQUEST['email'];
    $username=$_REQUEST['username'];
    $country=$_REQUEST['country'];
    $password=$_REQUEST['password'];
    $code=$_REQUEST['code'];
    //for payment
    $_SESSION['r_email']=$_REQUEST['email'];
    $_SESSION['r_name']=$_REQUEST['username'];
    $Int_p_code = random_int(100000, 999999);  
    $string_p_code = (string)$Int_p_code;
    $current_timestamp = date('Y-m-d ');// 'Y-m-d  for date H:i:s for time'
    //echo $email;
    //for check valid code
    $code_check="SELECT * FROM `users` WHERE P_code='".$code."'";
        $res=mysqli_query($conn,$code_check);
        
    echo $code;
    //check code is valid
    if (mysqli_num_rows($res)==1){
        $sql="INSERT INTO `users` (`name`, `email`,`password`, `country`,`i_code`,`p_code`,`created_at`)
        VALUES ('".$username."','".$email."','".$password."','".$country."','".$code."','".$string_p_code."','".$current_timestamp."')";    
        mysqli_query($conn,$sql);
        $sql_id="SELECT * FROM `users` WHERE `name`='".$username."' and `p_code`='".$string_p_code."' ";
        $ress=mysqli_query($conn,$sql_id);
        // echo $sql_id;
        if(mysqli_num_rows($ress)>0){
            while($row = mysqli_fetch_assoc($ress)){
                  echo $_SESSION['r_id']=$row['id'];
                  echo $_SESSION['r_name']=$row['name'];
            }
        }else{
        //for code is null or have invalid code
        $sql="INSERT INTO `users`(`name`, `email`,`password`, `country`,`p_code`,`created_at`)
        VALUES ('".$username."','".$email."','".$password."','".$country."','".$string_p_code."','".$current_timestamp."')";
        mysqli_query($conn,$sql);
        $sql_id="SELECT * FROM `users` WHERE `name`='".$username."' and `p_code`='".$string_p_code."' ";
         $ress=mysqli_query($conn,$sql_id);
         if(mysqli_num_rows($ress)>0){

             while($row = mysqli_fetch_assoc($ress)){
                   echo $_SESSION['r_id']=$row['id'];
                    echo $_SESSION['r_name']=$row['name'];
             }
            }    
}
   
    echo $sql;
     if(isset($_SESSION['r_id'])){
         header('Location: pay_form.php');
     }else{
         echo 'query error : ' . mysqli_error($conn);
     }
     

}
}
?>