<?php
    require_once("dbLogin.php");

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
			Email: <input type="email" name="email"/><br><br>
			Password: <input type="password" name="password" required="required"/><br><br>
			<input type="submit" name="login" value="Log In"/><br><br>
		</form>
	</p>
</body>
</html>
BODY;


if(isset($_POST['login'])){
    //Connect to DB
    $db_connection = new mysqli($host, $user, $dbpassword, $database);

    if ($db_connection->connect_error){
        die($db_connection->connect_error);
    }

    $tempEmail = $_POST['email'];
    $password = $_POST['password'];
    $email = trim($tempEmail);



    $query = "select firstName,lastName,email,password from users where email='$email'";
    $result = $db_connection->query($query);


    if ($result->num_rows == 0) {
        $body .= "<h2>No entry exists in the database for the specified email and password</h2>";
    } else {
        $result->data_seek(0);
        $row = $result->fetch_array(MYSQLI_ASSOC);

        if (password_verify($password, $row['password'])){
            $email = $row['email'];
            $firstName = $row['firstName'];
            $lastName = $row['lastName'];

            session_start();
            $_SESSION['UserEmail'] = $email;

            if (isset($_POST["login"]) ) {
                header("Location: menu.html");
            }

        }else {
            $body .= "<h2>Incorrect password entered.</h2>";
        }
    }


}


echo $body;

?>