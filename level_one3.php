<?php

session_start();

require_once 'includes/login.php';
require_once 'includes/functions.php';
require_once 'includes/auth.php';

if (isset($_POST['submit'])) {
  if (!isset($_POST['option'])) {
    $message = '<p class="error">Please fill out all of the form fields!</p>';
  } else {
    if ($_POST['option'] == $_POST['answer']){
      $message = '<p class="text">You hear an excited moan from the other side of the door.<br><br>You slide the book through the slot and another slip falls from the opening...</p><div class="note">';
      $score = ($_POST['score_one'] + 100);
      // echo "<br>your score is " . $score;
    } else {
      $message = '<p class="text">Nothing happens...<br><br>Another slip falls from the door</p><div class="note">';
      $score = $_POST['score_one'];
      // echo "<br>your score is " . $score;
    }
  }
}

include_once 'includes/header.php';
if (isset($message)) echo $message;
?>

<body>
  <script>$(document).ready(function(){
      $(".books").click(function(){
          $(".choices").toggle(1000);
      });
  });
  </script>

<?php
#_-_-_-_-_-_puzzle three_-_-_-_-_-_
$puzzle_three = rand_book_gen(4);
$question_three = mt_rand(0,3); #picks one of these random books to be metaphoned
$pieces = explode(" ", $puzzle_three[$question_three]['title']); #breaks title into words
$word_count = count($pieces);
#runs each word through metaphone and prints results
for ($x = 0; $x < $word_count; $x++) {
  echo metaphone($pieces[$x]) . " ";
}
echo '</div><p class="text">You return to your desk to find four books sitting neatly in a pile...<br><button class="books">Pick up Books</button></p><div class="choices">';
echo '<form method="POST" action="level_one4.php"><fieldset id="metaphone"><legend>You pick up...</legend>';
echo "<input type=\"radio\" name=\"option\" value=0>".$puzzle_three[0]['title'].", ".$puzzle_three[0]['author'].", ".$puzzle_three[0]['year']."<br>";
echo  "<input type=\"radio\" name=\"option\" value=1>".$puzzle_three[1]['title'].", ".$puzzle_three[1]['author'].", ".$puzzle_three[1]['year']."<br>";
echo  "<input type=\"radio\" name=\"option\" value=2>".$puzzle_three[2]['title'].", ".$puzzle_three[2]['author'].", ".$puzzle_three[2]['year']."<br>";
echo  "<input type=\"radio\" name=\"option\" value=3>".$puzzle_three[3]['title'].", ".$puzzle_three[3]['author'].", ".$puzzle_three[3]['year'];
echo "<input type=\"hidden\" name=\"answer\" value=" . $question_three . ">";
echo "<input type=\"hidden\" name=\"score_one\" value=" . $score . ">";
echo "<br><br><input type=\"submit\" name=\"submit\"></form></fieldset></div>";
?>
</body>
</html>
