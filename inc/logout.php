<?php
if (!isset($_SESSION)) session_start();

$_SESSION = array();
// session_unset();  cam tak function
session_destroy();

header("Location: ../index.php");
exit;
