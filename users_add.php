<?php

include('includes/config.php');
include('includes/database.php');
include('includes/functions.php');
secure();
include('includes/header.php'); 

if(isset($_POST['username'])){
    if($stm = $connect->prepare('INSERT INTO users(username,email,password,active) VALUES(?,?,?,?)')){
    $hashed = SHA1($_POST['password']);
    $stm -> bind_param('ssss',$_POST['username'], $_POST['email'], $hashed,$_POST['active']);
    $stm->execute();

    set_message('A new user ' . $_SESSION['username'].' has been added!');
      header('Location:users.php');
      $stm->close();
      die();
  }else{
    echo 'could not prepare statement!';
  }
}

?>


<div class="container mt-5">
  <div class="row justify-content-center">
  

  
    <h1 class="display-1"><font size = "10" style="font-family: verdana"><b><center>ADD USERS</center></b></font></h1>
    <div class="col-md-4">
    
    <form method="post">

    <!-- Username input -->
    <font  style="font-family: verdana">
    <div class="form-outline mb-4">
          <input type="text" name= "username" placeholder="Enter Username" id="username" class="form-control" />
          <label class="form-label " for="email">Username</label>
        </div>

        <!-- Email input -->
        <div class="form-outline mb-4">
          <input type="email" name= "email" placeholder="Enter Email ID" id="email" class="form-control" />
          <label class="form-label " for="email">Email address</label>
        </div>

        <!-- Password input -->
        <div class="form-outline mb-4">
          <input type="password" name="password" placeholder="Enter Password" id="password" class="form-control" />
          <label class="form-label" for="password">Password</label>
        </div>

        <!-- Active select -->
        <div class="form-outline mb-4">
            <select name="active" class ="form-select" id="active">
                <option value="1">Active</option>
                <option value="0">Inactive</option>
            </select>
        </div>

       

        <!-- Submit button -->
        <button type="submit" class="btn btn-primary btn-block">Add User</button>
      </form>    
    </div>
</font>
  </div>
</div>


<?php include('includes/footer.php'); ?>