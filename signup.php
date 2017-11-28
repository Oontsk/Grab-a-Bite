<?php
/**
 * Created by PhpStorm.
 * User: Oontsk
 * Date: 10/31/2017
 * Time: 5:34 PM
 */

$fn = "";
$ln = "";
$email = "";
$password = "";
$pn = "";
$bd = "";
$text = "";
$startAvail = "";
$endAvail = "";
$avail = "";
$imagePrefix = "ProfilePictures/";
$imageName = "";
$imageData;

require_once ("dbLogin.php");

if (isset($_POST["home"]) && $_POST["home"] === "Go back") {
    header("Location: 389something.html");
}

if (isset($_POST["email"])) {
    $fn = trim($_POST["firstName"]);
    $ln = trim($_POST["lastName"]);
    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);
    $pn = $_POST["telephoneNumber"];
    $bd = $_POST["birthday"];
    $food = implode(",", $_POST["food"]);
    $text = trim($_POST["texte"]);
    $startAvail = $_POST["usr-start-time"];
    $endAvail = $_POST["usr-end-time"];
    $avail = $startAvail . " " . $endAvail;
    $imageName = $imagePrefix . $_POST["picture"];


    $theTable = new mysqli($host, $user, $dbpassword, $database);
    $imageData = mysqli_real_escape_string($theTable, file_get_contents($imageName));


    $pwhash = password_hash($password, PASSWORD_DEFAULT);

    $theTable->query("insert into users VALUES 
                            (\"{$fn}\", \"{$ln}\", \"{$email}\",
                            \"{$pwhash}\", \"{$pn}\", \"{$bd}\",
                            \"{$food}\", \"{$text}\", \"{$avail}\", \"{$imageData}\")");

    $theTable->close();
}

$page = <<< THIS
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8"/>
	<title>Sign Up Page</title>
</head>
<body>

	<form action="signup.php" method="POST">
    First Name: <input type="text" name="firstName" value="$fn"><br/><br />
		Last Name: <input type="text" name="lastName" value="$ln"><br/> <br/>
		Email: <input type="email" name="email" value="$email" required="required"> <br/> <br/>
		Password: <input type="password" name="password" value="$password"/>
		<br/><br/>
		Phone Number: <input type="tel" name="telephoneNumber" value="$pn"> <br/> <br/>
		Birthday: <input type="date" name="birthday" value="$bd"> <br/> <br/>
		Select What Types of Food You Like: <br/>
			<table>
				<tr>
					<td> <input type="checkbox" name="food[]" value="American">American</td>
					<td> <input type="checkbox" name="food[]" value="Mexican">Mexican</td>
					<td> <input type="checkbox" name="food[]" value="Italian">Italian</td>
				</tr>
				<tr>
					<td> <input type="checkbox" name="food[]" value="Asian">Asian</td>
					<td> <input type="checkbox" name="food[]" value="Caribbean">Caribbean</td>
					<td> <input type="checkbox" name="food[]" value="Buffet">Buffet</td>
				</tr>
			</table>
		<br><br>
		Tell us a little about yourself!<br>
		<textarea rows="5" cols="75" name="texte"
		 value="$text"> </textarea><br><br>
		 
		 
		 When are you available?<br>
		 Starting from: <input type="time" name="usr-start-time"> until: <input type="time" name="usr-end-time"><br><br>

Upload your profile picture: <input type="file" name="picture" accept="image/*" value="$imageName">
		<br><br>
	<input type="reset" value="Clear">
	<input type="submit" value="Submit">
	<input type="submit" name="home" value="Go back"/>
	</form>
</body>
</html>
THIS;

echo $page;
