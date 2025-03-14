<?php
class ViewHelper_Escape extends ViewHelper {

  public function make(mixed $str, ...$values): string {
    if (!is_string($str)) throw new Exception('the arg must be a string');
    if (count($values) > 0) throw new Exception('only accept 1 args: the string to be escaped');
    return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
  }

}
