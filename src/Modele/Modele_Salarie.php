<?php

namespace App\Modele;
use App\Utilitaire\Singleton_ConnexionPDO;
use PDO;

class Modele_Salarie
{

    static function Utilisateur_Select_ParLogin($email)
        // Fonction permettant de retrouver l'utilisateur en fonction de ses logins
    {
        try {

            // Étape 1 : Connexion à la base
            $connexionPDO = Singleton_ConnexionPDO::getInstance();

            // Étape 2 : Préparation de la requête
            $requetePreparee = $connexionPDO->prepare(
                'SELECT * FROM `salarie` WHERE email = :paramLogin');

            // Étape 3 : Liaison des paramètres
            $requetePreparee->bindParam(':paramLogin', $email, PDO::PARAM_STR);

            // Étape 4 : Exécution de la requête
            $requetePreparee->execute();
            // echo "Requête exécutée avec succès<br>";

            // Étape 5 : Récupération des données
            $utilisateur = $requetePreparee->fetch(PDO::FETCH_ASSOC);

            return $utilisateur;

        } catch (PDOException $e) {
            throw new Exception("Erreur lors de la recherche de l'utilisateur : " . $e->getMessage());
        }
    }


    public static function ajouterSalarie(string $nom, string $prenom, string $email, string $mdp, int $age, string $adresse, string $type_utilisateur): int
    {
        try {
            $pdo = Singleton_ConnexionPDO::getInstance();
            $stmt = $pdo->prepare(
                'INSERT INTO salarie (nom, prenom, email, mot_de_passe, age, adresse, type_utilisateur)
                 VALUES (:nom, :prenom, :email, :mdp, :age, :adresse, :type_utilisateur)'
            );
            $stmt->execute([
                ':nom' => $nom,
                ':prenom' => $prenom,
                ':email' => $email,
                ':mdp' => $mdp,
//                ':mdp' => password_hash($mdp, PASSWORD_DEFAULT), // Hash du mot de passe
                ':age' => $age,
                ':adresse' => $adresse,
                ':type_utilisateur' => $type_utilisateur
            ]);

            // Retourne l'id du salarié inséré
            return $pdo->lastInsertId();

        } catch (\PDOException $e) {
            throw new \Exception("Erreur lors de l'ajout du salarié : " . $e->getMessage());
        }
    }

    public static function getSalarieById(int $idSalarie): array {

        $pdo = Singleton_ConnexionPDO::getInstance();
        $stmt = $pdo->prepare('SELECT * FROM salarie WHERE id_salarie = :id');
        $stmt->execute([':id' => $idSalarie]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function modifierSalarie(int $idSalarie, string $nom, string $prenom, string $email, int $age, string $adresse): void {
        $pdo = Singleton_ConnexionPDO::getInstance();
        $stmt = $pdo->prepare(
            'UPDATE salarie SET nom = :nom, prenom = :prenom, email = :email, age = :age, adresse = :adresse WHERE id_salarie = :id'
        );
        $stmt->execute([
            ':nom' => $nom,
            ':prenom' => $prenom,
            ':email' => $email,
            ':age' => $age,
            'adresse' => $adresse,
            ':id' => $idSalarie
        ]);
    }

    public static function supprimerSalarie(int $idSalarie): void {

        $pdo = Singleton_ConnexionPDO::getInstance();
        $stmt = $pdo->prepare('DELETE FROM salarie WHERE id_salarie = :id');
        $stmt->execute([':id' => $idSalarie]);

    }





}

