<?php

use App\Modele\Modele_Salarie;
use App\Modele\Modele_Visiteurs;
use App\Vue\Vue_Visiteurs_Liste;
use App\Vue\Vue_Visiteurs_Formulaire;

// Identification de l'action demandée
$action = $_REQUEST["action"] ?? "voirListe";


switch ($action) {
    case "voirListe":
        if ($_SESSION["typeConnexionBack"] == "responsable"){
            $visiteurs = Modele_Visiteurs::getVisiteurs();
            $Vue->addToCorps(new Vue_Visiteurs_Liste($visiteurs));
        }else{
            // Récupérer les visiteurs sous supervision
            $visiteurs = Modele_Visiteurs::getVisiteursSousSupervision($_SESSION["id_salarie"]);
            $Vue->addToCorps(new Vue_Visiteurs_Liste($visiteurs));
        }
        break;

    case "ajouter":
        // Formulaire d'ajout de visiteur
        $Vue->addToCorps(new Vue_Visiteurs_Formulaire());
        break;

    case "traiterAjout":
        // Ajouter un nouveau visiteur
        if (isset($_POST['nom'], $_POST['prenom'], $_POST['email'], $_POST['mdp'], $_POST['age'], $_POST['adresse'])) {
            $idSalarie = Modele_Salarie::ajouterSalarie(
                $_POST['nom'],
                $_POST['prenom'],
                $_POST['email'],
                $_POST['mdp'],
                $_POST['age'],
                $_POST['adresse'],
                "visiteur"
            );

            Modele_Visiteurs::ajouterVisiteur(
                $_SESSION["id_salarie"], // Delegue actuellement connecté
                $idSalarie // id de la personne de la table salarie que l'on va ajouté dans visiteur
            );
        }
        header("Location: index.php?case=Gerer_Visiteurs&action=voirListe");
        break;

    case "modifier":
        // Charger le formulaire de modification avec les données existantes
        if (isset($_GET['id_salarie'])) {
            $salarie = Modele_Salarie::getSalarieById($_GET['id_salarie']);
            $Vue->addToCorps(new Vue_Visiteurs_Formulaire($salarie));
        }
        break;

    case "traiterModification":
        // Modifier un salarié existant
        if (isset($_POST['id_salarie'], $_POST['nom'], $_POST['prenom'], $_POST['email'], $_POST['age'], $_POST['adresse'])) {
            Modele_Salarie::modifierSalarie(
                $_POST['id_salarie'],
                $_POST['nom'],
                $_POST['prenom'],
                $_POST['email'],
                $_POST['age'],
                $_POST['adresse']
            );

            // Ajout d'un message de confirmation
            $_SESSION['message'] = "La modification a bien été effectuée.";
        }

        header("Location: index.php?case=Gerer_Visiteurs&action=voirListe");
        exit;

    case "supprimer":
        // Supprimer un salarié et son lien avec visiteur
        if (isset($_GET['id_salarie'])) {
            Modele_Salarie::supprimerSalarie($_GET['id_salarie']);
        }
        header("Location: index.php?case=Gerer_Visiteurs&action=voirListe");
        exit;

    case "deconnexion":
        // Déconnexion de l'utilisateur
        session_destroy();
        header("Location: index.php");
        exit;

    default:
        $Vue->addToCorps(new \App\Vue\Vue_AfficherMessage("Action non reconnue pour les visiteurs"));
}
