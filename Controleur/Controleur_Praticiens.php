<?php

use App\Modele\Modele_Praticiens;
use App\Vue\Vue_Praticiens_Liste;
use App\Vue\Vue_Praticiens_Formulaire;

switch ($action){

    case "voirListe":
        // Récupérer la liste des praticiens
        $region = \App\Modele\Modele_Delegues::getRegionByDelegue($_SESSION["id_salarie"]);
        $praticiens = Modele_Praticiens::getPraticienDeLaRegion($region);
        $Vue->addToCorps(new Vue_Praticiens_Liste($praticiens));
        break;

    case "ajouter":
        // Formulaire d'ajout de praticien
        $Vue->addToCorps(new Vue_Praticiens_Formulaire());
        break;

    case "traiterAjout":
        $region = \App\Modele\Modele_Delegues::getRegionByDelegue($_SESSION["id_salarie"]);
        // Ajouter un nouveau praticien
        if (isset($_POST['nom_pds'], $_POST['prenom_pds'], $_POST['age_pds'], $_POST['metier'], $_POST['adresse_pds'], $_POST['CP_pds'], $_POST['ville_pds'], $region)) {
            Modele_Praticiens::ajouterPraticien(
                $_POST['nom_pds'],
                $_POST['prenom_pds'],
                $_POST['age_pds'],
                $_POST['metier'],
                $_POST['adresse_pds'],
                $_POST['CP_pds'],
                $_POST['ville_pds'],
                $region
            );

            // Message de confirmation
            $_SESSION['message'] = "Le praticien a bien été ajouté.";
        }

        header("Location: index.php?case=Gerer_Praticiens&action=voirListe");
        exit;

    case "modifier":
        // Charger le formulaire de modification avec les données existantes
        if (isset($_GET['id_pds'])) {
            $praticien = Modele_Praticiens::getPraticienById($_GET['id_pds']);
            $Vue->addToCorps(new Vue_Praticiens_Formulaire($praticien));
        }
        break;

    case "traiterModification":
        echo("traitement de la modification");
        // Modifier un praticien existant
        if (isset($_POST['id_pds'], $_POST['nom_pds'], $_POST['prenom_pds'], $_POST['age_pds'], $_POST['metier'], $_POST['adresse_pds'], $_POST['CP_pds'], $_POST['ville_pds'])) {
            Modele_Praticiens::modifierPraticien(
                $_POST['id_pds'],
                $_POST['nom_pds'],
                $_POST['prenom_pds'],
                $_POST['age_pds'],
                $_POST['metier'],
                $_POST['adresse_pds'],
                $_POST['CP_pds'],
                $_POST['ville_pds']
            );
            // Message de confirmation
            $_SESSION['message'] = "La modification a bien été effectuée.";
        }
        header("Location: index.php?case=Gerer_Praticiens&action=voirListe");
        break;

    case "supprimer":
        // Supprimer un praticien
        if (isset($_GET['id_pds'])) {
            Modele_Praticiens::supprimerPraticien($_GET['id_pds']);
        }

        header("Location: index.php?case=Gerer_Praticiens&action=voirListe");
        break;

    case "deconnexion":
        // Déconnexion de l'utilisateur
        session_destroy();
        header("Location: index.php");
        break;

    default:
        $Vue->addToCorps(new \App\Vue\Vue_AfficherMessage("Action non reconnue pour les praticiens"));
        break;
}