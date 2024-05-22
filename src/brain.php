<?php
interface MakeMove
{
  public function make_move(): array;
}

class Brain
{
  public array $board;

  public function __construct($board)
  {
    $this->board = $board;
  }
  protected function execute_move(int $idx)
  {
    $this->board[$idx] = Move::CPU->value;
  }
}

class NaiveBrain extends Brain implements MakeMove
{
  public function __construct($board)
  {
    parent::__construct($board);
  }
  public function make_move(): array
  {
    $empty_spaces = array();

    foreach ($this->board as $k => $v) {
      if ($v == 0) {
        array_push($empty_spaces, $k);
      }
    };
    $move_idx = $empty_spaces[rand(0, count($empty_spaces) - 1)];
    $this->execute_move($move_idx);
    return $this->board;
  }
}

class SmartBrain extends Brain implements MakeMove
{
  public function __construct($board)
  {
    parent::__construct($board);
  }
  public function make_move(): array
  {
    return array();
  }
}
