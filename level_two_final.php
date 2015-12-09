<?php

session_start();

require_once 'includes/login.php';
require_once 'includes/functions.php';
require_once 'includes/auth.php';

if (isset($_POST['submit'])) {
  $score = 0;
  $correct = 0;
  if ($_POST['answer_one'] == $_POST['question_one']) {
    $score += 100;
    $correct += 1;
  } else {
    $score -= 25;
  }
  if ($_POST['answer_two'] == $_POST['question_two']) {
    $score += 100;
    $correct += 1;
  } else {
    $score -= 25;
  }
}

?>
<?php
include_once 'includes/header.php';
echo $score . "<br>" . $correct;
echo "<form method=\"POST\" action=\"level_two_high_scores.php\"><fieldset style=\"width:50%\"><legend>Your final score is: " . $score . "</legend>";
echo "<input type=\"hidden\" name=\"score_two\" value=" . $score . ">";
echo "<br><br><input type=\"submit\" name=\"submit\"></form>";
?>
