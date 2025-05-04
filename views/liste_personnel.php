

<!-- Liste du personnel ajouté par l'admin -->  

<?php
session_start();
require_once '../config/db.php';

// Vérification de l'admin connecté
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header('Location: ../login.php');
    exit;
}

// Récupérer tous les utilisateurs sauf l’admin connecté
$stmt = $pdo->prepare("SELECT * FROM users WHERE id != ? ORDER BY role ASC");
$stmt->execute([$_SESSION['user_id']]);
$personnel = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Liste du personnel</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

  <div class="container py-5">
    <h2 class="mb-4">Liste du personnel</h2>

    <a href="dashboard_admin.php" class="btn btn-secondary mb-3">⬅ Retour au dashboard</a>

    <table class="table table-bordered table-hover bg-white shadow">
      <thead class="table-primary">
        <tr>
          <th>#</th>
          <th>Nom</th>
          <th>Email</th>
          <th>Rôle</th>
          <th>Date création</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($personnel as $index => $user): ?>
          <tr>
            <td><?= $index + 1 ?></td>
            <td><?= htmlspecialchars($user['nom']) ?></td>
            <td><?= htmlspecialchars($user['email']) ?></td>
            <td><span class="badge bg-info text-dark"><?= $user['role'] ?></span></td>
            <td><?= date('d/m/Y H:i', strtotime($user['created_at'])) ?></td>
            <td>
            <td>
              <a href="modifier_personnel.php?id=<?= $user['id'] ?>" class="btn btn-sm btn-outline-primary">✏️ Modifier</a>
              <a href="../actions/supprimer_personnel.php?id=<?= $user['id'] ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Confirmer la suppression de ce compte ?')">🗑️ Supprimer</a>
            </td>

            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>

</body>
</html>
