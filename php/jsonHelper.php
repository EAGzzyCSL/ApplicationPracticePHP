<?php
header("Content-type: text/html;charset=utf-8;");

function arrayRecursive(&$array, $function, $apply_to_keys_also = false)
{
    static $recursive_counter = 0;
    if (++$recursive_counter > 1000) {
        die('possible deep recursion attack');
    }
    foreach ($array as $key => $value) {
        if (is_array($value)) {
            arrayRecursive($array[$key], $function, $apply_to_keys_also);
        } else {
            $array[$key] = $function($value);
        }

        if ($apply_to_keys_also && is_string($key)) {
            $new_key = $function($key);
            if ($new_key != $key) {
                $array[$new_key] = $array[$key];
                unset($array[$key]);
            }
        }
    }
    $recursive_counter--;
}

/**************************************************************
 *
 *	将数组转换为JSON字符串（兼容中文）
 *	@param	array	$array		要转换的数组
 *	@return string		转换得到的json字符串
 *	@access public
 *
 *************************************************************/
function JSON($array) {
    arrayRecursive($array, 'urlencode', true);
    $json = json_encode($array);
    return urldecode($json);
}

function newjson($code, $msg, $array)
{
    $new['code']=$code;
    $new['msg']=$msg;
   // echo "测试".$msg."MM";
    //echo JSON("地方:地方");
    if($array==null){}
    else {

        $new['data']=JSON($array);
    }

    return JSON($new);
}

function njson($code, $msg)
{
    $new['code']=$code;
    $new['msg']=$msg;
    echo "测试".$msg."MM";
    return JSON($new);
}

function create_unique() {
    $data = $_SERVER['HTTP_USER_AGENT'] . $_SERVER['REMOTE_ADDR']
        .time() . rand();
    return sha1($data);
//return md5(time().$data);
//return $data;
}
?>


