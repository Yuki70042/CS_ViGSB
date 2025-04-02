<?php
namespace App\Vue;
use App\Utilitaire\Vue_Composant;

class Vue_VisitesRegion_Liste extends Vue_Composant
{
    private array $visites;

    public function __construct(array $visites) {
        $this->visites = $visites;
    }

    public function donneTexte(): string
    {
        $html = "

        <link rel='stylesheet' href='../../public/css/Visites_Liste.css'> 
        <ul>";
        // Changer le titre en fonction du type de connexion
        if ($_SESSION["typeConnexionBack"] === "responsable") {
            $html .= "<h1>Visites du Secteur</h1>";
        } else {
            $html .= "<h1>Visites de la Région</h1>";
        }

            // Vérification du type de connexion
            if ($_SESSION["typeConnexionBack"] !== "responsable") {
                $html .= "
                    
                    <!-- Bouton Création d'une Visite -->
                    <form method='GET' action='index.php'>
                        <input type='hidden' name='action' value='ajouterVisite'>
                        <input type='hidden' name='case' value='Gerer_Visites'>
                        <button type='submit'>Organiser une Visite</button>
                    </form>
                ";
            }


            $html .= "
                <!-- Bouton Retour -->
                <form method='GET' action='index.php'>
                    <input type='hidden' name='action' value=''>
                    <input type='hidden' name='case' value='menuPrincipal'>
                    <button type='submit'>Retour au menu principal</button>
                </form>
            ";

            foreach ($this->visites as $visite) {
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


                $html .= "
                
                    <li>
                        <div class='info-gauche'>
                            <strong>Visiteur :</strong> ".htmlspecialchars($visite['nom'])." ".htmlspecialchars($visite['prenom'])."
                            <strong>Médecin :</strong> " . htmlspecialchars($visite['nom_pro']) . "<br>
                            <strong>Adresse :</strong> " . htmlspecialchars($visite['adresse_pro']) . "<br>
                            <strong>Date :</strong> " . htmlspecialchars($visite['date_du_jour']) . "<br>
                            <strong>Commentaire :</strong> " . htmlspecialchars($visite['commentaire'] ?? "Aucun commentaire") . "<br>
                            
                            <label>
                                <input type='checkbox' disabled $checkboxStatus>
                                <span>" . ($compteRenduExistant ? "Compte-rendu réalisé" : "Compte-rendu non réalisé") . "</span>
                            </label>
                            
                        </div>
                        
                        <div class='info-droite'>
                        
                                <input type='checkbox' disabled $checkboxStatus>
                                <span>" . ($validationEffectuee ? "Compte-rendu validé" : "Compte-rendu non validé") . "</span>
                                </label>
                                <br>               
                    
                            <a href='$editLink' class='$buttonClass' $buttonDisabled>$buttonText</a>
                        </div>
                    </li>
                ";
            }
        $html .=
            "</ul>";


        return $html;
    }
}