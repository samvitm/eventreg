<?php
$to = "samvit.1@gmail.com";
$subject = "Test mail";
$message = "";
$from = "samvit.1@gmail.com";
$headers = "From: $from";
ini_set("SMTP","smtp");
ini_set("smtp_port","8080");
mail($to,$subject,$message,$headers);
echo "Mail Sent.";
?> 