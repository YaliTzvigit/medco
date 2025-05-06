<?php
session_start();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion - Plateforme CSC</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="login.css" />
    <style>
        /* Vos styles CSS ici (login.css ou style inline) */
    </style>
</head>
<body>

<h1 class="logo" onclick="window.location.href='index.php'">
    MEDCO
</h1>

<div class="login-container">
    <div class="tab-container">
        <button class="tab active" onclick="showForm('personnel-login')">Personnel</button>
        <button class="tab" onclick="showForm('patient-login')">Patient</button>
    </div>

    <?php if (isset($_SESSION['error'])): ?>
        <div class="alert alert-danger text-center"><?= $_SESSION['error']; unset($_SESSION['error']); ?></div>
    <?php endif; ?>

    <div id="personnel-login" class="form-wrapper active">
        <h3 class="form-title">Connexion Personnel</h3>
        <form action="controllers/loginController.php" method="POST" name="personnelForm">
            <div class="mb-3">
                <label for="email" class="form-label">Votre Courriel</label>
                <input type="email" name="email" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="pin_code_personnel" class="form-label">Code PIN</label>
                <input type="password" name="pin_code" class="form-control" maxlength="4" required>
            </div>
            <button type="submit" class="btn btn-custom w-100" name="login_personnel">Se connecter</button>
            <a href="#" class="link-back">J’ai oublié mon CODE PIN. <i class="fa-regular fa-circle-question"></i></a>
        </form>
    </div>

    <div id="patient-login" class="form-wrapper">
        <h3 class="form-title">Connexion Patient</h3>
        <form action="controllers/loginController.php" method="POST" name="patientForm">
            <div class="mb-3">
                <label for="telephone" class="form-label">Téléphone</label>
                <input type="text" name="telephone" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="pin_code_patient" class="form-label">Code PIN</label>
                <input type="password" name="pin_code" class="form-control" maxlength="4" required>
            </div>
            <button type="submit" class="btn btn-custom w-100" name="login_patient">Se connecter</button>
        </form>
        <a href="#" class="link-back">J’ai oublié mon CODE PIN. <i class="fa-regular fa-circle-question"></i></a>
    </div>
</div>

<script>
    function showForm(formId) {
        const forms = document.querySelectorAll('.form-wrapper');
        const tabs = document.querySelectorAll('.tab');

        forms.forEach(form => form.classList.remove('active'));
        tabs.forEach(tab => tab.classList.remove('active'));

        document.getElementById(formId).classList.add('active');
        const activeTab = formId === 'personnel-login' ? tabs[0] : tabs[1];
        activeTab.classList.add('active');
    }
</script>

</body>
</html>