<?php
session_start();
require_once('../config/db.php'); // Connexion à la BDD via $conn

if (isset($_POST['login'])) {
    $email = trim($_POST['email']);
    $code_pin = trim($_POST['code_pin']);

    // Vérifie si l'utilisateur existe
    $sql = "SELECT * FROM users WHERE email = ? AND code_pin = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$email, $code_pin]);
    $user = $stmt->fetch();

    if ($user) {
        // Vérifie que c'est bien un personnel (et non un admin)
        if (in_array($user['role'], ['medecin', 'infirmier', 'accueil'])) {
            $_SESSION['user'] = $user;

            // Redirection selon le rôle
            switch ($user['role']) {
                case 'medecin':
                    header("Location: ../views/dashboard_medecin.php");
                    break;
                case 'infirmier':
                    header("Location: ../views/dashboard_infirmier.php");
                    break;
                case 'accueil':
                    header("Location: ../views/dashboard_accueil.php");
                    break;
            }
            exit();
        } else {
            $_SESSION['error'] = "Accès réservé au personnel.";
            header("Location: ../login.php");
            exit();
        }
    } else {
        $_SESSION['error'] = "Email ou code PIN incorrect.";
        header("Location: ../login.php");
        exit();
    }
} else {
    header("Location: ../login.php");
    exit();
}
