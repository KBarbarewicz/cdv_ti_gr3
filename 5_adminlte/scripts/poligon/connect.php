<?php
// Establish a connection to the database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cdv_gr_3";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Prepare and bind the SQL statement
$stmt = $conn->prepare("INSERT INTO users (firstName, lastName, email, password, birthday, city_id) VALUES (?, ?, ?, ?, ?, ?)");
$stmt->bind_param("sssssi", $firstName, $lastName, $email, $password, $birthday, $city_id);

// Set parameters and execute the statement
$firstName = mysqli_real_escape_string($conn, $_POST['firstName']);
$lastName = mysqli_real_escape_string($conn, $_POST['lastName']);
$email = mysqli_real_escape_string($conn, $_POST['email']);
$password = mysqli_real_escape_string($conn, $_POST['password']);
$birthday = mysqli_real_escape_string($conn, $_POST['birthday']);
$city_id = mysqli_real_escape_string($conn, $_POST['city_id']);

if (empty($firstName) || empty($lastName) || empty($email) || empty($password) || empty($birthday) || empty($city_id)) {
    echo "All fields are required";
    exit();
}

if ($stmt->execute()) {
    echo "User registered successfully";
} else {
    echo "Error: " . $stmt->error;
}

// Close the statement and the connection
$stmt->close();
$conn->close();
?>
