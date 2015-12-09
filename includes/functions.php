<?php
function sanitizeString($var)
{
	$var = stripslashes($var);
	$var = strip_tags($var);
	$var = htmlentities($var);
	return $var;
}

function sanitizeMySQL($connection, $var)
{
	$var = $connection->real_escape_string($var);
	$var = sanitizeString($var);
	return $var;
}

function rand_book_gen($number)
{
	$puzzle = [];
	for ($x = 1; $x <= $number; $x++) {
		$book_id = mt_rand(1,6);
		$conn = new mysqli('localhost', 'root', '', 'jdull');
		if ($conn->connect_error) die($conn->connect_error);
		$query = "SELECT * FROM `books` WHERE book_id=$book_id";
		$result = $conn->query($query);
		if (!$result) {
		  die ("database malfunciotn: " . $conn->error);
		} else {
			$row = $result->fetch_assoc();
			array_push($puzzle, $row);
	}
}
return $puzzle;
}

function random_gen($min, $max, $quantity) {
  $puzzle = [];
  $numbers = range($min, $max);
  shuffle($numbers);
  $books = array_slice($numbers, 0, $quantity);#array of non repeating numbers that will correspond to book_id
	// print_r($books);
  $conn = new mysqli('localhost', 'root', '', 'jdull');
  if ($conn->connect_error) die($conn->connect_error);
  $query = "SELECT * FROM `books` WHERE book_id=$books[0] OR book_id=$books[1] OR book_id=$books[2] OR book_id=$books[3] OR book_id=$books[4]";
  $result = $conn->query($query);
  if (!$result) {
    die ("database malfunction: " . $conn->error);
  } else {
    $rows = $result->num_rows;
    while ($row = $result->fetch_assoc()) {
			array_push($puzzle, $row);
    }
  } return $puzzle;
}

function handleArticles($book_array) {
  $puzzle_array = [];
  for ($i=0; $i < 5; $i++) {
    list($first,$rest) = explode(" ",$book_array[$i]['title']." ",2);
    $validarticles = array("a","an","the");
    if( in_array(strtolower($first),$validarticles)) {
      array_push($puzzle_array, $rest . ", " . $first . " By: " . $book_array[$i]['author']);
    } else {
      array_push($puzzle_array, $book_array[$i]['title']. " By: " . $book_array[$i]['author']);
    }
  }
  return $puzzle_array;
}
?>
