<?php 
    include "header.php";
    include "config.php";

    if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
        header("Location: post.php");
        exit();
    }

?>
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-12">
                  <h1 class="admin-heading">Add User</h1>
              </div>
              <div class="col-md-offset-3 col-md-6">

              <?php

                if(isset($_POST['submit'])){
                   $fname = mysqli_real_escape_string($connection, $_POST['fname']);
                   $lname = mysqli_real_escape_string($connection,$_POST['lname']);
                   $user = mysqli_real_escape_string($connection,$_POST['user']);
                   $password = mysqli_real_escape_string($connection,md5($_POST['password']));
                   $role = mysqli_real_escape_string($connection,$_POST['role']);


                   $query = "SELECT username FROM user WHERE username = '$user'";

                   $result = mysqli_query($connection, $query) or die('query faild.');

                   $count = mysqli_num_rows($result);

                   if($count > 0){
                    echo "Username already exiest.";
                   }else{
                    
                    $insertQuery = "INSERT INTO `user`(`first_name`, `last_name`, `username`, `password`, `role`) VALUES ('$fname','$lname', '$user', '$password', '$role')";

                    $insertResult = mysqli_query($connection, $insertQuery);

                    if($insertResult){
                        echo "data insert.";
                        header('location:users.php');
                    }else{
                        echo 'data does not insert.';
                    }
                   }
                }
              ?>
                  <!-- Form Start -->
                  <form  action="<?php $_SERVER['PHP_SELF']; ?>" method ="POST" autocomplete="off">
                      <div class="form-group">
                          <label>First Name</label>
                          <input type="text" name="fname" class="form-control" placeholder="First Name" required>
                      </div>
                          <div class="form-group">
                          <label>Last Name</label>
                          <input type="text" name="lname" class="form-control" placeholder="Last Name" required>
                      </div>
                      <div class="form-group">
                          <label>User Name</label>
                          <input type="text" name="user" class="form-control" placeholder="Username" required>
                      </div>

                      <div class="form-group">
                          <label>Password</label>
                          <input type="password" name="password" class="form-control" placeholder="Password" required>
                      </div>
                      <div class="form-group">
                          <label>User Role</label>
                          <select class="form-control" name="role" >
                              <option value="modaretor">Modaretor</option>
                              <option value="admin">Admin</option>
                          </select>
                      </div>
                      <input type="submit"  name="submit" class="btn btn-primary" value="Save" required />
                  </form>
                   <!-- Form End-->
               </div>
           </div>
       </div>
   </div>
<?php include "footer.php"; ?>
