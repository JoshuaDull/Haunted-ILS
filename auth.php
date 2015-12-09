<?php
if (!isset($_SESSION['first_name']) || !isset($_SESSION['last_name']) || !isset($_SESSION['user_id'])) {
  header('Location: sign_in.php');
}
?>
