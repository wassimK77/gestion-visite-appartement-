<?php
class Util_String {

  private static Collator $collator;
  private static string $locale;

  public static function init(string $locale = 'FR_fr'): void {
    self::setGlobalLocale($locale);
    self::$collator = new Collator(self::$locale);
  }

  public static function setGlobalLocale(string $locale = 'FR_fr'): void {
    self::$locale = $locale;
    setlocale(LC_COLLATE, self::$locale . '.UTF8');
    setlocale(LC_CTYPE, self::$locale . '.UTF8');
  }

  public static function normalize(string $str): string {
    return normalizer_normalize($str, Normalizer::FORM_D);
  }

  public static function compare(string $str1, string $str2, int $strength = Collator::PRIMARY, bool $caseSensitive = false): int | bool {
    self::$collator->setStrength($strength);
    self::$collator->setAttribute(Collator::CASE_LEVEL, $caseSensitive ? Collator::ON : Collator::OFF);
    return self::$collator->compare($str1, $str2);
  }

  public static function isEqual(string $str1, string $str2, int $strength = Collator::PRIMARY, bool $caseSensitive = false): int | bool {
    return self::compare($str1, $str2, $strength, $caseSensitive) === 0;
  }

  public static function removeDiacritic(string $str): string{
    $str = self::normalize($str);
    return preg_replace('/\p{Mn}/u', '', $str);
  }

}