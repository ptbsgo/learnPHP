<?php
session_start();

//生成随机字符串函数
function random_str($length){
    $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    $str = '';
    for ($i = 0; $i < $length; $i++) {
        $str .= $chars[mt_rand(0, strlen($chars) - 1)];
    }
    return $str;
}

//生成验证码图片
$code = random_str(4); //生成6位随机字符串
$_SESSION['code'] = $code; //将验证码存储到session中

$width = 100; //验证码图片宽度
$height = 30; //验证码图片高度
$image = imagecreatetruecolor($width, $height); //创建画布

//定义颜色
$white = imagecolorallocate($image, 255, 255, 255); //白色
$black = imagecolorallocate($image, 0, 0, 0); //黑色
$gray = imagecolorallocate($image, 200, 200, 200); //灰色

//填充画布
imagefill($image, 0, 0, $gray);

//绘制干扰线
for ($i = 0; $i < 5; $i++) {
    $line_color = imagecolorallocate($image, mt_rand(0, 255), mt_rand(0, 255), mt_rand(0, 255));
    imageline($image, 0, mt_rand(0, $height), $width, mt_rand(0, $height), $line_color);
}

//绘制干扰点
for ($i = 0; $i < 50; $i++) {
    imagesetpixel($image, mt_rand(0, $width), mt_rand(0, $height), $black);
}

//绘制文字
$fontfile =  dirname(__FILE__) . '/font/Lost-Castedral.otf'; //字体文件路径
$fontsize = 20; //字体大小
$angle = mt_rand(-10, 10); //文字旋转角度
$x = mt_rand(10, 30); //文字X坐标
$y = mt_rand($fontsize, $height - 5); //文字Y坐标
$color = imagecolorallocate($image, mt_rand(0, 150), mt_rand(0, 150), mt_rand(0, 150)); //文字颜色
imagettftext($image, $fontsize, $angle, $x, $y, $color, $fontfile, $code);

//输出图像
header('Content-Type: image/png');
imagepng($image);

//释放内存
imagedestroy($image);
?>