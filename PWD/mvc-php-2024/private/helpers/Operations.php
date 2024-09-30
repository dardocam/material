<?php

/**
 *
 */
class Operations
{

  function __construct()
  {
    // code...
  }
  public function sum(int $n1, int $n2)
  {
    if ($n1 == null || $n2 == null) throw new InvalidArgumentException('El valor no puede ser nulo');
    return $n1 + $n2;
  }
}
