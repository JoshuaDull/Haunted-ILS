<?php

session_start();

require_once 'includes/login.php';
require_once 'includes/functions.php';
require_once 'includes/auth.php';
include_once 'includes/header.php';
if (isset($message)) echo $message;
?>

<body>
  <script>$(document).ready(function(){
      $(".story").click(function(){
          $(".puzzle").toggle(1000);
      });
  });
  </script>
  <script>$(document).ready(function(){
      $(".books").click(function(){
          $(".choices").toggle(1000);
      });
  });
  </script>
  <script>
    $(function(){
        $(".story").typed({
          strings: ["You hear a loud noise ^2000 <br><br>Sounds like someone banging a metal door ^500 . ^500 . ^500 . ^500 <br>\"What metal door?\" you mumble to yourself as you stand at your desk. ^1000 <br>The once bustling library is now deserted. ^1000 <br> Where did everyone go? ^1000 <br><br> You follow the noise to the back wall of the library... ^500 <br>Between the Men's room and the phonebooth you see a strange metal door... ^1000 <br>Never noticed that before. ^1000 <br>There's a small panel on the door, something you might see on a door to a speakeasy ^1000 ...in a movie maybe.<br><button class=\"toggle\">Slide Open</button>"],
          typeSpeed: 20
        });
    });
  </script>
  <div class="game">
  <div class="text_animation">
    <span class="story"></span>
  </div>
  <div class="puzzle">
    <p class="text">A small torn piece of paper falls from the opening:</p>
    <div class="note"><p>

<?php
#_-_-_-_-_-_puzzle one_-_-_-_-_-_
$puzzle_one = rand_book_gen(3); #returns an array of three random books
$score = 0;
$question_one = mt_rand(0,2); #picks one of these random books to be metaphoned. This variable will also serve as the correct answer.
$pieces = explode(" ", $puzzle_one[$question_one]['title']); #breaks title into individual words
$word_count = count($pieces);
#runs each word through metaphone and prints results
for ($x = 0; $x < $word_count; $x++) {
    echo metaphone($pieces[$x]) . " ";
  }
echo '</div><p class="text">As you return to your desk you notice a pile of strange books on the floor<br><br><button class="books">Pick up Books</button></p><div class="choices">';
echo '<form method="POST" action="level_one2.php"><fieldset id="metaphone"><legend>You pick up...</legend>';
echo "<input type=\"radio\" name=\"option\" value=0 required>".$puzzle_one[0]['title'].", ".$puzzle_one[0]['author'].", ".$puzzle_one[0]['year']."<br>";
echo  "<input type=\"radio\" name=\"option\" value=1 required>".$puzzle_one[1]['title'].", ".$puzzle_one[1]['author'].", ".$puzzle_one[1]['year']."<br>";
echo  "<input type=\"radio\" name=\"option\" value=2 required>".$puzzle_one[2]['title'].", ".$puzzle_one[2]['author'].", ".$puzzle_one[2]['year'];
echo "<input type=\"hidden\" name=\"answer\" value=" . $question_one . ">";
echo "<input type=\"hidden\" name=\"score_one\" value=" . $score . ">";
echo "<br><br><input type=\"submit\" name=\"submit\"></form></fieldset></div>";
?>
</div>
</div>
</body>
</html>
 <!-- <br><br>Sounds like someone banging a metal door ^500 . ^500 . ^500 . ^500 <br>\"What metal door?\" you mumble to yourself as you stand at your desk. ^1000 <br>The once bustling library is now deserted. ^1000 <br> Where did everyone go? ^1000 <br><br> You follow the noise to the back wall of the library... ^500 <br>Between the Men's room and the phonebooth you see a strange metal door... ^1000 <br>Never noticed that before. ^1000 <br>There's a small panel on the door, something you might see on a door to a speakeasy ^1000 ...in a movie maybe.<br> -->
