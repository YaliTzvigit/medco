

<?php
// Démarrer la session si nécessaire
session_start();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Logiciel de Gestion CSC</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet"> <!-- Pour les icônes -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <style>

 /* go to up */

 #goTopBtn {
            display: none; /* Initialement caché */
            position: fixed;
            bottom: 20px;
            right: 20px;
            z-index: 99;
            border: none;
            outline: none;
            background-color: rgba(0, 0, 0, 0.5); /* Fond semi-transparent */
            color: white;
            cursor: pointer;
            padding: 10px 15px;
            border-radius: 5px;
            font-size: 16px;
        }

        #goTopBtn:hover {
            background-color: rgba(0, 0, 0, 0.7);
        }

    .navbar {
        padding: 10px;
        top: 0;
        position: sticky;
        z-index: 999;
    }

    .cards {
        display: flex;
    }
    .card-hover:hover {
      transform: translateY(-10px);
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }
    
    /* carousel */

    #textCarousel .carousel-inner .carousel-item {
  padding: 50px; /* Ajoute un espace intérieur autour du texte */
}

#textCarousel .carousel-item h2 {
  margin-bottom: 15px; /* Ajoute un espace sous le titre */
  font-size: 2.5em; /* Augmente la taille de la police du titre */
  font-weight: bold; /* Met le titre en gras */
}

#textCarousel .carousel-item p.lead {
  font-size: 1.2em; /* Augmente légèrement la taille du paragraphe */
  color: #555; /* Assombrit légèrement la couleur du texte */
}

#textCarousel .carousel-control-prev,
#textCarousel .carousel-control-next {
  opacity: 0.7; /* Rend les flèches de contrôle un peu transparentes */
  width: 5%; /* Ajuste la largeur des contrôles */
}

#textCarousel .carousel-control-prev:hover,
#textCarousel .carousel-control-next:hover {
  opacity: 1; /* Rend les flèches de contrôle opaques au survol */
}

#textCarousel .carousel-indicators button {
  background-color: #ccc; /* Couleur par défaut des indicateurs */
  opacity: 0.5;
  border-radius: 50%; /* Les rend circulaires */
  width: 10px;
  height: 10px;
  margin: 0 5px;
}

#textCarousel .carousel-indicators .active {
  background-color: #333; /* Couleur de l'indicateur actif */
  opacity: 1;
}

#presentation {
    margin-top: 50px;
}

#features {
    margin-top: 80px;
}

.features .card {
  transition: transform 0.3s ease-in-out;
  cursor: pointer; /* Ajoute un curseur de type "pointeur" au survol */
}

.features .card:hover {
  transform: translateY(-5px); /* Légèrement soulever la carte au survol */
  box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15); /* Ajouter une ombre plus prononcée au survol */
}


.nav-link {
    text-transform : uppercase;
}

    .footer {
      background-color: #f8f9fa;
      padding: 20px;
      text-align: center;
      margin-top: 30px;
    }
  </style>
</head>
<body>

  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
      <a class="navbar-brand" href="#">CSC Management</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <a class="nav-link" href="#presentation"><i class="fa-solid fa-info"></i>&nbsp;AIDE</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="#presentation">Présentation</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#features">Fonctionnalités</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="login_admin.php"> <i class="fas fa-gears"></i> &nbsp; ADMINSYS</a>
          </li>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="login.php"> S'authentifier </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#contact">Contact</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

<!-- Slider de texte -->
<div id="textCarousel" class="carousel slide bg-light py-5" data-bs-ride="carousel" data-bs-interval="3000">
  <div class="carousel-inner text-center">
    <div class="carousel-item active" style="background-color:rgb(88, 199, 147);"> <h2 class="display-5">Bienvenue sur la plateforme de gestion des CSC</h2>
      <p class="lead" style="color: whitesmoke;">Un outil complet pour faciliter le suivi médical et administratif dans les centres de santé communautaires.</p>
    </div>
    <div class="carousel-item" style="background-color:rgb(42, 94, 126);"> <h2 class="display-5">Suivi structuré des dossiers patients</h2>
      <p class="lead" style="color: whitesmoke;">Consultez, modifiez et organisez les informations des patients de manière centralisée et sécurisée.</p>
    </div>
    <div class="carousel-item" style="background-color:rgb(29, 58, 99);"> <h2 class="display-5">Gestion efficace du personnel médical</h2>
      <p class="lead" style="color: whitesmoke;">Administrateurs, médecins, infirmiers et agents d’accueil disposent chacun d’un espace dédié.</p>
    </div>
  </div>

  <button class="carousel-control-prev" type="button" data-bs-target="#textCarousel" data-bs-slide="prev">
    <span class="carousel-control-prev-icon"></span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#textCarousel" data-bs-slide="next">
    <span class="carousel-control-next-icon"></span>
  </button>
