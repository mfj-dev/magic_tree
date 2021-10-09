<?php 
session_start();

include "db.php";


if(isset($_REQUEST['submit'])){
        $email=$_REQUEST['email'];
        $password=$_REQUEST['password'];
        $sql="SELECT * FROM `users` WHERE email='".$email."'";
        $result=mysqli_query($conn,$sql);
        if(mysqli_num_rows($result)>0){
            while($row = mysqli_fetch_assoc($result)){
                // if(password_verify($password,$row['password'])){
                    if($password==$row['password']){
                    $_SESSION['name']=$row['name'];
                    $_SESSION['user_id']=$row['id'];
                    $_SESSION['email']=$row['email'];
                    $_SESSION['country']=$row['country'];
                    $_SESSION['p_code']=$row['P_code'];
                    $_SESSION['i_code']=$row['i_code'];
                    $_SESSION['password']=$row['password'];
                    $_SESSION['imageURL'] = 'images/'.$row["img"];
                    //for check number of invite links
                    $p_code=$row['P_code'];
                    $_SESSION['P_code']=$row['P_code'];
                    $sql1="SELECT COUNT(*) FROM `users` WHERE i_code='".$p_code."'";
                    $result1=mysqli_query($conn,$sql1);
                    
                     $count=$result1->fetch_row();
                    //  $_SESSION['total_d_invite']=$count[0];
                    // $_SESSION['total_d_invite']=$count;
                    if($count[0]==0){
                        $_SESSION['total_d_invite']='0';

                    }else{
                        $_SESSION['total_d_invite']=$count[0];
                    }
                    //for  checking joining date

                    $join_date=$row['created_at'];
                    $_SESSION['joining_date']=date('Y-m-d', strtotime($join_date));
                    
                    
                        //link
                        $link = "http://".$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF'])."/register-2.php?code=$p_code";
                        $_SESSION['i_link']=$link;


                    header("Location:index.php");
                }
                else{
                    echo "incorrect password";
                }
                }
            
            }
        }
          
    

?>