
<?php
session_start();

require_once 'includes/login.php';
require_once 'includes/functions.php';
#require_once 'includes/autho.php';
$user_id = 3;
$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) die($conn->connect_error);
$query = "SELECT `user_name`, SUM(`score`) FROM save_files JOIN users ON save_files.user_id=users.user_id WHERE level_id=1 AND save_files.user_id=$user_id";
$result = $conn->query($query);
if (!$result) {
  die ("database malfunciotn: " . $conn->error);
} else {
  $row = $result->fetch_assoc();
  $user_name = $row['user_name'];
  $total_score = $row['SUM(`score`)'];
}


?>

<?php require_once 'includes/header.php'; ?>


        <div class="folders">
          <a href="level_one.php">
            <span class="icons"><img class="folder"src="images/smallfolder.png"><p class="folder_name">Application One</p></span>
          </a>
          <a href="application_one.html">
            <span class="icons"><img class="folder"src="images/smallfolder.png"><p class="folder_name">Application Three</p></span>
          </a>
        </div>
        <div class="folders">
          <a href="application_one.html">
            <span class="icons"><img class="folder"src="images/smallfolder.png"><p class="folder_name">Application Two</p></span>
          </a>
        </div>
      </div>
      <div id="toolbar">
        <p id="total_score"><?php echo "Hello: " . $user_name . " Total Score: " . $total_score; ?></p>
        <p id="clock">
          <iframe src="http://free.timeanddate.com/clock/i4wv5lj0/n179/fn2/tcccc/bas2/bat8/ts1" frameborder="0" width="77" height="25"></iframe>
        </p>

      </div>
    </body>
  </html>
