<?php

namespace App\Modele;
use App\Utilitaire\Singleton_ConnexionPDO;
use PDO;

class Modele_Visites
{

    /**
     * Récupère les Visites associés à un salarié
     */
    public static function getVisitesParSalarie(int $idSalarie): array {

        try {
            $pdo = Singleton_ConnexionPDO::getInstance();
            $stmt = $pdo->prepare(
                'SELECT v.date_du_jour AS date,
                    p.nom_pds AS nom_pro,
                    p.adresse_pds AS adresse_pro,
                    p.CP_pds AS code_postal,
                    v.commentaire AS compte_rendu,
                    v.id_medicament,
                    v.id_pds,
                    v.validation
             FROM visiter v
             INNER JOIN professionnels_de_sante p ON v.id_pds = p.id_pds
             WHERE v.id_salarie = :idSalarie 
             AND v.validation = 0  -- Ne récupérer que les visites non validées
             ORDER BY v.date_du_jour DESC'
        );
        $stmt->bindParam(':idSalarie', $idSalarie, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (\PDOException $e) {
            throw new \Exception("Erreur lors de la récupération des visites non validées : " . $e->getMessage());
        }
    }


    public static function getVisitesHistoriqueParSalarie(int $idSalarie): array {
        try {
            $pdo = Singleton_ConnexionPDO::getInstance();
            $stmt = $pdo->prepare(
                'SELECT v.date_du_jour AS date,
                    p.nom_pds AS nom_pro,
                    p.adresse_pds AS adresse_pro,
                    p.CP_pds AS code_postal,
                    v.commentaire AS compte_rendu,
                    v.id_medicament,
                    v.id_pds,
                    v.validation
             FROM visiter v
             INNER JOIN professionnels_de_sante p ON v.id_pds = p.id_pds
             WHERE v.id_salarie = :idSalarie 
             AND v.validation = 1  
             ORDER BY v.date_du_jour DESC'
        );
        $stmt->bindParam(':idSalarie', $idSalarie, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (\PDOException $e) {
            throw new \Exception("Erreur lors de la récupération de l'historique des visites : " . $e->getMessage());
        }
    }




    public static function updateCompteRendu(array $cleVisite, string $texteCompteRendu): bool {
        try {
            $pdo = Singleton_ConnexionPDO::getInstance();
            $stmt = $pdo->prepare(
                'UPDATE visiter
                 SET commentaire = :compteRendu
                 WHERE date_du_jour = :date
                   AND id_medicament = :idMedicament
                   AND id_pds = :idPds
                   AND id_salarie = :idSalarie'
            );
            $stmt->bindParam(':compteRendu', $texteCompteRendu, PDO::PARAM_STR);
            $stmt->bindParam(':date', $cleVisite['date'], PDO::PARAM_STR);
            $stmt->bindParam(':idMedicament', $cleVisite['id_medicament'], PDO::PARAM_INT);
            $stmt->bindParam(':idPds', $cleVisite['id_pds'], PDO::PARAM_INT);
            $stmt->bindParam(':idSalarie', $cleVisite['id_salarie'], PDO::PARAM_INT);
            return $stmt->execute();
        } catch (\PDOException $e) {
            throw new \Exception("Erreur lors de la mise à jour du compte-rendu : " . $e->getMessage());
        }
    }



    /**
     * Crée une nouvelle visite :
       On commence par créer la date de la visite associé à son horaire dans la table date_visite
       On vérifie préalablement qu'elle n'existe pas déjà.
    */

    public static function dateVisiteExiste(string $date_du_jour, string $heure_du_rdv): bool {
        try {
            $pdo = Singleton_ConnexionPDO::getInstance();
            $stmt = $pdo->prepare(
                'SELECT COUNT(*) FROM date_visite WHERE date_du_jour = :date_du_jour AND heure_du_rdv = :heure_du_rdv'
            );
            $stmt->bindParam(':date_du_jour', $date_du_jour, PDO::PARAM_STR);
            $stmt->bindParam(':heure_du_rdv', $heure_du_rdv, PDO::PARAM_STR);
            $stmt->execute();

            return $stmt->fetchColumn() > 0;
        } catch (Exception $e) {
            throw new Exception("Erreur lors de la vérification de la date de visite : " . $e->getMessage());
        }
    }


    public static function ajouterDateVisite(string $date_du_jour, string $heure_du_rdv): bool {
        try {
            $pdo = Singleton_ConnexionPDO::getInstance();
            $stmt = $pdo->prepare(
                'INSERT INTO date_visite (date_du_jour, heure_du_rdv) 
                 VALUES (:date_du_jour, :heure_du_rdv)'
            );
            $stmt->bindParam(':date_du_jour', $date_du_jour, PDO::PARAM_STR);
            $stmt->bindParam(':heure_du_rdv', $heure_du_rdv, PDO::PARAM_STR);

            return $stmt->execute();
        } catch (Exception $e) {
            throw new Exception("Erreur lors de l'ajout de la date de la visite : " . $e->getMessage());
        }
    }



    public static function ajouterVisite(string $date_du_jour, int $id_medicament, int $id_pds, int $id_salarie): bool {
        try {
            // Connexion à la base
            $pdo = Singleton_ConnexionPDO::getInstance();

            // Requête SQL
            $sql = "INSERT INTO visiter (date_du_jour, id_medicament, id_pds, id_salarie) 
                VALUES (:date_du_jour, :id_medicament, :id_pds, :id_salarie)";

            // Préparation de la requête
            $stmt = $pdo->prepare($sql);

            return $stmt->execute([
                ':date_du_jour' => $date_du_jour,
                ':id_medicament' => $id_medicament,
                ':id_pds' => $id_pds,
                ':id_salarie' => $id_salarie
            ]);

        } catch (PDOException $e) {
            error_log("Erreur SQL - ajouterVisite : " . $e->getMessage());
            return false;
        }
    }




    /**
     * Met à jour une visite existante
     */
    public static function ModifierVisite(string $dateDuJour, int $idMedicament, int $idPds, int $idSalarie, string $commentaire): bool
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
    public static function supprimerVisite(string $dateDuJour, int $idMedicament, int $idPds, int $idSalarie): bool
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


// -----------    Pour le Délégué

    public static function getVisitesParRegion(int $idRegion): array
    {
        try {
            // Création d'une instance PDO
            $pdo = Singleton_ConnexionPDO::getInstance();

            // Préparer la requête SQL pour récupérer les visites liées à la même région que celle du délégué connecté
            $stmt = $pdo->prepare("
            SELECT v.*, p.nom_pds AS nom_pro, p.prenom_pds AS prenom_pro, p.adresse_pds AS adresse_pro, s.nom , s.prenom
            FROM visiter v
            INNER JOIN professionnels_de_sante p ON v.id_pds = p.id_pds
            INNER JOIN visiteur vi ON v.id_salarie = vi.id_salarie
            INNER JOIN salarie s ON v.id_salarie = s.id_salarie
            WHERE vi.id_region = :idRegion
        ");

            // Exécuter la requête avec l'ID de la région du délégué
            $stmt->execute([':idRegion' => $idRegion]);

            // Retourner les résultats sous forme de tableau
            return $stmt->fetchAll();
        } catch (\PDOException $e) {
            throw new \Exception("Erreur lors de la récupération des visites par région : " . $e->getMessage());
        }
    }
    public static function validerCompteRendu(array $cleVisite): void
    {
        try {
            $pdo = Singleton_ConnexionPDO::getInstance();
            $requete = $pdo->prepare("
            UPDATE visiter 
            SET validation = 1 
            WHERE date_du_jour = :date_du_jour 
              AND id_medicament = :id_medicament 
              AND id_pds = :id_pds 
              AND id_salarie = :id_salarie
        ");
            $requete->bindParam(':date_du_jour', $cleVisite['date_du_jour'], PDO::PARAM_STR);
            $requete->bindParam(':id_medicament', $cleVisite['id_medicament'], PDO::PARAM_INT);
            $requete->bindParam(':id_pds', $cleVisite['id_pds'], PDO::PARAM_INT);
            $requete->bindParam(':id_salarie', $cleVisite['id_salarie'], PDO::PARAM_INT);
            $requete->execute();
        } catch (\PDOException $e) {
            throw new \Exception("Erreur lors de la validation du compte-rendu : " . $e->getMessage());
        }
    }

}