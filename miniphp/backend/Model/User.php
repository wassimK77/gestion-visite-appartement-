<?php
class Model_User extends Model {
  public string $tblName = 'clients';

  public function create($nom, $prenom, $adresse, $codePostal, $tel, $login, $mdp): int {
    // Chiffrement du mot de passe
    $mdp = password_hash($mdp, PASSWORD_DEFAULT);

    return $this->queryInsert("
      INSERT INTO
        `{$this->tblName}`
        (`NOM_CLI`, `PRENOM_CLI`, `ADRESSE_CLI`, `CODEVILLE_CLI`, `TEL_CLI`, `login`, `mdp`)
      VALUES
        ('%s', '%s', '%s', '%s', '%s', '%s', '%s')
    ", [$nom, $prenom, $adresse, $codePostal, $tel, $login, $mdp]);
  }

  public function login(string $login, string $mdp): string {
    $res = $this->querySelectFirst("
      SELECT
        `NUM_CLI`, `mdp`
      FROM
        `{$this->tblName}`
      WHERE
        `login` = '%s'
    ", [$login]);

    if ($res === null) {
      return false;
    }

    return password_verify($mdp, $res['mdp']) ? $res['NUM_CLI'] : false;
  }

  public function exist(string $login): bool {
    $res = $this->querySelectFirst("
      SELECT
        `NUM_CLI`
      FROM
        `{$this->tblName}`
      WHERE
        `login` = '%s'
    ", [$login]) !== null;
    return $res;
  }

  public function check(string $login, string $mdp): string {
    $res = $this->querySelectFirst("
      SELECT
        `NUM_CLI`, `mdp`
      FROM
        `{$this->tblName}`
      WHERE
        `login` = '%s'
    ", [$login]);

    if ($res === null) {
      return false;
    }

    return password_verify($mdp, $res->mdp) ? $res->NUM_CLI : false;
  }

  // Fonction pour supprimer un utilisateur
  public function delete(int $numCli): bool {
    $sql = "
      DELETE FROM `{$this->tblName}`
      WHERE `NUM_CLI` = ?
    ";
    return $this->queryDelete($sql, [$numCli]);
  }
}
?>