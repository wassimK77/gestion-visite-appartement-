<?php
class Controller_Proprietaires extends Controller {

    /*
     * Formulaire de creation des proprietaires
     */
    public function newproprioAction() : string {
        $error = $this->request('error', false);
        $login = $this->request('login', '');
        return $this->view->render([
            'error' => $error,
            'login' => $login,
    ]);
}

 /*
    * Formulaire de connexion des proprietaires
    */
    public function loginProprioAction() : string {
        $error = $this->request('error', false);
        return $this->view->render([
            'error' => $error,
            $mdp = $this->request('mdp'),
            $login = $this->request('login'),
    ]);
}
    
        /*
        * Suppression d'un proprietaire
        */
        public function deleteProprioAction() : string {
            $login = $this->request('login');
            $modelProprio = new Model_Proprietaires();
            $modelProprio->delete('login');
            Util_Http::redirect('index', 'home');
            return $this->view->render();
        }
    
        /*
        * Deconnexion d'un proprietaire
        */
        public function deconnexionProprioAction() : string {
            unset($_SESSION['proprio']);
            Util_Http::redirect('index', 'home');
            return $this->view->render();
        }
    
        /*
        * Creation d'un proprietaire
        */
        public function createProprioAction() : string {
            $nom = $this->request('nom');
            $prenom = $this->request('prenom');
            $adresse = $this->request('adresse');
            $codePostal = $this->request('codePostal');
            $tel = $this->request('tel');
            $login = $this->request('login');
            $mdp = $this->request('mdp');
            
    
            $modelProprio = new Model_Proprietaires();
            if ($modelProprio->existProprio($login)) {
                return $this->view->render([
                    'error' => 'Ce login est déjà utilisé',
                    'login' => $login,
                ]);
            }
    
            $modelProprio->createProprio($nom, $prenom, $adresse, $codePostal, $tel, $login, $mdp);
            Util_Http::redirect('index', 'home');
            return $this->view->render();
        }
    
        /*
        * Connexion d'un proprietaire
        */
        public function connectProprioAction() : string {
            $login = $this->request('login');
            $mdp = $this->request('mdp');
    
            $modelProprio = new Model_Proprietaires();
            $numProp = $modelProprio->loginProprio($login, $mdp);
            if ($numProp === false) {
                return $this->view->render([
                    'error' => 'Login ou mot de passe incorrect',
                ]);
            }
    
            $_SESSION['proprio'] = $login;
            Util_Http::redirect('index', 'home');
            return $this->view->render();
        }
}