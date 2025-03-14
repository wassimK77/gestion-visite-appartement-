<?php
  declare(strict_types=1);
  error_reporting(E_ALL | E_STRICT);
  require_once 'config.php';
  ini_set('display_errors', $conf['displayError']);

  define('ENV', $env);

  require_once 'shortcuts.php';



  spl_autoload_register(function (string $className) : void {
    $classPath = str_replace('_', DIRECTORY_SEPARATOR, $className) . '.php';
    if (file_exists(APPLICATION_PATH . DIRECTORY_SEPARATOR . $classPath)) {
      require_once $classPath;
    } else {
      throw new Exception("Class $className not found");
    }
  });

  $requestUri = strtok($_SERVER['REQUEST_URI'], '?');
  $pos = strpos($requestUri, $conf['baseUrl']);
  if ($pos === false) throw new Exception('baseUrl not found in requestUri');
  $requestUri = substr_replace($requestUri, '', $pos, strlen($conf['baseUrl']));

  $uri = explode('/', $requestUri);
  $controllerName = $uri[0] ?? '';
  $actionName = $uri[1] ?? '';

   // connection to the database
   try {
    $sqlCon = new mysqli(...$conf['db']);
    if ($sqlCon->connect_errno) {
      throw new RuntimeException('mysqli connection error: ' . $sqlCon->connect_error);
    }
    $sqlCon->set_charset('utf8mb4');
    $sqlCon->options(MYSQLI_OPT_INT_AND_FLOAT_NATIVE, TRUE);
    Util_Registry::set(Model::DEFAULT_CONNECTOR, $sqlCon);
  } catch (Exception $e) {
    $controllerName = 'Error';
    $actionName = 'index';
  }

  $validator = new Validator_Alnum(allowedChars: ['-'], allowDiacritics: false);

  if (!$validator->check($controllerName)) {
    $controllerName = $controllerName === '' ? 'Home' : 'Error';
  }

  if (!$validator->check($actionName)) {
    $actionName = 'index';
  }

  $controllerName = Util_Route::purify($controllerName);
  $actionName = Util_Route::purify($actionName, false);
  

  $classPath = 'Controller' . DIRECTORY_SEPARATOR . $controllerName . '.php';

  if (!file_exists(APPLICATION_PATH . DIRECTORY_SEPARATOR . $classPath)) {
    $controllerName = 'Error';
    $actionName = 'index';
  }

  $className = 'Controller_' . $controllerName;
  $methodName = $actionName . 'Action';

  if (!method_exists($className, $methodName)) {
    $controllerName = 'Error';
    $className = 'Controller_Error';
    $actionName = 'index';  
    $methodName = 'indexAction';
  }

  Util_Registry::set('controller', $controllerName);
  Util_Registry::set('action', $actionName);
  Util_Registry::set('conf', $conf);


  Util_Session::init();
  Util_String::init();

  // Create the controller instance
  $controller = new $className();

  // Dispatch to action
  $response = $controller->$methodName();
  die($response);

