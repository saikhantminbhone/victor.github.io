<?php
session_start();
//Destroy session
session_unset();
session_destroy();
setcookie("user_name", "", time() - 3600, "/");
setcookie("user_role", "", time() - 3600, "/");
header("Location: ../index.php");
exit;
