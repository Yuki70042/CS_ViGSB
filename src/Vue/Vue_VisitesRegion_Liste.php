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
        $html = "
        <link rel='stylesheet' href='../../public/css/Visites_Liste.css'> 
        <h1>Visites de la Région</h1>";

        // Vérification du type de connexion
        if ($_SESSION["typeConnexionBack"] !== "responsable") {
            $html .= "
                <!-- Bouton Création d'une Visite -->
                <form method='GET' action='index.php'>
                    <input type='hidden' name='action' value='ajouterVisite'>
                    <input type='hidden' name='case' value='Gerer_Visites'>
                    <button type='submit'>Organiser une Visite</button>
                </form>";
        }

        $html .= "
            <!-- Bouton Retour -->
            <form method='GET' action='index.php'>
                <input type='hidden' name='action' value=''>
                <input type='hidden' name='case' value='menuPrincipal'>
                <button type='submit'>Retour au menu principal</button>
            </form>";

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

        $html .= "
            <!-- Bouton vers l'historique des visites validés -->
            <form method='GET' action='index.php'>
                <input type='hidden' name='action' value='historiqueVisitesParRegion'>
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
        $checkboxStatus = $validationEffectuee ? "checked" : "";
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
                    <label>
                        <!--<input type='checkbox' disabled $checkboxStatus>
                        <span>" . ($compteRenduExistant ? "Compte-rendu réalisé" : "Compte-rendu non réalisé") . "</span> -->
                    </label>
                    <br>
                    <label>
                        <!--<input type='checkbox' disabled $checkboxStatus>
                        <span>" . ($validationEffectuee ? "Compte-rendu validé" : "Compte-rendu non validé") . "</span> -->
                    </label>
                    <br>
                    <a href='$editLink' class='$buttonClass' $buttonDisabled>$buttonText</a>
                </div>
            </div>
        ";

    }
}