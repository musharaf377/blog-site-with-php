<?php 
include "header.php"; 
include "config.php"; 
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
                $query = "SELECT * FROM user ORDER BY user_id DESC";

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
                        $serial = 1;
                        while($row = mysqli_fetch_assoc($result)){ var_dump($row);?>

                        <tr>
                            <td class='id'><?php echo $serial++;  ?></td>
                            <td><?php echo $row['first_name'] ." ". $row['last_name']  ?></td>
                            <td><?php echo $row['username']  ?></td>
                            <td>
                              <?php if($row['role'] == 1){
                                echo "Admin";
                              }else{
                                echo "Modaretor";
                              } ?>
                            </td>
                            <td class='edit'><a href='update-user.php?id=<?php echo $row['user_id']; ?>'><i class='fa fa-edit'></i></a></td>
                            <td class='delete'><a href='delete-user.php?id=<?php echo $row['user_id']; ?>'><i class='fa fa-trash-o'></i></a></td>
                        </tr>
                        <?php } ?>

                      </tbody>
                    </table>

                <?php } ?>

              </div>
          </div>
      </div>
  </div>
<?php include "footer.php"; ?>
