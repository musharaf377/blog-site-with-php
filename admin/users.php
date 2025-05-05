<?php include "header.php"; ?>

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

                        <tr>
                            <td class='id'>01</td>
                            <td>Musharaf Hossain</td>
                            <td>Musharaf</td>
                            <td>admin</td>
                            <td class='edit'><a href=''><i class='fa fa-edit'></i></a></td>
                            <td class='delete'><a href=''><i class='fa fa-trash-o'></i></a></td>
                        </tr>
                      </tbody>
                    </table>
              </div>
          </div>
      </div>
  </div>
<?php include "footer.php"; ?>
