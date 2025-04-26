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
if($user_role !== "admin"){
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
<div class="container py-5">
    <h2>Email Settings</h2>
    <?php if (isset($_SESSION['admin_success'])): ?>
        <div class="alert alert-success"><?= $_SESSION['admin_success']; unset($_SESSION['admin_success']); ?></div>
    <?php endif; ?>
    <form method="POST" action="../action/setting_action.php">
        <div class="mb-3">
            <label>Mailer Type</label>
            <select name="mailer_type" class="form-control">
                <option value="smtp" <?= $settings['mailer_type'] === 'smtp' ? 'selected' : '' ?>>SMTP</option>
            </select>
        </div>
        <div class="mb-3">
            <label>SMTP Host</label>
            <input type="text" name="smtp_host" class="form-control" value="<?= $settings['smtp_host'] ?? '' ?>" required>
        </div>
        <div class="mb-3">
            <label>SMTP Port</label>
            <input type="number" name="smtp_port" class="form-control" value="<?= $settings['smtp_port'] ?? '' ?>" required>
        </div>
        <div class="mb-3">
            <label>SMTP Username</label>
            <input type="text" name="smtp_username" class="form-control" value="<?= $settings['smtp_username'] ?? '' ?>" required>
        </div>
        <div class="mb-3">
            <label>SMTP Password</label>
            <input type="password" name="smtp_password" class="form-control" value="<?= $settings['smtp_password'] ?? '' ?>" required>
        </div>
        <div class="mb-3">
            <label>SMTP Encryption</label>
            <select name="smtp_encryption" class="form-control">
                <option value="tls" <?= $settings['smtp_encryption'] === 'tls' ? 'selected' : '' ?>>TLS</option>
                <option value="ssl" <?= $settings['smtp_encryption'] === 'ssl' ? 'selected' : '' ?>>SSL</option>
            </select>
        </div>
        <div class="mb-3">
            <label>From Email</label>
            <input type="email" name="from_email" class="form-control" value="<?= $settings['from_email'] ?? '' ?>" required>
        </div>
        <div class="mb-3">
            <label>From Name</label>
            <input type="text" name="from_name" class="form-control" value="<?= $settings['from_name'] ?? '' ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Save Settings</button>
    </form>
</div>

</div>


    <!-- for icon -->
    <script src="../assests/js/icon.js"></script>
    <!-- bootstrap js -->
    <script src="../assests/js/bootstrap.bundle.min.js"></script>

</body>

</html>