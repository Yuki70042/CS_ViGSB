<?php

namespace App\Modele;
use App\Utilitaire\Singleton_ConnexionPDO;
use PDO;

class Modele_Medicaments
// Classe intéragissant avec la table "medicaments" de la base vigsb
{
    public static function getTousMedicaments(): array
        // Fonction retournant le tableau contenant l'ensemble des médicaments
    {
        try {
            $pdo = Singleton_ConnexionPDO::getInstance();
            $requetePreparee = $pdo->prepare(
                'SELECT * FROM medicaments'
            );
            $requetePreparee->execute();
            $praticiens = $requetePreparee->fetchAll(PDO::FETCH_ASSOC);
            return $praticiens;

        } catch (PDOException $e) {
            error_log("Erreur dans getTousMedicaments : " . $e->getMessage());
            return [];
        }
    }

    public static function getMedicamentById($id_medicament): array{
        // Fonction permettant de retourner un médicament précis via son id
        $pdo = Singleton_ConnexionPDO::getInstance();
        $stmt = $pdo->prepare('SELECT * FROM medicaments WHERE id_medicament = :id_medicament');
        $stmt->execute([':id_medicament' => $id_medicament]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function modifierMedicament(int $id_medicament, float $prix, string $designation): void {
        // Fonction permettant de modifier un médicament de la table
        try {
            $pdo = Singleton_ConnexionPDO::getInstance();
            $stmt = $pdo->prepare(
                'UPDATE medicaments
            SET  prix = :prix, designation = :designation 
            WHERE id_medicament = :id_medicament');

            $stmt->execute([
                ':prix' => $prix,
                ':designation' => $designation,
                ':id_medicament' => $id_medicament
            ]);
        } catch (\PDOException $e) {
            throw new \Exception("Erreur lors de la modification du médicament : " . $e->getMessage());
        }
    }


    public static function ajouterMedicament(float $prix, string $designation): int
        // Fonction permettant d'ajouter un nouveau médicament à la table
    {
        try {
            $pdo = Singleton_ConnexionPDO::getInstance();
            $stmt = $pdo->prepare(
                'INSERT INTO medicaments (prix, designation)
                 VALUES (:prix, :designation)'
            );
            $stmt->execute([
                ':prix' => $prix,
                ':designation' => $designation,
            ]);
            // Retourne l'id du médicament inséré
            return $pdo->lastInsertId();

        } catch (\PDOException $e) {
            throw new \Exception("Erreur lors de l'ajout du médicament : " . $e->getMessage());
        }
    }

    public static function supprimerMedicament(int $id_medicament): void {
        // Fonction supprimant un médicament de la base
        try {
            $pdo = Singleton_ConnexionPDO::getInstance();
            $stmt = $pdo->prepare('DELETE FROM medicaments WHERE id_medicament = :id_medicament');
            $stmt->execute([':id_medicament' => $id_medicament]);

        } catch (\PDOException $e) {
            throw new \Exception("Erreur lors de l'ajout du médicament : " . $e->getMessage());
        }
    }
}