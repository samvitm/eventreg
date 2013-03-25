<?php
session_start();
echo "You have been logged out  Redirecting to Login Page...";
unset($_SESSION['user']);
usleep(20000);
?>

<html>
    <head>
        <script>
        alert("You have been logged out");
        </script>
        <meta HTTP-EQUIV="REFRESH" content="0; url=./login_new.php">
    </head>
</html>
