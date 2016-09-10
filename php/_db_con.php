<?php

$db_con = new mysqli('localhost', 'school', '123456');
$db_con->select_db('schoolfood');
$db_con->set_charset('utf8');
