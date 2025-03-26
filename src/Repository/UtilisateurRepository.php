
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

        $req = $this->bdd->getBdd()->prepare('INSERT INTO utilisateur (prenom, nom, email, mdp) VALUES (:prenom, :nom, :email, :mdp)');
        $success = $req->execute([
            "nom" => $utilisateur->getNom(),
            "prenom" => $utilisateur->getPrenom(),
            "email" => $utilisateur->getEmail(),
            "mdp" => $hashedPassword,
            "date_de_naissance" => $utilisateur->getDateDeNaissance(),
        "ville" => $utilisateur->getVille()
        ]);

        return $success;
    }

    public function connexion($email, $mdp)
    {
        $req = $this->bdd->getBdd()->prepare('SELECT * FROM utilisateur WHERE email = :email');
        $req->execute(['email' => $email]);

        $utilisateur = $req->fetch(PDO::FETCH_ASSOC);
        var_dump($utilisateur);
        var_dump(password_verify($mdp, $utilisateur['mdp']));
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

        $req = $this->bdd->getBdd()->prepare('UPDATE utilisateur 
            SET prenom = :prenom, nom = :nom, email = :email, role = :role
            WHERE id_utilisateur = :id_utilisateur');
        return $req->execute([
            "id_utilisateur" => $utilisateur->getIdUtilisateur(),
            "nom" => $utilisateur->getNom(),
            "prenom" => $utilisateur->getPrenom(),
            "email" => $utilisateur->getEmail(),
            "role" => $utilisateur->getRole(),
            "date_de_naissance" => $utilisateur->getDateDeNaissance(),
            "ville" => $utilisateur->getVille()
        ]);
    }
    public function supprimerUtilisateur(Utilisateur $utilisateur){

        $req = $this->bdd->getBdd()->prepare('DELETE FROM utilisateur WHERE id_utilisateur = :id_utilisateur');

        return $req->execute([
            "id_utilisateur" => $utilisateur->getIdUtilisateur(),
        ]);
    }

}
?>
