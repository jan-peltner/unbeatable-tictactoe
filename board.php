<?php
class Board
{
  private string $input_raw;
  private array $input_split;
  public array $input_parsed;

  // 0 = open
  // 1 = X (Player)
  // 2 = O (CPU)

  private array $player_cpu_map = array(
    1 => "Player",
    2 => "CPU"
  );

  public function __construct(string $input)
  {
    $this->input_raw = $input;
    $this->input_split = str_split($this->input_raw);
    $this->validate_input();
    $this->transform_input();
  }

  private function validate_input()
  {
    if (strlen($this->input_raw) != 9) {
      die("Invalid board length. Please provide a board with length = 9.");
    }
    foreach ($this->input_split as $idx => $val) {
      if ($val != "0" && $val != "1" && $val != "2") {
        die("Invalid board value at index $idx with value $val");
      }
    }
  }
  private function transform_input()
  {
    $this->input_parsed = array_map(function ($el) {
      return intval($el, 10);
    }, $this->input_split);
  }
  public function evaluate()
  {
    $res = 0;
    $res = $this->eval_rows();
    if ($res == 0) {
      $res = $this->eval_cols();
    }
    if ($res == 0) {
      $res = $this->eval_diags();
    }
    // someone has won
    if ($res > 0) {
      echo $this->player_cpu_map[$res] . " has won the game.";
      return;
    }
    // game is tied
    $found_zero = false;
    foreach ($this->input_parsed as $val) {
      if ($val == 0) {
        $found_zero = true;
      }
    }
    if (!$found_zero) {
      echo "The game is tied.";
      return;
    }
    // game still running
    echo "The game is in progress.";
  }
  private function eval_rows(): int
  {
    for ($i = 0; $i < 7; $i += 3) {
      if ($this->input_parsed[$i] == $this->input_parsed[$i + 1] && $this->input_parsed[$i + 1] == $this->input_parsed[$i + 2] && $this->input_parsed[$i] != 0) {
        return $this->input_parsed[$i];
      }
    }
    return 0;
  }
  private function eval_cols(): int
  {
    for ($i = 0; $i < 3; ++$i) {
      if ($this->input_parsed[$i] == $this->input_parsed[$i + 3] && $this->input_parsed[$i + 3] == $this->input_parsed[$i + 6] && $this->input_parsed[$i] != 0) {
        return $this->input_parsed[$i];
      }
    }
    return 0;
  }
  private function eval_diags(): int
  {
    if (
      $this->input_parsed[0] == $this->input_parsed[4] && $this->input_parsed[4] == $this->input_parsed[8] && $this->input_parsed[0] != 0 ||
      $this->input_parsed[2] == $this->input_parsed[4] && $this->input_parsed[4] == $this->input_parsed[6] && $this->input_parsed[0] != 0
    ) {
      return $this->input_parsed[4];
    }
    return 0;
  }
}
