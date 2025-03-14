<?php
  $env = 'dev'; // must be 'dev', 'prod'

  $baseConf = [
    'displayError' => '0',
    'baseUrl' => '/',
    'db' => [
      'hostname' => '127.0.0.1',
      'username' => 'root',
      'password' => 'W.Kaouachi77',
      'database' => 'location',
    ],
    'sessionName' => 'username',
  ];
  $baseConf['session'] = [
    'lifetime' => '0',
    'path' => $baseConf['baseUrl'],
    'secure' => true,
    'httponly' => true,
    'samesite' => 'Strict',
  ];

  $prod = [
    'baseUrl' => '127.0.0.1',
    'baseUrl' => '/',
    'db' => [
      'hostname' => 'localhost',
      'username' => 'root',
      'password' => 'W.Kaouachi77',
      'database' => 'location',
    ],
  ];

  $dev = [
    'displayError' => '1',
  ];

  $conf = array_merge($baseConf, $$env);
  if ($env === 'dev') $conf['session']['secure'] = false;