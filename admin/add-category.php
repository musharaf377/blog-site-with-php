<?php include "header.php"; ?>
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-12">
                  <h1 class="admin-heading">Add New Category</h1>
              </div>
              <div class="col-md-offset-3 col-md-6">
            <?php
                if(isset($_POST['submit'])){
                    include 'config.php';

                    $category_name = mysqli_real_escape_string($connection, $_POST['cat']);

                    //select caetegory
                    $select_query = "SELECT `category_name` FROM `category` WHERE `category_name`='$category_name'";
                    $select_result = mysqli_query($connection, $select_query); 

                    // print_r($select_query);

                    if(mysqli_num_rows($select_result ) > 0){
                        echo "Category name already Exist.";
                    }else{
                    $query = "INSERT INTO `category`(`category_name`) VALUES ('{$category_name}')";
                        $result = mysqli_query($connection, $query);

                        header('location:category.php');
                    }

                }
            
            ?>

                  <!-- Form Start -->
                  <form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST" autocomplete="off">
                      <div class="form-group">
                          <label>Category Name</label>
                          <input type="text" name="cat" class="form-control" placeholder="Category Name" required>
                      </div>
                      <input type="submit" name="submit" class="btn btn-primary" value="Save" required />
                  </form>
                  <!-- /Form End -->
              </div>
          </div>
      </div>
  </div>
<?php include "footer.php"; ?>
