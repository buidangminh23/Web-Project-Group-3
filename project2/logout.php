<?php
require_once "functions.php";

start_secure_session();
$_SESSION = [];
session_destroy();
header("Location: login.php");
exit();
?>
