

<!-- medecin dahs --> 

<?php
session_start();
require_once '../config/db.php';

// Vérification d'accès
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'medecin') {
    header('Location: ../login.php');
    exit;
}

$nom_medecin = $_SESSION['nom'];
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Dashboard Médecin</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #f8f9fa;
    }
    .sidebar {
      height: 100vh;
      background-color: #0d6efd;
      color: white;
      padding: 20px;
    }
    .sidebar a {
      color: white;
      display: block;
      margin: 10px 0;
      text-decoration: none;
    }
    .sidebar a:hover {
      text-decoration: underline;
    }
    .content {
      padding: 30px;
    }
  </style>
</head>
<body>

<div class="d-flex">
  <!-- Sidebar -->
  <div class="sidebar">
    <h4>Médecin</h4>
    <p>👨‍⚕️ <?= htmlspecialchars($nom_medecin) ?></p>
    <hr>
    <a href="patients_liste.php">📋 Liste des patients</a>
    <a href="ajouter_consultation.php">➕ Nouvelle consultation</a>
    <a href="historique_consultations.php">📚 Historique</a>
    <hr>
    <a href="../logout.php" class="text-danger">🚪 Déconnexion</a>
  </div>

  <!-- Content -->
  <div class="content flex-grow-1">
    <h2 class="mb-4">Bienvenue Dr. <?= htmlspecialchars($nom_medecin) ?></h2>

    <div class="row">
      <div class="col-md-4">
        <div class="card border-info">
          <div class="card-body">
            <h5 class="card-title">📋 Liste des patients</h5>
            <p class="card-text">Voir et accéder aux dossiers médicaux.</p>
            <a href="patients_liste.php" class="btn btn-outline-info">Accéder</a>
          </div>
        </div>
      </div>

      <div class="col-md-4">
        <div class="card border-success">
          <div class="card-body">
            <h5 class="card-title">➕ Nouvelle consultation</h5>
            <p class="card-text">Ajouter une consultation au dossier d’un patient.</p>
            <a href="ajouter_consultation.php" class="btn btn-outline-success">Ajouter</a>
          </div>
        </div>
      </div>

      <div class="col-md-4">
        <div class="card border-secondary">
          <div class="card-body">
            <h5 class="card-title">📚 Historique</h5>
            <p class="card-text">Voir les consultations passées.</p>
            <a href="historique_consultations.php" class="btn btn-outline-secondary">Voir</a>
          </div>
        </div>
      </div>
    </div>

  </div>
</div>

</body>
</html>
