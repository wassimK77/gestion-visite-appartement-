<?php
class Util_Http {

  public static function request(string $name, mixed $default = null) : mixed {
    return $_REQUEST[$name] ?? $default;
  }

  public static function jsonAndDie(mixed $data, int $statusCode = 200) : void {
    http_response_code($statusCode);
    header('Content-Type: application/json');
    die(json_encode($data));
  }

  public static function redirect(string $action, string $controller = null, array $values = []) : void {
    header('Location: ' . Util_Route::url($action, $controller, $values));
    die();
  }

}