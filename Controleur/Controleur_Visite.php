<?php

use App\Modele\Modele_Praticiens;
use App\Modele\Modele_Visites;
use App\Modele\Modele_Delegues;
use App\Vue\Vue_Visites_Liste;
use App\Vue\Vue_VisitesRegion_Liste;
use App\Vue\Vue_CompteRendu_Formulaire;
use App\Vue\Vue_Structure_Entete;
use App\Vue\Vue_Visite_Formulaire;

$Vue->setEntete(new Vue_Structure_Entete());

// Identification de l'action demandée
$action = $_REQUEST["action"] ;

switch ($action) {

    // Section Visiteur
    case "voirVisitesRegion":

        // Si la personne est délégué
        if ($_SESSION["typeConnexionBack"] === "delegue") {
            // Récupérer les régions du délégué connecté
            $idRegion = Modele_Delegues::getRegionByDelegue($_SESSION["id_salarie"]);

            // Récupérer les visites pour toutes les régions du délégué
            $visitesSansCR = Modele_Visites::getVisitesEnAttenteCompteRendu($idRegion);
            $visitesEnAttenteValidation = Modele_Visites::getVisitesEnAttenteValidation($idRegion);
            $Vue->addToCorps(new \App\Vue\Vue_VisitesRegion_Liste($visitesSansCR, $visitesEnAttenteValidation));
        }

        // Si la personne est responsable
        if ($_SESSION["typeConnexionBack"] === "responsable") {
            // Récupérer le secteur du responsable connecté
            $idSecteur = \App\Modele\Modele_Responsable::getSecteurByResponsable($_SESSION["id_salarie"]);

            // Récupérer les visites des régions supervisé par le responsable
            $regions = Modele_Visites::getRegionsDuSecteur($idSecteur);
            $visites = Modele_Visites::getVisitesParRegion($regions);
            $Vue->addToCorps(new \App\Vue\Vue_VisitesRegion_Liste($visites));
        }
        break;



        // Permet aux visiteurs de voir les visites qui lui sont actuellement en cours
    case "voirVisites":
        $visites = Modele_Visites::getVisitesParSalarie($_SESSION["id_salarie"]);
        $Vue->addToCorps(new Vue_Visites_Liste($visites));
        break;

    case "historique": // Menu de consultation des visites déjà validé
        $visites = Modele_Visites::getVisitesHistoriqueParSalarie($_SESSION["id_salarie"]);
        $Vue->addToCorps(new Vue_Visites_Liste($visites));
        break;




    case "editer":
        if (isset($_GET['date'], $_GET['id_medicament'], $_GET['id_pds'])) {
            $cleVisite = [
                'date' => $_GET['date'],
                'id_medicament' => $_GET['id_medicament'],
                'id_pds' => $_GET['id_pds'],
                'id_salarie' => $_SESSION['id_salarie']
            ];
            $compteRendu = ""; // Charge le compte-rendu actuel si existant
            $Vue->addToCorps(new Vue_CompteRendu_Formulaire($cleVisite, $compteRendu));
        }
        break;


        // Permet au visiteur de modifier son compte rendu
    case "modifier":
        if (isset($_POST['date'], $_POST['id_medicament'], $_POST['id_pds'], $_POST['compte_rendu'])) {
            $cleVisite = [
                'date' => $_POST['date'],
                'id_medicament' => $_POST['id_medicament'],
                'id_pds' => $_POST['id_pds'],
                'id_salarie' => $_SESSION['id_salarie']
            ];
            $texteCompteRendu = $_POST['compte_rendu'];
            Modele_Visites::updateCompteRendu($cleVisite, $texteCompteRendu);

            // Redirection vers la liste des visites
            header("Location: index.php?case=visiteur&action=voirVisites");
            exit;
        }
        break;


        // Renvoie vers le formulaire de création de visite
    case "ajouterVisite":
        $idRegion = Modele_Delegues::getRegionByDelegue($_SESSION["id_salarie"]);
        $visiteurs = \App\Modele\Modele_Visiteurs::getVisiteursSousSupervision($_SESSION["id_salarie"]);
        $praticiens = Modele_Praticiens::getPraticienDeLaRegion($idRegion);
        $medicaments = \App\Modele\Modele_Medicaments::getTousMedicaments();
        $Vue->addToCorps(new \App\Vue\Vue_Visite_Formulaire($visiteurs, $praticiens, $medicaments));
        break;

    // Permet d'envoyer la requête de création de visite vers la bdd
    case "traiterAjout":

        if (isset($_POST['salarie'], $_POST['praticien'], $_POST['date'], $_POST['heure'], $_POST['medicament'])) {

            $date_du_jour = $_POST['date'];
            $heure_du_rdv = $_POST['heure'];
            $salarie = $_POST['salarie'];
            $praticien = $_POST['praticien'];
            $medicament = $_POST['medicament'];

            if (!Modele_Visites::dateVisiteExiste($date_du_jour, $heure_du_rdv)) {
                Modele_Visites::ajouterDateVisite($date_du_jour, $heure_du_rdv);
            }

            $ajoutReussi = Modele_Visites::ajouterVisite($date_du_jour, $medicament, $praticien, $salarie);

            if ($ajoutReussi) {
                error_log("Visite ajoutée avec succès !");
            } else {
                error_log("Erreur lors de l'ajout de la visite.");
            }
        } else {
            error_log("Paramètres manquants.");
            exit("Erreur : Paramètres manquants.");
        }
        header("Location: index.php?case=Gerer_Visites&action=voirVisitesRegion");
        exit;



    // Permet au délégué de valider un compte-rendu
    case "valider":
        echo("demande validation");
        // Vérification si les paramètres sont bien présents
        $date_du_jour = $_REQUEST['date_du_jour'] ?? null;
        $id_medicament = $_REQUEST['id_medicament'] ?? null;
        $id_pds = $_REQUEST['id_pds'] ?? null;
        $id_salarie = $_REQUEST['id_salarie'] ?? null;

        if ($date_du_jour && $id_medicament && $id_pds && $id_salarie) {
            $cleVisite = [
                'date_du_jour' => $date_du_jour,
                'id_medicament' => $id_medicament,
                'id_pds' => $id_pds,
                'id_salarie' => $id_salarie
            ];

            try {
                Modele_Visites::validerCompteRendu($cleVisite);
                echo "Compte-rendu validé avec succès.";
            } catch (\Exception $e) {
                echo "Erreur lors de la validation du compte-rendu : " . $e->getMessage();
            }

            // Redirection vers la liste des visites
            header("Location: index.php?case=Gerer_Visites&action=voirVisites");
            exit;

        } else {
            echo "Paramètres manquants : vérifiez que date_du_jour, id_medicament et id_pds sont bien transmis.";
        }
        break;



    default:
        $Vue->addToCorps(new \App\Vue\Vue_AfficherMessage("Action non reconnue dans le Controleur visite"));
}