<?php 

$connection = mysqli_connect('localhost', 'root', 'root', 'live_news_project');

if (!$connection) {
    echo "Not Connected. " . mysqli_error($connection);
}
?>