<?php
require_once '../../src/Database/Bdd.php';
require_once '../../src/model/Utilisateur.php';
require_once '../../src/Repository/UtilisateurRepository.php';

$database = new Bdd();
$bdd = $database->getBdd();

if (isset($_POST['ok'])) {
    // Extraction des données du formulaire
    extract($_POST);
    var_dump($_POST); // Pour le débogage, à retirer en production

    // Validation de l'e-mail
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Vérification de l'existence de l'e-mail
        $stmt = $bdd->prepare("SELECT COUNT(*) FROM utilisateur WHERE email = ?");
        $stmt->execute([$email]);

        if ($stmt->fetchColumn() > 0) {
            echo "Cette adresse e-mail est déjà utilisée.";
        } else {
            // Création de l'utilisateur
            $utilisateurRepository = new UtilisateurRepository();
            $utilisateur = new Utilisateur([
                'nom' => $nom,
                'prenom' => $prenom,
                'email' => $email,
                'ville' => $ville,
                'date_de_naissance' => $dateNaissance, 
                'mdp' => password_hash($mdp, PASSWORD_BCRYPT),
            ]);

            // Insertion de l'utilisateur
            $resultat = $utilisateurRepository->inscription($utilisateur);
            if ($resultat) {
                echo "Inscription réussie!";
                header('Location: ../../vue/Connexion.html');
                exit;
            } else {
                echo "Erreur lors de l'inscription.";
            }
        }
    } else {
        echo "Email invalide.";
    }
}
?>