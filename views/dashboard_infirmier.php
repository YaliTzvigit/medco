


<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'infirmier') {
    header('Location: ../login_personnel.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Dashboard Infirmier</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../index.css" />
  <style>
     body {
         font-family: 'Inter', sans-serif;
     }
  </style>
</head>
<body class="d-flex">

<!-- Sidebar -->
<div class="bg-primary text-white p-3" style="width: 250px; min-height: 100vh;">
  <h4 class="text-center mb-4">Infirmier</h4>
  <ul class="nav flex-column">
    <li class="nav-item"><a href="#" class="nav-link text-white">📋 Consultations</a></li>
    <li class="nav-item"><a href="#" class="nav-link text-white">🩺 Suivi des patients</a></li>
  </ul>
  <hr>
  <a href="../logout.php" class="btn btn-light w-100">Déconnexion</a>
</div>

<!-- Main content -->
<div class="flex-grow-1 p-4 bg-light">
  <h3>Bienvenue, Infirmier(ère)</h3>
  <p>Ce tableau de bord vous permet de gérer les soins, les suivis et les consultations.</p>

  <div class="row mt-4">
    <div class="col-md-4">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Enregistrer un soin</h5>
          <p class="card-text">Ajoutez les soins prodigués à un patient.</p>
          <a href="#" class="btn btn-primary">Ajouter un soin</a>
        </div>
      </div>
    </div>
  </div>
</div>

</body>
</html>
