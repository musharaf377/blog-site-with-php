<?php
include "config.php";

$id = $_REQUEST['id'];

 $query = "DELETE FROM `user` WHERE `user`.`user_id` = '$id'";

 $result = mysqli_query($connection, $query);

 if($result){
    header("location:users.php");
 }else{
    echo "Delete Faild";
 }


?>