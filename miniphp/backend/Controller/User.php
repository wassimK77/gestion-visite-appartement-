<?php
class Controller_User extends Controller {

  /*
   * Formulaire de creation des utilisateurs
   */
  public function newAction() : string {
    $error = $this->request('error', false);
    $login = $this->request('login', '');
    return $this->view->render([
      'error' => $error,
      'login' => $login,
    ]);
  }

  /*
   * Formulaire de connexion des utilisateurs
   */
  public function loginAction() : string {
    $error = $this->request('error', false);
    return $this->view->render([
        'error' => $error,
        'mdp' => $this->request('mdp'),
        'login' => $this->request('login'),
    ]); 
  }

  /*
   * Deconnexion d'un utilisateur
   */
  public function deconnexionAction() : string {
    unset($_SESSION['user']);
    unset($_SESSION['user_id']);
    Util_Http::redirect('index', 'home');
    return $this->view->render();
  }

  /*
   * Creation d'un utilisateur
   */
  public function createAction() : string {
    $nom = $this->request('nom');
    $prenom = $this->request('prenom');
    $adresse = $this->request('adresse');
    $codePostal = $this->request('codePostal');
    $tel = $this->request('tel');
    $login = $this->request('login');
    $mdp = $this->request('mdp');
    
    $modelUser = new Model_User();
    if ($modelUser->exist($login)) {
      Util_Http::redirect(action: 'new', values: [
        'error' => 'login',
        'login' => $login,
      ]);
    } else {
      // Insertion des données dans la base de données
      $modelUser->create($nom, $prenom, $adresse, $codePostal, $tel, $login, $mdp);
      // Redirection vers une autre page après l'insertion
      Util_Http::redirect('index', 'home');
    }
  }

  /*
   * Vérification des informations de connexion
   */
  public function checkAction() : string {
    $login = $this->request('login');
    $mdp = $this->request('mdp');

    $userModel = new Model_User();
    $userId = $userModel->check($login, $mdp);

    if ($userId) {
      $_SESSION['user'] = $login;
      $_SESSION['user_id'] = $userId;
      Util_Http::redirect('index', 'home');
    }
    Util_Http::redirect('login', 'user', [
      'error' => 'true',
    ]);    
  }

  /*
   * Suppression d'un compte utilisateur
   */
  public function deleteAccountAction() {
    if (isset($_SESSION['user_id'])) {
        $userId = (int)$_SESSION['user_id']; // Convertir 'user_id' en entier
        $userModel = new Model_User();
        $userModel->delete($userId);
        session_destroy(); // Détruire la session après la suppression du compte
        header('Location: ' . Util_Route::url('index', 'Home')); // Rediriger vers la page d'accueil
        exit();
    } else {
        header('Location: ' . Util_Route::url('login', 'User')); // Rediriger vers la page de connexion si l'utilisateur n'est pas connecté
        exit();
    }
  }
}