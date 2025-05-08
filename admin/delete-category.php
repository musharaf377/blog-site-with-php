<?php
include "config.php";

$id = $_REQUEST['id'];

 $query = "DELETE FROM `category` WHERE `category_id` = '$id'";

 $result = mysqli_query($connection, $query);

 if($result){
    header("location:category.php");
 }else{
    echo "Delete Faild";
 }


?>