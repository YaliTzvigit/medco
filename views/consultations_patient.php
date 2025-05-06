

<?php
session_start();

if (!isset($_SESSION['patient_id']) || $_SESSION['role'] !== 'patient') {
    header('Location: ../login.php');
    exit;
}

require_once('../config/db.php');

$pdo = new PDO("mysql:host=localhost;dbname=medco", "root", "");
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$patient_id = $_SESSION['patient_id'];

// Récupération des consultations
$stmt = $pdo->prepare("SELECT c.date_consultation, c.motif, c.diagnostic, p.prenom AS medecin_prenom, p.nom AS medecin_nom
                       FROM consultations c
                       JOIN personnel p ON c.medecin_id = p.id
                       WHERE c.patient_id = ?
                       ORDER BY c.date_consultation DESC");
$stmt->execute([$patient_id]);
$consultations = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Mes consultations</title>
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

        .table thead {
            background-color: rgb(196, 156, 10);
            color: white;
        }

        .btn-custom {
            background-color: rgb(196, 156, 10);
            color: white;
            border: none;
        }

        .btn-custom:hover {
            background-color: rgb(150, 120, 8);
        }
    </style>
</head>
<body>

<div class="header mb-4">
    <h2>🩺 Mes consultations</h2>
</div>

<div class="container mt-4">
    <?php if (count($consultations) > 0): ?>
        <div class="table-responsive">
            <table class="table table-bordered rounded shadow-sm">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Motif</th>
                        <th>Diagnostic</th>
                        <th>Médecin</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($consultations as $c): ?>
                        <tr>
                            <td><?= htmlspecialchars($c['date_consultation']) ?></td>
                            <td><?= htmlspecialchars($c['motif']) ?></td>
                            <td><?= htmlspecialchars($c['diagnostic']) ?></td>
                            <td><?= htmlspecialchars($c['medecin_prenom'] . ' ' . $c['medecin_nom']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php else: ?>
        <div class="alert alert-info">Aucune consultation enregistrée.</div>
    <?php endif; ?>

    <a href="dashboard_patient.php" class="btn btn-custom mt-3">← Retour au tableau de bord</a>
</div>

</body>
</html>
