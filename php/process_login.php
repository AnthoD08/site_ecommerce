<?php
session_start(); // Pour gérer les sessions utilisateur

// Connexion à la base de données
include './db/connexionBDD.php';


// Récupération des données du formulaire
$email = $_POST['email'];
$password = $_POST['password'];

// Vérification si l'utilisateur existe dans la base
$sql = "SELECT membres.id, membres.nom, membres.password, roles.name AS role 
        FROM membres 
        JOIN roles ON membres.role_id = roles.id 
        WHERE membres.email = :email";

$stmt = $pdo->prepare($sql);
$stmt->execute(['email' => $email]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if ($user) {
    // Vérification du mot de passe
    if (password_verify($password, $user['password'])) {
        // Stocker les informations de l'utilisateur dans la session
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['nom'];
        $_SESSION['user_role'] = $user['role'];

        // Redirection basée sur le rôle
        if ($user['role'] === 'admin') {
            header('Location: dashboard'); // Page pour les admins
        } elseif ($user['role'] === 'user') {
            header('Location: accueil'); // Page pour les utilisateurs
        } else {
            header('Location: unknown_role.php'); // Pour des rôles inconnus (sécurité)
        }
        exit;
    } else {
        echo "Invalid password.";
    }
} else {
    echo "User not found.";
}
