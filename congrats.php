<?php
require_once("dbLogin.php");
require_once ("Student.php");


$body = <<<BODY
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Grab A Bite Homepage</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="menu.css"/>
    <link rel="shortcut icon" href="favicon.ico"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>

BODY;

if(isset($_POST['email'])){
    $emailArray = $_POST['email'];
    session_start();
    $email = $_SESSION['UserEmail'];

    $db_connection = new mysqli($host, $user, $dbpassword, $database);
    $result = $db_connection->query("SELECT * FROM users WHERE email = \"{$email}\"");

    $result->data_seek(0);
    $row = $result->fetch_array(MYSQLI_ASSOC);

    $friends = unserialize($row['friends']);



    foreach ($emailArray as $entry) {
        $temp = new Student($entry);
        $friends[] = $temp;
    }

    $serializedFriends = serialize($friends);
    $serializedFriends = $db_connection->real_escape_string($serializedFriends);
    print_r($serializedFriends);

    $query = "update users set friends=\"{$serializedFriends}\" where email=\"{$email}\"";

    
    $worked = $db_connection->query($query);

    if($worked){
        $body .= " <h1>Congratulations, Your new friends were added :)</h1>
            <form action=\"menu.html\" method=\"post\">
                <input type=\"submit\" value=\"Go Home\" class=\"back\">
            </form>

            </body>
            </html>";
    }else {
        $body .= " <h1>Sorry, No friends were added :(</h1>
            <form action=\"menu.html\" method=\"post\">
                <input type=\"submit\" value=\"Go Home\" class=\"back\">
            </form>

            </body>
            </html>";
    }


}else{
    $body .= " <h1>Sorry, No friends were added :(</h1>
            <form action=\"menu.html\" method=\"post\">
                <input type=\"submit\" value=\"Go Home\" class=\"back\">
            </form>

            </body>
            </html>";
}

















echo $body;
?>