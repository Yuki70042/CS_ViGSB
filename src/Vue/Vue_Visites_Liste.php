<?php
namespace App\Vue;
use App\Utilitaire\Vue_Composant;

class Vue_Visites_Liste extends Vue_Composant
{
    private array $visites;

    public function __construct(array $visites) {
        $this->visites = $visites;
    }

    public function donneTexte(): string
    {
        $html = "
    <!DOCTYPE html>
    <html lang='fr'>
        <head>
            <meta charset='UTF-8'>
            <meta name='viewport' content='width=device-width, initial-scale=1.0'>
            <title>Mes Visites</title>
            <link rel='stylesheet' href='../../public/css/Visites_Liste.css'> <!-- Lien vers le CSS -->
        </head>
    <ul>";
        // Changer le titre en fonction de l'action
        $titre = ($_GET['action'] === 'historique') ? "Historique" : "Mes Visites";
        $html .= "<h1>$titre</h1><ul>";



        foreach ($this->visites as $visite) {
            // Vérifie si un compte-rendu existe
            $compteRenduExistant = !empty($visite['compte_rendu']);
            $checkboxStatus = $compteRenduExistant ? "checked" : "";
            $compteRenduAction = $compteRenduExistant ? "Modifier mon compte-rendu" : "Rédiger mon compte-rendu";
            $buttonClass = $compteRenduExistant ? "btn-modifier" : "btn-rediger";

            // Vérifie si la visite est validée
            $visiteValidee = !empty($visite['validation']) && $visite['validation'] == 1;

            if ($visiteValidee) {
                $compteRenduAction = "Compte-rendu validé";
                $buttonClass = "btn-valide";
                $disabledAttribute = "disabled"; // Désactiver le bouton
                $editLink = "#"; // Empêcher l'édition
            } else {
                $disabledAttribute = ""; // Bouton cliquable
                $editLink = "index.php?case=visiteur&action=editer&date=" . urlencode($visite['date']) .
                    "&id_pds=" . urlencode($visite['id_pds']) .
                    "&id_medicament=" . urlencode($visite['id_medicament']);
            }

            $html .= "
                <li>
                    <div class='info-gauche'>
                        <p><strong>Médecin :</strong> " . htmlspecialchars($visite['nom_pro']) . "</p>
                        <p><strong>Adresse :</strong> " . htmlspecialchars($visite['adresse_pro']) . "</p>
                        <p><strong>Date :</strong> " . htmlspecialchars($visite['date']) . "</p>
                        
                        <label>
                            <input type='checkbox' disabled $checkboxStatus>
                            <span>" . ($compteRenduExistant ? "Compte-rendu réalisé" : "Compte-rendu non réalisé") . "</span>
                        </label>
                    </div>
                
                    <div class='info-droite'>
                        " . ($compteRenduExistant ? "
                        <div class='compte-rendu-box'>
                            <p class='compte-rendu-titre'><strong>Compte-rendu :</strong></p>
                            <p class='compte-rendu-texte'>" . nl2br(htmlspecialchars($visite['compte_rendu'])) . "</p>
                        </div>" : "") . "
                        
                        <a href='$editLink' class='$buttonClass' $disabledAttribute>$compteRenduAction</a>
                    </div>
                </li>";
        }

        $html .= "</ul>";

        $html .= "
        <!-- Bouton Retour -->
        <form method='GET' action='index.php'>
            <input type='hidden' name='action' value='visiteur'>
            <input type='hidden' name='case' value='menuPrincipal'>
            <button type='submit'>Retour au menu principal</button>
        </form>
    ";

        return $html;
    }


}

