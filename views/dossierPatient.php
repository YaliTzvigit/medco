
<!-- Dossier Médical du patient --> 

<?php
session_start();
require_once '../controllers/patientController.php';
require_once '../controllers/consultationController.php';

// Vérification de l'accès
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'medecin') {
    header('Location: ../login.php');
    exit;
}

$patientController = new PatientController();
$patient = $patientController->dossierPatient($_GET['id']); // Récupérer le patient par son ID

// Si le patient n'existe pas
if (!$patient) {
    echo "Patient introuvable.";
    exit;
}

// Récupérer l'historique des consultations du patient
$consultationController = new ConsultationController();
$consultations = $consultationController->getConsultationsByPatientId($_GET['id']);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Dossier du Patient</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
  <div class="container py-4">
    <h2 class="mb-4">Dossier Médical de <?= htmlspecialchars($patient['nom'] . ' ' . $patient['prenom']) ?></h2>

    <!-- Détails du patient -->
    <div class="card mb-4">
      <div class="card-header">Informations Personnelles</div>
      <div class="card-body">
        <p><strong>Nom :</strong> <?= htmlspecialchars($patient['nom']) ?></p>
        <p><strong>Prénom :</strong> <?= htmlspecialchars($patient['prenom']) ?></p>
        <p><strong>Date de naissance :</strong> <?= htmlspecialchars($patient['date_naissance']) ?></p>
        <p><strong>Sexe :</strong> <?= htmlspecialchars($patient['sexe']) ?></p>
        <p><strong>Téléphone :</strong> <?= htmlspecialchars($patient['telephone']) ?></p>
        <p><strong>Adresse :</strong> <?= nl2br(htmlspecialchars($patient['adresse'])) ?></p>
        <p><strong>Groupe sanguin :</strong> <?= htmlspecialchars($patient['groupe_sanguin']) ?></p>
      </div>
    </div>

    <!-- Historique des consultations -->
    <div class="card">
      <div class="card-header">Historique des Consultations</div>
      <div class="card-body">
        <table class="table table-striped table-bordered">
          <thead>
            <tr>
              <th>Date</th>
              <th>Type de consultation</th>
              <th>Notes</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php if (empty($consultations)): ?>
              <tr>
                <td colspan="4" class="text-center">Aucune consultation trouvée</td>
              </tr>
            <?php else: ?>
              <?php foreach ($consultations as $consultation): ?>
                <tr>
                  <td><?= htmlspecialchars($consultation['date_consultation']) ?></td>
                  <td><?= htmlspecialchars($consultation['type_consultation']) ?></td>
                  <td><?= nl2br(htmlspecialchars($consultation['notes'])) ?></td>
                  <td><a href="#" class="btn btn-sm btn-outline-warning">Modifier</a></td>
                </tr>
              <?php endforeach; ?>
            <?php endif; ?>
          </tbody>
        </table>
        <a href="ajouter_consultation.php?patient_id=<?= $patient['id'] ?>" class="btn btn-success">➕ Ajouter une consultation</a>
      </div>
    </div>

    <a href="patients_liste.php" class="btn btn-secondary mt-4">⬅️ Retour à la liste des patients</a>
  </div>
</body>
</html>

