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
              <div class="col-md-10">
                  <h1 class="admin-heading">All Users</h1>
              </div>
              <div class="col-md-2">
                  <a class="add-new" href="add-user.php">add user</a>
              </div>
              <div class="col-md-12">

              <?php
                $limit = 3;
                if(isset($_REQUEST['page_number'])){
                  $page_number = $_REQUEST['page_number'];
                }else{
                  $page_number = 1;
                }
                 
                $user_per_page = ($page_number - 1) * $limit;

                $query = "SELECT * FROM user ORDER BY user_id DESC LIMIT {$user_per_page}, {$limit}";

                $result = mysqli_query($connection, $query);
                $count = mysqli_num_rows($result);

                if($count > 0){ ?>

                  <table class="content-table">
                      <thead>
                          <th>DB ID</th>
                          <th>Full Name</th>
                          <th>User Name</th>
                          <th>Role</th>
                          <th>Edit</th>
                          <th>Delete</th>
                      </thead>
                      <tbody>
                      <?php 
                        $serial = $user_per_page + 1;
                        while($row = mysqli_fetch_assoc($result)){?>

                        <tr>
                            <td class='id'><?php echo $serial++;  ?></td>
                            <td><?php echo $row['first_name'] ." ". $row['last_name']  ?></td>
                            <td><?php echo $row['username']  ?></td>
                            <td>
                              <?php if($row['role'] == "admin"){
                                echo "Admin";
                              }else{
                                echo "Modaretor";
                              } ?>
                            </td>
                            <td class='edit'><a href='update-user.php?id=<?php echo $row['user_id']; ?>'><i class='fa fa-edit'></i></a></td>
                            <td class='delete'><a onclick="return confirm('Are you sure?')" href='delete-user.php?id=<?php echo $row['user_id']; ?>'><i class='fa fa-trash-o'></i></a></td>
                        </tr>
                        <?php } ?>

                      </tbody>
                    </table>

            <?php 
              $pagi_query = "SELECT * FROM user";
              $pagi_result = mysqli_query($connection, $pagi_query);
              
              $row_count = mysqli_num_rows($pagi_result);
              $page_count = ceil($row_count/$limit); ?>

              <ul class='pagination admin-pagination'>
        <?php 
              if($page_number > 1){
                echo '<li><a href="users.php?page_number='. ($page_number-1) .' ">prev</a></li>';             
              }

              for ($i=1; $i <= $page_count ; $i++) { 

                if($i == $page_number){
                  $active = 'active';
                }else{
                  $active = "";
                }

                echo "<li class='$active'><a href='users.php?page_number=$i'>$i</a></li>";
              }
              
              if($page_count > $page_number){

                echo '<li><a href="users.php?page_number='.($page_number+1).'">next</a></li>';
              }
        ?>
             </ul>
                <?php } ?>

              </div>
          </div>
      </div>
  </div>
<?php include "footer.php"; ?>
