<?php

class ReservationRepository
{
    private $bdd;

    public function __construct()
    {
        $this->bdd = new PDO('mysql:host=localhost;dbname=projetvol', 'root', '');
    }

    public function ajouterReservation(Reservation $reservation)
    {
        $sql = "INSERT INTO Reservation (Destination, heureDepart, heureArriver) 
            VALUES (:Destination, :heureDepart, :heureArrivee)";

        $req = $this->bdd->prepare($sql);

        $result = $req->execute(array(
            'Destination' => $reservation->getDestination(),
            'heureDepart' => $reservation->getHeureDepart(),
            'heureArriver' => $reservation->getHeureArriver()
        ));

        if ($result) {
            return true;
        } else {
            return false;
        }


    }

    public function supprimerReservation($id_reservation)
    {
        $sql = "DELETE FROM Reservation WHERE $id_reservation = :id_reservation";

        $req = $this->bdd->prepare($sql);

        $result = $req->execute(array(
            'id_reservation' => $id_reservation
        ));

        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public function modifierReservation(Reservation $reservation)
    {
        $sql = "UPDATE Reservation 
                SET destination = :destination, heureDepart = :heureDepart, heureArrivee = :heureArrivee, 
                    descriptions = :descriptions,image = COALESCE(NULLIF(:image, ''), image)

                WHERE id_film = :id_film";

        $req = $this->bdd->prepare($sql);
        $req->execute([
            'id_reservation' => $reservation->getId_reservation(),
            'destination' => $reservation->getDestination(),
            'genre' => $reservation->getHeureDepart(),
            'description' => $reservation->getHeureArrivee(),
            'duree' => $reservation->getDescriptions(),
        ]);

        return $req->rowCount() > 0;
    }


    public function afficherCatalogue()
    {
        // Tableau pour stocker les objets
        $reservations = [];

        // Connexion à la base de données
        $bdd = new Bdd();
        $connexion = $bdd->getbdd();

        // Récupérer les réservations depuis la base de données
        $volsBdd = $connexion->query("SELECT * FROM reservation ORDER BY id_reservation")->fetchAll(PDO::FETCH_ASSOC);

        // Parcourir chaque ligne de résultats
        foreach ($volsBdd as $vol) {
            // Créer une nouvelle instance de Reservation et l'ajouter au tableau
            $reservations[] = new Reservation(
                $vol['id_reservation'],
                $vol['heureDepart'],
                $vol['heureArriver']
            );
        }

        // Retourner le tableau des objets Reservation
        return $reservations;
    }
}

// port=3307;
?>
