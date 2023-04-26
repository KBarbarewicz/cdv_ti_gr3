<?php
//echo "<pre>";
//print_r($_POST);
//echo "</pre>";
foreach ($_POST as $key => $value){
    if (empty($value)){
        echo "<script>history.back();</script>";
        exit();
    }
}

require_once "./connect.php";
$sql = "INSERT INTO `users` (`city_id`, `firstName`, `lastName`, `birthday`, `email`, `password`) VALUES ('$_POST[city_id]', '$_POST[firstName]', '$_POST[lastName]', '$_POST[birthday]', '$_POST[email]', '$_POST[password]');";
$conn->query($sql);