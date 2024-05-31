<?php
interface MakeMove
{
  public function make_move(): string;
}

class Brain
{
  public array $board;

  public function __construct(array $board)
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
  public function __construct(array $board)
  {
    parent::__construct($board);
  }
  public function make_move(): string
  {
    $empty_spaces = array();

    foreach ($this->board as $k => $v) {
      if ($v == 0) {
        array_push($empty_spaces, $k);
      }
    };
    $move_idx = $empty_spaces[rand(0, count($empty_spaces) - 1)];
    $this->execute_move($move_idx);
    return implode($this->board);
  }
}

class SmartBrain extends Brain implements MakeMove
{
  public int $computed_boards;
  private int $move_val_buf;
  public function __construct(array $board)
  {
    parent::__construct($board);
    $this->move_val_buf = 0;
    $this->computed_boards = 0;
  }
  private function backtrack(string $cur, bool $is_cpu_turn, int $move_val, array $weights = [5, 1, -1])
  // This function recursively computes every board and adds the points ($weights) associated with the outcome (Win, Tie, Loss) to $this->move_val_buf 
  {
    $board = new Board($cur);
    $state = $board->evaluate();
    // base case
    if ($state != GameState::RUNNING) {
      ++$this->computed_boards;
      if ($state == GameState::CPUW) {
        return $this->move_val_buf += $move_val + $weights[0];
      } elseif ($state == GameState::TIED) {
        return $this->move_val_buf += $move_val + $weights[1];
      } else {
        return $this->move_val_buf += $move_val + $weights[2];
      }
    }
    // recurse
    foreach (str_split($cur) as $i => $v) {
      if ($v != 0) {
        continue;
      }
      $new = $cur;
      $new[$i] = $is_cpu_turn ? 2 : 1;
      $this->backtrack($new, !$is_cpu_turn, $move_val, $weights);
    }
  }
  private function pick_move(array $options): int
  {

    // brain chooses the nth AVAILABLE move on the board
    $n = array_search(max($options), $options);
    // find nth occurence of 0 on the board and reutrn that index
    $matching_indices = array_keys($this->board, 0);
    return $matching_indices[$n];
  }
  public function make_move(): string
  {
    // evaluated moves are pushed into $moves_list
    $moves_list = array();

    // evaluation algorithm
    foreach ($this->board as $i => $v) {
      // cell is occupied
      if ($v != 0) {
        continue;
      }
      $this->move_val_buf = 0;
      $new = $this->board;
      $new[$i] = 2;
      $this->backtrack(implode($new), true, 0, [10, 2, -100]);
      array_push($moves_list, $this->move_val_buf);
    }
    $move_idx = $this->pick_move($moves_list);
    $this->execute_move($move_idx);
    return implode($this->board);
  }
}
