
<?php 
    include "config.php";

    session_start();
    if(isset($_SESSION['username'])){
        header("location:users.php");
    }
?>
<!doctype html>
<html>
   <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>ADMIN | Login</title>
        <link rel="stylesheet" href="../css/bootstrap.min.css" />
        <link rel="stylesheet" href="../fonts/font-awesome-4.7.0/css/font-awesome.css">
        <link rel="stylesheet" href="../css/style.css">
    </head>

    <body>
        <div id="wrapper-admin" class="body-content">
            <div class="container">
                <div class="row">
                    <div class="col-md-offset-4 col-md-4">
                        <img class="logo" src="../images/news.jpg">
                        <h3 class="heading">Admin</h3>
                        <?php
                            if(isset($_POST['login'])){

                                $username = mysqli_real_escape_string($connection, $_POST['username']);
                                $password = md5($_POST['password']);

                                $query = "SELECT `user_id`,`first_name`, `last_name`, `username`, `role` FROM `user` WHERE `username`='$username' AND `password`= '$password'";

                                $query_result = mysqli_query($connection, $query);
                                if(mysqli_num_rows($query_result) > 0 ){
                                    while($row = mysqli_fetch_assoc($query_result)){

                                        $_SESSION['first_name'] = $row['first_name'];
                                        $_SESSION['last_name'] = $row['last_name'];
                                        $_SESSION['username'] = $row['username'];
                                        $_SESSION['role'] = $row['role'];
                                        $_SESSION['user_id'] = $row['user_id'];
                                        $_SESSION['role'] = $row['role'];

                                        header("location:users.php");
                                    }
                                }else{
                                    echo "You are not this user.";
                                }
                                
                            }
                        ?>
                        <!-- Form Start -->
                        <form  action="" method ="POST">
                            <div class="form-group">
                                <label>Username</label>
                                <input type="text" name="username" class="form-control" placeholder="" required>
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" name="password" class="form-control" placeholder="" required>
                            </div>
                            <input type="submit" name="login" class="btn btn-primary" value="login" />
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>