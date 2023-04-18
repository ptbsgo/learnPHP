<?php
require_once("image.php");
include("conn.php");

if (isset($_POST['submit'])) {
    $uname = htmlspecialchars($_POST["uname"]);
    $passwd1 = htmlspecialchars($_POST["passwd1"]);
    $passwd2 = htmlspecialchars($_POST["passwd2"]);
    $phone = htmlspecialchars($_POST["phone"]);
    }
if(empty($uname) || empty($passwd1) || empty($passwd2)){
    echo "请输入用户名或密码！";
    }elseif(strlen($uname)<5 || strlen($passwd1)<6 || strlen($passwd2)<6){
        echo "账号不能小于5位，密码长度不能小于6位"; 
        header("refresh:2;url=register.html");
    }elseif($passwd1 != $passwd2){
        echo "两次输入的密码要相同！";
        header("refresh:2;url=register.html");
    }elseif(strlen($phone) !== 11){
        echo "请输入正确的手机号码长度（11位）！";
        header("refresh:2;url=register.html");
    }else{
        $select_user = "SELECT * FROM testuser_tbl WHERE user = '$uname'";
        $select_phone = "SELECT * FROM testuser_tbl WHERE phone = '$phone'";
        $is_user = mysqli_query($conn1, $select_user);
        $is_phone = mysqli_query($conn1, $select_phone);
        if (mysqli_num_rows($is_user) > 0) {
            // 用户名已存在
            echo "该用户名已被注册。";
            header("refresh:2;url=register.html");
        }elseif(mysqli_num_rows($is_phone) > 0){
            // 手机号码已存在！
            echo "手机号码已存在。";
            header("refresh:2;url=register.html");
        }else {
            $pic = $_FILES["pic"];
            $pic_name = 'upload/'.$_FILES["pic"]["name"];
            $salt = mt_rand(1000,9999);
            $md5_passwd = md5($passwd1+$salt);
            $user_insert = "insert into testuser_tbl(user,passwd,phone,pic,salt) values ('$uname','$md5_passwd','$phone','$pic_name','$salt');";
            $reg = mysqli_query($conn1, $user_insert);
            if($reg === true){
                header("refresh:3;url=login.html");
                print('正在返回登录，请稍等...<br>三秒后自动跳转~~~');
                echo "<br/>注册成功，你的账号密码是：<br/>";
                echo "用户：".$uname."<br/>";         //详细信息调试用，正式上线没必要显示！
                echo "密码：".$passwd1."<br/>";
                imaget($pic);
                if(empty($pic['name'])){
                    echo "";
                }else{
                    echo "<img src='upload/$pic[name]' /> <br/>";
                }
            }else{
                echo "未知原因注册失败！ <br/>";
                header("refresh:2;url=register.html");
                 }
            }
        }
?>