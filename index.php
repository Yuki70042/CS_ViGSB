<?php
error_log("page debut");
session_start();
include_once "vendor/autoload.php";

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);



use App\Utilitaire\Vue;
use App\Modele\Modele_Visites;
use App\Modele\Modele_Praticiens;
use App\Controleur\Controleur_Visiteurs;
use App\Vue\Vue_Visites_Liste;
use App\Vue\Vue_Structure_Entete;


// Charge le gestionnaire de vue
$Vue = new Vue();
$Vue->setEntete(new Vue_Structure_Entete());


// Identification du type de connexion
if (isset($_SESSION["typeConnexionBack"])) {
    $typeConnexion = $_SESSION["typeConnexionBack"];

} else {
    $typeConnexion = "users";
}

//Identification du cas demandé (situation)
if (isset($_REQUEST["case"]))
    $case = $_REQUEST["case"];
else
    $case = "Cas_Par_Defaut";

//Identification de l'action demandée
if (isset($_REQUEST["action"]))
    $action = $_REQUEST["action"];
else
    $action = "Action_Par_Defaut";

// Pour suivis des redirections
echo("case: ".$case);
echo("\n- action: ".$action);


// Redirection vers le controleur concerné
switch ($typeConnexion) {
    // Première connexion
    case "users" :
        include "Controleur/Controleur_Users.php";
        break;

    case "visiteur":
        switch ($case) {
            case "menuPrincipal":
                $Vue->addToCorps(new \App\Vue\Vue_Menu_Visiteur()); // Nouvelle vue pour le menu principal
                break;

            case "deconnexion" :
                // Déconnexion de l'utilisateur
                session_destroy();
                header("Location: index.php");
                exit;

            default:
                include "Controleur/Controleur_Visite.php";
                break;
        }
        break;


    case "delegue" :
        switch ($case) {

            case "menuPrincipal":
                $Vue->addToCorps(new \App\Vue\Vue_Menu_DelegueRegional($typeConnexion));
                break;

            case "Gerer_Praticiens":
                include "Controleur/Controleur_Praticiens.php";
                break;

            case "Gerer_Visiteurs":
                include "Controleur/Controleur_Visiteurs.php";
                break;

            case "Gerer_Visites":
                include "Controleur/Controleur_Visite.php";
                break;

            case "deconnexion":
                // Déconnexion de l'utilisateur
                session_destroy();
                header("Location: index.php");
                exit;

            default:
                $Vue->setMenu(new \App\Vue\Vue_Menu_DelegueRegional($_SESSION["id_salarie"]));
                break;
        }
        break;

    case "responsable":
        switch ($case) {
            case "menuPrincipal":
                $Vue->addToCorps(new \App\Vue\Vue_Menu_ResponsableSecteur($typeConnexion));
                break;

            case "Gerer_Praticiens":
                include "Controleur/Controleur_Praticiens.php";
                break;

            case "Gerer_Visiteurs":
                include "Controleur/Controleur_Visiteurs.php";
                break;

            case "Gerer_Delegues":
                include "Controleur/Controleur_Delegues.php";
                break;

            case "Gerer_Visites":
                include "Controleur/Controleur_Visite.php";
                break;

            case "Gerer_Medicaments":
                include "Controleur/Controleur_Medicaments.php";
                break;

            case "deconnexion":
                // Déconnexion de l'utilisateur
                session_destroy();
                header("Location: index.php");
                exit;

            default:
                $Vue->setMenu(new \App\Vue\Vue_Menu_ResponsableSecteur($_SESSION["id_salarie"]));
                break;
            }
            break;

    default :
        $Vue->addToCorps(new \App\Vue\Vue_AfficherMessage("Type de connexion non reconnu"));
    }

$Vue->afficher();

