<?php
session_start();

if($_SESSION['user_role']){
    $user_role = $_SESSION['user_role'];
}

if ($_COOKIE['cookie_consent']== 'accepted') {
    $user_role = $_COOKIE['user_role'] ?? null;
}
// echo $user_role;
// die;
if($user_role !== "admin" && $user_role !== "editor"){
    header("Location: ../index.php");
}




?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Dashboard</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="title" property="og:title" content="Victor Travel & Tour">
    <meta name="Keywords"
        content="Tour, travel, south-east asia, Aisa, vacation, beaches, packages, group travel, solo travel, travel plan">

    <!-- bootstrap css -->
    <link href="../assests/css/bootstrap.css" rel="stylesheet">
    <!-- custom-->
    <link href="../assests/css/style.css" rel="stylesheet">
</head>

<body>

<?php include '../block/header.php';?>

<div class="main">

<div class="container-fluid mt-4">
    <h2 class="text-center">Manage Users</h2>

    <!-- Success/Error alerts -->
    <?php if (isset($_SESSION['admin_success'])): ?>
        <div class="alert alert-success"><?= $_SESSION['admin_success']; unset($_SESSION['admin_success']); ?></div>
    <?php elseif (isset($_SESSION['admin_error'])): ?>
        <div class="alert alert-danger"><?= $_SESSION['admin_error']; unset($_SESSION['admin_error']); ?></div>
    <?php endif; ?>

    <div class="text-end mb-3">
    <button class="btn btn-custom" data-bs-toggle="modal" data-bs-target="#addUserModal">+ Add User</button>
  </div>


    <div class="table-responsive">
    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Role</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        <?php 

        include '../config/database.php';
                // Fetch all users
        $query = "SELECT * FROM users ORDER BY id DESC";
        $result = mysqli_query($conn, $query);

        while($user = mysqli_fetch_assoc($result)): ?>
            <tr>
                <td><?= $user['id'] ?></td>
                <td><?= htmlspecialchars($user['name']) ?></td>
                <td><?= htmlspecialchars($user['email']) ?></td>
                <td><?= htmlspecialchars($user['phone']) ?></td>
                <td><?= $user['role'] ?></td>
                <td>
                <div class="d-flex gap-2">
                    <button class="btn btn-sm btn-primary" 
                            data-bs-toggle="modal" 
                            data-bs-target="#editUserModal<?= $user['id'] ?>">Edit</button>

                     <?php if($user_role == "admin"): ?>
                        <form action="../action/admin_action.php" method="POST" class="d-inline" onsubmit="return confirm('Are you sure?');">
                        <input type="hidden" name="delete_user_id" value="<?= $user['id'] ?>">
                        <button class="btn btn-sm btn-danger" type="submit">Delete</button>
                    </form>
                    <?php endif; ?>
                     </div>
                </td>
            </tr>

            <div class="modal fade" id="editUserModal<?= $user['id'] ?>" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <form action="../action/admin_action.php" method="POST">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Edit User</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <input type="hidden" name="edit_user_id" value="<?= $user['id'] ?>">
                      <div class="mb-3">
                          <label>Name</label>
                          <input type="text" class="form-control" name="name" value="<?= htmlspecialchars($user['name']) ?>" required>
                      </div>
                      <div class="mb-3">
                          <label>Email</label>
                          <input type="email" class="form-control" name="email" value="<?= htmlspecialchars($user['email']) ?>" required>
                      </div>
                      <div class="mb-3">
                          <label>Phone</label>
                          <input type="number" class="form-control" name="phone" value="<?= htmlspecialchars($user['phone']) ?>">
                      </div>

                      <?php if($user_role == "admin"): ?>
                      <div class="mb-3">
                          <label>Role</label>
                          <select name="role" class="form-control">
                              <option value="user" <?= $user['role'] === 'user' ? 'selected' : '' ?>>User</option>
                              <?php if($user_role == "admin"): ?>
                                <option value="editor" <?= $user['role'] === 'editor' ? 'selected' : '' ?>>Editor</option>
                                <?php endif; ?>
                             
                        
                          </select>
                      </div>
                      <?php endif; ?>
                    </div>
                    <div class="modal-footer">
                      <button type="submit" name="update_user" class="btn btn-success">Save changes</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>

        <?php endwhile; ?>
        </tbody>
    </table>
    </div>


    <!-- Add User Modal -->
<div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form action="../action/admin_action.php" method="POST">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addUserModalLabel">Add New User</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
              <label>Name</label>
              <input type="text" class="form-control" name="name" required>
          </div>
          <div class="mb-3">
              <label>Email</label>
              <input type="email" class="form-control" name="email" required>
          </div>
          <div class="mb-3">
              <label>Phone</label>
              <input type="number" class="form-control" name="phone" required>
          </div>
          <div class="mb-3">
              <label>Password</label>
              <input type="password" class="form-control" name="password" required>
          </div>
          <div class="mb-3">
              <label>Role</label>
              <select name="role" class="form-control" required>
                  <option value="user">User</option>
                  <option value="editor">Editor</option>
              </select>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" name="add_user" class="btn btn-success">Add User</button>
        </div>
      </div>
    </form>
  </div>
</div>



</div>


</div>


    <!-- for icon -->
    <script src="../assests/js/icon.js"></script>
    <!-- bootstrap js -->
    <script src="../assests/js/bootstrap.bundle.min.js"></script>

</body>

</html>