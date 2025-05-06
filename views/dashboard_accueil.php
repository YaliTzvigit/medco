<?php

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'accueil') {
    header('Location: ../login.php');
    exit;
}

require_once('../config/db.php');
require_once('../models/Patient.php');

$message = "";
$erreur = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['ajouter_patient'])) {
    $nom = trim($_POST['nom'] ?? '');
    $prenom = trim($_POST['prenom'] ?? '');
    $date_naissance = trim($_POST['date_naissance'] ?? '');
    $sexe = $_POST['sexe'] ?? '';
    $telephone = trim($_POST['telephone'] ?? '');
    $adresse = trim($_POST['adresse'] ?? '');
    $groupe_sanguin = $_POST['groupe_sanguin'] ?? '';

    if (!empty($nom) && !empty($prenom) && !empty($date_naissance) && !empty($sexe) && !empty($telephone) && !empty($adresse) && !empty($groupe_sanguin)) {
        $patientModel = new Patient();
        $success = $patientModel->addPatient(
            $nom,
            $prenom,
            $date_naissance,
            $sexe,
            $telephone,
            $adresse,
            $groupe_sanguin,
            $pin_code
        );

        if ($success) {
            $_SESSION['message'] = "Patient Enregistré.";
        } else {
            $_SESSION['erreur'] = "Erreur lors de l'enregistrement du patient.";
        }
    } else {
        $_SESSION['erreur'] = "Champs obligatoires."; 
    }

    // Rediriger après le traitement POST
    header("Location: dashboard_accueil.php");
    exit();
}

// Afficher les messages stockés en session (s'ils existent)
if (isset($_SESSION['message'])) {
    $message = $_SESSION['message'] . " <span style='cursor: pointer; float: right;' onclick=\"this.parentNode.style.display='none';\">&times;</span>";
    unset($_SESSION['message']); 
}
if (isset($_SESSION['erreur'])) {
    $erreur = $_SESSION['erreur'] . " <span style='cursor: pointer; float: right;' onclick=\"this.parentNode.style.display='none';\">&times;</span>";
    unset($_SESSION['erreur']); 
}

// Récupérer la liste des patients pour l'afficher
$patientModelListe = new Patient();
$patients = $patientModelListe->getAllPatients();

?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Tableau de bord - Agent d'accueil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../index.css" />
    <style>
        .alert {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .close-button {
            cursor: pointer;
            font-size: 1.5em;
            line-height: 1;
        }
        .pin-message {
            background-color: #e9ecef;
            padding: 10px;
            border-radius: 5px;
            margin-top: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .pin-close-button {
            cursor: pointer;
            font-size: 1.2em;
            line-height: 1;
            margin-left: 10px;
        }
    </style>
</head>
<body class="bg-light">

<div class="container mt-5">
    <h2 class="mb-4">Bienvenue, Agent d'Accueil</h2>
    <?php if ($message): ?>
        <div class="alert alert-success"><?= $message ?></div>
    <?php endif; ?>
    <?php if ($erreur): ?>
        <div class="alert alert-danger"><?= $erreur ?></div>
    <?php endif; ?>

    <div class="card mb-4">
        <div class="card-header bg-primary text-white">📋 Enregistrer un nouveau patient</div>
        <div class="card-body">
            <form method="POST">
                <div class="row mb-3">
                    <div class="col">
                        <label>Nom</label>
                        <input type="text" name="nom" class="form-control" required>
                    </div>
                    <div class="col">
                        <label>Prénom</label>
                        <input type="text" name="prenom" class="form-control" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col">
                        <label>Date de naissance</label>
                        <input type="date" name="date_naissance" class="form-control" required>
                    </div>
                    <div class="col">
                        <label>Sexe</label>
                        <select name="sexe" class="form-select" required>
                            <option value="">-- Sélectionner --</option>
                            <option value="Masculin">Masculin</option>
                            <option value="Feminin">Feminin</option>
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col">
                        <label>Téléphone</label>
                        <div class="input-group">
                            <select class="form-select" style="max-width: 110px;">
                                <option data-countryCode="CI" value="225" selected>🇨🇮 +225</option>
                                <option data-countryCode="FR" value="33">🇫🇷 +33</option>
                                <option data-countryCode="US" value="1">🇺🇸 +1</option>
                            </select>
                            <input type="text" name="telephone" class="form-control" required>
                        </div>
                    </div>
                    <div class="col">
                        <label>Adresse</label>
                        <input type="text" name="adresse" class="form-control" required>
                    </div>
                </div>
                <div class="mb-3">
                    <label>Groupe Sanguin</label>
                    <select name="groupe_sanguin" class="form-select">
                        <option value="">-- Sélectionner --</option>
                        <option value="A+">A+</option>
                        <option value="A-">A-</option>
                        <option value="B+">B+</option>
                        <option value="B-">B-</option>
                        <option value="AB+">AB+</option>
                        <option value="AB-">AB-</option>
                        <option value="O+">O+</option>
                        <option value="O-">O-</option>
                    </select>
                </div>
                <button type="submit" name="ajouter_patient" class="btn btn-success">Enregistrer</button>
                <?php if ($nouveau_pin): ?>
                    <div class="pin-message mt-3">
                        Code PIN : <strong><?= htmlspecialchars($nouveau_pin) ?></strong>
                        <span class="pin-close-button" onclick="this.parentNode.style.display='none';">&times;</span>
                    </div>
                <?php endif; ?>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="card-header bg-secondary text-white">📑 Patients enregistrés</div>
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr style="text-align: center;">
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Né (e) le</th>
                        <th>Sexe</th>
                        <th>Téléphone</th>
                        <th>Adresse</th>
                        <th>Groupe Sanguin</th>
                        <th>CODE PIN</th>
                        <th>Dossier</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($patients as $patient): ?>
                    <tr style="text-align: center;">
                        <td><?= htmlspecialchars($patient['nom']) ?></td>
                        <td><?= htmlspecialchars($patient['prenom']) ?></td>
                        <td><?= htmlspecialchars($patient['date_naissance']) ?></td>
                        <td><?= htmlspecialchars($patient['sexe']) ?></td>
                        <td><?= htmlspecialchars($patient['telephone']) ?></td>
                        <td><?= htmlspecialchars($patient['adresse']) ?></td>
                        <td><?= htmlspecialchars($patient['groupe_sanguin']) ?></td>
                        <td><?= htmlspecialchars($patient['pin_code']) ?></td>
                        <td>
                            <a href="../controllers/router_patient.php?action=voir&id=<?= $patient['id'] ?>" class="btn btn-primary btn-sm">Voir</a>
                            <a href="../controllers/router_patient.php?action=modifier&id=<?= $patient['id'] ?>" class="btn btn-warning btn-sm">Modifier</a>
                            <a href="../controllers/router_patient.php?action=supprimer&id=<?= $patient['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Confirmer la suppression ?')">Supprimer</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

</body>
</html>