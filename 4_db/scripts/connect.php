<?php
//echo "db";
$conn = new mysqli(hostname:"localhost", username:"root", password:"", database:"cdv_gr_3");
echo $conn->connect_errno;
?>

