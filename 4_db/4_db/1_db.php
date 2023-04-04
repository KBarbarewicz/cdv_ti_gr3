<!doctype html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Użytkownicy</title>
</head>
<body>
<?php
require_once "./scripts/connect.php";
$sql = "SELECT * FROM `users`;";
$result = $conn->query($sql);
//$user = $result->fetch_assoc();
//echo $user["firstName"];
while($user = $result->fetch_assoc()){
    //echo "test<br>";
    //print_r($user);//vardump dodatkowo dodaje jaki jest typ oraz pl znaki robi ray 2
    //echo "<br>";
    $year = substr($user["birthday"], 0, -6);
    echo <<< USERS
    Imię i nazwisko: $user[firstName] $user[lastName]<br>
    Data urodzenia: $user[birthday]<br>
    Rok urodzenia: $year<br>
    <hr>

USERS;
}
?>

</body>
</html>