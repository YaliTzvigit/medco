

<?php
session_start();

if (!isset($_SESSION['patient_id']) || $_SESSION['role'] !== 'patient') {
    header('Location: ../login.php');
    exit;
}

require_once('../config/db.php');
$pdo = new PDO("mysql:host=localhost;dbname=medco", "root", "");
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$id = $_SESSION['patient_id'];

$stmt = $pdo->prepare("SELECT * FROM patients WHERE id = ?");
$stmt->execute([$id]);
$patient = $stmt->fetch();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Tableau de bord - Patient</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #ffffff;
            font-family: 'Segoe UI', sans-serif;
        }

        .header {
            background-color: rgb(67, 44, 2);
            color: white;
            padding: 1rem 2rem;
            border-radius: 0 0 1rem 1rem;
        }

        .info-card {
            border-left: 5px solid rgb(196, 156, 10);
            box-shadow: 0 4px 8px rgba(0,0,0,0.05);
            padding: 1.5rem;
            border-radius: 1rem;
            background-color: #fff;
        }

        .btn-custom {
            background-color: rgb(196, 156, 10);
            color: white;
            border: none;
        }

        .btn-custom:hover {
            background-color: rgb(150, 120, 8);
        }

        .card-title {
            color: rgb(67, 44, 2);
        }
    </style>
</head>
<body>

    <div class="header mb-5">
        <h2>Bienvenue <?= htmlspecialchars($patient['prenom']) ?> 👋</h2>
        <p>Voici votre espace personnel</p>
    </div>

    <div class="container">
        <div class="row mb-4">
            <div class="col-md-6">
                <div class="info-card">
                    <h5 class="card-title">Informations personnelles</h5>
                    <p><strong>Nom :</strong> <?= htmlspecialchars($patient['nom']) ?></p>
                    <p><strong>Prénom :</strong> <?= htmlspecialchars($patient['prenom']) ?></p>
                    <p><strong>Date de naissance :</strong> <?= htmlspecialchars($patient['date_naissance']) ?></p>
                    <p><strong>Sexe :</strong> <?= htmlspecialchars($patient['sexe']) ?></p>
                    <p><strong>Groupe sanguin :</strong> <?= htmlspecialchars($patient['groupe_sanguin']) ?></p>
                </div>
            </div>

            <div class="col-md-6 d-flex flex-column justify-content-between">
                <a href="consultations_patient.php" class="btn btn-custom mb-3">📋 Voir mes consultations</a>
                <a href="ordonnances_patient.php" class="btn btn-custom mb-3">💊 Voir mes ordonnances</a>
                <a href="../logout.php" class="btn btn-secondary">Se déconnecter</a>
            </div>
        </div>
    </div>

</body>
</html>
