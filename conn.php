<?php
$host = "127.0.0.1";
$dbuser = "root";
$dbpasswd = "root";
$dbname = "testUser";


//连接数据库
$conn = @mysqli_connect($host,$dbuser,$dbpasswd);

if(!$conn){
    die("连接失败：" . mysqli_connect_error());
}else{
    //创建数据库
    $sql = "CREATE DATABASE testuser";
    if(mysqli_query($conn,$sql)){
        echo "正在创建数据库....".'<br/>';
        echo "创建testuser数据库成功".'<br/>';
    }else{
        echo "";
        // echo "数据库已经存在".mysqli_error($conn).'<br/>';
    }
    // 创建表
    $conn1 = mysqli_connect($host,$dbuser,$dbpasswd,$dbname);
    $table_name = "testUser_tbl";
    $query = "SELECT 1 FROM $table_name LIMIT 1";
    $result = mysqli_query($conn1, $query);
    if($result !== false){
        // echo "testUser_tbl表已经存在".mysqli_error($conn1).'<br/>';
        echo "";
    }else{
        echo "正在创建表....".'<br/>';
        $sqlcreat_table="
        CREATE TABLE IF NOT EXISTS `testUser_tbl`(
        `id` INT UNSIGNED AUTO_INCREMENT,
        `user` VARCHAR(10) NOT NULL,
        `passwd` VARCHAR(10) NOT NULL,
        `phone` BIGINT(11) NOT NULL,
        `pic` VARCHAR(30),
        PRIMARY KEY (`id`)
        )ENGINE=InnoDB DEFAULT CHARSET=utf8;";
        if(mysqli_query($conn1,$sqlcreat_table)){
            echo "创建testUser_tbl表成功".'<br/>';
        }else{
            echo "testUser_tbl表创建失败".mysqli_error($conn1).'<br/>';
        }
    }
    

}



?>