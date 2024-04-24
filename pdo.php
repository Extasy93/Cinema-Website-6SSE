<?php
    $servername = "localhost";
    $username = "root";
    $password = "Votre_MDP_SQL";
    $dbname = "cinema-rheto";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        echo "Erreur de connexion à la base de données : " . $e->getMessage();
    }
?>