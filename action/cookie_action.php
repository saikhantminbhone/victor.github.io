<?php
if (isset($_POST['accept_cookie'])) {
    setcookie('cookie_consent', 'accepted', time() + (86400 * 7), "/"); 
    header("Location: " . $_SERVER['HTTP_REFERER']);
    exit();
}
if (isset($_POST['reject_cookie'])) {
    setcookie('cookie_consent', 'rejected', time() + (86400 * 7), "/"); 
    header("Location: " . $_SERVER['HTTP_REFERER']);
    exit();
}
?>
