<?php 
    include "header.php";
    include "config.php";
?>
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-10">
                  <h1 class="admin-heading">All Posts</h1>
              </div>
              <div class="col-md-2">
                  <a class="add-new" href="add-post.php">add post</a>
              </div>
              <div class="col-md-12">
                  <table class="content-table">
                      <thead>
                          <th>S.No.</th>
                          <th>Image</th>
                          <th>Title</th>
                          <th>Description</th>
                          <th>Category</th>
                          <th>Date</th>
                          <th>Author</th>
                          <th>Edit</th>
                          <th>Delete</th>
                      </thead>
                      <tbody>

                    <?php 

                        $query = "SELECT * FROM `post`
                                LEFT JOIN category ON post.category = category.category_id
                                LEFT JOIN user ON post.author = user.user_id";


                        $result = mysqli_query($connection, $query);
                        $result_count = mysqli_num_rows($result);

                        if($result_count > 0){
                            $serial = 1;
                            while($row = mysqli_fetch_assoc($result)){ ?>

                          <tr>
                              <td class='id'><?php echo $serial++; ?></td>
                              <td><img height="50px" src="upload/<?php echo $row['post_image'] ?>"></td>
                              <td><?php echo $row['title'] ?></td>
                              <td><?php echo $row['description'] ?></td>
                              <td><?php echo $row['category_name'] ?></td>
                              <td><?php echo $row['post_date'] ?></td>
                              <td><?php echo $row['username'] ?></td>
                              <td class='edit'><a href='update-post.php?id=<?php echo $row['post_id'] ?>'><i class='fa fa-edit'></i></a></td>
                              <td class='delete'><a href='delete-post.php?id=<?php echo $row['post_id'] ?>'><i class='fa fa-trash-o'></i></a></td>
                          </tr>

                    <?php }} ?>

                      </tbody>
                 </table>
                  <ul class='pagination admin-pagination'>
                    <li><a href="post.php?page='.($page_number-1).'">prev</a></li>
                    <li class=''><a href="post.php">1</a></li>
                    <li><a href="post.php">next</a></li>
                  </ul>
              </div>
          </div>
      </div>
  </div>
<?php include "footer.php"; ?>
