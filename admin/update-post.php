<?php 
    include "header.php"; 
    include "config.php";
?>

  <div id="admin-content">
      <div class="container">
         <div class="row">
             <div class="col-md-12">
                 <h1 class="admin-heading">Update Post</h1>
             </div>
              <div class="col-md-offset-3 col-md-6">
                <?php 
                    $recv_id = $_REQUEST['id'];
                    $query = "SELECT * FROM `post` WHERE `post_id`='$recv_id' ";
                    $result = mysqli_query($connection, $query);
                    $result_count = mysqli_num_rows($result);
                    $row = mysqli_fetch_assoc($result);

                    print_r($row);
                
                
                ?>
                  <!-- Form -->
                  <form  action="<?php $_SERVER['PHP_SELF'] ?>" method="POST" enctype="multipart/form-data">
                      <div class="form-group">
                          <label for="post_title">Title</label>
                          <input type="text" name="post_title" value="<?php echo $row['title'] ?>" class="form-control" autocomplete="off" required>
                      </div>
                      <div class="form-group">
                          <label for="exampleInputPassword1"> Description</label>
                          <textarea name="postdesc" value="<?php echo $row['description'] ?>" class="form-control" rows="5"  required></textarea>
                      </div>
                      <div class="form-group">
                          <label for="exampleInputPassword1">Category</label>
                          <select name="category" class="form-control" required>
                              <option selected disabled> Select Category</option>
                              
                          </select>
                      </div>
                      <div class="form-group">
                          <label for="fileToUpload">Post image</label>
                          <input type="file" name="fileToUpload" required>
                      </div>
                      <input type="submit" name="submit" class="btn btn-primary" value="Save" required />
                  </form>
                  <!--/Form -->
              </div>
          </div>
      </div>
  </div>
<?php include "footer.php"; ?>
