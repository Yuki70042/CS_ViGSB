<?php

namespace App\Modele;
use App\Utilitaire\Singleton_ConnexionPDO;
use PDO;

class Modele_Visites
{
    /**
     * Récupère toutes les visites créées par un délégué donné (id_salarie)
     */
    public static function Visites_Par_Delegue(int $idSalarie): array
    {
        $pdo = Singleton_ConnexionPDO::getInstance();

        $sql = "
            SELECT *
            FROM visiter
            WHERE id_salarie = :idSalarie
            ORDER BY date_du_jour DESC
        ";

        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':idSalarie', $idSalarie, \PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_ASSOC); // Récupère toutes les visites sous forme associative
    }

    /**
     * Crée une nouvelle visite
     */
    public static function Ajouter_Visite(int $idSalarie, int $idMedicament, int $idPds, string $dateDuJour, string $commentaire = null): bool
    {
        $pdo = Singleton_ConnexionPDO::getInstance();

        $sql = "
            INSERT INTO visiter (id_salarie, id_medicament, id_pds, date_du_jour, commentaire)
            VALUES (:idSalarie, :idMedicament, :idPds, :dateDuJour, :commentaire)
        ";

        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':idSalarie', $idSalarie, \PDO::PARAM_INT);
        $stmt->bindParam(':idMedicament', $idMedicament, \PDO::PARAM_INT);
        $stmt->bindParam(':idPds', $idPds, \PDO::PARAM_INT);
        $stmt->bindParam(':dateDuJour', $dateDuJour, \PDO::PARAM_STR);
        $stmt->bindParam(':commentaire', $commentaire, \PDO::PARAM_STR);

        return $stmt->execute(); // Renvoie true si l'insertion a réussi
    }

    /**
     * Met à jour une visite existante
     */
    public static function Modifier_Visite(string $dateDuJour, int $idMedicament, int $idPds, int $idSalarie, string $commentaire): bool
    {
        $pdo = Singleton_ConnexionPDO::getInstance();

        $sql = "
            UPDATE visiter
            SET commentaire = :commentaire
            WHERE date_du_jour = :dateDuJour
              AND id_medicament = :idMedicament
              AND id_pds = :idPds
              AND id_salarie = :idSalarie
        ";

        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':dateDuJour', $dateDuJour, \PDO::PARAM_STR);
        $stmt->bindParam(':idMedicament', $idMedicament, \PDO::PARAM_INT);
        $stmt->bindParam(':idPds', $idPds, \PDO::PARAM_INT);
        $stmt->bindParam(':idSalarie', $idSalarie, \PDO::PARAM_INT);
        $stmt->bindParam(':commentaire', $commentaire, \PDO::PARAM_STR);

        return $stmt->execute(); // Renvoie true si la mise à jour a réussi
    }

    /**
     * Supprime une visite
     */
    public static function Supprimer_Visite(string $dateDuJour, int $idMedicament, int $idPds, int $idSalarie): bool
    {
        $pdo = Singleton_ConnexionPDO::getInstance();

        $sql = "
            DELETE FROM visiter
            WHERE date_du_jour = :dateDuJour
              AND id_medicament = :idMedicament
              AND id_pds = :idPds
              AND id_salarie = :idSalarie
        ";

        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':dateDuJour', $dateDuJour, \PDO::PARAM_STR);
        $stmt->bindParam(':idMedicament', $idMedicament, \PDO::PARAM_INT);
        $stmt->bindParam(':idPds', $idPds, \PDO::PARAM_INT);
        $stmt->bindParam(':idSalarie', $idSalarie, \PDO::PARAM_INT);

        return $stmt->execute(); // Renvoie true si la suppression a réussi
    }

}