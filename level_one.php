<?php

session_start();

require_once 'includes/login.php';
require_once 'includes/functions.php';

// if (isset($_POST['submit'])) {
//   if (!isset($_POST['option'])) {
//     $message = '<p class="error">Please fill out all of the form fields!</p>';
//   } else {
//     if ($_POST['option'] == $_POST['answer']){
//       $message = $_POST['option'] . " was correct " . $_POST['answer'];
//     } else {
//       $message = "wrong<br>";
//     }
//   }
// }

include_once 'includes/header.php';
if (isset($message)) echo $message;
#_-_-_-_-_-_puzzle one_-_-_-_-_-_
$puzzle_one = rand_book_gen(3); #picks 3 random books
$score = 0;
  $question_one = mt_rand(0,2);
  echo "<br>" . $question_one . " is the correct answer<br>"; #picks one of these random books to be metaphoned
  $pieces = explode(" ", $puzzle_one[$question_one]['title']); #breaks title into words
  $word_count = count($pieces);
  #runs each word through metaphone and prints results
  for ($x = 0; $x < $word_count; $x++) {
    echo metaphone($pieces[$x]) . " ";
  }
echo "<form method=\"POST\" action=\"level_one2.php\"><fieldset style=\"width:50%\"><legend>Choose correct book</legend>";
echo "<input type=\"radio\" name=\"option\" value=0>".$puzzle_one[0]['title'].", ".$puzzle_one[0]['author'].", ".$puzzle_one[0]['year']."<br>";
echo  "<input type=\"radio\" name=\"option\" value=1>".$puzzle_one[1]['title'].", ".$puzzle_one[1]['author'].", ".$puzzle_one[1]['year']."<br>";
echo  "<input type=\"radio\" name=\"option\" value=2>".$puzzle_one[2]['title'].", ".$puzzle_one[2]['author'].", ".$puzzle_one[2]['year']."</fieldset>";
echo "<input type=\"hidden\" name=\"answer\" value=" . $question_one . ">";
echo "<input type=\"hidden\" name=\"score_one\" value=" . $score . ">";
echo "<br><br><input type=\"submit\" name=\"submit\"></form>";
?>
</body>
</html>
