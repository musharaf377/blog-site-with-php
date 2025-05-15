<?php 
    include "header.php"; 
    include "config.php";
?>

  <div id="admin-content">
      <div class="container">
         <div class="row">
             <div class="col-md-12">
                 <h1 class="admin-heading">Add New Post</h1>
             </div>
              <div class="col-md-offset-3 col-md-6">
                  <!-- Form -->
                  <form  action="<?php $_SERVER['PHP_SELF'] ?>" method="POST" enctype="multipart/form-data">
                      <div class="form-group">
                          <label for="post_title">Title</label>
                          <input type="text" name="post_title" class="form-control" autocomplete="off" required>
                      </div>
                      <div class="form-group">
                          <label for="exampleInputPassword1"> Description</label>
                          <textarea name="postdesc" class="form-control" rows="5"  required></textarea>
                      </div>
                      <div class="form-group">
                          <label for="exampleInputPassword1">Category</label>
                          <select name="category" class="form-control" required>
                              <option selected disabled> Select Category</option>
                              <?php 
                                $query = "SELECT * FROM `category`";
                                $result = mysqli_query($connection, $query);
                                
                                if(mysqli_num_rows($result) > 0){
                                    while($row = mysqli_fetch_assoc($result)){
                                        echo "<option value='" . $row['category_id'] . "'>" . $row['category_name'] . "</option>";
                                    }
                                }
                              ?>
                          </select>
                      </div>
                      <div class="form-group">
                          <label for="exampleInputPassword1">Post image</label>
                          <input type="file" name="fileToUpload" required>
                      </div>
                      <input type="submit" name="submit" class="btn btn-primary" value="Save" required />
                  </form>
                  <!--/Form -->

                <?php

                    if(isset($_POST['submit'])){
                        $title = mysqli_real_escape_string($connection, $_POST['post_title']);
                        $postdesc = mysqli_real_escape_string($connection, $_POST['postdesc']);
                        $category = $_POST['category'];
                        $date = date("d M, Y");
                        $author = $_SESSION['user_id'];
                        $image = $_FILES['fileToUpload'];

                        //image
                        $file_error =[];

                        $file_name = $image['name'];
                        $file_size = $image['size'];
                        $file_tmp = $image['tmp_name'];
                        $file_type = $image['type'];
                        $file_ext_separated = explode('.', $file_name);
                        $file_ext = end($file_ext_separated);

                        print_r($file_ext);

                        

                        $image_extention = ['jpeg','svg', 'png', 'jpg'];

                        if(in_array($file_ext, $image_extention) == false){
                            $file_error[] = "This extension file not allow.";
                        }

                        if($file_size > 2097152 ){
                            $file_error[] = "Please select your image upto 2 MB size.";
                        }
                        
                        $image_new_name = time().'-'. basename($file_name);
                        // print_r($image_new_name);
                        $target = "upload/". $image_new_name ;

                        if(empty($file_error)){
                            move_uploaded_file($file_tmp, $target);
                        }else{
                            // print_r($file_error);
                        }

                        $query = "INSERT INTO `post`(`title`, `description`, `category`, `post_date`, `author`, `post_image`) VALUES ('$title','$postdesc','$category','$date','$author','$image_new_name')" ;

                        $result = mysqli_query($connection, $query);

                        if($result){
                            header("location:post.php");
                        }else{
                            echo "Post insert faild";
                        }

                    }
                  
                  ?>

              </div>
          </div>
      </div>
  </div>
<?php include "footer.php"; ?>
