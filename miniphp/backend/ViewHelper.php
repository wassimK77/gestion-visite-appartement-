<?php

abstract class ViewHelper
{
  protected View $view;

  function __construct(View $view) {
    $this->view = $view;
  }

  public function make(mixed $first, ...$values): mixed {
    return '';
  }

}
