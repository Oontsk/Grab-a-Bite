<!-- Grab A Bite Sign Up Page -->
<!-- Anna Blendermann, Ronnie Davis, Ashley Dear, Hunter Klamut -->

<?php
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
    header("Location: homepage.html");
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
    
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="shortcut icon" href="favicon.ico"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
	<div class="container">
    <div class="text-center">
	<form action="signup.php" method="POST">
    	<hr><br>
        
        <!-- First Name -->
    	First Name: <input type="text" name="firstName" value="$fn"><br><br>
        <hr><br>
        
        <!-- Last Name -->
		Last Name: <input type="text" name="lastName" value="$ln"><br><br>
        <hr><br>
        
        <!-- Email -->
		Email: <input type="email" name="email" value="$email" required="required"><br><br>
        <hr><br>
        
        <!-- Password -->
		Password: <input type="password" name="password" value="$password"/><br><br>
        <hr><br>
        
        <!-- Phone Number -->
		Phone Number: <input type="tel" name="telephoneNumber" value="$pn"><br><br>
        <hr><br>
        
        <!-- Birth Date -->
		Birthday: <input type="date" name="birthday" value="$bd"><br><br>
        <hr><br>
        
        <!-- Types of Food -->
		Select What Types of Food You Like:<br><br>
        <div class="form-group row">
        	<div class="col-sm-2">
        		<input type="checkbox" name="food[]" value="American"> American  
            </div>
            <div class="col-sm-2">
        		<input type="checkbox" name="food[]" value="Mexican"> Mexican
            </div>
            <div class="col-sm-2">
        		<input type="checkbox" name="food[]" value="Italian"> Italian
            </div>
            <div class="col-sm-2">
        		<input type="checkbox" name="food[]" value="Asian"> Asian
            </div>
            <div class="col-sm-2">
        	<input type="checkbox" name="food[]" value="Caribbean"> Caribbean
            </div>
            <div class="col-sm-2">
        	<input type="checkbox" name="food[]" value="Buffet"> Buffet<br><br>
            </div>
        </div>
        <hr><br>
        
        <!-- Personal Description -->
		Tell us a little about yourself!<br><br>
		<textarea rows="5" cols="75" name="text" value="$text"> </textarea><br><br>
        <hr><br>
        
     	<!-- Availability -->
		When are you available?<br><br>
		Starting From: <input type="time" name="usr-start-time"> Until: <input type="time" name="usr-end-time"><br><br>
        <hr><br>

		<!-- Profile Picture -->
        <div class="container" text-align="center">
        Upload your profile picture: <br><br> 
        </div>
        
        <div class="form-group text-center">
    		<div class="input-group" style="margin:auto;">
      			<input type="file" name="picture" accept="image/*" value="$imageName"><br>
    		</div>
    	</div>
        <hr><br>
       
    	<!-- Reset, Submit, and Go Back buttons -->
		<input type="reset" value="Clear">
		<input type="submit" value="Submit">
		<input type="submit" name="home" value="Go Back"/>
    	<hr>
        
	</form>
    </div>
</body>
</html>
THIS;

echo $page;