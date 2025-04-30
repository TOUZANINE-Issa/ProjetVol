<?php
require_once '../../src/Database/Bdd.php';
require_once '../../src/model/Utilisateur.php';
require_once '../../src/Repository/UtilisateurRepository.php';
session_start();

// Vérifier si le formulaire a été soumis
if (isset($_POST['Co'])) {
    // Extraire les données du formulaire
    extract($_POST);

    // Valider l'email
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Connexion à la base de données et vérification des identifiants
        $utilisateurRepository = new UtilisateurRepository();
        $utilisateur = $utilisateurRepository->connexion($email, $mdp);

        // Si l'utilisateur est trouvé
        if (isset($utilisateur["id_utilisateur"])) {
            // Stocker les informations de l'utilisateur dans la session
            $_SESSION['user_id'] = $utilisateur['id_utilisateur'];
            $_SESSION['nom'] = $utilisateur['nom'];
            $_SESSION['prenom'] = $utilisateur['prenom'];
            $_SESSION['email'] = $utilisateur['email'];
            $_SESSION['mdp'] = $utilisateur['mdp'];

            // Rediriger vers index.html dans le dossier vue
            header('Location: index.html');
            exit();
        } else {
            // Message en cas d'échec de la connexion
            echo "Email ou mot de passe incorrect.";
            header('Location: ../../index.html');
            exit();
        }
    } else {
        // Message en cas d'email invalide
        echo "Email invalide.";
        header('Location: ../../vue/Inscription.html');
        exit();
    }
}
?>
