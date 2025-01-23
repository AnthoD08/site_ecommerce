<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1.0" />
    <title>Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Montserrat Font -->
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet" />

    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet" />

    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/styles.css" />
</head>

<body>
    <?php include('./db/connexionBDD.php'); ?>

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
                </a>
            </div>
        </header>
        <!-- End Header -->

        <!-- Sidebar -->
        <aside id="sidebar">
            <div class="sidebar-title">
                <div class="sidebar-brand">
                    <span class="material-icons-outlined">shopping_cart</span> Mon
                    Dashboard
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
                        <span class="material-icons-outlined">groups</span> Clients
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
                    <a href="#">
                        <span class="material-icons-outlined">lock</span> Se deconnecter
                    </a>
                </li>
            </ul>
        </aside>
        <!-- End Sidebar -->

        <?php
        // Inclure la connexion à la base de données
        include './db/connexionBDD.php';

        try {
            // Requête pour récupérer les produits depuis la base de données
            $stmt = $pdo->query("SELECT * FROM Produits");
            $produits = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // Vérifier si des produits sont trouvés
            if ($produits) {
                echo "<div class='produits-container'>"; // Conteneur pour la grille de produits
                foreach ($produits as $produit) {
                    echo "<div class='produit-card'>"; // Carte produit
                    // Afficher l'image du produit
                    echo "<img src='" . htmlspecialchars($produit['image']) . "' alt='" . htmlspecialchars($produit['nom']) . "' class='produit-image'>";
                    // Lien pour voir plus d'informations sur le produit
                    echo "<a href='produit_details.php?id=" . htmlspecialchars($produit['Id_Produits']) . "' class='lien-produit'>Voir le produit</a>";
                    // Afficher le nom du produit
                    echo "<h2 class='produit-title'>" . htmlspecialchars($produit['nom']) . "</h2>";
                    // Afficher la description du produit
                    echo "<p class='produit-description'>" . htmlspecialchars($produit['description']) . "</p>";
                    // Afficher le prix et le stock
                    echo "<p class='produit-prix'>€ " . number_format($produit['prix'], 2, ',', ' ') . "</p>";
                    echo "<p class='produit-stock'>Stock: " . htmlspecialchars($produit['stock']) . "</p>";
                    // Ajouter le bouton "Ajouter au panier"
                    echo "<button class='add-to-cart-btn mt-2 px-4 py-2 bg-blue-500 text-white rounded' 
                    data-id='" . htmlspecialchars($produit['Id_Produits']) . "' 
                    data-name='" . htmlspecialchars($produit['nom']) . "' 
                    data-price='" . htmlspecialchars($produit['prix']) . "'>
                    Ajouter au panier
                  </button>";
                    echo "</div>"; // Fin de la carte produit
                }
                echo "</div>"; // Fin du conteneur
            } else {
                echo "<div class='produit'><p>Aucun produit trouvé.</p></div>";
            }
        } catch (PDOException $e) {
            echo "Erreur : " . $e->getMessage();
        }
        ?>

        <div>
            <div id="cart-container" class="absolute top-12 right-2 bg-white rounded-lg shadow-lg p-4 w-64 hidden">
                <h2 class="text-lg font-semibold">Panier</h2>
                <ul id="cart-items" class="mt-4 space-y-2"></ul>
                <p id="cart-total" class="mt-4 font-semibold">Total : 0€</p>
            </div>


            <button id="cart-toggle" class="fixed top-20 right-7 flex items-center space-x-2 z-50">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-700" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2 5h14m-7-3a2 2 0 110-4 2 2 0 010 4z" />
                </svg>
                <span id="cart-count" class="bg-red-500 text-white text-xs font-bold px-2 py-1 rounded-full">0</span>
            </button>
        </div>


        <script src="js/script.js"></script>
        <script src="js/panier.js"></script>
</body>

</html>