<?php
header("Content-type: text/html;charset=gbk;");

//本地测试的服务名
$serverName = "localhost";
//连接数据库 ，第一个用户名，第二个密码，第三个数据库名
$connectionInfo = array("UID" => "root", "PWD" => "", "Database" => "");
$sqlConn = true;

$conn = sqlsrv_connect($serverName, $connectionInfo);
//sqlsrv_query("set names utf8");

if (!$conn) {
    die("数据库连接出错");
}