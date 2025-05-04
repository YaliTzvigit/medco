

<?php
require_once '../models/Patient.php';

// Classe contrôleur des patients
class PatientController {

    // Afficher la liste des patients
    public function listePatients() {
        $patientModel = new Patient();
        $patients = $patientModel->getAllPatients(); // Récupérer tous les patients
        include '../views/patients_liste.php'; // Afficher la vue
    }

    // Afficher le dossier d'un patient
    public function dossierPatient($id) {
        $patientModel = new Patient();
        $patient = $patientModel->getPatientById($id); 
        include '../views/dossierPatient.php'; 
    }
}
?>
