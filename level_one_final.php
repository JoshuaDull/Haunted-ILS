<?php

session_start();

require_once 'includes/login.php';
require_once 'includes/functions.php';

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
		  die ("database malfunciotn: " . $conn->error);
		} else {
			$row = $result->fetch_assoc();
			$correct_answer = $row['title'];
      $user_answer = $_POST['four'];
      similar_text($user_answer, $correct_answer, $percent);
      echo $user_answer . " vs. " . $correct_answer. $percent;
      $score = ($_POST['score_one'] + ($percent * 1000));
      $score = round($score);

	}
}
}


    // if ($_POST['option'] == $_POST['answer']){
    //   $message = $_POST['option'] . " was correct " . $_POST['answer'];
    //   $score = ($_POST['score_one'] + 100);
    //   echo "<br>your score is " . $score;
    // } else {
    //   $message = "wrong<br>";
    //   $score = $_POST['score_one'];
    //   echo "<br>your score is " . $score;


include_once 'includes/header.php';
if (isset($message)) echo $message;

echo "<form method=\"POST\" action=\"level_one_high_scores.php\"><fieldset style=\"width:50%\"><legend>Your final score is: " . $score . "</legend>";
echo "<input type=\"hidden\" name=\"score_one\" value=" . $score . ">";
echo "<br><br><input type=\"submit\" name=\"submit\"></form>";
?>
</body>
</html>
