<?php
  define('RESSOURCES_PATH', realpath(dirname(__FILE__)));
  define('APPLICATION_PATH', RESSOURCES_PATH . '/../backend');
  set_include_path(get_include_path() . PATH_SEPARATOR . APPLICATION_PATH);

  require_once 'boot.php';