<?php
require_once "./connect.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  // Sanitize user input
  $firstName = mysqli_real_escape_string($conn, $_POST['firstName']);
  $lastName = mysqli_real_escape_string($conn, $_POST['lastName']);
  $email = mysqli_real_escape_string($conn, $_POST['email1']);
  $password = password_hash($_POST['password1'], PASSWORD_ARGON2ID); // hash the password
  $birthday = mysqli_real_escape_string($conn, $_POST['birthday']);
  $created_at = mysqli_real_escape_string($conn, $_POST['created_at']);
  $city_id = mysqli_real_escape_string($conn, $_POST['city_id']);

  // Prepare and execute the SQL statement
  $stmt = $conn->prepare(query: "INSERT INTO `users` (`email`, `city_id`, `firstName`, `lastName`,
  `birthday`, `password`, `created_at`) VALUES (?, ?, ?, ?, ?, ?, current_timestamp());");
  
  $stmt->bind_param('sissss', $firstName, $lastName, $email1, $password1, $birthday, $city_id);
  if ($stmt->execute()) {
    echo "User registered successfully";
  } else {
    echo "Error: " . $stmt->error;
  }
echo $stmt->affected_rows;
  $stmt->close();
  $conn->close();
}
