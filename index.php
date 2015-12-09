
<?php
session_start();

require_once 'includes/login.php';
require_once 'includes/functions.php';
require_once 'includes/auth.php';
$user_id = $_SESSION['user_id'];
$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) die($conn->connect_error);
$query = "SELECT `user_name`, SUM(`score`) FROM save_files JOIN users ON save_files.user_id=users.user_id WHERE save_files.user_id=$user_id";
$result = $conn->query($query);
if (!$result) {
  die ("database malfunciotn: " . $conn->error);
} else {
  $row = $result->fetch_assoc();
  $first_name = $_SESSION['first_name'];
  $user_name = $row['user_name'];
  $total_score = $row['SUM(`score`)'];
}


?>

<?php require_once 'includes/header.php'; ?>

<body id="desktop">
        <div class="folders">
          <a href="level_one.php"><img class="folder"src="images/book.gif"></a>
          <a href="level_two.php"><img class="folder"src="images/book.png"></a>
          <a href="application_one.html"><img class="folder"src="images/shield.png"></a>
        </div>
        <div class="menu">
        <p><?php echo "Hello " . $first_name . "<br> Total Score: " . $total_score; ?></p>
          <fieldset><legend>High Scores</legend>
          <form action="level_one_high_scores.php">
            <p class="buttons"><input type="submit" value="Level 1"></p>
          </form>
          <form action="level_two_high_scores.php">
            <p class="buttons"><input type="submit" value="Level 2"></p>
          </form>
        </fieldset>
        <form action="logout.php">
          <p class="buttons"><input type="submit" value="Logout"></p>
        </form>
        </div>
      <div id="toolbar">
        <p id="total_score"><button class="toggle">Options</button></p>
        <p id="clock">
          <iframe src="http://free.timeanddate.com/clock/i4wv5lj0/n179/fn2/tcccc/bas2/bat8/ts1" frameborder="0" width="77" height="25"></iframe>
        </p>
      </div>
    </body>
  </html>
