<?php

include('includes/config.php');
include('includes/database.php');
include('includes/functions.php');
secure();

include('includes/header.php');

if (isset($_GET['delete'])){
    if ($stm = $connect->prepare('DELETE FROM posts where id = ?')){
        $stm->bind_param('i',  $_GET['delete']);
        $stm->execute();
        

        set_message("A post " . $_GET['delete'] . " has beed deleted");
        header('Location: posts.php');
        $stm->close();
        die();

    } else {
        echo 'Could not prepare statement!';
    }

}

if ($stm = $connect->prepare('SELECT * FROM posts')){
    $stm->execute();

    $result = $stm->get_result();



    
    if ($result->num_rows >0){
  


?>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-9">
        <h1 class="display-1"><font size = "10" style="font-family: verdana"><b><center>POSTS MANAGEMENT</center></b></font></h1>
        <table class="table table-striped table-hover">
         <tr>
            <th>ID</th>
            <th>TITLE</th>
            <th>AUTHOR'S ID</th>
            <th>CONTENT</th>
            <th>EDIT | DELETE</th>

         </tr>

         <?php while($record = mysqli_fetch_assoc($result)){  ?>
        <tr>

        <td><?php echo $record['Id']; ?> </td>
        <td><?php echo $record['title']; ?> </td>
        <td><?php echo $record['author']; ?> </td>
        <td><?php echo $record['content']; ?> </td>
        <td><a href="posts_edit.php?id=<?php echo $record['Id']; ?>">EDIT</a> | 
            <a href="posts.php?delete=<?php echo $record['Id']; ?>">DELETE</a></td>
        </tr>
        
        
        <?php } ?> 


        </table>

        <a href="posts_add.php"> ADD NEW POST</a>
       
        </div>

    </div>
</div>


<?php
   } else 
   {
    echo 'No post found';
   }

    
   $stm->close();

} else {
   echo 'Could not prepare statement!';
}
include('includes/footer.php');
?>