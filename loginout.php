<?php
session_start();
$_SESSION["login"] = "false";
session_destroy();
// echo $_SESSION["login"];
echo "注销成功！";
header("refresh:3;url=login.html");
?>