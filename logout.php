<?php
session_start();
session_destroy();
// Clear the cookie
setcookie("user_id", "", time() - 3600, "/"); // Expire the cookie
header("Location: login.html");
exit();
?>
