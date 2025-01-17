<?php

use App\Modele\Modele_Visites;
use App\Vue\Vue_Affichage_Visites;
use App\Vue\Vue_Formulaire_Visites;
use App\Vue\Vue_Structure_Entete;
use App\Vue\Vue_Connexion_Formulaire_Users;
use App\Vue\Vue_Mail_Confirme;
use App\Vue\Vue_Mail_ReinitMdp;
use App\Vue\Vue_Menu_Visiteur;


$Vue->setEntete(new Vue_Structure_Entete());

switch ($action) {
    case "gestionVisites":
        // Vérifie si l'utilisateur est connecté
        if (!isset($_SESSION["id_salarie"])) {
            die("Vous n'êtes pas connecté.");
        }
        // Récupère l'ID utilisateur du délégué connecté
        $idUtilisateur = $_SESSION["id_salarie"];

        // Récupère les visites pour cet utilisateur
        $visites = Modele_Visites::Visites_Par_Delegue($idUtilisateur);

        // Affiche la vue avec toutes les visites du délégué
        $Vue->addToCorps(new \App\Vue\Vue_Affichage_Visites($visites));
        break;

    case "creerVisite":
        // Redirige vers le formulaire de création
        $Vue->addToCorps(new Vue_Formulaire_Visites());
        break;

    case "modifierVisite":
        // Récupérer les données pour une visite spécifique
        $idPDS = $_REQUEST["id"] ?? null;
        $dateVisite = $_REQUEST["date"] ?? null;

        // Charge un formulaire avec les informations existantes (à compléter)
        $Vue->addToCorps(new Vue_Formulaire_Visite($idPDS, $dateVisite));
        break;

    case "retour":
    default:
        $visites = Modele_Visites::Visites_Par_Delegue($_SESSION["id_salarie"]);
        $Vue->setEntete(new Vue_Structure_Entete());
        $Vue->addToCorps(new Vue_Affichage_Visites($visites));
        break;
}