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

    public static function getRegionsDuSecteur(int $idSecteur): array
    {
        try {
            // Connexion à la BDD
            $pdo = Singleton_ConnexionPDO::getInstance();

            // Requête SQL pour récupérer l'ID et le libellé des régions
            $stmt = $pdo->prepare("
            SELECT r.id_region, r.libelle_region
            FROM region r
            INNER JOIN secteur s ON r.id_secteur = s.id_secteur
            WHERE r.id_secteur = :idSecteur
        ");

            // Exécution de la requête
            $stmt->execute([':idSecteur' => $idSecteur]);

            // Récupération des résultats sous forme d'un tableau associatif
            $regions = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // Vérification et retour du résultat
            if (empty($regions)) {
                throw new \Exception("Aucune région trouvée pour ce secteur.");
            }

            return $regions;
        } catch (\PDOException $e) {
            throw new \Exception("Erreur lors de la récupération des régions du secteur : " . $e->getMessage());
        }
    }
}