<?php

$host = 'localhost';
$dbname = 'vigsb';
$user = 'root';
$pass = '';

try {
    // Connexion à MySQL
    $pdo = new PDO("mysql:host=$host", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Création de la base de données si elle n'existe pas
    $pdo->exec("CREATE DATABASE IF NOT EXISTS `$dbname` CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;");
    echo "Base de données '$dbname' créée avec succès ou déjà existante.<br>";

    // Sélection de la base de données
    $pdo->exec("USE `$dbname`;");

    // Lecture du fichier SQL
    $sql = file_get_contents(__DIR__ . '/database/vigsb.sql');
    if ($sql === false) {
        throw new Exception("Impossible de lire le fichier SQL.");
    }

    // Exécution des requêtes SQL
    $pdo->exec($sql);
    echo "Tables créées avec succès.<br>";

} catch (PDOException $e) {
    echo "Erreur PDO : " . $e->getMessage();
} catch (Exception $e) {
    echo "Erreur : " . $e->getMessage();
}

?>
