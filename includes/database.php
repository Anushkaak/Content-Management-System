<?php

$connect = mysqli_connect('localhost' , 'cms', 'password', 'cms');

if(mysqli_connect_errno()){
    exit('failed to connect to MYSQL: ' .mysqli_connect_errno());

}