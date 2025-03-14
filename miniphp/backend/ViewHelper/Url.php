<?php
class ViewHelper_Url extends ViewHelper {

  public function make(mixed $action, ...$values): string {
    if (!is_string($action)) throw new Exception('the action must be a string');
    if (count($values) > 2) throw new Exception('only accept 3 args: the action name and the optional controller name and query parameters as an associative array');
    if (count($values) > 0 && !is_string($values[0])) throw new Exception('the controller must be a string');
    if (count($values) > 1 && !is_array($values[1])) throw new Exception('the query parameters must be an associative array');

    $controller = count($values) > 0 ? $values[0] : Util_Registry::get('controller');
    $params = count($values) > 1 ? $values[1] : [];

    return Util_Route::url($action, $controller, $params);
  }

}
