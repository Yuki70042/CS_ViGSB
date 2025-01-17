<?php
error_log("page debut");
session_start();
include_once "vendor/autoload.php";

use App\Utilitaire\Vue;

// Charge le gestionnaire de vue
$Vue = new Vue();



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




// Redirection vers le controleur concerné
switch ($typeConnexion) {
    case "users" :
        include "Controleur/Controleur_Users.php";
        break;

    case "visiteurs":
        include "Controleur/Controleur_Visiteurs.php";
        break;

    case "DelegueRegional" :
        switch ($case) {

            case "Gerer_CompteRendu":
                include "Controleur/Controleur_Gestion_CompteRendu.php";
                break;

            case "Gerer_Praticiens":
                include "Controleur/Controleur_Gestion_Praticiens.php";
                break;

            case "Gerer_Visiteurs":
                include "Controleur/Controleur_Gestion_Visiteurs.php";
                break;

            case "Gerer_Visite":
                include "Controleur/Controleur_Gestion_Visites.php";
                break;

            default:
                $Vue->setMenu(new \App\Vue\Vue_Menu_DelegueRegional($_SESSION["id_salarie"]));
                break;
        }
        break;

    default :
        $Vue->addToCorps(new \App\Vue\Vue_AfficherMessage("Type de connexion non reconnu"));
    }



$Vue->afficher();

