<?php
require_once '../../src/Database/Bdd.php';
require_once '../../src/model/Reservation.php';
require_once '../../src/Repository/ReservationRepository.php';
// Vérifie si les données sont bien envoyées par la méthode POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupération et sécurisation des données du formulaire
    $id_reservation = htmlspecialchars(trim($_POST['id_reservation']));
    $destination = htmlspecialchars(trim($_POST['destination']));
    $heureArriver = htmlspecialchars(trim($_POST['heureArriver']));
    $heureDepart = htmlspecialchars(trim($_POST['heureDepart']));

    // Tu peux ici ajouter une logique de validation si nécessaire

    // Exemple d'affichage des données (à remplacer selon ce que tu veux faire avec)
    echo "<h2>Détails de la Réservation</h2>";
    echo "<p><strong>ID de réservation :</strong> " . $id_reservation . "</p>";
    echo "<p><strong>Destination :</strong> " . $destination . "</p>";
    echo "<p><strong>Heure d'arrivée :</strong> " . $heureArriver . "</p>";
    echo "<p><strong>Heure de départ :</strong> " . $heureDepart . "</p>";
    ////header('Location: index.html');
    exit();
} else {
    echo "Aucune donnée reçue.";
    exit();

}
?>
