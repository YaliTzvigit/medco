

<?php
require_once '../models/Consultation.php';

// Classe contrôleur des consultations
class ConsultationController {

    // Ajouter une consultation pour un patient
    public function ajouterConsultation($patient_id, $type_consultation, $notes) {
        $consultationModel = new Consultation();
        $consultationModel->addConsultation($patient_id, $type_consultation, $notes);
    }

    // Récupérer l'historique des consultations d'un patient
    public function getConsultationsByPatientId($patient_id) {
        $consultationModel = new Consultation();
        return $consultationModel->getConsultationsByPatientId($patient_id);
    }
}
?>

