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
</head>
<body>

<div class="left-panel text-center">
    <h1>MEDCO</h1>
    <p class="welph">Bienvenue à nouveau,</p>
    <h3 class="leftph">Connectez-vous à votre compte pour continuer.</h3>
</div>

<div class="right-panel">
    <div class="login-form">
        
        <?php if (isset($_SESSION['error'])): ?>
            <div class="alert alert-danger text-center"><?= $_SESSION['error']; unset($_SESSION['error']); ?></div>
        <?php endif; ?>

        <div class="tab-container d-flex justify-content-center mb-4">
            <button class="btn btn-outline-primary me-2" id="personnelBtn" onclick="showForm('personnel-login')">Personnel</button>
            <button class="btn btn-outline-primary" id="patientBtn" onclick="showForm('patient-login')">Patient</button>
        </div>

        <div id="personnel-login" class="form-wrapper active">
            <h3 class="form-title">Connexion Personnel</h3>
            <form action="controllers/loginController.php" method="POST" name="personnelForm">
                <div class="mb-3">
                    <label class="form-label">Adresse e-mail</label>
                    <input type="email" name="email" class="form-control" placeholder="nom@exemple.com" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Code PIN</label>
                    <input type="password" name="pin_code" class="form-control" maxlength="4" placeholder="****" required>
                </div>
                <a href="#" class="forgot-link">Mot de passe oublié ?</a>
                <button type="submit" class="btn btn-custom w-100 mt-3" name="login_personnel">Connexion</button>
            </form>
        </div>

        <div id="patient-login" class="form-wrapper" style="display: none;">
            <h3 class="form-title">Connexion Patient</h3>
            <form action="controllers/loginController.php" method="POST" name="patientForm">
                <div class="mb-3">
                    <label class="form-label">Téléphone</label>
                    <input type="text" name="telephone" class="form-control" placeholder="Ex: 0700000000" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Code PIN</label>
                    <input type="password" name="pin_code" class="form-control" maxlength="4" placeholder="****" required>
                </div>
                <a href="#" class="forgot-link">Mot de passe oublié ?</a>
                <button type="submit" class="btn btn-custom w-100 mt-3" name="login_patient">Connexion</button>
            </form>
        </div>

    </div>
</div>

<script>
    function showForm(formId) {
        const personnelForm = document.getElementById('personnel-login');
        const patientForm = document.getElementById('patient-login');
        const personnelBtn = document.getElementById('personnelBtn');
        const patientBtn = document.getElementById('patientBtn');

        if (formId === 'personnel-login') {
            personnelForm.style.display = 'block';
            patientForm.style.display = 'none';
            personnelBtn.classList.add('active');
            patientBtn.classList.remove('active');
        } else {
            personnelForm.style.display = 'none';
            patientForm.style.display = 'block';
            personnelBtn.classList.remove('active');
            patientBtn.classList.add('active');
        }
    }
</script>

</body>
</html>
