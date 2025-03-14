<?php 

class Controller_Appartements extends Controller {
    public function listAction() : string {
        $appartementsModel = new Model_Appartements();
        $appartements = $appartementsModel->getAppartements();
        return $this->view->render([ 'appartements' => $appartements]);
    }

    public function detailAction() : string {
        $id = $this->request('id');
        $appartementsModel = new Model_Appartements();
        $appartement = $appartementsModel->getById($id);
        return $this->view->render([ 'appartement' => $appartement]);
    }

    public function demandeAction() : string {
        $id = $this->request('id');
        $appartementsModel = new Model_Appartements();
        $appartement = $appartementsModel->getById($id);
        return $this->view->render([ 'appartement' => $appartement]);
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
        $ASCENSEUR = $this->request('ASCENSEUR');
        $PREAVIS = $this->request('PREAVIS');
        $DATE_LIBRE = $this->request('DATE_LIBRE');
        $NUMEROPROP = $this->request('NUMEROPROP');
        $PAYS = $this->request('PAYS');
        $VILLE = $this->request('VILLE');
        $REGION = $this->request('REGION');

        $appartementsModel = new Model_Appartements();
        $appartId = $appartementsModel->postAppartement($RUE, $ARRONDISSE, $ETAGE, $PRIX_LOC, $PRIX_CHARG, $ASCENSEUR, $PREAVIS, $DATE_LIBRE, $NUMEROPROP, $PAYS, $VILLE, $REGION);
        if ($appartId === false) {
            return $this->view->render([ 'error' => 'Impossible de créer l\'appartement']);
        } else {
            return $this->view->render([ 'appartement' => $appartId]);
        }
    }
}