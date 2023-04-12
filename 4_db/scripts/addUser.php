<?php
//print_r($_POST);
foreach($_POST as $key => $value){
//echo "$key: $value<br>";
if (empty($value)){
    echo"<script>history.back();</script>";
    exit();
}
}
require_once "./scripts/connect.php";
$sql = "insert";
$conn->query($sql);
echo $conn->affected_rows; //1-ok, 0-error