<?php
if ($_GET["board"] == null) {
  die("Please provide a board param.");
}

require "src/board.php";
require "src/brain.php";

$board = new Board($_GET["board"]);
$state = $board->evaluate();
if ($state == GameState::RUNNING) {
  $naive_brain = new NaiveBrain($board->input_parsed);
  $new_board = $naive_brain->make_move();
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
  <p class="bg-blue-200">test!</p>
  <code><?php print_r($new_board); ?></code>
</body>

</html>
