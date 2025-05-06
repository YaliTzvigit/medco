<?php
session_start();
require_once(__DIR__ . '/../config/db.php');

if (isset($_POST['login_admin'])) {
    $email = $_POST['email'] ?? '';
    $mot_de_passe = $_POST['mot_de_passe'] ?? '';

    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ? AND role = 'admin'");
    $stmt->execute([$email]);
    $admin = $stmt->fetch();

    if ($admin && password_verify($mot_de_passe, $admin['mot_de_passe'])) {
        $_SESSION['admin_id'] = $admin['id'];
        $_SESSION['admin_nom'] = $admin['nom'];
        $_SESSION['user_id'] = $admin['id'];
        $_SESSION['role'] = 'admin';       

        header("Location: ../views/dashboard_admin.php");
        exit;
    } else {
        $_SESSION['error'] = "Identifiants incorrects ou vous n'êtes pas administrateur.";
        header("Location: ../admin/auth.php");
        exit;
    }
} else {
    header("Location: ../admin/auth.php");
    exit;
}
