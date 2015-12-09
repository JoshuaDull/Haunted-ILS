<?php
session_start();

require_once 'includes/login.php';
require_once 'includes/functions.php';

if (isset($_POST['submit'])) { //check if the form has been submitted
	if (empty($_POST['user_name']) || empty($_POST['password']) || empty($_POST['first_name']) || empty($_POST['last_name']) || empty($_POST['email'])) {
		$message = '<p>Please fill out all of the form fields!</p>';
	} else {
		$conn = new mysqli($hn, $un, $pw, $db);
		if ($conn->connect_error) die($conn->connect_error);
		$user_name = sanitizeMySQL($conn, $_POST['user_name']);
		$password = sanitizeMySQL($conn, $_POST['password']);
		$first_name = sanitizeMySQL($conn, $_POST['first_name']);
		$last_name = sanitizeMySQL($conn, $_POST['last_name']);
		$email = sanitizeMySQL($conn, $_POST['email']);
		$salt1 = "rI3l*";
		$salt2 = "@6HgY";
		$token = hash('ripemd128', $salt1.$password.$salt2);
		$query  = "INSERT INTO users (`user_name`, `password`, `first_name`, `last_name`, `email`) VALUES('$user_name', '$token', '$first_name', '$last_name', '$email' )";
		$result = $conn->query($query);
		if (!$result) {
			die("database access failed: " . $conn->error);
	} else {
		$goto = '/Haunted-ILS/sign_in.php';
		header('Location: ' .$goto);
		}
	}
}
?>

<?php
include_once 'includes/header.php';
if (isset($message)) echo $message;
?>
<body class="windows">
<div id="windowDiv">
	<div id="windowHeader">
		<span>Miskatonic University Library</span>
	</div>
	<div id="windowBody">
		<fieldset class="fields">
			<form method="POST" action="">
				<!-- <legend>Create a new User</legend> -->
				Username:<br>
				<input type="text" name ="user_name" size="40" autofocus=""></br>
				Password:<br>
				<input type="text" name ="password" size="40"></br>
				First Name:<br>
				<input type="text" name ="first_name" size="40"></br>
				Last Name:<br>
				<input type="text" name ="last_name" size="40"></br>
				Email Address:</br>
				<input type="text" name ="email" size="40"></br>
				<p class="buttons">
					<input type="submit" name="submit" value="Create Account">
				</p>
			</form>
		</fieldset>
	</div>
</div>
</body>
</html>
