<?php

function dd(mixed $first, ...$data): void {
  echo '<pre>';
  var_dump($first);
  foreach ($data as $d) var_dump($d);
  echo '</pre>';
  die();
}

function ddp(mixed $first, ...$data): void {
  print_r($first);
  foreach ($data as $d) print_r($d);
  die();
}

function ddj(mixed $data): void {
  Util_Http::jsonAndDie($data);
}

function conf(string $key): mixed {
  return Util_Registry::getConf($key);
}