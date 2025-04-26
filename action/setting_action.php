<?php
session_start();
include '../config/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $mailer_type = $_POST['mailer_type'];
    $smtp_host = $_POST['smtp_host'];
    $smtp_port = $_POST['smtp_port'];
    $smtp_username = $_POST['smtp_username'];
    $smtp_password = $_POST['smtp_password'];
    $smtp_encryption = $_POST['smtp_encryption'];
    $from_email = $_POST['from_email'];
    $from_name = $_POST['from_name'];

    // Escape values to prevent SQL injection
    $mailer_type = mysqli_real_escape_string($conn, $mailer_type);
    $smtp_host = mysqli_real_escape_string($conn, $smtp_host);
    $smtp_username = mysqli_real_escape_string($conn, $smtp_username);
    $smtp_password = mysqli_real_escape_string($conn, $smtp_password);
    $smtp_encryption = mysqli_real_escape_string($conn, $smtp_encryption);
    $from_email = mysqli_real_escape_string($conn, $from_email);
    $from_name = mysqli_real_escape_string($conn, $from_name);

    $smtp_port = (int)$smtp_port; // safe cast

    // Check if settings exist
    $check = $conn->query("SELECT id FROM email_settings LIMIT 1");
    if ($check->num_rows > 0) {
        // Update existing
        $conn->query("UPDATE email_settings SET
            mailer_type='$mailer_type',
            smtp_host='$smtp_host',
            smtp_port='$smtp_port',
            smtp_username='$smtp_username',
            smtp_password='$smtp_password',
            smtp_encryption='$smtp_encryption',
            from_email='$from_email',
            from_name='$from_name',
            updated_at=NOW()
        ");
    } else {
        // Insert new
        $conn->query("INSERT INTO email_settings 
            (mailer_type, smtp_host, smtp_port, smtp_username, smtp_password, smtp_encryption, from_email, from_name)
            VALUES 
            ('$mailer_type', '$smtp_host', '$smtp_port', '$smtp_username', '$smtp_password', '$smtp_encryption', '$from_email', '$from_name')
        ");
    }

    $_SESSION['admin_success'] = "Email settings updated successfully.";
    header('Location: ../admin/setting.php');
    exit;
} else {
    $_SESSION['admin_error'] = "Invalid access.";
    header('Location: ../admin/setting.php');
    exit;
}
