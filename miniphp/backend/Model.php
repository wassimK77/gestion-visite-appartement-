<?php

abstract class Model {
  public const DEFAULT_CONNECTOR = 'dbConn';

  public string $tblName;
  protected mysqli $dbCon;

  public function __construct(string $conName = null) {
    $conName = $conName ?? self::DEFAULT_CONNECTOR;
    $this->dbCon = Util_Registry::get($conName);
  }

  public function query(string $sql, array $params = []): mysqli_result | bool {
    $res = $this->dbCon->query(vsprintf($sql, array_map(function ($item) {
      return $this->dbCon->real_escape_string($item);
    }, $params)));
    if (!$res) throw new Exception('Query error: ' . $this->dbCon->error);
    return $res;
  }

  public function querySelect(string $sql, array $params = []): array {
    $res = $this->query($sql, $params);
    $data = [];
    while ($row = mysqli_fetch_object($res)) $data[] = $row;
    return $data;
  }

  public function querySelectFirst(string $sql, array $params = []): object | null {
    $res = $this->querySelect($sql, $params);
    if (!isset($res[0])) return null;
    return $res[0];
  }

  public function queryInsert(string $sql, array $params = []): int | bool {
    $res = $this->query($sql, $params);
    if ($res === false) return false;
    return $this->dbCon->insert_id;
  }

  protected function queryDelete(string $sql, array $params): bool {
    $stmt = $this->dbCon->prepare($sql);
    return $stmt->execute($params);
  }
}
?>