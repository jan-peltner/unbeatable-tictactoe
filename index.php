<?php
if ($_GET["board"] == null) {
  die("Please provide a board param.");
}

require "src/php/classes/board.php";
require "src/php/classes/brain.php";

$board_obj = new Board($_GET["board"]);

// evaluate move made by player
$state = $board_obj->evaluate();
if ($state == GameState::RUNNING) {
  $naive_brain = new NaiveBrain($board_obj->input_parsed);
  $board_ser = $naive_brain->make_move();
  $board_obj = new Board($board_ser);
  // evaluate move made by CPU 
  $state = $board_obj->evaluate();
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
      require "src/php/components/cpuw.php";
      break;
    case GameState::PLAYERW:
      require "src/php/components/playerw.php";
      break;
    case GameState::TIED:
      require "src/php/components/tied.php";
      break;
    default:
      // running -> render board view
      require "src/php/components/boardview.php";
      break;
  }
  ?>
</body>

</html>
