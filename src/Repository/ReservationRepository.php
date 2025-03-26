<?php

class ReservationRepository
{
    private $bdd;
    private $film;
    public function __construct()
    {
    $this->bdd = new PDO('mysql:host=localhost;dbname=projetvol', 'root', '');
    }
    public function ajouterReservation(Reservation $reservation)
    {
        $sql = "INSERT INTO Reservation (Destination, heureDepart, heureArriver, descriptions,image) 
            VALUES (:Destination, :heureDepart, :heureArrivee, :descriptions)";

        $req = $this->bdd->prepare($sql);

        $result = $req->execute(array(
            'nom_film' => $reservation->getDestination(),
            'genre' => $reservation->getHeureDepart(),
            'description' => $reservation->getHeureArriver(),
            'duree' => $reservation->getDescriptions(),
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
        $films=[];
        $bdd = new Bdd();
        $connexion = $bdd->getbdd();
        $filmsBdd = $connexion->query("SELECT * FROM film ORDER BY id_film")->fetchAll(PDO::FETCH_ASSOC);
        foreach ($filmsBdd as $film) {
            $films[]= new Film([
                "idFilm"=>$film['id_film'],
                "nomFilm"=>$film['nom_film'],
                "duree"=>$film['duree'],
                "genre"=>$film['genre'],
                "description"=>$film['description'],
                "image"=>$film['image'],

            ]);
        }
        return $films;
    }
}
// port=3307;
?>