</div>

  <!-- Présentation -->
  <section id="presentation" class="container py-5">
    <h2 class="text-center mb-4">Présentation du Logiciel</h2>
    <p class="lead text-center">
      Notre logiciel de gestion des CSC vous permet de gérer et suivre les patients de manière simple et efficace.
      Il offre une interface intuitive pour le personnel médical et administratif, facilitant la gestion des dossiers patients, des consultations, et bien plus encore.
    </p>
  </section>

  <!-- Fonctionnalités -->
<h2 id="features" class="titre" style="text-align: center;">Fonctionnalités </h2>
<section class="container my-5 features" id="">
    <div class="row text-center">
        <div class="col-md-4 mb-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <i class="bi bi-people-fill" style="font-size: 5rem; color: #0d6efd;"></i>
                    <h5 class="card-title mt-3">Gestion simplifiée</h5>
                    <p class="card-text text-muted">Un suivi centralisé de tous vos patients et consultations en quelques clics.</p>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <i class="bi bi-shield-lock-fill" style="font-size: 5rem; color: #198754;"></i>
                    <h5 class="card-title mt-3">Sécurité des données</h5>
                    <p class="card-text text-muted">Toutes les informations médicales sont stockées de manière sécurisée.</p>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <i class="bi bi-speedometer2" style="font-size: 5rem; color: #ffc107;"></i>
                    <h5 class="card-title mt-3">Performance optimale</h5>
                    <p class="card-text text-muted">Un système rapide, optimisé pour un accès instantané aux données médicales.</p>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <i class="bi bi-pie-chart-fill" style="font-size: 5rem; color: #6f42c1;"></i>
                    <h5 class="card-title mt-3">Statistiques en temps réel</h5>
                    <p class="card-text text-muted">Suivi des consultations, examens et patients avec des chiffres toujours à jour.</p>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <i class="bi bi-layers-fill" style="font-size: 5rem; color: #fd7e14;"></i>
                    <h5 class="card-title mt-3">Modules interconnectés</h5>
                    <p class="card-text text-muted">Toutes les sections (patients, traitements, examens) communiquent entre elles.</p>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <i class="bi bi-gear-fill" style="font-size: 5rem; color: #20c997;"></i>
                    <h5 class="card-title mt-3">Administration flexible</h5>
                    <p class="card-text text-muted">Gestion des rôles et accès selon les profils : admin, médecins, agents, etc.</p>
                </div>
            </div>
        </div>
    </div>
</section>

  <!-- Contact -->
  <section id="contact" class="container py-5">
    <h2 class="text-center mb-4">Contact</h2>
    <div class="row justify-content-center">
      <div class="col-md-6">
        <p class="text-center">Pour toute question ou demande d'information, contactez-nous via le formulaire ci-dessous.</p>
        <form>
          <div class="mb-3">
            <label for="name" class="form-label">Nom</label>
            <input type="text" class="form-control" id="name" required>
          </div>
          <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" required>
          </div>
          <div class="mb-3">
            <label for="message" class="form-label">Message</label>
            <textarea class="form-control" id="message" rows="4" required></textarea>
          </div>
          <button type="submit" class="btn btn-primary">Envoyer</button>
        </form>
      </div>
    </div>
  </section>

  <!-- Footer -->
  <footer class="footer">
    <p>&copy; 2025 CSC Management - Tous droits réservés</p>
    <p>Contactez-nous : <a href="mailto:contact@cscmanagement.com">contact@cscmanagement.com</a></p>
  </footer>

    <button id="goTopBtn" title="Remonter">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-up" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M8 15a.5.5 0 0 0 .5-.5V2.707l3.146 3.147a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 0 0 .708.708L7.5 2.707V14.5a.5.5 0 0 0 .5.5z"/>
        </svg>
    </button>   

  <!-- Bootstrap JS + jQuery + Popper.js -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
  <script>
        // Récupérer le bouton
        let goTopBtn = document.getElementById("goTopBtn");

        // Afficher le bouton quand l'utilisateur scrolle vers le bas de 20px depuis le haut de la page
        window.onscroll = function() {scrollFunction()};

        function scrollFunction() {
    if (document.body.scrollTop > window.innerHeight || document.documentElement.scrollTop > window.innerHeight) {
        goTopBtn.style.display = "block";
    } else {
        goTopBtn.style.display = "none";
    }
}

        // Faire remonter la page quand on clique sur le bouton
        goTopBtn.addEventListener('click', function() {
            // Pour Chrome, Safari, etc.
            document.body.scrollTop = 0;
            // Pour Firefox
            document.documentElement.scrollTop = 0;
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
