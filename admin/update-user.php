<?php 
    include "header.php";
    include "config.php";

    if (!isset($_SESSION['role'] !== 'admin')) {
        header("Location: post.php");
        exit();
    }
?>
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-12">
                  <h1 class="admin-heading">Modify User</h1>
              </div>
              <div class="col-md-offset-3 col-md-6">
                <?php 
                    $id = $_GET['id'];

                    $query = "SELECT * FROM user WHERE user_id='$id'";
                    $result = mysqli_query($connection, $query);
                    
                    $count = mysqli_num_rows($result);
                    $row = mysqli_fetch_assoc($result);
                    // var_dump($row);
                ?>
                  <!-- Form Start -->
                  <form  action="<?php $_SERVER['PHP_SELF']; ?>" method ="POST" autocomplete="off">
                      <div class="form-group">
                          <label>First Name</label>
                          <input type="text" name="fname" value="<?php echo $row['first_name']; ?>" class="form-control" placeholder="First Name" required>

                          <input type="hidden" name="user_id" value="<?php echo $row['user_id']; ?>">
                      </div>
                          <div class="form-group">
                          <label>Last Name</label>
                          <input type="text" name="lname" value="<?php echo $row['last_name']; ?>" class="form-control" placeholder="Last Name" required>
                      </div>
                      <div class="form-group">
                          <label>User Name</label>
                          <input type="text" name="user" value="<?php echo $row['username']; ?>" class="form-control" placeholder="Username" required>
                      </div>
                      <div class="form-group">
                          <label>User Role</label>
                          <select class="form-control" name="role" >
                              <option value="modaretor" <?php echo $row['role'] == 'modaretor' ? 'selected' : ''; ?>>Modaretor</option>
                              <option value="admin" <?php echo $row['role'] == 'admin' ? 'selected' : ''; ?>>Admin</option>
                          </select>
                      </div>
                      <input type="submit"  name="submit" class="btn btn-primary" value="Update" required />
                  </form>
                   <!-- Form End-->

                   <?php 
                        if(isset($_POST['submit'])){
                            $fname = mysqli_real_escape_string($connection, $_POST['fname']);
                            $lname = mysqli_real_escape_string($connection,$_POST['lname']);
                            $user = mysqli_real_escape_string($connection,$_POST['user']);
                            $role = mysqli_real_escape_string($connection,$_POST['role']);

                            $update_query = "UPDATE `user` SET `first_name`='$fname',`last_name`='$lname',`username`='$user',`role`='$role' WHERE `user_id`='$id'";

                            $update_result = mysqli_query($connection, $update_query);

                            if($update_result){
                                header("location:users.php");
                            }else{
                                echo "update failed.";
                            }
                        }
                   ?>
               </div>
           </div>
       </div>
   </div>
<?php include "footer.php"; ?>
