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
    <title>Manage Tours</title>
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

<div class="container-fluid mt-5">
<h2 class="text-center">Manage Tours</h2>

    <?php if (isset($_SESSION['admin_success'])): ?>
        <div class="alert alert-success"> <?= $_SESSION['admin_success']; unset($_SESSION['admin_success']); ?> </div>
    <?php elseif (isset($_SESSION['admin_error'])): ?>
        <div class="alert alert-danger"> <?= $_SESSION['admin_error']; unset($_SESSION['admin_error']); ?> </div>
    <?php endif; ?>
    <div class="text-end mb-3">
    <button class="btn btn-custom" data-bs-toggle="modal" data-bs-target="#addTourModal">+ Add Tour</button>
  </div>
    <div class="table-responsive">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Title</th>
                <th>Image</th>
                <th>Price</th>
                <th>Duration</th>
                <th>Best Time</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        <?php
        include '../config/database.php';
            $result = mysqli_query($conn, "SELECT * FROM tours ORDER BY id DESC");
            while ($row = mysqli_fetch_assoc($result)):
        ?>
            <tr>
                <td><?= $row['id'] ?></td>
                <td><?= $row['name'] ?></td>
                <td><?= $row['title'] ?></td>
                <td><img src="../<?= $row['image'] ?>" alt="image" width="100"></td>
                <td><?= $row['price'] ?></td>
                <td><?= $row['duration'] ?></td>
                <td><?= $row['besttime'] ?></td>
                <td>
                <div class="d-flex gap-2">
                    <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#editTourModal<?= $row['id'] ?>">Edit</button>

                    <?php if($user_role == "admin"): ?>
                    <form action="../action/admin_action.php" method="POST" onsubmit="return confirm('Are you sure?');">
                        <input type="hidden" name="delete_tour" value="<?= $row['id'] ?>">
                        <button class="btn btn-sm btn-danger" type="submit">Delete</button>
                    </form>
                    <?php endif; ?>
                </div>
            </td>

            </tr>

            <!-- Edit Modal -->
            <div class="modal fade" id="editTourModal<?= $row['id'] ?>" tabindex="-1">
              <div class="modal-dialog">
                <form action="../action/admin_action.php" method="post" enctype="multipart/form-data">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Edit Tour</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                      <input type="hidden" name="id" value="<?= $row['id'] ?>">
                      <input type="text" name="name" class="form-control mb-2" placeholder="Name" value="<?= $row['name'] ?>">
                      <input type="text" name="title" class="form-control mb-2" placeholder="Title" value="<?= $row['title'] ?>">
                      <textarea name="description" class="form-control mb-2" placeholder="Description"><?= $row['description'] ?></textarea>
                      <input type="number" step="0.01" name="price" class="form-control mb-2" placeholder="Price" value="<?= $row['price'] ?>">
                      <input type="text" name="duration" class="form-control mb-2" placeholder="Duration" value="<?= $row['duration'] ?>">
                      <input type="text" name="besttime" class="form-control mb-2" placeholder="Best Time" value="<?= $row['besttime'] ?>">
                      <textarea name="locations" class="form-control mb-2" placeholder="Locations"><?= $row['locations'] ?></textarea>
                      <label>Current Image:</label><br>
                      <img src="../<?= $row['image'] ?>" width="100"><br>
                      <label for="image">Change Image:</label>
                      <input type="file" name="image" class="form-control" accept="image/*" onchange="previewImage(this, 'preview<?= $row['id'] ?>')">
                      <img id="preview<?= $row['id'] ?>" width="100" style="display:none;">
                    </div>
                    <div class="modal-footer">
                      <button type="submit" name="edit_tour" class="btn btn-success">Update</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
        <?php endwhile; ?>
        </tbody>
    </table>

   </div>
</div>

<!-- Add Modal -->
<div class="modal fade" id="addTourModal" tabindex="-1">
  <div class="modal-dialog">
    <form action="../action/admin_action.php" method="post" enctype="multipart/form-data" >
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Add New Tour</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <input type="text" name="name" class="form-control mb-2" placeholder="Name" required>
          <input type="text" name="title" class="form-control mb-2" placeholder="Title" required>
          <textarea name="description" class="form-control mb-2" placeholder="Description"></textarea>
          <input type="number" step="0.01" name="price" class="form-control mb-2" placeholder="Price" required>
          <input type="text" name="duration" class="form-control mb-2" placeholder="Duration" required>
          <input type="text" name="besttime" class="form-control mb-2" placeholder="Best Time">
          <textarea name="locations" class="form-control mb-2" placeholder="Locations"></textarea>
          <label for="image">Upload Image:</label>
          <input type="file" name="image" class="form-control" accept="image/*" onchange="previewImage(this, 'addPreview')">
          <img id="addPreview" width="100" style="display:none;">
        </div>
        <div class="modal-footer">
          <button type="submit" name="add_tour" class="btn btn-primary">Add Tour</button>
        </div>
      </div>
    </form>
  </div>
</div>

<script>
function previewImage(input, targetId) {
    const preview = document.getElementById(targetId);
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function (e) {
            preview.src = e.target.result;
            preview.style.display = 'block';
        }
        reader.readAsDataURL(input.files[0]);
    }
}
</script>


    <!-- for icon -->
    <script src="../assests/js/icon.js"></script>
    <!-- bootstrap js -->
    <script src="../assests/js/bootstrap.bundle.min.js"></script>

</body>

</html>