<?php


function secure(){
    if(!isset($_SESSION['id'])){
        echo'please login first to view the page!';
        die();

    }
}


function SET_message($message){
    {
        $_SESSION['message'] = $message;
    }
}

function get_message(){
    if(isset($_SESSION['message'])){
        echo "<script type='text/javascript'> showToast('" . $_SESSION['message'] . "','top right' , 'success') </script>";
        unset($_SESSION['message']);
    }
}