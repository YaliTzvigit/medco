<?php
session_start();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Connexion Admin - CSC</title>
  <link href="../assets/css/style.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
  <div class="row justify-content-center">
    <div class="col-md-4">
      <div class="card shadow rounded-4">
        <div class="card-body">
          <h4 class="text-center mb-4">Connexion Admin</h4>

          <?php if (isset($_SESSION['error'])): ?>
            <div class="alert alert-danger"><?= $_SESSION['error']; unset($_SESSION['error']); ?></div>
          <?php endif; ?>

          <form action="../controllers/logAdminController.php" method="POST">
            <div class="mb-3">
              <label for="email" class="form-label">Email</label>
              <input type="email" name="email" class="form-control" required>
            </div>
            <div class="mb-3">
              <label for="mot_de_passe" class="form-label">Mot de passe</label>
              <input type="password" name="mot_de_passe" class="form-control" required>
            </div>
            <button type="submit" name="login_admin" class="btn btn-primary w-100">Se connecter</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

</body>
</html>
