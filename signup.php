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

if (isset($_POST["email"])) {
    $fn = trim($_POST["firstName"]);
    $ln = trim($_POST["lastName"]);
    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);
    $pn = $_POST["telephoneNumber"];
    $bd = $_POST["birthday"];
    $food = implode(",", $_POST["food"]);
    $text = trim($_POST["texte"]);

    $theTable = new mysqli("localhost", "dbuser",
                            "Cheesey", "Grab-a-Bite");

    $pwhash = password_hash($password, PASSWORD_DEFAULT);

    $theTable->query("insert into users VALUES 
                            (\"{$fn}\", \"{$ln}\", \"{$email}\",
                            \"{$pwhash}\", \"{$pn}\", \"{$bd}\",
                            \"{$text}\", \"{$food}\")");

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
		Tell us a little about yourself!
		<textarea rows="5" cols="75" name="texte"
		 value="$text"> </textarea><br><br>

Upload your profile picture: <input type="file" name="picture" accept="image/*">
		<br><br>
	<input type="reset" value="Clear">
	<input type="submit" value="Submit">
	<input type="submit" name="home" value="Go back"/>
	</form>
</body>
</html>
THIS;

echo $page;