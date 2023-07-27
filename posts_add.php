<?php

include('includes/config.php');
include('includes/database.php');
include('includes/functions.php');
secure();
include('includes/header.php'); 

if(isset($_POST['title'])){
    if($stm = $connect->prepare('INSERT INTO posts(title,content,author,date) VALUES(?,?,?,?)')){
    $stm -> bind_param('ssis',$_POST['title'], $_POST['content'],$_SESSION['id'],$_POST['date']);
    $stm->execute();

    set_message('A new post ' . $_SESSION['username'].' has been added!');
      header('Location:posts.php');
      $stm->close();
      die();
  }else{
    echo 'could not prepare statement!';
  }
}

?>


<div class="container mt-5">
  <div class="row justify-content-center">
  

  
    <h1 class="display-1"><font size = "10" style="font-family: verdana"><b><center>ADD POSTS</center></b></font></h1>
    <div class="col-md-9">
    
    <form method="post">

    <!-- Title name input -->
    <font  style="font-family: verdana">
    <div class="form-outline mb-4">
          <input type="text" name= "title"  id="title" class="form-control" />
          <label class="form-label " for="title">Title</label>
        </div>

        

        <!-- Content input -->
        <div class="form-outline mb-4">
          <textarea name="content" id="content" ></textarea>
        </div>

        <!-- Date input -->
        <div class="form-outline mb-4">
        <input type="date" name="date"  id="date" class="form-control" />
          <label class="form-label" for="content">Date</label>  
        </div>

       

        <!-- Submit button -->
        <button type="submit" class="btn btn-primary btn-block">Add Post</button>
      </form>    
    </div>
</font>
  </div>
</div>

<script src="js/tinymce/js\tinymce/tinymce.min.js"></script>
<script>
  tinymce.init({
    selector : '#content'
  });
</script>
<?php include('includes/footer.php'); ?>