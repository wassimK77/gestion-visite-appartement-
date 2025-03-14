<?php
class Controller_Maisons extends Controller {
    public function listAction() : string {
        $maisonModel = new Model_Maison();
        $maisons = $maisonModel->getMaisons();
        return $this->view->render([ 'maisons' => $maisons]);
    }
    public function detailAction() : string {
       $id = $this->request('id');
        $maisonModel = new Model_Maison();
        $maison = $maisonModel->getById($id);
        return $this->view->render([ 'maison' => $maison]);
    }
    public function demandeAction() : string {
        $id = $this->request('id');
        $maisonModel = new Model_Maison();
        $maison = $maisonModel->getById($id);
        return $this->view->render([ 'maison' => $maison]);
    }
    public function locationAction() : string {
        return $this->view->render();
    }

    public function createAction() : string {
        $RUE = $this->request('RUE');
        $ARRONDISSE = $this->request('ARRONDISSE');
        $ETAGE = $this->request('ETAGE');
        $PRIX_LOC = $this->request('PRIX_LOC');
        $PRIX_CHARG = $this->request('PRIX_CHARG');
        $PREAVIS = $this->request('PREAVIS');
        $DATE_LIBRE = $this->request('DATE_LIBRE');
        $NUMEROPROP = $this->request('NUMEROPROP');
        $JARDIN = $this->request('JARDIN');
        $SUPERFICIE = $this->request('SUPERFICIE');
        $PISCINE = $this->request('PISCINE');
        $GARAGE = $this->request('GARAGE');
        $PAYS = $this->request('PAYS');
        $VILLE = $this->request('VILLE');
        $REGION = $this->request('REGION');

        $maisonModel = new Model_Maison();
        $maisonId = $maisonModel->postMaison($RUE, $ARRONDISSE, $ETAGE, $PRIX_LOC, $PRIX_CHARG, $PREAVIS, $DATE_LIBRE, $NUMEROPROP, $JARDIN, $SUPERFICIE, $PISCINE, $GARAGE, $PAYS, $VILLE, $REGION);
        if ($maisonId === false) {
            return $this->view->render([ 'error' => 'Impossible de créer la maison']);
        } else {
            return $this->view->render([ 'maison' => $maisonId]);
        }
}
}