<?php
class ViewHelper_SubView extends ViewHelper {

  public function make(mixed $action, ...$values): string {
    if (!is_string($action)) throw new Exception('the action must be a string');
    if (count($values) > 2) throw new Exception('only accept 3 args: the view name and the data as an array for the view, and an optional controller name');

    $data = (array)$this->view->__v_data;
    if (count($values) > 0) {
      if (!is_array($values[0])) throw new Exception('the data must be an array of key => value');
      $data = $values[0];
    }

    if (count($values) > 1) {
      if (!is_string($values[1])) throw new Exception('the controller name must be a string');
      $controller = Util_Route::purify($values[1]);
    } else {
      $controller = Util_Registry::get('controller');
    }

    return (new View(useQuasar: $this->view->__v_useQuasar))->render(
      data: $data,
      viewName: $action,
      controller: $controller,
      bodyOnly: true
    );
  }

}