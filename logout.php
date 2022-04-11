<?php

session_start();

unset($_SESSION['authenticated']);
unset($_SESSION['auth_user']);
$_SESSION['Status'] = "you logged out successfully";
header("location: index.php");





?>
