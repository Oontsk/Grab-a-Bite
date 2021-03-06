

<?php


session_start();
$email = $_SESSION["UserEmail"];

require_once ("dbLogin.php");

$db_connection = new mysqli($host,$user,$dbpassword,$database);
$result = $db_connection->query("Select firstName,lastName,telephoneNumber,birthday,text,specifications,food,photo from users where email = \"{$email}\"");

$row = mysqli_fetch_array($result,MYSQLI_ASSOC);

$fn = $row['firstName'];
$ln = $row['lastName'];
$password = "";
$pn = $row['telephoneNumber'];
$bd = $row['birthday'];
$text = $row['text'];
$textyz = explode("<br />", $text);
$textxyzy = implode("", $textyz);
$avail = $row['specifications'];
$foodSnipe = $row['food'];

$food = explode(",", $foodSnipe);
$fixAvail = explode(" ", $avail);
$startAvail = $fixAvail[0];
$endAvail = $fixAvail[1];
$fileName= "";
$imgData = $row['photo'];
$page = "";


$checked1 = "";
$checked2 = "";
$checked3 = "";
$checked4 = "";
$checked5 = "";
$checked6 = "";


if (in_array("American", $food)) {
    $checked1 = "checked=\"checked\"";
}
if (in_array("Mexican", $food)) {
    $checked2 = "checked=\"checked\"";
}
if (in_array("Italian", $food)) {
    $checked3 = "checked=\"checked\"";
}
if (in_array("Asian", $food)) {
    $checked4 = "checked=\"checked\"";
}
if (in_array("Caribbean", $food)) {
    $checked5 = "checked=\"checked\"";
} if (in_array("Buffet", $food)) {
    $checked6 = "checked=\"checked\"";
}


if (isset($_POST["submitButton"])) {
    if ($_POST["submitButton"] === "Go Back") {
        header("Location: myProfile.php");
    } else {
        $fn = trim($_POST["firstName"]);
        $ln = trim($_POST["lastName"]);
        $pn = $_POST["telephoneNumber"];
        $bd = $_POST["birthday"];
        $food = implode(",", $_POST["food"]);
        $text = nl2br(trim($_POST["text"]));
        $startAvail = $_POST["usr-start-time"];
        $endAvail = $_POST["usr-end-time"];
        $avail = $startAvail . " " . $endAvail;



        if ($_FILES['picture']['tmp_name'] === "") {
            $imgData = $row['photo'];
        } else {
            $imgData = $db_connection->real_escape_string(file_get_contents($_FILES['picture']['tmp_name']));
        }

        $pwhash = password_hash($password, PASSWORD_DEFAULT);

        $result = $db_connection->query("update users set firstName = \"{$fn}\", lastName=\"{$ln}\", 
                                telephoneNumber = \"{$pn}\", birthday=\"{$bd}\",
                                food =\"{$food}\", text=\"{$text}\", specifications=\"{$avail}\", photo=\"{$imgData}\"
                                where email = \"{$email}\"");


        $db_connection->close();
        header("Location: myProfile.php");
    }
}



$page = <<< THIS
		<!DOCTYPE html>
		<html>
		<head>
		<meta charset="UTF-8">
			<title>Edit Profile</title>
		    
		    <meta charset="utf-8">
		    <meta name="viewport" content="width=device-width, initial-scale=1">
		    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		    <link rel="stylesheet" href="menu.css"/>
		    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		</head>
		<body>
		<form enctype="multipart/form-data" action="editProfile.php" method="POST">
			<div class="container">
		    <div class="text-center">
			
		    	<hr><br>
		        
		         <!-- First Name -->
    	First Name: <input type="text" name="firstName" id="firstName" value="$fn">
        
        
        <!-- Last Name -->
		Last Name: <input type="text" name="lastName" id="lastName" value="$ln"><br>
        <hr><br>
        
       
        
        <!-- Phone Number -->
		Phone Number: <input type="tel" id="phone" name="telephoneNumber" value="$pn">
        
        <!-- Birth Date -->
		Birthday: <input type="date" id="birthday" name="birthday" value="$bd"><br>
        <hr><br>
        
        <!-- Types of Food -->
		Updat the Types of Food You Like:<br><br>
        <div class="form-group row">
        	<div class="col-sm-2">
        		<input type="checkbox" name="food[]" value="American" $checked1> American  
            </div>
            <div class="col-sm-2">
        		<input type="checkbox" name="food[]" value="Mexican" $checked2> Mexican
            </div>
            <div class="col-sm-2">
        		<input type="checkbox" name="food[]" value="Italian" $checked3> Italian
            </div>
            <div class="col-sm-2">
        		<input type="checkbox" name="food[]" value="Asian" $checked4> Asian
            </div>
            <div class="col-sm-2">
        	<input type="checkbox" name="food[]" value="Caribbean" $checked5> Caribbean
            </div>
            <div class="col-sm-2">
        	<input type="checkbox" name="food[]" value="Buffet" $checked6> Buffet<br><br>
            </div>
        </div>
        <hr><br>
        
        <!-- Personal Description -->
		Tell us a little about yourself or some of the foods you enjoy!<br><br>
		<textarea rows="5" cols="75" name="text" value="{$text}"> $textxyzy </textarea><hr><br>
       
        
     	<!-- Availability -->
		When are you available to meet?<br><br>
		Starting From: <input id="startT" type="time" name="usr-start-time" value="{$startAvail}"> Until: <input id="endT" type="time" name="usr-end-time" value="{$endAvail}"><br>
        <hr><br>
        

		<!-- Profile Picture -->
        <div class="container" text-align="center">
        Upload a new profile picture if you want: <br><br> 
        </div>
        
        <div class="form-group text-center">
    		<div class="input-group" style="margin:auto;">
      			<input type="file" name="picture" accept="image/*" id="filePic"><br>
    		</div>
    	</div>
        <hr><br>
       
    	<!-- Reset, Submit, and Go Back buttons -->
		<input type="reset" value="Clear" class="buttons">
		<input type="submit" name="submitButton" value="Submit" id="submit" class="buttons">
		<input type="submit" name="submitButton" id="back" value="Go Back" class="back"/>
    	<hr>
        

    </div>
    
    <script src="validateEdit.js"></script>	</form>
</body>
</html>
THIS;



echo $page;




