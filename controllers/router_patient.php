

<!-- Router patient vers --> 

<?php
require_once 'patientController.php';

$controller = new PatientController();

$action = $_GET['action'] ?? '';
$id = $_GET['id'] ?? null;

switch ($action) {
    case 'ajouter':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $controller->ajouterPatient($_POST);
        } else {
            $controller->showFormAjout();
        }
        break;

    case 'modifier':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $controller->modifierPatient($id, $_POST);
        } else {
            $controller->showFormEdit($id);
        }
        break;

    case 'supprimer':
        $controller->deletePatient($id);
        break;

    case 'voir':
        $controller->dossierPatient($id);
        break;

    default:
        $controller->listePatients();
        break;
}
