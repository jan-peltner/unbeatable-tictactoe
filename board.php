<?php
class Board
// 0 = open
// 1 = X (Player)
// 2 = = (CPU)
{
  private string $input_raw;
  private array $input_split;
  public array $input_parsed;
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
}
