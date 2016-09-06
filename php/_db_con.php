<?php

$db_con = new mysqli('localhost', 'schoolfood', '12345678');
$db_con->select_db('schoolfood');
$db_con->set_charset('utf8');
