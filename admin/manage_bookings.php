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
    <title>Manage Bookings</title>
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
    <h2 class="text-center">Tour Bookings Management</h2>

    <!-- Success/Error alerts -->
    <?php if (isset($_SESSION['admin_success'])): ?>
        <div class="alert alert-success"><?= $_SESSION['admin_success']; unset($_SESSION['admin_success']); ?></div>
    <?php elseif (isset($_SESSION['admin_error'])): ?>
        <div class="alert alert-danger"><?= $_SESSION['admin_error']; unset($_SESSION['admin_error']); ?></div>
    <?php endif; ?>


    <?php if (isset($_SESSION['admin_success'])): ?>
        <div class="alert alert-success"><?= $_SESSION['admin_success']; unset($_SESSION['admin_success']); ?></div>
    <?php elseif (isset($_SESSION['admin_error'])): ?>
        <div class="alert alert-danger"><?= $_SESSION['admin_error']; unset($_SESSION['admin_error']); ?></div>
    <?php endif; ?>

    <div class="table-responsive mt-3">
    <table class="table table-bordered table-hover">
            <thead >
                <tr>
                    <th>ID</th>
                    <th>Tour</th>
                    <th>User</th>
                    <th>Amount ($)</th>
                    <th>Payment Status</th>
                    <th>Payment Date</th>
                    <th>Booked At</th>
                </tr>
            </thead>
            <tbody>
                <?php
                session_start();
                include '../config/database.php';
                $query = "SELECT b.*, 
                                 t.title AS tour_title, 
                                 u.name AS user_name 
                          FROM bookings b
                          LEFT JOIN tours t ON b.tour_id = t.id
                          LEFT JOIN users u ON b.user_id = u.id
                          ORDER BY b.created_at DESC";
                
                $result = mysqli_query($conn, $query);
                
                if (mysqli_num_rows($result) > 0): ?>
                    <?php while ($row = mysqli_fetch_assoc($result)): ?>
                        <tr>
                            <td><?= $row['id'] ?></td>
                            <td><?= htmlspecialchars($row['tour_title']) ?></td>
                            <td><?= $row['user_name'] ?? 'Guest' ?></td>
                            <td><?= number_format($row['amount'], 2) ?></td>
                            <td>
                                <span class="badge bg-<?= $row['payment_status'] === 'completed' ? 'success' : ($row['payment_status'] === 'failed' ? 'danger' : 'warning') ?>">
                                    <?= ucfirst($row['payment_status']) ?>
                                </span>
                            </td>
                            <td><?= $row['payment_date'] ?? '-' ?></td>
                            <td><?= $row['created_at'] ?></td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr><td colspan="7">No bookings found.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>


</div>





    <!-- for icon -->
    <script src="../assests/js/icon.js"></script>
    <!-- bootstrap js -->
    <script src="../assests/js/bootstrap.bundle.min.js"></script>

</body>

</html>