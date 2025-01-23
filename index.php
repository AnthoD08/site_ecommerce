<?php

// Vérifiez si 'route' existe dans $_GET avant de l'utiliser
if (isset($_GET["route"])) {
    $maRoute = explode('/', $_GET["route"]);

    // Vérifier si la première route existe et traiter
    if (isset($maRoute[0])) {
        switch ($maRoute[0]) {

            case "":
            case "accueil":
                include("./php/accueil.php");
                break;

            case "produits":
                include("./php/produits.php");
                break;

            case "dashboard":
                include("./php/dashboard.php");
                break;
    
            case "login":
                include("./php/login.php");
                break;
                
            case "profil":
                include("./php/profil.php");
                break;

            case "signup":
                include("./php/signup.php");
                break;

            case "process_signup": // Traiter le formulaire d'inscription
                include("./php/process_signup.php");
                break;

            case "process_login": // Traiter le formulaire de connexion
                include("./php/process_login.php");
                break;

            case "deconnexion":
                include("./php/deconnexion.php");
                break;

            default:
                // Si la route n'est pas définie dans le switch
                include("./pages/erreur404.html");
                break;
        }
    } else {
        // Si la route est vide ou malformée
        include("./pages/erreur404.html");
    }
} else {
    // Si 'route' n'est pas définie dans l'URL
    include("./php/dashboard.php"); // Page par défaut
}
