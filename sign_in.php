<?php
session_start();

require_once 'includes/login.php';
require_once 'includes/functions.php';

if (isset($_POST['submit'])) {
	if (empty($_POST['user_name']) || empty($_POST['password']) ) {
		$message = '<p class="error">Looks like you forgot something...Enter a username AND a password!</p>';
	} else {
		$conn = new mysqli($hn, $un, $pw, $db);
		if ($conn->connect_error) die($conn->connect_error);
		$user_name = sanitizeMySQL($conn, $_POST['user_name']);
		$password = sanitizeMySQL($conn, $_POST['password']);
		$salt1 = "rI3l*";
		$salt2 = "@6HgY";
		$password = hash('ripemd128', $salt1.$password.$salt2);
		$query  = "SELECT first_name, last_name, user_id FROM users WHERE user_name='$user_name' AND password='$password'";
		$result = $conn->query($query);
		if (!$result) die($conn->error);
		$rows = $result->num_rows;
		if ($rows==1) {
			$row = $result->fetch_assoc();
			$_SESSION['first_name'] = $row['first_name'];
			$_SESSION['last_name'] = $row['last_name'];
			$_SESSION['user_id'] = $row['user_id'];
			$goto = '/Haunted-ILS/';
			header('Location: ' .$goto);
			exit;
		} else {
			$message = '<p>QUIT FOOLING AROUND!<br>Enter a correct username/password combination...</p>';
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
					Username:<br><input type="text" name="user_name" size="40" autofocus=""><br>
					Password:<br><input type="password" name="password" size="40"><br><br>
					<input type="submit" name="submit" value="Login">
				</form>
			</fieldset>
			<form action="add_user.php">
				<p class="buttons"><input type="submit" value="New Account"></p>
			</form>
	</div>
</div>
</body>
</html>
