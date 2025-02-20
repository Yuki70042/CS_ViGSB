<?php

use App\Vue\Vue_Medicaments_Formulaire;
use App\Vue\Vue_Medicaments_Liste;
use App\Vue\Vue_Menu_ResponsableSecteur;


switch ($action){

    case "voirListe":
        // Récupérer la liste des praticiens
        $medicaments = \App\Modele\Modele_Medicaments::getTousMedicaments();
        $Vue->addToCorps(new Vue_Medicaments_Liste($medicaments));
        break;

    case "ajouter":
        // Formulaire d'ajout de praticien
        $Vue->addToCorps(new Vue_Medicaments_Formulaire());
        break;

    case "traiterAjout":
        // Ajouter un nouveau Médicament
        if (isset($_POST['designation'], $_POST['prix'])) {
            $prix = (float) $_POST['prix'];

            \App\Modele\Modele_Medicaments::ajouterMedicament($_POST['prix'],$_POST['designation']);

            // Message de confirmation
            $_SESSION['message'] = "Le Médicament a bien été ajouté.";
        }
        header("Location: index.php?case=Gerer_Medicaments&action=voirListe");
        exit;

    case "modifier":
        // Charger le formulaire de modification avec les données existantes
        if (isset($_GET['id_medicament'])) {
            $medicament = \App\Modele\Modele_Medicaments::getMedicamentById($_GET['id_medicament']);
            $Vue->addToCorps(new Vue_Medicaments_Formulaire($medicament));
        }
        break;

    case "traiterModification":
        echo("traitement de la modification");
        // Modifier un praticien existant
        if (isset($_POST['id_medicament'], $_POST['prix'], $_POST['designation'])) {
            \App\Modele\Modele_Medicaments::modifierMedicament(
                $_POST['id_medicament'],
                $_POST['prix'],
                $_POST['designation']
            );
            // Message de confirmation
            $_SESSION['message'] = "La modification a bien été effectuée.";
        }
        header("Location: index.php?case=Gerer_Medicaments&action=voirListe");
        break;

    case "supprimer":
        // Supprimer un praticien
        if (isset($_GET['id_medicament'])) {
            \App\Modele\Modele_Medicaments::supprimerMedicament($_GET['id_medicament']);
        }
        header("Location: index.php?case=Gerer_Medicaments&action=voirListe");
        break;


    default:
        $Vue->addToCorps(new \App\Vue\Vue_AfficherMessage("Action non reconnue pour les Médicaments"));
        break;
}