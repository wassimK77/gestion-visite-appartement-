<?php
class Model_Cache extends Model {
  public string $tblName = 'Memorix_Cache';

  public function insert(string $key, mixed $data, int $lifetime): int {
    $cache = serialize($data);
    $utime = time();
    return $this->queryInsert("
      INSERT INTO
        `{$this->tblName}`
        (`key`, `data`, `utime`, `mtime`, `lifetime`)
      VALUES
        ('%s', '%s', %s, NOW(), %s)
    ", [$key, $cache, $utime, $lifetime]);
  }

  public function get(string $key): mixed {
    $res = $this->querySelectFirst("
      SELECT
        `data`
      FROM
        `{$this->tblName}`
      WHERE
        `key` = '%s'
      ORDER BY
        `mtime` DESC
    ", [$key]);
    if ($res === null) return null;
    return unserialize($res->data);
  }

  public function remove(string $key): void {
    $this->query("
      DELETE FROM
        `{$this->tblName}`
      WHERE
        `key` = '%s'
    ", [$key]);
  }

  public function clearOld(): void {
    $this->query("
      DELETE FROM
        `{$this->tblName}`
      WHERE
        `mtime` < NOW() - INTERVAL `lifetime` SECOND
    ");
  }

  public function clear(): int {
    return $this->query("TRUNCATE TABLE `{$this->tblName}`");
  }

}