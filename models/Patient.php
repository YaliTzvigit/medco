

<!-- models/Patient --> 

<?php
require_once '../config/db.php';

// Classe Patient
class Patient {

    // Récupérer tous les patients
    public function getAllPatients() {
        global $pdo; // Connexion à la base de données
        $stmt = $pdo->query("SELECT * FROM patients ORDER BY nom ASC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC); // Retourne tous les patients
    }

    // Récupérer un patient par son ID
    public function getPatientById($id) {
        global $pdo; // Connexion à la base de données
        $stmt = $pdo->prepare("SELECT * FROM patients WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC); // Retourne un patient par son ID
    }

    // Ajouter un nouveau patient
    public function addPatient($nom, $prenom, $date_naissance, $sexe, $telephone, $adresse, $groupe_sanguin) {
        global $pdo; // Connexion à la base de données
        $stmt = $pdo->prepare("INSERT INTO patients (nom, prenom, date_naissance, sexe, telephone, adresse, groupe_sanguin) 
                               VALUES (?, ?, ?, ?, ?, ?, ?)");
        return $stmt->execute([$nom, $prenom, $date_naissance, $sexe, $telephone, $adresse, $groupe_sanguin]);
    }

    // Mettre à jour les informations d'un patient
    public function updatePatient($id, $nom, $prenom, $date_naissance, $sexe, $telephone, $adresse, $groupe_sanguin) {
        global $pdo; // Connexion à la base de données
        $stmt = $pdo->prepare("UPDATE patients SET nom = ?, prenom = ?, date_naissance = ?, sexe = ?, 
                               telephone = ?, adresse = ?, groupe_sanguin = ? WHERE id = ?");
        return $stmt->execute([$nom, $prenom, $date_naissance, $sexe, $telephone, $adresse, $groupe_sanguin, $id]);
    }
}
?>
