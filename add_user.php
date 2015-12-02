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
		$first_name = sanitizeMySQL($conn, $_POST['first_name']);
		$last_name = sanitizeMySQL($conn, $_POST['last_name']);
		$email = sanitizeMySQL($conn, $_POST['email']);	
		$salt1 = "rI3l*";  
		$salt2 = "@6HgY";  
		$password = hash('ripemd128', $salt1.$password.$salt2);
		$query  = "INSERT INTO users (`user_name`, `password`, `first_name`, `last_name`, `email`) VALUES('$user_name', '$token', '$first_name', '$last_name', '$email' )"; 
		$result = $conn->query($query);    
		if (!$result) die($conn->error); 
		$rows = $result->num_rows;
		if ($rows==1) {
			$row = $result->fetch_assoc();
			$_SESSION['first_name'] = $row['first_name'];
			$_SESSION['last_name'] = $row['last_name'];
			$go_to = $_GET ["landing"];
			header("Location: ". $go_to);
			echo($goto);		
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
<fieldset>
<form method="POST" action="">
	
		<legend>Create a new User</legend>
		<label for="user_name">Username:</label>
		<input type="text" name ="user_name"></br>
		<label for="password">Password:</label>
		<input type="text" name ="password"></br>
		<label for="first_name">First Name:</label>
		<input type="text" name ="first_name"></br>
		<label for="last_name">Last Name:</label>
		<input type="text" name ="last_name"></br>
		<label for="email">Email Address:</label>
		<input type="text" name ="email"></br>
		<input type="submit" name="submit">
	
</form></fieldset>
</body>
</html>			