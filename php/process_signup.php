<?php
session_start();
include './db/connexionBDD.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les données du formulaire
    $nom = htmlspecialchars(trim($_POST['nom']));
    $email = htmlspecialchars(trim($_POST['email']));
    $password = htmlspecialchars(trim($_POST['password']));

    try {
        // Vérifier si le nom ou l'email existe déjà
        $query = "SELECT * FROM membres WHERE nom = :nom OR email = :email";
        $stmt = $pdo->prepare($query);
        $stmt->execute(['nom' => $nom, 'email' => $email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            echo "<p class='text-red-500 text-center'>Ce nom ou cet email est déjà pris. Veuillez en choisir un autre.</p>";
        } else {
            // Hacher le mot de passe
            $mot_de_passe_hache = password_hash($password, PASSWORD_DEFAULT);

            // Attribuer le rôle par défaut (id_role = 1)
            $role_id = 1;  // Rôle "Utilisateur"

            // Insérer l'utilisateur avec le rôle par défaut
            $insertQuery = "INSERT INTO membres (nom, email, password, role_id) VALUES (:nom, :email, :mot_de_passe, :role_id)";
            $insertStmt = $pdo->prepare($insertQuery);
            $insertStmt->execute([
                'nom' => $nom,
                'email' => $email,
                'mot_de_passe' => $mot_de_passe_hache,
                'role_id' => $role_id
            ]);

            echo '<p class="text-green-500 text-center">Inscription réussie ! Vous pouvez maintenant <a href="?route=login" class="text-blue-600">vous connecter</a>.</p>';
        }
    } catch (PDOException $e) {
        echo "<p class='text-red-500 text-center'>Erreur : " . $e->getMessage() . "</p>";
    }
} else {
    echo "<p class='text-red-500 text-center'>Méthode de requête non valide.</p>";
}
?>