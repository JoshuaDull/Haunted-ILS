<?php

session_start();

require_once 'includes/login.php';
require_once 'includes/functions.php';

if (isset($_POST['submit'])) {
  if (!isset($_POST['option'])) {
    $message = '<p class="error">Please fill out all of the form fields!</p>';
  } else {
    if ($_POST['option'] == $_POST['answer']){
      $message = $_POST['option'] . " was correct " . $_POST['answer'];
      $score = ($_POST['score_one'] + 100);
      echo "<br>your score is " . $score;
    } else {
      $message = "wrong<br>";
      $score = $_POST['score_one'];
      echo "<br>your score is " . $score;
    }
  }
}

include_once 'includes/header.php';
if (isset($message)) echo $message;

#_-_-_-_-_-_puzzle four_-_-_-_-_-_
$puzzle_four = rand_book_gen(1);
#picks one of these random books to be metaphoned
$pieces = explode(" ", $puzzle_four[0]['title']); #breaks title into words
$word_count = count($pieces);
#runs each word through metaphone and prints results
$correct_answer = $puzzle_four[0]['book_id'];
echo $correct_answer;
for ($x = 0; $x < $word_count; $x++) {
  echo metaphone($pieces[$x]) . " ";
}
echo "<form method=\"POST\" action=\"level_one_final.php\"><fieldset style=\"width:50%\"><legend>Name the book</legend>";
echo "<input type=\"text\" name=\"four\" size=\"100\"><br>";
echo "<input type=\"hidden\" name=\"score_one\" value=" . $score . ">";
echo "<input type=\"hidden\" name=\"correct_answer\" value=" . $correct_answer . ">";
echo "<br><br><input type=\"submit\" name=\"submit\"></form>";

?>
</body>
</html>
