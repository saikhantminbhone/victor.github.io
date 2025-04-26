<?php
session_start();
include '../config/database.php';

if (isset($_POST['action']) && $_POST['action'] === 'send_reply') {
    $message_id = $_POST['message_id'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $content = $_POST['content'];

    //echo $email.$subject.$content;

    // Save reply in DB
    $query = "INSERT INTO message_replies (message_id, subject,content) VALUES (?, ?, ?)";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "iss", $message_id,$subject, $content);

    if (mysqli_stmt_execute($stmt)) {
        // Send email (simple PHP mail function)
       // mail($email, $subject, $content, "From: admin@example.com");

        $_SESSION['admin_success'] = "Reply sent and email delivered.";
    } else {
        $_SESSION['admin_error'] = "Failed to save reply.";
    }

    header("Location: ../admin/manage_messages.php");
    exit;
}

if (isset($_GET['action']) && $_GET['action'] === 'get_conversation') {
    $message_id = $_GET['message_id'];

    // Get original message from contact_messages
    $msg_query = "SELECT * FROM contact_messages WHERE id = ?";
    $msg_stmt = mysqli_prepare($conn, $msg_query);
    mysqli_stmt_bind_param($msg_stmt, "i", $message_id);
    mysqli_stmt_execute($msg_stmt);
    $msg_result = mysqli_stmt_get_result($msg_stmt);
    $msg = mysqli_fetch_assoc($msg_result);

    // Get all replies from message_replies
    $reply_query = "SELECT * FROM message_replies WHERE message_id = ? ORDER BY replied_at ASC";
    $reply_stmt = mysqli_prepare($conn, $reply_query);
    mysqli_stmt_bind_param($reply_stmt, "i", $message_id);
    mysqli_stmt_execute($reply_stmt);
    $reply_result = mysqli_stmt_get_result($reply_stmt);
    ?>

    <div><strong>User Message:</strong><br><?= nl2br(htmlspecialchars($msg['message'])) ?></div><hr>

    <?php while ($reply = mysqli_fetch_assoc($reply_result)): ?>
        <div style="margin-bottom: 10px; background:#e6f3ff; padding: 10px;">
            <strong>Admin:</strong><br>
            <strong>Subject:</strong> <?= htmlspecialchars($reply['subject']) ?><br>
            <?= nl2br(htmlspecialchars($reply['content'])) ?><br>
            <small><?= $reply['replied_at'] ?></small>
        </div>
    <?php endwhile;
    exit;
}

?>
