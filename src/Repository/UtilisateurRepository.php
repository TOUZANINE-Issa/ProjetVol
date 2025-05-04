<?php
class UtilisateurRepository
{
    private $bdd;

    public function __construct()
    {
        $this->bdd = new Bdd();
    }

    public function inscription(Utilisateur $utilisateur)
    {
        $hashedPassword = password_hash($utilisateur->getMdp(), PASSWORD_DEFAULT);

        try {
            $req = $this->bdd->getBdd()->prepare('INSERT INTO utilisateur (prenom, nom, email, date_de_naissance, ville, mdp) VALUES (:prenom, :nom, :email, :date_de_naissance, :ville, :mdp)');
            $success = $req->execute([
                "prenom" => $utilisateur->getPrenom(),
                "nom" => $utilisateur->getNom(),
                "email" => $utilisateur->getEmail(),
                "date_de_naissance" => $utilisateur->getDateDeNaissance(),
                "ville" => $utilisateur->getVille(),
                "mdp" => $hashedPassword
            ]);
            return $success;
        } catch (PDOException $e) {
            echo "Erreur lors de l'inscription : " . $e->getMessage();
            return false;
        }
    }

    public function connexion($email, $mdp)
    {
        $req = $this->bdd->getBdd()->prepare('SELECT * FROM utilisateur WHERE email = :email');
        $req->execute(['email' => $email]);

        $utilisateur = $req->fetch(PDO::FETCH_ASSOC);
        // var_dump($utilisateur); // À retirer en production
        // var_dump(password_verify($mdp, $utilisateur['mdp'])); // À retirer en production
        if ($utilisateur && password_verify($mdp, $utilisateur['mdp'])) {
            return $utilisateur;
        }

        return false;
    }

    public function getUtilisateur($email) {
        $query = "SELECT * FROM utilisateur WHERE email = :email";
        $stmt = $this->bdd->getBdd()->prepare($query);
        $stmt->bindValue(':email', $email);
        $stmt->execute();
        $userData = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($userData) {
            return new Utilisateur($userData);
        }
        return null;
    }

    public function modifierUtilisateur(Utilisateur $utilisateur)
    {
        try {
            $req = $this->bdd->getBdd()->prepare('UPDATE utilisateur 
                SET prenom = :prenom, nom = :nom, email = :email, ville = :ville, date_de_naissance = :date_de_naissance
                WHERE id_utilisateur = :id_utilisateur');
            return $req->execute([
                "id_utilisateur" => $utilisateur->getIdUtilisateur(),
                "nom" => $utilisateur->getNom(),
                "prenom" => $utilisateur->getPrenom(),
                "email" => $utilisateur->getEmail(),
                "ville" => $utilisateur->getVille(),
                "date_de_naissance" => $utilisateur->getDateDeNaissance()
            ]);
        } catch (PDOException $e) {
            echo "Erreur lors de la mise à jour de l'utilisateur : " . $e->getMessage();
            return false;
        }
    }

    public function supprimerUtilisateur(Utilisateur $utilisateur)
    {
        try {
            $req = $this->bdd->getBdd()->prepare('DELETE FROM utilisateur WHERE id_utilisateur = :id_utilisateur');
            return $req->execute([
                "id_utilisateur" => $utilisateur->getIdUtilisateur(),
            ]);
        } catch (PDOException $e) {
            echo "Erreur lors de la suppression de l'utilisateur : " . $e->getMessage();
            return false;
        }
    }
}
?>