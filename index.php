<?php

include('includes/config.php');
include('includes/database.php');
include('includes/functions.php');



include('includes/header.php');

if (isset($_POST['email'])){
  if($stm = $connect->prepare('SELECT * FROM users WHERE email = ? AND password = ? AND active = 1')){
    $hashed = SHA1($_POST['password']);
    $stm -> bind_param('ss', $_POST['email'], $hashed);
    $stm->execute();
    
    $result = $stm->get_result();
    $user = $result->fetch_assoc();

    if($user){
      $_SESSION['id']= $user['id'];
      $_SESSION['email']= $user['email'];
      $_SESSION['username']= $user['username'];

      set_message('You have successfully logged in ' . $_SESSION['username']);


      header('Location:dashboard.php');
      die();
    }

    $stm->close();
  }else{
    echo 'could not prepare statement!';
  }
}




?>
<div class="container mt-5">
  <div class="row justify-content-center">
    <div class="col-md-4">
    <font  style="font-family: verdana">
      <form method="post">
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

       

        <!-- Sign in button -->
        <button type="submit" class="btn btn-primary btn-block">Log in</button>
        <div >New user?
    
    <a href="register.php"><font style="line-height:3" > Register </font></a>
    
    </div>

      </form>
     
        
     
    </font>
    </div>

  </div>
</div>


<?php
include('includes/footer.php');
?>

