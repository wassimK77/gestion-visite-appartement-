<?php

  class Filter_Alnum extends Filter {
    protected array $allowedChars;
    protected bool $allowDiacritics;

    function __construct(array $allowedChars = [], bool $allowDiacritics  = true) {
      $this->allowedChars = $allowedChars;
      $this->allowDiacritics = $allowDiacritics;
    }

    public function filter(mixed $value): string {
      if (!is_string($value)) return '';
      if (!$this->allowDiacritics) $value = Util_String::removeDiacritic($value);
      $allowCharRegex = preg_quote(implode('', $this->allowedChars), '/');
      $value = preg_replace("/[^[:alnum:]{$allowCharRegex}]/u", '', $value);
      return $value;
    }

  }