<?php
include("session.php");

$rand = $_POST["rand"];
$num1 = $_POST["num1"];
if($rand==""){
    $rand = rand(10,99);
}

if($num1 > $rand){
    $x = "猜大了！";

}elseif($num1 < $rand){
    $x = "猜小了！";
}else{
    $x = "恭喜你，猜对了！";
}

for($c=10;$c<=99;$c++){
    if($c==$rand){
        echo "<br/>".$c;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>数字炸弹游戏</title>
</head>
<body>
    <form class="text" action="" method="post">
        <input  type="hidden" name="rand" value="<?php echo $rand ?>" >
        <button  type="button" onclick="clearText()">重新开始</button>
        <h1>数字炸弹游戏，猜猜我的数字是多少，范围10-99</h1>
        猜数字<input type="number" name="num1" value="<?php echo $num1 ?>">
        <input  type="submit" value="计算">
        <label><?php echo $x ?></label>
        </br>
    </form>
</body>
</html>
<script src="http://code.jquery.com/jquery-2.2.1.min.js"></script>  
<script type="text/javascript" language="javascript">
       function clearText() {
            $(" input[ name='rand' ] ").val("");     //$ 需要引入min.js 库
       }
</script>