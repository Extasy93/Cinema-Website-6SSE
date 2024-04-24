<?php

include 'pdo.php';

if (isset($_GET['filmId'])) {
    $filmId = $_GET['filmId'];

    // Vérifiez si l'utilisateur a déjà voté en vérifiant le cookie côté client
    if (isset($_COOKIE['voted']) && $_COOKIE['voted'] === 'true') {
        echo 'Vous avez déjà voté.';
        exit;
    }

    // Mettez à jour la base de données pour incrémenter le nombre de votes
    $updateStmt = $conn->prepare("UPDATE films SET votes = votes + 1 WHERE id = :filmId");
    $updateStmt->bindParam(':filmId', $filmId);
    $updateStmt->execute();

    // Définissez le cookie pour indiquer que l'utilisateur a voté
    setcookie('voted', 'true', time() + (86400 * 30), "/"); // Expire dans 30 jours
    setcookie('voted_now', 'true', time() + (86400 * 1), "/");

    // Redirigez vers la page précédente
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit;

}
?>
