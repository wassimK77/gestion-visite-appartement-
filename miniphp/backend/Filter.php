<?php

abstract class Filter {

  public function filter(mixed $value) : mixed {
    return false;
  }

}