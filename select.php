<?php
include("session.php");
include("conn.php");


$info = $_GET["info"];
if(is_numeric($info)){
    $tag = " id=".$info;
}else{
    $tag = " user="."'".$info."'";
}
$select_info = "select * from testUser_tbl where ".$tag;
$result = mysqli_query($conn1, $select_info);
$row = mysqli_fetch_assoc($result);
$id = $row['id'];
$user = $row['user'];
$phone = $row['phone'];
// echo($select_info);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>有漏洞的查询系统</title>
</head>
<body>
    <h1>请输入你要查询的id或者账号！</h1>
   <form action="" method="get">
    <input type="text" name="info"><input type="submit" value="提交">
    </form>
    <?php echo "id = ".$id ?></br>
    <?php echo "user = ".$user ?></br>
    <?php echo "phone = ".$phone ?></br>
</body>
</html>