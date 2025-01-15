<?php

use App\Modele\Modele_Salarie;
use App\Vue\Vue_Structure_Entete;
use App\Vue\Vue_Connexion_Formulaire_Users;
use App\Vue\Vue_Mail_Confirme;
use App\Vue\Vue_Mail_ReinitMdp;
use App\Vue\Vue_Menu_Visiteur;


$Vue->setEntete(new Vue_Structure_Entete());

switch ($action){

    case "reinitmdpconfirm":
        $Vue->addToCorps(new Vue_Mail_Confirme());
        break;

    case "reinitmdp":
        $Vue->addToCorps(new Vue_Mail_ReinitMdp());
        break;

    case "Se connecter" :

        if (isset($_REQUEST["email"]) and isset($_REQUEST["password"])) {
            //Si tous les paramètres du formulaire sont bons
            // Alors on récupère les données de la base salarié
            $utilisateur = Modele_Salarie::Utilisateur_Select_ParLogin($_REQUEST["email"]);

            if ($utilisateur != NULL) {

                if ($_REQUEST["password"] == $utilisateur["mot_de_passe"]) {
                    // echo("user et mdp correctement trouvé dans la bdd");

                    // On définit alors l'utilisateur qu'il s'agit, et son type.
                    $_SESSION["id_salarie"] = $utilisateur["id_salarie"];
                    $_SESSION["type_utilisateur"] = $utilisateur["type_utilisateur"];

                    // En fonction du type de l'utilisateur (rôle) on affiche une page distinct:
                    switch ($utilisateur["type_utilisateur"]) {
                        case 0:
                            $_SESSION["typeConnexionBack"] = "administrateur";
                            echo('Session administrateur');
                            break;
                        case 1:
                            $_SESSION["typeConnexionBack"] = "visiteur";
                            echo('Session visiteur');
                            $Vue->addToCorps(new Vue_Menu_Visiteur($_SESSION["id_salarie"]));
                            break;
                        case 2:
                            $_SESSION["typeConnexionBack"] = "DelegueRegional";
                            echo('Session Delegue Regional');
                            break;

                        case 3:
                            $_SESSION["typeConnexionBack"] = "ResponsableSecteur";
                            echo('Session Responsable Secteur');
                            break;
                    }

                }
                // Si le mot de passe n'est pas lié à ce mail dans la bdd
                else {
                    echo('identifiant ou mdp incorrecte');
                }
            }

        }
    default:
        // Lors de la première connexion - lorsque l'action n'est pas définis
        $Vue->addToCorps(new Vue_Connexion_Formulaire_Users());
        break;

}
