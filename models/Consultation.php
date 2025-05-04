

<?php
require_once '../config/db.php';

// Classe Consultation
class Consultation {

    // Ajouter une consultation dans la base de données
    public function addConsultation($patient_id, $type_consultation, $notes) {
        global $pdo; // Connexion à la base de données
        $stmt = $pdo->prepare("INSERT INTO consultations (patient_id, type_consultation, notes, date_consultation) 
                               VALUES (?, ?, ?, NOW())");
        return $stmt->execute([$patient_id, $type_consultation, $notes]);
    }

    // Récupérer toutes les consultations d'un patient
    public function getConsultationsByPatientId($patient_id) {
        global $pdo;
        $stmt = $pdo->prepare("SELECT * FROM consultations WHERE patient_id = ? ORDER BY date_consultation DESC");
        $stmt->execute([$patient_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
