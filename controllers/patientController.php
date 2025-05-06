<?php

require_once '../models/Patient.php';

class PatientController {

    private $patientModel;

    public function __construct() {
        $this->patientModel = new Patient();
    }

    // Liste des patients
    public function listePatients() {
        $patients = $this->patientModel->getAllPatients();
        include '../views/patients_liste.php';
    }

    // Dossier individuel
    public function dossierPatient($id) {
        $patient = $this->patientModel->getPatientById($id);
        include '../views/dossierPatient.php';
    }

    // Formulaire d'ajout
    public function showFormAjout() {
        include '../views/ajouter_patient.php';
    }

    // Traitement ajout patient
    public function ajouterPatient($data) {
        if ($this->validerChampsAjout($data)) {
            $pin_code = $this->genererPinCode($data['nom'], $data['prenom']);
            $success = $this->patientModel->addPatient(
                $data['nom'],
                $data['prenom'],
                $data['date_naissance'],
                $data['sexe'],
                $data['telephone'],
                $data['adresse'],
                $data['groupe_sanguin'],
                $pin_code
            );
            if ($success) {
                $_SESSION['message'] = "Patient enregistré avec le code PIN : " . htmlspecialchars($pin_code);
            } else {
                $_SESSION['erreur'] = "Erreur lors de l'enregistrement du patient.";
            }
            header('Location: ../views/patients_liste.php');
            exit;
        } else {
            $_SESSION['erreur'] = "Veuillez remplir tous les champs obligatoires.";
            header('Location: ' . $_SERVER['HTTP_REFERER']); // Retour au formulaire
            exit;
        }
    }

    public function showFormEdit($id) {
        $patientModel = new Patient();
        $patient = $patientModel->getPatientById($id);
        include '../views/modifier_patient.php';
    }
    // Traitement modification
    public function modifierPatient($id, $data) {
        if ($this->validerChampsModification($data)) {
            $this->patientModel->updatePatient(
                $id,
                $data['nom'],
                $data['prenom'],
                $data['date_naissance'],
                $data['sexe'],
                $data['telephone'],
                $data['adresse'],
                $data['groupe_sanguin']
            );
            $_SESSION['message'] = "Informations du patient mises à jour.";
            header('Location: ../views/patients_liste.php');
            exit;
        } else {
            $_SESSION['erreur'] = "Veuillez remplir tous les champs.";
            header('Location: ' . $_SERVER['HTTP_REFERER']); // Retour au formulaire
            exit;
        }
    }

    // Suppression d'un patient
    public function supprimerPatient($id) {
        $success = $this->patientModel->supprimerPatient($id);
        if ($success) {
            $_SESSION['message'] = "Patient supprimé avec succès.";
        } else {
            $_SESSION['erreur'] = "Erreur lors de la suppression du patient.";
        }
        header('Location: ../views/dashboard_accueil.php');
        exit;
    }

    // Méthode pour déterminer quelle action effectuer
    public function handleRequest() {
        session_start(); // Démarrez la session ici pour les messages flash

        if (isset($_GET['action']) && $_GET['action'] === 'supprimer' && isset($_GET['id'])) {
            $this->supprimerPatient($_GET['id']);
        } elseif (isset($_GET['action']) && $_GET['action'] === 'modifier' && isset($_GET['id'])) {
            $this->showFormEdit($_GET['id']);
        } elseif ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['ajouter_patient'])) {
            $this->ajouterPatient($_POST);
        } elseif ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['modifier_patient'])) {
            if (isset($_GET['id'])) {
                $this->modifierPatient($_GET['id'], $_POST);
            } else {
                $_SESSION['erreur'] = "ID du patient manquant pour la modification.";
                header('Location: ../views/patients_liste.php');
                exit;
            }
        } else {
            // Action par défaut (par exemple, afficher la liste des patients)
            $this->listePatients();
        }
    }

    // Vérifie que tous les champs pour l'ajout sont présents
    private function validerChampsAjout($data) {
        return isset($data['nom'], $data['prenom'], $data['date_naissance'], $data['sexe'], $data['telephone'], $data['adresse'], $data['groupe_sanguin']);
    }

    // Vérifie que tous les champs pour la modification sont présents
    private function validerChampsModification($data) {
        return isset($data['nom'], $data['prenom'], $data['date_naissance'], $data['sexe'], $data['telephone'], $data['adresse'], $data['groupe_sanguin']);
    }

    // Code PIN pour le patient
    private function genererPinCode($nom, $prenom) {
        $initiale_nom = strtoupper(substr($nom, 0, 1));
        return $initiale_nom . mt_rand(100, 999);
    }
}

$controller = new PatientController();
$controller->handleRequest();

?>