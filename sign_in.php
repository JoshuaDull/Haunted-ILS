<?php
session_start();

require_once 'includes/login.php';
require_once 'includes/functions.php';

if (isset($_POST['submit'])) { //check if the form has been submitted
	if (empty($_POST['user_name']) || empty($_POST['password']) ) {
		$message = '<p class="error">Please fill out all of the form fields!</p>';
	} else {
		$conn = new mysqli($hn, $un, $pw, $db);
		if ($conn->connect_error) die($conn->connect_error);
		$user_name = sanitizeMySQL($conn, $_POST['user_name']);
		$password = sanitizeMySQL($conn, $_POST['password']);
		$salt1 = "rI3l*";
		$salt2 = "@6HgY";
		$password = hash('ripemd128', $salt1.$password.$salt2);
		$query  = "SELECT first_name, last_name FROM users WHERE user_name='$user_name' AND password='$password'";
		$result = $conn->query($query);
		if (!$result) die($conn->error);
		$rows = $result->num_rows;
		if ($rows==1) {
			$row = $result->fetch_assoc();
			$_SESSION['first_name'] = $row['first_name'];
			$_SESSION['last_name'] = $row['last_name'];
			$goto = empty($_SESSION['goto']) ? '/Haunted-ILS/index.php' : $_SESSION['goto'];
			header('Location: ' . $goto);
			exit;
		} else {
			$message = '<p class="error">Invalid username/password combination!</p>';
		}
	}
}
?>

<?php
include_once 'includes/header.php';
if (isset($message)) echo $message;
?>
<fieldset style="width:30%"><legend>Log-in</legend>
<form method="POST" action="">
Username:<br><input type="text" name="user_name" size="40"><br>
Password:<br><input type="password" name="password" size="40"><br>
<input type="submit" name="submit" value="Log-In">
</form>
</fieldset>
<p><a href="add_user.php">Create an Account</a>
</body>
</html>
