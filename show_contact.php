<?php
session_start();
include "db.php";
include __DIR__."/header.php";
if(!isset($_SESSION['name'])){
    header('Location:login-2.php');
  }



?>
<body>
<div class="row">
            <div class="col-md-12 stretch-card">
              <div class="card">
              <?php 
              if(isset($_SESSION['contact_delete'])){
               if($_SESSION['contact_delete']==1){
               echo '<div class="alert alert-success">
                <strong>Success!</strong> contact deleted.
              </div>';
              unset($_SESSION['contact_delete']);
               }elseif($_SESSION['contact_delete']==0){
                echo '<div class="alert alert-danger">
                <strong>Failes!</strong> contact not delete.
              </div>'; 
              unset($_SESSION['contact_delete']);     
               }
              }
            ?> 
                <div class="card-body">
                  <p class="card-title" style="color:blue">ALL CONTACT INFO</p>
                  <div class="table-responsive">
                    <table id="recent-purchases-listing" class="table">
                      <thead>
                        <tr>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Email</th>
                            <th>Phone No</th>
                            <th>Address</th>
                            <th>Additional Info</th>
                            <th style="color:green" >Edit</th>
                            <th style="color:red">Delete</th>
                           
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                       
                          include "db.php";

                          //for contact info
                    $sql1="SELECT * FROM `contact_info` WHERE user_id='".$_SESSION['user_id']."'";
                    $res=mysqli_query($conn,$sql1);
                    if(mysqli_num_rows($res)>0){
                        while($row = mysqli_fetch_assoc($res)){
                          echo"<tr>
                            <td>".$row['first name']."</td>
                            <td>".$row['last name']."</td>
                            <td>".$row['email']."</td>
                            <td>".$row['phone']."</td>
                            <td>".$row['address']."</td>
                            <td>".$row['additional_info']."</td>
                            <td><button><a  style=\"color:green\" href=\"c_edit.php?id=".$row['id']."\">edit</a></button></td>
                            <td><button ><a style=\"color:red\" href=\"c_delete.php?id=".$row['id']."\">delete</a></button></td>
                        </tr>";
                      }
                    }
                            ?>
                            
                        
                        
                      </tbody>
                    </table>
                    <a href="index.php" class="btn btn-info btn-lg" ><i class="glyphicon glyphicon-repeat"></i> GO BACK</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
          
</body>