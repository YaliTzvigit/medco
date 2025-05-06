

<?php
require_once(__DIR__ . '/config/db.php');

$nom = "Administrateur";
$email = "admin@csc.local";
$mot_de_passe = "admin123"; 
$role = "admin";

// Hachage du mot de passe
$mot_de_passe_hache = password_hash($mot_de_passe, PASSWORD_DEFAULT);

// Vérifier si l'admin existe déjà
$stmt = $pdo->prepare("SELECT * FROM users WHERE email = ? AND role = ?");
$stmt->execute([$email, $role]);

if ($stmt->rowCount() > 0) {
    echo "⚠️ Un administrateur existe déjà avec cet email.";
} else {
    // Insertion
    $stmt = $pdo->prepare("INSERT INTO users (nom, email, mot_de_passe, role) VALUES (?, ?, ?, ?)");
    $stmt->execute([$nom, $email, $mot_de_passe_hache, $role]);
    echo "✅ Admin créé avec succès !";
}
?>
