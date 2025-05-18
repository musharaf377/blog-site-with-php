<?php 
 include "config.php";

$recv_id = $_REQUEST['id'];
echo $recv_id;

$query = "DELETE FROM post WHERE `post_id` = '$recv_id';";
$query .= "UPDATE `category` SET post = post - 1 WHERE `category_id`='$recv_id'";

$result = mysqli_multi_query($connection, $query);

if($result){
    header("location:post.php");
}else{
    echo "Delete Faild";
}