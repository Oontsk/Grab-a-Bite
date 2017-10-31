<?php
    include_once("dbLogin.php");

$body = <<<BODY
   <!DOCTYPE html>
<html>
<head>
	<title>Grab A Bite Homepage</title>
</head>
<body>
	<h1>Welcome to Grab A Bite</h1>
	<p>
		<h2>Please Login</h2>
		<form action="{$_SERVER["PHP_SELF"]}" method="POST">
			Username: <input type="text" name="username"/><br><br>
			Password: <input type="password" name="password"/><br><br>
			<input type="submit" name="login" value="Log In"/><br><br>
		</form>
	</p>
</body>
</html>
BODY;


if(isset($_POST['login'])){
    //Connect to DB
    $db_connection = new mysqli($host, $user, $password, $database);

    if ($db_connection->connect_error){
        die($db_connection->connect_error);
    }

    $email = $_POST['email'];


    $query = "select email,password from users where email=$email";



}


echo $body;

?>