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
    echo $typeConnexion;
} else {
    $typeConnexion = "visiteur";
}

//Identification de l'action demandée
if (isset($_REQUEST["action"]))
    $action = $_REQUEST["action"];
else
    $action = "Action_Par_Defaut";


// Redirection vers le controleur concerné
switch ($typeConnexion) {
    case "visiteur" :
        include "Controleur/Controleur_Users.php";
        break;
    default :
        echo "Probleme du type de connexion";

}

$Vue->afficher();

