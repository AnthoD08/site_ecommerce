<?php
session_start(); // Démarrer la session

// Vérifier si l'utilisateur est connecté
$isUserLoggedIn = isset($_SESSION['user_id']);
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>Admin Dashboard</title>

    <!-- Montserrat Font -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/styles.css">
</head>

<body>
    <div class="grid-container">

        <!-- Header -->
        <header class="header">
            <div class="menu-icon" onclick="openSidebar()">
                <span class="material-icons-outlined">menu</span>
            </div>
            <div class="header-left">
                <span class="material-icons-outlined">search</span>
            </div>
            <div class="header-right">

                <div class="dropdown">
                    <!-- Si l'utilisateur est connecté, afficher le bouton vers le profil -->
                    <?php if ($isUserLoggedIn): ?>
                        <a href="profil" class="profile-link">
                            <span class="material-icons-outlined profile-icon">account_circle</span>
                        </a>
                    <?php else: ?>
                        <!-- Si l'utilisateur n'est pas connecté, afficher les liens de connexion -->
                        <span class="material-icons-outlined profile-icon" onclick="toggleDropdown()">account_circle</span>
                        <div class="dropdown-menu">
                            <a href="login">Se connecter</a>
                            <a href="signup">S'inscrire</a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

        </header>
        <!-- End Header -->

        <div class="slider">
            <img src="images/ecommerce.jpg" class="slider-background" alt="" />
            <div class="slider-content">
                <h1>Mon site ecommerce</h1>
            </div>
        </div>

        <!-- Sidebar -->
        <aside id="sidebar">
            <div class="sidebar-title">
                <div class="sidebar-brand">
                    <span class="material-icons-outlined">shopping_cart</span> Mon site
                </div>
                <span class="material-icons-outlined" onclick="closeSidebar()">close</span>
            </div>

            <ul class="sidebar-list">
                <li class="sidebar-list-item">
                    <a href="accueil">
                        <span class="material-icons-outlined">dashboard</span> Accueil
                    </a>
                </li>
                <li class="sidebar-list-item">
                    <a href="produits">
                        <span class="material-icons-outlined">inventory_2</span> Produits
                    </a>
                </li>
                <li class="sidebar-list-item">
                    <a href="#">
                        <span class="material-icons-outlined">category</span> Categories
                    </a>
                </li>

                <li class="sidebar-list-item">
                    <a href="#">
                        <span class="material-icons-outlined">credit_card</span> Paiements
                    </a>
                </li>
                <li class="sidebar-list-item">
                    <a href="#">
                        <span class="material-icons-outlined">settings</span> Paramètres
                    </a>
                </li>
                <li class="sidebar-list-item">
                    <a href="deconnexion">
                        <span class="material-icons-outlined">lock</span> Se deconnecter
                    </a>
                </li>
            </ul>
        </aside>


        <script src="js/script.js"></script>
</body>

</html>