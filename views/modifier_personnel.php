

<!-- Modifier le personnel crée par l'admin --> 




<!-- Modifier les infos du personnel crée  --> 

<?php
session_start();
require_once '../config/db.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header('Location: ../login.php');
    exit;
}

if (!isset($_GET['id'])) {
    header('Location: liste_personnel.php');
    exit;
}

$id = intval($_GET['id']);
$stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute([$id]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    header('Location: liste_personnel.php?erreur=introuvable');
    exit;
}

// Traitement de la mise à jour
$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = htmlspecialchars(trim($_POST['nom']));
    $email = htmlspecialchars(trim($_POST['email']));
    $role = $_POST['role'];

    $update = $pdo->prepare("UPDATE users SET nom = ?, email = ?, role = ? WHERE id = ?");
    if ($update->execute([$nom, $email, $role, $id])) {
        $message = "Informations mises à jour avec succès.";
        // On recharge l'utilisateur
        $stmt->execute([$id]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Modifier un personnel</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
  <div class="container py-5">
    <h2>Modifier le personnel</h2>

    <?php if ($message): ?>
      <div class="alert alert-success"><?= $message ?></div>
    <?php endif; ?>

    <form method="POST" class="bg-white p-4 shadow rounded">
      <div class="mb-3">
        <label>Nom complet</label>
        <input type="text" name="nom" class="form-control" required value="<?= htmlspecialchars($user['nom']) ?>">
      </div>
      <div class="mb-3">
        <label>Email</label>
        <input type="email" name="email" class="form-control" required value="<?= htmlspecialchars($user['email']) ?>">
      </div>
      <div class="mb-3">
        <label>Rôle</label>
        <select name="role" class="form-select" required>
          <option value="medecin" <?= $user['role'] === 'medecin' ? 'selected' : '' ?>>Médecin</option>
          <option value="infirmier" <?= $user['role'] === 'infirmier' ? 'selected' : '' ?>>Infirmier</option>
          <option value="accueil" <?= $user['role'] === 'accueil' ? 'selected' : '' ?>>Agent d'accueil</option>
        </select>
      </div>
      <button type="submit" class="btn btn-primary">Mettre à jour</button>
      <a href="liste_personnel.php" class="btn btn-secondary">Annuler</a>
    </form>
  </div>
</body>
</html>
