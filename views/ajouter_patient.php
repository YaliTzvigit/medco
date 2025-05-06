
<!-- L'agent d'accueil ajoute ou enregistre les patients --> 


<head>
    <meta charset="UTF-8">
    <title>Tableau de bord - Agent d'accueil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../index.css" />
</head>

<?php if (isset($message)): ?>
    <div class="alert alert-success"><?= htmlspecialchars($message) ?></div>
<?php endif; ?>

<div class="container mt-4">
    <h2>Ajouter un nouveau patient</h2>
    <form method="POST" action="../controllers/router_patient.php?action=ajouter">
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
                <select name="sexe" class="form-control" required>
                    <option value="">-- Sélectionner --</option>
                    <option value="Homme">Homme</option>
                    <option value="Femme">Femme</option>
                </select>
            </div>
        </div>
        <div class="mb-3">
            <label>Téléphone</label>
            <input type="text" name="telephone" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Adresse</label>
            <input type="text" name="adresse" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Groupe sanguin</label>
            <input type="text" name="groupe_sanguin" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Ajouter</button>
    </form>
</div>

