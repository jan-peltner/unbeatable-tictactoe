<?php
if ($_GET["board"] == null) {
  die("Please provide a board param.");
}

require "src/php/classes/board.php";
require "src/php/classes/brain.php";

$board = new Board($_GET["board"]);

// evaluate move made by player
$state = $board->evaluate();
if ($state == GameState::RUNNING) {
  $naive_brain = new NaiveBrain($board->input_parsed);
  $board = $naive_brain->make_move();
  // evaluate move made by CPU 
  $state = (new Board($board))->evaluate();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="theme-color" content="">
  <link rel="shortcut icon" href="">
  <link rel="stylesheet" href="src/css/main.min.css">
  <title>Unbeatable TicTacToe</title>
</head>

<body>
  <?php
  switch ($state) {
    case GameState::CPUW:
      break;
    case GameState::PLAYERW:
      break;
    case GameState::TIED:
      break;
    default:
  }
  ?>
</body>

</html>
