

<?php
require_once('../config/db.php'); // Connexion à la base de données
session_start();

$message = '';
$erreur = '';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Récupération des données du formulaire
    $nom = $_POST['nom'] ?? '';
    $email = $_POST['email'] ?? '';
    $mot_de_passe = $_POST['mot_de_passe'] ?? '';
    $role = $_POST['role'] ?? '';

    // Vérification de base
    if (empty($nom) || empty($email) || empty($mot_de_passe) || empty($role)) {
        $erreur = "Tous les champs sont obligatoires.";
    } elseif (!in_array($role, ['medecin', 'infirmier', 'accueil'])) {
        $erreur = "Rôle non valide.";
    } else {
        // Vérifier si l'email existe déjà
        $check = $conn->prepare("SELECT id FROM users WHERE email = ?");
        $check->execute([$email]);
        if ($check->rowCount() > 0) {
            $erreur = "Cet email est déjà utilisé.";
        } else {
            // Génération du code PIN : première lettre du nom + 3 chiffres aléatoires
            $initiale = strtoupper(substr($nom, 0, 1));
            $code_pin = $initiale . str_pad(rand(0, 999), 3, '0', STR_PAD_LEFT);

            // Hash du mot de passe
            $hashed_password = password_hash($mot_de_passe, PASSWORD_DEFAULT);

            // Insertion dans la base
            $sql = "INSERT INTO users (nom, email, mot_de_passe, code_pin, role) VALUES (?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $success = $stmt->execute([$nom, $email, $hashed_password, $code_pin, $role]);

            if ($success) {
                $message = "Membre ajouté avec succès. Code PIN : <strong>$code_pin</strong>";
            } else {
                $erreur = "Erreur lors de l'ajout du personnel.";
            }
        }
    }
}
?>
