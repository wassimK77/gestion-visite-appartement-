<?php
class Util_Time {

  public static function now(bool $getMicrotime = false) : string {
    return $getMicrotime ? intval(microtime(true) * 1000) : time();
  }

}