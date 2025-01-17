<?php

use App\Modele\Modele_Salarie;
use App\Vue\Vue_Structure_Entete;
use App\Vue\Vue_Connexion_Formulaire_Users;
use App\Vue\Vue_Mail_Confirme;
use App\Vue\Vue_Mail_ReinitMdp;
use App\Vue\Vue_Menu_Visiteur;


$Vue->setEntete(new Vue_Structure_Entete());

switch ($action){

    case 1:
        break;

    case "2":

        break;

    default:
        // Lors de la première connexion - lorsque l'action n'est pas définis
        echo("Controleur Compte-Rendu initialisé");

        break;
}
