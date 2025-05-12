<?php include "header.php"; 
      include "config.php";

    if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
        header("Location: post.php");
        exit();
    }

    $rec_id = $_REQUEST['id'];

    $query = "SELECT `category_id`, `category_name`, `post` FROM `category` WHERE  `category_id`='$rec_id'";
    $result = mysqli_query($connection, $query);
    
    $count = mysqli_num_rows($result);
    
    $row = mysqli_fetch_assoc($result);

    // print_r($row);
?>
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-12">
                  <h1 class="adin-heading"> Update Category</h1>
              </div>
              <div class="col-md-offset-3 col-md-6">
                  <form action="<?php $_SERVER['PHP_SELF'] ?>" method ="POST">
                      <div class="form-group">
                          <input type="hidden" name="category_id" value="<?php echo $row['category_id']; ?>"  class="form-control" value="" placeholder="">
                      </div>
                      <div class="form-group">
                          <label>Category Name</label>
                          <input type="text" name="category_name" class="form-control" value="<?php echo $row['category_name']; ?>"  placeholder="" required>
                      </div>
                      <input type="submit" name="submit" class="btn btn-primary" value="Update" required />
                  </form>

                  <?php 

                    if(isset($_POST['submit'])){
                        $category_id = $_POST['category_id'];
                        $category_name = mysqli_real_escape_string($connection, $_POST['category_name']);

                        $update_query = "UPDATE `category` SET `category_name`='$category_name' WHERE `category_id`= '{$rec_id}'";

                        $update_result = mysqli_query($connection, $update_query);

                        if($update_result){
                            header("location:category.php");
                        }else{
                            echo "Category Update Faild.";
                        }
                    }
                  
                  
                  
                  
                  ?>
                </div>
              </div>
            </div>
          </div>
<?php include "footer.php"; ?>
