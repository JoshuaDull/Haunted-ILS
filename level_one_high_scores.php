<?php

session_start();

require_once 'includes/login.php';
require_once 'includes/functions.php';
$user_id = 3;
$level_id = 1;
if (isset($_POST['submit'])) {
  $score = $_POST['score_one'];
  $conn = new mysqli($hn, $un, $pw, $db);
  if ($conn->connect_error) die($conn->connect_error);
  $query = "INSERT INTO save_files (`user_id`, `level_id`, `score`) VALUES ('$user_id', '$level_id', '$score')";
  $result = $conn->query($query);
  if (!$result) {
    die ("database malfunciotn: " . $conn->error);
} else {

}}

?>
<?php
include_once 'includes/header.php';
$high_scores = [];
$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) die($conn->connect_error);
$query = "SELECT `user_name`, `score` FROM save_files JOIN users ON save_files.user_id=users.user_id WHERE level_id=1 ORDER BY score DESC LIMIT 10";
$result = $conn->query($query);
if (!$result) die ("database malfunciotn: " . $conn->error);
$rows = $result->num_rows;

echo "<table><tr><th>Username</th><th>Score</th></tr>";
while ($row = $result->fetch_assoc()) {
  echo "<tr><td>" . $row['user_name'] . "</td>";
  echo "<td>" . $row['score'] . "</td></tr>";
}
echo "</table>";
?>
<a href="index.php">Return to Desktop</a>


</body>
</html>
