<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2016/9/9
 * Time: 15:22.
 */
header('Content-type: text/html;charset=utf-8;');
$array = null;
$user_ID = $_POST['user_ID'];
$token = $_POST['token'];
$result = mysqli_query($conn, "SELECT * FROM token WHERE  token='$token' AND user_ID='$user_ID'");
if (!(mysqli_num_rows($result))) {
    echo newjson(18, 'token操作错误或用户不存在，拒绝服务', $array);
} else {
    $result1 = mysqli_query($conn, "SELECT * FROM comment WHERE user_ID='$user_ID'");
    $result2 = mysqli_query($conn, "SELECT name,avatar FROM user_infor WHERE ID='$user_ID'");
    $row2 = mysqli_fetch_array($result2);
    $i = 0;
    while ($row = mysqli_fetch_array($result1)) {
        $array[$i]['content'] = $row['content'];
        $array[$i]['rate'] = $row['rate'];
        $array[$i]['time'] = $row['time'];
        $array[$i]['like_num'] = $row['like_num'];
        $array[$i]['name'] = $row2['name'];
        $array[$i]['avatar']=$row2['avatar'];
        $comment_ID= $row['ID'];
        if($user_ID==null){
            $array[$i]['ispraised']=0;
        }else{
            $result_ispraised = mysqli_query($conn,"SELECT * FROM praise WHERE user_ID='$user_ID' AND comment_ID='$comment_ID'");
            if (!(mysqli_num_rows($result_ispraised))){
                $array[$i]['ispraised']=0;
            }else{
                $array[$i]['ispraised']=1;
            }
        }
        $result_image = mysqli_query($conn, "SELECT `url` FROM `comment_image` WHERE `comment_ID`=$comment_ID");
        $url_array = array();
        while ($row_image = mysqli_fetch_array($result_image)) {
            array_push($url_array, $row_image['url']);
        }
        $array[$i]['images'] = $url_array;
        ++$i;
    }
    echo newjson(40, '获取用户所有评论成功', $array);
}
