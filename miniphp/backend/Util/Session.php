<?php
class Util_Session {
  protected string $namespace;
  protected static string $defaultNamespace = 'DEFAULT';

  public static function init() : void {
    ini_set('session.use_cookies', '1');
    ini_set('session.use_only_cookies', '1');
    ini_set('session.use_strict_mode', '1');
    ini_set('session.use_trans_sid', '0');
    ini_set('session.sid_length', '128');
    ini_set('session.name', Util_Registry::getConf('sessionName'));
    session_set_cookie_params(Util_Registry::getConf('session'));
    session_start();
  }

  public function __construct(string $namespace = null) {
    if ($namespace === null || trim($namespace) == '') $namespace = self::$defaultNamespace;
    $this->namespace = '__' . $namespace;
  }

  public function get(string $name, mixed $default = null) : mixed {
    $realName = $this->namespace . '_' . $name;
    if (!isset($_SESSION[$realName])) $_SESSION[$realName] = $default;
    return $_SESSION[$realName];
  }

  public function has(string $name) : bool {
    $realName = $this->namespace . '_' . $name;
    return isset($_SESSION[$realName]);
  }

  public function set(string $name, mixed $value) : void {
    $realName = $this->namespace . '_' . $name;
    $_SESSION[$realName] = $value;
  }

  public function unset(string $name) : void {
    $realName = $this->namespace . '_' . $name;
    if (!$this->has($name)) return;
    unset($_SESSION[$realName]);
  }

  public static function destroy() : void {
    session_write_close();
    session_destroy();
    $params = session_get_cookie_params();
    setcookie(session_name(), '', 0, $params['path'], $params['domain'], $params['secure'], isset($params['httponly']));
  }

  public static function regenerate() : void {
    session_regenerate_id(true);
  }

}