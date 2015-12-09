<?php

session_start();

require_once 'includes/login.php';
require_once 'includes/functions.php';
require_once 'includes/auth.php';
$user_id = $_SESSION['user_id'];
$level_id = 2;
if (isset($_POST['submit'])) {
  $score = $_POST['score_two'];
  $conn = new mysqli($hn, $un, $pw, $db);
  if ($conn->connect_error) die($conn->connect_error);
  $query = "INSERT INTO save_files (`user_id`, `level_id`, `score`) VALUES ('$user_id', '$level_id', '$score')";
  $result = $conn->query($query);
  if (!$result) {
    die ("database error: " . $conn->error);
} else {
  echo "<p>Your score: " . $score;
}}

?>
<?php
include_once 'includes/header.php';
$high_scores = [];
$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) die($conn->connect_error);
$query = "SELECT `user_name`, `score` FROM save_files JOIN users ON save_files.user_id=users.user_id WHERE level_id=2 ORDER BY score DESC LIMIT 10";
$result = $conn->query($query);
if (!$result) die ("database error: " . $conn->error);
$rows = $result->num_rows;

echo "<table><tr><th>Username</th><th>Score</th></tr>";
while ($row = $result->fetch_assoc()) {
  echo "<tr><td>" . $row['user_name'] . "</td>";
  echo "<td>" . $row['score'] . "</td></tr>";
}
echo "</table>";
?>
<form action="index.php">
  <p class="buttons"><input type="submit" value="Return to Desktop"></p>
</form>
<form action="level_two.php">
  <p class="buttons"><input type="submit" value="Play Again"></p>
</form>
</body>
</html>
