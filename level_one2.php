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
      $score = 0;
      echo "<br>your score is " . $score;
    }
  }
}

include_once 'includes/header.php';
if (isset($message)) echo $message;

#_-_-_-_-_-_puzzle two_-_-_-_-_-_
$puzzle_two = rand_book_gen(4);
$question_two = mt_rand(0,3); #picks one of these random books to be metaphoned
$pieces = explode(" ", $puzzle_two[$question_two]['title']); #breaks title into words
$word_count = count($pieces);
#runs each word through metaphone and prints results
for ($x = 0; $x < $word_count; $x++) {
  echo metaphone($pieces[$x]) . " ";
}
echo "<form method=\"POST\" action=\"level_one3.php\"><fieldset style=\"width:50%\"><legend>Choose correct book</legend>";
echo "<input type=\"radio\" name=\"option\" value=0>".$puzzle_two[0]['title'].", ".$puzzle_two[0]['author'].", ".$puzzle_two[0]['year']."<br>";
echo  "<input type=\"radio\" name=\"option\" value=1>".$puzzle_two[1]['title'].", ".$puzzle_two[1]['author'].", ".$puzzle_two[1]['year']."<br>";
echo  "<input type=\"radio\" name=\"option\" value=2>".$puzzle_two[2]['title'].", ".$puzzle_two[2]['author'].", ".$puzzle_two[2]['year']."<br>";
echo  "<input type=\"radio\" name=\"option\" value=3>".$puzzle_two[3]['title'].", ".$puzzle_two[3]['author'].", ".$puzzle_two[3]['year']."</fieldset>";
echo "<input type=\"hidden\" name=\"score_one\" value=" . $score . ">";
echo "<input type=\"hidden\" name=\"answer\" value=" . $question_two . ">";
echo "<br><br><input type=\"submit\" name=\"submit\"></form>";
?>
</body>
</html>
