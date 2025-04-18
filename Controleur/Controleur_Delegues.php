<?php

use App\Modele\Modele_Salarie;
use App\Modele\Modele_Visiteurs;
use App\Vue\Vue_Visiteurs_Liste;
use App\Vue\Vue_Visiteurs_Formulaire;
use App\Vue\Vue_Delegues_Liste;
use App\Vue\Vue_Delegues_Formulaire;
use App\Modele\Modele_Delegues;

// Identification de l'action demandée
$action = $_REQUEST["action"] ?? "voirListe";


switch ($action) {
    case "voirListe":
        // Récupérer les visiteurs sous supervision
        $secteur = \App\Modele\Modele_Responsable::getSecteurByResponsable($_SESSION["id_salarie"]);
        $delegues = \App\Modele\Modele_Delegues::getDeleguesSousSupervision($secteur);
        $Vue->addToCorps(new Vue_Delegues_Liste($delegues));
        break;

    case "ajouter":
        // Formulaire d'ajout de visiteur
        $secteur = \App\Modele\Modele_Responsable::getSecteurByResponsable($_SESSION["id_salarie"]);
        $regions = \App\Modele\Modele_Regions::getRegionsDuSecteur($secteur);
        $Vue->addToCorps(new Vue_Delegues_Formulaire(null, $regions));
        break;

    case "traiterAjout":
        // Vérifier que les champs requis sont présents
        if (isset($_POST['nom'], $_POST['prenom'], $_POST['email'], $_POST['mdp'], $_POST['age'], $_POST['adresse'])) {
            // Ajouter le Délégués
            $idSalarie = Modele_Salarie::ajouterSalarie(
                $_POST['nom'],
                $_POST['prenom'],
                $_POST['email'],
                $_POST['mdp'],
                $_POST['age'],
                $_POST['adresse'],
                "delegue"
            );

            $secteur = \App\Modele\Modele_Responsable::getSecteurByResponsable($_SESSION["id_salarie"]);
            // Ajouter le délégué avec la région sélectionnée
            Modele_Delegues::ajouterDelegues(
                $idSalarie,               // ID du salarié ajouté
                $_POST['region']         // ID de la région sélectionnée
            );
        }
        header("Location: index.php?case=Gerer_Delegues&action=voirListe");
        break;

    case "modifier":
        var_dump($_GET['id_salarie']);
        if (isset($_GET['id_salarie'])) {
            $idSalarie = $_GET['id_salarie'];
            // Charger le secteur et les régions
            $secteur = \App\Modele\Modele_Responsable::getSecteurByResponsable($_SESSION["id_salarie"]);
            $regions = \App\Modele\Modele_Regions::getRegionsDuSecteur($secteur);
            // Charger les informations du salarié avec l'ID passé en paramètre
            $salarie = Modele_Salarie::getSalarieById($idSalarie);
            $Vue->addToCorps(new Vue_Delegues_Formulaire($salarie, $regions));
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

        header("Location: index.php?case=Gerer_Delegues&action=voirListe");
        exit;

    case "supprimer":
        // Supprimer un salarié et son lien avec visiteur
        if (isset($_GET['id_salarie'])) {
            Modele_Salarie::supprimerSalarie($_GET['id_salarie']);
        }
        header("Location: index.php?case=Gerer_Delegues&action=voirListe");
        exit;

    case "deconnexion":
        // Déconnexion de l'utilisateur
        session_destroy();
        header("Location: index.php");
        exit;

    default:
        $Vue->addToCorps(new \App\Vue\Vue_AfficherMessage("Action non reconnue pour les visiteurs"));
}
