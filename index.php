<?php
if ($_GET["board"] == null) {
  die("Please provide a board param.");
}

require "board.php";
$board = new Board($_GET["board"]);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="theme-color" content="">
  <link rel="shortcut icon" href="">
  <link rel="stylesheet" href="">
  <title>Unbeatable TicTacToe</title>
</head>

<body>
  <code><?php print_r($board->input_parsed); ?></code>
</body>

</html>
