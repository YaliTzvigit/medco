
<!-- Ou le personnel > medecin, infirmier, agent d'accueil s'authentifie --> 

<?php
session_start();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Connexion Personnel - CSC</title>
  <link href="assets/css/style.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
  <div class="row justify-content-center">
    <div class="col-md-5">
      <div class="card shadow rounded-4">
        <div class="card-body">
          <h4 class="text-center mb-4">Connexion Personnel</h4>

          <?php if (isset($_SESSION['error'])): ?>
            <div class="alert alert-danger"><?= $_SESSION['error']; unset($_SESSION['error']); ?></div>
          <?php endif; ?>

          <form action="controllers/loginPersonnelController.php" method="POST">
            <div class="mb-3">
              <label for="email" class="form-label">Adresse Email</label>
              <input type="email" name="email" class="form-control" required>
            </div>

            <div class="mb-3">
              <label for="code_pin" class="form-label">Code PIN</label>
              <input type="text" name="code_pin" maxlength="4" class="form-control" required>
            </div>

            <button type="submit" name="login" class="btn btn-primary w-100">Se connecter</button>
          </form>

          <div class="mt-3 text-center">
            <a href="index.php" class="text-decoration-none">← Retour à l'accueil</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

</body>
</html>
