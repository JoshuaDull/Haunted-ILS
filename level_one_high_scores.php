<?php

session_start();

require_once 'includes/login.php';
require_once 'includes/functions.php';
require_once 'includes/auth.php';
$user_id = $_SESSION['user_id'];
$level_id = 1;
if (isset($_POST['submit'])) {
  $score = $_POST['score_one'];
  $conn = new mysqli($hn, $un, $pw, $db);
  if ($conn->connect_error) die($conn->connect_error);
  $query = "INSERT INTO save_files (`user_id`, `level_id`, `score`) VALUES ('$user_id', '$level_id', '$score')";
  $result = $conn->query($query);
  if (!$result) {
    die ("database error: " . $conn->error);
} else {
  $message = '<p class="text">Your score: ' . $score;
}}
include_once 'includes/header.php';
if (isset($message)) echo $message;
?>

<body>
  <div class="game">

<?php
$high_scores = [];
$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) die($conn->connect_error);
$query = "SELECT `user_name`, `score` FROM save_files JOIN users ON save_files.user_id=users.user_id WHERE level_id=1 ORDER BY score DESC LIMIT 10";
$result = $conn->query($query);
if (!$result) die ("database error: " . $conn->error);
$rows = $result->num_rows;

echo '<div class="score"><table><tr><th>Username</th><th>Score</th></tr>';
while ($row = $result->fetch_assoc()) {
  echo "<tr><td>" . $row['user_name'] . "</td>";
  echo "<td>" . $row['score'] . "</td></tr>";
}
echo "</table></div>";
?>
<form action="index.php">
  <p class="buttons"><input type="submit" value="Return to Desktop"></p>
</form>
<form action="level_one.php">
  <p class="buttons"><input type="submit" value="Play Again"></p>
</form>
</div>
</body>
</html>
