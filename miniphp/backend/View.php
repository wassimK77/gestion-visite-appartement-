<?php
class View {
  const DEFAULT_TEMPLATE = 'default';

  protected string $__v_template;
  protected string $__v_body;
  protected object $__v_data;

  public function __construct(string $template = null) {
    $this->__v_template = $template ?? self::DEFAULT_TEMPLATE;
    $this->__v_data = new stdClass();
    $templatePath = 'Template' . DIRECTORY_SEPARATOR . $this->__v_template . '.phtml';
    if (!file_exists(APPLICATION_PATH . DIRECTORY_SEPARATOR . $templatePath)) {
      throw new Exception('the template file does not exist');
    }
  }

  public function render(
    array $data = [],
    string $viewName = null,
    string $controller = null,
    bool $bodyOnly = false
  ) : string {
    foreach ($data as $key => $value) {
      ///if (!is_string($key)) throw new Exception('the key var must be a string');
      $this->__v_data->$key = $value;
    }

    $controller = $controller ?? Util_Registry::get('controller');
    $viewName = $viewName ?? Util_Registry::get('action');

    $viewPath = 'View' . DIRECTORY_SEPARATOR . $controller . DIRECTORY_SEPARATOR . $viewName . '.phtml';
    if (!file_exists(APPLICATION_PATH . DIRECTORY_SEPARATOR . $viewPath)) {
      throw new Exception('the view file does not exist');
    }

    ob_start();
    try {
      include $viewPath;
    } catch (Exception $e) {
      ob_end_clean();
      throw $e;
    }

    $this->__v_body = ob_get_contents();
    ob_end_clean();
    if ($bodyOnly) return $this->__v_body;

    ob_start();
    include 'Template' . DIRECTORY_SEPARATOR . $this->__v_template . '.phtml';
    $content = ob_get_contents();
    ob_end_clean();
    return $content;
  }

  public function __call(string $helper, mixed $data): string {
    $classname = 'ViewHelper_' . ucfirst($helper);
    $helper = new $classname($this);
    return $helper->make(...$data);
  }

  public function __get(string $name): mixed {
    if (!isset($this->__v_data->$name)) throw new Exception("{$name} does not exist in the view data");
    return $this->__v_data->$name;
  }

}