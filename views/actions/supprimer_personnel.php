

<?php
session_start();
require_once '../config/db.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header('Location: ../login.php');
    exit;
}

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    
    // On empêche de supprimer son propre compte admin
    if ($id === $_SESSION['user_id']) {
        header('Location: ../views/liste_personnel.php?erreur=self-delete');
        exit;
    }

    $stmt = $pdo->prepare("DELETE FROM users WHERE id = ?");
    $stmt->execute([$id]);
}

header('Location: ../views/liste_personnel.php?success=supprime');
exit;
