<?php
class Model_Proprietaires extends Model {
    public string $tblName = 'proprietaires';

    public function createProprio($nom, $prenom, $adresse, $codePostal, $tel, $login, $mdp): int {
        // Chiffrement du mot de passe
        $mdp = password_hash($mdp, PASSWORD_DEFAULT);

        return $this->queryInsert("
            INSERT INTO
                `{$this->tblName}`
                (`NOM`, `PRENOM`, `ADRESSE`, `CODE_VILLE`, `TEL`, `login`, `mdp`)
            VALUES
                ('%s', '%s', '%s', '%s', '%s', '%s', '%s')
        ", [$nom, $prenom, $adresse, $codePostal, $tel, $login, $mdp]);
    }
    
    public function loginProprio(string $login, string $mdp): string {
        $res = $this->querySelectFirst("
            SELECT
                `NUMEROPROP`, `mdp`
            FROM
                `{$this->tblName}`
            WHERE
                `login` = '%s'
        ", [$login]);

        if ($res === null) {
            return false;
        }

        return password_verify($mdp, $res->mdp) ? $res->NUMEROPROP : false;
    }
    
    public function existProprio(string $login): string {
        $res = $this->querySelectFirst("
            SELECT
                `NUMEROPROP`
            FROM
                `{$this->tblName}`
            WHERE
                `login` = '%s'
        ", [$login]) !== null;
        return $res;
    }

    public function checkProprio(string $login, string $mdp): string {
        $res = $this->querySelectFirst("
            SELECT
                `NUMEROPROP`, `mdp`
            FROM
                `{$this->tblName}`
            WHERE
                `login` = '%s'
        ", [$login]);

        if ($res === null) {
            return false;
        }

        return password_verify($mdp, $res->mdp) ? $res->NUMEROPROP : false;
    }

    public function deleteProprio(string $login, string $mdp): string {
        $res = $this->querySelectFirst("
            SELECT
                `NUMEROPROP`, `mdp`
            FROM
                `{$this->tblName}`
            WHERE
                `login` = '%s'
        ", [$login]);

        if ($res === null) {
            return false;
        }

        return password_verify($mdp, $res->mdp) ? $res->NUMEROPROP : false;
    }
}