<?php

namespace App\Modele;
use App\Utilitaire\Singleton_ConnexionPDO;
use PDO;

class Modele_Delegues
// Classe gérant les interactions avec la table : "delegue_regional" de la base vigsb
{
    public static function getDelegues(): array {
        // Fonction récupérant l'ensemble des informations d'un délégués
        $pdo = Singleton_ConnexionPDO::getInstance();
        $stmt = $pdo->query('SELECT d.id_salarie, s.nom, s.prenom, s.email, s.age, s.adresse
             FROM salarie s
             INNER JOIN delegue_regional d ON d.id_salarie = s.id_salarie'
        );
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public static function getRegionByDelegue(int $idSalarie): int
    {
        try {
            // Création d'une instance PDO
            $pdo = Singleton_ConnexionPDO::getInstance();
            $stmt = $pdo->prepare("
                SELECT id_region 
                FROM delegue_regional
                WHERE id_salarie = :idSalarie
                ");
            $stmt->execute([':idSalarie' => $idSalarie]);
            $idRegion = $stmt->fetchColumn();

            if ($idRegion === false) {
                throw new \Exception("Aucune région trouvée pour ce délégué.");
            }
            return (int) $idRegion;

        } catch (\PDOException $e) {
            throw new \Exception("Erreur lors de la récupération de la région du délégué : " . $e->getMessage());
        }
    }

    public static function getDeleguesSousSupervision(int $idResponsable): array
        // Fonction récupérant l'ensemble des délégues sous la responsabilité du responsable
        // idResponsable correspond à l'id du salarié actuellement connecté en tant que Responsable
    {
        try {
            $pdo = Singleton_ConnexionPDO::getInstance();
            $stmt = $pdo->prepare(
                'SELECT v.id_salarie, s.nom, s.prenom, s.email, s.age, s.adresse
             FROM visiteur v
             INNER JOIN salarie s ON v.id_salarie = s.id_salarie
             INNER JOIN delegue_regional d ON d.id_region = v.id_region
             INNER JOIN responsable_secteur r ON r.id_secteur = v.id_secteur
             WHERE d.id_salarie = :idResponsable'
            );
            $stmt->execute([':idResponsable' => $idResponsable]);

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            throw new \Exception("Erreur lors de la récupération des Delegues : " . $e->getMessage());
        }
    }

    public static function ajouterDelegues(int $idSalarie, int $idRegion): void {
        // Fonction permettant de créer un nouveau délégué dans la base
        $pdo = Singleton_ConnexionPDO::getInstance();
        $stmt = $pdo->prepare(
        // A ajouter ici le secteur de idResponsable actuellement connecté
            "INSERT INTO delegue_regional (id_salarie, id_region) 
        VALUES (:idSalarie, :idRegion)"
        );
        $stmt->execute([
            ':idSalarie' => $idSalarie,
            ':idRegion' => $idRegion,
        ]);
    }
}
