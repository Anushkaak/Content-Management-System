<?php

include('includes/config.php');
include('includes/database.php');
include('includes/functions.php');
secure();

include('includes/header.php');

if (isset($_POST['title'])) {

    if ($stm = $connect->prepare('UPDATE posts set  title = ?, content = ?, date = ?  WHERE id = ?')) {
        $stm->bind_param('sssi', $_POST['title'], $_POST['content'], $_POST['date'], $_GET['id']);
        $stm->execute();




        $stm->close();

       

        set_message("A post  " . $_GET['id'] . " has beed updated");
        header('Location: posts.php');
        die();

    } else {
        echo 'Could not prepare post update statement statement!';
    }





}


if (isset($_GET['id'])) {

    if ($stm = $connect->prepare('SELECT * from posts WHERE id = ?')) {
        $stm->bind_param('i', $_GET['id']);
        $stm->execute();

        $result = $stm->get_result();
        $post = $result->fetch_assoc();

        if ($post) {


            ?>
            <div class="container mt-5">
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <h1 class="display-1"><font size = "10" style="font-family: verdana"><b><center>EDIT POST</center></b></font></h1>

                        <form method="post">

    <!-- Title name input -->
    <font  style="font-family: verdana">
    <div class="form-outline mb-4">
          <input type="text" name= "title"  id="title" class="form-control" value="<?php echo $post['title'] ?>"/>
          <label class="form-label " for="title">Title</label>
        </div>

        

        <!-- Content input -->
        <div class="form-outline mb-4">
          <textarea name="content" id="content" <?php echo $post['content'] ?> </textarea>
        </div>

        <!-- Date input -->
        <div class="form-outline mb-4">
        <input type="date" name="date"  id="date" class="form-control" value="<?php echo $post['date'] ?>" />
          <label class="form-label" for="content">Date</label>  
        </div>

       

        <!-- Submit button -->
        <button type="submit" class="btn btn-primary btn-block">UPDATE POST</button>
      </form>



                    </div>

                </div>
            </div>

            <script src="js/tinymce/js\tinymce/tinymce.min.js"></script>
                <script>
                tinymce.init({
                selector : '#content'
             });
            </script>


            <?php
        }
        $stm->close();
     

    } else {
        echo 'Could not prepare statement!';
    }

} else {
    echo "No user selected";
    die();
}

include('includes/footer.php');
?>