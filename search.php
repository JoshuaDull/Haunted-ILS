<?php
session_start();

require_once 'includes/auth.php';
require_once 'includes/login.php';
require_once 'includes/functions.php';
require_once 'includes/header.php';
?>

<body>
  <div>
    <h1>B.I.L.L.I.</h1>
    <div class="search">
      <p>Search the catalog</p>
      <form method="post" action="">
        <input type="text" name="title" size="70" autofocus>
        <input type="submit" name="submit">
      </form><br>
    </div>


<?php
if (isset($_POST['submit'])) {
  $title = "'" . $_POST['title'] . "'";
  $conn = new mysqli($hn, $un, $pw, $db);
  if ($conn->connect_error) die($conn->connect_error);
  $query = "SELECT * FROM `books` WHERE MATCH (title,author) AGAINST ($title IN BOOLEAN MODE)";
  $result = $conn->query($query);
  if (!$result) die ("database error: " . $conn->error);
  echo '<div><table id="search_table"><tr id="search_row"><th id="search_header">Title</th><th id="search_header">Author</th><th id="search_header">Year</th><th id="search_header">Language</th></tr>';
  while ($row = $result->fetch_assoc()) {
    echo '<tr id="search_row"><td>' . $row['title'] . "</td>";
    echo '<td id="search_data">' . $row['author'] . "</td>";
    echo '<td id="search_data">' . $row['year'] . "</td>";
    echo '<td id="search_data">' . $row['language'] . "</td></tr>";
  }
  echo "</table></div>";
}

?>
</div>
</body>
</html>
