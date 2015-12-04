<?php

session_start();

require_once 'includes/login.php';
require_once 'includes/functions.php';

if (isset($_POST['submit'])) {
  if (!isset($_POST['option'])) {
    $message = '<p class="error">Please fill out all of the form fields!</p>';
  } else {
    $user_answer = $_POST['four'];
    $correct_answer = $_POST['correct_answer'];
    echo $user_answer . " vs. " . $correct_answer;
  } }

    // if ($_POST['option'] == $_POST['answer']){
    //   $message = $_POST['option'] . " was correct " . $_POST['answer'];
    //   $score = ($_POST['score_one'] + 100);
    //   echo "<br>your score is " . $score;
    // } else {
    //   $message = "wrong<br>";
    //   $score = $_POST['score_one'];
    //   echo "<br>your score is " . $score;


include_once 'includes/header.php';
if (isset($message)) echo $message;
