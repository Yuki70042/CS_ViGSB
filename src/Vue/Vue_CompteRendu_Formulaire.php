<?php
namespace App\Vue;
use App\Utilitaire\Vue_Composant;

class Vue_CompteRendu_Formulaire extends Vue_Composant {
    private array $cleVisite;
    private string $compteRendu;

    public function __construct(array $cleVisite, string $compteRendu) {
        $this->cleVisite = $cleVisite;
        $this->compteRendu = $compteRendu;
    }

    public function donneTexte(): string {
        return "
            <!DOCTYPE html>
                <html lang='fr'>
                <head>
                    <meta charset='UTF-8'>
                    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
                    <title>Modifier le Compte-Rendu</title>
                    <link rel='stylesheet' href='../public/Visite_CompteRendu_Formulaire.css'> 
                </head>
                <body>
                    <!-- Bouton Retour -->
                    <form method='GET' action='index.php'>
                        <input type='hidden' name='case' value='visiteur'>
                        <input type='hidden' name='action' value='voirVisites'>
                        <button type='submit' class='btn-retour'>Retour</button> 
                    </form>
        
                    <h1>Modifier le Compte-Rendu</h1>
                    <form method='post' action='index.php?case=visiteur&action=modifier'>
                        <input type='hidden' name='date' value='" . htmlspecialchars($this->cleVisite['date']) . "'>
                        <input type='hidden' name='id_medicament' value='" . htmlspecialchars($this->cleVisite['id_medicament']) . "'>
                        <input type='hidden' name='id_pds' value='" . htmlspecialchars($this->cleVisite['id_pds']) . "'>
                        <textarea name='compte_rendu'>" . htmlspecialchars($this->compteRendu) . "</textarea><br>
                      
                        <button type='submit' class='btn-modifier'>Modifier</button> 
                    </form>
                </body>
                </html>
        ";
    }
}
