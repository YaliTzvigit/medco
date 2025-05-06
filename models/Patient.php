<?php

require_once '../config/db.php'; // Inclusion en haut du modèle

class Patient {

    public function getAllPatients() {
        global $pdo; // Rendre $pdo accessible ici
        $stmt = $pdo->query("SELECT * FROM patients ORDER BY nom ASC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getPatientById($id) {
        global $pdo; // Rendre $pdo accessible ici
        $stmt = $pdo->prepare("SELECT * FROM patients WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function addPatient($nom, $prenom, $date_naissance, $sexe, $telephone, $adresse, $groupe_sanguin, $pin_code = null) {
        global $pdo; // Rendre $pdo accessible ici
        $sql = "INSERT INTO patients (nom, prenom, date_naissance, sexe, telephone, adresse, groupe_sanguin";
        $params = [$nom, $prenom, $date_naissance, $sexe, $telephone, $adresse, $groupe_sanguin];
        if ($pin_code !== null) {
            $sql .= ", pin_code";
            $params[] = $pin_code;
        }
        $sql .= ") VALUES (" . implode(', ', array_fill(0, count($params), '?')) . ")";
        $stmt = $pdo->prepare($sql);
        return $stmt->execute($params);
    }

    public function updatePatient($id, $nom, $prenom, $date_naissance, $sexe, $telephone, $adresse, $groupe_sanguin) {
        global $pdo; // Rendre $pdo accessible ici
        $stmt = $pdo->prepare("UPDATE patients SET nom = ?, prenom = ?, date_naissance = ?, sexe = ?,
                                    telephone = ?, adresse = ?, groupe_sanguin = ? WHERE id = ?");
        return $stmt->execute([$nom, $prenom, $date_naissance, $sexe, $telephone, $adresse, $groupe_sanguin, $id]);
    }

    public function supprimerPatient($id) {
        global $pdo; // Rendre $pdo accessible ici
        $stmt = $pdo->prepare("DELETE FROM patients WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
?>