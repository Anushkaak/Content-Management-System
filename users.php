<?php

include('includes/config.php');
include('includes/database.php');
include('includes/functions.php');
secure();

include('includes/header.php');

if (isset($_GET['delete'])){
    if ($stm = $connect->prepare('DELETE FROM users where id = ?')){
        $stm->bind_param('i',  $_GET['delete']);
        $stm->execute();
        

        set_message("A user " . $_GET['delete'] . " has beed deleted");
        header('Location: users.php');
        $stm->close();
        die();

    } else {
        echo 'Could not prepare statement!';
    }

}

if ($stm = $connect->prepare('SELECT * FROM users')){
    $stm->execute();

    $result = $stm->get_result();



    
    if ($result->num_rows >0){
  


?>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
        <h1 class="display-1"><font size = "10" style="font-family: verdana"><b><center>USER MANAGEMENT</center></b></font></h1>
        <table class="table table-striped table-hover">
         <tr>
            <th>ID</th>
            <th>USERNAME</th>
            <th>EMAIL</th>
            <th>STATUS</th>
            <th>EDIT | DELETE</th>

         </tr>

         <?php while($record = mysqli_fetch_assoc($result)){  ?>
        <tr>

        <td><?php echo $record['id']; ?> </td>
        <td><?php echo $record['username']; ?> </td>
        <td><?php echo $record['email']; ?> </td>
        <td><?php echo $record['active']; ?> </td>
        <td><a href="users_edit.php?id=<?php echo $record['id']; ?>">EDIT</a> | 
            <a href="users.php?delete=<?php echo $record['id']; ?>">DELETE</a></td>
        </tr>
        
        
        <?php } ?> 


        </table>

        <a href="users_add.php"> ADD NEW USER</a>
       
        </div>

    </div>
</div>


<?php
   } else 
   {
    echo 'No users found';
   }

    
   $stm->close();

} else {
   echo 'Could not prepare statement!';
}
include('includes/footer.php');
?>