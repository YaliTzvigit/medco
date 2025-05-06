

<?php
session_start();
require_once '../config/db.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'medecin') {
    header('Location: ../login.php');
    exit;
}

// Récupération des patients
$stmt = $pdo->query("SELECT * FROM patients ORDER BY nom ASC");
$patients = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Liste des Patients</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
  <div class="container py-4">
    <h2 class="mb-4">📋 Liste des Patients</h2>
    <table class="table table-striped table-bordered">
      <thead class="table-primary">
        <tr>
          <th>#ID</th>
          <th>Nom</th>
          <th>Prénom</th>
          <th>Date de naissance</th>
          <th>Sexe</th>
          <th>Contact</th>
          <th>Adresse</th>
          <th>Groupe Sanguin</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($patients as $p): ?>
        <tr>
          <td><?= $p['id'] ?></td>
          <td><?= htmlspecialchars($p['nom']) ?></td>
          <td><?= htmlspecialchars($p['prenom']) ?></td>
          <td><?= htmlspecialchars($p['date_naissance']) ?></td>
          <td><?= htmlspecialchars($p['sexe']) ?></td>
          <td><?= htmlspecialchars($p['telephone']) ?></td>
          <td><?= htmlspecialchars($p['adresse']) ?></td>
          <td><?= htmlspecialchars($p['groupe_sanguin']) ?></td>
          <td>
            <a href="dossierPatient.php?id=<?= $p['id'] ?>" class="btn btn-sm btn-outline-primary">
              <i class="fa-regular fa-eye"></i>
              Dossier
            </a>
            <a href="ajouter_consultation.php?patient_id=<?= $p['id'] ?>" class="btn btn-sm btn-outline-success">
              <i class="fa-solid fa-address-book"></i>
              Consulter
            </a>
          </td>
        </tr>
        <?php endforeach; ?>
        <?php if (empty($patients)): ?>
        <tr><td colspan="6" class="text-center text-muted">Aucun patient enregistré.</td></tr>
        <?php endif; ?>
      </tbody>
    </table>
    <a href="dashboard_medecin.php" class="btn btn-secondary">
      <i class="fa-solid fa-backward"></i>
      Retour
    </a>
  </div>
</body>
</html>
