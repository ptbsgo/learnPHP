<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<?php
require_once("image.php");

$file = $_FILES["file"];
echo imaget($file);

echo mt_rand(1000,9999);

?>
<body>
    <form action="#" method="post" enctype="multipart/form-data">    
    <input type="file" name="file" id="file">
    <input type="submit" value="提交">
</form>
</body>
</html>