<?php

namespace App\Modele;
use App\Utilitaire\Singleton_ConnexionPDO;
use PDO;

class Modele_Visiteurs
{

    public static function getVisiteurs(): array {
        $pdo = Singleton_ConnexionPDO::getInstance();
        $stmt = $pdo->query('SELECT v.id_salarie, s.nom, s.prenom, s.email, s.age, s.adresse
             FROM visiteur v
             INNER JOIN salarie s ON v.id_salarie = s.id_salarie'
        );
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function ajouterVisiteur( int $idDelegue, int $idSalarie): void
    {
        try {
            $pdo = Singleton_ConnexionPDO::getInstance();

            // Récupérer l'id_region du délégué
            $stmtRegion = $pdo->prepare('SELECT id_region FROM delegue_regional WHERE id_salarie = :idDelegue');
            $stmtRegion->execute([':idDelegue' => $idDelegue]);
            $idRegion = $stmtRegion->fetchColumn();

            if (!$idRegion) {
                throw new \Exception("Aucune région trouvée pour ce délégué.");
            }

            // Ajouter le visiteur
            $stmtVisiteur = $pdo->prepare(
                'INSERT INTO visiteur (id_salarie, id_region) VALUES (:idSalarie, :idRegion)'
            );
            $stmtVisiteur->execute([
                ':idSalarie' => $idSalarie,
                ':idRegion' => $idRegion
            ]);

        } catch (\PDOException $e) {
            throw new \Exception("Erreur lors de l'ajout du visiteur : " . $e->getMessage());
        }
    }


    /**
     * Récupère les visiteurs sous la supervision d’un délégué régional
     */
    public static function getVisiteursSousSupervision(int $idDelegue): array
    // idDelegue correspond à l'id du salarié connexté en tant que delegue
    {
        try {
            $pdo = Singleton_ConnexionPDO::getInstance();
            $stmt = $pdo->prepare(
                'SELECT v.id_salarie, s.nom, s.prenom, s.email, s.age, s.adresse
             FROM visiteur v
             INNER JOIN salarie s ON v.id_salarie = s.id_salarie
             INNER JOIN delegue_regional d ON d.id_region = v.id_region
             WHERE d.id_salarie = :idDelegue'
            );
            $stmt->execute([':idDelegue' => $idDelegue]);

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            throw new \Exception("Erreur lors de la récupération des visiteurs : " . $e->getMessage());
        }
    }

}
