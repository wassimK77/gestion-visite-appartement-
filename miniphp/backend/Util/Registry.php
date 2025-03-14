<?php
class Util_Registry {
  protected static array $data = [];

  public static function set(string $key, mixed $val) : void {
    self::$data[$key] = $val;
  }

  public static function get(string $key): mixed {
    if (!isset(self::$data[$key])) {
      throw new Exception("{$key} doesnt exists in this registry");
    }
    return self::$data[$key];
  }

  public static function getConf(string $key): mixed {
    if (!isset(self::$data['conf'])) {
      throw new Exception("conf doesnt exists in this registry");
    }
    if (!isset(self::$data['conf'][$key])) {
      throw new Exception("{$key} doesnt exists in the conf");
    }
    return self::$data['conf'][$key];
  }
  
}