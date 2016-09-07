<?php
/**
 * Created by PhpStorm.
 * User: 红印
 * Date: 2016/9/6
 * Time: 22:08
 */
$array=null;
$ID=$_POST['ID'];
$name=$_POST['name'];
$sex=$_POST['sex'];
$native=$_POST['native'];
$tel=$_POST['tel'];
$email=$_POST['email'];
$birth=$_POST['birth'];
$sql="UPDATE user_infor SET name='$name',sex='$sex',native='$native',tel='$tel',email='$email',birth='$birth' WHERE ID='$ID'";
if(mysqli_query($conn,$sql)){
    echo newjson(35,"更新数据成功",$array);
}else echo newjson(36,"更新数据失败",$array);

?>