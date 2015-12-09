<?php
session_start();
$_SESSION = array();
$goto = '/Haunted-ILS/sign_in.php';
header('Location: ' .$goto);
?>
