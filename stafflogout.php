<?php
session_start();
$_SESSION = array();
 
session_destroy();

header("location: staffogin.php");
exit;
?>