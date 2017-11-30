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
            $body .= "<th>Picture</th><th>First Name</th><th>Last Name</th><th>Email</th><th>Foods</th><th>Time Available</th><th>Age</th><th>Phone Number</th>";


            while ($recordArray = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                $body .= "<tr>";
                $firstName = $recordArray['firstName'];
                $lastName = $recordArray['lastName'];
                $email = $recordArray['email'];

                $food = $recordArray['food'];
                $birthday= $recordArray['birthday'];
                $timeAvail = $recordArray['specifications'];

                $timeAvail = explode(" ", $timeAvail);
                $firstHour = explode(":", $timeAvail[0]);
                $secondHour = explode(":", $timeAvail[1]);

                if ($firstHour[0] < 13) {
                    $firstAmOrPm = "am";
                } else {
                    $firstHour[0] = $firstHour[0] - 12;
                    $firstAmOrPm = "pm";
                }

                if ($secondHour[0] < 13) {
                    $secondAmOrPm = "am";
                } else {
                    $secondHour[0] = $secondHour[0] - 12;
                    $secondAmOrPm = "pm";
                }

                $food = explode(",", $food);
                $food = implode(", ", $food);

                $birthday = explode("-", $birthday);

                $birthday[3] = 2017 - $birthday[0];

                $photo = $recordArray["photo"];

                $photodata = base64_encode($photo);
                $phoneNumber = $recordArray['telephoneNumber'];



                $body .= "<td><img src=\"data:image / jpeg;base64,{$photodata}\" width='100' height='100'></td><td>$firstName</td><td>$lastName</td><td>$email</td><td>$food</td><td>$firstHour[0]:$firstHour[1]$firstAmOrPm - $secondHour[0]:$secondHour[1]$secondAmOrPm</td><td>$birthday[3]</td><td>$phoneNumber</td></tr>";

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