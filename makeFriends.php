<?php
/**
 * Created by PhpStorm.
 * User: ronalddavis
 * Date: 11/29/17
 * Time: 5:34 PM
 */

require_once("dbLogin.php");

$body = <<<TOPBODY
<!DOCTYPE html>
<html>
	<head>
		<title>Make Friends</title>
		<link rel="shortcut icon" href="favicon.ico"/>
	</head>
	<body>
		<h2>Make New Friends</h2>

TOPBODY;


//Connect to DB
    $db_connection = new mysqli($host, $user, $dbpassword, $database);

    if ($db_connection->connect_error){
        die($db_connection->connect_error);
    }

    session_start();
    $email = $_SESSION['UserEmail'];

    $query = "select * from users where email != '$email'";
    $result = $db_connection->query($query);

    if ($result) {
        $numRow = mysqli_num_rows($result);

        if ($numRow == 0) {
            $body = "<h2>No entries exists in the table</h2>";
        } else {
            $body .= "<table border=1>";
            while ($recordArray = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                $body .= "<tr>";
                $firstName = $recordArray['firstName'];
                $lastName = $recordArray['lastName'];
                $email = $recordArray['email'];
                $body .= "<td>$firstName</td><td>$lastName</td><td>$email</td></tr>";

            }
        }
       $body .= "</table>";
    }

    $body .= <<<BOTTOMBODY

        <form action="menu.html" method="POST">
			<input type="submit" name="home" value="Go Home"/>
		</form>

	</body>
</html>
BOTTOMBODY;

    echo $body;

?>