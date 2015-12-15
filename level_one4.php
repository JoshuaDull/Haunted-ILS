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
#_-_-_-_-_-_puzzle four_-_-_-_-_-_
$puzzle_four = rand_book_gen(1);
#picks one of these random books to be metaphoned
$pieces = explode(" ", $puzzle_four[0]['title']); #breaks title into words
$word_count = count($pieces);
#runs each word through metaphone and prints results
$correct_answer = $puzzle_four[0]['book_id'];

for ($x = 0; $x < $word_count; $x++) {
  echo metaphone($pieces[$x]) . " ";
}
echo '</div><p class="text">You immediately notice a drawer open on the card catalog.<br><button class="books">Find a Card</button></p><div class="choices">';
echo '<form method="POST" action="level_one_final.php"><fieldset id="metaphone"><legend>You look for...</legend>';
echo "<input type=\"text\" name=\"four\" size=\"100\" autofocus=\"\"><br>";
echo "<input type=\"hidden\" name=\"score_one\" value=" . $score . ">";
echo "<input type=\"hidden\" name=\"correct_answer\" value=" . $correct_answer . ">";
echo "<br><br><input type=\"submit\" name=\"submit\"></fieldset></form></div>";

?>
</body>
</html>
