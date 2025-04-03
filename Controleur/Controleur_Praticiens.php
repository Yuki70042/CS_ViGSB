<?php

use App\Modele\Modele_Praticiens;
use App\Modele\Modele_Regions;
use App\Vue\Vue_Praticiens_Liste;
use App\Vue\Vue_Praticiens_Formulaire;

switch ($action){

    case "voirListe":
        if ($_SESSION["typeConnexionBack"] === "delegue") {
            // Récupérer la liste des praticiens appartenant à la région du délégué
            $region = \App\Modele\Modele_Delegues::getRegionByDelegue($_SESSION["id_salarie"]);
            $idRegion = isset($region['id_region']) ? $region['id_region'] : null;
            $praticiens = Modele_Praticiens::getPraticienDeLaRegion($idRegion);
            $Vue->addToCorps(new Vue_Praticiens_Liste($praticiens));
        }
        if ($_SESSION["typeConnexionBack"] === "responsable") {
            $idSecteur = \App\Modele\Modele_Responsable::getSecteurByResponsable($_SESSION["id_salarie"]);
            $praticiens = Modele_Praticiens::getPraticiensDuSecteur($idSecteur);
            $Vue->addToCorps(new \App\Vue\Vue_Praticiens_Liste($praticiens));
        }
        break;

    case "ajouter":
        if ($_SESSION["typeConnexionBack"] === "delegue") {
            $region = \App\Modele\Modele_Delegues::getRegionByDelegue($_SESSION["id_salarie"]);
            $regionArray = [$region]; // $region devient un tableau avec un seul élément
            $Vue->addToCorps(new Vue_Praticiens_Formulaire(null, $regionArray));
        }
        if ($_SESSION["typeConnexionBack"] === "responsable") {
            // Formulaire d'ajout de praticien
            $idSecteur = \App\Modele\Modele_Responsable::getSecteurByResponsable($_SESSION["id_salarie"]);
            $regions = \App\Modele\Modele_Regions::getRegionsDuSecteur($idSecteur);
            $Vue->addToCorps(new Vue_Praticiens_Formulaire(null, $regions));
        }
        break;

    case "traiterAjout":
        var_dump($_POST);
        //$region = \App\Modele\Modele_Delegues::getRegionByDelegue($_SESSION["id_salarie"]);

        $region_id = isset($_POST["id_region"]) ? (int)$_POST["id_region"] : null;
        var_dump($region_id);
        // Ajouter un nouveau praticien
        if (isset($_POST['nom_pds'], $_POST['prenom_pds'], $_POST['age_pds'], $_POST['metier'], $_POST['adresse_pds'], $_POST['CP_pds'], $_POST['ville_pds'], $region_id)) {
            Modele_Praticiens::ajouterPraticien(
                $_POST['nom_pds'],
                $_POST['prenom_pds'],
                $_POST['age_pds'],
                $_POST['metier'],
                $_POST['adresse_pds'],
                $_POST['CP_pds'],
                $_POST['ville_pds'],
                $region_id
            );

            // Message de confirmation
            $_SESSION['message'] = "Le praticien a bien été ajouté.";
        }

        header("Location: index.php?case=Gerer_Praticiens&action=voirListe");
        exit;

    case "modifier":
        if ($_SESSION["typeConnexionBack"] === "delegue") {
            if (isset($_GET['id_pds'])) {
                $region = \App\Modele\Modele_Delegues::getRegionByDelegue($_SESSION["id_salarie"]);
                $regionArray = [$region]; // $region devient un tableau avec un seul élément
                $praticien = Modele_Praticiens::getPraticienById($_GET['id_pds']);
                $Vue->addToCorps(new Vue_Praticiens_Formulaire($praticien, $regionArray));
            }
        }
        if ($_SESSION["typeConnexionBack"] === "responsable") {
            // Charger le formulaire de modification avec les données existantes
            if (isset($_GET['id_pds'])) {
                $idSecteur = \App\Modele\Modele_Responsable::getSecteurByResponsable($_SESSION["id_salarie"]);
                $regions = \App\Modele\Modele_Regions::getRegionsDuSecteur($idSecteur);
                $praticien = Modele_Praticiens::getPraticienById($_GET['id_pds']);
                $Vue->addToCorps(new Vue_Praticiens_Formulaire($praticien, $regions));
            }
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