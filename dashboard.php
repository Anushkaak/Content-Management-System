<?php

include('includes/config.php');
include('includes/database.php');
include('includes/functions.php');
secure();
include('includes/header.php');

?>
<div class="container mt-5">
  <div class="row justify-content-center">
    <h1 class="display-1"><font size = "10" style="font-family: verdana"><center><b>DASHBOARD</b></center></font></h1>
    <div class="container mt-3">
    <font  style="font-family: verdana">
    <center><a href="users.php">USERS MANAGEMENT </a> |
    <a href="posts.php">POSTS MANAGEMENT</a></center>
    </font>
    </div>

  </div>
</div>


<?php
include('includes/footer.php');
?>