<?php

require_once "./connect.php";

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $required_fields = ['city_id', 'firstName', 'lastName', 'birthday', 'email1', 'password1'];

    foreach ($required_fields as $field) {
        if (empty($_POST[$field])) {
            echo "<script>history.back();</script>";
            exit();
        }
    }

	$password = password_hash($_POST['password1'], PASSWORD_ARGON2ID);//default changed to argon2id

    $sql = "INSERT INTO `users` (`city_id`, `firstName`, `lastName`, `birthday`, `email`, `password`, `created_at`) 
            VALUES (?, ?, ?, ?, ?, ?, current_timestamp());";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('isssss', $_POST['city_id'], $_POST['firstName'], $_POST['lastName'], $_POST['birthday'], $_POST['email1'], $password);//$_POST['password1']
    $stmt->execute();
	echo $stmt->error;


    if ($stmt->affected_rows > 0) {
        echo "Data inserted successfully.";
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>