<?php
session_start();
include "db.php";
include __DIR__."/header.php";
if(!isset($_SESSION['name'])){
    header('Location:login-2.php');
  }
 
 if(!isset($_REQUEST['submit']))
 {
  $_SESSION['c_id']=$_REQUEST['id'];  
  $sql="SELECT * FROM `contact_info` WHERE `id`=".$_SESSION['c_id']."";
  $result=mysqli_query($conn,$sql);
 if(mysqli_num_rows($result)>0){
     while($row = mysqli_fetch_assoc($result)){
       $_SESSION['c_fname']=$row['first name'];
       $_SESSION['c_lname']=$row['last name'];
       $_SESSION['c_phone']=$row['phone'];
       $_SESSION['c_email']=$row['email'];
       $_SESSION['c_address']=$row['address'];
       $_SESSION['c_add_info']=$row['additional_info'];
     }
    }
 }
 if(isset($_REQUEST['submit']))
 {
   
  $sql="UPDATE `contact_info` SET `first name`='".$_REQUEST['f_name']."',`last name`='".$_REQUEST['l_name']."',`phone`='".$_REQUEST['phone_no']."',`email`='".$_REQUEST['email']."',`address`='".$_REQUEST['address']."',`additional_info`='".$_REQUEST['add_info']."' WHERE `id`=".$_SESSION['c_id']."";
  if(mysqli_query($conn,$sql)){
    $_SESSION['contact_update']=1;
  }else{
    $_SESSION['contact_update']=0;
  }
  $_SESSION['c_fname']=$_REQUEST['f_name'];
  $_SESSION['c_lname']=$_REQUEST['l_name'];
  $_SESSION['c_phone']=$_REQUEST['phone_no'];
  $_SESSION['c_email']=$_REQUEST['email'];
  $_SESSION['c_address']=$_REQUEST['address'];
  $_SESSION['c_add_info']= $_REQUEST['add_info'];
  
 }
?>
<body>
  <div class="row" style="margin-left: 22%">
  <div class="col-md-8 mb-4">
    <div class="card mb-4">
    <?php 
              if(isset($_SESSION['contact_update'])){
               if($_SESSION['contact_update']==1){
               echo '<div class="alert alert-success">
                <strong>Success!</strong> contact updated.
              </div>';
              unset($_SESSION['contact_update']);
               }elseif($_SESSION['contact_update']==0){
                echo '<div class="alert alert-danger">
                <strong>Failes!</strong> contact not updated.
              </div>'; 
              unset($_SESSION['contact_update']);     
               }
            }
               ?> 
      <div class="card-header py-3">
        <h5 class="mb-0">ADD CONTACT INFO</h5>
      </div>
      <div class="card-body">
        <form action="">
          <!-- 2 column grid layout with text inputs for the first and last names -->
          <div class="row mb-4">
            <div class="col">
              <div class="form-outline">
                <input type="text" id="f_name" name="f_name" class="form-control" value=<?php echo $_SESSION['c_fname'] ?> required/>
                <label class="form-label" for="form6Example1">First name</label>
              </div>
            </div>
            <div class="col">
              <div class="form-outline">
                <input type="text" id="l_name" name="l_name" class="form-control" value=<?php echo $_SESSION['c_lname'] ?> required/>
                <label class="form-label" for="form6Example2">Last name</label>
              </div>
            </div>
          </div>

          <!-- Text input -->
          <div class="form-outline mb-4">
            <input type="text" id="address" name="address" class="form-control" value=<?php echo $_SESSION['c_address'] ?> required/>
            <label class="form-label" for="form6Example4">Address</label>
          </div>

          <!-- Email input -->
          <div class="form-outline mb-4">
            <input type="email" id="email" name="email" class="form-control" value=<?php echo $_SESSION['c_email'] ?> required/>
            <label class="form-label" for="form6Example5">Email</label>
          </div>

          <!-- Number input -->
          <div class="form-outline mb-4">
            <input type="text" id="phone_no" name="phone_no" class="form-control" value=<?php echo $_SESSION['c_phone'] ?> required/>
            <label class="form-label" for="form6Example6">Phone</label>
          </div>

          <!-- Message input -->
          <div class="form-outline mb-4">
            <textarea class="form-control" name="add_info" id="add_info" rows="4"  ><?php echo $_SESSION['c_add_info']?> </textarea>
            <label class="form-label" for="form6Example7">Additional information</label>
          </div>

          <!-- Checkbox -->
          <div class="form-check d-flex justify-content-center mb-2">
          <div class="my-3">
            <div class="btn-group">
                <button type="submit" name="submit" class="btn btn-block btn-primary  font-weight-medium auth-form-btn">UPDATE CONTACT</button>  
                <a href="show_contact.php" class="btn btn-info btn-lg" ><i class="glyphicon glyphicon-repeat"></i> GO BACK</a>
              </div>
          </div>
          </div>
        </form>
      </div>
    </div>
  </div>


      </form>
    </div>
  </div>
</div>
</body>