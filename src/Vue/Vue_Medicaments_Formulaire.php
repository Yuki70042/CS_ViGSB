<?php

namespace App\Vue;

use App\Utilitaire\Vue_Composant;

class Vue_Medicaments_Formulaire extends Vue_Composant {

    private ?array $medicaments;

    public function __construct(?array $medicaments = null) {
        $this->medicaments = $medicaments;
    }

    public function donneTexte(): string {
        $titre = $this->medicaments ? "Modifier un Médicament" : "Ajouter un Médicament";
        $action = $this->medicaments ? "traiterModification" : "traiterAjout";
        $id_medicament = $this->medicaments['id_medicament'] ?? '';
        $designation = $this->medicaments['designation'] ?? '';
        $prix = $this->medicaments['prix'] ?? '';


        $html = '
                <head>
                    <meta charset="UTF-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <title>Modifier le Compte-Rendu</title>
                    <link rel="stylesheet" href="../public/Listes_Table.css"> 
                </head>
                <h1>' . $titre . '</h1>';
                $html .= '<form action="index.php?case=Gerer_Medicaments&action=' . $action . '" method="post">
                    ' . ($this->medicaments ? '<input type="hidden" name="id_medicament" value="' . htmlspecialchars($id_medicament) . '">' : '') . '
                    <div>
                        <label for="designation">Designation :</label>
                        <input type="text" id="designation" name="designation" value="' . htmlspecialchars($designation) . '" required>
                    </div>
                    <form method="post" action="">
                        <div>
                            <label for="prix">Prix :</label>
                            <input type="number" id="prix" name="prix" value="' . htmlspecialchars($prix) . '" step="0.01" required>
                        </div>
                        <button type="submit">Envoyer</button>
                    </form>
        
        
                    <div>
                        <button type="submit">Enregistrer</button>
                        <a href="index.php?case=Gerer_Medicaments&action=voirListe">Annuler</a>
                    </div>
                  </form>';


                $html .=" <!-- Bouton Retour -->
                    <form method='GET' action='index.php'>
                       <input type='hidden' name='case' value='visiteur'>
                       <input type='hidden' name='action' value='menuPrincipal'> <!-- Action pour revenir au menu -->
                       <button type='submit'>Retour au menu principal</button>
                    </form>  ";

        return $html;
    }
}
