<?php

session_start();
$_SESSION['currentUser'] = '';
header('location:../admin.php');
