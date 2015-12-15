<?php

session_start();

require_once 'includes/login.php';
require_once 'includes/functions.php';
require_once 'includes/auth.php';
include_once 'includes/header.php';
?>
<body>
<div class="game">
<?php

echo("<br><br>");
$sorted_books = [];
$books = random_gen(1,6,5); #multidimensional array with book information
$books = handleArticles($books); #Handles issues with articles as first words in title. Returns an array of titles.
sort($books, SORT_NATURAL | SORT_FLAG_CASE); #sorts the array by title of book
foreach ($books as $key => $val) {
  array_push($sorted_books, $val);
}

$answer_array = array($sorted_books[1], $sorted_books[3]); #an array of answer choices
shuffle($answer_array); #shuffles answer choices so the are not necessarily displayed in their sorted order
$start = time();

echo '<br><div class="question"><h3>Put these books in the correct place.</h3><br><p class="text">On your cart:<br>'. $answer_array[0] . "<br>" . $answer_array[1] . "</p><br><br><br></div>";#Gives the options for the puzzle
# builds the puzzle form
echo '<div class="shelf">';
echo '<form action="level_two_final.php" method="post"><fieldset style="width:50%">';
echo '<div style="position: relative; background: url(images/greenspine.png); width:500px; height: 53px; line-height:53px;"><p style="text-align: center;">' . $sorted_books[4] . '</p></div>';
echo '<div style="position: relative; background: url(images/brownspine.png); width:500px; height: 53px; line-height:53px;"><p style="text-align: center;">';
echo '<select name="question_one"><option value="' . $answer_array[0]. '">' . $answer_array[0] . '</option>';
echo '<option value="' . $answer_array[1]. '">' . $answer_array[1] . '</option></select></p></div>';
echo '<div style="position: relative; background: url(images/purplespine.png); width:500px; height: 53px; line-height:53px;"><p style="text-align: center;">' . $sorted_books[2] . '</p></div>';
echo '<div style="position: relative; background: url(images/bluespine.png); width:500px; height: 53px; line-height:53px;"><p style="text-align: center;">';
echo '<select name="question_two"><option value="' . $answer_array[0]. '">' . $answer_array[0] . '</option>';
echo '<option value="' . $answer_array[1]. '">' . $answer_array[1] . '</option></select></p></div>';
echo '<div style="position: relative; background: url(images/redspine.png); width:500px; height: 53px; line-height:53px;"><p style="text-align: center;">' . $sorted_books[0] . '</p></div><br></fieldset>';
echo '<input type="hidden" name="answer_one" value="' . $sorted_books[3] . '">';
echo '<input type="hidden" name="answer_two" value="' . $sorted_books[1] . '">';
echo '<input type="hidden" name="time" value="' . $start . '">';
echo '</div><input type="submit" name="submit"></form>';
?>
</div>
</body>
</html>
