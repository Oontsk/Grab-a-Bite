<?php
require_once("dbLogin.php");

$db_connection = new mysqli($host, $user, $dbpassword, $database);

if ($db_connection->connect_error){
    die($db_connection->connect_error);
}
print_r($_POST);

session_start();
$email = $_SESSION['UserEmail'];
$query = "select * from users where email='$email'";
$result = $db_connection->query($query);

    $result->data_seek(0);
    $row = $result->fetch_array(MYSQLI_ASSOC);

    $firstName = $row['firstName'];
    $lastName = $row['lastName'];
    $telephonerNumber = $row['telephoneNumber'];
    $birthday= $row['birthday'];
    $food = $row['food'];
    $text = $row['text'];

    print_r($row);


$body = <<<BODY
    <!DOCTYPE html>
    <html>
    <head>
        <title>My Profile</title>
        <link rel="shortcut icon" href="favicon.ico"/>
        <link rel="stylesheet" type="text/css" href="myProfile.css"/>
    </head>
    <body>
    <h2>My Profile</h2>

    <img src="defaultProfile.png" alt="Profile Picture" style="width: 25%; border-style: solid; border-color: black;">
    <br><br>
    <strong>Favorite Kinds of Foods:</strong>
    <br><br>
    <strong>Bio:</strong>
    <br><br>
    <strong>Contact Information: {$telephonerNumber}</strong>
    <br><br>

    <form action="homepage.html" method="POST">
        <input type="submit" name="home" value="Go Home"/>
    </form>
</body>
</html>
BODY;


echo $body;
?>