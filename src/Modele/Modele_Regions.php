<?php

namespace App\Modele;

use App\Utilitaire\Singleton_ConnexionPDO;
use PDO;
class Modele_Regions
{
    public static function getRegions(): array {
        $pdo = Singleton_ConnexionPDO::getInstance();
        $stmt = $pdo->query('SELECT id_region, libelle_region FROM region');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}