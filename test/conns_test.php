<?php
 $host = "127.0.0.1";
 $user = "root";
 $passwd = "root";

//创建连接  mysqli_connect 方式1
 $conn = mysqli_connect($host,$user,$passwd);
 
 //检测连接
 if(!$conn){
    die("Connection failed:".mysqli_connect_errno());
 }else{
    echo "连接成功！<br/>";
 }

 
 $conn2 = new mysqli($host,$user,$passwd);   //mysqli 对象创建

 //检测连接
 if($conn->connect_error){
    die("连接失败：" . $conn->connect_error);
 }
 echo "连接成功！<br/";


 try{
    $conn3 =new PDO("mysql:host=$host;",$user,$passwd);    ///PDO  可以防止注入！
    echo "连接成功！";
 }
 catch(PDOException $e){
    echo  $e -> getMessage();  
 }


  // create database testUser;  创建库
 // use testUser;  进入库
 //创建表 testUser_tbl

//  CREATE TABLE IF NOT EXISTS `testUser_tbl`(
//    `id` INT UNSIGNED AUTO_INCREMENT,
//    `user` VARCHAR(10) NOT NULL,
//    `passwd` VARCHAR(10) NOT NULL,
//    `phone` BIGINT(11) NOT NULL,
//    `pic` VARCHAR(30),
//    PRIMARY KEY (`id`)
//    )ENGINE=InnoDB DEFAULT CHARSET=utf8;";

?>