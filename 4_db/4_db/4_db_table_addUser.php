<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/styles.css">
    <title>Users</title>
</head>
<body>
    <h1>Users</h1>

    <?php
        if (isset($_GET['deleted_user_id']))
            if ($_GET['deleted_user_id'] == 0) 
                echo "<h2>Could not delete user!</h2>";
            else
                echo "<h2>User with id = $_GET[deleted_user_id] deleted successfully!</h2>";
    ?>

    <?php
        require_once './db/scripts/connect_db.php';
        
        $sql = 'SELECT users.id, users.first_name, users.last_name, users.birthday, cities.city, states.state
                FROM users
                INNER JOIN cities
                ON cities.id = users.city_id
                INNER JOIN states
                ON states.id = cities.state_id';
        $result = $conn->query($sql);
        
        if ($result->num_rows != 0) {
            echo <<< HTML
                <table>
                <tr>
                    <th>Name</th>
                    <th>Lastname</th>
                    <th>Date of birth</th>
                    <th>City</th>
                    <th>State</th>
                    <th>Delete Row</th>
                </tr>
            HTML;

            while($data = $result->fetch_assoc())
            {
                echo <<< TABLEUSERS
                <tr>
                    <td>$data[first_name]</td>
                    <td>$data[last_name]</td>
                    <td>$data[birthday]</td>
                    <td>$data[city]</td>
                    <td>$data[state]</td>
                    <td><a href="./script/delete_user.php?user_delete_id=$data[id]">Remove</a></td>
                </tr>
                TABLEUSERS;
            }
        }
        else
            echo "<h2>NO RECORDS IN DB</h2>";

        echo "</table>";

        if (isset($_GET["showFormAddUser"])) {
            echo <<< ADDUSERFORM
                <h4>User Addition</h4>
                <form action="./script/add_user.php" method="POST">
                    First Name
                    <input type="text" name="first_name"> <br>
                    Last Name
                    <input type="text" name="last_name"> <br>
                    Birthday
                    <input type="date" name="birthday"> <br>
                    City_id
                    <input type="number" name="city_id"> <br>  
                    <input type="submit" value="Add User">  
                </form>
            ADDUSERFORM;
        } else {
            echo '<a href="./db_table_add.php?showFormAddUser=1">Add User</a>';
        }

        $conn->close();
    ?>

</body>
</html>