<?php
/**
 * Created by PhpStorm.
 * User: 红印
 * Date: 2016/9/6
 * Time: 14:25.
 */
header('Content-type: text/html;charset=utf-8;');
$array = null;
$sql = null;
$keyword = $_POST['keyword'];
if (isset($_POST['user_ID'])) {
    $user_ID = $_POST['user_ID'];
    $token = $_POST['token'];
    //date_date_set('PRC');
    $date = date('Y-m-d H:i:s', time());
    $sql = "INSERT INTO record (keyword, user_ID, type,time) VALUES ('$keyword','$user_ID',1,'$date')";
    $new = mysqli_query($conn, $sql);
}

$order = $_POST['order'];
switch ($order) {
    case '0':
        if (isset($_POST['school_ID'])) {
            if (isset($_POST['shop_ID'])) {
                $shop_ID = $_POST['shop_ID'];
                $sql = "SELECT * FROM goods WHERE  name LIKE '%$keyword%' AND shop_ID='$shop_ID' ORDER BY rate DESC";
            } else {
                $school_ID = $_POST['school_ID'];
                $sql = "SELECT * FROM goods WHERE  name LIKE '%$keyword%' AND school_ID='$school_ID' ORDER BY rate DESC";
                break;
            }
        } else {
            $sql = "SELECT * FROM goods WHERE  name LIKE '%$keyword%' ORDER BY rate DESC";
            break;
        }
    case '1':
        if (isset($_POST['school_ID'])) {
            if (isset($_POST['shop_ID'])) {
                $shop_ID = $_POST['shop_ID'];
                $sql = "SELECT * FROM goods WHERE  name LIKE '%$keyword%' AND shop_ID='$shop_ID' ORDER BY rate ASC";
                break;
            } else {
                $school_ID = $_POST['school_ID'];
                $sql = "SELECT * FROM goods WHERE  name LIKE '%$keyword%' AND school_ID='$school_ID' ORDER BY rate ASC";
                break;
            }
        } else {
            $sql = "SELECT * FROM goods WHERE  name LIKE '%$keyword%' ORDER BY rate ASC";
            break;
        }
    case '2':
        if (isset($_POST['school_ID'])) {
            if (isset($_POST['shop_ID'])) {
                $shop_ID = $_POST['shop_ID'];
                $sql = "SELECT * FROM goods WHERE  name LIKE '%$keyword%' AND shop_ID='$shop_ID' ORDER BY price ASC";
                break;
            } else {
                $school_ID = $_POST['school_ID'];
                $sql = "SELECT * FROM goods WHERE  name LIKE '%$keyword%' AND school_ID='$school_ID' ORDER BY price ASC";
                break;
            }
        } else {
            $sql = "SELECT * FROM goods WHERE  name LIKE '%$keyword%' ORDER BY price ASC";
            break;
        }
    case '3':
        if (isset($_POST['school_ID'])) {
            if (isset($_POST['shop_ID'])) {
                $shop_ID = $_POST['shop_ID'];
                $sql = "SELECT * FROM goods WHERE  name LIKE '%$keyword%' AND shop_ID='$shop_ID' ORDER BY price DESC";
                break;
            } else {
                $school_ID = $_POST['school_ID'];
                $sql = "SELECT * FROM goods WHERE  name LIKE '%$keyword%' AND school_ID='$school_ID' ORDER BY price DESC";
                break;
            }
        } else {
            $sql = "SELECT * FROM goods WHERE  name LIKE '%$keyword%' ORDER BY price DESC";
            break;
        }
}

$result = mysqli_query($conn, $sql);
if (!(mysqli_num_rows($result))) {
    echo newjson(10, '没有有关的数据', $array);
} else {
    $i = 0;
    while ($row = mysqli_fetch_array($result)) {
        //$row = mysqli_fetch_array($result)
        $array[$i]['ID'] = $row['ID'];
        $array[$i]['name'] = $row['name'];
        $array[$i]['price'] = $row['price'];
        $array[$i]['shop_ID'] = $row['shop_ID'];
        $array[$i]['school_ID'] = $row['school_ID'];
        $array[$i]['rate'] = $row['rate'];
        $goods_ID = $row['ID'];
        $result_image = mysqli_query($conn, "SELECT `url` FROM `goods_image` WHERE `goods_ID`=$goods_ID");
        $url_array = array();
        while ($row_image = mysqli_fetch_array($result_image)) {
            array_push($url_array, $row_image['url']);
        }
        $array[$i]['images'] = $url_array;
        ++$i;
    }
    echo newjson(11, '搜索成功', $array);
}
