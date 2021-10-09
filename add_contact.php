<?php
include __DIR__."/header.php";
session_start();
include "db.php";
if(!isset($_SESSION['name'])){
  header('Location:login-2.php');
}
$sql="SELECT * FROM `contact_info` WHERE `user_id`='".$_SESSION['user_id']."'";
$t_c_res=mysqli_query($conn,$sql);//total contant result
$rows = mysqli_num_rows($t_c_res);
$_SESSION['total_contact']=$rows;
?>
<body>
    
    <div class="row">
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
        <form action="add_contact_process.php">
          <!-- 2 column grid layout with text inputs for the first and last names -->
          <div class="row mb-4">
            <div class="col">
              <div class="form-outline">
                <input type="text" id="f_name" name="f_name" class="form-control" required/>
                <label class="form-label" for="form6Example1">First name</label>
              </div>
            </div>
            <div class="col">
              <div class="form-outline">
                <input type="text" id="l_name" name="l_name" class="form-control" required/>
                <label class="form-label" for="form6Example2">Last name</label>
              </div>
            </div>
          </div>

          <!-- Text input -->
          <div class="form-outline mb-4">
            <input type="text" id="address" name="address" class="form-control" required/>
            <label class="form-label" for="form6Example4">Address</label>
          </div>

          <!-- Email input -->
          <div class="form-outline mb-4">
            <input type="email" id="email" name="email" class="form-control" required/>
            <label class="form-label" for="form6Example5">Email</label>
          </div>

          <!-- Number input -->
          <div class="form-outline mb-4">
            <input type="text" id="phone_no" name="phone_no" class="form-control" required/>
            <label class="form-label" for="form6Example6">Phone</label>
          </div>

          <!-- Message input -->
          <div class="form-outline mb-4">
            <textarea class="form-control" name="add_info" id="add_info" rows="4"></textarea>
            <label class="form-label" for="form6Example7">Additional information</label>
          </div>

          <!-- Checkbox -->
          <div class="form-check d-flex justify-content-center mb-2">
          <div class="my-3">
          <div class="btn-group">
                <button type="submit" name="submit" class="btn btn-block btn-primary  font-weight-medium auth-form-btn">ADD CONTACT</button>
                <a href="index.php" class="btn btn-info btn-lg" ><i class="glyphicon glyphicon-repeat"></i> GO BACK</a>  
                </div>
          </div>
          </div>
        </form>
      </div>
    </div>
  </div>

  <div class="col-md-4 mb-4">
    <div class="card mb-4">
      <div class="card-header py-3">
        <h5 class="mb-0">CONTACTS INFO</h5>
      </div>
      <form action="show_contact.php">
      <div class="card-body">
        <ul class="list-group list-group-flush">
          <li
            class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 pb-0">
            total contact
            <span><?php echo $_SESSION['total_contact'];?></span>
          </li>
          <!-- <li class="list-group-item d-flex justify-content-between align-items-center px-0">
            Shipping
            <span>Gratis</span>
          </li>
          <li
            class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 mb-3">
            <div>
              <strong>Total amount</strong>
              <strong>
                <p class="mb-0">(including VAT)</p>
              </strong>
            </div> 
            <span><strong>$53.98</strong></span>
          </li>-->
        </ul>
            <hr>
        <button type="submit" class="btn btn-primary btn-lg btn-block">
          view all contacts or delete contacts
        </button>
      </div>
      </form>
    </div>
  </div>
</div>
</body>