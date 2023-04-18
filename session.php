<?php
session_start();
// echo $_SESSION["login"];
if($_SESSION["login"] == true){
    echo "您已成功登录<a href='loginout.php'>注销登录</a>";
}else{
    $_SESSION["login"] == false;
    header("refresh:3;url=login.html");
    die("您无权访问，页面即将跳转！");
}

?>