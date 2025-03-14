<?php
class Util_Hmac {
  protected string $key;
  protected string $algo;
  protected string $glue;

  public function __construct(string $key, string $algo = 'sha256', string $glue = '-§-') {
    $this->key = $key;
    $this->algo = $algo;
    $this->glue = $glue;
  }

  public function gen(...$values) : string {
    foreach ($values as $value) {
      if (!is_string($value)) throw new Exception('the value must be strings');
    }
    $data = implode($this->glue, $values);
    return hash_hmac($this->algo, $data, $this->key);
  }

  public function check(string $hash, ...$values) : bool {
    return hash_equals($this->gen(...$values), $hash);
  }

}