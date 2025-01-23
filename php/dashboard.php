<?php
session_start();

// Vérifier si l'utilisateur est connecté et s'il est un admin
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'admin') {
  header('Location: accueil'); // Rediriger l'utilisateur vers la page de connexion si ce n'est pas un admin
  exit;
}
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
          <span class="material-icons-outlined profile-icon" onclick="toggleDropdown()">account_circle</span>
          <div class="dropdown-menu">
            <a href="login">Se connecter</a>
            <a href="signup">S'inscrire</a>
          </div>
        </div>
      </div>

    </header>
    <!-- End Header -->

    <!-- Sidebar -->
    <aside id="sidebar">
      <div class="sidebar-title">
        <div class="sidebar-brand">
          <span class="material-icons-outlined">shopping_cart</span> Mon Dashboard
        </div>
        <span class="material-icons-outlined" onclick="closeSidebar()">close</span>
      </div>

      <ul class="sidebar-list">
        <li class="sidebar-list-item">
          <a href="dashboard">
            <span class="material-icons-outlined">dashboard</span> Dashboard
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
    <!-- End Sidebar -->

    <!-- Main -->
    <main class="main-container">
      <div class="main-title">
        <p class="font-weight-bold">DASHBOARD</p>
      </div>

      <div class="main-cards">

        <div class="card">
          <div class="card-inner">
            <p class="text-primary">PRODUITS</p>
            <span class="material-icons-outlined text-blue">inventory_2</span>
          </div>
          <span class="text-primary font-weight-bold">249</span>
        </div>

        <div class="card">
          <div class="card-inner">
            <p class="text-primary">ORDRE D'ACHATS</p>
            <span class="material-icons-outlined text-orange">add_shopping_cart</span>
          </div>
          <span class="text-primary font-weight-bold">83</span>
        </div>

        <div class="card">
          <div class="card-inner">
            <p class="text-primary">ORDRE DE VENTES</p>
            <span class="material-icons-outlined text-green">shopping_cart</span>
          </div>
          <span class="text-primary font-weight-bold">79</span>
        </div>

        <div class="card">
          <div class="card-inner">
            <p class="text-primary">ALERTES</p>
            <span class="material-icons-outlined text-red">notification_important</span>
          </div>
          <span class="text-primary font-weight-bold">56</span>
        </div>

      </div>

      <div class="charts">

        <div class="charts-card">
          <p class="chart-title">Top 5 Produits</p>
          <div id="bar-chart"></div>
        </div>

        <div class="charts-card">
          <p class="chart-title">Ordre de ventes et d'achats</p>
          <div id="area-chart"></div>
        </div>

      </div>
    </main>
    <!-- End Main -->

  </div>

  <!-- Scripts -->
  <!-- ApexCharts -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/apexcharts/4.3.0/apexcharts.min.js"></script>
  <!-- Custom JS -->
  <script src="js/script.js"></script>
</body>

</html>