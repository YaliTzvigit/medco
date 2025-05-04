

<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header('Location: ../login_admin.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Tableau de Bord Admin</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <style>
    body {
      min-height: 100vh;
      display: flex;
    }
    .sidebar {
      width: 250px;
      background-color: #0d6efd;
      color: white;
      min-height: 100vh;
    }
    .sidebar a {
      color: white;
      text-decoration: none;
    }
    .sidebar a:hover {
      background-color: rgba(255,255,255,0.1);
    }
    .content {
      flex-grow: 1;
      background-color: #f8f9fa;
    }
    .topbar {
      padding: 15px;
      background-color: #ffffff;
      border-bottom: 1px solid #dee2e6;
    }
  </style>
</head>
<body>

  <!-- Sidebar -->
  <div class="sidebar d-flex flex-column p-3">
    <h4 class="text-center">Gestion CSC</h4>
    <hr>
    <ul class="nav nav-pills flex-column mb-auto">
      <li><a href="#" class="nav-link text-white"><i class="bi bi-speedometer2 me-2"></i> Tableau de bord</a></li>
      <li><a href="ajouter_personnel.php" class="nav-link text-white"><i class="bi bi-person-plus-fill me-2"></i> Ajouter Personnel</a></li>
      <li><a href="liste_personnel.php" class="nav-link text-white"><i class="bi bi-people-fill me-2"></i> Liste du Personnel</a></li>
    </ul>
    <hr>
    <a href="../logout.php" class="btn btn-outline-light w-100"><i class="bi bi-box-arrow-right"></i> Déconnexion</a>
  </div>

  <!-- Contenu principal -->
  <div class="content">
    <div class="topbar d-flex justify-content-between align-items-center">
      <h4 class="mb-0">Bienvenue, Admin</h4>
    </div>

    <div class="p-4">
      <div class="row g-4">
        <div class="col-md-4">
          <div class="card shadow-sm border-0">
            <div class="card-body">
              <h5 class="card-title"><i class="bi bi-person-fill-add me-2"></i>Créer un compte</h5>
              <p class="card-text">Ajouter un nouveau membre du personnel médical ou administratif.</p>
              <a href="#" class="btn btn-primary">Ajouter</a>
            </div>
          </div>
        </div>

        <div class="col-md-4">
          <div class="card shadow-sm border-0">
            <div class="card-body">
              <h5 class="card-title"><i class="bi bi-clipboard-data me-2"></i>Voir les statistiques</h5>
              <p class="card-text">Consulter les indicateurs de suivi des patients et consultations.</p>
              <a href="#" class="btn btn-primary">Voir</a>
            </div>
          </div>
        </div>
        
        <div class="col-md-4">
          <div class="card shadow-sm border-0">
            <div class="card-body">
              <h5 class="card-title"><i class="bi bi-people me-2"></i>Gestion du personnel</h5>
              <p class="card-text">Voir ou modifier les comptes des utilisateurs existants.</p>
              <a href="#" class="btn btn-primary">Gérer</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

</body>
</html>
