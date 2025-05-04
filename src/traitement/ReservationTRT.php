<?php
require_once '../../src/Database/Bdd.php';
require_once '../../src/model/Reservation.php';
require_once '../../src/Repository/ReservationRepository.php';

// Vérifie si les données sont bien envoyées par la méthode POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupération et sécurisation des données du formulaire
    $destination = htmlspecialchars(trim($_POST['destination']));
    $heureArriver = htmlspecialchars(trim($_POST['heureArriver']));
    $heureDepart = htmlspecialchars(trim($_POST['heureDepart']));
    $nbrPlace = filter_var($_POST['nbrPlace'], FILTER_VALIDATE_INT, [
        'options' => ['min_range' => 1]
    ]);

    // Création d'un tableau de données
    $donnees = [
        'destination' => $destination,
        'heureArriver' => $heureArriver,
        'heureDepart' => $heureDepart,
        'nbrPlace' => $nbrPlace
    ];

    // Création d'une instance de Reservation avec les données
    $reservation = new Reservation($donnees);

    $reservationRepository = new ReservationRepository();
    $utilisateur = $reservationRepository->ajouterReservation($reservation); // Appel correct de la méthode


    if ($utilisateur != NULL) {
        header('Location: index.html');
    }

    exit();

} else {
    echo "Aucune donnée reçue.";
    exit();
}
?>