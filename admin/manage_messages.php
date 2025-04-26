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
    <title>Manage Custom Tours</title>
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


<div class="container-fluid mt-4">
<h2 class="text-center">Manage Custom Tour Requests</h2>

    <!-- Success/Error alerts -->
    <?php if (isset($_SESSION['admin_success'])): ?>
        <div class="alert alert-success"><?= $_SESSION['admin_success']; unset($_SESSION['admin_success']); ?></div>
    <?php elseif (isset($_SESSION['admin_error'])): ?>
        <div class="alert alert-danger"><?= $_SESSION['admin_error']; unset($_SESSION['admin_error']); ?></div>
    <?php endif; ?>



<table class="table table-bordered mt-4">
        <thead class="table-light">
            <tr>
                <th>#</th>
                <th>User Name</th>
                <th>Email</th>
                <th>Message</th>
                <th>Submitted At</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        <?php 
         include '../config/database.php';
        $query = "SELECT * FROM contact_messages ORDER BY submitted_at DESC";
        $result = mysqli_query($conn, $query);
  
        while ($row = mysqli_fetch_assoc($result)): ?>
            <tr>
                <td><?= $index + 1 ?></td>
                <td><?= htmlspecialchars($row['name']) ?></td>
                <td><?= htmlspecialchars($row['email']) ?></td>
                <td><?= htmlspecialchars(substr($row['message'], 0, 50)) ?>...</td>
                <td><?= $row['submitted_at'] ?></td>
                <td>
                <div class="d-flex gap-2">
                <button class="btn btn-primary btn-sm" onclick="openReplyModal(<?= $row['id'] ?>, '<?= htmlspecialchars($row['email']) ?>')">Reply</button>
                    <button class="btn btn-success btn-sm" onclick="viewConversation(<?= $row['id'] ?>)">View Conversation</button>
        </div>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

    <!-- Reply Modal -->
    <div class="modal fade" id="replyModal" tabindex="-1">
        <div class="modal-dialog">
            <form method="POST" action="../action/message_action.php" class="modal-content">
                <input type="hidden" name="action" value="send_reply">
                <input type="hidden" name="message_id" id="replyMessageId">
                <input type="hidden" name="email" id="replyEmail">

                <div class="modal-header">
                    <h5 class="modal-title">Reply to User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <div class="mb-3">
                        <label>Subject</label>
                        <input type="text" class="form-control" name="subject" required>
                    </div>
                    <div class="mb-3">
                        <label>Message</label>
                        <textarea name="content" class="form-control" rows="5" required></textarea>
                    </div>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-success" type="submit">Send Reply</button>
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Conversation Modal -->
    <div class="modal fade" id="conversationModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Conversation</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body" id="conversationContent">
                    <!-- Conversation loads here -->
                </div>
            </div>
        </div>
    </div>



</div>
<script>
        function openReplyModal(messageId, email) {
            document.getElementById("replyMessageId").value = messageId;
            document.getElementById("replyEmail").value = email;
            console.log(email);
            new bootstrap.Modal(document.getElementById("replyModal")).show();
        }

        function viewConversation(messageId) {
            fetch('../action/message_action.php?action=get_conversation&message_id=' + messageId)
                .then(res => res.text())
                .then(html => {
                    console.log(html);
                    document.getElementById("conversationContent").innerHTML = html;
                    new bootstrap.Modal(document.getElementById("conversationModal")).show();
                });
        }
    </script>

    <!-- for icon -->
    <script src="../assests/js/icon.js"></script>
    <!-- bootstrap js -->
    <script src="../assests/js/bootstrap.bundle.min.js"></script>

</body>

</html>