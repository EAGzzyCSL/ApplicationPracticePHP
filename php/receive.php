<?php
session_start();

require "jsonHelper.php";
require "connectSql.php";

$PostType = $_GET['PostType'];

switch ($PostType) {
    case "test":
        require "test.php";
        break;
}

sqlsrv_close($conn);