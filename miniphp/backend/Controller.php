<?php

abstract class Controller {
  protected View $view;

  public function __construct() {
    $this->view = new View();
    $this->preDispatch();
  }

  public function preDispatch() : void {
    // To override
  }

  public function request(string $name, mixed $default = null) : mixed {
    return Util_Http::request($name, $default);
  }

}