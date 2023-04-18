<?php 
function imaget($file){
    $allowedExts = array("gif","jpeg","jpg","png");   //白名单
    $temp = explode(".",$file["name"]); //按点分成数组
    $extension = end($temp);
    if(($file["type"] == "image/gif") || 
        ($file["type"] == "image/jpeg") ||
        ($file["type"] == "image/jpg") ||
        ($file["type"] == "image/pjpeg") ||
        ($file["type"] == "image/x-png") ||
        ($file["type"] == "image/png") &&
        ($file["size"] < 204800) &&
        in_array($extension,$allowedExts)){     // 去除的后缀必须再白名单内
        if($file["error"] >0 ){     //查看文件是否上传成功
                echo "错误：" . $file["error"]."<br />";
            }
        else{ 
                echo "上传文件名：". $file["name"] . "<br />";
                echo "文件类型：". $file["type"] . "<br />";
                echo "文件大小：". $file["size"]/1024 . "kb<br />";
                echo "文件临时存储的位置：". $file["tmp_name"] . "<br />";
                
                if(file_exists("upload/" . $file["name"]))
                {
                    echo $file["name"]. "文件已经存在！<br />" ;
                }

                
                else{
                    move_uploaded_file($file["tmp_name"],"upload/" . $file["name"]) ;  //保存文件
                    echo "保存成功！";
                    echo "图片路径：upload/" . $file["name"];
                    }
            }
        }elseif(empty($file['name'])){
            echo "图片为空(非必须上传)！";
        }else{
            echo "非法的文件格式！";
        }

}


?>

