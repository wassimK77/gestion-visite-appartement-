<?php
class Util_Route {

  public static function url(string $actionName, string $controllerName = null, array $values = []) : string {
    $controllerName ??= Util_Registry::get('controller');
    $controller = self::purify($controllerName);
    $action = self::purify($actionName, false);
    $className = 'Controller_' . $controller;
    $methodName = $action . 'Action';
    if (!method_exists($className, $methodName)) throw new Exception('the action does not exist');

    // put - instead of uppercase letters in url

    $urlPart = strtolower(preg_replace('/([A-Z])/', '-$1', lcfirst($controllerName) . '/' . $actionName));
    $urlFinal = Util_Registry::getConf('baseUrl') . $urlPart;

    // check that all params are string
    foreach ($values as $key => $value) {
      if (!is_string($key)) throw new Exception('Param key is not a string');
      if (!is_string($value)) throw new Exception("Param value of {$key} is not a string");
    }
    if (count($values) > 0) $urlFinal .= '?' . http_build_query($values);

    return $urlFinal;
  }

  public static function purify(string $actionOrControllerName, bool $controllerName = true) : string {
    $purified = '';
    foreach (explode('-', $actionOrControllerName) as $part) {
      $purified .= ucfirst(strtolower($part));
    }
    return $controllerName ? ucfirst($purified) : lcfirst($purified);
  }

}