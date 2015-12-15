<?php

session_start();

require_once 'includes/login.php';
require_once 'includes/functions.php';
require_once 'includes/auth.php';

$user_id = 3;

if (isset($_POST['submit'])) {
  if (!isset($_POST['four'])) {
    $message = '<p class="error">Please fill out all of the form fields!</p>';
  } else {
    $book_id = $_POST['correct_answer'];
    $conn = new mysqli($hn, $un, $pw, $db);
		if ($conn->connect_error) die($conn->connect_error);
		$query = "SELECT * FROM `books` WHERE book_id=$book_id";
		$result = $conn->query($query);
		if (!$result) {
		  die ("database malfunction: " . $conn->error);
		} else {
			$row = $result->fetch_assoc();
			$correct_answer = $row['title'];
      $user_answer = $_POST['four'];
      similar_text($user_answer, $correct_answer, $percent);
      $score = ($_POST['score_one'] + ($percent * 1000));
      $score = round($score);
      if ($percent >= 75) {
        $message = '<p class="text">You bring the card to the door and slide it through the open panel.<br>Why are you doing this again?<br> Maniacal laughter follow and the panel slides shut.</p>';
      } else {
        $message = '<p class="text">You bring the card to the door and slide it through the open panel.<br>Why are you doing this again?<br> Nothing happens.</p>';
      }
	   }
   }
 }

include_once 'includes/header.php';
if (isset($message)) echo $message;

echo '<div class="score"><p class="text">Final Score: ' . $score . '</p><form method="POST" action="level_one_high_scores.php">';
echo "<input type=\"hidden\" name=\"score_one\" value=" . $score . ">";
echo "<br><br><input type=\"submit\" name=\"submit\"></form></div>";
?>
</body>
</html>
