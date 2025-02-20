<?php

namespace App\Modele;
use App\Utilitaire\Singleton_ConnexionPDO;
use PDO;

class Modele_Responsable
{
    public static function getSecteurByResponsable(int $idSalarie): int
    {
        try {
            // Création d'une instance PDO
            $pdo = Singleton_ConnexionPDO::getInstance();

            // Préparer la requête pour obtenir la région du délégué
            $stmt = $pdo->prepare("
            SELECT id_secteur
            FROM responsable_secteur
            WHERE id_salarie = :idSalarie
        ");

            // Exécuter la requête
            $stmt->execute([':idSalarie' => $idSalarie]);

            // Récupérer et retourner l'ID du secteur du délégué
            $idRegion = $stmt->fetchColumn();

            if (!$idRegion) {
                throw new \Exception("Aucun secteur trouvée pour ce Responsable.");
            }
            return $idRegion;

        } catch (\PDOException $e) {
            throw new \Exception("Erreur lors de la récupération du secteur du responsable : " . $e->getMessage());
        }
    }
}
