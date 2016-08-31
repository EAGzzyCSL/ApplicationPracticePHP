<?php
session_start();

require "jsonHelper.php";
require "connectSql.php";

$PostType = $_GET['PostType'];

switch ($PostType) {
    case "Course":
        require "Course.php";
        break;
}

sqlsrv_close($conn);