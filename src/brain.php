<?php
class Brain
{
  public array $board;

  public function __construct($board)
  {
    $this->board = $board;
  }
  protected function execute_move(int $idx)
  {
    $this->board[$idx] = Move::CPU;
  }
}
class NaiveBrain extends Brain
{
  public function __construct($board)
  {
    parent::__construct($board);
  }
}
class SmartBrain extends Brain
{
  public function __construct($board)
  {
    parent::__construct($board);
  }
}
