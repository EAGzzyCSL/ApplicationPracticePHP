<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2016/9/6
 * Time: 14:07.
 */
header('Content-type: text/html;charset=utf-8;');
$array = null;
$user_ID=null;
$goods_ID = $_POST['goods_ID'];
if(isset($_POST['user_ID'])){
    $user_ID=$_POST['user_ID'];
}
//$result = mysqli_query($conn, "SELECT * FROM comment WHERE goods_ID='$goods_ID'");
//$result = mysqli_query($conn, "SELECT comment.ID,comment.user_ID,comment.goods_ID,comment.comment.content,
//comment.rate,comment.time,comment.like_num,user_infor.name,user_infor.avatar FROM comment,user_infor
//WHERE goods_ID='$goods_ID' AND comment.user_ID=user_infor.ID ORDER BY comment.like_num DESC");

$result = mysqli_query($conn, "SELECT comment.*,user_infor.name,user_infor.avatar
FROM comment,user_infor WHERE comment.goods_ID='$goods_ID' AND comment.user_ID=user_infor.ID ORDER BY comment.like_num DESC");
if (!(mysqli_num_rows($result))) {
    echo newjson(14, '对不起，没有您想要的菜', $array);
} else {
    $i = 0;
    while ($row = mysqli_fetch_array($result)) {
        $array[$i]['ID'] = $row['ID'];
        $array[$i]['user_ID'] = $row['user_ID'];
//        $result1 = mysqli_query($conn, 'SELECT * FROM user WHERE  ID='.$row['user_ID']);
//        $row1 = mysqli_fetch_array($result1);
        $array[$i]['goods_ID'] = $row['goods_ID'];
        $array[$i]['content'] = $row['content'];
        $array[$i]['rate'] = $row['rate'];
        $array[$i]['time'] = $row['time'];
        $array[$i]['like_num'] = $row['like_num'];
        $array[$i]['name'] = $row['name'];
        $array[$i]['avatar']=$row['avatar'];
        $comment_ID = $row['ID'];
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
    echo newjson(15, '查询成功', $array);
}
