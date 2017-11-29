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
            $body .= "<th>First Name</th><th>Last Name</th><th>Email</th><th>Foods</th><th>Time Available</th>";


            while ($recordArray = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                $body .= "<tr>";
                $firstName = $recordArray['firstName'];
                $lastName = $recordArray['lastName'];
                $email = $recordArray['email'];

                $food = $recordArray['food'];

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

                switch ($birthday[1]) {
                    case 1:
                        $birthday[1] = "January";
                        break;
                    case 2:
                        $birthday[1] = "February";
                        break;
                    case 3:
                        $birthday[1] = "March";
                        break;
                    case 4:
                        $birthday[1] = "April";
                        break;
                    case 5:
                        $birthday[1] = "May";
                        break;
                    case 6:
                        $birthday[1] = "June";
                        break;
                    case 7:
                        $birthday[1] = "July";
                        break;
                    case 8:
                        $birthday[1] = "August";
                        break;
                    case 9:
                        $birthday[1] = "September";
                        break;
                    case 10:
                        $birthday[1] = "October";
                        break;
                    case 11:
                        $birthday[1] = "November";
                        break;
                    case 12:
                        $birthday[1] = "December";
                        break;
                }

                $birthday[3] = 2017 - $birthday[0];




                $body .= "<td>$firstName</td><td>$lastName</td><td>$email</td><td>$food</td><td>$firstHour[0]:$firstHour[1]$firstAmOrPm - $secondHour[0]:$secondHour[1]$secondAmOrPm</td></tr>";

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