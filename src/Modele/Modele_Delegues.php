<?php

namespace App\Modele;
use App\Utilitaire\Singleton_ConnexionPDO;
use PDO;

class Modele_Delegues
// Classe gérant les interactions avec la table : "delegue_regional" de la base vigsb
{

    public static function getDeleguesSousSupervision(int $idSecteur): array
    {
        try {
            $pdo = Singleton_ConnexionPDO::getInstance();
            $stmt = $pdo->prepare(
                'SELECT s.id_salarie, s.nom, s.prenom, s.email, s.age, s.adresse, r.libelle_region AS region, s.mot_de_passe
             FROM delegue_regional d
             INNER JOIN salarie s ON d.id_salarie = s.id_salarie
             INNER JOIN region r ON d.id_region = r.id_region
             INNER JOIN responsable_secteur rs ON r.id_secteur = rs.id_secteur
             WHERE :idSecteur = r.id_secteur'
            );
            $stmt->execute([':idSecteur' => $idSecteur]);

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            throw new \Exception("Erreur lors de la récupération des Délégués : " . $e->getMessage());
        }
    }

    public static function getRegionByDelegue(int $idSalarie): array
    {
        try {
            // Création d'une instance PDO
            $pdo = Singleton_ConnexionPDO::getInstance();
            $stmt = $pdo->prepare("
            SELECT d.id_region , r.libelle_region
            FROM delegue_regional d
            INNER JOIN region r ON r.id_region = d.id_region
            WHERE id_salarie = :idSalarie
        ");
            $stmt->execute([':idSalarie' => $idSalarie]);

            // Récupère les deux colonnes (id_region et libelle_region) sous forme de tableau
            $region = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($region === false) {
                throw new \Exception("Aucune région trouvée pour ce délégué.");
            }

            return $region; // Retourne le tableau avec l'ID et le libellé de la région

        } catch (\PDOException $e) {
            throw new \Exception("Erreur lors de la récupération de la région du délégué : " . $e->getMessage());
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
