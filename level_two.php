<?php

session_start();

require_once 'includes/login.php';
require_once 'includes/functions.php';

// $puzzle_two = rand_book_gen(5);
// print_r($puzzle_two);

$books = random_gen(1,6,5); #multidimensional array with book information
print_r($books);

?>
