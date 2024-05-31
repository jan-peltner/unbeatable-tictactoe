<?php
if ($_GET["board"] == null) {
  $redirect_path = "/tictactoe?board=000000000";
  header("location: $redirect_path", false, 301);
}

require "src/php/classes/board.php";
require "src/php/classes/brain.php";

$board_obj = new Board($_GET["board"]);

// evaluate move made by player
$state = $board_obj->evaluate();

// only construct a CPU brain and let it make a move if the game is running and we don't have an empty board state
if (array_sum($board_obj->input_parsed) != 0 && $state == GameState::RUNNING) {
  $brain = new SmartBrain($board_obj->input_parsed);
  $board_ser = $brain->make_move();
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
  <script defer src="src/js/vendor/alpine.js"></script>
  <script src="src/js/data.js"></script>
</head>

<body class="h-screen flex flex-col justify-center items-center gap-4 bg-gray-300 text-indigo-500">
  <?php
  if (array_sum($board_obj->input_parsed) != 0 && $state == GameState::RUNNING) {
    $computed_boards_msg = "Computed " . $brain->computed_boards .  " boards";
    echo "<p>$computed_boards_msg</p>";
  }
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
  </div>
</body>

</html>
