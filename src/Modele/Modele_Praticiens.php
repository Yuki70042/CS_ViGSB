<?php

namespace App\Modele;
use App\Utilitaire\Singleton_ConnexionPDO;
use PDO;

class Modele_Praticiens
{
    public static function getPraticiens(): array {
        $pdo = Singleton_ConnexionPDO::getInstance();
        $stmt = $pdo->query("SELECT id_pds, nom_pds, prenom_pds, metier FROM professionnels_de_sante");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getTousPraticiens(): array
    {
        try {
            $pdo = Singleton_ConnexionPDO::getInstance();
            $requetePreparee = $pdo->prepare(
                'SELECT * FROM professionnels_de_sante p'
            );
            $requetePreparee->execute();
            $praticiens = $requetePreparee->fetchAll(PDO::FETCH_ASSOC);
            return $praticiens;

        } catch (PDOException $e) {
            // Gestion des erreurs (par exemple, loguer l'erreur et retourner un tableau vide)
            error_log("Erreur dans getTousPraticiens : " . $e->getMessage());
            return [];
        }
    }

    public static function getPraticienById($id_pds): array{
        $pdo = Singleton_ConnexionPDO::getInstance();
        $stmt = $pdo->prepare('
        SELECT * FROM professionnels_de_sante 
        WHERE id_pds = :id');

        $stmt->execute([':id' => $id_pds]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function getPraticienDeLaRegion(int $id_region): array {
        // Fonction retournant uniquement les praticiens de la même région que le délégué
        try {
            $pdo = Singleton_ConnexionPDO::getInstance();
            $stmt = $pdo->prepare('
            SELECT p.* 
            FROM professionnels_de_sante p 
            INNER JOIN region r ON r.id_region = p.id_region
            INNER JOIN delegue_regional d ON d.id_region = r.id_region
            WHERE r.id_region = :id_region
            ');
            $stmt->execute(['id_region' => $id_region]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);

        } catch (\PDOException $e) {
            throw new \Exception("Erreur lors de la récupération des praticiens : " . $e->getMessage());
        }
    }

    public static function modifierPraticien(
        int $idPds,
        string $nom,
        string $prenom,
        int $age,
        string $metier,
        string $adresse,
        string $cp,
        string $ville
    ): void {

        $pdo = Singleton_ConnexionPDO::getInstance();
        $stmt = $pdo->prepare(
            'UPDATE professionnels_de_sante 
         SET 
            nom_pds = :nom_pds, 
            prenom_pds = :prenom_pds, 
            age_pds = :age_pds, 
            metier = :metier, 
            adresse_pds = :adresse_pds, 
            CP_pds = :CP_pds, 
            ville_pds = :ville_pds
         WHERE id_pds = :id_pds'
        );
        $stmt->execute([
            ':nom_pds' => $nom,
            ':prenom_pds' => $prenom,
            ':age_pds' => $age,
            ':metier' => $metier,
            ':adresse_pds' => $adresse,
            ':CP_pds' => $cp,
            ':ville_pds' => $ville,
            ':id_pds' => $idPds
        ]);
    }


    public static function ajouterPraticien(string $nom_pds, string $prenom_pds, int $age_pds, string $metier, string $adresse_pds, string $CP_pds, string $ville_pds, int $id_region): int
    {
        try {
            $pdo = Singleton_ConnexionPDO::getInstance();
            $stmt = $pdo->prepare(
                'INSERT INTO professionnels_de_sante (nom_pds, prenom_pds, age_pds, metier, adresse_pds, CP_pds, ville_pds, id_region)
                 VALUES (:nom_pds, :prenom_pds, :age_pds, :metier, :adresse_pds, :CP_pds, :ville_pds, :id_region)'
            );
            $stmt->execute([
                ':nom_pds' => $nom_pds,
                ':prenom_pds' => $prenom_pds,
                ':age_pds' => $age_pds,
                ':metier' => $metier,
//                ':mdp' => password_hash($mdp, PASSWORD_DEFAULT), // Hash du mot de passe
                ':adresse_pds' => $adresse_pds,
                ':CP_pds' => $CP_pds,
                ':ville_pds' => $ville_pds,
                ':id_region' => $id_region
            ]);

            // Retourne l'id du praticiens inséré
            return $pdo->lastInsertId();

        } catch (\PDOException $e) {
            throw new \Exception("Erreur lors de l'ajout du professionnels de santé : " . $e->getMessage());
        }
    }

    public static function supprimerPraticien(int $idPds): void {

        $pdo = Singleton_ConnexionPDO::getInstance();
        $stmt = $pdo->prepare('DELETE FROM professionnels_de_sante WHERE id_pds = :id');
        $stmt->execute([':id' => $idPds]);

    }

}