<?php

class Model_Appartements extends Model {
    public string $tblName = 'appartements';

    public function getAppartements (): array {
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
        `NUMAPPART` = '%s'
    ", [$id]);
    return $res;
  }
  public function postAppartement(string $RUE, string $ARRONDISSE, int $ETAGE, string $PRIX_LOC, string $PRIX_CHARG, int $ASCENSEUR, int $PREAVIS, string $DATE_LIBRE, int $NUMEROPROP, string $PAYS, string $VILLE, string $REGION): int | bool {
    return $this->queryInsert("
      INSERT INTO
        `{$this->tblName}`
        (`RUE`, `ARRONDISSE`, `ETAGE`, `PRIX_LOC`, `PRIX_CHARG`, `ASCENSEUR`, `PREAVIS`, `DATE_LIBRE`, `NUMEROPROP`, `PAYS`, `VILLE`, `REGION` )
      VALUES
        ('%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s' )
    ", [$RUE, $ARRONDISSE, $ETAGE, $PRIX_LOC, $PRIX_CHARG, $ASCENSEUR, $PREAVIS, $DATE_LIBRE, $NUMEROPROP, $PAYS, $VILLE, $REGION]);
  }
  public function demandeAppartement(int $NUMAPPART, int $NUMCLI, string $DATEDEMANDE, string $TYPEDEMANDE): int | bool {
    return $this->queryInsert("
      INSERT INTO
        `demande`
        (`NUMAPPART`, `NUMCLI`, `DATEDEMANDE`, `TYPEDEMANDE`)
      VALUES
        ('%s', '%s', '%s', '%s')
    ", [$NUMAPPART, $NUMCLI, $DATEDEMANDE, $TYPEDEMANDE]);
  }
}
