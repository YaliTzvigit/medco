

<?php

session_start();

require_once(__DIR__ . '/../config/db.php');

if (isset($_POST['login_admin'])) {
    $email = $_POST['email'] ?? '';
    $mot_de_passe = $_POST['mot_de_passe'] ?? '';

    // Vérifier si l'admin existe
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ? AND role = 'admin'");
    $stmt->execute([$email]);
    $admin = $stmt->fetch();

    if ($admin && password_verify($mot_de_passe, $admin['mot_de_passe'])) {
        // Authentification réussie
        $_SESSION['admin_id'] = $admin['id'];
        $_SESSION['admin_nom'] = $admin['nom'];
        header("Location: ../views/dashboard_admin.php");
        exit;
    } else {
        // Erreur de connexion
        $_SESSION['error'] = "Identifiants incorrects ou vous n'êtes pas administrateur.";
        header("Location: ../login_admin.php");
        exit;
    }
} else {
    // Accès direct interdit
    header("Location: ../login_admin.php");
    exit;
}


