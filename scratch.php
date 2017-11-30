<?php
/**
 * Created by PhpStorm.
 * User: Oontsk
 * Date: 11/29/2017
 * Time: 7:13 PM
 */

if (isset($_POST["filename"])) {
    echo "{$_POST['filename']}";
}

var_dump($_FILES);

echo <<<THIS

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Help</title>
</head>
<body>
<form action="scratch.php" method="post" enctype="multipart/form-data">
<input type="file" name="filename" accept="image/*" id="theFile">
    <input type="submit" name="submit">
</form>
</body>
</html>

THIS;
?>