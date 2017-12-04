<?php
/**
 * Created by PhpStorm.
 * User: ronalddavis
 * Date: 12/3/17
 * Time: 7:26 PM
 */

$body = <<<BODY
<!DOCTYPE html>
<html>
	<head>
		<title>My Matches</title>
		<link rel="shortcut icon" href="favicon.ico"/>
		<link rel="stylesheet" href="menu.css"/>
	</head>
	<body>
		<h2>My Matches</h2>

		You have previously matched with:
		<br><br>

		George:
		<br>
		<img src="defaultProfile.png" alt="Profile Picture" style="width: 15%; border-style: solid; border-color: black;">
		<br><br>

		Sam:
		<br>
		<img src="defaultProfile.png" alt="Profile Picture" style="width: 15%; border-style: solid; border-color: black;">
		<br><br>

		<form action="menu.html" method="POST">
			<input type="submit" name="home" value="Go Home" class="back"/>
		</form>
	</body>
</html>

BODY;
