

<?php
require_once('../config/db.php');
require_once('../controllers/personnelController.php');

$message = "";
$erreur = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = trim($_POST['nom']);
    $email = trim($_POST['email']);
    $mot_de_passe = password_hash($_POST['mot_de_passe'], PASSWORD_DEFAULT);
    $role = $_POST['role'];

    // Vérifie si l'utilisateur existe déjà
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);

    if ($stmt->rowCount() > 0) {
        $erreur = "Un utilisateur avec cet email existe déjà.";
    } else {
        // Génération du code PIN (initiale + 3 chiffres)
        $prefix = strtoupper(substr($nom, 0, 1));
        $suffix = rand(100, 999);
        $pin_code = $prefix . $suffix;

        // Insertion dans la base
        $sql = "INSERT INTO users (nom, email, mot_de_passe, role, pin_code, created_at) 
                VALUES (?, ?, ?, ?, ?, NOW())";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$nom, $email, $mot_de_passe, $role, $pin_code]);

        $message = "Personnel ajouté avec succès. Code PIN généré : <strong>$pin_code</strong>";
    }
}
?>


<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Ajouter du personnel</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body class="bg-light">
  <div class="container py-5">
    <h2>Ajouter un membre du personnel</h2>

    <?php if ($message): ?>
      <div class="alert alert-success"><?= $message ?></div>
    <?php endif; ?>
    <?php if ($erreur): ?>
      <div class="alert alert-danger"><?= $erreur ?></div>
    <?php endif; ?>

    <form method="POST" class="bg-white p-4 shadow rounded">
      <div class="mb-3">
        <label>Nom complet</label>
        <input type="text" name="nom" class="form-control" required>
      </div>
      <div class="mb-3">
        <label>Email</label>
        <input type="email" name="email" class="form-control" required>
      </div>
      <div class="mb-3">
        <label>Mot de passe</label>
        <input type="password" name="mot_de_passe" class="form-control" required>
      </div>
      <div class="mb-3">
        <label>Rôle</label>
        <select name="role" class="form-select" required>
          <option value="">-- Sélectionner un rôle --</option>
          <option value="medecin">Médecin</option>
          <option value="infirmier">Infirmier</option>
          <option value="accueil">Agent d'accueil</option>
        </select>
      </div>
      <button type="submit" class="btn btn-primary">Ajouter</button>
      <a href="dashboard_admin.php" class="btn btn-secondary">Retour</a>
    </form>
  </div>
</body>
</html>
