<?php
class Controller_Error extends Controller {

  public function indexAction() : string {
    // if ($this->isAjax) {
    //   http_response_code(404);
    //   return json_encode(['error' => 'Not found']);
    // }
    return $this->view->render();
  }

}