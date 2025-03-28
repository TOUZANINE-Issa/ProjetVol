<?php
require_once '../../src/Database/Bdd.php';
require_once '../../src/model/Utilisateur.php';
require_once '../../src/Repository/UtilisateurRepository.php';

session_start();

var_dump($_POST);

if (isset($_POST['Co'])) {
    extract($_POST);

    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $utilisateurRepository = new UtilisateurRepository();
        $utilisateur = $utilisateurRepository->connexion($email, $mdp);

        if (isset($utilisateur["id_utilisateur"])) {
            $_SESSION['user_id'] = $utilisateur['id_utilisateur'];
            $_SESSION['nom'] = $utilisateur['nom'];
            $_SESSION['prenom'] = $utilisateur['prenom'];
            $_SESSION['email'] = $utilisateur['email'];
            $_SESSION['role'] = $utilisateur['role'];


            header('Location: ../../index.php');
            exit();
        } else {
            echo "Email ou mot de passe incorrect.";
            header('Location: ../../vue/Connexion.html');
            exit();
        }
    } else {
        echo "Email invalide.";
        header('Location: ../../vue/Connexion.html');
        exit();
    }
}
?>
