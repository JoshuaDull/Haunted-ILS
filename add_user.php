<?php 
session_start();

require_once 'includes/login.php';
// require_once 'includes/functions.php';

$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) die($conn->connect_error);
  
$salt1 = "rI3l*";  
$salt2 = "@6HgY";  
$first_name = 'Joshua';  
$last_name = 'Dull';  
$user_name = 'eldergods';  
$password = 'Cthulhu=#1'; 
$email = 'joshualdull@gmail.com'; 
$token = hash('ripemd128', "$salt1$password$salt2");

$query  = "INSERT INTO users (`user_name`, `psswrd`, `email`, `first_name`, `last_name`) VALUES('$user_name', '$token', '$email', '$first_name', '$last_name' )";    
$result = $conn->query($query);    
if (!$result) die($conn->error);  
?>
