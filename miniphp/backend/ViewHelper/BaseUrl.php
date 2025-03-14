<?php
class ViewHelper_BaseUrl extends ViewHelper {

  public function make(mixed $url, ...$values): string {
    if (!is_string($url)) throw new Exception('the url must be a string');
    if (count($values) > 1) throw new Exception('only accept 2 args: the relative URL and query parameters as an associative array');
    $params = count($values) > 0 ? $values[0] : [];

    // check that all params are string
    foreach ($params as $key => $value) {
      if (!is_string($key)) throw new Exception('Param key is not a string');
      if (!is_string($value)) throw new Exception("Param value of {$key} is not a string");
    }
    if (count($params) > 0) {
      $url .= '?'. http_build_query($params);
    }

    return Util_Registry::getConf('baseUrl') . $url;
  }

}
