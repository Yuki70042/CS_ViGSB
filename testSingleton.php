<?php


require_once 'src\Utilitaire\Singleton_ConnexionPDO.php';
// Assurez-vous que ce chemin est correct !

use App\Utilitaire\Singleton_ConnexionPDO;

try {
    // Obtenir l'instance de la connexion
    $pdo = Singleton_ConnexionPDO::getInstance();
    echo "Connexion réussie avec le Singleton !<br>";

    // Tester une requête simple
    $stmt = $pdo->query("SHOW TABLES");
    echo "Tables dans la base de données :<br>";
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "- " . implode(', ', $row) . "<br>";
    }
} catch (PDOException $e) {
    echo "Erreur lors de la connexion ou de l'exécution de la requête : " . $e->getMessage();
}
