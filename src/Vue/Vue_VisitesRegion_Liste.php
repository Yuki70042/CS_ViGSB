<?php
namespace App\Vue;
use App\Utilitaire\Vue_Composant;

class Vue_VisitesRegion_Liste extends Vue_Composant
{
    private array $visitesSansCR;
    private array $visitesEnAttenteValidation;

    public function __construct(array $visitesSansCR, array $visitesEnAttenteValidation) {
        $this->visitesSansCR = $visitesSansCR;
        $this->visitesEnAttenteValidation = $visitesEnAttenteValidation;
    }

    public function donneTexte(): string
    {
        $titre = ($_SESSION["typeConnexionBack"] === "responsable") ? "Visites du Secteur" : "Visites de la Région";

        $html = "
            <link rel='stylesheet' href='../../public/css/Visites_Liste.css'> 
            <h1>$titre</h1>";

        $html .= "
            <!-- Conteneur des boutons -->
            <div class='button-container'>
            
                <!-- Bouton Retour -->
                <form class='button-retour' method='GET' action='index.php'>
                    <input type='hidden' name='action' value=''>
                    <input type='hidden' name='case' value='menuPrincipal'>
                    <button type='submit'>Retour au menu principal</button>
                </form>
            
                <!-- Bouton Création d'une Visite -->
                <form class='button-creer' method='GET' action='index.php'>
                    <input type='hidden' name='action' value='ajouterVisite'>
                    <input type='hidden' name='case' value='Gerer_Visites'>
                    <button type='submit'>Organiser une Visite</button>
                </form>
            </div>";

        // Conteneur des colonnes pour les visites
        $html .= "<div class='visites-container'>";

        // Colonne des visites sans compte-rendu
        $html .= "<div class='visites-col-gauche'>
                    <h2>Visites sans compte-rendu</h2>";

        foreach ($this->visitesSansCR as $visite) {
            $html .= $this->afficherVisite($visite);
        }

        $html .= "</div>"; // fin de la colonne des visites sans CR

        // Colonne des visites en attente de validation
        $html .= "<div class='visites-col-droite'>
                    <h2>Visites en attente de validation</h2>";

        foreach ($this->visitesEnAttenteValidation as $visite) {
            $html .= $this->afficherVisite($visite);
        }

        $html .= "</div>"; // fin de la colonne des visites en attente

        $html .= "</div>"; // fin du conteneur principal

        // Définition de l'action pour l'historique des visites en fonction du type de connexion
        $actionHistorique = ($_SESSION["typeConnexionBack"] === "responsable") ? "historiqueVisitesParSecteur" : "historiqueVisitesParRegion";

        $html .= "
            <!-- Bouton vers l'historique des visites validés -->
            <form class='historiqueVisites' method='GET' action='index.php'>
                <input type='hidden' name='action' value='$actionHistorique'>
                <input type='hidden' name='case' value='Gerer_Visites'>
                <button type='submit'>Historique des précédentes visites</button>
            </form>";

        return $html;
    }

    // Fonction pour afficher une visite
    private function afficherVisite($visite): string
    {
        // Vérifie si un compte-rendu existe
        $compteRenduExistant = !empty($visite['commentaire']);
        $validationEffectuee = !empty($visite['validation']) && $visite['validation'] == 1;
        $buttonAction = null;

        if ($validationEffectuee) {
            $buttonText = "Visite validée";
            $buttonClass = "btn-validee";
            $buttonDisabled = "disabled";
        } elseif ($compteRenduExistant) {
            $buttonText = "Valider le compte-rendu";
            $buttonClass = "btn-modifier";
            $buttonAction = "valider";
            $buttonDisabled = "";
        } else {
            $buttonText = "Compte-rendu non rédigé";
            $buttonClass = "btn-rediger";
            $buttonDisabled = "disabled";
        }

        $editLink = $buttonAction ?
            "index.php?case=Gerer_Visites&action=$buttonAction" .
            "&date_du_jour=" . urlencode($visite['date_du_jour']) .
            "&id_pds=" . urlencode($visite['id_pds']) .
            "&id_medicament=" . urlencode($visite['id_medicament']) .
            "&id_salarie=" . urlencode($visite['id_salarie']) :
            "#";

        return "
            <div class='visite'>
                <div class='info-gauche'>
                    <strong>Visiteur :</strong> " . htmlspecialchars($visite['nom']) . " " . htmlspecialchars($visite['prenom']) . "<br>
                    <strong>Médecin :</strong> " . htmlspecialchars($visite['nom_pro']) . "<br>
                    <strong>Adresse :</strong> " . htmlspecialchars($visite['adresse_pro']) . "<br>
                    <strong>Date :</strong> " . htmlspecialchars($visite['date_du_jour']) . "<br>
                    <strong>Commentaire :</strong> " . htmlspecialchars($visite['commentaire'] ?? "Aucun commentaire") . "<br>
                </div>
                <div class='info-droite'>
                <form class='btn-supprimer' method='GET' action='index.php'>
                    <input type='hidden' name='action' value='supprimerVisite'>
                    <input type='hidden' name='case' value='Gerer_Visites'>
                    <input type='hidden' name='date_du_jour' value='" . htmlspecialchars($visite['date_du_jour']) . "'>
                    <input type='hidden' name='id_medicament' value='" . htmlspecialchars($visite['id_medicament']) . "'>
                    <input type='hidden' name='id_pds' value='" . htmlspecialchars($visite['id_pds']) . "'>
                    <input type='hidden' name='id_salarie' value='" . htmlspecialchars($visite['id_salarie']) . "'>
                    <button type='submit'>Supprimer</button>
                </form>
                    <a href='$editLink' class='$buttonClass' $buttonDisabled>$buttonText</a>
                    
                </div>
            </div>
        ";

    }
}