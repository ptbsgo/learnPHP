<?php
include("conn.php");
session_start();

if (isset($_POST['submit'])) {
    $uname = htmlspecialchars($_POST["uname"]);
    $passwd = htmlspecialchars($_POST["passwd"]);
    $code = $_POST['code'];      // 获取用户输入的验证码
    $captcha = $_SESSION['code'];// 获取之前生成的验证码
    }
    
if(empty($uname) || empty($passwd)){
    echo "请输入用户名或密码！";
    header("refresh:2;url=login.html");
    }elseif(strlen($uname)<5 || strlen($passwd)<6){
        echo "账号不能小于5位，密码长度不能小于6位"; 
        header("refresh:2;url=login.html");
    }
    elseif(strtolower($code) != strtolower($captcha)){
        echo '验证码错误，请重新输入';
        header("refresh:2;url=login.html");
    }else{
        $select_salt = "SELECT salt FROM testuser_tbl WHERE user = '$uname';";
        $is_salt = mysqli_query($conn1, $select_salt);
        $row = mysqli_fetch_assoc($is_salt);
        $salt = $row["salt"];
        $passwd = md5($passwd+$salt);
        $select_userpasswd = "SELECT * FROM testuser_tbl WHERE user = '$uname' and passwd = '$passwd';";
        $is_login = mysqli_query($conn1, $select_userpasswd);
        if (mysqli_num_rows($is_login ) > 0) {
            echo "用户：".$uname."<br/>";         //详细信息调试用，正式上线没必要显示！
            echo "密码：".$passwd."<br/>";
            echo "登录成功！";
            $_SESSION["login"] = 'true';
            header('Location:main.php');
            }else{
                $_SESSION["login"] = 'false';
                echo "登录失败！账号或者密码错误！<br />";
                // header('Location:login.html');
                header("refresh:3;url=login.html");
                print('正在返回登录，请稍等...<br>三秒后自动跳转~~~');
            }
        }
?>