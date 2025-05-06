<?php
session_start();
require_once('../config/db.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['login_personnel'])) {
        // Tentative de connexion du personnel
        $email = $_POST['email'] ?? '';
        $pin = $_POST['pin_code'] ?? '';

        if (empty($email) || empty($pin)) {
            $_SESSION['error'] = "Tous les champs sont requis.";
            header('Location: ../login.php');
            exit;
        }

        $pdo = new PDO("mysql:host=localhost;dbname=gestion_csc", "root", ""); // Adaptez si nécessaire
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ? AND pin_code = ?");
        $stmt->execute([$email, $pin]);
        $user = $stmt->fetch();

        if ($user) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['role'] = $user['role'];

            switch ($user['role']) {
                case 'medecin':
                    header('Location: ../views/dashboard_medecin.php');
                    break;
                case 'infirmier':
                    header('Location: ../views/dashboard_infirmier.php');
                    break;
                case 'accueil':
                    header('Location: ../views/dashboard_accueil.php');
                    break;
                default:
                    $_SESSION['error'] = "Rôle inconnu.";
                    header('Location: ../login.php');
            }
            exit;
        } else {
            $_SESSION['error'] = "Email ou code PIN incorrect pour le personnel.";
            header('Location: ../login.php');
            exit;
        }
    } elseif (isset($_POST['login_patient'])) {
        $telephone = $_POST['telephone'] ?? '';
        $pin = $_POST['pin_code'] ?? '';

        if (empty($telephone) || empty($pin)) {
            $_SESSION['error'] = "Téléphone et code PIN requis.";
            header('Location: ../login.php');
            exit;
        }

        $pdo = new PDO("mysql:host=localhost;dbname=medco", "root", ""); // Assurez-vous que c'est la bonne DB pour les patients
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $pdo->prepare("SELECT * FROM patients WHERE telephone = ? AND pin_code = ?");
        $stmt->execute([$telephone, $pin]);
        $patient = $stmt->fetch();

        if ($patient) {
            $_SESSION['patient_id'] = $patient['id'];
            $_SESSION['role'] = 'patient';
            header('Location: ../views/dashboard_patient.php');
            exit;
        } else {
            $_SESSION['error'] = "Téléphone ou code PIN incorrect pour le patient.";
            header('Location: ../login.php');
            exit;
        }
    } else {
        // Aucun formulaire de connexion identifié
        $_SESSION['error'] = "Erreur de connexion.";
        header('Location: ../login.php');
        exit;
    }
}
?>