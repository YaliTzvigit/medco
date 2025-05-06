

<!-- medecin dahs --> 

<?php
session_start();
require_once '../config/db.php';

// Vérification d'accès
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'medecin') {
    header('Location: ../login.php');
    exit;
}

$nom_medecin = isset($_SESSION['nom']) ? $_SESSION['nom'] : 'Médecin';

?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Dashboard Médecin</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <link rel="stylesheet" href="../index.css" />
  <style>
    body {
      background-color: #f8f9fa;
    }
    
    .sidebar {
      height: 100vh;
      background-color: rgb(196, 156, 10);
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

    .card {
      border: 1px solid rgb(196, 156, 10); 
    }

    .btn {
       width: 150px;
       border: 1px solid #555;
    }

  </style>
</head>
<body>

<div class="d-flex">
  <!-- Sidebar -->
  <div class="sidebar sidebar d-flex flex-column p-4">
    <h4 class="text-center">Gestion CSC</h4>
    <hr>
    <h4 class="text-center"> Medecin </h4>
    <hr>
    <ul class="nav nav-pills flex-column mb-auto">
      <li><a href="#" class="nav-link text-white"><i class="bi bi-people me-2"></i> Liste des patients</a></li>
      <li><a href="" class="nav-link text-white"><i class="bi bi-person-vcard me-2"></i> Listes de consultations</a></li>
      <li><a href="liste_personnel.php" class="nav-link text-white"><i class="bi bi-journals"></i> Historique</a></li>
    </ul>
    <hr>
    <a href="../logout.php" class="btn btn-outline-light w-100"><i class="bi bi-box-arrow-right"></i> Déconnexion</a>
  </div>

  <!-- Content -->
  <div class="content flex-grow-1">
    <h2 class="mb-4">Bienvenue Dr. <?= htmlspecialchars($nom_medecin) ?></h2>

    <div class="row">
      <div class="col-md-4">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">📋 Liste des patients</h5>
            <p class="card-text">Voir et accéder aux dossiers médicaux.</p>
            <a href="patients_liste.php" class="btn btn btn-primary">Accéder</a>
          </div>
        </div>
      </div>

      <div class="col-md-4">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">➕ Nouvelle consultation</h5>
            <p class="card-text">Ajouter une consultation au dossier d’un patient.</p>
            <a href="ajouter_consultation.php" class="btn btn btn-primary">Ajouter</a>
          </div>
        </div>
      </div>

      <div class="col-md-4">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">📚 Historique</h5>
            <p class="card-text">Voir les consultations passées.</p>
            <a href="historique_consultations.php" class="btn btn btn-primary">Voir</a>
          </div>
        </div>
      </div>
    </div>

  </div>
</div>

</body>
</html>
