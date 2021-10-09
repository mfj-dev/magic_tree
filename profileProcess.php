<?php
session_start();
include "db.php";

// for image upload
$statusMsg = '';
// File upload path
$targetDir = "images/";
 $fileName = basename($_FILES["file"]["name"]);
$targetFilePath = $targetDir . $fileName;
$fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);

if(isset($_POST["submit"]) && !empty($_FILES["file"]["name"])){
    // Allow certain file formats
    $allowTypes = array('jpg','png','jpeg','gif','pdf');
    if(in_array($fileType, $allowTypes)){
        // Upload file to server
        if(move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)){
            // Insert image file name into database
              $insert ="UPDATE `users` SET `img`='".$fileName."' WHERE `id`=".$_SESSION['user_id']."";
                $res=mysqli_query($conn,$insert);
                $sql="UPDATE `users` SET `name`='".$_POST['username']."',`email`='".$_POST['email']."',`password`='".$_POST['password']."',`country`='".$_POST['country']."' WHERE `id`=".$_SESSION['user_id']."";
                if(mysqli_query($conn,$sql)){
                $_SESSION['profile_update']=1;
                }else{
                    $_SESSION['profile_update']=0;
                }

            if($res){
                $statusMsg = "The file ".$fileName. " has been uploaded successfully.";
            }else{
                $statusMsg = "File upload failed, please try again.";
            } 
        }else{
            $statusMsg = "Sorry, there was an error uploading your file.";
        }
    }else{
        $statusMsg = 'Sorry, only JPG, JPEG, PNG, GIF, & PDF files are allowed to upload.';
    }
}else{
    $statusMsg = 'Please select a file to upload.';
}

if(isset($_POST["submit"]) && empty($_FILES["file"]["name"])){

    $sql="UPDATE `users` SET `name`='".$_POST['username']."',`email`='".$_POST['email']."',`password`='".$_POST['password']."',`country`='".$_POST['country']."' WHERE `id`=".$_SESSION['user_id']."";
    mysqli_query($conn,$sql);
    if(mysqli_query($conn,$sql)){
        $_SESSION['profile_update']=1;
        }else{
            $_SESSION['profile_update']=0;
        }
}



// Display status message
echo $statusMsg;

$_SESSION['img_status']= $statusMsg;

header('Location:profile.php');
?>