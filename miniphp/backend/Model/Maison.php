<?php
class Model_Maison extends Model {
    public string $tblName = 'maison';

    public function getMaisons (): array {
        $res = $this->querySelect("
            SELECT
                *
            FROM
                `{$this->tblName}`
        ");

        if ($res === null) {
            return [];
        }

        return $res;
    }
    
  public function getById(int $id): object | null{
    $res = $this->querySelectFirst("
      SELECT
        *
      FROM
        `{$this->tblName}`
      WHERE
        `NUM_MAISON` = '%s'
    ", [$id]);
    return $res;
  }
  public function postMaison(string $RUE, string $ARRONDISSE, int $ETAGE, string $PRIX_LOC, string $PRIX_CHARG, int $PREAVIS, string $DATE_LIBRE, int $NUMEROPROP, int $JARDIN, int $SUPERFICIE, int $PISCINE, int $GARAGE, string $PAYS, string $VILLE, string $REGION): int | bool {
    return $this->queryInsert("
      INSERT INTO
        `{$this->tblName}`
        (`RUE`, `ARRONDISSE`, `ETAGE`, `PRIX_LOC`, `PRIX_CHARG`,`PREAVIS`, `DATE_LIBRE`, `NUMEROPROP`, `JARDIN`, `SUPERFICIE`, `PISCINE`, `GARAGE`, `PAYS`, `VILLE`, `REGION`)
      VALUES
        ('%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s')
    ", [$RUE, $ARRONDISSE, $ETAGE, $PRIX_LOC, $PRIX_CHARG, $PREAVIS, $DATE_LIBRE, $NUMEROPROP, $JARDIN, $SUPERFICIE, $PISCINE, $GARAGE, $PAYS, $VILLE, $REGION]);
}
}