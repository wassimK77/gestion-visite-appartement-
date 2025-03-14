<?php

  class Validator_Alnum extends Validator {
    protected array $allowedChars;
    protected bool $allowDiacritics;

    function __construct(array $allowedChars = [], bool $allowDiacritics  = true) {
      $this->allowedChars = $allowedChars;
      $this->allowDiacritics = $allowDiacritics;
    }

    public function check(mixed $value) : bool {
      if (!is_string($value)) return false;
      if ($this->allowDiacritics) $value = Util_String::removeDiacritic($value);
      $value = str_replace($this->allowedChars, '', $value);
      return ctype_alnum($value);
    }

  }